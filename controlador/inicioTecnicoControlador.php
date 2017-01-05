<?php

require_once ('modulo/bitacora/dao/BitacoraDAO.php');
require_once ('modulo/ensayoLaboratorio/dao/EnsayoLaboratorioDAO.php');
require_once ('modulo/trabajoCampo/dao/TrabajoCampoDAO.php');
require_once ('modulo/solicitud/dao/SolicitudDAO.php');
require_once ('modulo/resultado/dao/ResultadoDAO.php');
require_once ('modulo/ensayo/dao/EnsayoDAO.php');
require_once ('modulo/muestra/dao/MuestraDAO.php');
require_once ('modulo/detalleEnsayo/dao/DetalleEnsayoDAO.php');
require_once ('modulo/alcance/dao/AlcanceDAO.php');
require_once ('modulo/bitacora/dao/BitacoraDAO.php');
require_once ('modulo/registro/ServicioRegistroSueloRoca.php');
require_once ('modulo/registro/ServicioRegistroResultado.php');

require_once ('modulo/ensayoLaboratorio/modelo/EnsayoLaboratorioModelo.php');
require_once ('modulo/trabajoCampo/modelo/TrabajoCampoModelo.php');
require_once ('modulo/solicitud/modelo/SolicitudModelo.php');
require_once ('modulo/resultado/modelo/ResultadoModelo.php');
require_once ('modulo/alcance/modelo/AlcanceModelo.php');
require_once ('modulo/registro/ServicioRegistroAlcance.php');
require_once ('modulo/pdf/ServicioPDFAlcance.php');


$bitacoraDAO = new BitacoraDAO();
$listaBitacoraUltimasDiez = $bitacoraDAO->getBitacoraUltimasDiez();

$ensayoLaboratorioDAO =  new EnsayoLaboratorioDAO();
$listaProyectoEL = $ensayoLaboratorioDAO->getEnsayoLaboratorioDAO();
$listaProyectoELHabilitado = $ensayoLaboratorioDAO->getEnsayoLaboratorioHabilitadoDAO();
$listaProyectoELSinMuestra = $ensayoLaboratorioDAO->getEnsayoLaboratorioSinMuestraDAO();
$listaProyectoELSinEnsayo = $ensayoLaboratorioDAO->getEnsayoLaboratorioSinEnsayoDAO();
$listaProyectoELConEnsayo = $ensayoLaboratorioDAO->getEnsayoLaboratorioConEnsayoDAO();
$listaSeguimientoEL = $ensayoLaboratorioDAO->getSeguimientoEnsayoLaboratorioDAO();

$trabajoCampoDAO =  new TrabajoCampoDAO();
$listaProyectoTC = $trabajoCampoDAO->getTrabajoCampoDAO();
$listaProyectoTCHabilitado = $trabajoCampoDAO->getTrabajoCampoHabilitadoDAO();
$listaProyectoTCSinAlcance = $trabajoCampoDAO->getTrabajoCampoSinAlcanceDAO();
$listaProyectoTCConAlcance = $trabajoCampoDAO->getTrabajoCampoConAlcanceDAO();
$listaSeguimientoTC = $trabajoCampoDAO->getSeguimientoTrabajoCampoDAO();

$solicitudDAO = new SolicitudDAO();
$listaSolicitud = $solicitudDAO->getSolicitudHabilitadoDAO();

$resultadoDAO = new ResultadoDAO();

$ensayoDAO = new EnsayoDAO();

$detalleEnsayoDAO =  new DetalleEnsayoDAO();
$listaDetalleEnsayo = $detalleEnsayoDAO->getDetalleEnsayoDAO();

$muestraDAO = new MuestraDAO();

$alcanceDAO = new AlcanceDAO();

$bitacoraDAO = new BitacoraDAO();
$listaBitacoraUltimasDiez = $bitacoraDAO->getBitacoraUltimasDiez();

//******************************* Registro de resultados parciales para un ensayo de laboratorio ***********************
$resultadoEL = false;

if(isset($_POST['grabarResultadoEL']) and $_POST['grabarResultadoEL'] == 'si') {
    if(empty($_POST['proyectoEL'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioTecnico'); exit;
    }
    $idSolicitud = intval($_POST['proyectoEL']);

    $resultado = new ResultadoModelo();
    $resultado->setSolicitudIdSolicitud($idSolicitud);

    $listaResultadoParcial = $resultadoDAO->getResultadoParcialDAO($resultado);

    $resultadoEL = true;
}

if(isset($_POST['grabarSubirResultadoEL']) and $_POST['grabarSubirResultadoEL'] == 'si') {
    $solicitud = new SolicitudModelo();
    $idSolicitud = intval($_POST['idSolicitud']);
    $solicitud->setIdSolicitud($idSolicitud);

    $tipoSolicitud = $solicitudDAO->getTipoSolicitudDAO($solicitud);
    $codigoProyecto = $solicitudDAO->getCodigoProyectoSolicitudDAO($solicitud);
    $tipo = 'EnsayoLaboratorio';

    $direccion = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/';

    $nombreArchivo = $_FILES['archivo']['name'];
    $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];

    if (file_exists($direccion)) {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/'.$nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/'.$nombreArchivo;
        mkdir('Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/', 0777, true);
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }

    $registro = new ServicioRegistroResultado($resultadoDAO, $solicitudDAO);
    $registro->registrar($nombreArchivo, $idSolicitud, $_POST['descripcion'], 'ResultadoParcial');

    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioTecnico'); exit;
}

//******************************* Registro de resultados parciale para un trabajo de campo *****************************
$resultadoTC = false;

if(isset($_POST['grabarResultadoTC']) and $_POST['grabarResultadoTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioTecnico'); exit;
    }
    $idSolicitud = intval($_POST['proyectoTC']);

    $resultado = new ResultadoModelo();
    $resultado->setSolicitudIdSolicitud($idSolicitud);

    $listaResultadoParcial = $resultadoDAO->getResultadoParcialDAO($resultado);

    $resultadoTC = true;
}

if(isset($_POST['grabarSubirResultadoTC']) and $_POST['grabarSubirResultadoTC'] == 'si') {
    $solicitud = new SolicitudModelo();
    $idSolicitud = intval($_POST['idSolicitud']);
    $solicitud->setIdSolicitud($idSolicitud);

    $tipoSolicitud = $solicitudDAO->getTipoSolicitudDAO($solicitud);
    $codigoProyecto = $solicitudDAO->getCodigoProyectoSolicitudDAO($solicitud);
    $tipo = 'TrabajoCampo';

    $direccion = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/';

    $nombreArchivo = $_FILES['archivo']['name'];
    $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];

    if (file_exists($direccion)) {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/'.$nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/'.$nombreArchivo;
        mkdir('Archivos/'.$tipo.'/'.$codigoProyecto.'/ResultadoParcial/', 0777, true);
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }

    $registro = new ServicioRegistroResultado($resultadoDAO, $solicitudDAO);
    $registro->registrar($nombreArchivo, $idSolicitud, $_POST['descripcion'], 'ResultadoParcial');

    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioTecnico'); exit;
}

require_once ('vista/inicioTecnico.phtml');
