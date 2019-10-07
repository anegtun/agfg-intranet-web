<div class="col-xs-12 login-form">
    <h2>Identifíquese</h2>
    <?= $this->Form->create() ?>
        <div class="form-group">
            <?= $this->Form->control('nome_usuario', array('class'=>'form-control','label'=>false)) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('contrasinal', array('class'=>'form-control','type'=>'password','label'=>false)) ?>
        </div>
        <?= $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn btn-primary')) ?>
    <?= $this->Form->end() ?>

    <?= $this->Flash->render('auth') ?>
</div>