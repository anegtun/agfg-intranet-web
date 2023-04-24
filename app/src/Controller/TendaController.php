<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\TendaEstados;
use App\Model\TendaTipoEnvio;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class TendaController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->TendaEstados = new TendaEstados();
        $this->TendaTipoEnvio = new TendaTipoEnvio();
        $this->TendaPedidos = TableRegistry::get('TendaPedidos');
        $this->TendaPedidoItems = TableRegistry::get('TendaPedidoItems');
        $this->TendaProdutos = TableRegistry::get('TendaProdutos');
        $this->TendaProdutoPrezos = TableRegistry::get('TendaProdutoPrezos');
        $this->TendaProdutoSkus = TableRegistry::get('TendaProdutoSkus');
    }

    public function pedidos() {
        $estados = $this->TendaEstados->getAll();

        $pedidos = $this->TendaPedidos
            ->find()
            ->contain(['Items' => ['Sku' => 'Produto']])
            ->order(['data' => 'DESC']);

        $filtro = $this->request->getQuery('todos');
        if(empty($filtro) || $filtro==='P') {
            $pedidos->where(['estado NOT IN ' => $this->TendaEstados->getCodigosFinalizados()]);
        } else if($filtro==='F') {
            $pedidos->where(['estado IN ' => $this->TendaEstados->getCodigosFinalizados()]);
        }

        $this->set(compact('pedidos', 'estados'));
    }

    public function pedido($id=null) {
        $estados = $this->TendaEstados->getAll();
        $tipos_envio = $this->TendaTipoEnvio->getAll();
        
        $skus = $this->TendaProdutoSkus
            ->find()
            ->contain(['Produto']);
        
        $pedido = $this->TendaPedidos->getOrNew($id, ['contain'=>['Items' => ['Sku' => 'Produto']]]);

        $this->set(compact('pedido', 'estados', 'tipos_envio', 'skus'));
    }

    public function engadirItem() {
        $data = $this->request->getData();
        $pedido = $this->TendaPedidos->get($data['id_pedido'], ['contain'=>['Items']]);
        $pedido->items[] = $this->TendaPedidoItems->newEntity($data);
        $pedido->setDirty('items', true);
        $this->TendaPedidos->save($pedido);
        return $this->redirect(['action'=>'pedido', $data['id_pedido']]);
    }

    public function borrarItem($id_pedido, $id_sku) {
        $this->TendaPedidoItems->query()
            ->delete()
            ->where(['id_pedido'=>$id_pedido, 'id_sku'=>$id_sku])
            ->execute();
        return $this->redirect(['action'=>'pedido', $id_pedido]);
    }

    public function gardarPedido() {
        $data = $this->request->getData();
        $pedido = $this->TendaPedidos->getOrNew($data['id_pedido'], ['contain'=>['Items']]);
        $pedido = $this->TendaPedidos->patchEntity($pedido, $data);
        $pedido->data = empty($data['data']) ? NULL : Time::createFromFormat('d-m-Y', $data['data']);
        if ($this->TendaPedidos->save($pedido)) {
            $this->Flash->success(__('Gardouse o pedido correctamente.'));
            return empty($data['id']) ? $this->redirect(['action'=>'pedidos']) : $this->redirect(['action'=>'pedido', $data['id']]);
        }
        $this->Flash->error(__('Erro ao gardar o pedido.'));
        $this->set(compact('pedido'));
        $this->render('pedido');
    }

    public function borrarPedido($id) {
        $pedido = $this->TendaPedidos->get($id);
        if($this->TendaPedidos->delete($pedido)) {
            $this->Flash->success(__('Eliminouse o pedido correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o pedido.'));
        }
        return $this->redirect(['action'=>'pedidos']);
    }

    public function stock() {
        $produtos = $this->TendaProdutos
            ->find()
            ->contain('Skus')
            ->order('nome');
        
        $this->set(compact('produtos'));
    }

    public function produto($id=null) {
        $produto = $this->TendaProdutos->getOrNew($id, ['contain'=>['Skus', 'Prezos']]);
        $this->set(compact('produto'));
    }

    public function sku($id=null) {
        if(empty($id)) {
            $sku = $this->TendaProdutoSkus->newEntity();
            $sku->id_produto = $this->request->getQuery('id_produto');
            $sku->produto = $this->TendaProdutos->get($sku->id_produto);
        } else {
            $sku = $this->TendaProdutoSkus->get($id, ['contain'=>['Produto']]);
        }
        $this->set(compact('sku'));
    }

    public function prezo($id=null) {
        if(empty($id)) {
            $prezo = $this->TendaProdutoPrezos->newEntity();
            $prezo->id_produto = $this->request->getQuery('id_produto');
            $prezo->produto = $this->TendaProdutos->get($prezo->id_produto);
        } else {
            $prezo = $this->TendaProdutoPrezos->get($id, ['contain'=>['Produto']]);
        }
        $this->set(compact('prezo'));
    }

    public function gardarProduto() {
        $produto = $this->TendaProdutos->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $produto = $this->TendaProdutos->patchEntity($produto, $this->request->getData());
            if ($this->TendaProdutos->save($produto)) {
                $this->Flash->success(__('Gardouse o produto correctamente.'));
                return $this->redirect(['action'=>'stock']);
            }
            $this->Flash->error(__('Erro ao gardar o produto.'));
        }
        $this->set(compact('produto'));
        $this->render('produto');
    }

    public function borrarProduto($id) {
        $produto = $this->TendaProdutos->get($id);
        if($this->TendaProdutos->delete($produto)) {
            $this->Flash->success(__('Eliminouse o produto correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o produto.'));
        }
        return $this->redirect(['action'=>'produto']);
    }

    public function gardarSku() {
        $sku = $this->TendaProdutoSkus->newEntity();
        if ($this->request->is('post') || $this->request->is('put')) {
            $sku = $this->TendaProdutoSkus->patchEntity($sku, $this->request->getData());
            if ($this->TendaProdutoSkus->save($sku)) {
                $this->Flash->success(__('Gardouse o produto correctamente.'));
                return $this->redirect(['action'=>'produto', $sku->id_produto]);
            }
            $this->Flash->error(__('Erro ao gardar o SKU.'));
        }
        $this->set(compact('sku'));
        $this->render('sku');
    }

    public function borrarSku($id) {
        $sku = $this->TendaProdutoSkus->get($id);
        if($this->TendaProdutoSkus->delete($sku)) {
            $this->Flash->success(__('Eliminouse o SKU correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o SKU.'));
        }
        return $this->redirect(['action'=>'produto', $sku->id_produto]);
    }

    public function gardarPrezo() {
        $data = $this->request->getData();
        $prezo = $this->TendaProdutoPrezos->getOrNew($data['id']);
        $prezo = $this->TendaProdutoPrezos->patchEntity($prezo, $data);
        $prezo->data_inicio = empty($data['data_inicio']) ? NULL : Time::createFromFormat('d-m-Y', $data['data_inicio']);
        $prezo->data_fin = empty($data['data_fin']) ? NULL : Time::createFromFormat('d-m-Y', $data['data_fin']);
        if ($this->TendaProdutoPrezos->save($prezo)) {
            $this->Flash->success(__('Gardouse o prezo correctamente.'));
            return $this->redirect(['action'=>'produto', $prezo->id_produto]);
        }
        $this->Flash->error(__('Erro ao gardar o prezo.'));
        $this->set(compact('prezo'));
        $this->render('prezo');
    }

    public function borrarPrezo($id) {
        $prezo = $this->TendaProdutoPrezos->get($id);
        if($this->TendaProdutoPrezos->delete($prezo)) {
            $this->Flash->success(__('Eliminouse o prezo correctamente.'));
        } else {
            $this->Flash->error(__('Erro ao eliminar o prezo.'));
        }
        return $this->redirect(['action'=>'produto', $prezo->id_produto]);
    }

}
