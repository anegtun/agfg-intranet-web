<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Árbitros</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false)) ?>    
                </li>
                <li><?= $this->Html->link('Árbitros', array('controller'=>'Arbitros', 'action'=>'index')) ?></li>
                <li class="active">Detalle</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($arbitro, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Árbitro</legend>
                <div class="form-group">
                    <?= $this->Form->control('alcume', ['class'=>'form-control','label'=>'Alcume']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('nif', ['class'=>'form-control','label'=>'NIF']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('nome', ['class'=>'form-control','label'=>'Nome completo']) ?>
                </div>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>