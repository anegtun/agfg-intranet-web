<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Equipas</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        ['controller'=>'Main', 'action'=>'index'],
                        ['escape'=>false]) ?>    
                </li>
                <li><?= $this->Html->link('Equipas', ['controller'=>'Equipas', 'action'=>'index']) ?></li>
                <li class="active">Detalle</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($equipa, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Equipa</legend>
                <?= $this->Form->control('codigo', ['class'=>'form-control','label'=>'Código']) ?>
                <?= $this->Form->control('nome', ['class'=>'form-control','label'=>'Nome']) ?>
                <?= $this->Form->control('categoria', ['options'=>array_merge([],$categorias), 'class'=>'form-control','label'=>'Categoría']) ?>
                <?= $this->Form->control('logo', ['class'=>'form-control','label'=>'Logo']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>