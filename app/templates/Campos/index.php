<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Campos');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Campos']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="column-button"></th>
                    <th>Pobo</th>
                    <th>Nome</th>
                    <th>Nome curto</th>
                    <th>Código</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($campos as $c) : ?>
                    <tr>
                        <td class="text-center">
                            <?php if($c->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-flag"></em></a>
                            <?php endif ?>
                        </td>
                        <td><?= $c->pobo ?></td>
                        <td><?= $this->Html->link($c->nome, ['action'=>'detalle', $c->id]) ?></td>
                        <td><?= $c->nome_curto ?></td>
                        <td><?= $c->codigo ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
</div>
