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

$campos = [];
$fases = [];
foreach($partidos_competicion as $p) {
    if(!empty($p->fase)) {
        $fases[$p->id_fase] = $p->fase;
    }
    if(!empty($p->campo)) {
        $campos[$p->id_campo] = $p->campo;
    }
}
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

    <?php foreach($partidos_filtrados as $p) : ?>
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
            $sabado = empty($data_referencia) ? NULL : $data_referencia->modify('next monday')->modify('previous saturday')->format('Y-m-d');
        ?>

        <?php if(!empty($sabado) && $data_xornada !== $sabado) : ?>
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
                    <div><figure><?= empty($p->equipa1) ? '' : $this->Html->image($p->equipa1->getLogo(), ['width'=>25]) ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= empty($p->equipa1) ? $p->provisional_equipa1 : $p->equipa1->nome_curto ?></div>
                    <div class='agfg-partido-resultado-equipa1 <?= $p->getGanador()==='L'?'agfg-partido-resultado-ganador':'' ?>'>
                        <div><?= $p->hasPuntuacionTotalEquipa1() ? $p->getPuntuacionTotalEquipa1() : '-' ?></div>
                        <?php if($p->hasDesglose()) : ?>
                            <div class='agfg-partido-resultado-desglose'><?= $p->formatDesglose1() ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class='agfg-partido-equipa'>
                    <div><figure><?= empty($p->equipa2) ? '' : $this->Html->image($p->equipa2->getLogo(), ['width'=>25]) ?></figure></div>
                    <div class='agfg-partido-equipa-nome'><?= empty($p->equipa2) ? $p->provisional_equipa2 : $p->equipa2->nome_curto ?></div>
                    <div class='agfg-partido-resultado-equipa2 <?= $p->getGanador()==='V'?'agfg-partido-resultado-ganador':'' ?>'>
                        <div><?= $p->hasPuntuacionTotalEquipa2() ? $p->getPuntuacionTotalEquipa2() : '-' ?></div>
                        <?php if($p->hasDesglose()) : ?>
                            <div class='agfg-partido-resultado-desglose'><?= $p->formatDesglose2() ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>


            <div class='agfg-partido-bottom'>
                <div class='agfg-partido-bottom-detalle'>
                    <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-estadio.jpg' alt='Campo' width='15'></figure>
                    <?= empty($p->campo) ? '-' : $p->campo->nome_curto ?>
                </div>
                <?php if($is_torneo) : ?>
                    <div class='agfg-partido-bottom-detalle'>
                        <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-umpire.jpg' alt='Umpires' width='15'></figure>
                        <?= empty($p->umpire) ? '-' : "{$p->umpire->nome} ({$p->umpire->categoria})" ?>
                    </div>
                <?php endif ?>
                <div class='agfg-partido-bottom-detalle'>
                    <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-silbato.jpg' alt='Árbitro' width='15'></figure>
                    <?= empty($p->arbitro) ? '-' : $p->arbitro->alcume ?>
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
