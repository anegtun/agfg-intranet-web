<?php

function wp_agfg_clasificacion_shortcode($atts) {
    $competicion = $atts['competicion'];
    $categoria = $atts['categoria'];
    $fase = empty($atts['fase']) ? null : $atts['fase'];
    $curto = empty($atts['curto']) ? false : $atts['curto'];
    $clasificacion = wp_agfg_clasificacion_get($competicion, $categoria, $fase);
    
    $html = wp_agfg_common_style();
    if(!empty($clasificacion)) {
        $orderSymbol = $categoria==='F' ? 'ª' : 'º';
        $html .= 
            '<div class="agfg-clasificacion">'.
            '<table style="width: 100%;">'.
                '<thead><tr><th></th><th>Equipo</th><th>Ptos</th>';
        if($curto) {
            $html .= "<th>XG/XE/XP</th>";
        } else {
            $html .= "<th>XG</th><th>XE</th><th>XP</th><th>Dif.</th>";
        }
        $html .= '</tr></thead></tbody>';
        foreach($clasificacion as $equipa) {
            $sancions = str_repeat ("*",$equipa->puntos_sancion);
            $nomeEquipa = $curto ? $equipa->codigo : $equipa->nome;
            $html .=
                "<tr>
                    <td style='width:3em;'>{$equipa->posicion}$orderSymbol</td>
                    <td>
                        <div style='text-align:left; padding-left:5px; width:100px;'>
                            <img src='{$equipa->logo}' alt='{$equipa->nome}' width='30' style='display: inline-block; height: 100%; vertical-align: middle;'>
                            <strong style='padding-left:1em'>$nomeEquipa $sancions</strong>
                        </div>
                    </td>
                    <td>{$equipa->puntos}</td>";
            if($curto) {
                $html .= "<td>{$equipa->partidosGanados}/{$equipa->partidosEmpatados}/{$equipa->partidosPerdidos}</td>";
            } else {
                $html .=
                    "<td>{$equipa->partidosGanados}</td>
                    <td>{$equipa->partidosEmpatados}</td>
                    <td>{$equipa->partidosPerdidos}</td>
                    <td>".($equipa->totalFavor - $equipa->totalContra)."</td>";
            }
            $html .= "</tr>";
        }
        $html .= '</tbody></table></div>';
    }
    return $html;
}

add_shortcode('agfg-clasificacion', 'wp_agfg_clasificacion_shortcode');
