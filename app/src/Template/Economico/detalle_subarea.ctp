<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', empty($subarea->id) ? 'Nova subárea' : $subarea->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas Orzamentarias', 'url'=>['controller'=>'Economico', 'action'=>'partidasOrzamentarias']],
    ['label'=>empty($subarea->id) ? 'Nova subárea' : $subarea->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<div class="row">
    <?= $this->Form->create($subarea, ['type'=>'post', 'url'=>['action'=>'gardarSubarea']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Subárea</legend>
            <?= $this->Form->control('id_area', ['options'=>$this->AgfgForm->objectToKeyValue($areas,'id','{$e->partidaOrzamentaria->nome} - {$e->nome}'), 'label'=>'Área', 'templates'=>$emptyTemplates]) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
