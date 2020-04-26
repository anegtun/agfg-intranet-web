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
        $this->Campos = TableRegistry::get('Campos');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function competicion($codigo) {
        $competicion = $this->Competicions->find()->where(['Competicions.codigo'=>$codigo])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        // Obtemos fases
        $fases = $this->_getFases($competicion);
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();

        $res = [
            'competicion' => ['nome' => $competicion->nome],
            'xornadas' => []
        ];
        foreach($fases as $f) {
            $xornadasFase = $this->Xornadas->find()->where(['id_fase'=>$f->id])->order(['data ASC']);
            foreach($xornadasFase as $x) {
                $resX = [
                    'data' => $x->data,
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
                $partidos = $this->Partidos->find()->where(['id_xornada'=>$x->id]);
                foreach($partidos as $p) {
                    $resX['partidos'][] = $this->_buildPartidoData($p, $equipas, $campos);
                }
                if($index>0) {
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

    public function seguintesPartidosClube($codigo) {
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $xornadaActual = FrozenDate::now()->modify('monday this week');
        $partidos = $this->Partidos
            ->find()
            ->contain(['Xornadas', 'Equipas1', 'Equipas2'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornadas.data)'])
            ->select(['codigo_clube1' => '(SELECT c1.codigo FROM agfg_clubes c1 WHERE c1.id = Equipas1.id_clube)'])
            ->select(['codigo_clube2' => '(SELECT c2.codigo FROM agfg_clubes c2 WHERE c2.id = Equipas2.id_clube)'])
            ->enableAutoFields(true)
            ->where(['OR' => [
                'Partidos.data_partido >=' => $xornadaActual,
                'Xornadas.data >=' => $xornadaActual
            ]])
            ->having(['OR' => [
                'codigo_clube1' => $codigo,
                'codigo_clube2' => $codigo
            ]])
            ->order(['data_calendario']);
        $res = [];
        foreach($partidos as $p) {
            $res[] = $this->_buildPartidoData($p, $equipas, $campos);
        }
        $this->set($res);
    }

    public function ultimosPartidosClube($codigo) {
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $xornadaActual = FrozenDate::now()->modify('monday this week');
        $partidos = $this->Partidos
            ->find()
            ->limit(10)
            ->contain(['Xornadas', 'Equipas1', 'Equipas2'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornadas.data)'])
            ->select(['codigo_clube1' => '(SELECT c1.codigo FROM agfg_clubes c1 WHERE c1.id = Equipas1.id_clube)'])
            ->select(['codigo_clube2' => '(SELECT c2.codigo FROM agfg_clubes c2 WHERE c2.id = Equipas2.id_clube)'])
            ->enableAutoFields(true)
            ->where(['Partidos.data_partido <' => $xornadaActual])
            ->having(['OR' => [
                'codigo_clube1' => $codigo,
                'codigo_clube2' => $codigo
            ]])
            ->order(['data_calendario' => 'DESC']);
        $res = [];
        foreach($partidos as $p) {
            $res[] = $this->_buildPartidoData($p, $equipas, $campos);
        }
        $this->set($res);
    }

    private function _getFases($competicion) {
        $conditions = ['id_competicion'=>$competicion->id];
        $categoria = $this->request->getQuery('categoria');
        if(!empty($categoria)) {
            $conditions['categoria'] = $categoria;
        }
        return $this->Fases->find()->where($conditions);
    }

    private function _getJsonPartidosSemana($competicion, $dataReferencia) {
        $luns = $dataReferencia->modify('monday this week');
        $domingo = $luns->modify('sunday this week');
        $lunsYMD = $luns->i18nFormat('yyyy-MM-dd');
        $domingoYMD = $domingo->i18nFormat('yyyy-MM-dd');
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fases', 'Xornadas'])
            ->where(['Fases.id_competicion'=>$competicion->id, 'OR' => [
                ['Xornadas.data >='=>$lunsYMD, 'Xornadas.data <='=>$domingoYMD],
                ['Partidos.data_partido >='=>$lunsYMD, 'Partidos.data_partido <='=>$domingoYMD]
            ]])
            ->order(['-Partidos.data_partido DESC', 'Partidos.hora_partido']);
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $res = [
            'inicio' => $luns,
            'fin' => $domingo,
            'partidos' => []
        ];
        foreach($partidos as $p) {
            $resP = $this->_buildPartidoData($p, $equipas, $campos);
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

    private function _buildPartidoData($p, $equipas, $campos) {
        $resP = [
            'data_partido' => $p->getDataHora(),
            'adiado' => $p->adiado,
            'cancelado' => $p->cancelado,
            'equipa1' => [],
            'equipa2' => [],
            'ganador' => $p->getGanador(),
            'campo' => []
        ];
        if(!empty($p->data_calendario)) {
            $resP['data_calendario'] = $p->data_calendario;
        }
        if(!empty($p->id_equipa1)) {
            $resP['equipa1'] = [
                'codigo' => $equipas[$p->id_equipa1]->codigo,
                'nome' => $equipas[$p->id_equipa1]->nome,
                'logo' => $equipas[$p->id_equipa1]->logo,
                'goles' => $p->goles_equipa1,
                'tantos' => $p->tantos_equipa1,
                'total' => $p->getPuntuacionTotalEquipa1(),
                'non_presentado' => $p->non_presentado_equipa1
            ];
        }
        if(!empty($p->id_equipa2)) {
            $resP['equipa2'] = [
                'codigo' => $equipas[$p->id_equipa2]->codigo,
                'nome' => $equipas[$p->id_equipa2]->nome,
                'logo' => $equipas[$p->id_equipa2]->logo,
                'goles' => $p->goles_equipa2,
                'tantos' => $p->tantos_equipa2,
                'total' => $p->getPuntuacionTotalEquipa2(),
                'non_presentado' => $p->non_presentado_equipa2
            ];
        }
        if(!empty($p->id_campo)) {
            $resP['campo'] = [
                'nome' => $campos[$p->id_campo]->nome,
                'nome_curto' => $campos[$p->id_campo]->nome_curto,
                'pobo' => $campos[$p->id_campo]->pobo
            ];
        }
        return $resP;
    }
    
}
