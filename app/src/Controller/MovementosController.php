<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Contas;
use App\Model\Tempadas;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class MovementosController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Tempadas = new Tempadas();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->Subareas = TableRegistry::get('MovementosSubarea');
    }

    public function index() {
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $movementos = $this->movementosFiltrados();
        $this->set(compact('movementos', 'contas', 'subareas', 'tempadas'));
    }

    public function resumo() {
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $movementos = $this->movementosFiltrados();

        $resumo = [];
        foreach($movementos as $m) {
            $item = (object) [
                'subarea' => $m->subarea,
                'tempada' => $m->tempada,
                'ingresos' => $m->importe>0 ? $m->importe : 0,
                'gastos' => $m->importe<0 ? $m->importe : 0,
                'comision' => $m->comision,
                'balance' => $m->importe + $m->comision
            ];
            $existent = $this->findResumo($resumo, $item);
            if($existent) {
                $existent->ingresos += $item->ingresos;
                $existent->gastos += $item->gastos;
                $existent->comision += $item->comision;
                $existent->balance += $item->balance;
            } else {
                $resumo[] = $item;
            }
        }
        usort($resumo, ["self", "cmpResumo"]);

        $this->set(compact('movementos', 'resumo', 'tempadas'));
    }

    public function resumoClubes() {
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $movementos = $this->movementosFiltrados();

        $resumo = [];
        $ids_subareas = [];
        foreach($movementos as $m) {
            if(!empty($m->clube)) {
                if(empty($resumo[$m->clube->id])) {
                    $resumo[$m->clube->id] = [];
                }
                if(empty($resumo[$m->clube->id][$m->subarea->id])) {
                    $resumo[$m->clube->id][$m->subarea->id] = 0;
                }
                $resumo[$m->clube->id][$m->subarea->id] += $m->importe;
                $ids_subareas[] = $m->subarea->id;
            }
        }

        $subareas = $this->Subareas->find('all', ['order'=>'nome'])->where(['id IN' => $ids_subareas]);
        $clubes = $this->Clubes->find('all', ['order'=>'nome'])->where(['id IN' => array_keys($resumo)]);

        $this->set(compact('movementos', 'resumo', 'clubes', 'subareas', 'tempadas'));
    }

    private function findResumo($list, $item) {
        foreach($list as $e) {
            if($e->subarea->id===$item->subarea->id && $e->tempada===$item->tempada) {
                return $e;
            }
        }
        return null;
    }

    public function detalle($id=null) {
        $movemento = empty($id) ? $this->Movementos->newEntity() : $this->Movementos->get($id);
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $clubes = $this->Clubes->find('all', ['order'=>'nome']);
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas'));
    }

    public function clonar($id) {
        $movemento = $this->Movementos->get($id);
        $movemento->id = NULL;
        // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
        $movemento->data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $clubes = $this->Clubes->find('all', ['order'=>'nome']);
        $subareas = $this->Subareas->find('all', ['order'=>'Area.nome'])->contain(['Area']);
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas'));
        $this->render('detalle');
    }

    public function gardar() {
        $movemento = $this->Movementos->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            $movemento = $this->Movementos->patchEntity($movemento, $data);
            if(empty($data['id_clube'])) {
                $movemento->id_clube = NULL;
            }
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

    public function borrar($id) {
        $movemento = $this->Movementos->get($id);
        if($this->Movementos->delete($movemento)) {
            $this->Flash->success(__('Eliminouse o movemento correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o movemento.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    private function movementosFiltrados() {
        $movementos = $this->Movementos
            ->find('all', ['order'=>['data desc', 'Movementos.id desc']])
            ->contain(['Subarea' => ['Area'], 'Clube']);
        if(!empty($this->request->getQuery('data_ini'))) {
            $movementos->where(['data >=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_ini'))]);
        }
        if(!empty($this->request->getQuery('data_fin'))) {
            $movementos->where(['data <=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_fin'))]);
        }
        if(!empty($this->request->getQuery('conta'))) {
            $movementos->where(['conta' => $this->request->getQuery('conta')]);
        }
        if(!empty($this->request->getQuery('tempada'))) {
            $movementos->where(['tempada' => $this->request->getQuery('tempada')]);
        }
        if(!empty($this->request->getQuery('id_subarea'))) {
            $movementos->where(['id_subarea' => $this->request->getQuery('id_subarea')]);
        }
        return $movementos;
    }

    private static function cmpResumo($a, $b) {
        $cmp = strcmp($a->subarea->area->nome, $b->subarea->area->nome);
        if($cmp===0) {
            $cmp = strcmp($a->subarea->nome, $b->subarea->nome);
        }
        if($cmp===0) {
            $cmp = strcmp($b->tempada, $a->tempada);
        }
        return $cmp;
    }

}
