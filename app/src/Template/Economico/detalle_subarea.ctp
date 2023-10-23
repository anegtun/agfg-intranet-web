<?php
$this->extend('template_areas');
$this->set('cabeceiraTitulo', empty($subarea->id) ? 'Nova subárea' : $subarea->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Configuración'],
    ['label'=>'Partidas Orzamentarias', 'url'=>['controller'=>'Economico', 'action'=>'partidasOrzamentarias']],
    ['label'=>empty($subarea->id) ? 'Nova subárea' : $subarea->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<div class="row">
    <?= $this->Form->create($subarea, ['type'=>'post', 'url'=>['action'=>'gardarSubarea']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend>Subárea</legend>
            <?= $this->Form->control('id_area', ['options'=>$this->AgfgForm->objectToKeyValue($areas,'id','{$e->partidaOrzamentaria->nome} - {$e->nome}'), 'label'=>'Área', 'templates'=>$emptyTemplates]) ?>
            <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary']); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>

<?php if (!empty($subarea->id)) : ?>
    <div class="row" style="margin-top:2em">
        <h3>Movementos asociados</h3>

        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="celda-titulo text-center">Data</th>
                        <th class="celda-titulo text-center">Importe</th>
                        <th class="celda-titulo text-center">Tempada</th>
                        <th class="celda-titulo text-center">Conta</th>
                        <th class="celda-titulo">Descricición</th>
                        <th class="celda-titulo"></th>
                        <th class="celda-titulo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($movementos as $m) : ?>
                        <tr>
                            <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                            <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>">
                                <?php if (!empty($m->comision)) : ?>
                                    <a title="Comisión: <?= $this->Number->currency($m->comision, 'EUR') ?>" class="glyphicon glyphicon-euro" href="javascript:void(0)" data-toggle="tooltip">&nbsp;</a>
                                <?php endif ?>
                                <?= $this->Number->currency($m->importe, 'EUR') ?>
                            </td>
                            <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                            <td class="text-center"><?= empty($m->conta) ? '' : $this->Html->image("/images/conta-{$m->conta}-logo.png", ['width'=>30,'height'=>30]) ?></td>
                            <td>
                                <?= $m->descricion ?>
                                <?php if(!empty($m->clube)) : ?>
                                    - <?= $this->Html->image($m->clube->logo, ['width'=>25,'height'=>25]) . ' ' . $m->clube->codigo ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php if(!empty($m->referencia)) : ?>
                                    <a title="<?= $m->referencia ?>" class="glyphicon glyphicon-info-sign" href="javascript:void(0)" data-toggle="tooltip"></a>
                                <?php endif ?>
                            </td>
                            <td class="text-center"><?= $this->AgfgForm->editButton(['controller' => 'movementos', 'action'=>'detalle', $m->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif ?>
