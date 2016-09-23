<?php
require_once ("modulo/calendario/modelo/calendarioModelo.php");

$calendario = new Calendario();
$contador = 0;
$arregloFecha = $calendario->getFecha();

require_once ("vista/inicioDirector.phtml");
?>