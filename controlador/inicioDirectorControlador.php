<?php

require_once ('modulo/ensayoLaboratorio/dao/EnsayoLaboratorioDAO.php');
require_once ('modulo/trabajoCampo/dao/TrabajoCampoDAO.php');
require_once ('modulo/ensayo/dao/EnsayoDAO.php');
require_once ('modulo/muestra/dao/MuestraDAO.php');
require_once ('modulo/solicitud/dao/SolicitudDAO.php');
require_once ('modulo/solicitud/modelo/SolicitudModelo.php');
require_once ('modulo/pdf/ServicioPDF.php');
require_once ('modulo/bitacora/dao/BitacoraDAO.php');
require_once ('modulo/registro/ServicioRegistroBitacora.php');

$bitacoraDAO = new BitacoraDAO();
$listaBitacoraUltimasDiez = $bitacoraDAO->getBitacoraUltimasDiez();

$ensayoLaboratorioDAO =  new EnsayoLaboratorioDAO();
$listaProyectoEL = $ensayoLaboratorioDAO->getEnsayoLaboratorioDAO();
$listaSeguimientoEL = $ensayoLaboratorioDAO->getSeguimientoEnsayoLaboratorioDAO();

$trabajoCampoDAO =  new TrabajoCampoDAO();
$listaProyectoTC = $trabajoCampoDAO->getTrabajoCampoDAO();
$listaSeguimientoTC = $trabajoCampoDAO->getSeguimientoTrabajoCampoDAO();

$solicitudDAO = new SolicitudDAO();
$listaSolicitud = $solicitudDAO->getSolicitudDAO();

//******************************* Para habilitar una solicitud *********************************************************
if (isset($_GET['is'])) {
    $codigoProyecto = $solicitudDAO->getCodigoProyectoParaInsertarDAO();
    
    $solicitud = new SolicitudModelo();
    $solicitud->setIdSolicitud($_GET['is']);
    $solicitud->setHabilitado('true');
    $solicitud->setCodigoProyecto($codigoProyecto);

    $solicitudDAO->setHabilitadoSolicitudDAO($solicitud);
    $solicitudDAO->setCodigoProyectoSolicitudDAO($solicitud);

    $registroBitacora =  new ServicioRegistroBitacora($bitacoraDAO);
    $registroBitacora->registrar($_GET['is'], 'Nueva solicitud habilitada');

    header('Location: '.Conexion::ruta().'?accion=inicioDirector'); exit;
}

if(isset($_POST['grabar']) and $_POST['grabar'] == 'si') {
    $muestraDAO = new MuestraDAO();
    
    $pdf = new ServicioPDF($solicitudDAO, $ensayoLaboratorioDAO, $muestraDAO, $trabajoCampoDAO);
    $pdf->crearPDF($_POST['reporte'], $_POST['anio']);
}

require_once ('vista/inicioDirector.phtml');
