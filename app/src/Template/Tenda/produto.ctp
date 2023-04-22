<?php
$this->extend('template');
$this->set('submenu_option', 'stock');
$this->set('cabeceiraTitulo', 'Produto');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Stock', 'url'=>['controller'=>'Tenda', 'action'=>'stock']],
    ['label'=>'Produto']
]);
?>

<div class="row">
    <?= $this->Form->create($produto, ['type'=>'post', 'url'=>['action'=>'gardarProduto']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Produto</legend>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('prezo', ['label'=>'Prezo']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>



<?php if(!empty($produto->id)) : ?>

    <div class="row" style="margin-top:2em;">
        <h3>SKUs</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Stock</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produto->skus as $s) : ?>
                    <tr>
                        <td><?= $s->nome ?></td>
                        <td><?= $s->stock ?></td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'sku', $s->id]) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarSku', $s->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            <tbody>
        </table>
        <?= $this->Html->link('Engadir SKU', ['action'=>'sku', 'id_produto'=>$produto->id], ['class'=>'btn btn-primary']) ?>
    </div>

<?php endif ?>