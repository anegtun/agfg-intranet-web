<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Detalle');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Campos', 'url'=>['controller'=>'Campos', 'action'=>'index']],
    ['label'=>'Detalle']
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($campo, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Campo</legend>
                <?= $this->Form->control('codigo', ['label'=>'Código']) ?>
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
                <?= $this->Form->control('nome_curto', ['label'=>'Nome curto']) ?>
                <?= $this->Form->control('pobo', ['label'=>'Poboación']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>