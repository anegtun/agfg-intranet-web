<?php
$this->extend('template');
$this->set('submenu_option', 'stock');
$this->set('cabeceiraTitulo', 'Stock tenda');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Stock']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo text-center">Stock total</th>
                    <th class="celda-titulo text-center">Activo</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $p) : ?>
                    <tr>
                        <td><?= $this->Html->link($p->nome, ['action'=>'produto', $p->id]) ?></td>
                        <td class="text-center"><?= $p->getStockTotal() ?></td>
                        <td class="text-center">
                            <?php if($p->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-shopping-cart"></em></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarProduto', $p->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), array('action'=>'produto'), array('class'=>'btn btn-primary')) ?>
    </div>
</div>
