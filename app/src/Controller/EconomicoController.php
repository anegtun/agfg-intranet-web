<?php
namespace App\Controller;

use App\Model\Contas;
use App\Model\EconomicoFacturaEstado;
use App\Model\ResumoEconomico;
use Cake\Filesystem\Folder;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Shuchkin\SimpleXLSX;
use InvalidArgumentException;

class EconomicoController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Contas = new Contas();
        $this->FacturaEstado = new EconomicoFacturaEstado();
        $this->Clubes = TableRegistry::get('Clubes');
        $this->PartidasOrzamentarias = TableRegistry::get('EconomicoPartidasOrzamentarias');
        $this->Areas = TableRegistry::get('EconomicoAreas');
        $this->Subareas = TableRegistry::get('EconomicoSubareas');
        $this->Facturas = TableRegistry::get('EconomicoFacturas');
        $this->Movementos = TableRegistry::get('EconomicoMovementos');
        $this->Tempadas = TableRegistry::get('Tempadas');
        $this->loadComponent('EconomicoFactura');
        $this->loadComponent('ResumoEconomicoPdf');
    }

    public function index() {
        $this->redirect(['action' => 'movementos']);
    }

    public function movementos() {
        $this->listarMovementos(false);
        $this->render('movementos');
    }

    public function previsions() {
        $this->listarMovementos(true);
        $this->render('movementos');
    }

    public function detalleMovemento($id=null) {
        if(empty($id)) {
            $movemento = $this->Movementos->newEntity([]);
            $movemento->prevision = $this->request->getQuery('prevision', false);
        } else {
            $movemento = $this->Movementos->get($id);
        }
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->findSorted();
        $clubes = $this->Clubes->find()->order('nome');
        $subareas = $this->Subareas->find()->contain(['Area' => 'PartidaOrzamentaria'])->order('PartidaOrzamentaria.nome', 'Area.nome');
        if ($movemento->id_subarea) {
            $subareas->where(['OR' => ['EconomicoSubareas.activa' => 1, 'EconomicoSubareas.id' => $movemento->id_subarea]]);
        } else {
            $subareas->where(['EconomicoSubareas.activa' => 1]);
        }
        $facturas = $this->Facturas->findAbertas($movemento->id_factura);
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas', 'facturas'));
    }

    public function clonarMovemento($id) {
        $movemento = $this->Movementos->get($id);
        $movemento->id = NULL;
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->findSorted();
        $clubes = $this->Clubes->find()->order('nome');
        $subareas = $this->Subareas->find()->contain(['Area' => 'PartidaOrzamentaria'])->order('PartidaOrzamentaria.nome', 'Area.nome');
        $facturas = $this->Facturas->findAbertas($movemento->id_factura);
        $this->set(compact('movemento', 'contas', 'tempadas', 'clubes', 'subareas', 'facturas'));
        $this->render('detalleMovemento');
    }

    public function gardarMovemento() {
        $data = $this->request->getData();
        $movemento = $this->Movementos->newEntity($data);
        if(empty($data['id_clube'])) {
            $movemento->id_clube = NULL;
        }
        $movemento->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
        if ($this->Movementos->save($movemento)) {
            $this->Flash->success(__('Gardáronse os datos do movemento correctamente.'));
            return $this->redirect(['action' => $movemento->prevision ? 'previsions' : 'index']);
        }
        $this->Flash->error(__('Erro ao gardar os datos do movemento.'));
        $this->set(compact('movemento'));
        $this->render('detalleMovemento');
    }

    public function borrarMovemento($id) {
        $movemento = $this->Movementos->get($id);
        if($this->Movementos->delete($movemento)) {
            $this->Flash->success(__('Eliminouse o movemento correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o movemento.'));
        }
        return $this->redirect(['action' => $movemento->prevision ? 'previsions' : 'index']);
    }

    public function previsualizarMovementos() {
        $file = $this->request->getUploadedFile('file');

        $stream = $file->getStream();
        $tmpFilePath = $stream->getMetadata('uri');
        $stream->close();

        if (!$xlsx = SimpleXLSX::parse($tmpFilePath)) {
            die(SimpleXLSX::parseError());
        }

        $filas = [];
        $fin = null;
        $inicio = null;
        $ix_data = $ix_importe = $ix_desc = -1;
        foreach($xlsx->rows() as $row) {
            try {
                if ($row[0] === 'FECHA CONTABLE') {
                    foreach($row as $i=>$col) {
                        switch($col) {
                            case 'FECHA CONTABLE': $ix_data = $i; break;
                            case 'IMPORTE': $ix_importe = $i; break;
                            case 'DESCRIPCIÓN': $ix_desc = $i; break;
                        }
                    }
                    continue;
                }

                if ($ix_data < 0) {
                    continue;
                }

                $data = FrozenDate::createFromFormat('Y-m-d H:i:s', $row[$ix_data], 'Europe/Madrid');
                $inicio = $data;
                if(empty($fin)) {
                    $fin = $data;
                }
                $filas[] = (object) [
                    'data' => $data,
                    'importe' => $row[$ix_importe],
                    'descricion' => $row[$ix_desc]
                ];
            } catch (InvalidArgumentException $ex) {
            }
        }

        $movementos = $this->Movementos
            ->find()
            ->contain(['Subarea' => ['Area' => ['PartidaOrzamentaria']], 'Clube'])
            ->where(['and' => ['data >= ' => $inicio, 'data <= ' => $fin]]);

        $facturas = $this->Facturas->findAbertas();
        $tempadas = $this->Tempadas->findSorted();
        $clubes = $this->Clubes->findAGFG();
        $subareas = $this->Subareas
            ->find()
            ->contain(['Area' => 'PartidaOrzamentaria'])
            ->where(['activa' => 1])
            ->order('PartidaOrzamentaria.nome', 'Area.nome');

        $this->set(compact('filas', 'movementos', 'facturas', 'tempadas', 'clubes', 'subareas'));
    }

    public function importarMovementos() {
        $data = $this->request->getData();

        foreach($data['fila'] as $fila) {
            if(!empty($fila['importar'])) {
                $movemento = $this->Movementos->newEntity($fila);
                if(empty($fila['id_clube'])) {
                    $movemento->id_clube = NULL;
                }
                if(empty($fila['id_factura'])) {
                    $movemento->id_factura = NULL;
                } elseif($fila['id_factura'] == -1) {
                    $movemento->id_factura = NULL;
                    $movemento->sen_factura = 1;
                }
                $movemento->data = empty($fila['data']) ? NULL : Time::createFromFormat('d-m-Y', $fila['data']);
                $this->Movementos->save($movemento);
            }
        }
        return $this->redirect(['action' => 'index']);
    }



    public function facturas() {
        $estados = $this->FacturaEstado->getAll();
        $facturas_query = $this->Facturas
            ->find()
            ->contain(['Movementos' => ['Subarea' => ['Area' => ['PartidaOrzamentaria']]]])
            ->order('data desc');

        $all_facturas = $facturas_query->toArray();

        $entidades = [''=>''];
        foreach($all_facturas as $f) {
            $entidades[$f->entidade] = $f->entidade;
        }
        asort($entidades);

        if(!empty($this->request->getQuery('data_ini'))) {
            $facturas_query->where(['data >=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_ini'))]);
        }
        if(!empty($this->request->getQuery('data_fin'))) {
            $facturas_query->where(['data <=' => FrozenDate::createFromFormat('d-m-Y', $this->request->getQuery('data_fin'))]);
        }
        if(!empty($this->request->getQuery('entidade'))) {
            $facturas_query->where(['entidade' => $this->request->getQuery('entidade')]);
        }
        if(!empty($this->request->getQuery('texto'))) {
            $texto = strtoupper($this->request->getQuery('texto'));
            $facturas_query->where(['OR' =>[
                'UPPER(entidade) LIKE' => "%$texto%",
                'UPPER(referencia) LIKE' => "%$texto%",
                'UPPER(descricion) LIKE' => "%$texto%",
                'UPPER(observacions) LIKE' => "%$texto%"
            ]]);
        }

        $facturas = [];

        $estado_param = $this->request->getQuery('estado');
        foreach($facturas_query->toArray() as $f) {
            $diff = $f->diffImporteMovementos();
            switch($estado_param) {
                case 'A': $fn_match = function($fac) { return $fac->isAberta(); }; break;
                case 'F': $fn_match = function($fac) { return !$fac->isAberta(); }; break;
                case 'S': $fn_match = function($fac) { return $fac->isPechada() && empty($fac->movementos); }; break;
                case 'I': $fn_match = function($fac) { return $fac->isPechada() && !empty($fac->movementos) && ((int)$fac->diffImporteMovementos()) != 0; }; break;
                default:  $fn_match = function($fac) { return true; }; break;
            }
            if($fn_match($f)) {
                $facturas[] = $f;
            }
        }

        foreach($facturas as $f) {
            $f->arquivos = $this->EconomicoFactura->list($f);
        }

        $this->set(compact('facturas', 'estados', 'entidades'));
    }

    public function detalleFactura($id=null) {
        $estados = $this->FacturaEstado->getAll();
        $factura = $this->Facturas->getOrNew($id, ['contain' => 'Movementos']);
        $arquivos = empty($id) ? [] : $this->EconomicoFactura->list($factura);
        $this->set(compact('factura', 'arquivos', 'estados'));
    }

    public function clonarFactura($id) {
        $estados = $this->FacturaEstado->getAll();
        $factura = $this->Facturas->get($id);
        $factura->id = null;
        $factura->estado = 'A';
        $this->set(compact('factura', 'estados'));
        $this->render('detalleFactura');
    }

    public function gardarFactura() {
        $data = $this->request->getData();
        $factura = $this->Facturas->newEntity($data);
        $factura->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);

        if ($this->Facturas->save($factura)) {
            $this->Flash->success(__('Gardáronse os datos da factura correctamente.'));
            return $this->redirect(['action' => 'facturas']);
        }
        $this->Flash->error(__('Erro ao gardar os datos da factura.'));
        $this->set(compact('factura'));
        $this->render('detalleFactura');
    }

    public function subirFactura() {
        $data = $this->request->getData();
        $file = $this->request->getUploadedFile('file');
        $factura = $this->Facturas->get($data['id']);
        $this->EconomicoFactura->upload($factura, $file );
        $this->redirect(['action'=>'detalleFactura', $factura->id]);
    }

    public function borrarFactura($id) {
        $factura = $this->Facturas->get($id);
        if($this->Facturas->delete($factura)) {
            $this->EconomicoFactura->deleteAll($factura);
            $this->Flash->success(__('Eliminouse a factura correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a factura.'));
        }
        return $this->redirect(['action' => 'facturas']);
    }

    public function descargarFacturaArquivo($id_factura, $arquivo) {
        $factura = $this->Facturas->get($id_factura);
        $path = $this->EconomicoFactura->getPath($factura, $arquivo);
        return $this->response->withFile($path, ['name'=>$arquivo]);
    }

    public function borrarFacturaArquivo($id_factura, $arquivo) {
        $factura = $this->Facturas->get($id_factura);
        $path = $this->EconomicoFactura->delete($factura, $arquivo);
        $this->Flash->success(__('Eliminouse o arquivo correctamente.'));
        return $this->redirect(['action' => 'detalleFactura', $factura->id]);
    }



    public function resumo() {
        $query = $this->queryToArray($this->request);
        $query['subarea_activa'] = false;
        $movementos = $this->Movementos->findBy($query, false);
        $previsions = $this->Movementos->findBy($query, true);
        $resumo = new ResumoEconomico($movementos, $previsions);

        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $tempadas = $this->Tempadas->findOptions();

        if($this->request->getQuery('accion') === 'pdf') {
            $content = $this->ResumoEconomicoPdf->generate($resumo, $tempadas, $this->request);
            $response = $this->response->withStringBody($content)->withType('application/pdf');
            if(!empty($this->request->getQuery('download'))) {
                $response = $response->withDownload($content->getReportFilename());
            }
            return $response;
        }

        $this->set(compact('resumo', 'partidasOrzamentarias', 'tempadas'));
    }

    public function resumoClubes() {
        $query = $this->queryToArray($this->request);
        $query['subarea_activa'] = false;
        $movementos = $this->Movementos->findBy($query, false);
        $previsions = $this->Movementos->findBy($query, true);
        $resumo = new ResumoEconomico($movementos, $previsions);
        $tempadas = $this->Tempadas->findOptions();
        $clubes = $this->Clubes->find()->order('nome');
        $this->set(compact('resumo', 'clubes', 'tempadas'));
    }



    public function partidasOrzamentarias() {
        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $this->set(compact('partidasOrzamentarias'));
    }

    public function detallePartidaOrzamentaria($id=null) {
        $partidaOrzamentaria = $this->PartidasOrzamentarias->getOrNew($id);
        $this->set(compact('partidaOrzamentaria'));
    }

    public function gardarPartidaOrzamentaria() {
        $partidaOrzamentaria = $this->PartidasOrzamentarias->newEntity($this->request->getData());
        if ($this->PartidasOrzamentarias->save($partidaOrzamentaria)) {
            $this->Flash->success(__('Gardouse a partida orzamentaria correctamente.'));
            return $this->redirect(['action'=>'partidasOrzamentarias']);
        }
        $this->Flash->error(__('Erro ao gardar a partida orzamentaria.'));
        $this->set(compact('partidaOrzamentaria'));
        $this->render('detallePartidaOrzamentaria');
    }

    public function borrarPartidaOrzamentaria($id) {
        if($this->PartidasOrzamentarias->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a partida orzamentaria correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a partida orzamentaria.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    public function detalleArea($id=null) {
        $area = $this->Areas->getOrNew($id);
        $partidasOrzamentarias = $this->PartidasOrzamentarias->find()->order('nome');
        $this->set(compact('area', 'partidasOrzamentarias'));
    }

    public function gardarArea() {
        $area = $this->Areas->newEntity($this->request->getData());
        if ($this->Areas->save($area)) {
            $this->Flash->success(__('Gardouse a área correctamente.'));
            return $this->redirect(['action'=>'partidasOrzamentarias']);
        }
        $this->Flash->error(__('Erro ao gardar a área.'));
        $this->set(compact('area'));
        $this->render('detalleArea');
    }

    public function borrarArea($id) {
        if($this->Areas->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a área correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a área.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    public function detalleSubarea($id=null) {
        $subarea = $this->Subareas->getOrNew($id, ['contain' => ['Movementos'=>['Factura','Clube'], 'Previsions'=>['Clube']]]);
        $areas = $this->Areas->find()->contain(['PartidaOrzamentaria'])->order(['PartidaOrzamentaria.nome', 'EconomicoAreas.nome']);
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->findOptions();
        $this->set(compact('subarea', 'areas', 'contas', 'tempadas'));
    }

    public function gardarSubarea() {
        $subarea = $this->Subareas->newEntity($this->request->getData());
        if ($this->Subareas->save($subarea)) {
            $this->Flash->success(__('Gardouse a subárea correctamente.'));
            return $this->redirect(['action'=>'partidasOrzamentarias']);
        }
        $this->Flash->error(__('Erro ao gardar a subárea.'));
        $this->set(compact('subarea'));
        $this->render('detalleSubarea');
    }

    public function borrarSubarea($id) {
        if($this->Subareas->deleteById($id)) {
            $this->Flash->success(__('Eliminouse a subárea correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar a subárea.'));
        }
        return $this->redirect(['action'=>'partidasOrzamentarias']);
    }

    private function listarMovementos($prevision) {
        $contas = $this->Contas->getAllWithEmpty();
        $tempadas = $this->Tempadas->findOptions();
        $partidasOrzamentarias = $this->PartidasOrzamentarias->findComplete();
        $movementos = $this->Movementos->findBy($this->queryToArray($this->request), $prevision);
        $this->set(compact('prevision', 'contas', 'tempadas', 'partidasOrzamentarias', 'movementos'));
    }

    private function queryToArray($request) {
        $array = [];

        $params = ['importe', 'factura', 'data_ini', 'data_fin', 'conta', 'tempada', 'id_partida_orzamentaria', 'id_area', 'id_subarea', 'texto'];
        foreach($params as $p) {
            $valor = $request->getQuery($p);
            if(!empty($valor)) {
                $array[$p] = $valor;
            }
        }

        $subarea_activa = $request->getQuery('subarea_activa');
        if(isset($subarea_activa)) {
            $array['subarea_activa'] = $subarea_activa;
        }

        return $array;
    }

}
