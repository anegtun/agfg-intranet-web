<?php
$this->extend('template');
if($prevision) {
    $this->set('submenu_option', 'previsions');
    $this->set('cabeceiraTitulo', 'Previsións');
    $this->set('cabeceiraMigas', [
        ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
        ['label'=>'Previsións']
    ]);
} else {
    $this->set('submenu_option', 'movementos');
    $this->set('cabeceiraTitulo', 'Movementos');
    $this->set('cabeceiraMigas', [
        ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
        ['label'=>'Movementos']
    ]);
}
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$acumulado = 0;
foreach($movementos as $m) {
    $acumulado += $m->getImporteConComision();
}

$areas = [];
foreach($partidasOrzamentarias as $po) {
    foreach($po->areas as $a) {
        $areas[] = $a;
    }
}
?>


<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('id_partida_orzamentaria', ['options'=>$this->AgfgForm->objectToKeyValue($partidasOrzamentarias,'id','{$e->nome}'), 'label'=>'Part. Orzamentaria', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-4">
                <?= $this->Form->control('id_area', ['options'=>$this->AgfgForm->objectToKeyValue($areas,'id','{$e->partidaOrzamentaria->nome} - {$e->nome}'), 'label'=>'Área', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('subarea_activa', ['options'=>['0'=>'Non', '1'=>'Si'], 'default'=>'1']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('importe', ['options'=>[''=>'Todos', 'P'=>'Positivo', 'N'=>'Negativo'], 'default'=>'', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('factura', ['options'=>[''=>'Todos', 'S'=>'Si', 'N'=>'Non'], 'default'=>'', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
            </div>
            <?php if(empty($prevision)) : ?>
                <div class="col-lg-2">
                    <?= $this->Form->control('conta', ['options'=>$contas, 'label'=>'Conta', 'class'=>'form-control']) ?>
                </div>
            <?php endif ?>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
            <?= $this->Html->link(__($prevision ? 'Nova previsión' : 'Novo movemento'), ['action'=>'detalleMovemento', '?'=>['prevision'=>$prevision]], ['class'=>'btn btn-success']) ?>
        </div>

    <?= $this->Form->end() ?>

    <?= $this->Form->create(null, ['type'=>'post', 'enctype' => 'multipart/form-data', 'url'=>['action'=>'previsualizarMovementos']]) ?>
        <div class="row">
            <?php echo $this->Form->input('file', ['type'=>'file', 'label'=>'Arquivo', 'class'=>'form-control', 'accept'=>".xlsx"]) ?>
        </div>
        <?= $this->Form->button('Subir', ['class'=>'btn btn-default glyphicon glyphicon-upload']); ?>
    <?= $this->Form->end() ?>
</div>


<div class="row" style="margin-top:2em">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo text-center" style="min-width: 100px;">Data</th>
                    <th class="celda-titulo text-center">Importe</th>
                    <th class="celda-titulo text-center">Acumulado</th>
                    <th class="celda-titulo text-center">Tempada</th>
                    <?php if(empty($prevision)) : ?>
                        <th class="celda-titulo text-center">Conta</th>
                    <?php endif ?>
                    <th class="celda-titulo text-center">Partida Orz.</th>
                    <th class="celda-titulo text-center">Área</th>
                    <th class="celda-titulo text-center">Subárea</th>
                    <th class="celda-titulo">Descricición</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($movementos as $m) : ?>
                    <tr>
                        <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                        <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>">
                            <?php if (!empty($m->comision)) : ?>
                                <a title="Comisión: <?= $this->Number->currency($m->comision, 'EUR') ?>" class="glyphicon glyphicon-euro" href="javascript:void(0)" data-toggle="tooltip">&nbsp;</a>
                            <?php endif ?>
                            <?= $this->Number->currency($m->importe, 'EUR') ?>
                        </td>
                        <td class="text-right"><?= $this->Number->currency($acumulado, 'EUR') ?></td>
                        <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                        <?php if(empty($prevision)) : ?>
                            <td class="text-center"><?= empty($m->conta) ? '' : $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                        <?php endif ?>
                        <td class="text-center"><?= $m->subarea->area->partidaOrzamentaria->nome ?></td>
                        <td class="text-center"><?= $m->subarea->area->nome ?></td>
                        <td class="text-center"><?= $m->subarea->nome ?></td>
                        <td>
                            <?= $m->descricion ?>
                            <?php if(!empty($m->clube)) : ?>
                                - <?= $this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo ?>
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <?php if(!empty($m->factura)) : ?>
                                <a title="<?= $m->factura->entidade ?> - <?= $m->factura->descricion ?>" class="glyphicon glyphicon-barcode" href="javascript:void(0)" data-toggle="tooltip"></a>
                            <?php endif ?>
                            <?php if(!empty($m->referencia)) : ?>
                                <a title="<?= $m->referencia ?>" class="glyphicon glyphicon-info-sign" href="javascript:void(0)" data-toggle="tooltip"></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleMovemento', $m->id]) ?></td>
                        <td class="text-center"><?= $this->Html->link('', ['action'=>'clonarMovemento', $m->id], ['class'=>'glyphicon glyphicon-duplicate']) ?></td>
                        <td class="text-center">
                            <?php if(!empty($m->subarea->activa)) : ?>
                                <?= $this->AgfgForm->deleteButton(['action'=>'borrarMovemento', $m->id]) ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php $acumulado -= $m->getImporteConComision() ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
