<?php
namespace App\Controller;

use App\Controller\RestController;
use App\Model\Categorias;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class CalendarioController extends RestController {
    
    public function initialize() {
        parent::initialize();
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
        $fases = $this->getFases($competicion);
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
                    $resP = [
                        'data_partido' => $p->getDataHora(),
                        'adiado' => $p->adiado,
                        'equipa1' => [],
                        'equipa2' => [],
                        'ganador' => $p->getGanador(),
                        'campo' => []
                    ];
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
                            'pobo' => $campos[$p->id_campo]->pobo
                        ];
                    }
                    $resX['partidos'][] = $resP;
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

    private function getFases($competicion) {
        $conditions = ['id_competicion'=>$competicion->id];
        $categoria = $this->request->getQuery('categoria');
        if(!empty($categoria)) {
            $conditions['categoria'] = $categoria;
        }
        return $this->Fases->find()->where($conditions);
    }
    
}
