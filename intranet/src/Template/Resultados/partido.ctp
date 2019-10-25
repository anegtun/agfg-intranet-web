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
            <legend>Partido</legend>
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
                    <?= $this->Form->checkbox('adiado', ['templates'=>$emptyTemplates]) ?> Adiado (marcar en caso de que o partido non se vaia xogar na fin de semana da xornada)
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3" style="padding-top: 1.5em;">
                    <?= $equipas[$partido->id_equipa1]->nome ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $this->Form->control('goles_equipa1', ['class'=>'form-control','label'=>'Goles', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $this->Form->control('tantos_equipa1', ['class'=>'form-control','label'=>'Tantos', 'templates'=>$emptyTemplates]) ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3" style="padding-top: 1.5em;">
                    <?= $equipas[$partido->id_equipa2]->nome ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $this->Form->control('goles_equipa2', ['class'=>'form-control','label'=>'Goles', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-1">
                    <?= $this->Form->control('tantos_equipa2', ['class'=>'form-control','label'=>'Tantos', 'templates'=>$emptyTemplates]) ?>
                </div>
            </div>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
