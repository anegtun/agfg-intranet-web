<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións', 'url'=>['controller'=>'Competicions', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

?>

<div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
        <?php foreach($partidos as $p) : ?>
            <?php
                $categoria = $p->fase->categoria;
                $logoCategoria = \App\Model\Categorias::getLogo($categoria);
                $fase = empty($p->xornada->descricion) ? $p->fase->nome : $p->xornada->descricion;
                $data_referencia = $p->data_partido ? $p->data_partido : $p->xornada->data;
                $sabado = empty($data_referencia) ? NULL : $data_referencia->modify('next monday')->modify('previous saturday')->format('Y-m-d');
            ?>

            <tr>
                <td><?= $p->formatHoraPartido() ?></td>
                <td><img src='<?= h($logoCategoria) ?>' alt='Categoría <?= h($categoria) ?>' style='max-width: 35px; height: auto;'></td>
                <td><?= $fase ?></td>
                <td><?= $p->getNomeCurtoEquipa1() ?></td>
                <td><?= $p->formatDesglose1() ?> (<?= $p->getPuntuacionTotalEquipa1() ?>)</td>
                <td><?= $p->formatDesglose2() ?> (<?= $p->getPuntuacionTotalEquipa2() ?>)</td>
                <td><?= $p->getNomeCurtoEquipa2() ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
