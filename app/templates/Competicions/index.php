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
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="column-s"></th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php $tempada = ""; ?>
                <?php foreach($competicions as $c) : ?>

                    <?php if ($tempada !== $c->tempada) : ?>
                        <th colspan="6" style="text-align: center; line-height: 30px; background-color: #eee">
                            <?= $tempadas[$c->tempada] ?>
                        </th>
                        <?php $tempada = $c->tempada; ?>
                    <?php endif ?>
                    
                    <tr>
                        <td><?= $this->AgfgForm->logo($c->federacion) ?></td>
                        <td><?= $this->Html->link($c->nome, ['action'=>'detalle', $c->id]) ?></td>
                        <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                        <td><?= $c->codigo ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
