<?php
/*
Plugin Name: Asociacion Galega de Futbol Gaelico - Calendario Wordpress Plugin
Plugin URI:  https://gaeligogalego.gal/
Description: Plugin para visualización do calendario da AGFG.
Version:     1.0.0
Author:      Asociacion Galega de Futbol Gaelico
Author URI:  https://gaeligogalego.gal/
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class wp_agfg_calendario {
    

    //include(plugin_dir_path(__FILE__) . 'inc/wp_agfg_calendario_shortcode.php');
    //include(plugin_dir_path(__FILE__) . 'inc/wp_agfg_calendario_widget.php');

}

function wp_agfg_calendario_plugin($atts) {
    $url = "https://intranet.gaelicogalego.gal/calendario/index/3.json";
    $response = wp_remote_get($url);
    $data = json_decode($response['body']);


    $html = "<style>";
    $html .= ".calendario-full-new .partido table { border: 0 !important; }";
    $html .= "</style>";
    $html .= '<div class="calendario-full-new">';
    foreach($data->fases as $f) {
        foreach($f->xornadas as $x) {
            $html .= "<div class=\"xornada\">";
            $d = date('d/m/Y', strtotime($x->data));
            $html .= "<h4>Xornada {$x->numero} ({$d})</h4>";
            foreach($x->partidos as $p) {
                $html .= '<div class="partido">';
                $html .= '<table>';
                $html .= '<thead><tr><th colspan="3">Pte. data<br>Pte. campo</th></tr><thead>';
                $html .= '<tbody>';
                $html .= '<tr>';
                $html .= '<td><!--figure><img class="alignnone" src="http://gaelicogalego.gal/wp-content/uploads/2018/07/escudo-turonia-min.png" alt="Turonia" width="18" height="20"></figure--></td>';
                $html .= "<td>{$p->equipa1}</td>";
                $html .= '<td>-</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td><!--figure><img class="alignnone" src="http://gaelicogalego.gal/wp-content/uploads/2018/07/escudo-turonia-min.png" alt="Turonia" width="18" height="20"></figure--></td>';
                $html .= "<td>{$p->equipa2}</td>";
                $html .= '<td>-</td>';
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

add_shortcode('agfg-calendario', 'wp_agfg_calendario_plugin');

?>