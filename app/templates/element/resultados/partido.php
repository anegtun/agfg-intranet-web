<?php
    $text_class = "";
    if ($partido->adiado) {
        $text_class = "text-warning";
    } elseif (empty($partido->data_partido)) {
        $text_class = "text-muted";
    }

    $competicion = $partido->fase->competicion;
    $categoria = $partido->fase->categoria;
    $logoCategoria = \App\Model\Categorias::getLogo($categoria);

    if ($partido->adiado && empty($partido->data_partido)) {
        $dataOrixinal = $partido->xornada->data ?? null;
        $hora = empty($dataOrixinal)
            ? 'Data pendente'
            : $dataOrixinal->format('d/m') . ' (orixinal)';
    } else {
        $dataPartido = $partido->data_calendario ?? $partido->data_partido ?? null;
        if ($competicion->isTorneo()) {
            $hora = $partido->formatDiaHora();
        } else {
            $hora = empty($dataPartido) ? '' : $dataPartido->format('d/m');
            if (!empty($partido->hora_partido)) {
                $hora .= ($hora === '' ? '' : ' ') . $partido->hora_partido;
            }
        }

        if ($partido->adiado) {
            if ($hora === '') {
                $hora = empty($dataPartido) ? '' : $dataPartido->format('d/m');
            }
            if (!str_ends_with($hora, ' (adiado)')) {
                $hora = rtrim($hora) . ' (adiado)';
            }
        }
    }

    $faseMostrada = '';
    if ($competicion->isTorneoOuEliminatoria()) {
        $faseMostrada = " - {$partido->fase->nome}";
        if(!empty($partido->xornada->descricion)) {
            $faseMostrada .= ", {$partido->xornada->descricion}";
        }
    }

    $resaltarHora = !empty($resaltarNonConfigurado) && empty($partido->hora_partido);
    $resaltarCampo = !empty($resaltarNonConfigurado) && empty($partido->campo);
    $resaltarArbitro = !empty($resaltarNonConfigurado) && empty($partido->arbitro);
?>

<div class="agfg-partido <?= $text_class ?>">

    <div class='agfg-partido-top'>
        <div class='agfg-partido-top-data'>
            <span class="<?= $resaltarHora ? 'bg-danger' : '' ?>"><?= h($hora) ?></span>
            <?= h($faseMostrada) ?>
        </div>
        <div class='agfg-partido-top-fase'>
            <?php if ($logoCategoria !== null) : ?>
                <img src='<?= h($logoCategoria) ?>' alt='Categoría <?= h($categoria) ?>' style='max-width: 35px; height: auto;'>
            <?php endif ?>
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
        <?php if ($competicion->isTorneo()) : ?>
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