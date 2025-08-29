<?php
$this->extend('template');
$this->set('submenu_option', 'demanda');
$this->set('cabeceiraTitulo', 'Demanda tenda');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Demanda']
]);
?>

<?php foreach($estados as $id_estado=>$estado) : ?>

    <?php
    $itemsEstado = [];

    foreach ($items as $item) {
        if ($item->pedido->estado == $id_estado) {
            $demanda = empty($itemsEstado[$item->sku->id]->demanda) ? $item->cantidade : $itemsEstado[$item->sku->id]->demanda + $item->cantidade;
            $persoalizado = !empty($item->persoalizacion) || !empty($itemsEstado[$item->sku->id]->persoalizado);
            $itemsEstado[$item->sku->id] = (object) [
                'id_sku' => $item->sku->id,
                'nome' => "{$item->sku->produto->nome} - {$item->sku->nome}",
                'estado' => $estados[$item->pedido->estado],
                'demanda' => $demanda,
                'persoalizado' => $persoalizado,
                'stock' => $item->sku->stock
            ];
        }
    }

    usort($itemsEstado, function($a, $b) { return strcmp($a->nome, $b->nome); });
    ?>

    <?php if(!empty($itemsEstado)) : ?>

        <h2><?= $estado ?></h2>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="column-button"></th>
                            <th>Produto</th>
                            <th class="column-s">Demanda</th>
                            <th class="column-s">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalDemanda = 0 ?>
                        <?php $totalStock = 0 ?>
                        <?php foreach($itemsEstado as $item) : ?>
                            <?php $totalDemanda += $item->demanda ?>
                            <?php $totalStock += $item->stock ?>
                            <tr>
                                <td class="text-center">
                                    <a href="javascript:void(0)"><em class="glyphicon glyphicon-shopping-cart" data-toggle="modal" data-target="#modal-pedidos-<?= "{$id_estado}_{$item->id_sku}" ?>"></em></a>
                                </td>
                                <td><?= $item->nome ?></td>
                                <td><?= $item->demanda ?> <?= empty($item->persoalizado) ? "" : " *" ?></td>
                                <td><?= $item->stock ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>TOTAL</th>
                            <th><?= $totalDemanda ?></th>
                            <th><?= $totalStock ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>



        <?php foreach($itemsEstado as $item) : ?>

            <div id="modal-pedidos-<?= "{$id_estado}_{$item->id_sku}" ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= $item->nome ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="column-button"></th>
                                            <th>Data</th>
                                            <th>Nome</th>
                                            <th class="column-s">Cantidade</th>
                                            <th>Persoalización</th>
                                            <th>T. envío</th>
                                            <th>Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $itemPedido = array_filter($items, function ($i) use ($item, $id_estado) {
                                            return $i->sku->id === $item->id_sku && $i->pedido->estado === $id_estado;
                                        });
                                        ?>
                                        <?php foreach($itemPedido as $i) : ?>
                                            <tr>
                                                <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'pedido', $i->pedido->id]) ?></td>
                                                <td><?= $i->pedido->data->format('Y-m-d') ?></td>
                                                <td><?= $i->pedido->nome ?></td>
                                                <td><?= $i->cantidade ?></td>
                                                <td><?= $i->persoalizacion ?></td>
                                                <td><?= empty($i->pedido->tipo_envio) ? '' : $tipos_envio[$i->pedido->tipo_envio] ?></td>
                                                <td class="text-center">
                                                    <?php if($i->pedido->pago) : ?>
                                                        <a href="javascript:void(0)"><em class="glyphicon glyphicon-euro"></em></a>
                                                    <?php endif ?>
                                                </td>
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

    <?php endif ?>

<?php endforeach ?>