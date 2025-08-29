<div class="login-form">
    <h2>Identifíquese</h2>
    <?= $this->Form->create() ?>
        <div class="form-group">
            <?= $this->Form->control('nome_usuario', ['class'=>'form-control','label'=>false]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('contrasinal', ['class'=>'form-control','type'=>'password','label'=>false]) ?>
        </div>
        <?= $this->Form->button('Entrar', ['type'=>'submit', 'class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

    <?= $this->Flash->render('auth') ?>
</div>