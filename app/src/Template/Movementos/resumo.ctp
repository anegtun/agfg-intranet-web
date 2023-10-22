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
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('id_partida_orzamentaria', ['options'=>$this->AgfgForm->objectToKeyValue($partidasOrzamentarias,'id','nome'), 'label'=>'Partida orzamentaria', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('id_area', ['options'=>$this->AgfgForm->objectToKeyValue($areas,'id','nome'), 'label'=>'Area', 'class'=>'form-control']) ?>
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
                        <?php $total_subarea = $resumo->getTotalSubarea($subarea) ?>
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
                                        <a href="javascript:void(0)"><em class="glyphicon glyphicon-th-list" data-toggle="modal" data-target="#modal-movementos-subarea-<?= $subarea->id."_".preg_replace("/[ '()]/i", "_", $concepto) ?>"></em></a>
                                        &nbsp;
                                        <a href="javascript:void(0)"><em class="glyphicon glyphicon-time" data-toggle="modal" data-target="#modal-previsions-subarea-<?= $subarea->id."_".preg_replace("/[ '()]/i", "_", $concepto) ?>"></em></a>
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

    <div id="modal-movementos-area-<?= $area->id ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= $area->nome ?></h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="celda-titulo text-center">Data</th>
                                    <th class="celda-titulo text-center">Importe</th>
                                    <th class="celda-titulo text-center">Comisión</th>
                                    <th class="celda-titulo text-center">Subarea</th>
                                    <th class="celda-titulo text-center">Tempada</th>
                                    <th class="celda-titulo text-center">Conta</th>
                                    <th class="celda-titulo text-center">Clube</th>
                                    <th class="celda-titulo text-center">Observacións</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resumo->getMovementosArea(false, $area) as $m) : ?>
                                    <tr>
                                        <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                                        <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                                        <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                                        <td class="text-center"><?= $m->subarea->nome ?></td>
                                        <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                                        <td class="text-center"><?= $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                                        <td class="text-center"><?= $m->clube ? ($this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo) : '-' ?></td>
                                        <td><?= $m->descricion ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-previsions-area-<?= $area->id ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Previsións <?= $area->nome ?></h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="celda-titulo text-center">Data</th>
                                    <th class="celda-titulo text-center">Importe</th>
                                    <th class="celda-titulo text-center">Comisión</th>
                                    <th class="celda-titulo text-center">Subarea</th>
                                    <th class="celda-titulo text-center">Tempada</th>
                                    <th class="celda-titulo text-center">Conta</th>
                                    <th class="celda-titulo text-center">Clube</th>
                                    <th class="celda-titulo text-center">Observacións</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resumo->getMovementosArea(true, $area) as $m) : ?>
                                    <tr>
                                        <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                                        <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                                        <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                                        <td class="text-center"><?= $m->subarea->nome ?></td>
                                        <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                                        <td class="text-center"><?= $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                                        <td class="text-center"><?= $m->clube ? ($this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo) : '-' ?></td>
                                        <td><?= $m->descricion ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php foreach($resumo->getSubareas($area) as $subarea) : ?>
        <?php foreach($resumo->getConceptos($subarea) as $concepto) : ?>
            
            <div id="modal-movementos-subarea-<?= $subarea->id."_".preg_replace("/[ '()]/i", "_", $concepto) ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= $subarea->nome ?> (<?= $concepto ?>)</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="celda-titulo text-center">Data</th>
                                            <th class="celda-titulo text-center">Importe</th>
                                            <th class="celda-titulo text-center">Comisión</th>
                                            <th class="celda-titulo text-center">Conta</th>
                                            <th class="celda-titulo text-center">Clube</th>
                                            <th class="celda-titulo text-center">Observacións</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($resumo->getMovementosSubareaConcepto(false, $subarea, $concepto) as $m) : ?>
                                            <tr>
                                                <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                                                <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                                                <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                                                <td class="text-center"><?= $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                                                <td class="text-center"><?= $m->clube ? ($this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo) : '-' ?></td>
                                                <td><?= $m->descricion ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-previsions-subarea-<?= $subarea->id."_".preg_replace("/[ '()]/i", "_", $concepto) ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Previsións <?= $subarea->nome ?> (<?= $concepto ?>)</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="celda-titulo text-center">Data</th>
                                            <th class="celda-titulo text-center">Importe</th>
                                            <th class="celda-titulo text-center">Comisión</th>
                                            <th class="celda-titulo text-center">Conta</th>
                                            <th class="celda-titulo text-center">Clube</th>
                                            <th class="celda-titulo text-center">Observacións</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($resumo->getMovementosSubareaConcepto(true, $subarea, $concepto) as $m) : ?>
                                            <tr>
                                                <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                                                <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                                                <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                                                <td class="text-center"><?= $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                                                <td class="text-center"><?= $m->clube ? ($this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo) : '-' ?></td>
                                                <td><?= $m->descricion ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    <?php endforeach ?>

<?php endforeach ?>
