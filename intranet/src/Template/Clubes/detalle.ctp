<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Clube');
$this->set('cabeceiraMigas', [
    ['label'=>'Clubes', 'url'=>['controller'=>'Clubes', 'action'=>'index']],
    ['label'=>empty($clube->id) ? 'Novo clube' : $clube->nome]
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
        <?= $this->Form->create($clube, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
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

    
    <?php if(!empty($clube->id)) : ?>
        <div class="row" style="margin-top:2em;">
            <h3>Equipas</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo">Código</th>
                        <th class="celda-titulo">Nome</th>
                        <th class="celda-titulo">Categoria</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($equipas as $e) : ?>
                        <tr>
                            <td class="text-center"><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
                            <td><?= $e->codigo ?></td>
                            <td><?= $e->nome ?></td>
                            <td><?= $categorias[$e->categoria] ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleEquipa', $e->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarEquipa', $e->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                <tbody>
            </table>
            <?= $this->Html->link('Crear', ['action'=>'detalleEquipa', 'idClube'=>$clube->id], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php endif ?>
</div>