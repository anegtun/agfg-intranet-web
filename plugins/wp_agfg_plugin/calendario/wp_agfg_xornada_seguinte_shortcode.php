<?php

function wp_agfg_xornada_seguinte_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $titulo = empty($atts['titulo']) ? 'h3' : $atts['titulo'];
    $url = "https://intranet.gaelicogalego.gal/calendario/xornadaSeguinte/$competicion.json";
    if(!empty($categoria)) {
        $url .= "?categoria=$categoria";
    }
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);

    $diasSemana = ['Domingo','Luns','Martes','Mércores','Xoves','Venres','Sábado'];
    $meses = ['','xaneiro','febreiro','marzo','abril','maio','xuño','xullo','agosto','setembro','outubro','novembro','decembro'];
    
    $html = wp_agfg_common_style();
    if(!empty($titulo)) {
        $dataInicio = strtotime($data->inicio);
        $dataFin = strtotime($data->fin);
        $diaI = date('d', $dataInicio);
        $diaF = date('d', $dataFin);
        $mesI = date('n', $dataInicio);
        $mesF = date('n', $dataFin);
        $datasXornada = "$diaI de $meses[$mesI] a $diaF de $meses[$mesF]";
        $html .= "<$titulo>Próxima xornada ($datasXornada)</$titulo>";
    }
    $html .= '<div class="agfg-xornada-proxima">';
    $dataActual = '000-00-00';
    foreach($data->partidos as $p) {
        // Data
        $dataPartido = null;
        $hora  = '';
        $dataClass = '';
        if(!empty($p->data_partido)) {
            $dataPartidoDate = strtotime($p->data_partido);
            $diaStr = date('d', $dataPartidoDate);
            $diaSemanaStr = date('w', $dataPartidoDate);
            $mesStr = date('n', $dataPartidoDate);
            $horaStr = date('H:i', $dataPartidoDate);
            $dataPartido = "$diasSemana[$diaSemanaStr] $diaStr de $meses[$mesStr]";
            $hora = ($horaStr==='00:00') ? '(pte.hora)' : $horaStr;
        }
        // Campo
        $campo = 'Pte. horario/campo';
        if(!empty($p->campo)) {
            $campo = "{$p->campo->nome_curto} ({$p->campo->pobo})";
        } elseif(!empty($p->ganador)) {
            $campo = 'Campo descoñecido';
        }
        // Xestión adiados
        if(!empty($p->adiado)) {
            $dataClass = 'adiado';
            $dataPartido = 'Partidos da xornada adiados a outra data';
            $hora = '(adiado)';
            if(!empty($p->data_partido)) {
                $dataPartidoDate = strtotime($p->data_partido);
                $diaStr = date('d', $dataPartidoDate);
                $mesStr = date('m', $dataPartidoDate);
                $mesStr = date('n', $dataPartidoDate);
                $campo = "$diaStr de $meses[$mesStr]";
            }
        }
        // HTML
        if($dataActual !== $dataPartido) {
            $html .= "<div style='clear:both'></div>";
            $html .= "<div class='dia-partido'>".(empty($dataPartido) ? 'Pendente de data' : $dataPartido)."</div>";
            $html .= "<div style='clear:both'></div>";
        }
        $html .= '<div class="partido">';
        $html .= '<table>';
        $html .= "<thead><tr><th colspan='2' class='$dataClass'>C. {$p->fase->categoria}<span style='float:right'>$hora</span><br>$campo</th></tr></thead>";
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

add_shortcode('agfg-xornada-seguinte', 'wp_agfg_xornada_seguinte_shortcode');
