<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Áreas');
$this->set('cabeceiraMigas', [['label'=>'Áreas']]);
?>

<div class="container-full" style="margin-top:2em;">
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
                    <?php foreach($areas as $a) : ?>
                        <tr>
                            <td><?= $a->nome ?></td>
                            <td></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleArea', $a->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarArea', $a->id]) ?></td>
                        </tr>
                        <?php foreach($subareas as $s) : ?>
                            <?php if($s->id_area===$a->id) : ?>
                                <tr>
                                    <td></td>
                                    <td><?= $s->nome ?></td>
                                    <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleSubarea', $s->id]) ?></td>
                                    <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarSubarea', $s->id]) ?></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Crear área'), ['action'=>'detalleArea'], ['class'=>'btn btn-primary']) ?>
            <?= $this->Html->link(__('Crear subárea'), ['action'=>'detalleSubarea'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
</div>
