<?php $this->assign('title', 'Login'); ?>

<div class="users form">
    <?= $this->Flash->render('auth') ?>

    <?= $this->Form->create() ?>
        <fieldset>
            <legend>
                <?php echo __('Introduce o teu usuario e contrasinal'); ?>
            </legend>
            <?= $this->Form->input('nome_usuario', array('label'=>'Usuario')) ?>
            <?= $this->Form->input('contrasinal', array('label'=>'Contrasinal', 'type'=>'password')) ?>
            <?= $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn btn-primary')) ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
