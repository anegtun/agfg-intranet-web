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
                    <th class="column-button"></th>
                    <th class="column-s">Código</th>
                    <th>Nome</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($federacions as $f) : ?>
                    <tr>
                        <td class="text-center"><?= $this->AgfgForm->logo($f) ?></td>
                        <td><?= $f->codigo ?></td>
                        <td><?= $this->Html->link($f->nome, ['action'=>'detalle', $f->id]) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $f->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
</div>
