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
        $competicion = $instance['competicion'];
        $categoria = $instance['categoria'];
        $fase = empty($instance['fase']) ? null : $instance['fase'];
        $urlResultados = $instance['url_resultados'];
        
        $clasificacion = wp_agfg_clasificacion_get($competicion, $categoria, $fase);
        
        $html = $args['before_widget'];
        if(!empty($title)) {
            $html .= $args['before_title'] . $title . $args['after_title'];
        }
        if(!empty($clasificacion)) {
            $orderSymbol = $categoria==='F' ? 'ª' : 'º';
            $html .= wp_agfg_common_style();
            $html .=
                '<div class="agfg-clasificacion">'.
                '<table style="width: 100%;">'.
                    '<thead><tr><th></th><th>Equipo</th><th>Ptos</th><th>XG</th><th>XE</th><th>XP</th><th>Dif.</th></tr></thead>'.
                    '</tbody>';
            foreach($clasificacion as $equipa) {
                $sancions = str_repeat ("*",$equipa->puntos_sancion);
                $html .=
                    "<tr>
                        <td style='width:3em;'>{$equipa->posicion}$orderSymbol</td>
                        <td>
                            <div style='text-align:left; padding-left:5px; width:100px;'>
                                <img src='{$equipa->logo}' alt='{$equipa->nome}' width='25' style='display: inline-block; height: 100%; vertical-align: middle;'>
                                <strong style='padding-left:1em'>$equipa->codigo $sancions</strong>
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
        if(!empty($urlResultados)) {
            $html .= "<a href='$urlResultados'>Ver todos os resultados</a>";
        }
        $html .= $args['after_widget'];
        echo $html;
    }
    
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $competicion = ! empty( $instance['competicion'] ) ? $instance['competicion'] : '';
        $categoria = ! empty( $instance['categoria'] ) ? $instance['categoria'] : '';
        $fase = ! empty( $instance['fase'] ) ? $instance['fase'] : '';
        $urlResultados = ! empty( $instance['url_resultados'] ) ? $instance['url_resultados'] : '';

        $competicionsUrl = "https://intranet.gaelicogalego.gal/mestras/competicions.json?tipo=liga";
        $competicionsResponse = wp_remote_get($competicionsUrl);
        $competicions = json_decode($competicionsResponse['body']);
        $html =
            "<p>
                <label for='".$this->get_field_id('title')."'>Titulo:</label>
                <input type='text' id='".$this->get_field_id('title')."' name='".$this->get_field_name('title')."' value='".esc_attr( $title )."' class='widefat' />
            </p>";
        $html .=
            "<p>
                <label for='".$this->get_field_id('categoria')."'>Categoría:</label>
                <select id='".$this->get_field_id('categoria')."' name='".$this->get_field_name('categoria')."' value='".esc_attr( $categoria )."' class='widefat'>
                    <option value=''></option>
                    <option value='F' ".($categoria==='F'?"selected='selected'":'').">Feminina</option>
                    <option value='M' ".($categoria==='M'?"selected='selected'":'').">Masculina</option>
                </select>
            </p>";
        $html .=
            "<p>
                <label for='".$this->get_field_id('competicion')."'>Competición:</label>
                <select id='".$this->get_field_id('competicion')."' name='".$this->get_field_name('competicion')."' class='widefat'>
                    <option value=''></option>";
        foreach($competicions as $c) {
            $html .= "<option value='{$c->codigo}' ".($c->codigo===$competicion?" selected='selected'":"").">$c->nome</option>";
        }
        $html .= "</select></p>";
        $html .=
            "<p>
                <label for='".$this->get_field_id('fase')."'>URL resultados:</label>
                <input type='text' id='".$this->get_field_id('fase')."' name='".$this->get_field_name('fase')."' value='".esc_attr( $fase )."' class='widefat' />
            </p>";
        $html .=
            "<p>
                <label for='".$this->get_field_id('url_resultados')."'>URL resultados:</label>
                <input type='text' id='".$this->get_field_id('url_resultados')."' name='".$this->get_field_name('url_resultados')."' value='".esc_attr( $urlResultados )."' class='widefat' />
            </p>";
        echo $html;
    }
    
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title']);
        $instance['competicion'] = $new_instance['competicion'];
        $instance['categoria'] = $new_instance['categoria'];
        $instance['fase'] = $new_instance['fase'];
        $instance['url_resultados'] = $new_instance['url_resultados'];
        return $instance;
    }
}

function agfg_register_widget() {
    register_widget( 'agfg_Clasificacion_Widget' );
}

add_action( 'widgets_init', 'agfg_register_widget' );


?>