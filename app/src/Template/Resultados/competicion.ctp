<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións'],
    ['label'=>'Horarios e resultados', 'url'=>['controller'=>'Resultados', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$is_torneo = $competicion->tipo === 'torneo';
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('id_fase', ['options'=>$this->AgfgForm->objectToKeyValue($fases,'id','$e->categoria - $e->nome'), 'label'=>'Fase']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','nome'), 'label'=>'Campo']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('pendente', ['options'=>['0'=>'Non', '1'=>'Si'], 'default'=>'1']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary', 'style'=> ['margin-top: 1.7em']]); ?>
            </div>
        </div>

        <?php if($is_torneo) : ?>
            <div class="row">
                <div class="col-lg-3">
                    <?= $this->Html->link('Reemplazar equipos', ['action'=>'reemplazar', $competicion->id], ['class'=>'btn btn-success']) ?>
                </div>
            </div>
        <?php endif ?>
    <?= $this->Form->end() ?>
</div>

<div class="agfg-competicion">

    <?php $data_xornada = "" ?>

    <?php foreach($partidos as $p) : ?>
        <?php
            $fase = "";
            if($is_torneo) {
                $fase = empty($p->xornada->descricion) ? $p->fase->nome : $p->xornada->descricion;
            } else {
                $fase = "{$p->fase->categoria} [X.{$p->xornada->numero}]";
            }
            $hora = $is_torneo ? $p->formatDiaHora() : $p->formatDataHora();
            if(empty($hora) && !empty($p->adiado)) {
                $hora = '(adiado)';
            }

            $data_referencia = $p->data_partido ? $p->data_partido : $p->xornada->data;
            $sabado = $data_referencia->modify('next monday')->modify('previous saturday')->format('Y-m-d');

            $nome1 = empty($p->id_equipa1) ? $p->provisional_equipa1 : $equipas[$p->id_equipa1]->nome_curto;
            $nome2 = empty($p->id_equipa2) ? $p->provisional_equipa2 : $equipas[$p->id_equipa2]->nome_curto;
            $logo1 = empty($p->id_equipa1) ? '' : $equipas[$p->id_equipa1]->getLogo();
            $logo2 = empty($p->id_equipa2) ? '' : $equipas[$p->id_equipa2]->getLogo();

            $total1 = $p->getPuntuacionTotalEquipa1() === NULL ? '-' : $p->getPuntuacionTotalEquipa1();
            $total2 = $p->getPuntuacionTotalEquipa2() === NULL ? '-' : $p->getPuntuacionTotalEquipa2();
            $desglose1 = (!is_null($p->goles_equipa1) || !is_null($p->goles_equipa2)) ? sprintf('%01d', $p->goles_equipa1)."-".sprintf('%02d', $p->tantos_equipa1) : '';
            $desglose2 = (!is_null($p->goles_equipa1) || !is_null($p->goles_equipa2)) ? sprintf('%01d', $p->goles_equipa2)."-".sprintf('%02d', $p->tantos_equipa2) : '';

            $campo = empty($p->id_campo) ? '-' : $campos[$p->id_campo]->nome_curto;
            $arbitro = empty($p->id_arbitro) ? '-' : $arbitros[$p->id_arbitro]->alcume;
            $umpires = empty($p->id_umpire) ? '-' : "{$equipas[$p->id_umpire]->nome} ({$equipas[$p->id_umpire]->categoria})";
        ?>

        <?php if($data_xornada !== $sabado) : ?>
            <?php $data_xornada = $sabado; ?>
            <div class="agfg-xornada"><?= $data_xornada ?></div>
        <?php endif?>

        <div class="agfg-partido">
            
            <div class='agfg-partido-top'>
                <div class='agfg-partido-top-data'><?= $hora ?></div>
                <div class='agfg-partido-top-fase'><?= $fase ?></div>
            </div>
            
            <div class="agfg-partido-equipas">
                <div class='agfg-partido-equipa'>
                    <div><figure><?= empty($logo1) ? '' : $this->Html->image($logo1, ['width'=>25]) ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= $nome1 ?></div>
                    <div class='agfg-partido-resultado-equipa1 <?= $p->getGanador()==='L'?'agfg-partido-resultado-ganador':'' ?>'>
                        <div><?= $total1 ?></div>
                        <?php if(!empty($desglose1)) : ?>
                            <div class='agfg-partido-resultado-desglose'><?= $desglose1 ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class='agfg-partido-equipa'>
                    <div><figure><?= empty($logo2) ? '' : $this->Html->image($logo2, ['width'=>25]) ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= $nome2 ?></div>
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

            <div class='agfg-partido-botons'>
                <div class='agfg-partido-edit'>
                    <?= $this->Html->link('Editar', ['action'=>'partido', $p->id], ['class'=>'glyphicon glyphicon-edit']); ?>
                </div>
                <?php if(!empty($p->observacions)) : ?>
                    <div class="agfg-partido-observacions">
                        <?= $this->Html->link('Ver observacións', '#', ['onclick'=>'return alert("'.$p->observacions.'")', 'class'=>'glyphicon glyphicon-exclamation-sign']); ?>
                    </div>
                <?php endif ?>
            </div>

        </div>

    <?php endforeach ?>

</div>
