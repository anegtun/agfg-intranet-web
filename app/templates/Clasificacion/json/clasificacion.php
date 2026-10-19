<?php

$response = [
    'competicion' => [
        'nome' => $competicion->nome,
        'tipo' => $competicion->tipo
    ],
    'clasificacion' => $clasificacion->getClasificacion()
];

if (!empty($fase)) {
    $response['fase'] = [
        'nome' => $fase->nome,
        'formato' => $fase->formato
    ];
}

echo json_encode($response);
