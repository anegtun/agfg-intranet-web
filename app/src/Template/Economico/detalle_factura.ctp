<?php
$this->extend('template');
$this->set('submenu_option', 'facturas');
$this->set('cabeceiraTitulo', empty($factura->id) ? 'Nova factura' : $factura->data->format('Y-m-d'));
$this->set('cabeceiraMigas', [
    ['label'=>'Contabilidade'],
    ['label'=>'Facturas', 'url'=>['action'=>'facturas']],
    ['label'=>empty($factura->id) ? 'Nova factura' : $factura->data->format('Y-m-d')]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<?= $this->Form->create($factura, ['type'=>'post', 'url'=>['action'=>'gardarFactura']]) ?>
    <?= $this->Form->hidden('id') ?>
    <fieldset>
        <legend>Factura</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$factura->data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('importe', ['type'=>'number', 'label'=>'Importe']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('entidade', ['label'=>'Entidade']) ?>
            </div>
            <div class="form-group col-lg-12">
                <?= $this->Form->control('referencia', ['label'=>'Referencia']) ?>
            </div>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>
