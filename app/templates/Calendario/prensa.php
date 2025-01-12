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
        </div>

    <?= $this->Form->end() ?>
</div>


<blockquote>
    <p>Redacta un resumo da liga galega de fútbol gaélico nun ton formal:</p>

    <p>&nbsp;</p>

    <?php if(!empty($partidos_anterior)) : ?>

        <?php foreach($categorias as $c=>$categoria) : ?>
            <p><strong>Resultados da xornada <?= $categoria ?></strong></p>

            <?php foreach($partidos_anterior as $p) : ?>
                <?php if($p->fase->categoria == $c) : ?>
                    <p>
                        -
                        <?= empty($p->equipa1) ? $p->provisional_equipa1 : $p->equipa1->nome ?>
                        (<?= $p->getPuntuacionTotalEquipa1() ?>)
                        VS
                        <?= empty($p->equipa2) ? $p->provisional_equipa2 : $p->equipa2->nome ?>
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
                        <?= empty($p->equipa1) ? $p->provisional_equipa1 : $p->equipa1->nome ?>
                        VS
                        <?= empty($p->equipa2) ? $p->provisional_equipa2 : $p->equipa2->nome ?>
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

<ol>
    <li>
        Copiar texto de arriba e pegalo en <a href="https://toolbaz.com/writer/ai-text-generator">toolbaz.com</a>. Configuración recomendada:
        <ul>
            <li>AI Model: O1-Mini</li>
            <li>Tone/Mood: Profesional</li>
            <li>Content Structure: Paragraphs</li>
        </ul>
    </li>
    <li>Copiar texto xerado e pegalo en <a href="https://tradutorgaio.xunta.gal/TradutorPublico/traducir/index">Gaio</a></li>
    <li>Repasar texto xerado e pegalo como artigo na <a href="https://gaelicogalego.gal/wp-admin/post-new.php?post_title=">Web</a>.</li>
</ol>