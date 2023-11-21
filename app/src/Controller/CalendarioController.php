<?php
namespace App\Controller;

use App\Controller\RestController;
use App\Model\Categorias;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

class CalendarioController extends RestController {
    
    public function initialize() {
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

        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $arbitros = $this->Arbitros->findMap();

        $res = [
            'competicion' => [
                'nome' => $competicion->nome,
                'tipo' => $competicion->tipo
            ],
            'xornadas' => []
        ];
        foreach($competicion->fases as $f) {
            foreach($f->xornadas as $x) {
                $resX = [
                    'data' => $x->data,
                    'numero' => $x->numero,
                    'descricion' => $x->descricion,
                    'partidos' => []
                ];
                $index = -1;
                foreach($res['xornadas'] as $i=>$xJson) {
                    if($xJson['data']==$x->data) {
                        $resX = $xJson;
                        $index = $i;
                        break;
                    }
                }
                foreach($x->partidos as $p) {
                    $resX['partidos'][] = $this->_buildPartidoData($p, $f, $x, $equipas, $campos, $arbitros);
                }
                if($index>=0) {
                    $res['xornadas'][$index] = $resX;
                } else {
                    $res['xornadas'][] = $resX;
                }
            }
        }
        $this->set($res);
    }

    public function xornadaSeguinte($codigo) {
        $competicion = $this->Competicions->find()->where(['Competicions.codigo'=>$codigo])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        $dataReferencia = $this->_getDataMaisCercanaFutura($competicion);
        $this->set($this->_getJsonPartidosSemana($competicion, $dataReferencia));
    }

    public function xornadaAnterior($codigo) {
        $competicion = $this->Competicions->find()->where(['Competicions.codigo'=>$codigo])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        $dataReferencia = $this->_getDataMaisCercanaPasada($competicion);
        $this->set($this->_getJsonPartidosSemana($competicion, $dataReferencia));
    }

    private function _getJsonPartidosSemana($competicion, $dataReferencia) {
        if(empty($dataReferencia)) {
            return ['partidos' => []];
        }
        $luns = $dataReferencia->modify('monday this week');
        $domingo = $luns->modify('sunday this week');
        $lunsYMD = $luns->i18nFormat('yyyy-MM-dd');
        $domingoYMD = $domingo->i18nFormat('yyyy-MM-dd');
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fases', 'Xornada', 'Equipa1', 'Equipa2', 'Campo', 'Arbitro', 'Umpire'])
            ->where(['Fases.id_competicion'=>$competicion->id, 'OR' => [
                ['Xornada.data >='=>$lunsYMD, 'Xornada.data <='=>$domingoYMD],
                ['Partidos.data_partido >='=>$lunsYMD, 'Partidos.data_partido <='=>$domingoYMD]
            ]])
            ->order(['-Partidos.data_partido DESC', 'Partidos.hora_partido']);
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $arbitros = $this->Arbitros->findMap();
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $res = [
            'inicio' => $luns,
            'fin' => $domingo,
            'partidos' => []
        ];
        foreach($partidos as $p) {
            $resP = $this->_buildPartidoData($p, null, null, $equipas, $campos, $arbitros);
            $resP['fase'] = [
                'categoria' => $categorias[$p->fase->categoria],
                'nome' => $p->fase->nome
            ];
            $resP['xornada'] = [
                'data' => $p->xornada->data,
                'numero' => $p->xornada->numero
            ];
            $res['partidos'][] = $resP;
        }
        return $res;
    }

    private function _getDataMaisCercanaFutura($competicion) {
        $currentMonday = new FrozenDate('monday this week');
        // Data da seguinte xornada
        $seguinteXornada = $this->Xornadas
            ->find()
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Xornadas.id_fase']])
            ->where(['id_competicion'=>$competicion->id, 'data >='=>$currentMonday])
            ->order(['data'])
            ->first();
        $data = empty($seguinteXornada) ? null : $seguinteXornada->data;
        
        // Por se hai un partido antes da seguinte xornada
        $seguintePartido = $this->Partidos
            ->find()
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Partidos.id_fase']])
            ->where(['id_competicion'=>$competicion->id, 'data_partido >='=>$currentMonday])
            ->order(['data_partido'])
            ->first();
        if(!empty($seguintePartido) && (empty($data) || $data>$seguintePartido->data_partido)) {
            $data = $seguintePartido->data_partido;
        }
        return $data;
    }

    private function _getDataMaisCercanaPasada($competicion) {
        $currentMonday = new FrozenDate('monday this week');
        // Data da seguinte xornada
        $anteriorXornada = $this->Xornadas
            ->find()
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Xornadas.id_fase']])
            ->where(['id_competicion'=>$competicion->id, 'data <='=>$currentMonday])
            ->order(['data DESC'])
            ->first();
        $data = empty($anteriorXornada) ? null : $anteriorXornada->data;
        
        // Por se hai un partido antes da seguinte xornada
        $anteriorPartido = $this->Partidos
            ->find()
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Partidos.id_fase']])
            ->where(['id_competicion'=>$competicion->id, 'data_partido <='=>$currentMonday])
            ->order(['data_partido DESC'])
            ->first();
        if(!empty($anteriorPartido) && (empty($data) || $data<$anteriorPartido->data_partido)) {
            $data = $anteriorPartido->data_partido;
        }
        return $data;
    }

    private function _buildPartidoData($p, $f, $x, $equipas, $campos, $arbitros) {
        $resP = [
            'data_partido' => $p->getDataHora(),
            'adiado' => $p->adiado,
            'cancelado' => $p->cancelado,
            'ganador' => $p->getGanador()
        ];
        if(!empty($p->data_calendario)) {
            $resP['data_calendario'] = $p->data_calendario;
        }
        if(!empty($p->equipa1) || !empty($p->provisional_equipa1)) {
            $resP['equipa1'] = [
                'codigo' => empty($p->equipa1) ? '' : $p->equipa1->codigo,
                'nome' => empty($p->equipa1) ? $p->provisional_equipa1 : $p->equipa1->nome,
                'nome_curto' => empty($p->equipa1) ? $p->provisional_equipa1 : $p->equipa1->nome_curto,
                'logo' => empty($p->equipa1) ? '' : $p->equipa1->getLogo(),
                'goles' => $p->goles_equipa1,
                'tantos' => $p->tantos_equipa1,
                'total' => $p->getPuntuacionTotalEquipa1(),
                'non_presentado' => $p->non_presentado_equipa1
            ];
        }
        if(!empty($p->equipa2) || !empty($p->provisional_equipa2)) {
            $resP['equipa2'] = [
                'codigo' => empty($p->equipa2) ? '' : $p->equipa2->codigo,
                'nome' => empty($p->equipa2) ? $p->provisional_equipa2 : $p->equipa2->nome,
                'nome_curto' => empty($p->equipa2) ? $p->provisional_equipa2 : $p->equipa2->nome_curto,
                'logo' => empty($p->equipa2) ? '' : $p->equipa2->getLogo(),
                'goles' => $p->goles_equipa2,
                'tantos' => $p->tantos_equipa2,
                'total' => $p->getPuntuacionTotalEquipa2(),
                'non_presentado' => $p->non_presentado_equipa2
            ];
        }
        if(!empty($f) || !empty($x)) {
            $resP['fase'] = [
                'fase' => empty($f->nome) ? null : $f->nome,
                'subfase' => empty($x->descricion) ? null : $x->descricion
            ];
        }
        if(!empty($p->campo)) {
            $resP['campo'] = [
                'nome' => $p->campo->nome,
                'nome_curto' => $p->campo->nome_curto,
                'pobo' => $p->campo->pobo
            ];
        }
        if(!empty($p->arbitro)) {
            $resP['arbitro'] = [
                'alcume' => $p->arbitro->alcume,
                'nome' => $p->arbitro->nome_publico
            ];
        }
        if(!empty($p->umpire)) {
            $resP['umpires'] = [
                'categoria' => $p->umpire->categoria,
                'codigo' => $p->umpire->codigo,
                'nome' => $p->umpire->nome,
                'nome_curto' => $p->umpire->nome_curto,
                'logo' => $p->umpire->getLogo()
            ];
        }
        return $resP;
    }
    
}
