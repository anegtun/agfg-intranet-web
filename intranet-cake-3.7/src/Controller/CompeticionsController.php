<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use App\Model\Tempadas;
use App\Model\TiposCompeticion;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class CompeticionsController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Tempadas = new Tempadas();
        $this->TiposCompeticion = new TiposCompeticion();
        $this->Fases = TableRegistry::get('Fases');
    }

    public function index() {
        $this->set('categorias', $this->Categorias->getCategorias());
        $this->set('tempadas', $this->Tempadas->getTempadas());
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all'));
    }

    public function detalle($id=null) {
        $competicion = empty($id) ? $this->Competicions->newEntity() : $this->Competicions->get($id, ['contain'=>['Fases']]);
        $categorias = $this->Categorias->getCategorias();
        $tempadas = $this->Tempadas->getTempadas();
        $tiposCompeticion = $this->TiposCompeticion->getTipos();
        $this->set(compact('competicion', 'categorias', 'tempadas', 'tiposCompeticion'));
    }

    public function detailFase($id=null) {
        $fase = empty($id) ? $this->Fases->newEntity() : $this->Fases->get($id);
        $this->set(compact('fase'));
    }



    public function save() {
        $competicion = $this->Competicions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $team = $this->Competicions->patchEntity($competicion, $this->request->data);
            if ($this->Competicions->save($team)) {
                $this->Flash->success(__('Gardouse a competición correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar a competición.'));
        }
        $this->set(compact('competicion'));
        $this->render('detail');
    }

    public function delete($id) {
        $competicion = $this->Competicions->get($id);
        if($this->Competicions->delete($competicion)) {
            $this->Flash->success(__('Eliminouse a competición correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a competición.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
