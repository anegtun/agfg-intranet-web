<?php

class agfg_Clasificacion_Widget extends WP_Widget {
    
    function __construct() {
        parent::__construct(
            'agfg_clasificacion_widget',
            'Asociación Galega de Fútbol Gaélico - Clasificación Widget',
            array('classname'=>'agfg_clasificacion_widget', 'description'=>'Widget para mostrar la clasificación') );
    }
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        $idCalendario = $instance['id_calendario'];
        $urlResultados = $instance['url_resultados'];
        $url = "https://intranet.gaelicogalego.gal/clasificacion/competicion/$idCalendario.json";
        $response = wp_remote_get($url);
        $clasificacion = json_decode($response['body']);
        
        $html = $args['before_widget'];
        if(!empty($title)) {
            $html .= $args['before_title'] . $title . $args['after_title'];
        }
        if(!empty($clasificacion)) {
            $html .=
                '<div class="tablaClasificacion tablaClasificacion-widget">'.
                '<table style="width: 100%;">'.
                    '<thead><tr><th>Pos</th><th>Equipo</th><th>Ptos</th><th>XG</th><th>XE</th><th>XP</th><th>Dif.</th></tr>';
            foreach($clasificacion as $equipa) {
                $html .=
                    "<tr>
                        <td>{$equipa->posicion}</td>
                        <td><img src='{$equipa->logo}' alt='{$equipa->nome}' width='30'></td>
                        <td>{$equipa->puntos}</td>
                        <td>{$equipa->partidosGanados}</td>
                        <td>{$equipa->partidosEmpatados}</td>
                        <td>{$equipa->partidosPerdidos}</td>
                        <td>".($equipa->totalFavor - $equipa->totalContra)."</td>
                    </tr>";
            }
            $html .= '</tbody></table></div>';
        }
        if(!empty($urlResultados)) {
            $html .= "<a href='$urlResultados'>Ver todos os resultados</a>";
        }
        $html .= $args['after_widget'];
        echo $html;
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $calendar = ! empty( $instance['id_calendario'] ) ? $instance['id_calendario'] : '';
        $urlResultados = ! empty( $instance['url_resultados'] ) ? $instance['url_resultados'] : '';
        echo
            "<p>
                <label for='".$this->get_field_id('title')."'>Titulo:</label>
                <input type='text' id='".$this->get_field_id('title')."' name='".$this->get_field_name('title')."' value='".esc_attr( $title )."' class='widefat' />
            </p>
            <p>
                <label for='".$this->get_field_id('id_calendario')."'>ID calendario (Intranet AGFG):</label>
                <input type='text' id='".$this->get_field_id('id_calendario')."' name='".$this->get_field_name('id_calendario')."' value='".esc_attr( $calendar )."' class='widefat' />
            </p>
            <p>
                <label for='".$this->get_field_id('url_resultados')."'>URL resultados:</label>
                <input type='text' id='".$this->get_field_id('url_resultados')."' name='".$this->get_field_name('url_resultados')."' value='".esc_attr( $urlResultados )."' class='widefat' />
            </p>";
    }
    
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title']);
        $instance['id_calendario'] = $new_instance['id_calendario'];
        $instance['url_resultados'] = $new_instance['url_resultados'];
        return $instance;
    }
}

function agfg_register_widget() {
    register_widget( 'agfg_Clasificacion_Widget' );
}

add_action( 'widgets_init', 'agfg_register_widget' );


?>