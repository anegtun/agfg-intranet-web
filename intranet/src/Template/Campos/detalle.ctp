<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Campos</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false)) ?>    
                </li>
                <li><?= $this->Html->link('Campos', array('controller'=>'Campos', 'action'=>'index')) ?></li>
                <li class="active">Campo</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($campo, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Campo</legend>
                <div class="form-group">
                    <?= $this->Form->control('codigo', ['class'=>'form-control','label'=>'Código']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('nome', ['class'=>'form-control','label'=>'Nome']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('pobo', ['class'=>'form-control','label'=>'Poboación']) ?>
                </div>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>