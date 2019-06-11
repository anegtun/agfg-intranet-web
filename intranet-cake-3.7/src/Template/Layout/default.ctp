<?php
$authUser = $this->request->session()->read('Auth.User');
$menu_option = empty($menu_option) ? '' : $menu_option;
?>

<!DOCTYPE html>
<html lang="gl">
    <head>
        <title>AGFG - <?= $this->fetch('title') ?></title>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {height: 450px}
            /* Set gray background color and 100% height */
            .sidenav {
                padding-top: 20px;
                background-color: #f1f1f1;
                height: 100%;
            }
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }
            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
                .sidenav {
                    height: auto;
                    padding: 15px;
                }
                .row.content {height:auto;}
            }
        </style>
        <?= $this->Html->meta('icon') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    
    
    
    <body>
        
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= $this->Html->link('Logo', array('controller'=>'Main'), array('class'=>'navbar-brand')) ?>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="<?= empty($menu_option) ? 'active' : '' ?>">
                            <?= $this->Html->link('Inicio', ['controller'=>'Main', 'action'=>'index']) ?>
                        </li>
                        <?php if(!empty($authUser)) : ?>
                            <?php /*li class="<?= ($menu_option==='users') ? 'active' : '' ?>">
                                <?= $this->Html->link('Usuarios', ['controller'=>'Usuarios', 'action'=>'index']) ?>
                            </li*/ ?>
                            <li class="<?= ($menu_option==='clubes') ? 'active' : '' ?>">
                                <?= $this->Html->link('Clubes', ['controller'=>'Clubes', 'action'=>'index']) ?>
                            </li>
                            <li class="<?= ($menu_option==='competitions') ? 'active' : '' ?>">
                                <?= $this->Html->link('Competicións', ['controller'=>'Competicions', 'action'=>'index']) ?>
                            </li>
                        <?php endif ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(!empty($authUser)) : ?>
                            <li>
                                <a><?= $authUser['nome'] ?></a>
                            </li>
                            <li>
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-log-out"></span> Saír',
                                    ['controller'=>'Main', 'action'=>'logout'],
                                    ['escape'=>false]
                                ) ?>
                            </li>
                        <?php else : ?>
                            <li>
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-log-in"></span> Entrar',
                                    ['controller'=>'Main', 'action'=>'login'],
                                    ['escape'=>false]
                                ) ?>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-2 sidenav">
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                </div>
                <div class="col-sm-8 text-left">
                    <h1><?= $this->fetch('title') ?></h1>
                    <?= $this->Flash->render(); ?>
                    <?= $this->fetch('content'); ?>
                </div>
                <div class="col-sm-2 sidenav">
                    <div class="well">
                        <p>ADS</p>
                    </div>
                    <div class="well">
                        <p>ADS</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid text-center">
            <p>Footer Text</p>
        </footer>

        <?php //$this->element('sql_dump'); ?>
        
    </body>
</html>
