<?php
namespace App\Controller;

class CamposController extends AppController {

    public function index() {
        $campos = $this->Campos->find()->order(['pobo', 'nome']);
        $this->set(compact('campos'));
    }

    public function detalle($id=null) {
        $campo = $this->Campos->getOrNew($id);
        $this->set(compact('campo'));
    }

    public function gardar() {
        $campo = $this->Campos->newEntity($this->request->getData());
        if ($this->Campos->save($campo)) {
            $this->Flash->success(__('Gardouse o campo correctamente.'));
            return $this->redirect(['action'=>'index']);
        }
        $this->Flash->error(__('Erro ao gardar o campo.'));
        $this->set(compact('campo'));
        $this->render('detalle');
    }

    public function borrar($id) {
        $campo = $this->Campos->get($id);
        if($this->Campos->delete($campo)) {
            $this->Flash->success(__('Eliminouse o campo correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o campo.'));
        }
        return $this->redirect(['action'=>'index']);
    }

}
