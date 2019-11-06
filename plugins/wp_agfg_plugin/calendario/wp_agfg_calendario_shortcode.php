<?php

function wp_agfg_calendario_shortcode($atts) {
    $idCalendario = $atts['id'];
    $categoria = $atts['categoria'];
    $url = "https://intranet.gaelicogalego.gal/calendario/competicion/$idCalendario.json";
    if(!empty($categoria)) {
        $url .= "?categoria=$categoria";
    }
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);
    usort($data->xornadas, function($a,$b) {
        if($a->data===NULL || $b->data===NULL) {
            return 0;
        }
        return strtotime($a->data) - strtotime($b->data);
    });

    $diasSemana = ['Dom','Lun','Mar','Mér','Xov','Ven','Sáb'];
    
    $html = "<style>";
    $html .= ".calendario-full-new .partido table { border: 0 !important; }";
    $html .= "</style>";
    $html .= '<div class="calendario-full-new">';
    foreach($data->xornadas as $x) {
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
            // Resultado
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
            // Data
            $dataPartido = 'Pte. data';
            if(!empty($p->data_partido)) {
                $dataPartidoDate = strtotime($p->data_partido);
                $dataStr = date('d/m', $dataPartidoDate);
                $horaStr = date('H:i', $dataPartidoDate);
                $diaStr = date('w', $dataPartidoDate);
                $dataPartido = "$diasSemana[$diaStr] $dataStr";
                if($horaStr!=='00:00') {
                    $dataPartido .= " - $horaStr";
                }
            }
            $dataStyle = "";
            if(!empty($p->adiado)) {
                $dataPartido .= ' (adiado)';
                $dataStyle = 'color:#c54242';
            }
            // Campo
            $campo = 'Pte. campo';
            if(!empty($p->campo)) {
                $campo = "{$p->campo->nome} ({$p->campo->pobo})";
            } elseif(!empty($p->ganador)) {
                $campo = 'Campo descoñecido';
            }
            // HTML
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
    $html .= "</div>";
    return $html;
}

function format_resultado($equipa) {
    $resultado = "";
    if(!is_null($equipa->goles) || !is_null($p->equipa1->goles)) {
        $resultado = sprintf('%01d', $equipa->goles)."-".sprintf('%02d', $equipa->tantos)." (".sprintf('%02d', $equipa->total).")";
    } else {
        $resultado = "(".sprintf('%02d', $equipa->total).")";
    }
    return $resultado;
}

add_shortcode('agfg-calendario', 'wp_agfg_calendario_shortcode');
