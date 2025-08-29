<?php
namespace App\Controller;

use App\Model\Categorias;
use App\Model\TiposCompeticion;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class CompeticionsController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->TiposCompeticion = new TiposCompeticion();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->FasesEquipas = TableRegistry::get('FasesEquipas');
        $this->Federacions = TableRegistry::get('Federacions');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Tempadas = TableRegistry::get('Tempadas');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index() {
        $competicions = $this->Competicions->find()
            ->contain('Federacion')
            ->order(['Competicions.tempada DESC','Competicions.nome ASC']);

        $tempadas = $this->Tempadas->findOptions();
        $tiposCompeticion = $this->TiposCompeticion->getTipos();

        $this->set(compact('competicions', 'tempadas', 'tiposCompeticion'));
    }

    public function detalle($id=null) {
        $competicion = $this->Competicions->getOrNew($id, ['contain' => ['Fases' => ['sort'=>['Fases.categoria', 'Fases.nome']], 'Fases.FasePai']]);
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $tempadas = $this->Tempadas->findSorted();
        $tiposCompeticion = $this->TiposCompeticion->getTiposWithEmpty();
        $federacions = $this->Federacions->find();
        $this->set(compact('competicion', 'categorias', 'federacions', 'tempadas', 'tiposCompeticion'));
    }

    public function gardar() {
        $competicion = $this->Competicions->newEntity($this->request->getData());
        if ($this->Competicions->save($competicion)) {
            $this->Flash->success(__('Gardouse a competición correctamente.'));
            return $this->redirect(['action'=>'detalle', $competicion->id]);
        }
        $this->Flash->error(__('Erro ao gardar a competición.'));
        $this->set(compact('competicion'));
        $this->render('detail');
    }

    public function borrar($id) {
        $competicion = $this->Competicions->get($id);
        if($this->Competicions->delete($competicion)) {
            $this->Flash->success(__('Eliminouse a competición correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a competición.'));
        }
        return $this->redirect(['action'=>'index']);
    }



    public function detalleFase($id=null) {
        if(empty($id)) {
            $fase = $this->Fases->newEntity([]);
            $fase->id_competicion = $this->request->getQuery('idCompeticion');
            $fase->equipas = [];
            $equipas = [];
            $outras_fases = $this->Fases->find()->where(['id_competicion'=>$fase->id_competicion]);
        } else {
            $fase = $this->Fases->get($id, [ 'contain' => [ 'Competicion', 'Equipas' ] ]);
            $fase->xornadas = $this->Xornadas->findWithPartidos($fase->id);
            $equipas = $this->Equipas->findInFase($fase);
            $outras_fases = $this->Fases->find()->where(['id_competicion'=>$fase->id_competicion, 'id !='=>$id]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $competicion = $this->Competicions->get($fase->id_competicion);
        $this->set(compact('fase','competicion','categorias','equipas','outras_fases'));
    }

    public function gardarFase() {
        $data = $this->request->getData();
        $fase = $this->Fases->newEntity($data);
        // Gardamos datos de fase
        if (!$this->Fases->save($fase)) {
            $this->Flash->error(__('Erro ao gardar a fase.'));
            $this->set(compact('fase'));
            return $this->render('detalleFase');
        }
        // Gardamos equipas
        $this->FasesEquipas->deleteAll(['id_fase'=>$fase->id]);
        if(!empty($data['equipas'])) {
            foreach($data['equipas'] as $idE) {
                $faseEquipa = $this->FasesEquipas->newEntity([]);
                $faseEquipa->id_fase = $fase->id;
                $faseEquipa->id_equipa = $idE;
                $faseEquipa->puntos = empty($data['puntos'][$idE]) ? 0 : $data['puntos'][$idE];
                $this->FasesEquipas->save($faseEquipa);
            }
        }
        $this->Flash->success(__('Gardouse a fase correctamente.'));
        $this->redirect(['action'=>'detalleFase', $fase->id]);
    }

    public function borrarFase($id) {
        $fase = $this->Fases->get($id);
        if($this->Fases->delete($fase)) {
            $this->Flash->success(__('Eliminouse a fase correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a fase.'));
        }
        return $this->redirect(['action'=>'detalle', $fase->id_competicion]);
    }



    public function gardarXornada() {
        $data = $this->request->getData();
        $xornada = $this->Xornadas->getOrNew($data['id']);
        $xornada = $this->Xornadas->patchEntity($xornada, $data);
        $xornada->data = empty($data['data_xornada']) ? NULL : Time::createFromFormat('d-m-Y', $data['data_xornada']);
        if ($this->Xornadas->save($xornada)) {
            $this->Flash->success(__('Gardouse a xornada correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao gardar a xornada.'));
        }
        return $this->redirect(['action'=>'detalleFase', $xornada->id_fase]);
    }

    public function borrarXornada($id) {
        $xornada = $this->Xornadas->get($id);
        if($this->Xornadas->delete($xornada)) {
            $this->Flash->success(__('Eliminouse a xornada correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a xornada.'));
        }
        return $this->redirect(['action'=>'detalleFase', $xornada->id_fase]);
    }



    public function gardarPartido() {
        $data = $this->request->getData();
        $partido = $this->Partidos->getOrNew($data['id']);
        $partido = $this->Xornadas->patchEntity($partido, $data);
        $partido->data_partido = empty($data['data_partido']) ? NULL : Time::createFromFormat('d-m-Y', $data['data_partido']);
        if ($this->Partidos->save($partido)) {
            $this->Flash->success(__('Gardouse o partido correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao gardar o partido.'));
        }
        return $this->redirect(['action'=>'detalleFase',$partido->id_fase]);
    }

    public function borrarPartido($id) {
        $partido = $this->Partidos->get($id);
        if($this->Partidos->delete($partido)) {
            $this->Flash->success(__('Eliminouse o partido correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o partido.'));
        }
        return $this->redirect(['action'=>'detalleFase', $partido->id_fase]);
    }

}
