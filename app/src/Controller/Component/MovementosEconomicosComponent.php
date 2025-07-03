<?php
namespace App\Controller\Component;

use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

class MovementosEconomicosComponent extends Component {

    public function startup(Event $event) {
        $this->Movementos = TableRegistry::get('EconomicoMovementos');
    }

    public function find($request, $prevision = false) {
        $sort = $prevision ? 'asc' : 'desc';
        $movementos = $this->Movementos
            ->find()
            ->contain(['Subarea' => ['Area' => ['PartidaOrzamentaria']], 'Clube', 'Factura'])
            ->where(['prevision' => $prevision])
            ->order(["EconomicoMovementos.data $sort", "EconomicoMovementos.id $sort"]);

        if(!empty($request->getQuery('importe'))) {
            if($request->getQuery('importe') === 'P') {
                $movementos->where(['EconomicoMovementos.importe >' => 0]);
            } else if ($request->getQuery('importe') === 'N') {
                $movementos->where(['EconomicoMovementos.importe <' => 0]);
            }
        }
        if(!empty($request->getQuery('factura'))) {
            if($request->getQuery('factura') === 'CF') {
                $movementos->where(['EconomicoMovementos.id_factura IS NOT' => null]);
            } else if ($request->getQuery('factura') === 'SF') {
                $movementos->where(['EconomicoMovementos.id_factura IS' => null, 'EconomicoMovementos.sen_factura' => 0]);
            } else if ($request->getQuery('factura') === 'NA') {
                $movementos->where(['EconomicoMovementos.sen_factura' => 1]);
            }
        }
        if(!empty($request->getQuery('data_ini'))) {
            $movementos->where(['EconomicoMovementos.data >=' => FrozenDate::createFromFormat('d-m-Y', $request->getQuery('data_ini'))]);
        }
        if(!empty($request->getQuery('data_fin'))) {
            $movementos->where(['EconomicoMovementos.data <=' => FrozenDate::createFromFormat('d-m-Y', $request->getQuery('data_fin'))]);
        }
        if(!empty($request->getQuery('conta'))) {
            $movementos->where(['EconomicoMovementos.conta' => $request->getQuery('conta')]);
        }
        if(!empty($request->getQuery('tempada'))) {
            $movementos->where(['EconomicoMovementos.tempada' => $request->getQuery('tempada')]);
        }
        if(!empty($request->getQuery('id_partida_orzamentaria'))) {
            $movementos->where(['Area.id_partida_orzamentaria' => $request->getQuery('id_partida_orzamentaria')]);
        }
        if(!empty($request->getQuery('id_area'))) {
            $movementos->where(['Subarea.id_area' => $request->getQuery('id_area')]);
        }
        if(!empty($request->getQuery('id_subarea'))) {
            $movementos->where(['EconomicoMovementos.id_subarea' => $request->getQuery('id_subarea')]);
        }
        $subarea_activa = $request->getQuery('subarea_activa');
        if(!isset($subarea_activa) || !empty($subarea_activa)) {
            $movementos->where(['Subarea.activa' => 1]);
        }
        return $movementos;
    }

}
