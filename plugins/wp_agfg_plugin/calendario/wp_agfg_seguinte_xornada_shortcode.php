<?php

function wp_agfg_seguinte_xornada_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $url = "https://intranet.gaelicogalego.gal/calendario/seguinteXornada/$competicion.json";
    if(!empty($categoria)) {
        $url .= "?categoria=$categoria";
    }
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);

    $diasSemana = ['Dom','Lun','Mar','Mér','Xov','Ven','Sáb'];
    
    $html = wp_agfg_common_style();
    $html .= '<div class="agfg-proxima-xornada">';
    foreach($data->partidos as $p) {
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
            $campo = "{$p->campo->nome_curto} ({$p->campo->pobo})";
        } elseif(!empty($p->ganador)) {
            $campo = 'Campo descoñecido';
        }
        // HTML
        $html .= '<div class="partido">';
        $html .= '<table>';
        $html .= "<thead><tr><th colspan='2' style='$dataStyle'>$dataPartido<br>$campo<br>Cat. {$p->fase->categoria}</th></tr><thead>";
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= "<td><figure><img class='alignnone' src='{$p->equipa1->logo}' alt='{$p->equipa1->nome}' width='18' height='20'></figure></td>";
        $html .= "<td>{$p->equipa1->nome}</td>";
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<td><figure><img class='alignnone' src='{$p->equipa2->logo}' alt='{$p->equipa2->nome}' width='18' height='20'></figure></td>";
        $html .= "<td>{$p->equipa2->nome}</td>";
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
    }
    $html .= '</div>';
    $html .= '<div style="clear:both"></div>';
    return $html;
}

add_shortcode('agfg-seguinte-xornada', 'wp_agfg_seguinte_xornada_shortcode');
