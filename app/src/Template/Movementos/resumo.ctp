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

$total = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0];

$info_area = [];
$info_subarea = [];
foreach($movementos as $m) {
    $area_key = $m->subarea->area->id;
    $subarea_key = $m->tempada.'_'.$m->subarea->id;
    if(empty($info_area[$area_key])) {
        $info_area[$area_key] = (object) ['id' => $m->subarea->area->id, 'nome' => $m->subarea->area->nome, 'movementos' => []];
    }
    if(empty($info_subarea[$subarea_key])) {
        $info_subarea[$subarea_key] = (object) ['id' => $m->subarea->id, 'nome' => $m->subarea->nome, 'tempada' => $m->tempada, 'movementos' => []];
    }
    $info_area[$area_key]->movementos[] = $m;
    $info_subarea[$subarea_key]->movementos[] = $m;
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
                        <th class="celda-titulo text-center">Tempada</th>
                        <th class="celda-titulo text-center">Ingresos</th>
                        <th class="celda-titulo text-center">Gastos</th>
                        <th class="celda-titulo text-center">Comisión</th>
                        <th class="celda-titulo text-center">Balance</th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $area_actual = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'id' => '', 'nome' => '']; ?>

                    <?php foreach($resumo as $i=>$r) : ?>

                        <?php if($area_actual->id !== $r->subarea->area->id) : ?>
                            <tr>
                                <th colspan="7">&nbsp;</th>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <th class="celda-titulo text-center" colspan="7"><?= $r->subarea->area->nome ?></th>
                            </tr>
                            <?php $area_actual = (object) ['ingresos' => 0, 'gastos' => 0, 'comision' => 0, 'balance' => 0, 'id' => $r->subarea->area->id, 'nome' => $r->subarea->area->nome]; ?>
                        <?php endif ?>

                        <?php
                        $total->ingresos += $r->ingresos;
                        $total->gastos += $r->gastos;
                        $total->comision += $r->comision;
                        $total->balance += $r->balance;
                        $area_actual->ingresos += $r->ingresos;
                        $area_actual->gastos += $r->gastos;
                        $area_actual->comision += $r->comision;
                        $area_actual->balance += $r->balance;
                        ?>

                        <tr>
                            <td class="text-center"><?= $r->subarea->nome ?></td>
                            <td class="text-center"><?= $tempadas[$r->tempada] ?></td>
                            <td class="text-right"><?= empty($r->ingresos) ? '-' : $this->Number->currency($r->ingresos, 'EUR') ?></td>
                            <td class="text-right text-danger"><?= empty($r->gastos) ? '-' : $this->Number->currency($r->gastos, 'EUR') ?></td>
                            <td class="text-right <?= $r->comision<0 ? 'text-danger' : ''?>"><?= empty($r->comision) ? '-' : $this->Number->currency($r->comision, 'EUR') ?></td>
                            <td class="text-right <?= $r->balance<0 ? 'text-danger' : ''?>"><strong><?= empty($r->balance) ? '-' : $this->Number->currency($r->balance, 'EUR') ?></strong></td>
                            <td class="text-center"><a href="javascript:void(0)"><em class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#modal-subarea-<?= $r->tempada.'_'.$r->subarea->id ?>"></em></a></td>
                        </tr>

                        <?php if(empty($resumo[$i+1]) || $area_actual->id !== $resumo[$i+1]->subarea->area->id) : ?>
                            <tr>
                                <th class="celda-titulo text-center">Subtotal</th>
                                <th></th>
                                <th class="celda-titulo text-right"><?= $this->Number->currency($area_actual->ingresos, 'EUR') ?></th>
                                <th class="celda-titulo text-right text-danger"><?= $this->Number->currency($area_actual->gastos, 'EUR') ?></th>
                                <th class="celda-titulo text-right <?= $area_actual->comision<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($area_actual->comision, 'EUR') ?></th>
                                <th class="celda-titulo text-right <?= $area_actual->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($area_actual->balance, 'EUR') ?></strong></th>
                                <th class="text-center"><a href="javascript:void(0)"><em class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#modal-area-<?= $r->subarea->area->id ?>"></em></a></th>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td class="text-center"><strong>TOTAL</strong></td>
                        <td></td>
                        <td class="text-right"><strong><?= $this->Number->currency($total->ingresos, 'EUR') ?></strong></td>
                        <td class="text-right text-danger"><strong><?= $this->Number->currency($total->gastos, 'EUR') ?></strong></td>
                        <td class="text-right <?= $total->comision<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total->comision, 'EUR') ?></strong></td>
                        <td class="text-right <?= $total->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total->balance, 'EUR') ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php foreach($info_area as $a) : ?>

        <div id="modal-area-<?= $a->id ?>" class="modal fade" role="dialog">
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
    <?php endforeach ?>

    <?php foreach($info_subarea as $k=>$sa) : ?>

        <div id="modal-subarea-<?= $k ?>" class="modal fade" role="dialog">
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

    <?php endforeach ?>

</div>
