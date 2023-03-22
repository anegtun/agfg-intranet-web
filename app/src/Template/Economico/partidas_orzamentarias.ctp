<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', 'Partidas orzamentarias');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas orzamentarias']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Área</th>
                    <th class="celda-titulo">Subárea</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($partidasOrzamentarias as $po) : ?>
                    <tr>
                        <th colspan='2'><?= $po->nome ?></th>
                        <th class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detallePartidaOrzamentaria', $po->id]) ?></th>
                        <th class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarPartidaOrzamentaria', $po->id]) ?></th>
                    </tr>
                    <?php foreach($po->areas as $a) : ?>
                        <tr>
                            <td><?= $a->nome ?></td>
                            <td></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleArea', $a->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarArea', $a->id]) ?></td>
                        </tr>
                        <?php foreach($a->subareas as $s) : ?>
                            <tr>
                                <td></td>
                                <td><?= $s->nome ?></td>
                                <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleSubarea', $s->id]) ?></td>
                                <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarSubarea', $s->id]) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endforeach ?>

                <?php if(!$areas->isEmpty()) : ?>
                    <tr>
                        <th colspan='4'>Sen clasificar</th>
                    </tr>
                    <?php foreach($areas as $a) : ?>
                        <tr>
                            <td><?= $a->nome ?></td>
                            <td></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleArea', $a->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarArea', $a->id]) ?></td>
                        </tr>
                        <?php foreach($a->subareas as $s) : ?>
                            <tr>
                                <td></td>
                                <td><?= $s->nome ?></td>
                                <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleSubarea', $s->id]) ?></td>
                                <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarSubarea', $s->id]) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear partida orzamentaria'), ['action'=>'detallePartidaOrzamentaria'], ['class'=>'btn btn-primary']) ?>
        <?= $this->Html->link(__('Crear área'), ['action'=>'detalleArea'], ['class'=>'btn btn-secondary']) ?>
        <?= $this->Html->link(__('Crear subárea'), ['action'=>'detalleSubarea'], ['class'=>'btn btn-secondary']) ?>
    </div>
</div>
