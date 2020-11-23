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

$total = (object) ['ingresos' => 0, 'gastos' => 0, 'balance' => 0];
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo text-center">Area</th>
                        <th class="celda-titulo text-center">Subarea</th>
                        <th class="celda-titulo text-center">Tempada</th>
                        <th class="celda-titulo text-center">Ingresos</th>
                        <th class="celda-titulo text-center">Gastos</th>
                        <th class="celda-titulo text-center">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resumo as $r) : ?>
                        <?php
                        $total->ingresos += $r->ingresos;
                        $total->gastos += $r->gastos;
                        $total->balance += $r->balance;
                        ?>
                        <tr>
                            <td class="text-center"><?= $r->subarea->area->nome ?></td>
                            <td class="text-center"><?= $r->subarea->nome ?></td>
                            <td class="text-center"><?= $tempadas[$r->tempada] ?></td>
                            <td class="text-right"><?= $this->Number->currency($r->ingresos, 'EUR') ?></td>
                            <td class="text-right text-danger"><?= $this->Number->currency($r->gastos, 'EUR') ?></td>
                            <td class="text-right <?= $r->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($r->balance, 'EUR') ?></strong></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan="3"><strong>TOTAL</strong></td>
                        <td class="text-right"><strong><?= $this->Number->currency($total->ingresos, 'EUR') ?></strong></td>
                        <td class="text-right text-danger"><strong><?= $this->Number->currency($total->gastos, 'EUR') ?></strong></td>
                        <td class="text-right <?= $total->balance<0 ? 'text-danger' : ''?>"><strong><?= $this->Number->currency($total->balance, 'EUR') ?></strong></td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </div>
</div>
