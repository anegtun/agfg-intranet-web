<?php

$res = [];
foreach($eventos as $e) {
    $data = [
        'nome' => $e->nome,
        'data' => $e->data,
        'lugar' => $e->lugar,
        'observacions' => $e->observacions,
        'datas' => []
    ];
    if(!empty($e->datas)) {
        foreach($e->datas as $d) {
            $data['datas'][] = [
                'data_ini' => $d->data_ini,
                'data_fin' => $d->data_fin
            ];
        }
    } else {
        $data['datas'][] = [
            'data_ini' => $e->data,
            'data_fin' => $e->data
        ];
    }
    $res[] = $data;
}

echo json_encode($res);
