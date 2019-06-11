<?php $this->extend('template') ?>

<table class="table table-striped table-bordered table-hover">
    <tr>    
        <th>Nome</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($clubes as $c) : ?>
        <tr>
            <td><?= $c->nome ?></td>
            <!--td><?= empty($c->logo) ? '' : $this->Html->image($c->logo, ['width'=>30,'height'=>30]) ?></td-->
            <td><?= $this->Html->link(__('Editar'), ['action'=>'detalle', $c->id]) ?></td>
            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'borrar', $c->id]) ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?= $this->Html->link(__('Crear'), array('action'=>'detalle'), array('class'=>'btn btn-primary')) ?>
