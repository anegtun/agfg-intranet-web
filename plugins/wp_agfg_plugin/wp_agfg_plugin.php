<?php
/*
Plugin Name: Asociacion Galega de Futbol Gaelico - WordPress Plugin
Plugin URI:  https://gaeligogalego.gal/
Description: Plugin para visualización do calendario e clasificación das competicións da AGFG.
Version:     1.4.7
Author:      Asociacion Galega de Futbol Gaelico
Author URI:  https://gaeligogalego.gal/
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

include('wp_agfg_common.php');
include('calendario/wp_agfg_calendario_common.php');
include('calendario/wp_agfg_calendario_shortcode.php');
include('calendario/wp_agfg_xornada_seguinte_shortcode.php');
include('calendario/wp_agfg_xornada_anterior_shortcode.php');
include('clasificacion/wp_agfg_clasificacion_common.php');
include('clasificacion/wp_agfg_clasificacion_shortcode.php');
include('clasificacion/wp_agfg_clasificacion_widget.php');
