<?php
$this->extend('template');

$this->set('submenu_option', 'eventos');
$this->set('cabeceiraTitulo', 'Calendario');
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Eventos']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Data</th>
                    <th class="celda-titulo">Lugar</th>
                    <th class="celda-titulo">Tipo</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($eventos as $e) : ?>
                    <tr>
                        <td><?= $this->Html->link($e->nome, ['action'=>'evento', $e->id]) ?></td>
                        <td><?= $e->data->format('Y-m-d') ?></td>
                        <td><?= $e->lugar ?></td>
                        <td><?= $tipos[$e->tipo] ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarEvento', $e->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), array('action'=>'evento'), array('class'=>'btn btn-primary')) ?>
    </div>
</div>
