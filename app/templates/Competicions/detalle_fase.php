<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Fase competición');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Administrar', 'url'=>['controller'=>'Competicions', 'action'=>'index']],
    ['label'=>$competicion->nome, 'url'=>['controller'=>'Competicions', 'action'=>'detalle', $competicion->id]],
    ['label'=>empty($fase->id) ? 'Fase' : $fase->nome]
]);
$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
$this->Html->script('detalle-fase', ['block' => 'script']);
?>

<div class="row">
    <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarFase'))) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_competicion') ?>
        <fieldset>
            <legend>Fase</legend>
            <?= $this->Form->control('categoria', ['options'=>$categorias, 'label'=>'Categoría']) ?>
            <?= $this->Form->control('codigo', ['label'=>'Codigo']) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('id_fase_pai', ['options'=>$this->AgfgForm->objectToKeyValue($outras_fases,'id','nome'), 'label'=>'Fase pai']) ?>

            <?php if(!empty($fase->id)) : ?>
                <label for="equipas">Equipas participantes</label>
                <div class="form-group">
                    <input type="hidden" name="equipas" class="form-control" value="">

                    <?php foreach($equipas as $e) : ?>
                        <?php
                            $equipa = null;
                            if(!empty($fase->equipas)) {
                                foreach($fase->equipas as $fe) {
                                    if($fe->id == $e->id) {
                                        $equipa = $fe;
                                    }
                                }
                            }
                        ?>
                        <label for="equipas-<?= $e->id ?>" class="selected">
                            <input type="checkbox" name="equipas[<?= $e->id ?>]" id="equipas-<?= $e->id ?>" value="<?= $e->id ?>" <?= empty($equipa) ? '' : 'checked="checked"' ?> />
                            <?= $e->nome ?>
                            <input type="number" name="puntos[<?= $e->id ?>]" id="puntos-<?= $e->id ?>" value="<?= empty($equipa->_joinData->puntos) ? '' : $equipa->_joinData->puntos ?>" />
                        </label>
                        <br/>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

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
                        <td colspan="4">
                            <?= empty($x->descricion) ? "Xornada $x->numero" : $x->descricion ?>
                            <?= empty($x->data) ? "" : " ({$x->data->format('Y-m-d')})" ?>
                        </td>
                        <td class="text-center">
                            <?= $this->AgfgForm->editButton('#', [
                                'data-xornada-id' => $x->id,
                                'data-xornada-data' => empty($x->data) ? '' : $x->data->format('d-m-Y'),
                                'data-xornada-numero' => $x->numero,
                                'data-xornada-descricion' => $x->descricion
                            ]) ?>
                        </td>
                        <td class="text-center">
                            <?= $this->AgfgForm->deleteButton(['action'=>'borrarXornada', $x->id]) ?>
                        </td>
                    </tr>
                    <?php if(!empty($x->partidos)) : ?>
                        <?php foreach($x->partidos as $p) : ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td><?= empty($p->id_equipa1) ? $p->provisional_equipa1 : $equipas_map[$p->id_equipa1] ?></td>
                                <td><?= empty($p->id_equipa2) ? $p->provisional_equipa2 : $equipas_map[$p->id_equipa2] ?></td>
                                <td><?= $p->formatDataHora() ?></td>
                                <td class="text-center">
                                    <?= $this->AgfgForm->editButton('#', [
                                        'data-partido-id'=>$p->id,
                                        'data-partido-id-xornada'=>$p->id_xornada,
                                        'data-partido-id-equipo1'=>$p->id_equipa1,
                                        'data-partido-id-equipo2'=>$p->id_equipa2,
                                        'data-partido-provisional-equipo1' => $p->provisional_equipa1,
                                        'data-partido-provisional-equipo2' => $p->provisional_equipa2,
                                        'data-partido-data' => empty($p->data_partido) ? '' : $p->data_partido->format('d-m-Y'),
                                        'data-partido-hora' => $p->hora_partido
                                    ]) ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->AgfgForm->deleteButton(['action'=>'borrarPartido', $p->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endforeach ?>
            <tbody>
        </table>
        <button id="modal-xornada-button" type="button" class="btn btn-primary">Engadir xornada</button>
        <button id="modal-partido-button" type="button" class="btn btn-primary">Engadir partido</button>
    </div>
<?php endif ?>


<div id="modalXornada" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <?= $this->Form->create($fase, array('type'=>'post', 'url'=>array('action'=>'gardarXornada'))) ?>
        <?= $this->Form->hidden('id_fase', ['value'=>$fase->id]) ?>
        <?= $this->Form->hidden('id') ?>
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
                        <?= $this->Form->control('descricion', ['label'=>'Descricion']) ?>
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
        <?= $this->Form->hidden('id') ?>
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
                        <?= $this->Form->control('id_xornada', ['options'=>$this->AgfgForm->objectToKeyValue($fase->xornadas,'id','Xornada $e->numero'), 'label'=>'Xornada']) ?>
                        <?php
                            $equipasHelper = $this->AgfgForm->objectToKeyValue($fase->equipas,'id','nome');
                            echo $this->Form->control('id_equipa1', ['options'=>$equipasHelper, 'label'=>'Equipa local']);
                            echo $this->Form->control('provisional_equipa1', ['label'=>'Equipa local (provisional)']);
                            echo $this->Form->control('id_equipa2', ['options'=>$equipasHelper, 'label'=>'Equipa visitante']);
                            echo $this->Form->control('provisional_equipa2', ['label'=>'Equipa visitante (provisional)']);
                        ?>
                        <?= $this->Form->control('data_partido', ['class'=>'form-control fld-date', 'label'=>'Data', 'templates'=>$emptyTemplates]) ?>
                        <?= $this->Form->control('hora_partido', ['class'=>'form-control fld-time', 'label'=>'Hora', 'templates'=>$emptyTemplates]) ?>
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
