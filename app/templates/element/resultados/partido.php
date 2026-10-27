<?php
    $text_class = "";
    if ($partido->adiado) {
        $text_class = "text-warning";
    } elseif (empty($partido->data_partido)) {
        $text_class = "text-muted";
    }

    $competicion = $partido->fase->competicion;
    $categoria = $partido->fase->categoria;

    $logosCategoria = [
        'M' => 'https://compartir.gaelicogalego.gal/content/logos/federacions/gaa-min.png',
        'F' => 'https://compartir.gaelicogalego.gal/content/logos/federacions/lgfa-min.png',
        'E' => 'https://compartir.gaelicogalego.gal/content/logos/gaelico-escolas/gaelico-escolas-min.png'
    ];
    $horaMostrada = preg_replace_callback(
        '/\b(\d{4})-(\d{2})-(\d{2})(?:\s+(\d{2}:\d{2}))?/',
        function ($coincidencias) {
            $data = "{$coincidencias[3]}/{$coincidencias[2]}";
            return isset($coincidencias[4]) ? "{$data} {$coincidencias[4]}" : $data;
        },
        $hora
    );

    $faseMostrada = '';
    if ($competicion->isTorneoOuEliminatoria()) {
        $faseMostrada = empty($partido->xornada->descricion) ? $partido->fase->nome : $partido->xornada->descricion;
    }

    $resaltarHora = !empty($resaltarNonConfigurado) && empty($partido->hora_partido);
    $resaltarCampo = !empty($resaltarNonConfigurado) && empty($partido->campo);
    $resaltarArbitro = !empty($resaltarNonConfigurado) && empty($partido->arbitro);
?>

<div class="agfg-partido <?= $text_class ?>">

    <div class='agfg-partido-top'>
        <div class='agfg-partido-top-data'>
            <span class="<?= $resaltarHora ? 'bg-danger' : '' ?>"><?= h($horaMostrada) ?></span>
        </div>
        <div class='agfg-partido-top-fase'>
            <?php if (isset($logosCategoria[$categoria])) : ?>
                <img src='<?= $logosCategoria[$categoria] ?>' alt='Categoría <?= h($categoria) ?>' style='max-width: 35px; height: auto;'>
            <?php endif ?>
            <?= h($faseMostrada) ?>
        </div>
    </div>
    
    <div class="agfg-partido-equipas">
        <div class='agfg-partido-equipa'>
            <div><figure><?= $this->AgfgForm->logo($partido->equipa1, ['size'=>25]) ?></figure></div>
            <div class='agfg-partido-equipa-nome'><?= $partido->getNomeCurtoEquipa1() ?></div>
            <?php if (empty($ocultarResultado)) : ?>
                <div class='agfg-partido-resultado-equipa1 <?= $partido->getGanador()==='L'?'agfg-partido-resultado-ganador':'' ?>'>
                    <div><?= $partido->hasPuntuacionTotalEquipa1() ? $partido->getPuntuacionTotalEquipa1() : '-' ?></div>
                    <?php if($partido->hasDesglose()) : ?>
                        <div class='agfg-partido-resultado-desglose'><?= $partido->formatDesglose1() ?></div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
        <div class='agfg-partido-equipa'>
            <div><figure><?= $this->AgfgForm->logo($partido->equipa2, ['size'=>25]) ?></figure></div>
            <div class='agfg-partido-equipa-nome'><?= $partido->getNomeCurtoEquipa2() ?></div>
            <?php if (empty($ocultarResultado)) : ?>
                <div class='agfg-partido-resultado-equipa2 <?= $partido->getGanador()==='V'?'agfg-partido-resultado-ganador':'' ?>'>
                    <div><?= $partido->hasPuntuacionTotalEquipa2() ? $partido->getPuntuacionTotalEquipa2() : '-' ?></div>
                    <?php if($partido->hasDesglose()) : ?>
                        <div class='agfg-partido-resultado-desglose'><?= $partido->formatDesglose2() ?></div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>


    <div class='agfg-partido-bottom'>
        <div class='agfg-partido-bottom-detalle <?= $resaltarCampo ? 'bg-danger' : '' ?>'>
            <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2025/01/icono-estadio.png' alt='Campo' width='15'></figure>
            <?= empty($partido->campo) ? '-' : $partido->campo->nome_curto ?>
        </div>
        <?php if (!$partido->fase->competicion->isLiga()) : ?>
            <div class='agfg-partido-bottom-detalle'>
                <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2025/01/icono-umpire.png' alt='Umpires' width='15'></figure>
                <?= empty($partido->umpire) ? '-' : "{$partido->umpire->nome} ({$partido->umpire->categoria})" ?>
            </div>
        <?php endif ?>
        <div class='agfg-partido-bottom-detalle <?= $resaltarArbitro ? 'bg-danger' : '' ?>'>
            <figure><img class='alignnone' src='https://gaelicogalego.gal/wp-content/uploads/2025/01/icono-silbato.png' alt='Árbitro' width='15'></figure>
            <?= empty($partido->arbitro) ? '-' : $partido->arbitro->alcume ?>
        </div>
    </div>

    <div class='agfg-partido-botons'>
        <div class='agfg-partido-edit'>
            <?= $this->Html->link('Editar', [
                'controller' => 'Resultados',
                'action' => 'partido',
                $partido->id,
                '?' => ['urlReferrer' => $this->request->getRequestTarget()],
            ], ['class'=>'glyphicon glyphicon-edit']); ?>
        </div>
        <?php if(!empty($partido->observacions)) : ?>
            <div class="agfg-partido-observacions">
                <?= $this->Html->link('Ver observacións', '#', ['onclick'=>'return alert("'.$partido->observacions.'")', 'class'=>'glyphicon glyphicon-exclamation-sign']); ?>
            </div>
        <?php endif ?>
    </div>

</div>