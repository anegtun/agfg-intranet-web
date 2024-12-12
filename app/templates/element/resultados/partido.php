<div class="agfg-partido">

    <div class='agfg-partido-top'>
        <div class='agfg-partido-top-data'><?= $hora ?></div>
        <div class='agfg-partido-top-fase'><?= $fase ?></div>
    </div>
    
    <div class="agfg-partido-equipas">
        <div class='agfg-partido-equipa'>
            <div><figure><?= empty($partido->equipa1) ? '' : $this->Html->image($partido->equipa1->getLogo(), ['width'=>25]) ?></figure></div>
            <div class='agfg-partido-equipa-nome'><?= empty($partido->equipa1) ? $partido->provisional_equipa1 : $partido->equipa1->nome_curto ?></div>
            <div class='agfg-partido-resultado-equipa1 <?= $partido->getGanador()==='L'?'agfg-partido-resultado-ganador':'' ?>'>
                <div><?= $partido->hasPuntuacionTotalEquipa1() ? $partido->getPuntuacionTotalEquipa1() : '-' ?></div>
                <?php if($partido->hasDesglose()) : ?>
                    <div class='agfg-partido-resultado-desglose'><?= $partido->formatDesglose1() ?></div>
                <?php endif ?>
            </div>
        </div>
        <div class='agfg-partido-equipa'>
            <div><figure><?= empty($partido->equipa2) ? '' : $this->Html->image($partido->equipa2->getLogo(), ['width'=>25]) ?></figure></div>
            <div class='agfg-partido-equipa-nome'><?= empty($partido->equipa2) ? $partido->provisional_equipa2 : $partido->equipa2->nome_curto ?></div>
            <div class='agfg-partido-resultado-equipa2 <?= $partido->getGanador()==='V'?'agfg-partido-resultado-ganador':'' ?>'>
                <div><?= $partido->hasPuntuacionTotalEquipa2() ? $partido->getPuntuacionTotalEquipa2() : '-' ?></div>
                <?php if($partido->hasDesglose()) : ?>
                    <div class='agfg-partido-resultado-desglose'><?= $partido->formatDesglose2() ?></div>
                <?php endif ?>
            </div>
        </div>
    </div>


    <div class='agfg-partido-bottom'>
        <div class='agfg-partido-bottom-detalle'>
            <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-estadio.jpg' alt='Campo' width='15'></figure>
            <?= empty($partido->campo) ? '-' : $partido->campo->nome_curto ?>
        </div>
        <?php if($is_torneo) : ?>
            <div class='agfg-partido-bottom-detalle'>
                <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-umpire.jpg' alt='Umpires' width='15'></figure>
                <?= empty($partido->umpire) ? '-' : "{$partido->umpire->nome} ({$partido->umpire->categoria})" ?>
            </div>
        <?php endif ?>
        <div class='agfg-partido-bottom-detalle'>
            <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2022/07/icono-silbato.jpg' alt='Árbitro' width='15'></figure>
            <?= empty($partido->arbitro) ? '-' : $partido->arbitro->alcume ?>
        </div>
    </div>

    <div class='agfg-partido-botons'>
        <div class='agfg-partido-edit'>
            <?= $this->Html->link('Editar', ['action'=>'partido', $partido->id], ['class'=>'glyphicon glyphicon-edit']); ?>
        </div>
        <?php if(!empty($partido->observacions)) : ?>
            <div class="agfg-partido-observacions">
                <?= $this->Html->link('Ver observacións', '#', ['onclick'=>'return alert("'.$partido->observacions.'")', 'class'=>'glyphicon glyphicon-exclamation-sign']); ?>
            </div>
        <?php endif ?>
    </div>

</div>