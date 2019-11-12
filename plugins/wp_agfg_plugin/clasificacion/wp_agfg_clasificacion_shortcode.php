<?php

function wp_agfg_clasificacion_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $url = "https://intranet.gaelicogalego.gal/clasificacion/competicion/$competicion/$categoria.json";
    $response = wp_remote_get($url);
    $clasificacion = json_decode($response['body']);
    
    $html = wp_agfg_common_style();
    if(!empty($clasificacion)) {
        $orderSymbol = $categoria==='F' ? 'ª' : 'º';
        $html .= 
            '<div class="agfg-clasificacion">'.
            '<table style="width: 100%;">'.
                '<thead><tr><th>Pos</th><th>Equipo</th><th>Ptos</th><th>XG</th><th>XE</th><th>XP</th><th>Dif.</th></tr></thead>'.
                '</tbody>';
        foreach($clasificacion as $equipa) {
            $sancions = str_repeat ("*",$equipa->puntos_sancion);
            $html .=
                "<tr>
                    <td>{$equipa->posicion}$orderSymbol</td>
                    <td>
                        <div style='text-align:left; padding-left:5px;'>
                            <img src='{$equipa->logo}' alt='{$equipa->nome}' width='30' style='display: inline-block; height: 100%; vertical-align: middle;'>
                            <strong style='padding-left:1em'>$equipa->nome $sancions</strong>
                        </div>
                    </td>
                    <td>{$equipa->puntos}</td>
                    <td>{$equipa->partidosGanados}</td>
                    <td>{$equipa->partidosEmpatados}</td>
                    <td>{$equipa->partidosPerdidos}</td>
                    <td>".($equipa->totalFavor - $equipa->totalContra)."</td>
                </tr>";
        }
        $html .= '</tbody></table></div>';
    }
    return $html;
}

add_shortcode('agfg-clasificacion', 'wp_agfg_clasificacion_shortcode');
