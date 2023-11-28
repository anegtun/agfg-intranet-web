<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Federacións');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Federacións']
]);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($federacions as $f) : ?>
                    <tr>
                        <td class="text-center"><?= empty($f->logo) ? '' : $this->Html->image($f->logo, ['width'=>30,'height'=>30]) ?></td>
                        <td><?= $f->codigo ?></td>
                        <td><?= $f->nome ?></td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $f->id]) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $f->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
