<?php
$this->set('menu_option', 'calendario');
$this->set('cabeceiraTitulo', empty($cabeceiraTitulo) ? null : $cabeceiraTitulo);
$this->set('cabeceiraMigas', empty($cabeceiraMigas) ? null : $cabeceiraMigas);

echo $this->fetch('content');