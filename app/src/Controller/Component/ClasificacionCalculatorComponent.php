<?php
namespace App\Controller\Component;

use App\Model\Clasificacion;
use Cake\Controller\Component;
use Cake\Datasource\ModelAwareTrait;

class ClasificacionCalculatorComponent extends Component {

    use ModelAwareTrait;

    public function calcular($id_competicion, $categoria, $fase = NULL) {
        $this->loadModel('Equipas');
        $this->loadModel('FasesEquipas');
        $this->loadModel('Partidos');

        $equipas = $this->Equipas->findMap();
        $partidos = $this->Partidos->find()->contain(['Fase'])->where(['Fase.id_competicion'=>$id_competicion, 'Fase.categoria'=>$categoria])->toArray();
        $equipasFase = $this->FasesEquipas->find()->contain(['Fases'])->where(['Fases.id_competicion'=>$id_competicion])->toArray();

        $clasificacion = new Clasificacion($partidos, $equipasFase, $equipas);
        if(!empty($fase)) {
            $clasificacion->forFase($fase);
        }

        $clasificacion->build();

        return $clasificacion;
    }

}
