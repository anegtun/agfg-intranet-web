<?php

$res = [
    'codigo' => $clube->codigo,
    'nome' => $clube->nome,
    'palmares' => []
];

foreach ($tempadas as $t) {
    $res_tempada = [
        'tempada' => ['codigo' => $t['codigo'], 'nome' => $t['nome']],
        'competicions' => []
    ];

    foreach ($clube->equipas as $equipa) {
        $competicions = array_filter($equipa->competicions, function ($e) use ($t) { return $e->tempada === $t['codigo']; });
        if (empty($competicions)) {
            continue;
        }

        foreach ($competicions as $competicion) {
            if (!isset($res_tempada['competicions'][$competicion->id])) {
                $res_tempada['competicions'][$competicion->id] = [
                    'nome' => $competicion->nome,
                    'tipo' => $competicion->tipo,
                    'federacion' => [
                        'codigo' => $competicion->federacion->codigo,
                        'nome' => $competicion->federacion->nome
                    ],
                    'equipas' => []
                ];
            }

            $res_equipa = [
                'nome' => $equipa->nome,
                'categoria' => [
                    'codigo' => $equipa->categoria,
                    'nome' => $categorias[$equipa->categoria]
                ],
                'posicion' => $competicion->clasificacion->posicion ?? NULL
            ];

            $fases = array_filter($competicion->fases, function ($e) use ($equipa) { return $e->categoria == $equipa->categoria; });
            if ($competicion->isLiga() && count($fases) > 1) {

                $ids_fases_pai = [];
                foreach ($fases as $fase) {
                    if (!empty($fase->id_fase_pai)) {
                        $ids_fases_pai[] = $fase->id_fase_pai;
                    }
                }

                $res_equipa['fases'] = [];
                foreach ($fases as $fase) {
                    if ($fase->codigo !== 'promocion' && isset($fase->clasificacion->posicion) && !empty($fase->clasificacion->posicion) && !in_array($fase->id, $ids_fases_pai)) {
                        $res_equipa['fases'][] = [
                            'nome' => $fase->nome,
                            'posicion' => $fase->clasificacion->posicion,
                            'prioridade' => $fase->prioridade
                        ];
                    }
                }
            }

            $res_tempada['competicions'][$competicion->id]['equipas'][] = $res_equipa;
        }
    }

    if (empty($res_tempada['competicions'])) {
       continue; 
    }

    $res_tempada['competicions'] = array_values($res_tempada['competicions']);
    $res['palmares'][] = $res_tempada;
}

echo json_encode($res);
