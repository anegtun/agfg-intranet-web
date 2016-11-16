<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($equipa, ['url'=>['action'=>'save']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Equipo') ?></legend>
            <?= $this->Form->input('codigo') ?>
            <?= $this->Form->input('nome') ?>
            <?= $this->Form->input('logo') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
