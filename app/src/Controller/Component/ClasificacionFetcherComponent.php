<?php
namespace App\Controller\Component;

use App\Model\Clasificacion;
use Cake\Controller\Component;
use Cake\Datasource\ModelAwareTrait;

class ClasificacionFetcherComponent extends Component {

    use ModelAwareTrait;

    public function get($competicion, $categoria) {
        $this->loadModel('Competicions');
        $this->loadModel('Equipas');
        $this->loadModel('FasesEquipas');
        $this->loadModel('Partidos');

        $equipas = $this->Equipas->findMap();
        
        $partidos = $this->Partidos
            ->find()
            ->contain(['Fase'])
            ->where(['Fase.id_competicion'=>$competicion->id, 'Fase.categoria'=>$categoria])
            ->toArray();
        
        $equipasFaseQuery = $this->FasesEquipas
            ->find()
            ->contain(['Fases']);

        if ($competicion->isTorneoOuEliminatoria()) {
            $equipasFaseQuery->where([
                'Fases.id_competicion' => $competicion->id,
                'Fases.categoria' => $categoria
            ]);
        } else {
            $ids_fases = [];
            foreach($partidos as $p) {
                $ids_fases[] = $p->id_fase;
            }
            $equipasFaseQuery->where(['Fases.id IN' => array_unique($ids_fases)]);
        }

        $equipasFase = $equipasFaseQuery->toArray();

        return Clasificacion::create($competicion, $partidos, $equipasFase, $equipas);
    }

}
