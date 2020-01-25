<?php

function wp_agfg_xornada_anterior_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $titulo = empty($atts['titulo']) ? 'h3' : $atts['titulo'];
    $url = "https://intranet.gaelicogalego.gal/calendario/xornadaAnterior/$competicion.json";
    if(!empty($categoria)) {
        $url .= "?categoria=$categoria";
    }
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);
    
    $html = wp_agfg_common_style();
    if(!empty($titulo)) {
        $dataInicio = strtotime($data->inicio);
        $dataFin = strtotime($data->fin);
        $datasXornada = date('d',$dataInicio)." de ".mes($dataInicio)." a ".date('d',$dataFin)." de ".mes($dataFin);
        $html .= "<$titulo>Resultados última xornada ($datasXornada)</$titulo>";
    }
    $html .= '<div class="agfg-xornada-anterior">';
    $dataActual = null;
    foreach($data->partidos as $p) {
        $resultados = format_resultados($p);
        $dataClass = empty($p->adiado) ? '' : 'adiado';
        // HTML
        $html .= '<div class="partido">';
        $html .= '<table>';
        $html .= "<thead><tr><th colspan='3' class='$dataClass'>C. {$p->fase->categoria}<span style='float:right'>".(empty($p->adiado)?'':'(adiado)')."</span></th></tr></thead>";
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
        $dataActual = $dataPartido;
    }
    $html .= '</div>';
    $html .= '<div style="clear:both"></div>';
    return $html;
}

add_shortcode('agfg-xornada-anterior', 'wp_agfg_xornada_anterior_shortcode');
