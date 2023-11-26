<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class FederacionsController extends AppController {
    
    public function initialize(): void {
        parent::initialize();
        $this->Clubes = TableRegistry::get('Clubes');
    }

    public function index() {
        $federacions = $this->Federacions->find()->order('codigo');
        $this->set(compact('federacions'));
    }

    public function detalle($id=null) {
        $federacion = $this->Federacions->getOrNew($id, ['contain' => [ 'Clubes' => [ 'sort' => 'Clubes.codigo' ] ]]);
        $this->set(compact('federacion'));
    }

    public function gardar() {
        $federacion = $this->Federacions->newEntity($this->request->getData());
        if ($this->Federacions->save($federacion)) {
            $this->Flash->success(__('Gardouse a federación correctamente.'));
            return $this->redirect(['action'=>'index']);
        }
        $this->Flash->error(__('Erro ao gardar a federación.'));
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
