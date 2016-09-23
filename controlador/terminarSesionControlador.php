<?php
session_destroy();
header("Location: ".Conexion::ruta()."?accion=inicio&m=3");exit;
?>