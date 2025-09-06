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

        $fases_conditions = ['Fases.id_competicion'=>$id_competicion];
        if(!empty($fase)) {
            $fases_conditions['Fases.id'] = $fase->id;
        }

        $partidos = $this->Partidos->find()->contain(['Fase'])->where(['Fase.id_competicion'=>$id_competicion, 'Fase.categoria'=>$categoria])->toArray();
        $equipasFase = $this->FasesEquipas->find()->contain(['Fases'])->where($fases_conditions)->toArray();

        $clasificacion = new Clasificacion($partidos, $equipasFase, $equipas);
        if(!empty($fase)) {
            $clasificacion->forFase($fase);
        }

        $clasificacion->build();

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

}
