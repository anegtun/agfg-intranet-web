<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $partido->competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Horarios e resultados', 'url'=>['controller'=>'Resultados', 'action'=>'index']],
    ['label'=>$partido->competicion->nome, 'url'=>['controller'=>'Resultados', 'action'=>'competicion', $partido->competicion->id]],
    ['label'=>$equipas[$partido->id_equipa1]->nome.' - '.$equipas[$partido->id_equipa2]->nome]
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<div class="container-full" style="margin-top:2em;">
    <?= $this->Form->create($partido, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_competicion', ['value'=>$partido->competicion->id]) ?>
        <fieldset>
            <legend><?=$partido->competicion->nome?> - <?=$categorias[$partido->fase->categoria]?> - Xornada <?=$partido->xornada->numero?> (<?=$partido->xornada->data?>)</legend>
            <div class="row">
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('data', ['class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$partido->data_partido_str, 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('hora_partido', ['class'=>'form-control fld-time', 'label'=>'Hora', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','$e->pobo - $e->nome'), 'label'=>'Campo', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('id_arbitro', ['options'=>$this->AgfgForm->objectToKeyValue($arbitros,'id','$e->alcume ($e->nome)'), 'label'=>'Árbitro', 'templates'=>$emptyTemplates]) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-8">
                    <?= $this->Form->checkbox('adiado', ['id'=>'adiado','templates'=>$emptyTemplates]) ?>
                    <label for="adiado">Adiado (marcar en caso de que o partido se xogue nunha semana diferente)</label>
                </div>
            </div>
            <div class="clearfix">
                <div class="col-lg-6">
                    <div class="row">
                        <h3>
                            <?php if(!empty($equipas[$partido->id_equipa1]->logo)) : ?>
                                <?= $this->Html->image($equipas[$partido->id_equipa1]->logo, ['width'=>30]) ?>&nbsp;
                            <?php endif ?>
                            <?= $equipas[$partido->id_equipa1]->nome ?>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('goles_equipa1', ['class'=>'form-control','label'=>'Goles', 'templates'=>$emptyTemplates]) ?>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('tantos_equipa1', ['class'=>'form-control','label'=>'Tantos', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 partido-check">
                            <input type="checkbox" id="sen_desglose1" <?=!is_null($partido->total_equipa1)?'checked="checked"':''?> />
                            <label for="sen_desglose1">Sen puntuación desglosada</label>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('total_equipa1', ['class'=>'form-control','label'=>'Total', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 partido-check">
                            <?= $this->Form->checkbox('non_presentado_equipa1', ['id'=>'non_presentado_equipa1', 'templates'=>$emptyTemplates]) ?>
                            <label for="non_presentado_equipa1">Non presentado</label>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('sancion_puntos_equipa1', ['class'=>'form-control','label'=>'Sanción pts.', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <h3>
                            <?php if(!empty($equipas[$partido->id_equipa2]->logo)) : ?>
                                <?= $this->Html->image($equipas[$partido->id_equipa2]->logo, ['width'=>30]) ?>&nbsp;
                            <?php endif ?>
                            <?= $equipas[$partido->id_equipa2]->nome ?>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('goles_equipa2', ['class'=>'form-control','label'=>'Goles', 'templates'=>$emptyTemplates]) ?>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('tantos_equipa2', ['class'=>'form-control','label'=>'Tantos', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 partido-check">
                            <input type="checkbox" id="sen_desglose2" <?=!is_null($partido->total_equipa2)?'checked="checked"':''?> />
                            <label for="sen_desglose2">Sen puntuación desglosada</label>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('total_equipa2', ['class'=>'form-control','label'=>'Total', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 partido-check">
                            <?= $this->Form->checkbox('non_presentado_equipa2', ['id'=>'non_presentado_equipa2', 'templates'=>$emptyTemplates]) ?>
                            <label for="non_presentado_equipa2">Non presentado</label>
                        </div>
                        <div class="form-group col-lg-2">
                            <?= $this->Form->control('sancion_puntos_equipa2', ['class'=>'form-control','label'=>'Sanción pts.', 'templates'=>$emptyTemplates]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>


<?php
$this->Html->scriptStart(['block' => true]);
echo "$(document).ready(function() {
    $('#sen_desglose1').change(function() {
        $('input[name=\"goles_equipa1\"], input[name=\"tantos_equipa1\"]').prop('disabled', this.checked);
        $('input[name=\"total_equipa1\"]').prop('disabled', !this.checked);
    });
    $('#sen_desglose2').change(function() {
        $('input[name=\"goles_equipa2\"], input[name=\"tantos_equipa2\"]').prop('disabled',this.checked);
        $('input[name=\"total_equipa2\"]').prop('disabled', !this.checked);
    });

    $('#sen_desglose1, #sen_desglose2').change();
});";
$this->Html->scriptEnd();
?>