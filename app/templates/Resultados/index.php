<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Horarios e resultados');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Horarios e resultados']
]);

$authUser = $this->request->getAttribute('identity');
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="column-s"></th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Código</th>
                </tr>
            </thead>
            <tbody>
                <?php $tempada = ""; ?>
                <?php foreach($competicions as $c) : ?>
                    
                    <?php if ($tempada !== $c->tempada) : ?>
                        <th colspan="6" style="text-align: center; line-height: 30px; background-color: #eee">
                            <?= $tempadas[$c->tempada] ?>
                        </th>
                        <?php $tempada = $c->tempada; ?>
                    <?php endif ?>
                    
                    <tr>
                        <?php if($authUser['rol'] !== 'euro22' || $c->codigo === 'euro22') : ?>
                            <td><?= $this->AgfgForm->logo($c->federacion) ?></td>
                            <td><?= $this->Html->link($c->nome, ['action'=>'competicion', $c->id]) ?></td>
                            <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                            <td><?= $c->codigo ?></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
