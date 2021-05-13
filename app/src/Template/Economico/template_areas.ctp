<?php
$this->set('menu_option', 'configuracion');
$this->set('submenu_option', 'areas_economicas');
$this->set('cabeceiraTitulo', empty($cabeceiraTitulo) ? null : $cabeceiraTitulo);
$this->set('cabeceiraMigas', empty($cabeceiraMigas) ? null : $cabeceiraMigas);

echo $this->fetch('content');
?>