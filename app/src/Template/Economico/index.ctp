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

        <h3 style="color:#1d71b8;">Balance total</h3>

        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Líquido</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>Balance:</strong> <?= $this->Number->currency($total->balance + $total->comision, 'EUR') ?></p>
                        <?= $this->Html->link(__('Movementos'), ['controller'=>'Movementos', 'action'=>'index'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Previsións</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            <span style="margin-right:4em;"><strong>Ingresos:</strong> <?= $this->Number->currency($prevision->ingresos, 'EUR') ?></span>
                            <span><strong>Gastos:</strong> <span class="text-danger"><?= $this->Number->currency($prevision->gastos, 'EUR') ?></span></span>
                        </p>
                        <?= $this->Html->link(__('Previsión movementos'), ['controller'=>'Movementos', 'action'=>'previsions'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
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
                        <?= $this->Html->link(__('Resumo'), ['controller'=>'Movementos', 'action'=>'resumo'], ['class'=>'btn btn-default']) ?>
                        <?= $this->Html->link(__('Resumo clubes'), ['controller'=>'Movementos', 'action'=>'resumoClubes'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>

        <h3 style="color:#1d71b8;">Líquido por conta</h3>

        <div class="row">
            <?php foreach($contas as $key=>$value) : ?>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <em class="glyphicon glyphicon-info-sign"></em>
                                <span><?= $value ?></span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <p><strong>Balance:</strong> <?= $this->Number->currency($datos_conta[$key]['total'], 'EUR') ?></p>
                            <?= $this->Html->link(__('Movementos'), ['controller'=>'Movementos', 'action'=>'index', '?' => ['conta'=>$key]], ['class'=>'btn btn-default']) ?>
                       </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <h3 style="color:#1d71b8;">Configuración</h3>

        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Áreas</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>Podes modificar as áreas e subáreas dos movementos</p>
                        <?= $this->Html->link(__('Áreas'), ['action'=>'areas'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</fieldset>