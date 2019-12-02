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

    $diasSemana = ['Domingo','Luns','Martes','Mércores','Xoves','Venres','Sábado'];
    $meses = ['','xaneiro','febreiro','marzo','abril','maio','xuño','xullo','agosto','setembro','outubro','novembro','decembro'];
    
    $html = wp_agfg_common_style();
    $html .= '<div class="agfg-proxima-xornada">';
    $dataActual = null;
    foreach($data->partidos as $p) {
        // Data
        $dataPartido = null;
        $horaPartido = '(pte. horario)';
        if(!empty($p->data_partido)) {
            $dataPartidoDate = strtotime($p->data_partido);
            $diaStr = date('d', $dataPartidoDate);
            $diaSemanaStr = date('w', $dataPartidoDate);
            $mesStr = date('n', $dataPartidoDate);
            $dataPartido = "$diasSemana[$diaSemanaStr] $diaStr de $meses[$mesStr]";
            $horaStr = date('H:i', $dataPartidoDate);
            if($horaStr!=='00:00') {
                $horaPartido = $horaStr;
            } else if(!empty($p->adiado)) {
                $horaPartido = '(adiado)';
            }
        }
        $dataClass = empty($p->adiado) ? '' : 'adiado';
        // Campo
        $campo = 'Pte. campo';
        if(!empty($p->campo)) {
            $campo = "{$p->campo->nome_curto} ({$p->campo->pobo})";
        } elseif(!empty($p->ganador)) {
            $campo = 'Campo descoñecido';
        }
        // HTML
        if($dataActual !== $dataPartido) {
            $html .= "<div style='clear:both'></div>";
            $html .= "<div class='dia-partido'>".(empty($dataPartido) ? 'Pendente de data' : $dataPartido)."</div>";
            $html .= "<div style='clear:both'></div>";
        }
        $html .= '<div class="partido">';
        $html .= '<table>';
        $html .= "<thead><tr><th colspan='2' class='$dataClass'>C. {$p->fase->categoria}<span style='float:right'>$horaPartido</span><br>$campo</th></tr></thead>";
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
        $dataActual = $dataPartido;
    }
    $html .= '</div>';
    $html .= '<div style="clear:both"></div>';
    return $html;
}

add_shortcode('agfg-seguinte-xornada', 'wp_agfg_seguinte_xornada_shortcode');
