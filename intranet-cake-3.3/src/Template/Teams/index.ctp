<?php $this->extend('/Teams/template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($teams as $t) : ?>
        <tr>
            <td><?= $t->codigo ?></td>
            <td><?= $t->nome ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detail', $t->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'delete', $t->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detail'), array('class'=>'btn btn-primary')) ?>
