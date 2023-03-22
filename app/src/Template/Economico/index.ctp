<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Xestión Económica');
$this->set('cabeceiraMigas', [['label'=>'Xestión Económica']]);

$datos_conta = [];
foreach($contas as $k=>$v) {
    $datos_conta[$k] = [
        'total' => 0
    ];
}
foreach($resumo_balance as $r) {
    $datos_conta[$r->conta]['total'] = $r->balance + $r->comision;
}
?>

<fieldset>
    <section class="content">

        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Resumo</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>Resumo de líquido e previsións por áreas e tempadas</p>
                        <p><?= $this->Html->link(__('Ir a resumo xeral'), ['controller'=>'Movementos', 'action'=>'resumo'], ['class'=>'btn btn-default']) ?></p>
                        <p><?= $this->Html->link(__('Ir a resumo desglosado por clube'), ['controller'=>'Movementos', 'action'=>'resumoClubes'], ['class'=>'btn btn-default']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Balance líquido</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>Total:</strong> <?= $this->Number->currency($total->balance + $total->comision, 'EUR') ?></p>
                        
                        <p>
                            <ul>
                                <?php foreach($contas as $key=>$value) : ?>
                                    <?php if(!empty($datos_conta[$key]['total'])) : ?>
                                        <li><strong><?= $value ?>:</strong> <?= $this->Number->currency($datos_conta[$key]['total'], 'EUR') ?></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </p>

                        <p>
                            <ul>
                                <li><strong>Previsión ingresos:</strong> <?= $this->Number->currency($prevision->ingresos, 'EUR') ?></span>
                                <li><strong>Previsión gastos:</strong> <span class="text-danger"><?= $this->Number->currency($prevision->gastos, 'EUR') ?></span></li>
                            </ul>
                        </p>
                        <?= $this->Html->link(__('Ver movementos'), ['controller'=>'Movementos', 'action'=>'index'], ['class'=>'btn btn-default']) ?>
                        <?= $this->Html->link(__('Ver previsións'), ['controller'=>'Movementos', 'action'=>'previsions'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</fieldset>