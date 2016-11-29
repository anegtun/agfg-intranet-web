<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($competicion, ['url'=>['action'=>'save']]) ?>
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

<?php if(!empty($competicion)) : ?>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($competicion->fases as $f) : ?>
            <tr>
                <td><?= $f->nome ?></td>
                <td><?= $f->tipo ?></td>
                <td><?= $this->Html->link(__('Editar'), ['action'=>'detail', $f->id]) ?></td>
                <td><?= $this->Html->link(__('Eliminar'), ['action'=>'delete', $f->id]) ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <?= $this->Html->link(__('Crear'), ['action'=>'detail', 'idCompeticion'=>$f->id], ['class'=>'btn btn-primary']) ?>

<?php endif ?>