<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ClubesController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Federacions = TableRegistry::get('Federacions');
    }

    public function index() {
        $clubes = $this->Clubes->find('all', ['order'=>'codigo']);
        $this->set(compact('clubes'));
    }

    public function detalle($id=null) {
        if(empty($id)) {
            $clube =  $this->Clubes->newEntity();
        } else {
            $clube = $this->Clubes->get($id, [ 'contain' => ['Equipas', 'Federacions'] ]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $federacions = $this->Federacions->find('all', ['order'=>'codigo']);
        $this->set(compact('clube', 'categorias', 'federacions'));
    }

    public function gardar() {
        $clube = $this->Clubes->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $clube = $this->Clubes->patchEntity($clube, $data);
            $clube->federacions = $this->Federacions->find()
                ->where(['id IN' => $data['federacions']])
                ->toArray();
            $clube->setDirty('federacions', true);
            if ($this->Clubes->save($clube)) {
                $this->Flash->success(__('Gardouse o clube correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar o clube.'));
        }
        $this->set(compact('clube'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $clube = $this->Clubes->get($id);
        if($this->Clubes->delete($clube)) {
            $this->Flash->success(__('Eliminouse o clube correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o clube.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function detalleEquipa($id=null) {
        if(empty($id)) {
            $equipa = $this->Equipas->newEntity();
            $equipa->id_clube = $this->request->getQuery('idClube');
            $equipa->clube = $this->Clubes->get($equipa->id_clube);
        } else {
            $equipa = $this->Equipas->get($id, ['contain'=>['Clube']]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $this->set(compact('categorias', 'equipa'));
    }

    public function gardarEquipa() {
        $equipa = $this->Equipas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $equipa = $this->Equipas->patchEntity($equipa, $this->request->getData());
            if ($this->Equipas->save($equipa)) {
                $this->Flash->success(__('Gardouse a equipa correctamente.'));
                return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
            }
            $this->Flash->error(__('Erro ao gardar a equipa.'));
        }
        $this->set(compact('equipa'));
        $this->render('detalleEquipa');
    }

    public function borrarEquipa($id) {
        $equipa = $this->Equipas->get($id);
        if($this->Equipas->delete($equipa)) {
            $this->Flash->success(__('Eliminouse a equipa correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a equipa.'));
        }
        return $this->redirect(['action'=>'detalle', $equipa->id_clube]);
    }

}
