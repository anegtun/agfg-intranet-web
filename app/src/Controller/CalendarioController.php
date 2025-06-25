<?php
namespace App\Controller;

use App\Model\Categorias;
use App\Model\EventosTipo;
use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class CalendarioController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->EventosTipo = new EventosTipo();
        $this->Arbitros = TableRegistry::get('Arbitros');
        $this->Campos = TableRegistry::get('Campos');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Eventos = TableRegistry::get('Eventos');
        $this->EventosDatas = TableRegistry::get('EventosDatas');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);

        $unauth = ['competicion'];
        $extension = $event->getSubject()->getRequest()->getParam("_ext");
        if($extension === 'json') {
            $unauth[] = 'eventos';
        }
        $this->Authentication->allowUnauthenticated($unauth);
    }

    public function eventos() {
        $iniParam = $this->request->getQuery('ini');
        $limitParam = $this->request->getQuery('limit');
        $eventos = $this->Eventos->find()->contain('Datas')->order('data DESC');
        $tipos = $this->EventosTipo->getAll();
        $partidos = $this->Partidos->findByDatas(FrozenDate::createFromFormat('Y-m-d', '2010-01-01'), FrozenDate::createFromFormat('Y-m-d', '2025-12-31'));
        $this->set(compact('eventos', 'tipos', 'partidos', 'iniParam', 'limitParam'));
    }

    public function evento($id=null) {
        $evento = $this->Eventos->getOrNew($id, ['contain' => ['Datas'=>['sort'=>'data_ini']]]);
        $tipos = $this->EventosTipo->getAllWithEmpty();
        $this->set(compact('evento', 'tipos'));
    }

    public function clonarEvento($id) {
        $evento = $this->Eventos->get($id);
        $evento->id = NULL;
        $tipos = $this->EventosTipo->getAllWithEmpty();
        $this->set(compact('evento', 'tipos'));
        $this->render('evento');
    }

    public function gardarEvento() {
        $data = $this->request->getData();
        $evento = $this->Eventos->getOrNew($data['id']);
        $evento = $this->Eventos->patchEntity($evento, $data);
        $evento->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
        if ($this->Eventos->save($evento)) {
            $this->Flash->success(__('Gardouse o evento correctamente.'));
            return $this->redirect(['action'=>'eventos']);
        }
        $this->Flash->error(__('Erro ao gardar o evento.'));
        $this->set(compact('evento'));
        $this->render('evento');
    }

    public function borrarEvento($id) {
        $evento = $this->Eventos->get($id);
        if($this->Eventos->delete($evento)) {
            $this->Flash->success(__('Eliminouse o evento correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o evento.'));
        }
        return $this->redirect(['action'=>'eventos']);
    }

    public function engadirEventoData() {
        $data = $this->request->getData();
        $evento_data = $this->EventosDatas->newEntity([
            'id_evento' => $data['id'],
            'data_ini' => Time::createFromFormat('d-m-Y', $data['data_ini']),
            'data_fin' => Time::createFromFormat('d-m-Y', $data['data_fin'])
        ]);

        if ($this->EventosDatas->save($evento_data)) {
            $this->Flash->success(__('Gardouse o evento correctamente.'));
            return $this->redirect(['action'=>'evento', $data['id']]);
        }
        $this->Flash->error(__('Erro ao gardar o evento.'));
        return $this->redirect(['action'=>'evento', $data['id']]);
    }

    public function borrarEventoData($id) {
        $evento_data = $this->EventosDatas->get($id);
        if($this->EventosDatas->delete($evento_data)) {
            $this->Flash->success(__('Eliminouse a data correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a data.'));
        }
        return $this->redirect(['action'=>'evento', $evento_data->id_evento]);
    }

    public function competicion($codigo) {
        $categoriaParam = $this->request->getQuery('categoria');
        $faseParam = $this->request->getQuery('fase');
        $fasesParam = $this->request->getQuery('fases');
        $campoParam = $this->request->getQuery('campo');
        $competicionQuery = $this->Competicions
            ->find()
            ->contain([
                'Fases' => [
                    'queryBuilder' => function ($q) use ($categoriaParam, $faseParam, $fasesParam) {
                        if(!empty($categoriaParam)) {
                            $q = $q->where(['Fases.categoria' => $categoriaParam]);
                        }
                        if(!empty($faseParam)) {
                            $q = $q->where(['Fases.codigo' => $faseParam]);
                        }
                        if(!empty($fasesParam)) {
                            $q = $q->where(['Fases.codigo IN' => explode(",", $fasesParam)]);
                        }
                        return $q;
                    },      
                    'Xornadas' => [
                        'sort' => ['Xornadas.data ASC', 'Xornadas.numero ASC'],
                        'Partidos' => [
                            'queryBuilder' => function ($q) use ($campoParam) {
                                $q = $q->order(['Partidos.data_partido', 'Partidos.hora_partido']);
                                if(!empty($campoParam)) {
                                    $q = $q->where(['Fases.Xornadas.Partidos.Campo.codigo' => $campoParam]);
                                }
                                return $q;
                            },
                            'Equipa1' => 'Clube',
                            'Equipa2' => 'Clube',
                            'Campo',
                            'Arbitro',
                            'Umpire' => 'Clube'
                        ]
                    ]
                ]
            ])
            ->where(['Competicions.codigo'=>$codigo]);

        $competicion = $competicionQuery->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }

        $this->set('competicion', $competicion);
    }

    public function partidos($codigo) {
        if(empty($this->request->getQuery('data_ini'))) {
            die('Falta o parámetro "data_ini"');
        }

        $data_ini = FrozenDate::createFromFormat('Y-m-d', $this->request->getQuery('data_ini'));
        $data_fin = !empty($this->request->getQuery('data_fin'))
            ? FrozenDate::createFromFormat('Y-m-d', $this->request->getQuery('data_fin'))
            : $data_ini->modify('sunday this week');

        $partidos = $this->Partidos->findByDatas($data_ini, $data_fin);
        $categorias = $this->Categorias->getCategoriasWithEmpty();

        $this->set(compact('partidos', 'categorias', 'data_ini', 'data_fin'));
        $this->render('partidos');
    }

    public function prensa() {
        $data_seguinte = !empty($this->request->getQuery('data_seguinte'))
            ? FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_seguinte'))
            : FrozenTime::now();
        
        $data_anterior = !empty($this->request->getQuery('data_anterior'))
            ? FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_anterior'))
            : $data_seguinte->modify('-1 week');

        $partidos_anterior = $this->Partidos->findByDatas($data_anterior, $data_anterior->modify('sunday this week'));
        $partidos_seguinte = $this->Partidos->findByDatas($data_seguinte, $data_seguinte->modify('sunday this week'));

        $categorias = $this->Categorias->getCategoriasFiltered(['M','F']);
        $this->set(compact('categorias', 'data_anterior', 'data_seguinte', 'partidos_anterior', 'partidos_seguinte'));
    }
}
