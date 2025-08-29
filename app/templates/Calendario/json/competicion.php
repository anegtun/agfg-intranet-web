<?php


function _buildPartidoData($p, $f, $x) {
    $resP = [
        'data_partido' => $p->getDataHora(),
        'adiado' => $p->adiado,
        'cancelado' => $p->cancelado,
        'ganador' => $p->getGanador()
    ];
    if(!empty($p->data_calendario)) {
        $resP['data_calendario'] = $p->data_calendario;
    }
    if($p->hasEquipa1()) {
        $resP['equipa1'] = [
            'codigo' => empty($p->equipa1) ? '' : $p->equipa1->codigo,
            'nome' => $p->getNomeEquipa1(),
            'nome_curto' => $p->getNomeCurtoEquipa1(),
            'logo' => empty($p->equipa1) ? '' : $p->equipa1->getLogo(),
            'goles' => $p->goles_equipa1,
            'tantos' => $p->tantos_equipa1,
            'total' => $p->getPuntuacionTotalEquipa1(),
            'non_presentado' => $p->non_presentado_equipa1
        ];
    }
    if($p->hasEquipa2()) {
        $resP['equipa2'] = [
            'codigo' => empty($p->equipa2) ? '' : $p->equipa2->codigo,
            'nome' => $p->getNomeEquipa2(),
            'nome_curto' => $p->getNomeCurtoEquipa2(),
            'logo' => empty($p->equipa2) ? '' : $p->equipa2->getLogo(),
            'goles' => $p->goles_equipa2,
            'tantos' => $p->tantos_equipa2,
            'total' => $p->getPuntuacionTotalEquipa2(),
            'non_presentado' => $p->non_presentado_equipa2
        ];
    }
    if(!empty($f) || !empty($x)) {
        $resP['fase'] = [
            'fase' => empty($f->nome) ? null : $f->nome,
            'subfase' => empty($x->descricion) ? null : $x->descricion
        ];
    }
    if(!empty($p->campo)) {
        $resP['campo'] = [
            'nome' => $p->campo->nome,
            'nome_curto' => $p->campo->nome_curto,
            'pobo' => $p->campo->pobo
        ];
    }
    if(!empty($p->arbitro)) {
        $resP['arbitro'] = [
            'alcume' => $p->arbitro->alcume,
            'nome' => $p->arbitro->nome_publico
        ];
    }
    if(!empty($p->umpire)) {
        $resP['umpires'] = [
            'categoria' => $p->umpire->categoria,
            'codigo' => $p->umpire->codigo,
            'nome' => $p->umpire->nome,
            'nome_curto' => $p->umpire->nome_curto,
            'logo' => $p->umpire->getLogo()
        ];
    }
    return $resP;
}

$res = [
    'competicion' => [
        'nome' => $competicion->nome,
        'tipo' => $competicion->tipo
    ],
    'xornadas' => []
];
foreach($competicion->fases as $f) {
    foreach($f->xornadas as $x) {
        $resX = [
            'data' => $x->data,
            'numero' => $x->numero,
            'descricion' => $x->descricion,
            'partidos' => []
        ];
        $index = -1;
        foreach($res['xornadas'] as $i=>$xJson) {
            if($xJson['data']==$x->data) {
                $resX = $xJson;
                $index = $i;
                break;
            }
        }
        foreach($x->partidos as $p) {
            $resX['partidos'][] = _buildPartidoData($p, $f, $x);
        }
        if($index>=0) {
            $res['xornadas'][$index] = $resX;
        } else {
            $res['xornadas'][] = $resX;
        }
    }
}

echo json_encode($res);
