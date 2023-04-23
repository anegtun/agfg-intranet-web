<?php
$this->extend('template');
$this->set('submenu_option', 'pedidos');
$this->set('cabeceiraTitulo', 'Pedidos tenda');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Pedidos']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo" style="width:5px"></th>
                    <th class="celda-titulo">Data</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Nº items</th>
                    <th class="celda-titulo">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos as $p) : ?>
                    <tr>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'pedido', $p->id]) ?></td>
                        <td><?= $p->data->format('Y-m-d') ?></td>
                        <td><?= $p->nome ?></td>
                        <td><?= count($p->items) ?></td>
                        <td><?= $p->getTotal() ?>&euro;</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), array('action'=>'pedido'), array('class'=>'btn btn-primary')) ?>
    </div>
</div>
