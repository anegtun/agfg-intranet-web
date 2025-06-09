<?php
$this->extend('template');
$this->Html->script('eventos', ['block' => 'script']);


// Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
$data_str = empty($evento->data) ? NULL : $evento->data->format('d-m-Y');

$this->set('submenu_option', 'eventos');
$this->set('cabeceiraTitulo', empty($evento->id) ? 'Novo evento' : $evento->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Eventos', 'url'=>['action'=>'eventos']],
    ['label'=>empty($evento->id) ? 'Novo evento' : $evento->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<?= $this->Form->create($evento, ['type'=>'post', 'url'=>['action'=>'gardarEvento']]) ?>
    <?= $this->Form->hidden('id') ?>
    <fieldset>
        <legend>Evento</legend>

        <div class="row">
            <div class="form-group col-lg-9">
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('observacions', ['label'=>'Observacións']) ?>
            </div>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>
