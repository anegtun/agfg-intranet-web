<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', empty($area->id) ? 'Nova área' : $area->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas Orzamentarias', 'url'=>['controller'=>'Economico', 'action'=>'partidasOrzamentarias']],
    ['label'=>empty($area->id) ? 'Nova área' : $area->nome]
]);
?>

<div class="row">
    <?= $this->Form->create($area, ['type'=>'post', 'url'=>['action'=>'gardarArea']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Área</legend>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('id_partida_orzamentaria', ['options'=>$this->AgfgForm->objectToKeyValue($partidasOrzamentarias,'id','nome'), 'label'=>'Partida Orzamentaria']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
