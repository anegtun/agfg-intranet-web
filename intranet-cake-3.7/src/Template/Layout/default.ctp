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
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
        <link rel="manifest" href="manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">

        <!-- custom:css -->
        <?= $this->Html->css(array("/maqint/maqint", "basic-page")) ?>
        <!-- libs:js -->
        <?= $this->Html->script("/libs/ckeditor/ckeditor") ?>
        <!-- custom:js -->
        <?= $this->Html->script(array("/maqint/maqint-config", "/maqint/maqint", "/maqint/support")) ?>

        <?php //= $this->Html->meta('icon') ?>
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
                    <a href="index.html" id="header-logo">
                        <?= $this->Html->image("/images/maqint-logo.png", ['alt' => 'AGFG']); ?>
                        <span class="sr-only">AGFG</span>
                    </a>
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
                                                <img alt="Imaxe do/a usuario/a" class="img-circle" src="images/user/user-image-mini.png">
                                            </div>
                                            <div id="header-user-info">
                                                <div id="header-user-name" class="hidden-xs hidden-sm"><?= $authUser['nome'] ?></div>
                                                <div id="header-user-role" class="hidden-xs hidden-sm">Administrador</div>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li class="hidden-from-md text-right"><a href="#"><strong class="main-blue"><?= $authUser['nome'] ?></strong><span class="sr-only"><?= $authUser['nome'] ?></span></a></li>
                                            <li class="hidden-from-md text-right"><a href="#"><small class="medium-blue">Administrador</small><span class="sr-only">Administrador</span> </a></li>
                                            <!-- Mobil -->
                                            <li class="divider visible-xs"></li>
                                            <li class="hidden-from-md">
                                                <?= $this->Html->link(
                                                    '<span class="text-danger"><i class="glyphicon glyphicon-log-out p-r-5"><span class="sr-only">Saír</span></i> <strong >Saír</strong></span>',
                                                    ['controller'=>'Main', 'action'=>'logout'],
                                                    ['escape'=>false]
                                                ) ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="header-logout" class="hidden-xs hidden-sm">
                                        <?= $this->Html->link(
                                            '<span class="text-danger"><i class="glyphicon glyphicon-off p-r-5" data-toggle="tooltip" title="Saír"  data-placement="bottom"><span class="sr-only">Saír</span></i></span>',
                                            ['controller'=>'Main', 'action'=>'logout'],
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
                        <ul class="nav nav-pills nav-stacked" id="left-menu-content" role="navigation">
                            <li data-toggle="tooltip">
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-home"><span class="sr-only">Inicio</span></span> Inicio',
                                    ['controller'=>'Main', 'action'=>'index'],
                                    ['escape'=>false]) ?>
                            </li>
                            <li data-toggle="tooltip">
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon glyphicon-user"><span class="sr-only">Equipas</span></span> Equipas',
                                    ['controller'=>'Equipas', 'action'=>'index'],
                                    ['escape'=>false]) ?>
                            </li>
                            <li data-toggle="tooltip">
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon glyphicon-calendar"><span class="sr-only">Competicións</span></span> Competicións',
                                    ['controller'=>'Competicions', 'action'=>'index'],
                                    ['escape'=>false]) ?>
                            </li>
                        </ul>
                    </div>
                </aside>

                <div class="page-content">
                    <?= $this->Flash->render(); ?>
                    <?= $this->fetch('content'); ?>
                </div>
            </div>

            <footer id="main-footer" class="row">
                <div id="footer-logo">
                    <a href="https://gaelicogalego.gal">
                        <img alt="Logo da Xunta" src="https://gaelicogalego.gal/wp-content/uploads/2018/12/agfg-header-2b.png" width="150" />
                        <span class="sr-only">Ligazón á web da Xunta</span>
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
                                    Ver. <span>1.0.0</span>
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