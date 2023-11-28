<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', empty($partidaOrzamentaria->id) ? 'Nova partida orzamentaria' : $partidaOrzamentaria->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas Orzamentarias', 'url'=>['controller'=>'Economico', 'action'=>'partidasOrzamentarias']],
    ['label'=>empty($partidaOrzamentaria->id) ? 'Nova' : $partidaOrzamentaria->nome]
]);
?>

<div class="row">
    <?= $this->Form->create($partidaOrzamentaria, ['type'=>'post', 'url'=>['action'=>'gardarPartidaOrzamentaria']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Partida Orzamentaria</legend>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>
