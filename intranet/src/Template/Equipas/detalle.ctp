<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Detalle');
$this->set('cabeceiraMigas', [
    ['label'=>'Equipas', 'url'=>['controller'=>'Equipas', 'action'=>'index']],
    ['label'=>'Detalle']
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($equipa, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Equipa</legend>
                <?= $this->Form->control('codigo', ['class'=>'form-control','label'=>'Código']) ?>
                <?= $this->Form->control('nome', ['class'=>'form-control','label'=>'Nome']) ?>
                <?= $this->Form->control('categoria', ['options'=>$categorias, 'label'=>'Categoría']) ?>
                <?= $this->Form->control('logo', ['class'=>'form-control','label'=>'Logo']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>