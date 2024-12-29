<?php
namespace App\Controller;

use App\Model\Categorias;
use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class CalendarioController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Arbitros = TableRegistry::get('Arbitros');
        $this->Campos = TableRegistry::get('Campos');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['competicion', 'xornadaSeguinte', 'xornadaAnterior']);
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
        $competicion = $this->Competicions->findByCodigoOrFail($codigo);
        if(empty($this->request->getQuery('data_ini'))) {
            die('Falta o parámetro "data_ini"');
        }

        $data_ini = FrozenDate::createFromFormat('Y-m-d', $this->request->getQuery('data_ini'));
        $data_fin = !empty($this->request->getQuery('data_fin'))
            ? FrozenDate::createFromFormat('Y-m-d', $this->request->getQuery('data_fin'))
            : $data_ini->modify('sunday this week');

        $partidos = $this->Partidos->findByDatas($competicion->id, $data_ini, $data_fin);
        $categorias = $this->Categorias->getCategoriasWithEmpty();

        $this->set(compact('partidos', 'categorias', 'data_ini', 'data_fin'));
        $this->render('partidos');
    }

    public function prensa() {
        $competicions = $this->Competicions->find()->order(['tempada DESC','nome ASC']);

        $data_seguinte = !empty($this->request->getQuery('data_seguinte'))
            ? FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_seguinte'))
            : FrozenTime::now();
        
        $data_anterior = !empty($this->request->getQuery('data_anterior'))
            ? FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_anterior'))
            : $data_seguinte->modify('-1 week');

        $id_competicion = $this->request->getQuery('id_competicion');
        if(!empty($id_competicion)) {
            $partidos_anterior = $this->Partidos->findByDatas($id_competicion, $data_anterior, $data_anterior->modify('sunday this week'));
            $partidos_seguinte = $this->Partidos->findByDatas($id_competicion, $data_seguinte, $data_seguinte->modify('sunday this week'));
        }

        $categorias = $this->Categorias->getCategoriasFiltered(['M','F']);
        $this->set(compact('competicions', 'categorias', 'data_seguinte', 'data_anterior', 'partidos_anterior', 'partidos_seguinte'));
    }
}
