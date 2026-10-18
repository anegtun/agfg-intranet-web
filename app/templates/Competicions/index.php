<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Competicións');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións']
]);

$authUser = $this->request->getAttribute('identity');
$is_admin = $authUser['rol'] === 'admin';
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query', 'context'])->create(null, ['type' => 'get']) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('id_federacion', [
                    'options' => $this->AgfgForm->objectToKeyValue($federacions, 'id', 'nome'),
                    'label' => 'Federación',
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('tipo', [
                    'options' => array_merge(['' => ''], $tiposCompeticion),
                    'label' => 'Tipo de competición',
                ]) ?>
            </div>
        </div>
        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class' => 'btn btn-primary']); ?>
        </div>
    <?= $this->Form->end() ?>
</div>

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
                    <th class="column-button"></th>
                    <?php if($is_admin) : ?>
                        <th class="column-button"></th>
                        <th class="column-button"></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php $tempada = ""; ?>
                <?php $colspan = $is_admin ? "8" : "6"; ?>
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
                        <td class="text-center">
                            <?php if(empty($c->finalizada)) : ?>
                                <span class="glyphicon glyphicon-fire text-danger" title="Competición non finalizada" aria-label="Competición non finalizada"></span>
                            <?php endif ?>
                        </td>
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
