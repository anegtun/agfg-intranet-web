<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($equipa, ['url'=>['action'=>'gardarEquipa']]) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_clube') ?>
        <fieldset>
            <legend><?= __('Equipo') ?></legend>
            <?= $this->Form->input('codigo') ?>
            <?= $this->Form->input('nome') ?>
            <?= $this->Form->input('logo') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>