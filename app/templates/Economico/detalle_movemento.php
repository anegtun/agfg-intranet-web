<?php
$this->extend('template');

// Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
$data_str = empty($movemento->data) ? NULL : $movemento->data->format('d-m-Y');

if($movemento->prevision) {
    $this->set('submenu_option', 'previsions');
    $this->set('cabeceiraTitulo', empty($movemento->id) ? 'Nova previsión' : $data_str);
    $this->set('cabeceiraMigas', [
        ['label'=>'Previsións', 'url'=>['action'=>'previsions']],
        ['label'=>empty($movemento->id) ? 'Nova previsión' : $data_str]
    ]);
} else {
    $this->set('submenu_option', 'movementos');
    $this->set('cabeceiraTitulo', empty($movemento->id) ? 'Novo movemento' : $data_str);
    $this->set('cabeceiraMigas', [
        ['label'=>'Movementos', 'url'=>['action'=>'movementos']],
        ['label'=>empty($movemento->id) ? 'Novo movemento' : $data_str]
    ]);
}
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$subarea_activa = true;
if(!empty($movemento->id_subarea)) {
    foreach($subareas as $s) {
        if($s->id === $movemento->id_subarea && empty($s->activa)) {
            $subarea_activa = false;
            break;
        }
    }
}
?>

<?= $this->Form->create($movemento, ['type'=>'post', 'url'=>['action'=>'gardarMovemento']]) ?>
    <?= $this->Form->hidden('id') ?>
    <?= $this->Form->hidden('prevision') ?>
    <fieldset>
        <legend>Movemento</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('importe', ['type'=>'number', 'label'=>'Importe']) ?>
            </div>
            <?php if(!$movemento->prevision) : ?>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('comision', ['type'=>'number', 'label'=>'Comisión']) ?>
                </div>
            <?php endif ?>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('tempada', ['options'=>$this->AgfgForm->objectToKeyValue($tempadas,'codigo','nome',true,false), 'label'=>'Tempada', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('id_subarea', ['options'=>$this->AgfgForm->objectToKeyValue($subareas,'id','{$e->area->partidaOrzamentaria->nome} - {$e->area->nome} - {$e->nome}'), 'label'=>'Subárea', 'templates'=>$emptyTemplates]) ?>
            </div>
            <?php if(!$movemento->prevision) : ?>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('conta', ['options'=>$contas, 'label'=>'Conta', 'templates'=>$emptyTemplates]) ?>
                </div>
            <?php endif ?>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('id_clube', ['options'=>$this->AgfgForm->objectToKeyValue($clubes,'id','{$e->nome}'), 'label'=>'Clube', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('descricion', ['label'=>'Descrición']) ?>
            </div>
            <div class="form-group col-lg-12">
                <?= $this->Form->control('referencia', ['label'=>'Referencia']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <?= $this->Form->control('id_factura', ['options'=>$this->AgfgForm->objectToKeyValue($facturas,'id','{$e->data->format("Y-m-d")} - {$e->entidade} - {$e->importe} - {$e->descricion}',true,false), 'label'=>'Factura', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-2">
                <?= $this->Form->checkbox('sen_factura', ['id'=>'sen_factura']) ?>
                <label for="sen_factura">Non aplica factura</label>
            </div>
        </div>

        <?php if($subarea_activa) : ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
        <?php endif ?>
    </fieldset>
<?= $this->Form->end() ?>
