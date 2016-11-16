<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Logo</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($equipas as $e) : ?>
        <tr>
            <td><?= $e->codigo ?></td>
            <td><?= $e->nome ?></td>
            <td><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detail', $e->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'delete', $e->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detail'), array('class'=>'btn btn-primary')) ?>
