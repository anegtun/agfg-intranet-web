<?php

function wp_agfg_calendario_shortcode($atts) {
    $idCalendario = $atts['id'];
    $url = "https://intranet.gaelicogalego.gal/calendario/competicion/$idCalendario.json";
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);
    
    $html = "<style>";
    $html .= ".calendario-full-new .partido table { border: 0 !important; }";
    $html .= "</style>";
    $html .= '<div class="calendario-full-new">';
    foreach($data->fases as $f) {
        $html .= "<h3 style='color:#04395E; border-bottom:1px solid; clear:both; padding-top:2em;'>{$f->nome}</h3>";
        foreach($f->xornadas as $x) {
            usort($x->partidos, function($a,$b) {
                if($a->data_partido===NULL || $b->data_partido===NULL) {
                    return 0;
                }
                return strtotime($a->data_partido) - strtotime($b->data_partido);
            });
            $html .= "<div class=\"xornada\">";
            $d = date('d/m/Y', strtotime($x->data));
            $html .= "<h4>Xornada {$x->numero} ({$d})</h4>";
            foreach($x->partidos as $p) {
                $resultado1 = $resultado2 = '-';
                if(!empty($p->ganador)) {
                    $resultado1 = sprintf('%01d', $p->equipa1->goles)."-".sprintf('%02d', $p->equipa1->tantos)." (".sprintf('%02d', $p->equipa1->total).")";
                    $resultado2 = sprintf('%01d', $p->equipa2->goles)."-".sprintf('%02d', $p->equipa2->tantos)." (".sprintf('%02d', $p->equipa2->total).")";
                }
                $dataPartido = 'Pte. data';
                if(!empty($p->data_partido)) {
                    $dataPartidoDate = strtotime($p->data_partido);
                    $dataStr = date('d/m', $dataPartidoDate);
                    $horaStr = date('H:i', $dataPartidoDate);
                    $dataPartido = $dataStr;
                    if($horaStr!=='00:00') {
                        $dataPartido .= ' - '.$horaStr;
                    }
                }
                $dataStyle = "";
                if(!empty($p->adiado)) {
                    $dataPartido .= ' (ADIADO)';
                    $dataStyle = 'color:#c54242';
                }
                $campo = empty($p->campo) ? 'Pte. campo' : ($p->campo->nome.' ('.$p->campo->pobo.')');
                $html .= '<div class="partido">';
                $html .= '<table>';
                $html .= "<thead><tr><th colspan='3' style='$dataStyle'>$dataPartido<br>$campo</th></tr><thead>";
                $html .= '<tbody>';
                $html .= '<tr>';
                $html .= "<td><figure><img class='alignnone' src='{$p->equipa1->logo}' alt='{$p->equipa1->nome}' width='18' height='20'></figure></td>";
                $html .= "<td>{$p->equipa1->nome}</td>";
                $html .= "<td>$resultado1</td>";
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= "<td><figure><img class='alignnone' src='{$p->equipa2->logo}' alt='{$p->equipa2->nome}' width='18' height='20'></figure></td>";
                $html .= "<td>{$p->equipa2->nome}</td>";
                $html .= "<td>$resultado2</td>";
                $html .= '</tr>';
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';
            }
            $html .= "</div>";
        }
    }
    $html .= "</div>";
    return $html;
}

add_shortcode('agfg-calendario', 'wp_agfg_calendario_shortcode');
