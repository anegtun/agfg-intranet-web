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

$is_torneo = $competicion->isTorneo();

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

$partidos_adiados = [];
$partidos_normais = [];

foreach($partidos_filtrados as $p) {
    if ($p->adiado && empty($p->data_partido)) {
        $partidos_adiados[] = $p;
    } else {
        $partidos_normais[] = $p;
    }
}
?>

<div class="row form-group">
    <?= $this->Form->setValueSources(['query','context'])->create(null, ['type'=>'get']) ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->control('categoria', ['options'=>array_merge([''=>''], $categorias), 'label'=>'Categoría']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_fase', ['options'=>$this->AgfgForm->objectToKeyValue($fases,'id','$e->categoria - $e->nome'), 'label'=>'Fase']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_campo', ['options'=>$this->AgfgForm->objectToKeyValue($campos,'id','nome'), 'label'=>'Campo']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('id_equipa', ['options'=>$this->AgfgForm->objectToKeyValue($equipas,'id','$e->nome [$e->categoria]',true,false), 'label'=>'Equipa']) ?>
            </div>
            <div class="col-lg-3">
                <?= $this->Form->control('pendente', ['options'=>['0'=>'Non', '1'=>'Si'], 'default'=>'1']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <?= $this->Form->button('Buscar', ['class'=>'btn btn-primary', 'style'=> ['margin-top: 1.7em']]) ?>
                <?= $this->Html->link('Resumo', ['action'=>'resumo', $competicion->id], ['class'=>'btn btn-secondary']) ?>
                <?php if($is_torneo) : ?>
                    <?= $this->Html->link('Reemplazar equipos', ['action'=>'reemplazar', $competicion->id], ['class'=>'btn btn-success']) ?>
                <?php endif ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="agfg-competicion">

    <?php if (!empty($partidos_adiados)) : ?>

        <div class="agfg-xornada">Adiados</div>

        <?php foreach($partidos_adiados as $p) : ?>
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
        <?php endforeach ?>
    
    <?php endif ?>

    <?php foreach($partidos_normais as $p) : ?>
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
    <?php endforeach ?>

</div>
