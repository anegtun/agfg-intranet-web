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
        </div>
    </fieldset>

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
