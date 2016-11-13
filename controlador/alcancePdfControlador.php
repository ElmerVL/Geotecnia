<?php
require_once ('modulo/alcance/dao/AlcanceDAO.php');
$alcanceDao = new AlcanceDAO();
$alcanceDao->recuperarAlcanceDAO($_GET['TC']);
require_once ('vista/alcancePdf.phtml');