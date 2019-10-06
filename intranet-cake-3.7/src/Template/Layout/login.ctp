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
        <?= $this->Html->css(["/maqint/maqint", "login-page"]) ?>
        <!-- libs:js -->
        <?= $this->Html->script("/libs/ckeditor/ckeditor") ?>
        <!-- custom:js -->
        <?= $this->Html->script(["/maqint/maqint-config", "/maqint/maqint", "/maqint/support"]) ?>
    </head>

    <body>
        <!-- Loader -->
        <div id="page-loader">
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div id="main-content" class="row" role="main"><section id="login-page" class="page no-header no-footer">
            <div class="login-bg"></div>
                <div class="page-content">
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 login-left">
                                        <div class="row">
                                            <!-- Logo -->
                                            <div class="col-xs-12 text-center login-logo">
                                                <?= $this->Html->image("/images/maqint-logo-medium.png", ['alt' => 'AGFG']); ?>
                                            </div>

                                            <!-- Content -->
                                            <?= $this->Flash->render(); ?>
                                            <?= $this->fetch('content'); ?>

                                            <!-- Footer toolbar -->
                                            <div class="login-toolbar text-center col-xs-12" style="min-width:500px"></div>
                                        </div>
                                    </div>
                                    <div class="hidden-xs hidden-sm col-md-6 col-sm-8 login-right">
                                        <!-- MAQINT logo -->
                                        <div class="col-xs-12 text-center login-right-content"></div>

                                        <!-- Disclaimer -->
                                        <div class="xunta-disclaimer">
                                            <!--div class="xunta-logo">
                                                <a href="https://gaelicogalego.gal/">
                                                    <span class="sr-only">Ir á páxina da Xunta</span>
                                                    <img alt="Logo da Xunta" src="images/xunta-galicia-logo-medium.png" class="img-responsive">
                                                </a>
                                            </div-->
                                            <div class="xunta-disclaimer-text">
                                                <p>Intranet da Asociación Galega de Fútbol Gaélico</p>
                                            </div>
                                            <div class="version">
                                                Ver. <span>1.0.0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>