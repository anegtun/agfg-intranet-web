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

$estado_param = $this->request->getQuery('estado');
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
            <div class="col-lg-2">
                <?= $this->Form->control('estado', ['options'=>[''=>'Todas', 'A'=>'Abertas', 'F'=>'Finalizadas', 'S'=>'Pechadas sen pagos', 'I'=>'Pechadas pagos inconsistentes']]) ?>
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
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo text-center">Data</th>
                    <th class="celda-titulo text-center">Importe</th>
                    <th class="celda-titulo text-center">Entidade</th>
                    <th class="celda-titulo text-center">Referencia</th>
                    <th class="celda-titulo text-center">Descrición</th>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($facturas as $f) : ?>
                    <?php
                        $diff = $f->diffImporteMovementos();
                        switch($estado_param) {
                            case 'A': $fn_match = function($fac) { return $fac->isAberta(); }; break;
                            case 'F': $fn_match = function($fac) { return !$fac->isAberta(); }; break;
                            case 'S': $fn_match = function($fac) { return $fac->isPechada() && empty($fac->movementos); }; break;
                            case 'I': $fn_match = function($fac) { return $fac->isPechada() && !empty($fac->movementos) && ((int)$fac->diffImporteMovementos()) != 0; }; break;
                            default:  $fn_match = function($fac) { return true; }; break;
                        }
                        if(!$fn_match($f)) {
                            continue;
                        }
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php
                                $icon = '';
                                $color = '';
                                $tooltip = '';

                                if (((int)$diff) == 0) {
                                    $color = 'text-success';
                                } else if (abs($diff) == $f->importe) {
                                    $color = 'text-danger';
                                    $tooltip = 'Sen pagos';
                                } else if ($diff < 0) {
                                    $color = 'text-warning';
                                    $tooltip = 'Pago a medias ('.$this->Number->currency($diff,'EUR').')';
                                } else if ($diff > 0) {
                                    $color = 'text-info';
                                    $tooltip = 'Pago de máis ('.$this->Number->currency($diff,'EUR').')';
                                }

                                if ($f->isAberta()) {
                                    $icon = 'list-alt';
                                } else if ($f->isPechada()) {
                                    $icon = 'ok';
                                } else if ($f->isDescartada()) {
                                    $icon = 'remove';
                                    $color = 'text-muted';
                                    $tooltip = 'Descartada';
                                }
                            ?>
                            <a title="<?= $tooltip ?>" class="glyphicon glyphicon-<?= $icon ?> <?= $color ?>" href="javascript:void(0)" data-toggle="tooltip"></a>
                        </td>
                        <td class="text-center">
                            <?php if(empty($f->arquivos)) : ?>
                                <a class="glyphicon glyphicon-paperclip text-danger" href="javascript:void(0)"></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center"><?= $f->data->format('Y-m-d') ?></td>
                        <td class="text-right"><?= $this->Number->currency($f->importe, 'EUR') ?></td>
                        <td class="text-center"><?= $f->entidade ?></td>
                        <td class="text-center"><?= $f->referencia ?></td>
                        <td class="text-center"><?= $f->descricion ?></td>
                        <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleFactura', $f->id]) ?></td>
                        <td class="text-center"><?= $this->Html->link('', ['action'=>'clonarFactura', $f->id], ['class'=>'glyphicon glyphicon-duplicate']) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarFactura', $f->id]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
