<?php
$this->extend('template');
$this->set('submenu_option', 'resumoClubes');
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
        <?php foreach($resumo->getAreas() as $area) : ?>
            <?php if ($resumo->getTotalAreaClube($area, null)->balance > 0) : ?>

                <?php
                    $subareas = [];
                    foreach ($resumo->getSubareas($area) as $sa) {
                        if ($resumo->getTotalSubareaClube($sa, null)->balance > 0) {
                            $subareas[] = $sa;
                        } 
                    }
                ?>

                <h4><?= $area->partidaOrzamentaria->nome ?> - <?= $area->nome ?></h4>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Clube</th>
                            <?php foreach($subareas as $sa) : ?>
                                <th class="text-center"><?= $sa->nome ?></th>
                            <?php endforeach ?>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clubes as $clube) : ?>
                            <?php $total_area = $resumo->getTotalAreaClube($area, $clube) ?>
                            <?php if ($total_area->balance > 0) : ?>
                                <tr>
                                    <td><?= $clube->nome ?></td>
                                    <?php $total = 0; ?>
                                    <?php foreach($subareas as $sa) : ?>
                                        <?php $subtotal = $resumo->getTotalSubareaClube($sa, $clube) ?>
                                        <?php $total += $subtotal->balance ?>
                                        <td class="text-center <?= $subtotal->balance<0?'text-danger':'' ?>"><?= $this->Number->currency($subtotal->balance, 'EUR') ?></td>
                                    <?php endforeach ?>
                                    <td class="text-center <?= $total<0?'text-danger':'' ?>"><strong><?= $this->Number->currency($total, 'EUR') ?></strong></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>

            <?php endif ?>

        <?php endforeach ?>
    </div>
</div>
