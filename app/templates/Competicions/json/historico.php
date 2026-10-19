<?php

$historico = [];
foreach ($competicions as $competicion) {
    $fasesHistorico = [];
    $clasificacions = [];
    $finalizada = !empty($competicion->finalizada);
    if ($finalizada) {
        foreach ($competicion->fases as $fase) {
            if (empty($fase->final)) {
                continue;
            }

            $claveClasificacion = $fase->categoria . ':' . $fase->formato;
            if (!isset($clasificacions[$claveClasificacion])) {
                $clasificacions[$claveClasificacion] = $clasificacionFetcher->get(
                    $competicion,
                    $fase->categoria,
                    $fase
                );
            }
            $clasificacion = $clasificacions[$claveClasificacion];
            $clasificacion->build($fase);

            $campions = [];
            foreach ($clasificacion->getClasificacion() as $equipa) {
                if ((int)$equipa->posicion === 1) {
                    $campions[] = [
                        'nome' => $equipa->nome,
                        'logo' => $equipa->logo,
                    ];
                }
            }

            if (empty($campions)) {
                continue;
            }

            $fasesHistorico[] = [
                'nome' => $fase->nome,
                'categoria' => $fase->categoria,
                'posicion' => (int)$fase->prioridade,
                'campions' => $campions,
            ];
        }
    }

    $historico[] = [
        'competicion' => [
            'nome' => $competicion->nome,
            'tempada' => $competicion->tempada,
            'tipo' => $competicion->tipo,
            'finalizada' => $finalizada,
        ],
        'fases' => $fasesHistorico,
    ];
}

echo json_encode($historico);
