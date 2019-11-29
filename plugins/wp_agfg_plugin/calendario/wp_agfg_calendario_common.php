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
