<?php

function wp_agfg_calendario_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $url = "https://intranet.gaelicogalego.gal/calendario/competicion/$competicion.json";
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
    
    $html = wp_agfg_common_style();
    $html .= '<div class="agfg-calendario">';
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
            // Resultados
            $resultados = format_resultados($p);
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
            $dataClass = "";
            if(!empty($p->adiado)) {
                $dataPartido .= ' (adiado)';
                $dataClass = 'adiado';
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
            $html .= "<thead><tr><th colspan='3' class='$dataClass'>$dataPartido<br>$campo</th></tr></thead>";
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= "<td><figure><img class='alignnone' src='{$p->equipa1->logo}' alt='{$p->equipa1->nome}' width='18' height='20'></figure></td>";
            $html .= "<td>{$p->equipa1->nome}</td>";
            $html .= "<td>$resultados[0]</td>";
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= "<td><figure><img class='alignnone' src='{$p->equipa2->logo}' alt='{$p->equipa2->nome}' width='18' height='20'></figure></td>";
            $html .= "<td>{$p->equipa2->nome}</td>";
            $html .= "<td>$resultados[1]</td>";
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

add_shortcode('agfg-calendario', 'wp_agfg_calendario_shortcode');
