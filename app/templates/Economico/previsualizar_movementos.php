<?php
$this->extend('template');

$this->set('submenu_option', 'movementos');
$this->set('cabeceiraTitulo', 'Importar movementos');
$this->set('cabeceiraMigas', [
    ['label'=>'Movementos', 'url'=>['action'=>'movementos']],
    ['label'=>'Importar']
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$ids_movementos_existentes = [];
?>

<h2>Movementos a importar</h2>


<?= $this->Form->create(null, ['type'=>'post', 'url'=>['action'=>'importarMovementos']]) ?>

    <div class="row" style="margin-top:2em">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo text-center"></th>
                        <th class="celda-titulo text-center" style="min-width: 100px;">Data</th>
                        <th class="celda-titulo text-center">Importe</th>
                        <th class="celda-titulo text-center">Tempada</th>
                        <th class="celda-titulo text-center">Conta</th>
                        <th class="celda-titulo text-center">Subárea</th>
                        <th class="celda-titulo text-center">Clube</th>
                        <th class="celda-titulo">Descricición</th>
                        <th class="celda-titulo">Referencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach($filas as $f) : ?>
                        <?php
                            $movemento = null;
                            foreach($movementos as $m) {
                                $atopado_anteriormente = in_array($m->id, $ids_movementos_existentes);
                                $mesma_data = $m->data == $f->data;
                                $mesmo_importe = $m->importe == $f->importe;
                                $mesma_comision = !empty($m->comision) && $m->comision == $f->importe;
                                if ($mesma_data && $mesmo_importe && !$atopado_anteriormente) {
                                    $ids_movementos_existentes[] = $m->id;
                                    $movemento = $m;
                                    break;
                                } else if ($mesma_data && $mesma_comision) {
                                    $movemento = $m;
                                    break;
                                }
                            } 
                        ?>

                        <?php if (!empty($movemento)) : ?>

                            <tr>
                                <td class="text-center">&nbsp;</td>
                                <td class="text-center"><?= $f->data->format('Y-m-d') ?></td>
                                <td class="text-right <?= $f->importe<0 ? 'text-danger' : ''?>">
                                    <?= $this->Number->currency($f->importe, 'EUR') ?>
                                </td>
                                <td class="text-center"><?= $tempadas[$movemento->tempada] ?></td>
                                <td class="text-center"><?= $contas[$movemento->conta] ?></td>
                                <td class="text-center"><?= "{$movemento->subarea->area->partidaOrzamentaria->nome} - {$movemento->subarea->area->nome} - {$movemento->subarea->nome}" ?></td>
                                <td class="text-center"><?= empty($movemento->clube) ? '' : $movemento->clube->nome ?></td>
                                <td class="text-center"><?= $movemento->descricion ?></td>
                                <td class="text-center"><?= $movemento->referencia ?></td>
                            </tr>

                        <?php else : ?>

                            <tr>
                                <td class="text-center">
                                <?= $this->Form->checkbox('fila.'.$i.'.importar', ['checked'=>false]) ?>
                                </td>
                                <td class="text-center">
                                    <?= $f->data->format('Y-m-d') ?>
                                    <?= $this->Form->hidden('fila.'.$i.'.data', ['value' => $f->data->format('d-m-Y')]) ?>
                                </td>
                                <td class="text-right <?= $f->importe<0 ? 'text-danger' : ''?>">
                                    <?= $this->Number->currency($f->importe, 'EUR') ?>
                                    <?= $this->Form->hidden('fila.'.$i.'.importe', ['value' => $f->importe]) ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->Form->control('fila.'.$i.'.tempada', ['options'=>$tempadas, 'label'=>false, 'templates'=>$emptyTemplates]) ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->Form->control('fila.'.$i.'.conta', ['options'=>$contas, 'label'=>false, 'templates'=>$emptyTemplates, 'value'=>'B']) ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->Form->control('fila.'.$i.'.id_subarea', ['options'=>$this->AgfgForm->objectToKeyValue($subareas,'id','{$e->area->partidaOrzamentaria->nome} - {$e->area->nome} - {$e->nome}'), 'label'=>false, 'templates'=>$emptyTemplates]) ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->Form->control('fila.'.$i.'.id_clube', ['options'=>$this->AgfgForm->objectToKeyValue($clubes,'id','{$e->nome}'), 'label'=>false, 'templates'=>$emptyTemplates]) ?>
                                </td>
                                <td>
                                    <?= $this->Form->control('fila.'.$i.'.descricion', ['label'=>false, 'value' => $f->descricion]) ?>
                                </td>
                                <td>
                                    <?= $this->Form->control('fila.'.$i.'.referencia', ['label'=>false]) ?>
                                </td>
                            </tr>

                            <?php $i++ ?>

                        <?php endif ?>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </div>

<?= $this->Form->end() ?>



<h2>Existentes fóra do Excel</h2>

<div class="row" style="margin-top:2em">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo text-center"></th>
                    <th class="celda-titulo text-center" style="min-width: 100px;">Data</th>
                    <th class="celda-titulo text-center">Importe</th>
                    <th class="celda-titulo text-center">Tempada</th>
                    <th class="celda-titulo text-center">Conta</th>
                    <th class="celda-titulo text-center">Subárea</th>
                    <th class="celda-titulo text-center">Clube</th>
                    <th class="celda-titulo">Descricición</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($movementos as $m) : ?>
                    <?php if (!in_array($m->id, $ids_movementos_existentes)) : ?>
                        <tr>
                            <td class="text-center">&nbsp;</td>
                            <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                            <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>">
                                <?= $this->Number->currency($m->importe, 'EUR') ?>
                            </td>
                            <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                            <td class="text-center"><?= $contas[$m->conta] ?></td>
                            <td class="text-center"><?= "{$m->subarea->area->partidaOrzamentaria->nome} - {$m->subarea->area->nome} - {$m->subarea->nome}" ?></td>
                            <td class="text-center"><?= empty($m->clube) ? '' : $m->clube->nome ?></td>
                            <td class="text-center"><?= $m->descricion ?></td>
                        </tr>
                    <?php endif ?>

                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
