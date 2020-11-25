<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Movementos');
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Movementos']
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
                    <?= $this->Form->control('conta', ['options'=>$contas, 'label'=>'Conta', 'class'=>'form-control']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada', 'class'=>'form-control']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $this->Form->control('id_subarea', ['options'=>$this->AgfgForm->objectToKeyValue($subareas,'id','{$e->area->nome} - {$e->nome}'), 'label'=>'Subárea', 'templates'=>$emptyTemplates]) ?>
                </div>
            </div>

            <div style="margin-top:1em">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
                <?= $this->Html->link(__('Novo movemento'), ['action'=>'detalle'], ['class'=>'btn btn-success']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>


    <div class="row" style="margin-top:2em">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo text-center">Data</th>
                        <th class="celda-titulo text-center">Importe</th>
                        <th class="celda-titulo text-center">Comisión</th>
                        <th class="celda-titulo text-center">Tempada</th>
                        <th class="celda-titulo text-center">Conta</th>
                        <th class="celda-titulo text-center">Área</th>
                        <th class="celda-titulo text-center">Subárea</th>
                        <th class="celda-titulo text-center">Clube</th>
                        <th class="celda-titulo">Observacións</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($movementos as $m) : ?>
                        <tr>
                            <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                            <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                            <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                            <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                            <td class="text-center"><?= $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                            <td class="text-center"><?= $m->subarea->area->nome ?></td>
                            <td class="text-center"><?= $m->subarea->nome ?></td>
                            <td class="text-center"><?= $m->clube ? ($this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo) : '-' ?></td>
                            <td><?= $m->descricion ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalle', $m->id]) ?></td>
                            <td class="text-center"><?= $this->Html->link('', ['action'=>'clonar', $m->id], ['class'=>'glyphicon glyphicon-duplicate']) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrar', $m->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
