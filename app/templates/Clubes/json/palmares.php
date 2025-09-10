<?php

$res = [
    'codigo' => $clube->codigo,
    'nome' => $clube->nome,
    'palmares' => []
];

foreach($tempadas as $t) {
    $res_tempada = [
        'tempada' => ['codigo' => $t['codigo'], 'nome' => $t['nome']],
        'equipas' => []
    ];

    foreach($clube->equipas as $equipa) {
        $competicions = array_filter($equipa->competicions, function ($e) use ($t) { return $e->tempada === $t['codigo']; });
        if (empty($competicions)) {
            continue;
        }

        $res_equipa = [
            'nome' => $equipa->nome,
            'categoria' => [
                'codigo' => $equipa->categoria,
                'nome' => $categorias[$equipa->categoria]
            ],
            'competicions' => []
        ];

        foreach($competicions as $competicion) {
            $res_competicion = [
                'nome' => $competicion->nome,
                'tipo' => $competicion->tipo,
                'federacion' => [
                    'codigo' => $competicion->federacion->codigo,
                    'nome' => $competicion->federacion->nome
                ],
                'posicion' => $competicion->clasificacion->posicion
            ];

            $fases = array_filter($competicion->fases, function ($e) use ($equipa) { return $e->categoria == $equipa->categoria; });
            if ($competicion->isLiga() && count($fases) > 1) {
                $res_competicion['fases'] = [];
                foreach($fases as $fase) {
                    if(!empty($fase->clasificacion->posicion)) {
                        $res_competicion['fases'][] = [
                            'nome' => $fase->nome,
                            'posicion' => $fase->clasificacion->posicion
                        ];
                    }
                }
            }

            $res_equipa['competicions'][] = $res_competicion;
        }

        $res_tempada['equipas'][] = $res_equipa;
    }

    if (empty($res_tempada['equipas'])) {
       continue; 
    }

    $res['palmares'][] = $res_tempada;
}

echo json_encode($res);
