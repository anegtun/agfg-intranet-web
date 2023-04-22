<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Categorias;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class TendaController extends AppController {
    
    public function initialize() {
        parent::initialize();
        $this->TendaProdutos = TableRegistry::get('TendaProdutos');
        $this->TendaProdutoSkus = TableRegistry::get('TendaProdutoSkus');
    }

    public function stock() {
        $produtos = $this->TendaProdutos
            ->find()
            ->contain('Skus')
            ->order('nome');
        
        $this->set(compact('produtos'));
    }

    public function produto($id=null) {
        $produto = empty($id)
            ? $this->newEntity()
            : $this->TendaProdutos->get($id, [ 'contain' => ['Skus'] ]);
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

}
