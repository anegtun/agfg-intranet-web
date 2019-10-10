<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class CalendarioController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index']);

        $this->Campos = TableRegistry::get('Campos');
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index($uuid) {
        $competicion = $this->Competicions->find()->where(['Competicions.uuid'=>$uuid])->first();
        if(empty($competicion)) {
            throw new Exception("No existe competición");
        }
        $fases = $this->Fases->find()->where(['id_competicion'=>$competicion->id]);
        $campos = $this->Campos->findMap();
        $equipas = $this->Equipas->findMap();

        $res = [
            'competicion' => ['nome' => $competicion->nome],
            'fases' => []
        ];
        foreach($fases as $f) {
            $xornadas = $this->Xornadas->find()->where(['id_fase'=>$f->id])->order(['numero ASC']);
            $resF = ['nome' => $f->nome, 'xornadas' => []];
            foreach($xornadas as $x) {
                $resX = [
                    'numero' => $x->numero,
                    'data' => $x->data,
                    'partidos' => []
                ];
                $partidos = $this->Partidos->find()->where(['id_xornada'=>$x->id]);
                foreach($partidos as $p) {
                    $resP = [
                        'equipa1' => $equipas[$p->id_equipa1]->nome,
                        'equipa2' => $equipas[$p->id_equipa2]->nome,
                        'logo_equipa1' => $equipas[$p->id_equipa1]->logo,
                        'logo_equipa2' => $equipas[$p->id_equipa2]->logo,
                        'goles_equipa1' => $p->goles_equipa1,
                        'goles_equipa2' => $p->goles_equipa2,
                        'tantos_equipa1' => $p->tantos_equipa1,
                        'tantos_equipa2' => $p->tantos_equipa2,
                        'total_equipa1' => $p->getPuntuacionTotalEquipa1(),
                        'total_equipa2' => $p->getPuntuacionTotalEquipa2(),
                        'ganador' => $p->getGanador(),
                        'data_partido' => $p->getDataHora(),
                        'campo' => []
                    ];
                    if(!empty($p->id_campo)) {
                        $resP['campo'] = [
                            'nome' => $campos[$p->id_campo]->nome,
                            'pobo' => $campos[$p->id_campo]->pobo
                        ];
                    }
                    $resX['partidos'][] = $resP;
                }
                $resF['xornadas'][] = $resX;
            }
            $res['fases'][] = $resF;
        }
        $this->set($res);
    }
    
}
