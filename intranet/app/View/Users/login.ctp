<?php $this->assign('title', 'Login'); ?>

<div class="users form">
	<?php echo $this->Flash->render('auth'); ?>

	<?php echo $this->Form->create('User'); ?>
	    <fieldset>
	        <legend>
	            <?php echo __('Introduce o teu usuario e contrasinal'); ?>
	        </legend>
	        <?php
	        echo $this->Form->input('username', array('label'=>'Usuario'));
	        echo $this->Form->input('password', array('label'=>'Contrasinal'));
	        echo $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn-primary'));
	        ?>
	    </fieldset>
	<?php echo $this->Form->end(); ?>
</div>