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
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Estado</th>
                    <th>Pago</th>
                    <th>Nº items</th>
                    <th class="text-right">Total</th>
                    <th>T. envío</th>
                    <th class="text-right">G. envío</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos as $k => $p) : ?>
                    <?php $total = $p->getTotal() ?>
                    <tr 
                        <?= in_array($p->estado, ['D','NC']) ? 'class="text-danger"' : '' ?>
                        <?= in_array($p->estado, ['E']) ? 'class="text-success"' : '' ?>
                    >
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'pedido', $p->id]) ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0)"><em class="glyphicon glyphicon-shopping-cart" data-toggle="modal" data-target="#modal-pedido-detalle-<?= $k ?>"></em></a>
                        </td>
                        <td><?= $p->data->format('Y-m-d') ?></td>
                        <td><?= $p->nome ?></td>
                        <td><?= $estados[$p->estado] ?></td>
                        <td class="text-center">
                            <?php if($p->pago) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-euro"></em></a>
                            <?php endif ?>
                        </td>
                        <td><?= count($p->items) ?></td>
                        <td class="text-right"><?= isset($total) ? ($this->Number->precision($total, 2)." &euro;") : '-' ?></td>
                        <td><?= empty($p->tipo_envio) ? '' : $tipos_envio[$p->tipo_envio] ?></td>
                        <td class="text-right"><?= isset($p->gastos_envio) ? ($this->Number->precision($p->gastos_envio, 2)." &euro;") : '-' ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'pedido'], ['class'=>'btn btn-primary']) ?>
</div>



<?php foreach($pedidos as $k => $p) : ?>

    <div id="modal-pedido-detalle-<?= $k ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= $p->nome ?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Cantidade</th>
                                    <th>Persoalización</th>
                                    <th class="text-right">Prezo</th>
                                    <th class="text-right">Prezo extra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($p->items as $i) : ?>
                                    <tr>
                                        <td><?= $i->sku->produto->nome ?> - <?= $i->sku->nome ?> (stock: <?=  $i->sku->stock ?>)</td>
                                        <td><?= $i->cantidade ?></td>
                                        <td><?= $i->persoalizacion ?></td>
                                        <td class="text-right"><?= $this->Number->precision($i->getPrezo(), 2) ?>&euro;</td>
                                        <td class="text-right"><?= $this->Number->precision($i->prezo_extra, 2) ?>&euro;</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php endforeach ?>