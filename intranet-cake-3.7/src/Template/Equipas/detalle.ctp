<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($equipa, ['url'=>['action'=>'gardar']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Equipa') ?></legend>
			<?= $this->Form->input('codigo') ?>
			<?= $this->Form->input('nome') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>