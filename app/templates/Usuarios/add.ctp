<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($usuario, array('type'=>'post')) ?>
        <fieldset>
            <legend><?= __('Engadir usuario') ?></legend>
            <?= $this->Form->input('nome_usuario') ?>
            <?= $this->Form->input('contrasinal') ?>
            <?= $this->Form->input('rol', array(
                'options' => array('admin' => 'Admin', 'author' => 'Author')
            )) ?>
        </fieldset>
    <?= $this->Form->button(__('Gardar')); ?>
    <?= $this->Form->end() ?>
</div>
