<?php $this->extend('template') ?>

<div class="container-full gray-bg">
    <div class="row page-header">
        <div class="col-xs-12 m-b-15">
            <h1>Competición</h1>
            <ol class="breadcrumb">
                <li>
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                        ['controller'=>'Main', 'action'=>'index'],
                        ['escape'=>false]) ?>    
                </li>
                <li>
                    <?= $this->Html->link('Competicións', ['controller'=>'Competicions', 'action'=>'index']) ?>    
                </li>
                <li class="active">Competición</li>
            </ol>
        </div>
    </div>
</div>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
    <?= $this->Form->create($competicion, ['url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Competición</legend>
                <div class="form-group">
                    <?= $this->Form->control('nome', ['class'=>'form-control','label'=>'Nome']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('tempada', ['options'=>array_merge([''=>''], $tempadas), 'class'=>'form-control','label'=>'Tempada']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('categoria', ['options'=>array_merge([''=>''], $categorias), 'class'=>'form-control','label'=>'Categoría']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('tipo', ['options'=>array_merge([''=>''], $tiposCompeticion), 'class'=>'form-control','label'=>'Tipo competición']) ?>
                </div>
                <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    <div class="row">
        <?php /*if(!empty($competicion->id)) : ?>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($competicion->fases as $f) : ?>
                    <tr>
                        <td><?= $f->nome ?></td>
                        <td><?= $f->tipo ?></td>
                        <td><?= $this->Html->link(__('Editar'), ['action'=>'detailFase', $f->id]) ?></td>
                        <td><?= $this->Html->link(__('Eliminar'), ['action'=>'deleteFase', $f->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <?= $this->Html->link(__('Crear'), ['action'=>'detailFase', 'idCompeticion'=>$competicion->id], ['class'=>'btn btn-primary']) ?>

        <?php endif*/ ?>
    </div>
</div>


