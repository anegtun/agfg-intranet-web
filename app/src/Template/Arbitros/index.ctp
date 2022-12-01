<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Árbitros');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Árbitros']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Alcume</th>
                    <th class="celda-titulo">NIF</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arbitros as $a) : ?>
                    <tr>
                        <td><?= $this->Html->link($a->alcume, ['action'=>'detalle', $a->id]) ?></td>
                        <td><?= $a->nif ?></td>
                        <td><?= $a->nome ?></td>
                        <td class="text-center">
                            <?php if($a->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-user"></em></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $a->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), array('action'=>'detalle'), array('class'=>'btn btn-primary')) ?>
    </div>
</div>
