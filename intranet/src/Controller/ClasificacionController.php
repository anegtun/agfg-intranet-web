<?php
namespace App\Controller;

use App\Controller\RestController;
use App\Model\Clasificacion;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ClasificacionController extends RestController {
    
    public function initialize() {
        parent::initialize();
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->Fases = TableRegistry::get('Fases');
        $this->Partidos = TableRegistry::get('Partidos');
    }

    public function competicion($codCompeticion, $categoria) {
        $competicion = $this->_getCompeticion($codCompeticion, $categoria);
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fases'])
            ->where(['Fases.id_competicion'=>$competicion->id, 'Fases.categoria'=>$categoria]);
        $this->set($this->_buildClasificacion($partidos)->getClasificacion());
    }

    public function fase($codCompeticion, $categoria, $codFase) {
        $competicion = $this->_getCompeticion($codCompeticion, $categoria);
        $fase = $this->Fases->find()->where(['id_competicion'=>$competicion->id, 'categoria'=>$categoria, 'codigo'=>$codFase])->first();
        $partidos = $this->Partidos->find()->where(['id_fase'=>$fase->id]);
        $clasificacion = $this->_buildClasificacion($partidos);
        if(!empty($fase->id_fase_pai)) {
            $partidos = $this->Partidos->find()->where(['id_fase'=>$fase->id_fase_pai]);
            $clasificacionAcumulada = $this->_buildClasificacion($partidos);
            $clasificacion->add($clasificacionAcumulada);
            $clasificacion->desempatar();
        }
        $this->set($clasificacion->getClasificacion());
    }

    private function _getCompeticion($codCompeticion, $categoria) {
        $competicion = $this->Competicions->find()->where(['Competicions.codigo'=>$codCompeticion])->first();
        if(empty($competicion)) {
            throw new Exception("Non existe competición");
        }
        if(empty($categoria)) {
            throw new Exception("Hai que especificar categoría");
        }
        return $competicion;
    }

    private function _buildClasificacion($partidos) {
        $equipas = $this->Equipas->findMap();
        $clsf = new Clasificacion($equipas, $partidos);
        $clsf->build();
        $clsf->desempatar();
        return $clsf;
    }
    
}
