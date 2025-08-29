<?php
$this->extend('template');

$this->set('submenu_option', 'tempadas');
$this->set('cabeceiraTitulo', empty($tempada->codigo) ? 'Nova tempada' : $tempada->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Tempadas', 'url'=>['action'=>'tempadas']],
    ['label'=>empty($tempada->codigo) ? 'Nova tempada' : $tempada->nome]
]);
?>

<?= $this->Form->create($tempada, ['type'=>'post', 'url'=>['action'=>'gardarTempada']]) ?>
    <fieldset>
        <legend>Tempada</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('codigo', ['label'=>'Código', 'type' => 'text']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('nome_curto', ['label'=>'Nome curto']) ?>
            </div>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>
