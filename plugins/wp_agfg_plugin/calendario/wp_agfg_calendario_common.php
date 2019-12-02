<?php

function format_resultado($equipa) {
    $resultado = "";
    if(!is_null($equipa->goles) || !is_null($p->equipa1->goles)) {
        $resultado = sprintf('%01d', $equipa->goles)."-".sprintf('%02d', $equipa->tantos)." (".sprintf('%02d', $equipa->total).")";
    } else {
        $resultado = "(".sprintf('%02d', $equipa->total).")";
    }
    return $resultado;
}

function format_resultados($p) {
    $resultado1 = $resultado2 = '-';
    if(!empty($p->equipa1->non_presentado)) {
        $resultado1 = 'N.P.';
    } elseif(!empty($p->equipa2->non_presentado)) {
        $resultado2 = 'N.P.';
    } elseif(!empty($p->ganador)) {
        // Para cando o resultado é descoñecido, por convención pomos un "100-0"
        if($p->equipa1->total===100 && $p->equipa2->total===0) {
            $resultado1 = 'V';
        } elseif($p->equipa2->total===100 && $p->equipa1->total===0) {
            $resultado2 = 'V';
        } else {
            $resultado1 = format_resultado($p->equipa1);
            $resultado2 = format_resultado($p->equipa2);
        }
    }
    return array($resultado1, $resultado2);
}
