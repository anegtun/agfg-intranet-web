<?php
$this->set('menu_option', 'competicions');
$this->set('submenu_option', 'listado');
$this->set('cabeceiraTitulo', empty($cabeceiraTitulo) ? null : $cabeceiraTitulo);
$this->set('cabeceiraMigas', empty($cabeceiraMigas) ? null : $cabeceiraMigas);

echo $this->fetch('content');
?>