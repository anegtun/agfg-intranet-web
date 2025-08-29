<?php
$this->extend('template');

$this->set('submenu_option', 'eventos');
$this->set('cabeceiraTitulo', 'Calendario');
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Eventos']
]);

$agora = $this->Time->fromString(time());
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Lugar</th>
                    <th>Tipo</th>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($eventos as $e) : ?>
                    <tr class="<?= $e->data->greaterThan($agora) ? '' : 'text-muted' ?>">
                        <td><?= $this->Html->link($e->nome, ['action'=>'evento', $e->id]) ?></td>
                        <td><?= $e->data->format('Y-m-d') ?></td>
                        <td><?= $e->lugar ?></td>
                        <td><?= $tipos[$e->tipo] ?></td>
                        <td class="text-center"><?= $this->Html->link('', ['action'=>'clonarEvento', $e->id], ['class'=>'glyphicon glyphicon-duplicate']) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarEvento', $e->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'evento'], ['class'=>'btn btn-primary']) ?>
</div>
