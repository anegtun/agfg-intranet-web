<?php

$res = [
    'codigo' => $clube->codigo,
    'nome' => $clube->nome,
    'equipas' => []
];

foreach($clube->equipas as $e) {
    $res_equipa = [
        'nome' => $e->nome,
        'categoria' => [
            'codigo' => $e->categoria,
            'nome' => $categorias[$e->categoria]
        ],
        'competicions' => []
    ];

    foreach($e->competicions as $competicion) {
        $res_competicion = [
            'nome' => $competicion->nome,
            'tempada' => $competicion->tempada,
            'tipo' => $competicion->tipo,
            'federacion' => [
                'codigo' => $competicion->federacion->codigo,
                'nome' => $competicion->federacion->nome
            ],
            'posicion' => $competicion->clasificacion->posicion,
            'fases' => []
        ];

        foreach($competicion->fases as $fase) {
            if($fase->categoria != $e->categoria) {
                continue;
            }

            $res_fase = [
                'nome' => $fase->nome,
                'posicion' => $fase->clasificacion->posicion
            ];

            $res_competicion['fases'][] = $res_fase;
        }

        $res_equipa['competicions'][] = $res_competicion;
    }

    $res['equipas'][] = $res_equipa;
}

echo json_encode($res);
