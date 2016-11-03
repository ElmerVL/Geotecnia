<?php

require_once ('modulo/bitacora/dao/BitacoraDAO.php');

$bitacoraDAO = new BitacoraDAO();
$listaBitacoraUltimasDiez = $bitacoraDAO->getBitacoraUltimasDiez();

require_once ('vista/inicioTecnico.phtml');
