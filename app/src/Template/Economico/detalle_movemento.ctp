<?php
$this->extend('template');
if($movemento->prevision) {
    $this->set('submenu_option', 'previsions');
    $this->set('cabeceiraTitulo', empty($movemento->id) ? 'Nova previsión' : $movemento->data->format('Y-m-d'));
    $this->set('cabeceiraMigas', [
        ['label'=>'Previsións', 'url'=>['action'=>'previsions']],
        ['label'=>empty($movemento->id) ? 'Nova previsión' : $movemento->data->format('Y-m-d')]
    ]);
} else {
    $this->set('submenu_option', 'movementos');
    $this->set('cabeceiraTitulo', empty($movemento->id) ? 'Novo movemento' : $movemento->data->format('Y-m-d'));
    $this->set('cabeceiraMigas', [
        ['label'=>'Movementos', 'url'=>['action'=>'movementos']],
        ['label'=>empty($movemento->id) ? 'Novo movemento' : $movemento->data->format('Y-m-d')]
    ]);
}
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<?= $this->Form->create($movemento, ['type'=>'post', 'url'=>['action'=>'gardarMovemento']]) ?>
    <?= $this->Form->hidden('id') ?>
    <?= $this->Form->hidden('prevision') ?>
    <fieldset>
        <legend>Movemento</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$movemento->data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('importe', ['type'=>'number', 'label'=>'Importe']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('comision', ['type'=>'number', 'label'=>'Comisión']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('id_subarea', ['options'=>$this->AgfgForm->objectToKeyValue($subareas,'id','{$e->area->partidaOrzamentaria->nome} - {$e->area->nome} - {$e->nome}'), 'label'=>'Subárea', 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('conta', ['options'=>$contas, 'label'=>'Conta', 'templates'=>$emptyTemplates]) ?>
            </div>
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

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>
