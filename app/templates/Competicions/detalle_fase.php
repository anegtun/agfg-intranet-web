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
$opciones_xornadas = ['' => ''];
foreach ($fase->xornadas as $xornada) {
    $nome_xornada = "Xornada {$xornada->numero}";
    if (!empty($xornada->data)) {
        $nome_xornada .= ' - ' . $xornada->data->format('Y-m-d');
    }
    $opciones_xornadas[$xornada->id] = $nome_xornada;
}
?>

<div class="row">
    <?= $this->Form->create($fase, ['type'=>'post', 'url'=>['action'=>'gardarFase']]) ?>
        <?= $this->Form->hidden('id') ?>
        <?= $this->Form->hidden('id_competicion') ?>
        <fieldset>
            <legend>Fase</legend>
            <?= $this->Form->control('categoria', ['options'=>$categorias, 'label'=>'Categoría']) ?>
            <?= $this->Form->control('tipo', ['options'=>$tiposFase, 'label'=>'Tipo de fase']) ?>
            <?= $this->Form->control('codigo', ['label'=>'Codigo']) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('id_fase_pai', ['options'=>$this->AgfgForm->objectToKeyValue($outras_fases, 'id', 'nome'), 'label'=>'Fase pai']) ?>
            <?= $this->Form->control('prioridade', ['label'=>'Orde']) ?>

            <?php if(!empty($fase->id)) : ?>
                <fieldset class="form-group">
                    <legend>Equipas participantes</legend>
                    <input type="hidden" name="equipas" class="form-control" value="">
                    <?php
                        $equipasDaFase = [];
                        foreach($fase->equipas as $equipaDaFase) {
                            $equipasDaFase[$equipaDaFase->id] = $equipaDaFase;
                        }
                        $equipas = $equipas->toArray();
                        $ordemAlfabetica = [];
                        foreach($equipas as $indice => $equipaLista) {
                            $ordemAlfabetica[$equipaLista->id] = $indice;
                        }
                        usort($equipas, function ($a, $b) use ($equipasDaFase, $ordemAlfabetica) {
                            $seleccionadaA = isset($equipasDaFase[$a->id]);
                            $seleccionadaB = isset($equipasDaFase[$b->id]);
                            if ($seleccionadaA !== $seleccionadaB) {
                                return $seleccionadaA ? -1 : 1;
                            }

                            $posicionA = $equipasDaFase[$a->id]->_joinData->posicion ?? null;
                            $posicionB = $equipasDaFase[$b->id]->_joinData->posicion ?? null;
                            if (($posicionA === null) !== ($posicionB === null)) {
                                return $posicionA === null ? 1 : -1;
                            }
                            if ($posicionA !== null && (int)$posicionA !== (int)$posicionB) {
                                return (int)$posicionA <=> (int)$posicionB;
                            }

                            return $ordemAlfabetica[$a->id] <=> $ordemAlfabetica[$b->id];
                        });
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width: 1%;"></th>
                                    <th>Equipa</th>
                                    <?php if($competicion->isLiga()) : ?>
                                        <th>Puntos</th>
                                    <?php endif ?>
                                    <?php if($competicion->isLiga() || $competicion->isTorneoOuEliminatoria()) : ?>
                                        <th>Posición final</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($equipas as $e) : ?>
                                    <?php
                                        $equipa = $equipasDaFase[$e->id] ?? null;
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="equipas[<?= $e->id ?>]" id="equipas-<?= $e->id ?>" value="<?= $e->id ?>" <?= empty($equipa) ? '' : 'checked="checked"' ?> aria-label="<?= h($e->nome) ?>" style="margin: 0; vertical-align: middle;" />
                                        </td>
                                        <td><label for="equipas-<?= $e->id ?>" style="margin: 0;"><?= h($e->nome) ?></label></td>
                                        <?php if($competicion->isLiga()) : ?>
                                            <td>
                                                <input type="number" name="puntos[<?= $e->id ?>]" id="puntos-<?= $e->id ?>" class="form-control input-sm" value="<?= empty($equipa) || empty($equipa->_joinData->puntos) ? '' : $equipa->_joinData->puntos ?>" style="max-width: 100px;" />
                                            </td>
                                        <?php endif ?>
                                        <?php if($competicion->isLiga() || $competicion->isTorneoOuEliminatoria()) : ?>
                                            <td>
                                                <input type="number" name="posicions[<?= $e->id ?>]" id="posicions-<?= $e->id ?>" class="form-control input-sm" min="1" step="1" placeholder="Posición final" value="<?= empty($equipa) || empty($equipa->_joinData->posicion) ? '' : $equipa->_joinData->posicion ?>" style="max-width: 120px;" />
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
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
                        <td colspan="6">
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
                            <tr class="<?= $p->adiado ? 'warning' : '' ?>">
                                <td>&nbsp;</td>
                                <td><?= $this->AgfgForm->logo($p->equipa1, ['size'=>20]) ?> <?= $p->getNomeEquipa1() ?></td>
                                <td><?= $this->AgfgForm->logo($p->equipa2, ['size'=>20]) ?> <?= $p->getNomeEquipa2() ?></td>
                                <td><?= $p->formatDataHora() ?></td>
                                <td>
                                    <?= $p->hasPuntuacionTotalEquipa1() ? $p->getPuntuacionTotalEquipa1() : '-' ?>
                                    -
                                    <?= $p->hasPuntuacionTotalEquipa2() ? $p->getPuntuacionTotalEquipa2() : '-' ?>
                                </td>
                                <td><?= $p->campo->nome ?></td>
                                <td class="text-center">
                                    <?= $this->AgfgForm->editButton('#', [
                                        'data-partido-id'=>$p->id,
                                        'data-partido-id-xornada'=>$p->id_xornada,
                                        'data-partido-id-equipo1'=>$p->id_equipa1,
                                        'data-partido-id-equipo2'=>$p->id_equipa2,
                                        'data-partido-provisional-equipo1' => $p->provisional_equipa1,
                                        'data-partido-provisional-equipo2' => $p->provisional_equipa2,
                                        'data-partido-data' => empty($p->data_partido) ? '' : $p->data_partido->format('d-m-Y'),
                                        'data-partido-hora' => $p->hora_partido,
                                        'data-partido-id-campo' => $p->campo->id
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
    <?= $this->Form->create($fase, ['type'=>'post', 'url'=>['action'=>'gardarXornada']]) ?>
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
    <?= $this->Form->create($fase, ['type'=>'post', 'url'=>['action'=>'gardarPartido']]) ?>
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
                        <?= $this->Form->control('id_xornada', ['options'=>$opciones_xornadas, 'label'=>'Xornada']) ?>
                        <?php
                            $equipasHelper = $this->AgfgForm->objectToKeyValue($fase->equipas,'id','nome');
                            echo $this->Form->control('id_equipa1', ['options'=>$equipasHelper, 'label'=>'Equipa local']);
                            echo $this->Form->control('provisional_equipa1', ['label'=>'Equipa local (provisional)']);
                            echo $this->Form->control('id_equipa2', ['options'=>$equipasHelper, 'label'=>'Equipa visitante']);
                            echo $this->Form->control('provisional_equipa2', ['label'=>'Equipa visitante (provisional)']);
                        ?>
                        <?= $this->Form->control('data_partido', ['class'=>'form-control fld-date', 'label'=>'Data', 'templates'=>$emptyTemplates]) ?>
                        <?= $this->Form->control('hora_partido', ['class'=>'form-control fld-time', 'label'=>'Hora', 'templates'=>$emptyTemplates]) ?>
                        <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','{$e->pobo} - {$e->nome}'), 'label'=>'Campo']) ?>
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
