<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use App\Model\Tempadas;
use App\Model\TiposCompeticion;
use Cake\Event\Event;
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
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Fases = TableRegistry::get('Fases');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index() {
        $this->set('tempadas', $this->Tempadas->getTempadas());
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all', ['order'=>'tempada DESC','nome']));
    }

    public function competicion($id) {
        $competicion = $this->Competicions->get($id, ['contain'=>['Fases']]);
        $xornadas = [];
        foreach($competicion->fases as $f) {
            $xornadasFase = $this->Xornadas->find()->where(['id_fase'=>$f->id]);
            foreach($xornadasFase as $x) {
                $key = $x->data->format('Y-m-d');
                if(empty($xornadas[$key])) {
                    $xornadas[$key] = $x;
                    $xornadas[$key]->partidos = [];
                }
                $partidos = $this->Partidos->find()->where(['id_xornada'=>$x->id])->order(['data_partido','hora_partido']);
                foreach($partidos as $p) {
                    $p->categoria = $f->categoria;
                    $xornadas[$key]->partidos[] = $p;
                }
                usort($xornadas[$key]->partidos, [$this,'cmpPartido']);
            }
        }
        usort($xornadas, [$this,'cmpXornada']);
        $arbitros = $this->Arbitros->findMap();
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $this->set(compact('competicion', 'xornadas', 'arbitros', 'campos', 'equipas'));
    }

    public function partido($id) {
        $partido = $this->Partidos->get($id);
        $partido->xornada = $this->Xornadas->get($partido->id_xornada);
        $partido->fase = $this->Fases->get($partido->xornada->id_fase);
        $partido->competicion = $this->Competicions->get($partido->fase->id_competicion);
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $partido->data_partido_str = empty($partido->data_partido) ? NULL : $partido->data_partido->format('d-m-Y');

        $arbitros = $this->Arbitros->findMap();
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $categorias = $this->Categorias->getCategorias();
        $this->set(compact('partido', 'arbitros', 'campos', 'equipas', 'categorias'));
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
     * Ordena os partidos dunha xornada, por data/hora e, senon, por equipa local
     */
    private function cmpPartido($a, $b) {
        $cmp = 0;
        if(!empty($a->data_partido) && !empty($b->data_partido)) {
            $cmp = ((int)$a->data_partido->toUnixString()) - ((int)$b->data_partido->toUnixString());
            if($cmp===0) {
                $cmp = strcmp($a->hora_partido, $b->hora_partido);
            }
        }
        if(empty($cmp)) {
            $equipaLocalA = $this->Equipas->get($a->id_equipa1);
            $equipaLocalB = $this->Equipas->get($b->id_equipa1);
            $cmp = strcoll($equipaLocalA->nome, $equipaLocalB->nome);
        }
        return $cmp;
    }

    /**
     * Ordena as xornadas por data
     */
    private function cmpXornada($a, $b) {
        return ((int)$a->data->toUnixString()) - ((int)$b->data->toUnixString());
    }

    /**
     * Procesa o formulario dun partido
     */
    private function processGameForm($partido, $data) {
        $p = $this->Partidos->patchEntity($partido, $data);
        $p->data_partido = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
        $p->goles_equipa1 = $this->clean($data['goles_equipa1']);
        $p->tantos_equipa1 = $this->clean($data['tantos_equipa1']);
        $p->total_equipa1 = $this->clean($data['total_equipa1']);
        $p->goles_equipa2 = $this->clean($data['goles_equipa2']);
        $p->tantos_equipa2 = $this->clean($data['tantos_equipa2']);
        $p->total_equipa2 = $this->clean($data['total_equipa2']);
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
