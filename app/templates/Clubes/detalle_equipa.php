<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Equipa');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Clubes', 'url'=>['controller'=>'Clubes', 'action'=>'index']],
    ['label'=>$equipa->clube->nome, 'url'=>['controller'=>'Clubes', 'action'=>'detalle', $equipa->clube->id]],
    ['label'=>empty($equipa->id) ? 'Nova equipa' : $equipa->nome]
]);
?>

<div class="row">
    <?= $this->Form->create($equipa, ['type'=>'post', 'url'=>['action'=>'gardarEquipa']]) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_clube') ?>
        <fieldset>
            <legend><?= empty($equipa->id) ? "Nova equipa de {$equipa->clube->nome}" : $equipa->nome ?></legend>
            <?= $this->Form->control('codigo', ['label'=>'Código']) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('nome_curto', ['label'=>'Nome curto']) ?>
            <?= $this->Form->control('categoria', ['options'=>$categorias, 'label'=>'Categoría']) ?>
            <?= $this->Form->control('logo', ['label'=>'Logo']) ?>
            <div class="form-group">
                <?= $this->Form->checkbox('activo', ['id'=>'activo' ]) ?>
                <label for="activo">Activo</label>
            </div>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
