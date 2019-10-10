<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Equipas');
$this->set('cabeceiraMigas', [['label'=>'Equipas']]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo">Código</th>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Categoria</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipas as $e) : ?>
                        <tr>
                            <td class="text-center"><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
                            <td><?= $e->codigo ?></td>
                            <td><?= $e->nome ?></td>
                            <td><?= $categorias[$e->categoria] ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $e->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $e->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
</div>
