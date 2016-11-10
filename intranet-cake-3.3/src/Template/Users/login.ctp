<?php $this->assign('title', 'Login'); ?>

<div class="users form">
    <?= $this->Flash->render('auth') ?>

    <?= $this->Form->create() ?>
        <fieldset>
            <legend>
                <?php echo __('Introduce o teu usuario e contrasinal'); ?>
            </legend>
            <?= $this->Form->input('username', array('label'=>'Usuario')) ?>
            <?= $this->Form->input('password', array('label'=>'Contrasinal')) ?>
            <?= $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn-primary')) ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
