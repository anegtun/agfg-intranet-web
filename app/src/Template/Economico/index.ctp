<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Xestión Económica');
$this->set('cabeceiraMigas', [['label'=>'Xestión Económica']]);

$total = [];
foreach($contas as $k=>$v) {
    $total[$k] = 0;
}
foreach($resumo_balance as $r) {
    $total[$r->conta] = $r->balance;
}
?>

<fieldset>
    <section class="content">
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
                            <p><?= $this->Number->currency($total[$key], 'EUR') ?></p>
                            <!--a class="btn btn-default" data-toggle="tooltip">Link</a-->
                        </div>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
    </section>
</fieldset>