<?php
$this->extend('template');
$this->set('submenu_option', 'pedidos');
$this->set('cabeceiraTitulo', 'Pedido');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Pedidos', 'url'=>['controller'=>'Tenda', 'action'=>'pedidos']],
    ['label'=>empty($pedido->id) ? 'Pedido' : $pedido->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$this->Html->script('tenda', ['block' => 'script']);

if(!empty($pedido->id)) {
    // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
    $pedido->data_str = $pedido->data->format('d-m-Y');
}
?>

<?= $this->Form->create($pedido, ['type'=>'post', 'url'=>['action'=>'gardarPedido']]) ?>
    <?= $this->Form->hidden('id') ?>

    <fieldset>
        <legend>Pedido</legend>
        <div class="row">
            <div class="form-group col-lg-1">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$pedido->data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('nome', ['class'=>'form-control', 'label'=>'Nome', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-2">
                <?= $this->Form->control('estado', ['options'=>array_merge([''=>''], $estados), 'label'=>'Estado']) ?>
            </div>
            <div class="form-group col-lg-2">
                <?= $this->Form->control('prezo', ['label'=>'Prezo fixo']) ?>
            </div>
        </div>
    </fieldset>

    <?php if(!empty($pedido->id)) : ?>

        <fieldset>
            <legend>Produtos</legend>
            <div class="row">

            <div class="col-xs-12 table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="celda-titulo" style="width:5px"></th>
                            <th class="celda-titulo">Produto</th>
                            <th class="celda-titulo">Cantidade</th>
                            <th class="celda-titulo">Persoalización</th>
                            <th class="celda-titulo">Prezo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pedido->items as $i) : ?>
                            <tr>
                                <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarItem', $i->id_pedido, $i->id_sku]) ?></td>
                                <td><?= $i->sku->produto->nome ?> (<?= $i->sku->nome ?>)</td>
                                <td><?= $i->cantidade ?></td>
                                <td><?= $i->persoalizacion ?></td>
                                <td class="text-right"><?= $i->getPrezo() ?>&euro;</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>


                <button id="modal-skus-button" type="button" class="btn btn-light">Engadir</button>

            </div>
        </fieldset>

    <?php endif ?>

    <fieldset>
        <legend>Envío</legend>
        <div class="row">
            <div class="form-group col-lg-2">
                <?= $this->Form->control('tipo_envio', ['options'=>array_merge([''=>''], $tipos_envio), 'label'=>'Tipo envío']) ?>
            </div>
            <div class="form-group col-lg-1">
                <?= $this->Form->control('gastos_envio', ['class'=>'form-control', 'label'=>'G. envío', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-1">
                <?= $this->Form->control('gastos_envio_real', ['class'=>'form-control', 'label'=>'G. envío (real)', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-7">
                <?= $this->Form->control('direccion', ['class'=>'form-control', 'label'=>'Dirección', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Outros datos</legend>
        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('email', ['class'=>'form-control', 'label'=>'Correo-e', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('telefono', ['class'=>'form-control', 'label'=>'Teléfono', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-8">
                <label>Observacións</label>
                <?= $this->Form->textarea('observacions', ['class'=>'form-control', 'width'=>'100%']) ?>
            </div>
        </div>
    </fieldset>

    <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
    
    <?php if(!empty($pedido->id)) : ?>
        <?= $this->Html->link('Eliminar', ['action'=>'borrarPedido', $pedido->id], ['class'=>'btn btn-danger', 'confirm'=>'Seguro que queres borrar o pedido?']); ?>
    <?php endif ?>

<?= $this->Form->end() ?>



<div id="modalProduto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <?= $this->Form->create(NULL, ['type'=>'post', 'url'=>['action'=>'engadirItem']]) ?>
        <?= $this->Form->hidden('id_pedido', ['value'=>$pedido->id]) ?>

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Engadir produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <?= $this->Form->control('id_sku', ['options'=>$this->AgfgForm->objectToKeyValue($skus,'id','{$e->produto->nome} - {$e->nome} (stock: {$e->stock})'), 'label'=>'Produto']) ?>
                        <?= $this->Form->control('cantidade', ['label'=>'Cantidade']) ?>
                        <?= $this->Form->control('persoalizacion', ['label'=>'Persoalización']) ?>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pechar</button>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
