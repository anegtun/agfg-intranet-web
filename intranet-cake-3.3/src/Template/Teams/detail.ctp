<?php $this->extend('/Teams/template') ?>

<div class="users form">
    <?= $this->Form->create($team, ['url'=>['action'=>'save']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Equipo') ?></legend>
            <?= $this->Form->input('codigo') ?>
            <?= $this->Form->input('nome') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
