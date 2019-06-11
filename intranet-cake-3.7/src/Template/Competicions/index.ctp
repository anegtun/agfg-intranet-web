<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Nome</th>
        <th>Ano</th>
        <th>Tipo</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($competicions as $c) : ?>
        <tr>
            <td><?= $c->nome ?></td>
            <td><?= $c->ano ?></td>
            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detail', $c->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'delete', $c->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detail'), array('class'=>'btn btn-primary')) ?>
