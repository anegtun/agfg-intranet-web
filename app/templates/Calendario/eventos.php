<?php
$this->extend('template');

$this->set('submenu_option', 'eventos');
$this->set('cabeceiraTitulo', 'Calendario');
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Eventos']
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$agora = $this->Time->fromString(time());
$finalizados_param = $this->request->getQuery('finalizados');
$incluir_finalizados = !empty($finalizados_param) && $finalizados_param === 'S';
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('finalizados', ['options'=>[''=>'Non', 'S'=>'Si']]) ?>
            </div>
            <div class="col-lg-2">
                <?= $this->Form->control('tipo', ['options'=>array_merge([''=>''], $tipos)]) ?>
            </div>
        </div>

        <div style="margin-top:1em">
            <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary']); ?>
            <?= $this->Html->link(__('Crear'), ['action'=>'evento'], ['class'=>'btn btn-success']) ?>
        </div>

    <?= $this->Form->end() ?>
</div>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="column-button"></th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Lugar</th>
                    <th class="column-button"></th>
                    <th class="column-button"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($eventos as $e) : ?>
                    <?php if($e->data->greaterThan($agora) || $incluir_finalizados) : ?>
                        <tr class="<?= $e->data->greaterThan($agora) ? '' : 'text-muted' ?>">
                            <td><?= $this->Html->image("/images/eventos/{$e->tipo}.png", ['width'=>25]) ?></td>
                            <td><?= $this->Html->link($e->nome, ['action'=>'evento', $e->id]) ?></td>
                            <td><?= $e->data->format('Y-m-d') ?></td>
                            <td><?= $e->lugar ?></td>
                            <td class="text-center"><?= $this->Html->link('', ['action'=>'clonarEvento', $e->id], ['class'=>'glyphicon glyphicon-duplicate']) ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarEvento', $e->id]) ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
</div>
