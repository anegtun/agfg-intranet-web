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
</div>



<?php /*if(!empty($fase)) : ?>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Data</th>
            <th>Equipo 1</th>
            <th>Equipo 2</th>
        </tr>
        <?php foreach($fase->partidos as $p) : ?>
            <tr>
                <td><?= $p->data_partido ?></td>
                <td><?= $p->id_equipo1 ?></td>
                <td><?= $p->id_equipo2 ?></td>
            </tr>
        <?php endforeach ?>
    </table>

<?php endif*/ ?>