<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Horarios e resultados');
$this->set('cabeceiraMigas', [['label'=>'Horarios e resultados']]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Tempada</th>
                        <th class="celda-titulo">Categoría</th>
                        <th class="celda-titulo">Tipo</th>
                        <th class="celda-titulo">UUID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($competicions as $c) : ?>
                        <tr>
                            <td><?= $this->Html->link($c->nome, ['action'=>'competicion', $c->id]) ?></td>
                            <td><?= $tempadas[$c->tempada] ?></td>
                            <td><?= empty($c->categoria) ? '' : $categorias[$c->categoria] ?></td>
                            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                            <td><?= $c->uuid ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>