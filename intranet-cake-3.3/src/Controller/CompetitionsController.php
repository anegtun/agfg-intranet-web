<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\TiposCompeticion;

class CompetitionsController extends AppController {
    
    public function initialize() {
        $this->TiposCompeticion = new TiposCompeticion();
    }

    public function index() {
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competitions', $this->Competitions->find('all'));
    }

    public function detail($id=null) {
        $competition = empty($id) ? $this->Competitions->newEntity() : $this->Competitions->get($id);
        $tiposCompeticion = $this->TiposCompeticion->getTipos();
        $this->set(compact('competition', 'tiposCompeticion'));
    }

    public function save() {
        $competition = $this->Competitions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $team = $this->Competitions->patchEntity($competition, $this->request->data);
            if ($this->Competitions->save($team)) {
                $this->Flash->success(__('Gardouse a competición correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar a competición.'));
        }
        $this->set(compact('competition'));
        $this->render('detail');
    }

    public function delete($id) {
        $team = $this->Competitions->get($id);
        if($this->Competitions->delete($team)) {
            $this->Flash->success(__('Eliminouse a competición correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a competición.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
