<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class FederacionsController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Clubes = TableRegistry::get('Clubes');
    }

    public function index() {
        $federacions = $this->Federacions->find()->order('codigo');
        $this->set(compact('federacions'));
    }

    public function detalle($id=null) {
        $federacion = empty($id)
            ? $this->Federacions->newEntity()
            : $this->Federacions->get($id, ['contain' => [ 'Clubes' => [ 'sort' => 'Clubes.codigo' ] ]]);
        $this->set(compact('federacion'));
    }

    public function gardar() {
        $federacion = $this->Federacions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $federacion = $this->Federacions->patchEntity($federacion, $this->request->getData());
            if ($this->Federacions->save($federacion)) {
                $this->Flash->success(__('Gardouse a federación correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar a federación.'));
        }
        $this->set(compact('federacion'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $federacion = $this->Federacions->get($id);
        if($this->Federacions->delete($federacion)) {
            $this->Flash->success(__('Eliminouse a federación correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a federación.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
