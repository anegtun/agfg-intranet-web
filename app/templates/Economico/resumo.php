<?php
$this->extend('template');
$this->set('submenu_option', 'resumo');
$this->set('cabeceiraTitulo', 'Resumo');
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Resumo']
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$areas = [];
foreach($partidasOrzamentarias as $po) {
    foreach($po->areas as $a) {
        $areas[] = $a;
    }
}

$id_regexp = "/[ ñÑºª,'~()\*\.\/\?\+]/i";
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('id_partida_orzamentaria', ['options'=>$this->AgfgForm->objectToKeyValue($partidasOrzamentarias,'id','nome'), 'label'=>'Partida orzamentaria', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('id_area', ['options'=>$this->AgfgForm->objectToKeyValue($areas,'id','{$e->partidaOrzamentaria->nome} - {$e->nome}'), 'label'=>'Area', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['name'=>'accion', 'value'=>'buscar', 'class'=>'btn btn-primary']) ?>
            <?= $this->Form->button('Exportar', ['name'=>'accion', 'value'=>'pdf', 'class'=>'btn btn-default']) ?>
        </div>

    <?= $this->Form->end() ?>
</div>


<div class="row" style="margin-top:2em">
    <div class="col-xs-12 table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo text-center">Subarea</th>
                    <th class="celda-titulo text-center border-right">Tempada</th>
                    <th class="celda-titulo text-center">Ingresos</th>
                    <th class="celda-titulo text-center">Gastos</th>
                    <th class="celda-titulo text-center">Comisión</th>
                    <th class="celda-titulo text-center border-right">Balance</th>
                    <th class="celda-titulo text-center">Prev. ingresos</th>
                    <th class="celda-titulo text-center border-right">Prev. gastos</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resumo->getAreas() as $area) : ?>
                    <?php $total_area = $resumo->getTotalArea($area) ?>
                    <tr>
                        <th colspan="9">&nbsp;</th>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <th class="celda-titulo text-center" colspan="9"><?= $area->partidaOrzamentaria->nome ?> - <?= $area->nome ?></th>
                    </tr>

                    <?php foreach($resumo->getSubareas($area) as $subarea) : ?>
                        <?php foreach($resumo->getConceptos($subarea) as $concepto) : ?>
                            <?php $total_concepto = $resumo->getTotalConcepto($subarea, $concepto) ?>
                            <tr>
                                <td class="text-center"><?= $subarea->nome ?></td>
                                <td class="text-center border-right"><?= $concepto ?></td>
                                <td class="text-right"><?= empty($total_concepto->ingresos) ? '-' : $this->Number->currency($total_concepto->ingresos, 'EUR') ?></td>
                                <td class="text-right text-danger"><?= empty($total_concepto->gastos) ? '-' : $this->Number->currency($total_concepto->gastos, 'EUR') ?></td>
                                <td class="text-right <?= !empty($total_concepto->comision) && $total_concepto->comision<0 ? 'text-danger' : ''?>"><?= empty($total_concepto->comision) ? '-' : $this->Number->currency($total_concepto->comision, 'EUR') ?></td>
                                <td class="text-right border-right <?= !empty($total_concepto->balance) && $total_concepto->balance<0 ? 'text-danger' : ''?>"><strong><?= empty($total_concepto->balance) ? '-' : $this->Number->currency($total_concepto->balance, 'EUR') ?></strong></td>
                                <td class="text-right"><strong><?= empty($total_concepto->ingresos_previstos) ? '-' : $this->Number->currency($total_concepto->ingresos_previstos, 'EUR') ?></strong></td>
                                <td class="text-right text-danger border-right"><strong><?= empty($total_concepto->gastos_previstos) ? '-' : $this->Number->currency($total_concepto->gastos_previstos, 'EUR') ?></strong></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)"><em class="glyphicon glyphicon-th-list" data-toggle="modal" data-target="#modal-movementos-subarea-<?= $subarea->id."_".preg_replace($id_regexp, "_", $concepto) ?>"></em></a>
                                    &nbsp;
                                    <a href="javascript:void(0)"><em class="glyphicon glyphicon-time" data-toggle="modal" data-target="#modal-previsions-subarea-<?= $subarea->id."_".preg_replace($id_regexp, "_", $concepto) ?>"></em></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>

                    <tr>
                        <th class="celda-titulo text-center">Subtotal</th>
                        <th class="border-right"></th>
                        <th class="celda-titulo text-right"><?= $this->Number->currency($total_area->ingresos, 'EUR') ?></th>
                        <th class="celda-titulo text-right text-danger"><?= $this->Number->currency($total_area->gastos, 'EUR') ?></th>
                        <th class="celda-titulo text-right <?= $total_area->comision<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($total_area->comision, 'EUR') ?></th>
                        <th class="celda-titulo text-right border-right <?= $total_area->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total_area->balance, 'EUR') ?></strong></th>
                        <td class="celda-titulo text-right"><strong><?= empty($total_area->ingresos_previstos) ? '-' : $this->Number->currency($total_area->ingresos_previstos, 'EUR') ?></strong></td>
                        <td class="celda-titulo text-right text-danger border-right"><strong><?= empty($total_area->gastos_previstos) ? '-' : $this->Number->currency($total_area->gastos_previstos, 'EUR') ?></strong></td>
                        <th class="text-center">
                            <a href="javascript:void(0)"><em class="glyphicon glyphicon-th-list" data-toggle="modal" data-target="#modal-movementos-area-<?= $area->id ?>"></em></a>
                            &nbsp;
                            <a href="javascript:void(0)"><em class="glyphicon glyphicon-time" data-toggle="modal" data-target="#modal-previsions-area-<?= $area->id ?>"></em></a>
                        </th>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <?php $total = $resumo->getTotal() ?>
                <tr>
                    <td colspan="9">&nbsp;</td>
                </tr>
                <tr style="background-color: #f9f9f9;">
                    <td class="text-center"><strong>TOTAL</strong></td>
                    <td class="border-right"></td>
                    <td class="text-right"><strong><?= $this->Number->currency($total->ingresos, 'EUR') ?></strong></td>
                    <td class="text-right text-danger"><strong><?= $this->Number->currency($total->gastos, 'EUR') ?></strong></td>
                    <td class="text-right <?= $total->comision<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total->comision, 'EUR') ?></strong></td>
                    <td class="text-right border-right <?= $total->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total->balance, 'EUR') ?></strong></td>
                    <td class="text-right"><strong><?= $this->Number->currency($total->ingresos_previstos, 'EUR') ?></strong></td>
                    <td class="text-right border-right text-danger"><strong><?= $this->Number->currency($total->gastos_previstos, 'EUR') ?></strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php foreach($resumo->getAreas() as $area) : ?>

    <?= $this->element('economico/modal_movemento', [
        'id' => "modal-movementos-area-{$area->id}",
        'titulo' => $area->nome,
        'movementos' => $resumo->getMovementosArea(false, $area)
    ]) ?>

    <?= $this->element('economico/modal_movemento', [
        'id' => "modal-previsions-area-{$area->id}",
        'titulo' => "Previsións {$area->nome}",
        'movementos' => $resumo->getMovementosArea(true, $area)
    ]) ?>

    <?php foreach($resumo->getSubareas($area) as $subarea) : ?>
        <?php foreach($resumo->getConceptos($subarea) as $concepto) : ?>

            <?= $this->element('economico/modal_movemento', [
                'id' => "modal-movementos-subarea-" . $subarea->id . "_" . preg_replace($id_regexp, "_", $concepto),
                'titulo' => "{$subarea->nome} ($concepto)",
                'movementos' => $resumo->getMovementosSubareaConcepto(false, $subarea, $concepto)
            ]) ?>

            <?= $this->element('economico/modal_movemento', [
                'id' => "modal-previsions-subarea-" . $subarea->id . "_" . preg_replace($id_regexp, "_", $concepto),
                'titulo' => "Previsións {$subarea->nome} ($concepto)",
                'movementos' => $resumo->getMovementosSubareaConcepto(true, $subarea, $concepto)
            ]) ?>

        <?php endforeach ?>
    <?php endforeach ?>

<?php endforeach ?>
