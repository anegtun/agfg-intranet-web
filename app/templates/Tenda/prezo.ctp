<?php
$this->extend('template');
$this->set('submenu_option', 'stock');
$this->set('cabeceiraTitulo', 'Prezo');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Stock', 'url'=>['controller'=>'Tenda', 'action'=>'stock']],
    ['label'=>$prezo->produto->nome],
    ['label'=>'Prezo']
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

if(!empty($prezo->id)) {
    // Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
    $prezo->data_inicio_str = $prezo->data_inicio->format('d-m-Y');
    $prezo->data_fin_str = $prezo->data_fin->format('d-m-Y');
}

?>

<?= $this->Form->create($prezo, ['type'=>'post', 'url'=>['action'=>'gardarPrezo']]) ?>
    <?= $this->Form->hidden('id') ?>
    <?= $this->Form->hidden('id_produto') ?>
    <fieldset>
        <legend><?= $prezo->produto->nome ?>: Prezo</legend>
        <div class="row">
            <div class="form-group col-lg-1">
                <?= $this->Form->control('data_inicio', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$prezo->data_inicio_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-1">
                <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$prezo->data_fin_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-1">
                <?= $this->Form->control('prezo', ['label'=>'Prezo']) ?>
            </div>
        </div>
        <div class="row">
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']) ?>
        </div>
    </fieldset>
<?= $this->Form->end() ?>
