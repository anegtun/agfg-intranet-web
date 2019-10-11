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
        $this->set('categorias', $this->Categorias->getCategorias());
        $this->set('tempadas', $this->Tempadas->getTempadas());
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all', ['order'=>'tempada DESC','nome']));
    }

    public function competicion($id) {
        $competicion = $this->Competicions->get($id, ['contain'=>['Fases']]);
        foreach($competicion->fases as $f) {
            $f->xornadas = $this->Xornadas->find()->where(['id_fase'=>$f->id]);
            foreach($f->xornadas as $x) {
                $x->partidos = $this->Partidos->find()->where(['id_xornada'=>$x->id])->order(['data_partido','hora_partido']);
            }
        }
        $arbitros = $this->Arbitros->findMap();
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $this->set(compact('competicion', 'arbitros', 'campos', 'equipas'));
    }

    public function partido($id) {
        $partido = $this->Partidos->get($id);
        $partido->xornada = $this->Xornadas->get($partido->id_xornada);
        $partido->fase = $this->Fases->get($partido->xornada->id_fase);
        $partido->competicion = $this->Competicions->get($partido->fase->id_competicion);
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $partido->data_partido_str = $partido->data_partido->format('d-m-Y');

        $arbitros = $this->Arbitros->findMap();
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $this->set(compact('partido', 'arbitros', 'campos', 'equipas'));
    }

    public function gardar() {
        $partido = $this->Competicions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $partido = $this->Partidos->patchEntity($partido, $data);
            $partido->data_partido = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
            if ($this->Partidos->save($partido)) {
                $this->Flash->success(__('Gardáronse os datos do partido correctamente.'));
                return $this->redirect(['action'=>'competicion', $data['id_competicion']]);
            }
            $this->Flash->error(__('Erro ao gardar os datos do partido.'));
        }
        $this->set(compact('partido'));
        $this->render('partido');
    }

}
