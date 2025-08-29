<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Competicións');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións']
]);

$authUser = $this->request->getAttribute('identity');
$is_admin = $authUser['rol'] === 'admin';
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="column-s"></th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th class="column-button"></th>
                    <?php if($is_admin) : ?>
                        <th class="column-button"></th>
                        <th class="column-button"></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php $tempada = ""; ?>
                <?php $colspan = $is_admin ? "7" : "5"; ?>
                <?php foreach($competicions as $c) : ?>

                    <?php if ($tempada !== $c->tempada) : ?>
                        <th colspan="<?= $colspan ?>" style="text-align: center; line-height: 30px; background-color: #eee">
                            <?= $tempadas[$c->tempada] ?>
                        </th>
                        <?php $tempada = $c->tempada; ?>
                    <?php endif ?>
                    
                    <tr>
                        <td><?= $this->AgfgForm->logo($c->federacion) ?></td>
                        <td><?= $c->nome ?></td>
                        <td><?= empty($c->tipo) ? '' : $tiposCompeticion[$c->tipo] ?></td>
                        <td><?= $c->codigo ?></td>
                        <td><?= $this->Html->link('', ['controller'=>'Resultados', 'action'=>'competicion', $c->id], ['class'=>'glyphicon glyphicon-flag']) ?></td>
                        <?php if($is_admin) : ?>
                            <td><?= $this->Html->link('', ['action'=>'detalle', $c->id], ['class'=>'glyphicon glyphicon-cog']) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
