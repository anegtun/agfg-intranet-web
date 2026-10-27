<?php
$this->set('cabeceiraTitulo', 'Inicio');
$this->set('cabeceiraMigas', []);
$this->set('menu_option', 'inicio');
?>

<?php if (isset($partidosUltimosSeteDias)) : ?>
    <div class="row inicio-seccion">
        <div class="col-xs-12">
            <h2>Partidos da última xornada</h2>
            <?php if (empty($partidosUltimosSeteDias)) : ?>
                <p>Non hai partidos na última xornada.</p>
            <?php else : ?>
                <div class="agfg-competicion">
                <?php foreach ($partidosUltimosSeteDias as $partido) : ?>
                    <?= $this->element('resultados/partido', [
                        'partido' => $partido,
                        'resaltarNonConfigurado' => true,
                    ]) ?>
                <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>

<?php if (isset($partidosProximos)) : ?>
    <div class="row inicio-seccion">
        <div class="col-xs-12">
            <h2>Próximos partidos</h2>
            <?php if (empty($partidosProximos)) : ?>
                <p>Non hai partidos programados nos próximos sete días.</p>
            <?php else : ?>
                <div class="agfg-competicion">
                <?php foreach ($partidosProximos as $partido) : ?>
                    <?= $this->element('resultados/partido', [
                        'partido' => $partido,
                        'ocultarResultado' => true,
                        'resaltarNonConfigurado' => true,
                    ]) ?>
                <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>

<?php if (isset($partidosAplazadosSenData)) : ?>
    <div class="row inicio-seccion">
        <div class="col-xs-12">
            <h2>Partidos aprazados sen data asignada</h2>
            <?php if (empty($partidosAplazadosSenData)) : ?>
                <p>Non hai partidos aprazados sen data asignada.</p>
            <?php else : ?>
                <div class="agfg-competicion">
                    <?php foreach ($partidosAplazadosSenData as $partido) : ?>
                        <?= $this->element('resultados/partido', [
                            'partido' => $partido,
                            'ocultarResultado' => true
                        ]) ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>

<?php if (isset($saldos)) : ?>
    <div class="row inicio-seccion">
        <div class="col-xs-12">
            <h2>Saldo actual das contas</h2>
            <?php if (empty($saldos)) : ?>
                <p>Non hai contas con saldo.</p>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Conta</th>
                                <th class="text-right">Saldo</th>
                                <th>Data do último movemento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($saldos as $saldo) : ?>
                                <tr>
                                    <td><?= h($saldo['nome']) ?></td>
                                    <td class="text-right"><?= $this->Number->currency($saldo['saldo'], 'EUR') ?></td>
                                    <td><?= $saldo['data']->format('d/m/Y') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>
