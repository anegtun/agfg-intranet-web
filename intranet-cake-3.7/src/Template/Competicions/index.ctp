<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Competicións</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false)) ?>    
                </li>
                <li class="active">Competicións</li>
            </ol>
        </div>
    </div>
</div>



<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Tempada</th>
                        <th class="celda-titulo">Categoría</th>
                        <th class="celda-titulo">Tipo</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($competicions as $c) : ?>
                        <tr>
                            <td><?= $c->nome ?></td>
                            <td><?= $tempadas[$c->tempada] ?></td>
                            <td><?= empty($c->categoria) ? '' : $categorias[$c->categoria] ?></td>
                            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                            <td>
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'detalle', $c->id),
                                    array('class'=>'glyphicon glyphicon-pencil')) ?>
                            </td>
                            <td>
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