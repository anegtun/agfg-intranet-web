<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use Cake\ORM\TableRegistry;

class EconomicoController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Areas = TableRegistry::get('MovementosArea');
        $this->Subareas = TableRegistry::get('MovementosSubarea');
        $this->Movementos = TableRegistry::get('Movementos');
    }

    public function index() {
        $contas = $this->Contas->getAll();
        $movementos_query = $this->Movementos->find()->where(['prevision'=>false]);
        $prevision_query = $this->Movementos->find()->where(['prevision'=>true]);
        $total = $movementos_query
            ->select([
                'balance' => $movementos_query->func()->sum('importe'),
                'comision' => $movementos_query->func()->sum('comision')
            ])->toArray()[0];
        $prevision = (object) [
            'ingresos' => $prevision_query->select(['ingresos' => $prevision_query->func()->sum('importe')])->where(['importe >' => 0])->toArray()[0]->ingresos,
            'gastos' => $prevision_query->select(['ingresos' => $prevision_query->func()->sum('importe')])->where(['importe <' => 0])->toArray()[0]->gastos
        ];
        $resumo_balance = $movementos_query
            ->select(['conta', 'balance' => $movementos_query->func()->sum('importe'), 'comision' => $movementos_query->func()->sum('comision')])
            ->group(['conta'])
            ->toArray();
        $this->set(compact('contas', 'total', 'prevision', 'resumo_balance'));
    }

    public function areas() {
        $areas = $this->Areas->find('all', ['order'=>'nome']);
        $subareas = $this->Subareas->find('all', ['order'=>'nome']);
        $this->set(compact('areas', 'subareas'));
    }

    public function detalleArea($id=null) {
        $area = empty($id) ? $this->Areas->newEntity() : $this->Areas->get($id);
        $this->set(compact('area'));
    }

    public function gardarArea() {
        $area = $this->Areas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $area = $this->Areas->patchEntity($area, $this->request->getData());
            if ($this->Areas->save($area)) {
                $this->Flash->success(__('Gardouse a área correctamente.'));
                return $this->redirect(['action'=>'areas']);
            }
            $this->Flash->error(__('Erro ao gardar a área.'));
        }
        $this->set(compact('area'));
        $this->render('detalle');
    }

    public function borrarArea($id) {
        $area = $this->Areas->get($id);
        if($this->Areas->delete($area)) {
            $this->Flash->success(__('Eliminouse a área correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a área.'));
        }
        return $this->redirect(['action'=>'areas']);
    }

    public function detalleSubarea($id=null) {
        $subarea = empty($id) ? $this->Subareas->newEntity() : $this->Subareas->get($id);
        $areas = $this->Areas->find()->find('list', ['keyField'=>'id','valueField'=>'nome','order'=>'nome'])->toArray();
        $this->set(compact('subarea', 'areas'));
    }

    public function gardarSubarea() {
        $subarea = $this->Subareas->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $subarea = $this->Subareas->patchEntity($subarea, $this->request->getData());
            if ($this->Subareas->save($subarea)) {
                $this->Flash->success(__('Gardouse a subárea correctamente.'));
                return $this->redirect(['action'=>'areas']);
            }
            $this->Flash->error(__('Erro ao gardar a subárea.'));
        }
        $this->set(compact('subarea'));
        $this->render('detalle');
    }

    public function borrarSubarea($id) {
        $subarea = $this->Subareas->get($id);
        if($this->Subareas->delete($subarea)) {
            $this->Flash->success(__('Eliminouse a subárea correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a subárea.'));
        }
        return $this->redirect(['action'=>'areas']);
    }

}