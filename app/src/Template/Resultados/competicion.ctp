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

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Data</th>
                        <th class="celda-titulo">Categoría</th>
                        <th class="celda-titulo" colspan="4">Local</th>
                        <th class="celda-titulo" colspan="4">Visitante</th>
                        <th class="celda-titulo">Campo</th>
                        <th class="celda-titulo">Árbitro</th>
                        <?php if ($is_torneo) : ?>
                            <th class="celda-titulo">Umpires</th>
                        <?php endif ?>
                        <th class="celda-titulo">Gañador</th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $xornadaActual = NULL ?>
                    <?php foreach($partidos as $p) : ?>
                        <?php $seguinteLuns = $p->data_calendario->modify('monday next week') ?>
                        <?php if(empty($xornadaActual) || $xornadaActual->format('Y-m-d')!==$seguinteLuns->format('Y-m-d')) : ?>
                            <?php $xornadaActual = $seguinteLuns ?>
                            <tr>
                                <th colspan="<?= $is_torneo ? '15' : '14'?>"><?= $seguinteLuns->modify('previous saturday')->format('Y-m-d') ?></th>
                            </tr>
                        <?php endif ?>
                        <?php
                            $rowClass = ($p->cancelado || $p->non_presentado_equipa1 || $p->non_presentado_equipa2 
                                || !empty($p->sancion_puntos_equipa1) || !empty($p->sancion_puntos_equipa2))
                                    ? 'bg-danger text-danger' : '';
                        ?>
                        <tr>
                            <td class="<?= $rowClass ?> <?= $p->adiado?'text-warning':''?>"><?= empty($d=$p->formatDataHora()) ? '-' : $d ?></td>
                            <td class="<?= $rowClass ?> <?= $p->adiado?'text-warning':''?>"><?= "{$p->fase->categoria} [X.{$p->xornada->numero}]" ?></td>
                            <td class="<?= $rowClass ?> text-center"><?= empty($equipas[$p->id_equipa1]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa1]->logo, ['width'=>30,'height'=>30]) ?></td>
                            <td class="<?= $rowClass ?>"><?= $equipas[$p->id_equipa1]->nome ?></td>
                            <td class="<?= $rowClass ?>"><?= $p->formatPuntuacionEquipa1() ?></td>
                            <td class="<?= $rowClass ?>"><?= !empty($p->sancion_puntos_equipa1) ? "[-{$p->sancion_puntos_equipa1}pt]" : '' ?></td>
                            <td class="<?= $rowClass ?> text-center"><?= empty($equipas[$p->id_equipa2]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa2]->logo, ['width'=>30,'height'=>30]) ?></td>
                            <td class="<?= $rowClass ?>"><?= $equipas[$p->id_equipa2]->nome ?></td>
                            <td class="<?= $rowClass ?>"><?= $p->formatPuntuacionEquipa2() ?></td>
                            <td class="<?= $rowClass ?>"><?= !empty($p->sancion_puntos_equipa2) ? "[-{$p->sancion_puntos_equipa2}pt]" : '' ?></td>
                            <td class="<?= $rowClass ?>"><?= empty($p->id_campo) ? '-' : $campos[$p->id_campo]->nome ?></td>
                            <td class="<?= $rowClass ?>"><?= empty($p->id_arbitro) ? '-' : $arbitros[$p->id_arbitro]->alcume ?></td>
                            <?php if ($is_torneo) : ?>
                                <td class="<?= $rowClass ?>"><?= empty($p->id_umpire) ? '-' : "{$equipas[$p->id_umpire]->nome} ({$equipas[$p->id_umpire]->categoria})" ?></td>
                            <?php endif ?>
                            <td class="<?= $rowClass ?>"><?= $p->getGanador() ?></td>
                            <td class="<?= $rowClass ?>">
                                <?= $this->Html->link('', ['action'=>'partido', $p->id], ['class'=>'glyphicon glyphicon-edit']); ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
