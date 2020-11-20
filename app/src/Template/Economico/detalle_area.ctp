<?php
$this->extend('template');
$this->set('cabeceiraTitulo', empty($area->id) ? 'Nova área' : $area->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Áreas', 'url'=>['controller'=>'Economico', 'action'=>'areas']],
    ['label'=>empty($area->id) ? 'Nova área' : $area->nome]
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($area, ['type'=>'post', 'url'=>['action'=>'gardarArea']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Área</legend>
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>