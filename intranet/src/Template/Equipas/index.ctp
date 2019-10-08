<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Equipas</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false)) ?>    
                </li>
                <!--li><a href="#">MAQINT<span class="sr-only">Maqint</span></a></li-->
                <li class="active">Equipas</li>
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
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo">Código</th>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Categoria</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipas as $e) : ?>
                        <tr>
                            <td><?= empty($e->logo) ? '' : $this->Html->image($e->logo, array('width'=>30,'height'=>30)) ?></td>
                            <td><?= $e->codigo ?></td>
                            <td><?= $e->nome ?></td>
                            <td><?= $categorias[$e->categoria] ?></td>
                            <td class="text-center">
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'detalle', $e->id),
                                    array('class'=>'glyphicon glyphicon-pencil')) ?>
                            </td>
                            <td class="text-center">
                                <?= $this->Html->link(
                                    '',
                                    array('action'=>'borrar', $e->id),
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
