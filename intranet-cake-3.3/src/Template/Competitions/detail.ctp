<?php $this->extend('/Competitions/template') ?>

<div class="users form">
    <?= $this->Form->create($competition, ['url'=>['action'=>'save']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Competición') ?></legend>
            <?= $this->Form->input('nome') ?>
            <?= $this->Form->input('ano') ?>
            <?= $this->Form->input('tipo', ['options'=>$tiposCompeticion]) ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
