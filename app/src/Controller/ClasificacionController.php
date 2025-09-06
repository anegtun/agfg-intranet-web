<?php
namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

class ClasificacionController extends AppController {
    
    public function initialize(): void {
        parent::initialize();
        $this->Competicions = TableRegistry::get('Competicions');
        $this->Fases = TableRegistry::get('Fases');
        $this->loadComponent('ClasificacionCalculator');
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['competicion', 'fase']);
    }

    public function competicion($codCompeticion, $categoria) {
        if(empty($categoria)) {
            throw new Exception("Hai que especificar categoría");
        }

        $competicion = $this->Competicions->findByCodigoOrFail($codCompeticion);

        $clasificacion = $this->ClasificacionCalculator->calcular($competicion->id, $categoria);

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

        $clasificacion = $this->ClasificacionCalculator->calcular($competicion->id, $categoria, $fase);

        $this->set(compact('clasificacion'));
        $this->render('clasificacion');
    }
}
