<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Competicións');
$this->set('cabeceiraMigas', [['label'=>'Competicións']]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Tempada</th>
                        <th class="celda-titulo">Categoría</th>
                        <th class="celda-titulo">Tipo</th>
                        <th class="celda-titulo">UUID</th>
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
                            <td><?= $c->uuid ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $c->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
</div>