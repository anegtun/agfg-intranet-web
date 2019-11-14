<?php

function wp_agfg_clasificacion_get($competicion, $categoria, $fase=null) {
    if(empty($fase)) {
        $url = "https://intranet.gaelicogalego.gal/clasificacion/competicion/$competicion/$categoria.json";
    } else {
        $url = "http://intranet.gaelicogalego.gal/clasificacion/fase/$competicion/$categoria/$fase.json";
    }
    $response = wp_remote_get($url);
    return json_decode($response['body']);
}
