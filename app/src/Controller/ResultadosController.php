<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use App\Model\Tempadas;
use App\Model\TiposCompeticion;
use Cake\Event\Event;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class ResultadosController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Tempadas = new Tempadas();
        $this->TiposCompeticion = new TiposCompeticion();
        $this->Arbitros = TableRegistry::get('Arbitros');
        $this->Campos = TableRegistry::get('Campos');
        $this->Clubes = TableRegistry::get('Clubes');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Fases = TableRegistry::get('Fases');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index() {
        $competicions = $this->Competicions->find()
            ->contain('Federacion')
            ->order(['Competicions.tempada DESC','Competicions.nome ASC']);

        $tempadas = $this->Tempadas->getTempadas();
        $tiposCompeticion = $this->TiposCompeticion->getTipos();

        $this->set(compact('competicions', 'tempadas', 'tiposCompeticion'));
    }

    public function competicion($id) {
        $competicion = $this->Competicions->get($id, ['contain'=>['Fases']]);
  
        $xornadas = [];
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fases', 'Xornadas', 'Equipas1'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornadas.data)'])
            ->enableAutoFields(true)
            ->where(['Fases.id_competicion'=>$id])
            ->order(['data_calendario','hora_partido', 'Equipas1.nome'])
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
                return $results->map(function ($row) {
                    $row['data_calendario'] = FrozenDate::createFromFormat('Y-m-d', $row['data_calendario']);
                    return $row;
                });
            });
        if(!empty($this->request->getQuery('id_fase'))) {
            $partidos->where(['Partidos.id_fase' => $this->request->getQuery('id_fase')]);
        }
        if(!empty($this->request->getQuery('id_campo'))) {
            $partidos->where(['Partidos.id_campo' => $this->request->getQuery('id_campo')]);
        }

        $fases = $this->Fases->find()
            ->where(['id_competicion'=>$id]);
        $arbitros = $this->Arbitros->findMap();
        $campos_map = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();

        $all_partidos = $this->Partidos->find()
            ->contain(['Fases'])
            ->where(['Fases.id_competicion'=>$id]);
        $campos = [];
        foreach($all_partidos as $p) {
            if(!empty($p->id_campo)) {
                $campos[$p->id_campo] = $campos_map[$p->id_campo];
            }
        }

        $this->set(compact('competicion', 'partidos', 'arbitros', 'campos', 'equipas', 'fases'));
    }

    public function reemplazar($id) {
        $this->competicion($id);
        $competicion = $this->Competicions->get($id);

        $id_clubes = $this->Clubes->findInFederacion($competicion->id_federacion)
            ->extract('id')
            ->toList();

        $equipas_competicion = $this->Equipas->find()
            ->where(['id_clube IN' => $id_clubes])
            ->order('nome');

        $this->set(compact('equipas_competicion'));
    }

    public function gardarReemplazo() {
        $data = $this->request->getData();
        if(!empty($data['id_competicion']) && !empty($data['id_orixinal']) && !empty($data['id_nova'])) {
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fases'])
                ->where(['Fases.id_competicion' => $data['id_competicion'], 'id_equipa1' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_equipa1 = $data['id_nova'];
                $this->Partidos->save($p);
            }
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fases'])
                ->where(['Fases.id_competicion' => $data['id_competicion'], 'id_equipa2' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_equipa2 = $data['id_nova'];
                $this->Partidos->save($p);
            }
            $partidos = $this->Partidos
                ->find()
                ->contain(['Fases'])
                ->where(['Fases.id_competicion' => $data['id_competicion'], 'id_umpire' => $data['id_orixinal']]);
            foreach($partidos as $p) {
                $p->id_umpire = $data['id_nova'];
                $this->Partidos->save($p);
            }
        }
        return $this->redirect(['action'=>'competicion', $data['id_competicion']]);
    }

    public function partido($id) {
        $partido = $this->Partidos->get($id);
        $partido->xornada = $this->Xornadas->get($partido->id_xornada);
        $partido->fase = $this->Fases->get($partido->xornada->id_fase);
        $partido->competicion = $this->Competicions->get($partido->fase->id_competicion);
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $partido->data_partido_str = empty($partido->data_partido) ? NULL : $partido->data_partido->format('d-m-Y');

        $id_clubes = $this->Clubes->findInFederacion($partido->competicion->id_federacion)
            ->extract('id')
            ->toList();
        $umpires = $this->Equipas->find()
            ->where(['id_clube IN' => $id_clubes])
            ->order('nome');

        $arbitros = $this->Arbitros->findMap(true);
        if ($partido->id_arbitro) {
            $arbitros[$partido->id_arbitro] = $this->Arbitros->get($partido->id_arbitro);
        }
        $campos = $this->Campos->findMap(true);
        if ($partido->id_campo) {
            $campos[$partido->id_campo] = $this->Campos->get($partido->id_campo);
        }
        $equipas = $this->Equipas->findMap();
        $categorias = $this->Categorias->getCategorias();
        $this->set(compact('partido', 'arbitros', 'campos', 'equipas', 'umpires', 'categorias'));
    }

    public function gardar() {
        $partido = $this->Competicions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $partido = $this->processGameForm($partido, $data);
            if ($this->Partidos->save($partido)) {
                $this->Flash->success(__('Gardáronse os datos do partido correctamente.'));
                return $this->redirect(['action'=>'competicion', $data['id_competicion']]);
            }
            $this->Flash->error(__('Erro ao gardar os datos do partido.'));
        }
        $this->set(compact('partido'));
        $this->render('partido');
    }

    /**
     * Procesa o formulario dun partido
     */
    private function processGameForm($partido, $data) {
        $p = $this->Partidos->patchEntity($partido, $data);
        $p->data_partido = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
        $p->id_campo = $this->clean($data['id_campo']);
        $p->id_arbitro = $this->clean($data['id_arbitro']);
        $p->goles_equipa1 = $this->clean($data['goles_equipa1']);
        $p->tantos_equipa1 = $this->clean($data['tantos_equipa1']);
        if(isset($data['total_equipa1'])) {
            $p->total_equipa1 = $this->clean($data['total_equipa1']);
        }
        $p->goles_equipa2 = $this->clean($data['goles_equipa2']);
        $p->tantos_equipa2 = $this->clean($data['tantos_equipa2']);
        if(isset($data['total_equipa2'])) {
            $p->total_equipa2 = $this->clean($data['total_equipa2']);
        }
        $p->sancion_puntos_equipa1 = $this->clean($data['sancion_puntos_equipa1']);
        $p->sancion_puntos_equipa2 = $this->clean($data['sancion_puntos_equipa2']);
        if(!is_null($p->goles_equipa1) || !is_null($p->tantos_equipa1)) {
            $p->total_equipa1 = NULL;
        }
        if(!is_null($p->goles_equipa2) || !is_null($p->tantos_equipa2)) {
            $p->total_equipa2 = NULL;
        }
        return $p;
    }

    /**
     * Forza NULL en caso de cadea baleira
     */
    private function clean($str) {
        return $str==='' ? NULL : $str;
    }
    
}
