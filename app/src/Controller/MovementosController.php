<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use App\Model\Tempadas;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class MovementosController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Tempadas = new Tempadas();
        $this->Subareas = TableRegistry::get('MovementosSubarea');
    }

    public function index() {
        $contas = $this->Contas->getAll();
        $tempadas = $this->Tempadas->getTempadas();
        $movementos = $this->Movementos
            ->find('all', ['order'=>'data'])
            ->contain(['Subarea' => ['Area']]);
        $this->set(compact('movementos', 'contas', 'tempadas'));
    }

    public function detalle($id=null) {
        if(empty($id)) {
            $movemento = $this->Movementos->newEntity();
        } else {
            $movemento = $this->Movementos->get($id /*, ['contain' => ['Fases' => ['sort'=>['Fases.categoria']], 'Fases.FasePai']]*/);
        }
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $this->set(compact('movemento', 'contas', 'tempadas', 'subareas'));
    }

    public function gardar() {
        $movemento = $this->Movementos->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $movemento = $this->Movementos->patchEntity($movemento, $data);
            $movemento->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
            if ($this->Movementos->save($movemento)) {
                $this->Flash->success(__('Gardáronse os datos do movemento correctamente.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('Erro ao gardar os datos do movemento.'));
        }
        $this->set(compact('movemento'));
        $this->render('detalle');
    }

}
