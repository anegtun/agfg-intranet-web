<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Horarios e resultados', 'url'=>['controller'=>'Resultados', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);

$this->Html->script('reemplazar-equipos', ['block' => 'script']);

$is_torneo = $competicion->tipo === 'torneo';
?>

<div class="row form-group">
    <?= $this->Form->create(null, ['type'=>'post', 'url'=>['action'=>'gardarReemplazo']]) ?>
        <?= $this->Form->hidden('id_competicion', ['value'=>$competicion->id]) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('id_orixinal', ['options'=>$this->AgfgForm->objectToKeyValue($equipas_competicion,'id','$e->nome ($e->categoria)'), 'label'=>'Equipa orixinal']) ?>
            </div>
            <div class="col-lg-3">
            <?= $this->Form->control('id_nova', ['options'=>$this->AgfgForm->objectToKeyValue($equipas_competicion,'id','$e->nome ($e->categoria)'), 'label'=>'Equipa nova']) ?>
            </div>
        </div>
        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved', 'onclick'=>'return confirm(\'Estas seguro? Isto non se pode desfacer.\')']); ?>
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

            $umpires = empty($p->id_umpire) ? '-' : "{$equipas[$p->id_umpire]->nome} ({$equipas[$p->id_umpire]->categoria})";
        ?>

        <div class="agfg-partido" data-equipa1="<?= $p->id_equipa1 ?>" data-equipa2="<?= $p->id_equipa2 ?>" data-umpire="<?= $p->id_umpire ?>">
            
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
                    <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2025/01/icono-umpire.png' alt='Umpires' width='15'></figure>
                    <?= $umpires ?>
                </div>
            </div>
        </div>

    <?php endforeach ?>

</div>
