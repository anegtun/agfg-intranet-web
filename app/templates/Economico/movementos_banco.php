<?php
$this->extend('template');
$this->set('submenu_option', 'movementos_banco');
$this->set('cabeceiraTitulo', 'Revisión banco');
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Revisión banco']
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$movementos_ar = $movementos->toArray();
?>


<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('conta', ['options'=>$contas, 'label'=>'Conta', 'class'=>'form-control']) ?>
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
                    <th class="column-date text-center">Data</th>
                    <th class="text-center"></th>
                    <th class="text-center">Importe</th>
                    <th class="text-center">Acumulado</th>
                    <th class="text-center">Partida Orz.</th>
                    <th class="text-center">Tempada</th>
                    <th class="text-center">Área</th>
                    <th>Descricición</th>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($movementos_ar as $m) : ?>
                    <?php
                    $atopado = false;
                    $acumulado = 0;
                    foreach($movementos_ar as $m2) {
                        if($m2->id === $m->id) {
                            $atopado = true;
                        }
                        if($atopado) {
                            $acumulado += $m2->importe + $m2->comision;
                        }
                    }
                    ?>

                    <tr>
                        <td class="text-center">
                            <?= $m->data->format('Y-m-d') ?>
                        </td>
                        <td class="column-button">
                            <?php if (!empty($m->comision)) : ?>
                                <a title="Comisión: <?= $this->Number->currency($m->comision, 'EUR') ?>" class="glyphicon glyphicon-euro" href="javascript:void(0)" data-toggle="tooltip" style="cursor:default;"></a>
                            <?php endif ?>
                        </td>
                        <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>">
                            <?= $this->Number->currency($m->importe, 'EUR') ?>
                        </td>
                        <td class="text-right">
                            <?= $this->Number->currency($acumulado, 'EUR') ?>
                        </td>
                        <td class="text-center">
                            <?= $this->Html->image($m->area->partidaOrzamentaria->logo, ['height'=>25]) ?>
                        </td>
                        <td class="text-center">
                            <?= $tempadas[$m->tempada] ?>
                        </td>
                        <td class="text-center">
                            <?= $m->area->nome ?>
                        </td>
                        <td>
                            <?= $m->descricion ?>
                            <?php if(!empty($m->clube)) : ?>
                                - <?= $this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo ?>
                            <?php endif ?>
                        </td>
                        <td class="column-button">
                            <?= $this->AgfgForm->editButton(['action'=>'detalleMovemento', $m->id]) ?>
                        </td>
                        <td class="column-button">
                            <?= $this->AgfgForm->deleteButton(['action'=>'borrarMovemento', $m->id]) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
