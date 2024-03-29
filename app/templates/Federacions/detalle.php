<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Federación');
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Federacións', 'url'=>['controller'=>'Federacions', 'action'=>'index']],
    ['label'=>empty($federacion->id) ? 'Nova federación' : $federacion->nome]
]);
?>

<div class="row">
    <?= $this->Form->create($federacion, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Clube</legend>
            <?= $this->Form->control('codigo', ['label'=>'Código']) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->control('logo', ['label'=>'Logo']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>


<?php if(!empty($federacion->id)) : ?>
    <div class="row" style="margin-top:2em;">
        <h3>Clubes</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo"></th>
                    <th class="celda-titulo">Código</th>
                    <th class="celda-titulo">Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($federacion->clubes as $c) : ?>
                    <tr>
                        <td class="text-center"><?= empty($c->logo) ? '' : $this->Html->image($c->logo, ['width'=>30,'height'=>30]) ?></td>
                        <td><?= $c->codigo ?></td>
                        <td><?= $c->nome ?></td>
                    </tr>
                <?php endforeach ?>
            <tbody>
        </table>
    </div>
<?php endif ?>
