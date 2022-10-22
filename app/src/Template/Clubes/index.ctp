<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Clubes');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Clubes']
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>



<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('id_federacion', ['options'=>$this->AgfgForm->objectToKeyValue($federacions,'id','codigo'), 'label'=>'Federación', 'templates'=>$emptyTemplates]) ?>
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
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo">Federacións</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clubes as $c) : ?>
                    <tr>
                        <td class="text-center"><?= empty($c->logo) ? '' : $this->Html->image($c->logo, ['width'=>30,'height'=>30]) ?></td>
                        <td><?= $c->codigo ?></td>
                        <td><?= $c->nome ?></td>
                        <td>
                            <?php foreach($c->federacions as $f) : ?>
                                <?= $f->codigo ?>,
                            <?php endforeach ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $c->id]) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $c->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $this->Html->link(__('Crear'), ['action'=>'detalle'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
