<?php
$this->set('menu_option', 'competicions');
$this->set('submenu_option', 'prensa');
$this->set('cabeceiraTitulo', 'Prensa');
$this->set('cabeceiraMigas', [
    ['label'=>'Competición'],
    ['label'=>'Prensa']
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$this->Html->script('prensa', ['block' => 'script']);
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('data_anterior', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data anterior', 'value'=>$data_anterior->format('d-m-Y'), 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('data_seguinte', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data seguinte', 'value'=>$data_seguinte->format('d-m-Y'), 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Ver', ['class'=>'btn btn-primary']); ?>
            <?= $this->Form->button('Copiar a portapapéis', ['class'=>'btn btn-info', 'type'=>'button', 'onclick'=>'copyClipboard("quote")']); ?>
        </div>

    <?= $this->Form->end() ?>
</div>


<blockquote id="quote">
    <p>Redacta un resumo da liga galega de fútbol gaélico nun ton formal:</p>

    <p>&nbsp;</p>

    <?php if(!empty($partidos_anterior)) : ?>

        <?php foreach($categorias as $c=>$categoria) : ?>
            <p><strong>Resultados da xornada <?= $categoria ?></strong></p>

            <?php foreach($partidos_anterior as $p) : ?>
                <?php if($p->fase->categoria == $c) : ?>
                    <p>
                        -
                        <?= $p->getNomeEquipa1() ?>
                        (<?= $p->getPuntuacionTotalEquipa1() ?>)
                        VS
                        <?= $p->getNomeEquipa2() ?>
                        (<?= $p->getPuntuacionTotalEquipa2() ?>)
                        , <?= $p->getDataHora() ?>
                        , <?= $p->campo->nome ?> (<?= $p->campo->pobo ?>)
                </p>
                <?php endif ?>

            <?php endforeach ?>
        <?php endforeach ?>

    <?php endif ?>


    <p>&nbsp;</p>


    <?php if(!empty($partidos_seguinte)) : ?>

        <?php foreach($categorias as $c=>$categoria) : ?>
            <p><strong>Partidos seguinte xornada <?= $categoria ?></strong></p>

            <?php foreach($partidos_seguinte as $p) : ?>
                <?php if($p->fase->categoria == $c) : ?>
                    <p>
                        -
                        <?= $p->getNomeEquipa1() ?>
                        VS
                        <?= $p->getNomeEquipa2() ?>
                        <?php if(!empty($p->data_partido)) : ?>
                            , <?= $p->getDataHora() ?>
                        <?php endif ?>
                        <?php if(!empty($p->campo)) : ?>
                            , <?= $p->campo->nome ?> (<?= $p->campo->pobo ?>)
                        <?php endif ?>
                    </p>
                <?php endif ?>

            <?php endforeach ?>
        <?php endforeach ?>

    <?php endif ?>

</blockquote>

<h3>Instrucións</h3>

<p>Copiar texto de arriba e pegalo en <a href="https://chat.deepseek.com/" target="_blank">deepseek.com</a> ou <a href="https://chatgpt.com/" target="_blank">chatgpt.com</a>.</p>