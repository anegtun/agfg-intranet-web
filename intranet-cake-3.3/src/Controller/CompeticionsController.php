<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\TiposCompeticion;

class CompeticionsController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->TiposCompeticion = new TiposCompeticion();
    }

    public function index() {
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all'));
    }

    public function detail($id=null) {
        $competicion = empty($id) ? $this->Competicions->newEntity() : $this->Competicions->get($id, ['contain'=>['Fases']]);
        $tiposCompeticion = $this->TiposCompeticion->getTipos();
        $this->set(compact('competicion', 'tiposCompeticion'));
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
