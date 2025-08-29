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
                    <th class="column-button"></th>
                    <th>Nome</th>
                    <th class="text-center">Stock total</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $p) : ?>
                    <tr>
                        <td class="text-center">
                            <?php if($p->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-shopping-cart"></em></a>
                            <?php endif ?>
                        </td>
                        <td><?= $this->Html->link($p->nome, ['action'=>'produto', $p->id]) ?></td>
                        <td class="text-center"><?= $p->getStockTotal() ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarProduto', $p->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'produto'], ['class'=>'btn btn-primary']) ?>
</div>
