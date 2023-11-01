<?php
namespace App\Controller\Component;

use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class MovementosEconomicosComponent extends Component {

    public function startup(Event $event) {
        $this->Movementos = TableRegistry::get('Movementos');
    }

    public function find($request, $prevision = false) {
        $sort = $prevision ? 'asc' : 'desc';
        $movementos = $this->Movementos
            ->find()
            ->contain(['Subarea' => ['Area' => ['PartidaOrzamentaria']], 'Clube'])
            ->where(['prevision' => $prevision])
            ->order(["data $sort", "Movementos.id $sort"]);

        if(!empty($request->getQuery('data_ini'))) {
            $movementos->where(['data >=' => FrozenDate::createFromFormat('d-m-Y', $request->getQuery('data_ini'))]);
        }
        if(!empty($request->getQuery('data_fin'))) {
            $movementos->where(['data <=' => FrozenDate::createFromFormat('d-m-Y', $request->getQuery('data_fin'))]);
        }
        if(!empty($request->getQuery('conta'))) {
            $movementos->where(['conta' => $request->getQuery('conta')]);
        }
        if(!empty($request->getQuery('tempada'))) {
            $movementos->where(['tempada' => $request->getQuery('tempada')]);
        }
        if(!empty($request->getQuery('id_partida_orzamentaria'))) {
            $movementos->where(['Area.id_partida_orzamentaria' => $request->getQuery('id_partida_orzamentaria')]);
        }
        if(!empty($request->getQuery('id_area'))) {
            $movementos->where(['Subarea.id_area' => $request->getQuery('id_area')]);
        }
        if(!empty($request->getQuery('id_subarea'))) {
            $movementos->where(['id_subarea' => $request->getQuery('id_subarea')]);
        }
        return $movementos;
    }

}
