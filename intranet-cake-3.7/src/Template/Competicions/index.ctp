<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Nome</th>
        <th>Tempada</th>
        <th>Categoría</th>
        <th>Tipo</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($competicions as $c) : ?>
        <tr>
            <td><?= $c->nome ?></td>
            <td><?= $tempadas[$c->tempada] ?></td>
            <td><?= empty($c->categoria) ? '' : $categorias[$c->categoria] ?></td>
            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detalle', $c->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'delete', $c->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detail'), array('class'=>'btn btn-primary')) ?>
