<?php
$this->extend('template');
$this->set('cabeceiraTitulo', 'Competición');
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións', 'url'=>['controller'=>'Competicions', 'action'=>'index']],
    ['label'=>empty($competicion->id) ? 'Competición' : $competicion->nome]
]);
?>

<div class="container-full" style="margin-top:2em;">
    <div class="row">
    <?= $this->Form->create($competicion, ['type'=>'post', 'url'=>['action'=>'gardar']]) ?>
            <?= $this->Form->hidden('id') ?>
            <fieldset>
                <legend>Competición</legend>
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
                <?= $this->Form->control('codigo', ['label'=>'Código (uso en WordPress)']) ?>
                <?= $this->Form->control('tempada', ['options'=>$tempadas, 'label'=>'Tempada']) ?>
                <?= $this->Form->control('tipo', ['options'=>$tiposCompeticion, 'label'=>'Tipo competición']) ?>
                <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    
    <?php if(!empty($competicion->id)) : ?>
        <div class="row" style="margin-top:2em;">
            <h3>Fases</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Fase pai</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($competicion->fases as $f) : ?>
                        <tr>
                            <td><?= empty($f->categoria) ? '' : $categorias[$f->categoria] ?></td>
                            <td><?= $f->codigo ?></td>
                            <td><?= $f->nome ?></td>
                            <td><?= empty($f->fasePai) ? '' : $f->fasePai->nome ?></td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['action'=>'detalleFase', $f->id]) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarFase', $f->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                <tbody>
            </table>
            <?= $this->Html->link('Crear', ['action'=>'detalleFase', 'idCompeticion'=>$competicion->id], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php endif ?>
    
</div>