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
                <!--li><a href="#">MAQINT<span class="sr-only">Maqint</span></a></li-->
                <li class="active">Equipas</li>
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
                            <td><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
                            <td><?= $e->codigo ?></td>
                            <td><?= $e->nome ?></td>
                            <td><?= $categorias[$e->categoria] ?></td>
                            <td>
                                <?= $this->Html->link(
                                    '',
                                    ['action'=>'detalle', $e->id],
                                    ['class'=>'glyphicon glyphicon-pencil']) ?>
                            </td>
                            <td>
                                <?= $this->Html->link(
                                    '',
                                    ['action'=>'borrar', $e->id],
                                    ['class'=>'glyphicon glyphicon-trash']) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Crear'), array('action'=>'detalle'), array('class'=>'btn btn-primary')) ?>
        </div>
    </div>
</div>