<?php
$authUser = $this->request->getSession()->read('Auth.User');

$menu_selected = $menu_option === $id;
?>

<?php if(empty($auth) || in_array($authUser['rol'], $auth)) : ?>

    <li data-toggle="tooltip">
        <a 
            href="#" 
            data-toggle="collapse" 
            data-target="#<?= $id ?>-entries" 
            data-parent="#left-menu-content" 
            <?=$menu_selected ? 'aria-expanded="true"' : ''?>>
            
                <span class="glyphicon glyphicon-<?= $icono ?>">
                    <span class="sr-only"><?= $nome ?></span>
                </span>
                <?= $nome ?>
                <span class="caret caret-right"></span>
        
        </a>

        <?php if (!empty($submenus)) : ?>
            <ul 
                id="<?= $id ?>-entries" 
                class="nav nav-pills nav-stacked left-submenu collapse 
                <?=$menu_selected ? 'in' : ''?>" 
                <?=$menu_selected ? 'aria-expanded="true"' : ''?>>

                    <?php foreach($submenus as $submenu) : ?>

                        <?php if(empty($submenu['auth']) || in_array($authUser['rol'], $submenu['auth'])) : ?>
                            
                            <li <?=$submenu_option === $submenu['id'] ? 'class="active"' : ''?>>
                                <?= $this->Html->link($submenu['nome'], $submenu['url']) ?>
                            </li>
                        
                        <?php endif ?>
                        
                    <?php endforeach ?>
            </ul>
        <?php endif ?>
    </li>

<?php endif ?>