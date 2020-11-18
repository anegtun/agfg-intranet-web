<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Movementos');
$this->set('cabeceiraMigas', [['label'=>'Movementos']]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Data</th>
                        <th class="celda-titulo">Importe</th>
                        <th class="celda-titulo">Tempada</th>
                        <th class="celda-titulo">Conta</th>
                        <th class="celda-titulo">Área</th>
                        <th class="celda-titulo">Subárea</th>
                        <th class="celda-titulo">Observacións</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($movementos as $m) : ?>
                        <tr>
                            <td><?= $m->data->format('Y-m-d') ?></td>
                            <td><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                            <td><?= $tempadas[$m->tempada] ?></td>
                            <td><?= $contas[$m->conta] ?></td>
                            <td><?= $m->subarea->area->nome ?></td>
                            <td><?= $m->subarea->nome ?></td>
                            <td><?= $m->descricion ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $m->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $m->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Novo movemento'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
</div>
