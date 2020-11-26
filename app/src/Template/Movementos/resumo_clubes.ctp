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
                        <th class="celda-titulo text-center">Clube</th>
                        <?php foreach($subareas as $sa) : ?>
                            <th class="celda-titulo text-center"><?= $sa->nome ?></th>
                        <?php endforeach ?>
                        <th class="celda-titulo text-center">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clubes as $clube) : ?>
                        <tr>
                            <td class="text-center"><?= $clube->nome ?></td>
                            <?php $total = 0; ?>
                            <?php foreach($subareas as $sa) : ?>
                                <?php $importe = empty($resumo[$clube->id][$sa->id]) ? 0 : $resumo[$clube->id][$sa->id] ?>
                                <?php $total += $importe ?>
                                <td class="celda-titulo text-center <?= $importe<=0?'text-danger':'' ?>"><?= $this->Number->currency($importe, 'EUR') ?></td>
                            <?php endforeach ?>
                            <td class="text-center <?= $total<=0?'text-danger':'' ?>"><strong><?= $this->Number->currency($total, 'EUR') ?></strong></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
