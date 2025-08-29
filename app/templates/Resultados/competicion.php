<?php
$this->extend('template');
$this->set('cabeceiraTitulo', $competicion->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Competicións', 'url'=>['controller'=>'Competicions', 'action'=>'index']],
    ['label'=>$competicion->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];

$is_torneo = $competicion->tipo === 'torneo';

$campos = [];
$fases = [];
foreach($partidos_competicion as $p) {
    if(!empty($p->fase)) {
        $fases[$p->id_fase] = $p->fase;
    }
    if(!empty($p->campo)) {
        $campos[$p->id_campo] = $p->campo;
    }
}
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $this->Form->control('id_fase', ['options'=>$this->AgfgForm->objectToKeyValue($fases,'id','$e->categoria - $e->nome'), 'label'=>'Fase']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','nome'), 'label'=>'Campo']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('pendente', ['options'=>['0'=>'Non', '1'=>'Si'], 'default'=>'1']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary', 'style'=> ['margin-top: 1.7em']]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <?= $this->Html->link('Resumo', ['action'=>'resumo', $competicion->id], ['class'=>'btn btn-secondary']) ?>
            </div>
            <?php if($is_torneo) : ?>
                <div class="col-lg-3">
                    <?= $this->Html->link('Reemplazar equipos', ['action'=>'reemplazar', $competicion->id], ['class'=>'btn btn-success']) ?>
                </div>
            <?php endif ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="agfg-competicion">
    
    <div class="agfg-xornada">Adiados</div>

    <?php foreach($partidos_filtrados as $p) : ?>
        <?php if($p->adiado && empty($p->data_partido)) : ?>
            <?php
                $fase = $is_torneo
                    ? (empty($p->xornada->descricion) ? $p->fase->nome : $p->xornada->descricion)
                    : "{$p->fase->categoria} [X.{$p->xornada->numero}]";
            ?>

            <?= $this->element('resultados/partido', [
                'hora' => $p->xornada->data->format('Y-m-d') . " (orixinal)",
                'fase' => $fase,
                'partido' => $p
            ]) ?>

        <?php endif ?>
    <?php endforeach ?>

    <?php foreach($partidos_filtrados as $p) : ?>
        <?php if(!($p->adiado && empty($p->data_partido))) : ?>
            <?php
                $fase = $is_torneo
                    ? (empty($p->xornada->descricion) ? $p->fase->nome : $p->xornada->descricion)
                    : "{$p->fase->categoria} [X.{$p->xornada->numero}]";

                $hora = $is_torneo ? $p->formatDiaHora() : $p->formatDataHora();
                if(empty($hora) && !empty($p->adiado)) {
                    $hora = '(adiado)';
                }

                $data_referencia = $p->data_partido ? $p->data_partido : $p->xornada->data;
                $sabado = empty($data_referencia) ? NULL : $data_referencia->modify('next monday')->modify('previous saturday')->format('Y-m-d');
            ?>

            <?php if(!empty($sabado) && $data_xornada !== $sabado) : ?>
                <?php $data_xornada = $sabado; ?>
                <div class="agfg-xornada"><?= $data_xornada ?></div>
            <?php endif?>

            <?= $this->element('resultados/partido', [
                'hora' => $hora,
                'fase' => $fase,
                'partido' => $p
            ]) ?>

        <?php endif ?>
    <?php endforeach ?>

</div>
