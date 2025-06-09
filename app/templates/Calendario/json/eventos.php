<?php

$res = [];
foreach($eventos as $e) {
    $res[] = [
        'nome' => $e->nome,
        'observacions' => $e->observacions,
        'data' => $e->data
    ];
}

echo json_encode($res);
