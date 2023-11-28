<?php
namespace App\Controller;

use App\Model\Categorias;
use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;
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
        $this->Auth->allow();
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

    public function xornadaSeguinte($codigo) {
        $competicion = $this->Competicions->findByCodigoOrFail($codigo);

        $dataReferencia = $this->_getDataMaisCercanaFutura($competicion->id);
        $luns = $dataReferencia->modify('monday this week');
        $domingo = $luns->modify('sunday this week');

        $partidos = $this->Partidos->findPartidosSemana($competicion->id, $luns, $domingo);
        $categorias = $this->Categorias->getCategoriasWithEmpty();

        $this->set(compact('partidos', 'categorias', 'luns', 'domingo'));
        $this->render('xornada');
    }

    public function xornadaAnterior($codigo) {
        $competicion = $this->Competicions->findByCodigoOrFail($codigo);

        $dataReferencia = $this->_getDataMaisCercanaPasada($competicion->id);
        $luns = $dataReferencia->modify('monday this week');
        $domingo = $luns->modify('sunday this week');

        $partidos = $this->Partidos->findPartidosSemana($competicion->id, $luns, $domingo);
        $categorias = $this->Categorias->getCategoriasWithEmpty();

        $this->set(compact('partidos', 'categorias', 'luns', 'domingo'));
        $this->render('xornada');
    }

    private function _getDataMaisCercanaFutura($id_competicion) {
        $currentMonday = new FrozenDate('monday this week');
        // Data da seguinte xornada
        $seguinteXornada = $this->Xornadas
            ->find()
            ->contain('Fase')
            ->where(['Fase.id_competicion'=>$id_competicion, 'Xornadas.data >='=>$currentMonday])
            ->order(['Xornadas.data'])
            ->first();
        $data = empty($seguinteXornada) ? null : $seguinteXornada->data;
        
        // Por se hai un partido antes da seguinte xornada
        $seguintePartido = $this->Partidos
            ->find()
            ->contain(['Xornada' => 'Fase'])
            ->where(['Fase.id_competicion'=>$id_competicion, 'Partidos.data_partido >='=>$currentMonday])
            ->order(['Partidos.data_partido'])
            ->first();
        if(!empty($seguintePartido) && (empty($data) || $data>$seguintePartido->data_partido)) {
            $data = $seguintePartido->data_partido;
        }
        return $data;
    }

    private function _getDataMaisCercanaPasada($id_competicion) {
        $currentMonday = new FrozenDate('monday this week');
        // Data da seguinte xornada
        $anteriorXornada = $this->Xornadas
            ->find()
            ->contain('Fase')
            ->where(['Fase.id_competicion'=>$id_competicion, 'Xornadas.data <='=>$currentMonday])
            ->order(['Xornadas.data DESC'])
            ->first();
        $data = empty($anteriorXornada) ? null : $anteriorXornada->data;
        
        // Por se hai un partido antes da seguinte xornada
        $anteriorPartido = null; $this->Partidos
            ->find()
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Partidos.id_fase']])
            ->where(['id_competicion'=>$id_competicion, 'data_partido <='=>$currentMonday])
            ->order(['data_partido DESC'])
            ->first();
        if(!empty($anteriorPartido) && (empty($data) || $data<$anteriorPartido->data_partido)) {
            $data = $anteriorPartido->data_partido;
        }
        return $data;
    }
    
}
