<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Competición</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false)) ?>    
                </li>
                <li><?= $this->Html->link('Competicións', array('controller'=>'Competicions', 'action'=>'index')) ?></li>
                <li class="active">Competición</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
    <?= $this->Form->create($competicion, array('type'=>'post', 'url'=>array('action'=>'gardar'))) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Competición</legend>
                <div class="form-group">
                    <?= $this->Form->control('nome', array('class'=>'form-control','label'=>'Nome')) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('tempada', array('options'=>array_merge(array(''=>''), $tempadas), 'class'=>'form-control','label'=>'Tempada')) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('categoria', array('options'=>array_merge(array(''=>''), $categorias), 'class'=>'form-control','label'=>'Categoría')) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('tipo', array('options'=>array_merge(array(''=>''), $tiposCompeticion), 'class'=>'form-control','label'=>'Tipo competición')) ?>
                </div>
                <?= $this->Form->button('Gardar', array('class'=>'btn btn-primary')); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    
    <?php if(!empty($competicion->id)) : ?>
        <div class="row" style="margin-top:2em;">
            <h3>Fases</h3>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($competicion->fases as $f) : ?>
                    <tr>
                        <td><?= $f->nome ?></td>
                        <td>
                            <?= $this->Html->link(
                                '',
                                array('action'=>'detalleFase', $f->id),
                                array('class'=>'glyphicon glyphicon-pencil')) ?>
                        </td>
                        <td>
                            <?= $this->Html->link(
                                '',
                                array('action'=>'borrarFase', $f->id),
                                array('class'=>'glyphicon glyphicon-trash')) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <?= $this->Html->link('Crear', ['action'=>'detalleFase', 'idCompeticion'=>$competicion->id], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php endif ?>
    
</div>
