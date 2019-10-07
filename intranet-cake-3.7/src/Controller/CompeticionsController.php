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
        $this->Equipas = TableRegistry::get('Equipas');
        $this->FasesEquipas = TableRegistry::get('FasesEquipas');
    }

    public function index() {
        $this->set('categorias', $this->Categorias->getCategorias());
        $this->set('tempadas', $this->Tempadas->getTempadas());
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all'));
    }

    public function detalle($id=null) {
        $competicion = empty($id) ? $this->Competicions->newEntity() : $this->Competicions->get($id, array('contain'=>array('Fases')));
        $categorias = $this->Categorias->getCategorias();
        $tempadas = $this->Tempadas->getTempadas();
        $tiposCompeticion = $this->TiposCompeticion->getTipos();
        $this->set(compact('competicion', 'categorias', 'tempadas', 'tiposCompeticion'));
    }

    public function gardar() {
        $competicion = $this->Competicions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $competicion = $this->Competicions->patchEntity($competicion, $this->request->getData());
            if ($this->Competicions->save($competicion)) {
                $this->Flash->success(__('Gardouse a competición correctamente.'));
                return $this->redirect(['action'=>'detalle', $competicion->id]);
            }
            $this->Flash->error(__('Erro ao gardar a competición.'));
        }
        $this->set(compact('competicion'));
        $this->render('detail');
    }

    public function borrar($id) {
        $competicion = $this->Competicions->get($id);
        if($this->Competicions->delete($competicion)) {
            $this->Flash->success(__('Eliminouse a competición correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a competición.'));
        }
        return $this->redirect(array('action'=>'index'));
    }



    public function detalleFase($id=null) {
        if(empty($id)) {
            $fase = $this->Fases->newEntity();
            $fase->id_competicion = $this->request->getQuery('idCompeticion');
            $fase->equipas = [];
        } else {
            $fase = $this->Fases->get($id);
            $fase->equipas = $this->FasesEquipas->find('list', ['keyField'=>'id_equipa','valueField'=>'id_equipa'])->where(['id_fase'=>$fase->id])->toArray();
        }
        $competicion = $this->Competicions->get($fase->id_competicion);
        $equipas = $this->Equipas->find()->where(['categoria'=>$competicion->categoria]);
        $this->set(compact('fase','competicion','equipas'));
    }

    public function gardarFase() {
        $fase = $this->Fases->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            // Gardamos datos de fase
            $fase = $this->Fases->patchEntity($fase, $data);
            if (!$this->Fases->save($fase)) {
                $this->Flash->error(__('Erro ao gardar a fase.'));
                $this->set(compact('fase'));
                return $this->render('detalleFase');
            }
            // Gardamos equipas
            $this->FasesEquipas->deleteAll(['id_fase'=>$fase->id]);
            if(!empty($data['equipas'])) {
                foreach($data['equipas'] as $idE) {
                    $faseEquipa = $this->FasesEquipas->newEntity();
                    $faseEquipa->id_fase = $fase->id;
                    $faseEquipa->id_equipa = $idE;
                    $this->FasesEquipas->save($faseEquipa);
                }
            }
            $this->Flash->success(__('Gardouse a fase correctamente.'));
            $this->redirect(['action'=>'detalleFase', $fase->id]);
        }
    }

    public function borrarFase($id) {
        $fase = $this->Fases->get($id);
        if($this->Fases->delete($fase)) {
            $this->Flash->success(__('Eliminouse a fase correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a fase.'));
        }
        return $this->redirect(['action'=>'detalle', $fase->id_competicion]);
    }

}
