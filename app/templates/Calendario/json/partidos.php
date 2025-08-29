<?php

$res = [
    'inicio' => $data_ini,
    'fin' => $data_fin,
    'partidos' => []
];

foreach($partidos as $p) {
    $resP = [
        'fase' => [
            'categoria' => $categorias[$p->fase->categoria],
            'nome' => $p->fase->nome
        ],
        'xornada' => [
            'data' => $p->xornada->data,
            'numero' => $p->xornada->numero
        ],
        'data_partido' => $p->getDataHora(),
        'adiado' => $p->adiado,
        'cancelado' => $p->cancelado,
        'ganador' => $p->getGanador()
    ];

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

    $res['partidos'][] = $resP;
}

echo json_encode($res);
