<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', 'Partidas orzamentarias');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas orzamentarias']
]);
?>

<div class="row">

    <?php foreach($partidasOrzamentarias as $po) : ?>
        <h2><a href="#partidaOrzamentaria-<?= $po->id ?>" data-toggle="collapse"><?= $po->nome ?></a></h2>

        <?= $this->AgfgForm->editButton(['action'=>'detallePartidaOrzamentaria', $po->id]) ?>
        <?= $this->AgfgForm->deleteButton(['action'=>'borrarPartidaOrzamentaria', $po->id]) ?>


        <div id="partidaOrzamentaria-<?= $po->id ?>" class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Área</th>
                        <th>Subárea</th>
                        <th class="column-button">Activa</th>
                        <th class="column-button"></th>
                        <th class="column-button"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($po->areas as $a) : ?>
                        <tr>
                            <td><?= $a->nome ?></td>
                            <td></td>
                            <td></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleArea', $a->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarArea', $a->id]) ?></td>
                        </tr>
                        <?php foreach($a->subareas as $s) : ?>
                            <tr>
                                <td></td>
                                <td><?= $s->nome ?></td>
                                <td class="text-success">
                                    <?php if(!empty($s->activa)) : ?>
                                        <span class="glyphicon glyphicon-euro">&nbsp;</span>
                                    <?php endif ?>
                                </td>
                                <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleSubarea', $s->id]) ?></td>
                                <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarSubarea', $s->id]) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <br/><br/>

    <?php endforeach ?>
</div>

<div class="row">
    <?= $this->Html->link(__('Crear partida orzamentaria'), ['action'=>'detallePartidaOrzamentaria'], ['class'=>'btn btn-primary']) ?>
    <?= $this->Html->link(__('Crear área'), ['action'=>'detalleArea'], ['class'=>'btn btn-secondary']) ?>
    <?= $this->Html->link(__('Crear subárea'), ['action'=>'detalleSubarea'], ['class'=>'btn btn-secondary']) ?>
</div>
