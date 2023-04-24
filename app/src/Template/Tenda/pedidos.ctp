<?php
$this->extend('template');
$this->set('submenu_option', 'pedidos');
$this->set('cabeceiraTitulo', 'Pedidos tenda');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Pedidos']
]);
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('todos', ['options'=>['P'=>'Pendentes', 'F'=>'Finalizados', 'T'=>'Todos'], 'label'=>'']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary', 'style'=> ['margin-top: 1.7em']]); ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo" style="width:5px"></th>
                    <th class="celda-titulo">Data</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Estado</th>
                    <th class="celda-titulo">Nº items</th>
                    <th class="celda-titulo text-right">Total</th>
                    <th class="celda-titulo">T. envío</th>
                    <th class="celda-titulo text-right">G. envío</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos as $p) : ?>
                    <?php $total = $p->getTotal() ?>
                    <tr 
                        <?= in_array($p->estado, ['D','NC']) ? 'class="text-danger"' : '' ?>
                        <?= in_array($p->estado, ['E']) ? 'class="text-success"' : '' ?>
                    >
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'pedido', $p->id]) ?></td>
                        <td><?= $p->data->format('Y-m-d') ?></td>
                        <td><?= $p->nome ?></td>
                        <td><?= $estados[$p->estado] ?></td>
                        <td><?= count($p->items) ?></td>
                        <td class="text-right"><?= isset($total) ? ($this->Number->precision($total, 2)." &euro;") : '-' ?></td>
                        <td><?= empty($p->tipo_envio) ? '' : $tipos_envio[$p->tipo_envio] ?></td>
                        <td class="text-right"><?= isset($p->gastos_envio) ? ($this->Number->precision($p->gastos_envio, 2)." &euro;") : '-' ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), array('action'=>'pedido'), array('class'=>'btn btn-primary')) ?>
    </div>
</div>
