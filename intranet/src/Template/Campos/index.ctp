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
                <li class="active">Campos</li>
            </ol>
        </div>
    </div>
</div>



<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Código</th>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Pobo</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($campos as $c) : ?>
                        <tr>
                            <td><?= $c->codigo ?></td>
                            <td><?= $c->nome ?></td>
                            <td><?= $c->pobo ?></td>
                            <td class="text-center">
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'detalle', $c->id),
                                    array('class'=>'glyphicon glyphicon-pencil')) ?>
                            </td>
                            <td class="text-center">
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'borrar', $c->id),
                                    array('class'=>'glyphicon glyphicon-trash')) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Crear'), array('action'=>'detalle'), array('class'=>'btn btn-primary')) ?>
        </div>
    </div>
</div>
