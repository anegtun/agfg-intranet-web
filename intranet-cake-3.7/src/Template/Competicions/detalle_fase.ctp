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
                <li><?= $this->Html->link($competicion->nome, array('controller'=>'Competicions', 'action'=>'detalle', $competicion->id)) ?></li>
                <li class="active">Fase</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarFase'))) ?>
            <?= $this->Form->hidden('id') ?>
            <?= $this->Form->hidden('id_competicion') ?>
            <fieldset>
                <legend>Fase</legend>
                <div class="form-group">
                    <?= $this->Form->control('nome', array('class'=>'form-control','label'=>'Nome')) ?>
                </div>
                <div class="form-group">
                    <?php
                        $fasesHelper = array(''=>'');
                        foreach($outras_fases as $f) {
                            $fasesHelper[$f->id] = $f->nome;
                        }
                        echo $this->Form->control('id_fase_pai', array('options'=>$fasesHelper, 'class'=>'form-control','label'=>'Fase pai'))
                    ?>
                </div>

                <label>Equipas participantes</label>
                <?php
                    $equipasHelper = array();
                    foreach($equipas as $e) {
                        $equipasHelper[$e->id] = $e->nome;
                    }
                    echo $this->Form->control('equipas', array(
                        'label'=>false,
                        'multiple' => 'checkbox',
                        'options' => $equipasHelper,
                        'templates'=>[
                            'checkboxWrapper' => '{{label}}',
                            'nestingLabel' => '<label{{attrs}}>{{input}} {{text}}</label><br/>']
                    ));
                ?>

                <?= $this->Form->button('Gardar', array('class'=>'btn btn-primary')); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    
    <?php if(!empty($fase->id)) : ?>
        <div class="row" style="margin-top:2em;">
            <h3>Xornadas</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fase->xornadas as $x) : ?>
                        <tr>
                            <td><?= $x->numero ?></td>
                            <td><?= $x->data->format('Y-m-d'); ?></td>
                            <td class="text-center">
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'borrarXornada', $x->id),
                                    array('class'=>'glyphicon glyphicon-trash')) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Engadir xornada</button>
        </div>
    <?php endif ?>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarXornada'))) ?>
        <?= $this->Form->hidden('id', ['value'=>'']) ?>
        <?= $this->Form->hidden('id_fase', ['value'=>$fase->id]) ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xornada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('numero', array('class'=>'form-control','label'=>'Número')) ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('data', array('class'=>'form-control','label'=>'Data')) ?>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Gardar', array('class'=>'btn btn-primary')); ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pechar</button>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
