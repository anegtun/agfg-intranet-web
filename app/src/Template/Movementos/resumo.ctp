<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Resumo');
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Resumo']
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$total = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'ingresos_previstos' => 0, 'gastos_previstos' => 0];

$info_area = [];
$info_subarea = [];
foreach($movementos as $m) {
    $area_key = $m->subarea->area->id;
    $subarea_key = $m->tempada.'_'.$m->subarea->id;
    if(empty($info_area[$area_key])) {
        $info_area[$area_key] = (object) ['id' => $m->subarea->area->id, 'nome' => $m->subarea->area->nome, 'movementos' => [], 'previsions' => []];
    }
    if(empty($info_subarea[$subarea_key])) {
        $info_subarea[$subarea_key] = (object) ['id' => $m->subarea->id, 'nome' => $m->subarea->nome, 'tempada' => $m->tempada, 'movementos' => [], 'previsions' => []];
    }
    $info_area[$area_key]->movementos[] = $m;
    $info_subarea[$subarea_key]->movementos[] = $m;
}
foreach($previsions as $p) {
    $area_key = $p->subarea->area->id;
    $subarea_key = $p->tempada.'_'.$p->subarea->id;
    if(empty($info_area[$area_key])) {
        $info_area[$area_key] = (object) ['id' => $p->subarea->area->id, 'nome' => $p->subarea->area->nome, 'movementos' => [], 'previsions' => []];
    }
    if(empty($info_subarea[$subarea_key])) {
        $info_subarea[$subarea_key] = (object) ['id' => $p->subarea->id, 'nome' => $p->subarea->nome, 'tempada' => $p->tempada, 'movementos' => [], 'previsions' => []];
    }
    $info_area[$area_key]->previsions[] = $p;
    $info_subarea[$subarea_key]->previsions[] = $p;
}
?>

<div class="container-full" style="margin-top:2em;">

    <div class="row form-group">
        <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

            <div class="row">
                <div class="col-lg-2">
                    <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="col-lg-2">
                    <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="col-lg-2">
                    <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada', 'class'=>'form-control']) ?>
                </div>
            </div>

            <div style="margin-top:1em">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
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
                    <?php $area_actual = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'ingresos_previstos' => 0, 'gastos_previstos' => 0, 'id' => '', 'nome' => '']; ?>

                    <?php foreach($resumo as $i=>$r) : ?>

                        <?php if($area_actual->id !== $r->subarea->area->id) : ?>
                            <tr>
                                <th colspan="9">&nbsp;</th>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <th class="celda-titulo text-center" colspan="9"><?= $r->subarea->area->nome ?></th>
                            </tr>
                            <?php $area_actual = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'ingresos_previstos' => 0, 'gastos_previstos' => 0, 'id' => $r->subarea->area->id, 'nome' => $r->subarea->area->nome]; ?>
                        <?php endif ?>

                        <?php
                        $total->ingresos += empty($r->ingresos) ? 0 : $r->ingresos;
                        $total->gastos += empty($r->gastos) ? 0 : $r->gastos;
                        $total->comision += empty($r->comision) ? 0 : $r->comision;
                        $total->balance += empty($r->balance) ? 0 : $r->balance;
                        $total->ingresos_previstos += empty($r->ingresos_previstos) ? 0 : $r->ingresos_previstos;
                        $total->gastos_previstos += empty($r->gastos_previstos) ? 0 : $r->gastos_previstos;
                        $area_actual->ingresos += empty($r->ingresos) ? 0 : $r->ingresos;
                        $area_actual->gastos += empty($r->gastos) ? 0 : $r->gastos;
                        $area_actual->comision += empty($r->comision) ? 0 : $r->comision;
                        $area_actual->balance += empty($r->balance) ? 0 : $r->balance;
                        $area_actual->ingresos_previstos += empty($r->ingresos_previstos) ? 0 : $r->ingresos_previstos;
                        $area_actual->gastos_previstos += empty($r->gastos_previstos) ? 0 : $r->gastos_previstos;
                        ?>

                        <tr>
                            <td class="text-center"><?= $r->subarea->nome ?></td>
                            <td class="text-center border-right"><?= $tempadas[$r->tempada] ?></td>
                            <td class="text-right"><?= empty($r->ingresos) ? '-' : $this->Number->currency($r->ingresos, 'EUR') ?></td>
                            <td class="text-right text-danger"><?= empty($r->gastos) ? '-' : $this->Number->currency($r->gastos, 'EUR') ?></td>
                            <td class="text-right <?= !empty($r->comision) && $r->comision<0 ? 'text-danger' : ''?>"><?= empty($r->comision) ? '-' : $this->Number->currency($r->comision, 'EUR') ?></td>
                            <td class="text-right border-right <?= !empty($r->balance) && $r->balance<0 ? 'text-danger' : ''?>"><strong><?= empty($r->balance) ? '-' : $this->Number->currency($r->balance, 'EUR') ?></strong></td>
                            <td class="text-right"><strong><?= empty($r->ingresos_previstos) ? '-' : $this->Number->currency($r->ingresos_previstos, 'EUR') ?></strong></td>
                            <td class="text-right text-danger border-right"><strong><?= empty($r->gastos_previstos) ? '-' : $this->Number->currency($r->gastos_previstos, 'EUR') ?></strong></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-th-list" data-toggle="modal" data-target="#modal-movementos-subarea-<?= $r->tempada.'_'.$r->subarea->id ?>"></em></a>
                                &nbsp;
                                <a href="javascript:void(0)"><em class="glyphicon glyphicon-time" data-toggle="modal" data-target="#modal-previsions-subarea-<?= $r->tempada.'_'.$r->subarea->id ?>"></em></a>
                            </td>
                        </tr>

                        <?php if(empty($resumo[$i+1]) || $area_actual->id !== $resumo[$i+1]->subarea->area->id) : ?>
                            <tr>
                                <th class="celda-titulo text-center">Subtotal</th>
                                <th class="border-right"></th>
                                <th class="celda-titulo text-right"><?= $this->Number->currency($area_actual->ingresos, 'EUR') ?></th>
                                <th class="celda-titulo text-right text-danger"><?= $this->Number->currency($area_actual->gastos, 'EUR') ?></th>
                                <th class="celda-titulo text-right <?= $area_actual->comision<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($area_actual->comision, 'EUR') ?></th>
                                <th class="celda-titulo text-right border-right <?= $area_actual->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($area_actual->balance, 'EUR') ?></strong></th>
                                <td class="celda-titulo text-right"><strong><?= empty($area_actual->ingresos_previstos) ? '-' : $this->Number->currency($area_actual->ingresos_previstos, 'EUR') ?></strong></td>
                                <td class="celda-titulo text-right text-danger border-right"><strong><?= empty($area_actual->gastos_previstos) ? '-' : $this->Number->currency($area_actual->gastos_previstos, 'EUR') ?></strong></td>
                                <th class="text-center">
                                    <a href="javascript:void(0)"><em class="glyphicon glyphicon-th-list" data-toggle="modal" data-target="#modal-movementos-area-<?= $r->subarea->area->id ?>"></em></a>
                                    &nbsp;
                                    <a href="javascript:void(0)"><em class="glyphicon glyphicon-time" data-toggle="modal" data-target="#modal-previsions-area-<?= $r->subarea->area->id ?>"></em></a>
                                </th>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
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

    <?php foreach($info_area as $a) : ?>

        <div id="modal-movementos-area-<?= $a->id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= $a->nome ?></h4>
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
                                    <?php foreach($a->movementos as $m) : ?>
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

        <div id="modal-previsions-area-<?= $a->id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Previsións <?= $a->nome ?></h4>
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
                                    <?php foreach($a->previsions as $m) : ?>
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

    <?php endforeach ?>

    <?php foreach($info_subarea as $k=>$sa) : ?>

        <div id="modal-movementos-subarea-<?= $k ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= $sa->nome ?> (<?= $tempadas[$sa->tempada] ?>)</h4>
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
                                    <?php foreach($sa->movementos as $m) : ?>
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

        <div id="modal-previsions-subarea-<?= $k ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Previsións <?= $sa->nome ?> (<?= $tempadas[$sa->tempada] ?>)</h4>
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
                                    <?php foreach($sa->previsions as $m) : ?>
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

</div>
