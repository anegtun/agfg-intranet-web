<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Horarios e resultados');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Horarios e resultados']
]);

$authUser = $this->request->getSession()->read('Auth.User');
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Tempada</th>
                    <th class="celda-titulo">Tipo</th>
                    <th class="celda-titulo">Código</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($competicions as $c) : ?>
                    <tr>
                        <?php if($authUser['rol'] !== 'euro22' || $c->codigo === 'euro22') : ?>
                            <td><?= $this->Html->link($c->nome, ['action'=>'competicion', $c->id]) ?></td>
                            <td><?= $tempadas[$c->tempada] ?></td>
                            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                            <td><?= $c->codigo ?></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
