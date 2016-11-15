<?php $this->extend('/Users/template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Usuario</th>
        <th>Nome</th>
        <th>Rol</th>
        <th>Creado</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($users as $u) : ?>
        <tr>
            <td><?= $u->username ?></td>
            <td><?= $u->name ?></td>
            <td><?= $u->role ?></td>
            <td><?= $u->created ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action' => 'edit', $u->id]) ?></td>
            <td><?php //$this->Html->link('Eliminar', array('controller'=>'Users', 'action'=>'delete', $u['User']['id'])) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'add'), array('class'=>'btn btn-primary')) ?>
