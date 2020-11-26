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
                            <span>Total</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>Balance:</strong> <?= $this->Number->currency($total->balance + $total->comision, 'EUR') ?></p>
                        <?= $this->Html->link(__('Movementos'), ['controller'=>'Movementos', 'action'=>'index'], ['class'=>'btn btn-default']) ?>
                        <?= $this->Html->link(__('Resumo'), ['controller'=>'Movementos', 'action'=>'resumo'], ['class'=>'btn btn-default']) ?>
                        <?= $this->Html->link(__('Resumo clubes'), ['controller'=>'Movementos', 'action'=>'resumoClubes'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <em class="glyphicon glyphicon-info-sign"></em>
                            <span>Configuración</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>Administrar configuración</p>
                        <?= $this->Html->link(__('Áreas'), ['action'=>'areas'], ['class'=>'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</fieldset>