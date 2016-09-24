<?php
require_once 'configuracion/Conexion.php';

if (!empty($_GET['accion'])) {
    $accion=$_GET['accion'];
} else {
    $accion='inicio';
}

if (is_file('controlador/'.$accion.'Controlador.php')) {
    require_once ('controlador/' . $accion . 'Controlador.php');
} else {
    require_once('controlador/errorControlador.php');
}
