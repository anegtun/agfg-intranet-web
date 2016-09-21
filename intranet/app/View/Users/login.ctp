<?php $this->assign('title', 'Login'); ?>

<div class="users form">
	<?php echo $this->Flash->render('auth'); ?>

	<?php echo $this->Form->create('User'); ?>
	    <fieldset>
	        <legend>
	            <?php echo __('Introduce o teu usuario e contrasinal'); ?>
	        </legend>
	        <?php
	        echo $this->Form->input('username', array('label' => 'Usuario'));
	        echo $this->Form->input('password', array('label' => 'Contrasinal'));
	        ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Entrar')); ?>
</div>