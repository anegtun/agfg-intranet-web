<?php
namespace App\Controller\Component;

use App\Model\Clasificacion;
use Cake\Controller\Component;
use Cake\Datasource\ModelAwareTrait;

class ClasificacionCalculatorComponent extends Component {

    use ModelAwareTrait;

    public function fase($id_competicion, $categoria, $fase = NULL) {

        $this->loadModel('Equipas');
        $this->loadModel('FasesEquipas');
        $this->loadModel('Partidos');

        $equipas = $this->Equipas->findMap();

        $partidos_conditions = ['Fase.id_competicion'=>$id_competicion, 'Fase.categoria'=>$categoria];
        $fases_conditions = ['Fases.id_competicion'=>$id_competicion];
        if(!empty($fase)) {
            $partidos_conditions['Fase.id'] = $fase->id;
            $fases_conditions['Fases.id'] = $fase->id;
        }

        $partidos = $this->Partidos->find()->contain(['Fase'])->where($partidos_conditions)->toArray();
        $equipasFase = $this->FasesEquipas->find()->contain(['Fases'])->where($fases_conditions);

        $clasificacion = $this->_buildClasificacion($equipas, $partidos);

        if(!empty($fase) && !empty($fase->id_fase_pai)) {
            $partidos_pai = $this->Partidos->find()->where(['id_fase'=>$fase->id_fase_pai])->toArray();
            $clasificacionAcumulada = $this->_buildClasificacion($equipas, $partidos_pai);
            $clasificacion->add($clasificacionAcumulada);
            $clasificacion->desempatar();
        }

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

        return $clasificacion;
    }

    private function _buildClasificacion($equipas, $partidos) {
        $clsf = new Clasificacion($equipas, $partidos);
        $clsf->build();
        $clsf->desempatar();
        return $clsf;
    }

}
