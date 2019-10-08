<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class CalendarioController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index']);

        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index($idCompeticion) {
        $competicion = $this->Competicions->get($idCompeticion);
        $fases = $this->Fases->find()->where(['id_competicion'=>$idCompeticion]);
        $equipas_map = $this->Equipas->find()->find('list', ['keyField'=>'id','valueField'=>'nome'])->toArray();

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
                        'equipa1' => $equipas_map[$p->id_equipa1],
                        'equipa2' => $equipas_map[$p->id_equipa2],
                        'goles_equipa1' => $p->goles_equipa1,
                        'goles_equipa2' => $p->goles_equipa2,
                        'tantos_equipa1' => $p->tantos_equipa1,
                        'tantos_equipa2' => $p->tantos_equipa2,
                        'total_equipa1' => $p->getPuntuacionTotalEquipa1(),
                        'total_equipa2' => $p->getPuntuacionTotalEquipa2(),
                        'ganador' => $p->getGanador(),
                        'data_partido' => $p->data_partido,
                        'campo' => ''
                    ];
                    $resX['partidos'][] = $resP;
                }
                $resF['xornadas'][] = $resX;
            }
            $res['fases'][] = $resF;
        }
        $this->set($res);
    }
    
}
