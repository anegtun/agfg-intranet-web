<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Clubes');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Clubes']
]); 
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('id_federacion', ['options'=>$this->AgfgForm->objectToKeyValue($federacions,'id','codigo'), 'label'=>'Federación']) ?>
            </div>
        </div>
        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="column-s"></th>
                    <th class="column-s">Activo</th>
                    <th class="column-s">Código</th>
                    <th>Nome</th>
                    <th>Federacións</th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clubes as $c) : ?>
                    <tr>
                        <td class="text-center"><?= $this->AgfgForm->logo($c) ?></td>
                        <td class="text-center">
                            <?php $activo = false ?>
                            <?php foreach($c->equipas as $e) : ?>
                                <?php $activo = $activo || $e->activo ?>
                            <?php endforeach ?>
                            <?php if($activo) : ?>
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-user"></em></a>
                            <?php endif ?>
                        </td>
                        <td><?= $c->codigo ?></td>
                        <td><?= $this->Html->link($c->nome, ['action'=>'detalle', $c->id]) ?></td>
                        <td>
                            <?php foreach($c->federacions as $f) : ?>
                                <?= $this->AgfgForm->logo($f) ?>
                            <?php endforeach ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
</div>
