<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Horarios e resultados', 'url'=>['controller'=>'Resultados', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);

$is_torneo = $competicion->tipo === 'torneo';
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('id_fase', ['options'=>$this->AgfgForm->objectToKeyValue($fases,'id','nome'), 'label'=>'Fase']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','nome'), 'label'=>'Campo']) ?>
            </div>
        </div>
        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="agfg-competicion">

    <?php foreach($partidos as $p) : ?>
        <?php
            $fase = "";
            if($is_torneo) {
                $fase = empty($p->xornada->descricion) ? $p->fase->nome : $p->xornada->descricion;
            } else {
                $fase = "{$p->fase->categoria} [X.{$p->xornada->numero}]";
            }
            $hora = $is_torneo ? $p->formatDiaHora() : $p->formatDataHora();

            $logo1 = empty($equipas[$p->id_equipa1]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa1]->logo, ['width'=>25]);
            $logo2 = empty($equipas[$p->id_equipa2]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa2]->logo, ['width'=>25]);

            $total1 = $p->getPuntuacionTotalEquipa1() === NULL ? '-' : $p->getPuntuacionTotalEquipa1();
            $total2 = $p->getPuntuacionTotalEquipa2() === NULL ? '-' : $p->getPuntuacionTotalEquipa2();
            $desglose1 = (!is_null($p->goles_equipa1) || !is_null($p->goles_equipa2)) ? sprintf('%01d', $p->goles_equipa1)."-".sprintf('%02d', $p->tantos_equipa1) : '';
            $desglose2 = (!is_null($p->goles_equipa1) || !is_null($p->goles_equipa2)) ? sprintf('%01d', $p->goles_equipa2)."-".sprintf('%02d', $p->tantos_equipa2) : '';

            $campo = empty($p->id_campo) ? '-' : $campos[$p->id_campo]->nome;
            $arbitro = empty($p->id_arbitro) ? '-' : $arbitros[$p->id_arbitro]->alcume;
            $umpires = empty($p->id_umpire) ? '-' : "{$equipas[$p->id_umpire]->nome} ({$equipas[$p->id_umpire]->categoria})";
        ?>

        <div class="agfg-partido">
            
            <div class='agfg-partido-top'>
                <div class='agfg-partido-top-data'><?= $hora ?></div>
                <div class='agfg-partido-top-fase'><?= $fase ?></div>
            </div>
            
            <div class="agfg-partido-equipas">
                <div class='agfg-partido-equipa'>
                    <div><figure><?= $logo1 ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= $equipas[$p->id_equipa1]->nome ?></div>
                    <div class='agfg-partido-resultado-equipa1 <?= $p->getGanador()==='L'?'agfg-partido-resultado-ganador':'' ?>'>
                        <div><?= $total1 ?></div>
                        <?php if(!empty($desglose1)) : ?>
                            <div class='agfg-partido-resultado-desglose'><?= $desglose1 ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class='agfg-partido-equipa'>
                    <div><figure><?= $logo2 ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= $equipas[$p->id_equipa2]->nome ?></div>
                    <div class='agfg-partido-resultado-equipa2 <?= $p->getGanador()==='V'?'agfg-partido-resultado-ganador':'' ?>'>
                        <div><?= $total2 ?></div>
                        <?php if(!empty($desglose2)) : ?>
                            <div class='agfg-partido-resultado-desglose'><?= $desglose2 ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <div class='agfg-partido-bottom'>
                <div class='agfg-partido-bottom-detalle'>
                    <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-estadio.jpg' alt='Campo' width='15'></figure>
                    <?= $campo ?>
                </div>
                <?php if($is_torneo) : ?>
                    <div class='agfg-partido-bottom-detalle'>
                        <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-umpire.jpg' alt='Umpires' width='15'></figure>
                        <?= $umpires ?>
                    </div>
                <?php endif ?>
                <div class='agfg-partido-bottom-detalle'>
                    <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-silbato.jpg' alt='Árbitro' width='15'></figure>
                    <?= $arbitro ?>
                </div>
            </div>

            <div class='agfg-partido-edit'>
                <?= $this->Html->link('Editar', ['action'=>'partido', $p->id], ['class'=>'glyphicon glyphicon-edit']); ?>
            </div>

        </div>

    <?php endforeach ?>

</div>
