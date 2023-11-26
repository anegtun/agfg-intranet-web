<?php
$authUser = $this->request->getSession()->read('Auth.User');
$menu_option = empty($menu_option) ? '' : $menu_option;
$submenu_option = empty($submenu_option) ? '' : $submenu_option;
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
        <?= $this->Html->meta('favicon.ico', '/agfg/img/favicon/agfg-icon.png', ['type' => 'icon']) ?>
        <!-- custom:css -->
        <?= $this->Html->css(["/maqint/maqint", "/agfg/css/resultados", "/agfg/css/custom"]) ?>
        <!-- libs:js -->
        <?= $this->Html->script("/libs/ckeditor/ckeditor") ?>
        <!-- custom:js -->
        <?= $this->Html->script(["/maqint/maqint-config", "/maqint/maqint", "/maqint/support"]) ?>
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
                                                    '<span class="text-danger"><i class="glyphicon glyphicon-log-out p-r-5"><span class="sr-only">Saír</span></i> <strong>Saír</strong></span>',
                                                    ['controller'=>'Users', 'action'=>'logout'],
                                                    ['escape'=>false]
                                                ) ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="header-logout" class="hidden-xs hidden-sm">
                                        <?= $this->Html->link(
                                            '<span class="text-danger"><i class="glyphicon glyphicon-off p-r-5" data-toggle="tooltip" title="Saír"  data-placement="bottom"><span class="sr-only">Saír</span></i></span>',
                                            ['controller'=>'Users', 'action'=>'logout'],
                                            ['escape'=>false]
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
                        <?= $this->element('layout/menu', ['menu_option'=>$menu_option, 'submenu_option'=>$submenu_option]) ?>
                    </div>
                </aside>

                <div class="page-content">
                    <div class="container-full gray-bg">
                        <div class="row page-header">
                            <div class="col-xs-12 m-b-15">
                                <?php if(isset($cabeceiraTitulo)) : ?>
                                    <h1 class="hidden-xs hidden-sm"><?= $cabeceiraTitulo ?></h1>
                                <?php endif ?>
                                <?php if(isset($cabeceiraMigas)) : ?>
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

                    <div class="container-full" style="margin-top:2em;">
                        <?= $this->Flash->render(); ?>
                        <?= $this->fetch('content'); ?>
                    </div>
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
                                    Ver. <span><?= $this->AgfgConfig->version() ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>