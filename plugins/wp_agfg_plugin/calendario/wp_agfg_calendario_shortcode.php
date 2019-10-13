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
                    $resultado1 = sprintf('%01d', $p->goles_equipa1)."-".sprintf('%02d', $p->tantos_equipa1)." (".sprintf('%02d', $p->total_equipa1).")";
                    $resultado2 = sprintf('%01d', $p->goles_equipa2)."-".sprintf('%02d', $p->tantos_equipa2)." (".sprintf('%02d', $p->total_equipa2).")";
                }
                $dataPartido = empty($p->data_partido) ? 'Pte. data' : date('d/m - H:i', strtotime($p->data_partido));
                $campo = empty($p->campo) ? 'Pte. campo' : ($p->campo->nome.' ('.$p->campo->pobo.')');
                $html .= '<div class="partido">';
                $html .= '<table>';
                $html .= "<thead><tr><th colspan='3'>$dataPartido<br>$campo</th></tr><thead>";
                $html .= '<tbody>';
                $html .= '<tr>';
                $html .= "<td><figure><img class='alignnone' src='{$p->logo_equipa1}' alt='{$p->equipa1}' width='18' height='20'></figure></td>";
                $html .= "<td>{$p->equipa1}</td>";
                $html .= "<td>$resultado1</td>";
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= "<td><figure><img class='alignnone' src='{$p->logo_equipa2}' alt='{$p->equipa2}' width='18' height='20'></figure></td>";
                $html .= "<td>{$p->equipa2}</td>";
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
