<?php
$this->extend('template');

// Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
$data_str = empty($factura->data) ? NULL : $factura->data->format('d-m-Y');

$this->set('submenu_option', 'facturas');
$this->set('cabeceiraTitulo', empty($factura->id) ? 'Nova factura' : $data_str);
$this->set('cabeceiraMigas', [
    ['label'=>'Contabilidade'],
    ['label'=>'Facturas', 'url'=>['action'=>'facturas']],
    ['label'=>empty($factura->id) ? 'Nova factura' : $data_str]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<?= $this->Form->create($factura, ['type'=>'post', 'url'=>['action'=>'gardarFactura']]) ?>
    <?= $this->Form->hidden('id') ?>
    <fieldset>
        <legend>Factura</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('importe', ['type'=>'number', 'label'=>'Importe']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('entidade', ['label'=>'Entidade']) ?>
            </div>
            <div class="form-group col-lg-12">
                <?= $this->Form->control('referencia', ['label'=>'Referencia']) ?>
            </div>
            <div class="form-group col-lg-12">
                <?= $this->Form->control('descricion', ['label'=>'Descrición']) ?>
            </div>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>



<?php if(!empty($factura->id)) : ?>
    <div class="row" style="margin-top:2em;">
        <h3>Arquivos</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Nome</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arquivos as $a) : ?>
                    <tr>
                        <td><?= $this->Html->link($a, ['action'=>'descargarFacturaArquivo', $factura->id, urlencode($a)], ['target'=>'_blank']) ?></td>
                        <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarFacturaArquivo', $factura->id, urlencode($a)]) ?></td>
                    </tr>
                <?php endforeach ?>
            <tbody>
        </table>

        <?= $this->Form->create($factura, ['type'=>'post', 'enctype' => 'multipart/form-data', 'url'=>['action'=>'subirFactura']]) ?>
            <?php echo $this->Form->input('id', ['type'=>'hidden', 'value'=>$factura->id]) ?>

            <div class="row">
                <?php echo $this->Form->input('file', ['type'=>'file', 'label'=>'Arquivo', 'class'=>'form-control', 'accept'=>"image/*,.pdf,.doc,.docx"]) ?>
            </div>
            <?= $this->Form->button('Subir', ['class'=>'btn btn-default glyphicon glyphicon-upload']); ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif ?>
