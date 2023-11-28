<?php
$this->extend('template');
$this->set('submenu_option', 'stock');
$this->set('cabeceiraTitulo', 'SKU');
$this->set('cabeceiraMigas', [
    ['label'=>'Tenda'],
    ['label'=>'Stock', 'url'=>['controller'=>'Tenda', 'action'=>'stock']],
    ['label'=>$sku->produto->nome],
    ['label'=>'SKU']
]);
?>

<div class="row">
    <?= $this->Form->create($sku, ['type'=>'post', 'url'=>['action'=>'gardarSku']]) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_produto') ?>
        <fieldset>
            <legend><?= $sku->produto->nome ?>: SKU</legend>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('stock', ['label'=>'Stock']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
