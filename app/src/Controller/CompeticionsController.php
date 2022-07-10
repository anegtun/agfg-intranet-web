<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use App\Model\Tempadas;
use App\Model\TiposCompeticion;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class CompeticionsController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->Categorias = new Categorias();
        $this->Tempadas = new Tempadas();
        $this->TiposCompeticion = new TiposCompeticion();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->Fases = TableRegistry::get('Fases');
        $this->Equipas = TableRegistry::get('Equipas');
        $this->FasesEquipas = TableRegistry::get('FasesEquipas');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Xornadas = TableRegistry::get('Xornadas');
    }

    public function index() {
        $this->set('tempadas', $this->Tempadas->getTempadas());
        $this->set('tiposCompeticion', $this->TiposCompeticion->getTipos());
        $this->set('competicions', $this->Competicions->find('all', ['order'=>'tempada DESC','nome']));
    }

    public function detalle($id=null) {
        if(empty($id)) {
            $competicion = $this->Competicions->newEntity();
        } else {
            $competicion = $this->Competicions->get($id, ['contain' => ['Fases' => ['sort'=>['Fases.categoria', 'Fases.nome']], 'Fases.FasePai']]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $tempadas = $this->Tempadas->getTempadasWithEmpty();
        $tiposCompeticion = $this->TiposCompeticion->getTiposWithEmpty();
        $clubes = $this->Clubes->find();
        $this->set(compact('competicion', 'categorias', 'tempadas', 'tiposCompeticion', 'clubes'));
    }

    public function gardar() {
        $competicion = $this->Competicions->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $competicion = $this->Competicions->patchEntity($competicion, $this->request->getData());
            if ($this->Competicions->save($competicion)) {
                $this->Flash->success(__('Gardouse a competición correctamente.'));
                return $this->redirect(['action'=>'detalle', $competicion->id]);
            }
            $this->Flash->error(__('Erro ao gardar a competición.'));
        }
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
        return $this->redirect(array('action'=>'index'));
    }



    public function detalleFase($id=null) {
        if(empty($id)) {
            $fase = $this->Fases->newEntity();
            $fase->id_competicion = $this->request->getQuery('idCompeticion');
            $fase->equipas = [];
            $equipas = [];
            $outras_fases = $this->Fases->find()->where(['id_competicion'=>$fase->id_competicion]);
        } else {
            $fase = $this->Fases->get($id);
            $fase->equipas = [];
            $fasesEquipas = $this->FasesEquipas->find()->where(['id_fase'=>$fase->id]);
            foreach($fasesEquipas as $fe) {
                $fase->equipas[$fe->id_equipa] = $fe;
            }
            $fase->xornadas = $this->Xornadas->findWithPartidos($fase->id);
            $fase->equipasData = $this->Equipas->findInFase($fase->id);
            $equipas = $this->Equipas->find()->where(['categoria'=>$fase->categoria])->order(['nome']);
            $outras_fases = $this->Fases->find()->where(['id_competicion'=>$fase->id_competicion, 'id !='=>$id]);
        }
        $categorias = $this->Categorias->getCategoriasWithEmpty();
        $competicion = $this->Competicions->get($fase->id_competicion);
        $equipas_map = $this->Equipas->find()->find('list', ['keyField'=>'id','valueField'=>'nome'])->toArray();
        $this->set(compact('fase','competicion','categorias','equipas','equipas_map','outras_fases'));
    }

    public function gardarFase() {
        $fase = $this->Fases->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->getData();
            // Gardamos datos de fase
            $fase = $this->Fases->patchEntity($fase, $data);
            if (!$this->Fases->save($fase)) {
                $this->Flash->error(__('Erro ao gardar a fase.'));
                $this->set(compact('fase'));
                return $this->render('detalleFase');
            }
            // Gardamos equipas
            $this->FasesEquipas->deleteAll(['id_fase'=>$fase->id]);
            if(!empty($data['equipas'])) {
                foreach($data['equipas'] as $idE) {
                    $faseEquipa = $this->FasesEquipas->newEntity();
                    $faseEquipa->id_fase = $fase->id;
                    $faseEquipa->id_equipa = $idE;
                    $faseEquipa->puntos = empty($data['puntos'][$idE]) ? 0 : $data['puntos'][$idE];
                    $this->FasesEquipas->save($faseEquipa);
                }
            }
            $this->Flash->success(__('Gardouse a fase correctamente.'));
            $this->redirect(['action'=>'detalleFase', $fase->id]);
        }
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
        $xornada = empty($data['id']) ? $this->Xornadas->newEntity() : $this->Xornadas->get($data['id']);
        if ($this->request->is('post') || $this->request->is('put')) {
            $xornada = $this->Xornadas->patchEntity($xornada, $data);
            $xornada->data = empty($data['data_xornada']) ? NULL : Time::createFromFormat('d-m-Y', $data['data_xornada']);
            if ($this->Xornadas->save($xornada)) {
                $this->Flash->success(__('Gardouse a xornada correctamente.'));
            } else {
                $this->Flash->error(__('Erro ao gardar a xornada.'));
            }
        }
        return $this->redirect(['action'=>'detalleFase',$xornada->id_fase]);
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
        $partido = empty($data['id']) ? $this->Partidos->newEntity() : $this->Partidos->get($data['id']);
        if ($this->request->is('post') || $this->request->is('put')) {
            $partido = $this->Xornadas->patchEntity($partido, $this->request->getData());
            if ($this->Partidos->save($partido)) {
                $this->Flash->success(__('Gardouse o partido correctamente.'));
            } else {
                $this->Flash->error(__('Erro ao gardar o partido.'));
            }
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
