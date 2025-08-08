<?php
$this->extend('template');

$this->set('submenu_option', 'tempadas');
$this->set('cabeceiraTitulo', 'Calendario');
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Tempadas']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tempadas as $t) : ?>
                    <tr>
                        <td><?= $this->Html->link($t->codigo, ['action'=>'tempada', $t->codigo]) ?></td>
                        <td><?= $t->nome ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarTempada', $t->codigo]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'tempada'], ['class'=>'btn btn-primary']) ?>
</div>
