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

    $dataInicio = strtotime($data->inicio);
    $dataFin = strtotime($data->fin);
    
    $html = wp_agfg_common_style();
    if(!empty($titulo)) {
        $datasXornada = date('d',$dataInicio)." de ".mes($dataInicio)." a ".date('d',$dataFin)." de ".mes($dataFin);
        $html .= "<$titulo>Próxima xornada ($datasXornada)</$titulo>";
    }
    $html .= '<div class="agfg-xornada-proxima">';
    $dataActual = '';
    foreach($data->partidos as $p) {
        // Data
        $diaPartido = $timePartido = null;
        $hora  = '';
        $dataClass = '';
        if(!empty($p->data_partido)) {
            $timePartido = strtotime($p->data_partido);
            $diaPartido = diaSemana($timePartido)." ".date('d',$timePartido)." de ".mes($timePartido);
            $horaStr = date('H:i',$timePartido);
            $hora = ($horaStr==='00:00') ? '(pte.hora)' : $horaStr;
        }
        // Campo
        $segundaLina = 'Pte. horario/campo';
        if(!empty($p->campo)) {
            $segundaLina = "{$p->campo->nome_curto} ({$p->campo->pobo})";
        } elseif(!empty($p->ganador)) {
            $segundaLina = 'Campo descoñecido';
        }
        // Xestión adiados
        if(!empty($p->adiado) && !empty($timePartido) && date('Y-m-d',$timePartido)>date('Y-m-d',$dataFin)) {
            $dataClass = 'adiado';
            $diaPartido = "Partidos da xornada adiados a outra data";
            $hora = '(adiado)';
            $segundaLina = date('d',$timePartido)." de ".mes($timePartido);
        }
        // HTML
        if($dataActual !== $diaPartido) {
            $html .= "<div style='clear:both'></div>";
            $html .= "<div class='dia-partido'>".(empty($diaPartido) ? 'Pendente de data' : $diaPartido)."</div>";
            $html .= "<div style='clear:both'></div>";
        }
        $html .= '<div class="partido">';
        $html .= '<table>';
        $html .= "<thead><tr><th colspan='2' class='$dataClass'>C. {$p->fase->categoria}<span style='float:right'>$hora</span><br>$segundaLina</th></tr></thead>";
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
        $dataActual = $diaPartido;
    }
    $html .= '</div>';
    $html .= '<div style="clear:both"></div>';
    return $html;
}

add_shortcode('agfg-xornada-seguinte', 'wp_agfg_xornada_seguinte_shortcode');
