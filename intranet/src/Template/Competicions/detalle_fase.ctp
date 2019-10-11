<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Fase competición');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións', 'url'=>['controller'=>'Competicions', 'action'=>'index']],
    ['label'=>'Competición', 'url'=>['controller'=>'Competicions', 'action'=>'detalle', $competicion->id]],
    ['label'=>'Fase']
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarFase'))) ?>
            <?= $this->Form->hidden('id') ?>
            <?= $this->Form->hidden('id_competicion') ?>
            <fieldset>
                <legend>Fase</legend>
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
                <?= $this->Form->control('id_fase_pai', ['options'=>$this->AgfgForm->objectToKeyValue($outras_fases,'id','nome'), 'label'=>'Fase pai']) ?>

                <label for="equipas">Equipas participantes</label>
                <?= $this->Form->control('equipas', [
                        'label'=>false,
                        'multiple' => 'checkbox',
                        'options' => $this->AgfgForm->objectToKeyValue($equipas,'id','nome',false),
                        'templates'=>[
                            'checkboxWrapper' => '{{label}}',
                            'nestingLabel' => '<label{{attrs}}>{{input}} {{text}}</label><br/>']
                    ]);
                ?>

                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    
    <?php if(!empty($fase->id)) : ?>
        <div class="row" style="margin-top:2em;">
            <h3>Xornadas</h3>
            <table class="table table-striped table-hover">
                <tbody>
                    <?php foreach($fase->xornadas as $x) : ?>
                        <tr>
                            <td colspan="3"><?= "Xornada $x->numero ({$x->data->format('Y-m-d')})" ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarXornada', $x->id]) ?></td>
                        </tr>
                        <?php if(!empty($x->partidos)) : ?>
                            <?php foreach($x->partidos as $p) : ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><?= $equipas_map[$p->id_equipa1] ?></td>
                                    <td><?= $equipas_map[$p->id_equipa2] ?></td>
                                    <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarPartido', $p->id]) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
                <tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalXornada">Engadir xornada</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPartido">Engadir partido</button>
        </div>
    <?php endif ?>
</div>


<div id="modalXornada" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarXornada'))) ?>
        <?= $this->Form->hidden('id_fase', ['value'=>$fase->id]) ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xornada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <?= $this->Form->control('numero', ['label'=>'Número']) ?>
                        <?= $this->Form->control('data_xornada', ['class'=>'form-control fld-date', 'label'=>'Data', 'templates'=>$emptyTemplates]) ?>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pechar</button>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>



<div id="modalPartido" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarPartido'))) ?>
        <?= $this->Form->hidden('id_fase', ['value'=>$fase->id]) ?>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Partido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <?php
                            $xornadasHelper = array(''=>'');
                            foreach($fase->xornadas as $x) {
                                $xornadasHelper[$x->id] = "Xornada $x->numero ({$x->data->format('Y-m-d')})";
                            }
                            echo $this->Form->control('id_xornada', ['options'=>$xornadasHelper, 'label'=>'Xornada']);
                            
                            $equipasHelper = $this->AgfgForm->objectToKeyValue($fase->equipasData,'id','nome');
                            echo $this->Form->control('id_equipa1', ['options'=>$equipasHelper, 'label'=>'Equipa local']);
                            echo $this->Form->control('id_equipa2', ['options'=>$equipasHelper, 'label'=>'Equipa visitante']);
                        ?>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pechar</button>
                </div>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
