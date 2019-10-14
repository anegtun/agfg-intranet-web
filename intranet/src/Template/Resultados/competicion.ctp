<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Horarios e resultados', 'url'=>['controller'=>'Resultados', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo">Data</th>
                        <th class="celda-titulo" colspan="3">Local</th>
                        <th class="celda-titulo" colspan="3">Visitante</th>
                        <th class="celda-titulo">Campo</th>
                        <th class="celda-titulo">Árbitro</th>
                        <th class="celda-titulo">Gañador</th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($competicion->fases as $f) : ?>
                        <?php foreach($f->xornadas as $x) : ?>
                            <tr>
                                <th colspan="11"><?= "Xornada $x->numero (".$x->data->format('Y-m-d').")" ?></th>
                            </tr>
                            <?php foreach($x->partidos as $p) : ?>
                                <tr>
                                    <td style="<?= empty($p->adiado)?'':'color:red'?>"><?= empty($d=$p->formatDataHora()) ? '-' : $d ?></td>
                                    <td class="text-center"><?= empty($equipas[$p->id_equipa1]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa1]->logo, ['width'=>30,'height'=>30]) ?></td>
                                    <td><?= $equipas[$p->id_equipa1]->nome ?></td>
                                    <td><?= $p->formatPuntuacionEquipa1() ?></td>
                                    <td class="text-center"><?= empty($equipas[$p->id_equipa2]->logo) ? '' : $this->Html->image($equipas[$p->id_equipa2]->logo, ['width'=>30,'height'=>30]) ?></td>
                                    <td><?= $equipas[$p->id_equipa2]->nome ?></td>
                                    <td><?= $p->formatPuntuacionEquipa2() ?></td>
                                    <td><?= empty($p->id_campo) ? '-' : $campos[$p->id_campo]->nome ?></td>
                                    <td><?= empty($p->id_arbitro) ? '-' : $arbitros[$p->id_arbitro]->alcume ?></td>
                                    <td><?= $p->getGanador() ?></td>
                                    <td>
                                        <?= $this->Html->link('', ['action'=>'partido', $p->id], ['class'=>'glyphicon glyphicon-edit']); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>