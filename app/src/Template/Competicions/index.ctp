<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Competicións');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Administrar']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo">Tempada</th>
                    <th class="celda-titulo">Tipo</th>
                    <th class="celda-titulo">Federación</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($competicions as $c) : ?>
                    <tr>
                        <td><?= $this->Html->link($c->nome, ['action'=>'detalle', $c->id]) ?></td>
                        <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                        <td><?= $tempadas[$c->tempada] ?></td>
                        <td><?= $c->codigo ?></td>
                        <td><?= empty($c->federacion) ? '' : $c->federacion->codigo ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
