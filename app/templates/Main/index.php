<?php
$this->set('cabeceiraTitulo', 'Inicio');
$this->set('cabeceiraMigas', []);
?>

<?php if (isset($saldos)) : ?>
    <div class="row">
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
