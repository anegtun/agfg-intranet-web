<?php
$this->extend('template');
$this->set('submenu_option', 'previsions');
$this->set('cabeceiraTitulo', 'Previsións');
$this->set('cabeceiraMigas', [
    ['label'=>'Xestión Económica', 'url'=>['controller'=>'Economico', 'action'=>'index']],
    ['label'=>'Previsións']
]);
    
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$areas = [];
foreach($partidasOrzamentarias as $po) {
    foreach($po->areas as $a) {
        $areas[] = $a;
    }
}
?>


<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('tempada', ['options'=>array_merge([''=>''], $tempadas), 'label'=>'Tempada', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('id_partida_orzamentaria', ['options'=>$this->AgfgForm->objectToKeyValue($partidasOrzamentarias,'id','{$e->nome}'), 'label'=>'Part. Orzamentaria', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('importe', ['options'=>[''=>'Todos', 'P'=>'Positivo', 'N'=>'Negativo'], 'default'=>'', 'class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $this->Form->control('texto', ['type'=>'text', 'class'=>'form-control', 'label'=>'Texto']) ?>
            </div>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
            <?= $this->Html->link(__('Nova previsión'), ['action'=>'detalleMovemento', '?'=>['prevision'=>true]], ['class'=>'btn btn-success']) ?>
        </div>

    <?= $this->Form->end() ?>

</div>


<div id="modalImportar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= $this->Form->create(null, ['type'=>'post', 'enctype' => 'multipart/form-data', 'url'=>['action'=>'previsualizarMovementos']]) ?>
                <div class="modal-header">
                    <h5 class="modal-title">Importar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php echo $this->Form->input('file', ['type'=>'file', 'label'=>'Arquivo', 'class'=>'form-control', 'accept'=>".xlsx"]) ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                    <?= $this->Form->button('Importar', ['class'=>'btn btn-success glyphicon glyphicon-upload']); ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>

    
</div>



<div class="row" style="margin-top:2em">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                    <th class="column-date text-center">Data</th>
                    <th class="text-center">Importe</th>
                    <th class="text-center">Tempada</th>
                    <th class="text-center">Partida Orz.</th>
                    <th class="text-center">Área</th>
                    <th>Descricición</th>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($movementos as $m) : ?>
                    <tr>
                        <td class="column-button">
                            <?php if (!empty($m->comision)) : ?>
                                <a title="Comisión: <?= $this->Number->currency($m->comision, 'EUR') ?>" class="glyphicon glyphicon-euro" href="javascript:void(0)" data-toggle="tooltip" style="cursor:default;"></a>
                            <?php endif ?>
                        </td>
                        <td class="column-button">
                            <?php if(!empty($m->referencia)) : ?>
                                <a title="<?= $m->referencia ?>" class="glyphicon glyphicon-info-sign" href="javascript:void(0)" data-toggle="tooltip" style="cursor:default;"></a>
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <?= $m->data->format('Y-m-d') ?>
                        </td>
                        <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>">
                            <?= $this->Number->currency($m->importe, 'EUR') ?>
                        </td>
                        <td class="text-center">
                            <?= $tempadas[$m->tempada] ?>
                        </td>
                        <td class="text-center">
                            <?= $this->Html->image($m->area->partidaOrzamentaria->logo, ['height'=>25]) ?>
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
                            <?= $this->Html->link('', ['action'=>'clonarMovemento', $m->id], ['class'=>'glyphicon glyphicon-duplicate']) ?>
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
