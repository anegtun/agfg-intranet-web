<?php

$res = [];

foreach($eventos as $e) {
    $data = [
        'nome' => $e->nome,
        'data' => $e->data,
        'lugar' => $e->lugar,
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
        $observacions = "";
        foreach($e->partidos as $p) {
            $observacions .= "<p>";
            if(!empty($p->hora_partido)) {
                $observacions .= "{$p->hora_partido}: ";
            }
            $observacions .= "{$p->equipa1->nome} VS {$p->equipa2->nome}";
            if(!empty($p->campo)) {
                $observacions .= " ({$p->campo->pobo}: {$p->campo->nome})";
            }
            $observacions .= "</p>";
        }

        $data = [
            'nome' => $e->competicion,
            'data' => $e->data,
            'lugar' => '',
            'observacions' => $observacions,
            'datas' => [[
                'data_ini' => $e->data,
                'data_fin' => $e->data
            ]]
        ];

         $data['tipo'] = str_contains($e->competicion, 'Feile')
           ? ['codigo' => 'GE', 'descricion' => 'Gaélico Escolas']
           : ['codigo' => 'CL', 'descricion' => 'Competicion clubes'];

        $res[] = $data;
    }
}

echo json_encode($res);
