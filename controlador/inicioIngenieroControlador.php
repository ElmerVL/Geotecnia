<?php

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
require_once ('modulo/registro/ServicioRegistroMuestra.php');
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

//******************************* Informe final ************************************************************************
$informeFinal = false;

if(isset($_POST['grabarInformeFinal']) and $_POST['grabarInformeFinal'] == 'si') {
    if(empty($_POST['proyecto'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idSolicitud = intval($_POST['proyecto']);

    $resultado = new ResultadoModelo();
    $resultado->setSolicitudIdSolicitud($idSolicitud);
    
    $listaInformeFinal = $resultadoDAO->getResultadoInformeFinalDAO($resultado);

    $informeFinal = true;
}

if(isset($_POST['grabarSubirInformeFinal']) and $_POST['grabarSubirInformeFinal'] == 'si') {
    $solicitud = new SolicitudModelo();
    $idSolicitud = intval($_POST['idSolicitud']);
    $solicitud->setIdSolicitud($idSolicitud);

    $tipoSolicitud = $solicitudDAO->getTipoSolicitudDAO($solicitud);
    if ('Ensayo de laboratorio' == $tipoSolicitud) { 
        $tipo = 'EnsayoLaboratorio'; 
    } else {
        $tipo = 'TrabajoCampo';
    }
    $codigoProyecto = $solicitudDAO->getCodigoProyectoSolicitudDAO($solicitud);

    $direccion = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/InformeFinal/';

    $nombreArchivo = $_FILES['archivo']['name'];
    $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];

    if (file_exists($direccion)) {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/InformeFinal/'.$nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        $destino = 'Archivos/'.$tipo.'/'.$codigoProyecto.'/InformeFinal/'.$nombreArchivo;
        mkdir('Archivos/'.$tipo.'/'.$codigoProyecto.'/InformeFinal/', 0777, true);
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }

    $registro = new ServicioRegistroResultado($resultadoDAO, $solicitudDAO);
    $registro->registrar($nombreArchivo, $idSolicitud, $_POST['descripcion'], 'InformeFinal');

    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}
//******************************* Registro suelo y roca ****************************************************************
$tipoEnsayo = ' ';

if(isset($_POST['grabarDetalleEnsayo']) and $_POST['grabarDetalleEnsayo'] == 'si') {
    if(empty($_POST['proyectoEL'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idEnsayoSolicitud = intval($_POST['proyectoEL']);

    if ('Suelo' == $_POST['tipoEnsayo']) {
        $tipoEnsayo = 'Suelo';
    } else {
        $tipoEnsayo = 'Roca';
    }
}

if(isset($_POST['grabarRegistroSuelo']) and $_POST['grabarRegistroSuelo'] == 'si') {
    $registro = new ServicioRegistroSueloRoca($ensayoDAO, $ensayoLaboratorioDAO, $detalleEnsayoDAO);

    $listaCodigoEnsayo = array();

    if(!(empty($_POST['ensayo']))){
        foreach($_POST['ensayo'] as $ensayo){
            $listaCodigoEnsayo[] = $ensayo;
        }
    }

    for ($i = 0; $i < sizeof($listaCodigoEnsayo); $i++) {
        $codigoEnsayo = $listaCodigoEnsayo[$i];
        $cantidadEnsayo = $_POST["cantidad$codigoEnsayo"];

        $registro->registrar(intval($_POST['idEnsayoLaboratorio']), $codigoEnsayo, $cantidadEnsayo);
    }
}

if(isset($_POST['grabarRegistroRoca']) and $_POST['grabarRegistroRoca'] == 'si') {
    $registro = new ServicioRegistroSueloRoca($ensayoDAO, $ensayoLaboratorioDAO, $detalleEnsayoDAO);

    $listaCodigoEnsayo = array();
    if(!(empty($_POST['ensayo']))){
        foreach($_POST['ensayo'] as $ensayo){
            $listaCodigoEnsayo[] = $ensayo;
        }
    }

    for ($i = 0; $i < sizeof($listaCodigoEnsayo); $i++) {
        $codigoEnsayo = $listaCodigoEnsayo[$i];
        $cantidadEnsayo = $_POST["cantidad$codigoEnsayo"];

        $registro->registrar(intval($_POST['idEnsayoLaboratorio']), $codigoEnsayo, $cantidadEnsayo);
    }
}

//******************************* Registro muestra *********************************************************************
$muestra = false;

if(isset($_POST['grabarMuestra']) and $_POST['grabarMuestra'] == 'si') {
    if(empty($_POST['proyectoEL'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idEnsayoSolicitud = intval($_POST['proyectoEL']);

    $muestra = true;
}

if(isset($_POST['grabarRegistroMuestra']) and $_POST['grabarRegistroMuestra'] == 'si') {
    if(empty($_POST['ubicacionGeneral']) or empty($_POST['ubicacionEspecifica'])
       or empty($_POST['profundidad']) or empty($_POST['puntoExtraccion'])) {
        // A qui un mensaje desplegable para este control
        $muestra = true;
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }

    $registro = new ServicioRegistroMuestra($muestraDAO, $ensayoLaboratorioDAO, $bitacoraDAO);
    $registro->registrar(intval($_POST['idEnsayoLaboratorio']),
                         $_POST['tipoMuestra'],
                         $_POST['ubicacionGeneral'],
                         $_POST['ubicacionEspecifica'],
                         $_POST['profundidad'],
                         $_POST['fechaTomaMuestra'],
                         $_POST['metodoExtraccion'],
                         $_POST['puntoExtraccion'],
                         $_POST['descripcion']);
    // A qui un mensaje desplegable para este control
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}
//******************************* Registro de resultados parciales para un ensayo de laboratorio ***********************
$resultadoEL = false;

if(isset($_POST['grabarResultadoEL']) and $_POST['grabarResultadoEL'] == 'si') {
    if(empty($_POST['proyectoEL'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
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
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}

//******************************* Registro de alcance para un trabajo de campo *****************************************
$alcanceTC = false;

if(isset($_POST['grabarAlcanceTC']) and $_POST['grabarAlcanceTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idTrabajoCampo = intval($_POST['proyectoTC']);

    $alcanceTC = true;
}

if(isset($_POST['grabarRegistroAlcanceTC']) and $_POST['grabarRegistroAlcanceTC'] == 'si') {
    if (empty($_POST['antecedente'])) { 
        $antecedente = 'NINGUNO'; 
    } else {
        $antecedente = $_POST['antecedente']; 
    }
    if (empty($_POST['objetivo'])) {
        $objetivo = 'NINGUNO'; 
    } else {
        $objetivo = $_POST['objetivo']; 
    }
    if (empty($_POST['duracionEstudio'])) {
        $duracionEstudio = 0;
    } else { 
        $duracionEstudio = $_POST['duracionEstudio']; 
    }
    if (empty($_POST['precioEstudio'])) {
        $precioEstudio = 0; 
    } else {
        $precioEstudio = $_POST['precioEstudio']; 
    }
    if (empty($_POST['formaPago'])) {
        $formaPago = 'NINGUNO'; 
    } else {
        $formaPago = $_POST['formaPago']; 
    }
    if (empty($_POST['requerimientoAdicional'])) { 
        $requerimientoAdicional = 'NINGUNO';
    } else {
        $requerimientoAdicional = $_POST['requerimientoAdicional']; 
    }
    if ('Trabajo de campo' == $_POST['trabajoCampo']) {
        $trabajoRealizadoTC = $_POST['trabajoRealizadoTC'];
    } else {
        $trabajoRealizadoTC = 'NINGUNO';
    }
    if ('Trabajo de laboratorio' == $_POST['trabajoLaboratorio']) {
        $trabajoRealizadoTL = $_POST['trabajoRealizadoTL'];
    } else {
        $trabajoRealizadoTL = 'NINGUNO';
    }
    if ('Trabajo de gabinete' == $_POST['trabajoGabinete']) {
        $trabajoRealizadoTG = $_POST['trabajoRealizadoTG'];
    } else {
        $trabajoRealizadoTG = 'NINGUNO';
    }

    $registro = new ServicioRegistroAlcance($alcanceDAO, $trabajoCampoDAO);
    $registro->registrar($_POST['idTrabajoCampo'],
                         $antecedente,
                         $objetivo,
                         $duracionEstudio,
                         $precioEstudio,
                         $formaPago,
                         $requerimientoAdicional,
                         $trabajoRealizadoTC,
                         $trabajoRealizadoTL,
                         $trabajoRealizadoTG);
    
    // A qui un mensaje desplegable para este control
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}
//******************************* Registro de alcance editado **********************************************************
$editarAlcanceTC = false;

if(isset($_POST['grabarEditarAlcanceTC']) and $_POST['grabarEditarAlcanceTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idTrabajoCampo = intval($_POST['proyectoTC']);

    $alcance = new AlcanceModelo();
    $alcance->setTrabajoCampoSolicitudIdSolicitud($idTrabajoCampo);

    $idAlcance = $alcanceDAO->getIdAlcanceDAO($alcance);

    $editarAlcanceTC = true;
}

if(isset($_POST['grabarRegistroEditarAlcanceTC']) and $_POST['grabarRegistroEditarAlcanceTC'] == 'si') {
    if (empty($_POST['antecedente'])) {
        $antecedente = 'NINGUNO';
    } else {
        $antecedente = $_POST['antecedente'];
    }
    if (empty($_POST['objetivo'])) {
        $objetivo = 'NINGUNO';
    } else {
        $objetivo = $_POST['objetivo'];
    }
    if (empty($_POST['duracionEstudio'])) {
        $duracionEstudio = 0;
    } else {
        $duracionEstudio = $_POST['duracionEstudio'];
    }
    if (empty($_POST['precioEstudio'])) {
        $precioEstudio = 0;
    } else {
        $precioEstudio = $_POST['precioEstudio'];
    }
    if (empty($_POST['formaPago'])) {
        $formaPago = 'NINGUNO';
    } else {
        $formaPago = $_POST['formaPago'];
    }
    if (empty($_POST['requerimientoAdicional'])) {
        $requerimientoAdicional = 'NINGUNO';
    } else {
        $requerimientoAdicional = $_POST['requerimientoAdicional'];
    }
    if ('Trabajo de campo' == $_POST['trabajoCampo']) {
        $trabajoRealizadoTC = $_POST['trabajoRealizadoTC'];
    } else {
        $trabajoRealizadoTC = 'NINGUNO';
    }
    if ('Trabajo de laboratorio' == $_POST['trabajoLaboratorio']) {
        $trabajoRealizadoTL = $_POST['trabajoRealizadoTL'];
    } else {
        $trabajoRealizadoTL = 'NINGUNO';
    }
    if ('Trabajo de gabinete' == $_POST['trabajoGabinete']) {
        $trabajoRealizadoTG = $_POST['trabajoRealizadoTG'];
    } else {
        $trabajoRealizadoTG = 'NINGUNO';
    }

    $registro = new ServicioEditarAlcance($alcanceDAO, $trabajoCampoDAO);
    $registro->editar($_POST['idTrabajoCampo'],
                      $_POST['idAlcance'],
                      $antecedente,
                      $objetivo,
                      $duracionEstudio,
                      $precioEstudio,
                      $formaPago,
                      $requerimientoAdicional,
                      $trabajoRealizadoTC,
                      $trabajoRealizadoTL,
                      $trabajoRealizadoTG);

    // A qui un mensaje desplegable para este control
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}

//******************************* Ver alcance en .pdf ******************************************************************
if(isset($_POST['grabarVerAlcanceTC']) and $_POST['grabarVerAlcanceTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
    }
    $idTrabajoCampo = intval($_POST['proyectoTC']);

    $pdf = new ServicioPDFAlcance($alcanceDAO);
    $pdf->crearPDF($idTrabajoCampo);
}

//******************************* Registro de resultados parciale para un trabajo de campo *****************************
$resultadoTC = false;

if(isset($_POST['grabarResultadoTC']) and $_POST['grabarResultadoTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
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
    header('Location: '.Conexion::ruta().'?accion=inicioIngeniero'); exit;
}

require_once ('vista/inicioIngeniero.phtml');
