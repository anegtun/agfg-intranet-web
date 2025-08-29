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
                    <th class="column-button"></th>
                    <th>Alcume</th>
                    <th>Nome público</th>
                    <th>Nome</th>
                    <th>NIF</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arbitros as $a) : ?>
                    <tr>
                        <td class="text-center">
                            <?php if($a->activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-user"></em></a>
                            <?php endif ?>
                        </td>
                        <td><?= $this->Html->link($a->alcume, ['action'=>'detalle', $a->id]) ?></td>
                        <td><?= $a->nome_publico ?></td>
                        <td><?= $a->nome ?></td>
                        <td><?= $a->nif ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $a->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
</div>
