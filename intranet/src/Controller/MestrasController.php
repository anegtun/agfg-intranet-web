<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use App\Model\Competicions;
use App\Model\Tempadas;
use App\Model\TiposCompeticion;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class MestrasController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['competicions']);

        $this->Competicions = TableRegistry::get('Competicions');
        $this->Categorias = new Categorias();
        $this->Tempadas = new Tempadas();
        $this->TiposCompeticion = new TiposCompeticion();
    }

    public function competicions() {
        $where = [];
        $tipo = $this->request->getQuery('tipo');
        if(!empty($tipo)) {
            $where['Competicions.tipo'] = $tipo;
        }
        $competicions = $this->Competicions->find()->where($where);
        $categorias = $this->Categorias->getCategorias();
        $tempadas = $this->Tempadas->getTempadas();
        $categorias = $this->Categorias->getCategorias();
        $tipos = $this->TiposCompeticion->getTipos();
        $json = [];
        foreach($competicions as $c) {
            $json[] = [
                'id' => $c->uuid,
                'nome' => $c->nome,
                'tipo' => [
                    'codigo' => $c->tipo,
                    'descricion' => $tipos[$c->tipo],
                ],
                'tempada' => [
                    'codigo' => $c->tempada,
                    'descricion' => $tempadas[$c->tempada],
                ],
            ];
        }
        $this->set($json);
    }
    
}
