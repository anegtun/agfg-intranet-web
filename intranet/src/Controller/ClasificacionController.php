<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Clasificacion;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ClasificacionController extends AppController {
    
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

    public function index($uuid) {
        $competicion = $this->Competicions->find()->where(['Competicions.uuid'=>$uuid])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        
        $equipas = $this->Equipas->findMap();

        $partidos = $this->Partidos
            ->find()
            ->join(['table'=>'agfg_xornada', 'alias'=>'Xornadas', 'conditions'=>['Xornadas.id = Partidos.id_xornada']])
            ->join(['table'=>'agfg_fase', 'alias'=>'Fases', 'conditions'=>['Fases.id = Xornadas.id_fase']])
            ->where(['Fases.id_competicion'=>$competicion->id]);
        
        $clsf = new Clasificacion($equipas, $partidos);
        $clsf->build();
        $clsf->desempatar();
        $this->set($clsf->getClasificacion());
    }
    
}
