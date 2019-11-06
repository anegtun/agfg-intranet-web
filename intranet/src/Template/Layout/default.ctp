<?php
$authUser = $this->request->getSession()->read('Auth.User');
$menu_option = empty($menu_option) ? '' : $menu_option;
?>

<!DOCTYPE html>
<html lang="gl">
    <head>
        <?= $this->Html->charset() ?>
        <title>AGFG - <?= $this->fetch('title') ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="theme-color" content="#ffffff">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <!-- Favicon -->
        <?= $this->Html->meta('favicon.ico', '/images/favicon/agfg-icon.png', array('type' => 'icon')) ?>
        <!-- custom:css -->
        <?= $this->Html->css(array("/maqint/maqint", "basic-page", "custom")) ?>
        <!-- libs:js -->
        <?= $this->Html->script("/libs/ckeditor/ckeditor") ?>
        <!-- custom:js -->
        <?= $this->Html->script(array("/maqint/maqint-config", "/maqint/maqint", "/maqint/support")) ?>
        <!-- outros -->
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    
    
    
    <body>
        <!-- Loader -->
        <div id="page-loader">
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        <!-- Main Container -->
        <div id="main-wrapper">
            <!-- Environment Display -->
            <!--div id="env-display-top" class="env-display-red row">
                <div class="hc-exception" id="env-display-content-top">
                    <i class="fa fa-cogs"><span class="sr-only"></span></i><span class="env-display-name"></span>
                </div>
            </div-->

            
            <header id="main-header" class="row">
                <div id="header-controls">
                    <?= $this->Html->link(
                        $this->Html->image("/images/agfg-logo.png", array('alt'=>'AGFG', 'width'=>'95')) . '<span class="sr-only">AGFG</span>',
                        array('controller'=>'Main', 'action'=>'index'),
                        array('escape'=>false, 'id'=>'header-logo')) ?>
                    <div id="header-left-menu-toggler">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </div>
                </div>
                <div id="header-right">
                    <div class="row no-gutters">
                        <!-- Buscador (non hai, pero deixa espazo) -->
                        <div id="header-search" class="col-md-3 hidden-to-sm"></div>
                        <div id="header-user" class="col-xs-12 col-md-9">
                            <div class="row row-no-gutters">
                                <div id="header-notifications" class="hidden-xs col-sm-10 col-md-7 text-right">
                                    <!--a href="#" data-toggle-search class="hidden-from-md"><i class="glyphicon glyphicon-search"><span class="sr-only">Busca</span></i></a>
                                    <a href="#"><i class="glyphicon glyphicon-bell" data-toggle="tooltip" data-placement="bottom" title="Alertas"><span class="notification warning">4</span><span class="sr-only">Alertas</span></i></a>
                                    <a href="#"><i class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="bottom" title="Mensaxes"><span class="notification danger">20</span><span class="sr-only">Mensaxes</span></i></a>
                                    <a href="#"><i class="glyphicon glyphicon-cog" data-toggle="tooltip" data-placement="bottom" title="Axustes"><span class="sr-only">Axustes</span></i></a>
                                    <a href="#"><i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Axuda"><span class="sr-only">Axuda</span></i></a-->
                                </div>
                                <div id="header-profile" class="col-xs-12 col-sm-2 col-md-5">
                                    <!-- Profile data -->
                                    <div class="dropdown" id="header-profile-data">
                                        <div class="dropdown-toggle no-selectable" data-toggle="dropdown" >
                                            <div id="header-user-image">
                                                <?= $this->Html->image("/images/user/user-image-mini.png", array('alt'=>$authUser['nome'])); ?>
                                            </div>
                                            <div id="header-user-info">
                                                <div id="header-user-name" class="hidden-xs hidden-sm"><?= $authUser['nome'] ?></div>
                                                <div id="header-user-role" class="hidden-xs hidden-sm"><?= $authUser['rol'] ?></div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li class="hidden-from-md text-right"><a href="#"><strong class="main-blue"><?= $authUser['nome'] ?></strong><span class="sr-only"><?= $authUser['nome'] ?></span></a></li>
                                            <li class="hidden-from-md text-right"><a href="#"><small class="medium-blue"><?= $authUser['rol'] ?></small><span class="sr-only"><?= $authUser['rol'] ?></span> </a></li>
                                            <!-- Mobil -->
                                            <li class="divider visible-xs"></li>
                                            <li class="hidden-from-md">
                                                <?= $this->Html->link(
                                                    '<span class="text-danger"><i class="glyphicon glyphicon-log-out p-r-5"><span class="sr-only">Saír</span></i> <strong >Saír</strong></span>',
                                                    array('controller'=>'Main', 'action'=>'logout'),
                                                    array('escape'=>false)
                                                ) ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="header-logout" class="hidden-xs hidden-sm">
                                        <?= $this->Html->link(
                                            '<span class="text-danger"><i class="glyphicon glyphicon-off p-r-5" data-toggle="tooltip" title="Saír"  data-placement="bottom"><span class="sr-only">Saír</span></i></span>',
                                            array('controller'=>'Main', 'action'=>'logout'),
                                            array('escape'=>false)
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            

            <div id="main-content" class="row" role="main"><section id="basic-page" class="page">
                <aside id="left-menu" class="no-selectable">
                    <div class="content-wrapper">
                        <ul class="nav nav-pills nav-stacked" id="left-menu-content" role="navigation">
                            <li data-toggle="tooltip">
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></span> Inicio',
                                    array('controller'=>'Main', 'action'=>'index'),
                                    array('escape'=>false)) ?>
                            </li>
                            <li data-toggle="tooltip">
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-check"><span class="sr-only">Horarios e resultados</span></span> Horarios e resultados',
                                    array('controller'=>'Resultados', 'action'=>'index'),
                                    array('escape'=>false)) ?>
                            </li>
                            <?php if($authUser['rol']==='admin') : ?>
                                <li data-toggle="tooltip">
                                    <?= $this->Html->link(
                                        '<span class="glyphicon glyphicon-calendar"><span class="sr-only">Competicións</span></span> Competicións',
                                        array('controller'=>'Competicions', 'action'=>'index'),
                                        array('escape'=>false)) ?>
                                </li>
                                <li data-toggle="tooltip">
                                    <?= $this->Html->link(
                                        '<span class="glyphicon glyphicon-user"><span class="sr-only">Equipas</span></span> Equipas',
                                        array('controller'=>'Equipas', 'action'=>'index'),
                                        array('escape'=>false)) ?>
                                </li>
                                <li data-toggle="tooltip">
                                    <?= $this->Html->link(
                                        '<span class="glyphicon glyphicon-education"><span class="sr-only">Árbitros</span></span> Árbitros',
                                        array('controller'=>'Arbitros', 'action'=>'index'),
                                        array('escape'=>false)) ?>
                                </li>
                                <li data-toggle="tooltip">
                                    <?= $this->Html->link(
                                        '<span class="glyphicon glyphicon-flag"><span class="sr-only">Campos</span></span> Campos',
                                        array('controller'=>'Campos', 'action'=>'index'),
                                        array('escape'=>false)) ?>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </aside>

                <div class="page-content">
                    <?= $this->Flash->render(); ?>

                    <div class="container-full gray-bg">
                        <div class="row page-header">
                            <div class="col-xs-12 m-b-15">
                                <?php if(!empty($cabeceiraTitulo)) : ?>
                                    <h1><?= $cabeceiraTitulo ?></h1>
                                <?php endif ?>
                                <?php if(!empty($cabeceiraMigas)) : ?>
                                    <ol class="breadcrumb">
                                        <li>
                                            <?= $this->Html->link(
                                                '<i class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></i>',
                                                ['controller'=>'Main', 'action'=>'index'],
                                                ['escape'=>false]) ?>    
                                        </li>
                                        <?php foreach($cabeceiraMigas as $c) : ?>
                                            <?php if(!empty($c['url'])) : ?>
                                                <li><?= $this->Html->link($c['label'], $c['url']) ?></li>
                                            <?php else : ?>
                                                <li class="active"><?= $c['label'] ?></li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ol>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    
                    <?= $this->fetch('content'); ?>
                </div>
            </div>

            <footer id="main-footer" class="row">
                <div id="footer-logo">
                    <a href="https://gaelicogalego.gal">
                        <?= $this->Html->image('/images/agfg-logo-footer.png', array('width'=>'150')) ?>
                    </a>
                </div>
                <div id="footer-info">
                    <div class="row row-no-gutters">
                        <div id="footer-text" class="hidden-xs col-sm-7">
                            Intranet da Asociación Galega de Fútbol Gaélico (AGFG)
                        </div>
                        <div id="footer-menu" class="col-xs-12 col-sm-5">
                            <ul class="list-inline">
                                <li>
                                    <i class="glyphicon glyphicon-bookmark" aria-label="Versión"><span class="sr-only">Versión</span></i>
                                    Ver. <span>1.3.2</span>
                                </li>
                                <!--li data-toggle="tooltip" title="Ver información de contacto" data-placement="left">
                                    <a href="#" data-toggle="modal" data-target="#modal-contact-info">
                                        <i class="glyphicon glyphicon-envelope" aria-label="Contacto"><span class="sr-only">Contacto</span></i>
                                        Contacto
                                    </a>
                                </li-->
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
    </div>

</body>
</html>