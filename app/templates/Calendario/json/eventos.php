<?php

$res = [];
foreach($eventos as $e) {
    $res[] = [
        'nome' => $e->nome,
        'data' => $e->data,
        'lugar' => $e->lugar,
        'observacions' => $e->observacions
    ];
}

echo json_encode($res);
