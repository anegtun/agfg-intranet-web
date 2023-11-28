<?php
namespace App\Controller;

use App\Model\Clasificacion;
use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

class ClasificacionController extends AppController {
    
    public function initialize(): void {
        parent::initialize();
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->FasesEquipas = TableRegistry::get('FasesEquipas');
        $this->Fases = TableRegistry::get('Fases');
        $this->Partidos = TableRegistry::get('Partidos');
    }

    public function beforeFilter(EventInterface $event) {
        $this->Auth->allow();
    }

    public function competicion($codCompeticion, $categoria) {
        if(empty($categoria)) {
            throw new Exception("Hai que especificar categoría");
        }

        $competicion = $this->Competicions->findByCodigoOrFail($codCompeticion);
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fase'])
            ->where(['Fase.id_competicion'=>$competicion->id, 'Fase.categoria'=>$categoria])
            ->toArray();
        $equipasFases = $this->FasesEquipas
            ->find()
            ->contain(['Fases'])
            ->where(['Fases.id_competicion'=>$competicion->id]);
        $equipasPuntos = [];
        foreach($equipasFases as $fe) {
            if(empty($equipasPuntos[$fe->id_equipa])) {
                $equipasPuntos[$fe->id_equipa] = Clasificacion::init($fe->id_equipa);
            }
            if(!empty($fe->puntos)) {
                $equipasPuntos[$fe->id_equipa]->puntos_sen_sancion += $fe->puntos;
            }
        }
        $clasificacion = $this->_buildClasificacion($partidos);
        $clasificacion->addData(array_values($equipasPuntos));

        $this->set(compact('clasificacion'));
        $this->render('clasificacion');
    }

    public function fase($codCompeticion, $categoria, $codFase) {
        if(empty($categoria)) {
            throw new Exception("Hai que especificar categoría");
        }

        $competicion = $this->Competicions->findByCodigoOrFail($codCompeticion);
        $fase = $this->Fases
            ->find()
            ->where(['id_competicion'=>$competicion->id, 'categoria'=>$categoria, 'codigo'=>$codFase])
            ->first();
        $partidos = $this->Partidos
            ->find()
            ->where(['id_fase'=>$fase->id])
            ->toArray();
        
        $clasificacion = $this->_buildClasificacion($partidos);
        if(!empty($fase->id_fase_pai)) {
            $partidos = $this->Partidos->find()->where(['id_fase'=>$fase->id_fase_pai])->toArray();
            $clasificacionAcumulada = $this->_buildClasificacion($partidos);
            $clasificacion->add($clasificacionAcumulada);
            $clasificacion->desempatar();
        }
        $equipasFase = $this->FasesEquipas
            ->find()
            ->where(['id_fase'=>$fase->id]);
        
        $equipasPuntos = [];
        foreach($equipasFase as $fe) {
            if(empty($equipasPuntos[$fe->id_equipa])) {
                $equipasPuntos[$fe->id_equipa] = Clasificacion::init($fe->id_equipa);
            }
            if(!empty($fe->puntos)) {
                $equipasPuntos[$fe->id_equipa]->puntos_sen_sancion += $fe->puntos;
            }
        }
        $clasificacion->addData(array_values($equipasPuntos));
        $clasificacion->desempatar();

        $this->set(compact('clasificacion'));
        $this->render('clasificacion');
    }

    private function _buildClasificacion($partidos) {
        $equipas = $this->Equipas->findMap();
        $clsf = new Clasificacion($equipas, $partidos);
        $clsf->build();
        $clsf->desempatar();
        return $clsf;
    }
    
}
