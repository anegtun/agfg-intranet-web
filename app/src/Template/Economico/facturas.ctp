<?php
$this->extend('template');
$this->set('submenu_option', 'facturas');
$this->set('cabeceiraTitulo', 'Facturas');
$this->set('cabeceiraMigas', [
    ['label'=>'Contabilidade'],
    ['label'=>'Facturas']
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
                <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
            <?= $this->Html->link(__('Nova factura'), ['action'=>'detalleFactura'], ['class'=>'btn btn-success']) ?>
        </div>

    <?= $this->Form->end() ?>
</div>


<div class="row" style="margin-top:2em">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo text-center">Data</th>
                    <th class="celda-titulo text-center">Importe</th>
                    <th class="celda-titulo text-center">Entidade</th>
                    <th class="celda-titulo text-center">Referencia</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($facturas as $f) : ?>
                    <tr>
                        <td class="text-center"><?= $f->data->format('Y-m-d') ?></td>
                        <td class="text-right"><?= $this->Number->currency($f->importe, 'EUR') ?></td>
                        <td class="text-center"><?= $f->entidade ?></td>
                        <td class="text-center"><?= $f->referencia ?></td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleFactura', $f->id]) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarFactura', $f->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
