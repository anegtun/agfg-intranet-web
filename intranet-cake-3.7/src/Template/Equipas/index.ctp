<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th></th>
        <th>Código</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($equipas as $e) : ?>
        <tr>
            <td><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
            <td><?= $e->codigo ?></td>
            <td><?= $e->nome ?></td>
            <td><?= $categorias[$e->categoria] ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detalle', $e->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'borrar', $e->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detalle'), array('class'=>'btn btn-primary')) ?>
