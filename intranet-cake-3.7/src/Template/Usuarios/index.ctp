<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Usuario</th>
        <th>Nome</th>
        <th>Rol</th>
        <th>Creado</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($usuarios as $u) : ?>
        <tr>
            <td><?= $u->nome_usuario ?></td>
            <td><?= $u->nome ?></td>
            <td><?= $u->rol ?></td>
            <td><?= $u->created ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action' => 'edit', $u->id]) ?></td>
            <td><?php //$this->Html->link('Eliminar', array('controller'=>'Users', 'action'=>'delete', $u['User']['id'])) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'add'), array('class'=>'btn btn-primary')) ?>
