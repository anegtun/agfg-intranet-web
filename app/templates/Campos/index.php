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
                    <th class="celda-titulo">Pobo</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Nome curto</th>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($campos as $c) : ?>
                    <tr>
                        <td><?= $c->pobo ?></td>
                        <td><?= $this->Html->link($c->nome, ['action'=>'detalle', $c->id]) ?></td>
                        <td><?= $c->nome_curto ?></td>
                        <td><?= $c->codigo ?></td>
                        <td class="text-center">
                            <?php if($c->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-flag"></em></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
