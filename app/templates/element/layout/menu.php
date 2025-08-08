<?php
$authUser = $this->request->getAttribute('identity');
?>

<ul class="nav nav-pills nav-stacked" id="left-menu-content" role="navigation">
    <li data-toggle="tooltip">
        <?= $this->Html->link(
            "<span class='glyphicon glyphicon-home'><span class='sr-only'>Inicio</span></span> Inicio",
            array('controller'=>'Main', 'action'=>'index'),
            array('escape'=>false)) ?>
    </li>

    <?= $this->element('layout/menu_option', [
        'id' => 'competicions',
        'nome' => 'Competición',
        'icono' => 'fire',
        'auth' => ['admin','comp','euro22'],
        'submenus' => [
            [ 'id' => 'resultados', 'nome' => 'Horarios e resultados', 'url' => ['controller'=>'Resultados', 'action'=>'index'] ],
            [ 'id' => 'prensa', 'nome' => 'Prensa', 'url' => ['controller'=>'Calendario', 'action'=>'prensa'], 'auth' => ['admin','comp'] ],
            [ 'id' => 'administracion', 'nome' => 'Administrar competicións', 'url' => ['controller'=>'Competicions', 'action'=>'index'], 'auth' => ['admin'] ],
            [ 'id' => 'arbitros', 'nome' => 'Árbitros', 'url' => ['controller'=>'Arbitros', 'action'=>'index'], 'auth' => ['admin','comp'] ],
            [ 'id' => 'campos', 'nome' => 'Campos', 'url' => ['controller'=>'Campos', 'action'=>'index'], 'auth' => ['admin','comp'] ],
        ],
        'menu_option'=>$menu_option, 
        'submenu_option'=>$submenu_option]) ?>

    <?= $this->element('layout/menu_option', [
        'id' => 'calendario',
        'nome' => 'Calendario',
        'icono' => 'calendar',
        'auth' => ['admin'],
        'submenus' => [
            [ 'id' => 'eventos', 'nome' => 'Eventos', 'url' => ['controller'=>'Calendario', 'action'=>'eventos'] ],
            [ 'id' => 'tempadas', 'nome' => 'Tempadas', 'url' => ['controller'=>'Calendario', 'action'=>'tempadas'] ]
        ],
        'menu_option'=>$menu_option, 
        'submenu_option'=>$submenu_option]) ?>

    <?= $this->element('layout/menu_option', [
        'id' => 'economico',
        'nome' => 'Contabilidade',
        'icono' => 'euro',
        'auth' => ['admin','tesour'],
        'submenus' => [
            [ 'id' => 'movementos', 'nome' => 'Movementos', 'url' => ['controller'=>'Economico', 'action'=>'movementos'] ],
            [ 'id' => 'previsions', 'nome' => 'Previsións', 'url' => ['controller'=>'Economico', 'action'=>'previsions'] ],
            [ 'id' => 'facturas', 'nome' => 'Facturas', 'url' => ['controller'=>'Economico', 'action'=>'facturas'] ],
            [ 'id' => 'resumo', 'nome' => 'Resumo xeral', 'url' => ['controller'=>'Economico', 'action'=>'resumo'] ],
            [ 'id' => 'resumoClubes', 'nome' => 'Resumo clubes', 'url' => ['controller'=>'Economico', 'action'=>'resumoClubes'] ],
            [ 'id' => 'partidas', 'nome' => 'Partidas orzamentarias', 'url' => ['controller'=>'Economico', 'action'=>'partidasOrzamentarias'] ]
        ],
        'menu_option'=>$menu_option, 
        'submenu_option'=>$submenu_option]) ?>

    <?= $this->element('layout/menu_option', [
        'id' => 'tenda',
        'nome' => 'Tenda',
        'icono' => 'shopping-cart',
        'auth' => ['admin','tesour'],
        'submenus' => [
            [ 'id' => 'pedidos', 'nome' => 'Pedidos', 'url' => ['controller'=>'Tenda', 'action'=>'pedidos'] ],
            [ 'id' => 'demanda', 'nome' => 'Demanda', 'url' => ['controller'=>'Tenda', 'action'=>'demanda'] ],
            [ 'id' => 'stock', 'nome' => 'Stock', 'url' => ['controller'=>'Tenda', 'action'=>'stock'] ]
        ],
        'menu_option'=>$menu_option, 
        'submenu_option'=>$submenu_option]) ?>

    <?= $this->element('layout/menu_option', [
        'id' => 'clubes',
        'nome' => 'Clubes',
        'icono' => 'flag',
        'auth' => ['admin'],
        'submenus' => [
            [ 'id' => 'clubes', 'nome' => 'Clubes', 'url' => ['controller'=>'Clubes', 'action'=>'index'] ],
            [ 'id' => 'federacions', 'nome' => 'Federacións', 'url' => ['controller'=>'Federacions', 'action'=>'index'] ]
        ],
        'menu_option'=>$menu_option, 
        'submenu_option'=>$submenu_option]) ?>
</ul>