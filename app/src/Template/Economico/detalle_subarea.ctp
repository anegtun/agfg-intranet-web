<?php
$this->extend('template');
$this->set('cabeceiraTitulo', empty($subarea->id) ? 'Nova subárea' : $subarea->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Áreas', 'url'=>['controller'=>'Economico', 'action'=>'areas']],
    ['label'=>empty($subarea->id) ? 'Nova subárea' : $subarea->nome]
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($subarea, ['type'=>'post', 'url'=>['action'=>'gardarSubarea']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Subárea</legend>
                <?= $this->Form->control('id_area', ['options'=>$areas, 'label'=>'Área']) ?>
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>