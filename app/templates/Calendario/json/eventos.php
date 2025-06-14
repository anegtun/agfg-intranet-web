<?php

$res = [];

foreach($eventos as $e) {
    $data = [
        'nome' => $e->nome,
        'data' => $e->data,
        'lugar' => $e->lugar,
        'imaxe' => $e->imaxe,
        'tipo' => [
            'codigo' => $e->tipo,
            'descricion' => $tipos[$e->tipo]
        ],
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

$partidos_agrupados = [];
foreach($partidos as $p) {
    if(empty($p->data_partido) && !empty($p->adiado)) {
        continue;
    }

    $data = empty($p->data_partido) ? $p->xornada->data : $p->data_partido;
    $domingo = $data->modify('sunday this week');
    if ($domingo->diffInDays($data) === 0) {
        $data = $data->modify('-1 day');
    }

    $data_str = $data->format('Y-m-d');
    $id_comp = $p->fase->competicion->id;

    if(empty($partidos_agrupados[$data_str])) {
        $partidos_agrupados[$data_str] = [];
    }

    if(empty($partidos_agrupados[$data_str][$id_comp])) {
        $partidos_agrupados[$data_str][$id_comp] = (object) [
            'data' => $data,
            'competicion' => $p->fase->competicion->nome,
            'partidos' => []
        ];
    }

    $partidos_agrupados[$data_str][$id_comp]->partidos[] = $p;
}

foreach($partidos_agrupados as $pa) {
    foreach($pa as $e) {
        $data_ini = null;
        $data_fin = null;
        $observacions = "";
        foreach($e->partidos as $p) {
            $data = empty($p->data_partido) ? $p->xornada->data : $p->data_partido;
            if(empty($data_ini) || $data->lessThan($data_ini)) {
                $data_ini = $data;
            }
            if(empty($data_fin) || $data->greaterThan($data_fin)) {
                $data_fin = $data;
            }

            $observacions .= "<p>";
            if(!empty($p->hora_partido)) {
                $dia = str_replace("Sat", "Sáb", str_replace("Sun", "Dom", $data->format('D')));
                $observacions .= "$dia {$p->hora_partido}: ";
            }
            $observacions .= "{$p->equipa1->nome} VS {$p->equipa2->nome}";
            if(!empty($p->campo)) {
                $observacions .= " ({$p->campo->pobo}: {$p->campo->nome})";
            }
            $observacions .= "</p>";
        }


        $r = [
            'nome' => $e->competicion,
            'data' => $data_ini,
            'lugar' => '',
            'imaxe' => '',
            'observacions' => $observacions,
            'datas' => [[
                'data_ini' => $data_ini,
                'data_fin' => $data_fin
            ]]
        ];

         $r['tipo'] = str_contains($e->competicion, 'Feile')
           ? ['codigo' => 'GE', 'descricion' => 'Gaélico Escolas']
           : ['codigo' => 'CL', 'descricion' => 'Competicion clubes'];

        $res[] = $r;
    }
}

function cmp($a, $b) {
    return strcmp($a['data']->format('Y-m-d'), $b['data']->format('Y-m-d'));
}

usort($res, "cmp");

if(!empty($iniParam)) {
    $res_aux = [];
    foreach($res as $r) {
        if(strcmp($r['data']->format('Y-m-d'), $iniParam) >= 0) {
            $res_aux[] = $r;
        }
    }
    $res = $res_aux;
}

if(!empty($limitParam)) {
    $res_aux = [];
    $i = 0;
    for($i=0; $i < $limitParam; $i++) {
        $res_aux[] = $res[$i];
    }
    $res = $res_aux;
}

echo json_encode($res);
