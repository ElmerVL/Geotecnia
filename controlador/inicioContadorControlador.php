<?php

require_once ('modulo/ensayoLaboratorio/dao/EnsayoLaboratorioDAO.php');
require_once ('modulo/trabajoCampo/dao/TrabajoCampoDAO.php');
require_once ('modulo/solicitud/dao/SolicitudDAO.php');
require_once ('modulo/solicitudUsuario/dao/SolicitudUsuarioDAO.php');
require_once ('modulo/usuario/dao/UsuarioDAO.php');
require_once ('modulo/ingeniero/dao/IngenieroDAO.php');
require_once ('modulo/registro/ServicioRegistroSolicitud.php');
require_once ('modulo/registro/ServicioRegistroCliente.php');
require_once ('modulo/registro/ServicioRegistroPago.php');
require_once ('modulo/cliente/dao/ClienteDAO.php');
require_once ('modulo/formularioEL/dao/FormularioELDAO.php');
require_once ('modulo/formularioEL/dao/FormularioELDAO.php');
require_once ('modulo/formularioTC/dao/FormularioTCDAO.php');
require_once ('modulo/solicitudPago/dao/SolicitudPagoDAO.php');
require_once ('modulo/pago/dao/PagoDAO.php');
require_once ('modulo/bitacora/dao/BitacoraDAO.php');
require_once ('modulo/muestra/dao/MuestraDAO.php');
require_once ('modulo/alcance/dao/AlcanceDAO.php');

require_once ('modulo/alcance/modelo/AlcanceModelo.php');
require_once ('modulo/muestra/modelo/MuestraModelo.php');
require_once ('modulo/ensayoLaboratorio/modelo/EnsayoLaboratorioModelo.php');
require_once ('modulo/trabajoCampo/modelo/TrabajoCampoModelo.php');
require_once ('modulo/solicitud/modelo/SolicitudModelo.php');
require_once ('modulo/formularioEL/modelo/FormularioELModelo.php');
require_once ('modulo/formularioTC/modelo/FormularioTCModelo.php');

$bitacoraDAO = new BitacoraDAO();
$listaBitacoraUltimasDiez = $bitacoraDAO->getBitacoraUltimasDiez();

$ensayoLaboratorioDAO =  new EnsayoLaboratorioDAO();
$listaProyectoELSinCliente = $ensayoLaboratorioDAO->getEnsayoLaboratorioSinClienteRegistradoDAO();
$listaSeguimientoEL = $ensayoLaboratorioDAO->getSeguimientoEnsayoLaboratorioDAO();
$listaProyectoEL = $ensayoLaboratorioDAO->getEnsayoLaboratorioDAO();

$trabajoCampoDAO =  new TrabajoCampoDAO();
$listaProyectoTCSinCliente = $trabajoCampoDAO->getTrabajoCampoSinClienteRegistradoDAO();
$listaSeguimientoTC = $trabajoCampoDAO->getSeguimientoTrabajoCampoDAO();
$listaProyectoTC = $trabajoCampoDAO->getTrabajoCampoDAO();

$solicitudDAO = new SolicitudDAO();
$listaSolicitud = $solicitudDAO->getSolicitudSinHabilitarDAO();
$listaProyectoConClientePago = $solicitudDAO->getSolicitudConClientePagoRegistradoDAO();
$listaProyectoELSinPago = $solicitudDAO->getSolicitudTipoELSinPagoRegistradoDAO();
$listaProyectoTCSinPago = $solicitudDAO->getSolicitudTipoTCSinPagoRegistradoDAO();

$ingenieroDAO = new IngenieroDAO();
$listaIngeniero = $ingenieroDAO->getIngenieroDAO();

$formularioELDAO = new FormularioELDAO();

$formularioTCDAO = new FormularioTCDAO();

//******************************* Registro de una solicitud ************************************************************
if(isset($_POST['grabarS']) and $_POST['grabarS'] == 'si') {
    if(empty($_POST['nombreP']) or empty($_POST['ubicacionP'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }
    $solicitudUsuarioDAO = new SolicitudUsuarioDAO();
    $usuarioDAO = new UsuarioDAO();
    
    $registro = new ServicioRegistroSolicitud($solicitudDAO, $solicitudUsuarioDAO, $usuarioDAO, $ensayoLaboratorioDAO, $trabajoCampoDAO, $bitacoraDAO);
    $registro->registrar($_SESSION['idUsuario'], $_POST['nombreP'], $_POST['ubicacionP'], $_POST['proyecto'], $_POST['responsable']);
    
    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}
//******************************* Registro de un cliente para un proyecto EL *******************************************
$formularioRegistroClienteEL = false;

if(isset($_POST['grabarEL']) and $_POST['grabarEL'] == 'si') {
    if(empty($_POST['proyectoEL'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }
    $ensayoLaboratorio = new EnsayoLaboratorioModelo();
    $idEnsayoSolicitud = intval($_POST['proyectoEL']);
    $ensayoLaboratorio->setSolicitudIdSolicitud($idEnsayoSolicitud);

    $nombreProyectoEL = $ensayoLaboratorioDAO->getNombreProyectoDAO($ensayoLaboratorio);
    $fechaProyectoEL = $ensayoLaboratorioDAO->getFechaProyectoDAO($ensayoLaboratorio);

    $formularioRegistroClienteEL = true;
}

if(isset($_POST['grabarRCEL']) and $_POST['grabarRCEL'] == 'si') {
    if(empty($_POST['nombreFactura']) or empty($_POST['nitCI']) or empty($_POST['nombreContacto'])
        or empty($_POST['ciContacto']) or empty($_POST['telefonoFijo']) or empty($_POST['telefonoCelular'])
        or empty($_POST['correo']) or empty($_POST['direccionFiscal'])) {
        // A qui un mensaje desplegable para este control
        $formularioRegistroClienteEL = true;
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }

    $clienteDAO = new ClienteDAO();

    $registro = new ServicioRegistroCliente($clienteDAO, $formularioELDAO, $formularioTCDAO, $solicitudDAO);
    $registro->registrar(intval($_POST['idEnsayoLaboratorio']),
        $_POST['nombreFactura'],
        $_POST['tipoCliente'],
        $_POST['nombreFactura'],
        $_POST['nitCI'],
        $_POST['nombreContacto'],
        $_POST['ciContacto'],
        $_POST['telefonoFijo'],
        $_POST['telefonoCelular'],
        $_POST['correo'],
        $_POST['direccionFiscal']);
    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}
//******************************* Registro de un cliente para un proyecto TC *******************************************
$formularioRegistroClienteEG = false;

if(isset($_POST['grabarTC']) and $_POST['grabarTC'] == 'si') {
    if(empty($_POST['proyectoTC'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }
    $trabajoCampo = new TrabajoCampoModelo();
    $idTrabajoCampo = intval($_POST['proyectoTC']);
    $trabajoCampo->setSolicitudIdSolicitud($idTrabajoCampo);

    $nombreProyectoTC = $trabajoCampoDAO->getNombreProyectoDAO($trabajoCampo);
    $fechaProyectoTC = $trabajoCampoDAO->getFechaProyectoDAO($trabajoCampo);

    $formularioRegistroClienteEG = true;
}

if(isset($_POST['grabarRCTC']) and $_POST['grabarRCTC'] == 'si') {
    if(empty($_POST['nombreFactura']) or empty($_POST['nitCI']) or empty($_POST['nombreContacto'])
        or empty($_POST['ciContacto']) or empty($_POST['telefonoFijo']) or empty($_POST['telefonoCelular'])
        or empty($_POST['correo']) or empty($_POST['direccionFiscal'])) {
        // A qui un mensaje desplegable para este control
        $formularioRegistroClienteEG = true;
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }

    $clienteDAO = new ClienteDAO();

    $registro = new ServicioRegistroCliente($clienteDAO, $formularioELDAO, $formularioTCDAO, $solicitudDAO);
    $registro->registrar(intval($_POST['idEnsayoLaboratorio']),
                         $_POST['nombreFactura'],
                         $_POST['tipoCliente'],
                         $_POST['nombreFactura'],
                         $_POST['nitCI'],
                         $_POST['nombreContacto'],
                         $_POST['ciContacto'],
                         $_POST['telefonoFijo'],
                         $_POST['telefonoCelular'],
                         $_POST['correo'],
                         $_POST['direccionFiscal']);
    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}
//******************************* Registro de pago de un proyecto (EL o TC)*********************************************
$formularioRegistroPago = false;

if(isset($_POST['grabarPagoTodoProyecto']) and $_POST['grabarPagoTodoProyecto'] == 'si') {
    if(empty($_POST['proyectoT'])) {
        // A qui un mensaje desplegable para este control
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }
    $solicitud = new SolicitudModelo();
    $idSolicitud = intval($_POST['proyectoT']);
    $solicitud->setIdSolicitud($idSolicitud);
    
    $tipoSolicitud = $solicitudDAO->getTipoSolicitudDAO($solicitud);

    if ('Ensayo de laboratorio' == $tipoSolicitud) {
        $formularioEL = new FormularioELModelo();
        $formularioEL->setEnsayoLaboratorioSolicitudIdSolicitud($idSolicitud);
        
        $listaDetalleFormulario = $formularioELDAO->getDetalleFormularioELDAO($formularioEL);
    } else {
        $formularioTC = new FormularioTCModelo();
        $formularioTC->setTrabajoCampoSolicitudIdSolicitud($idSolicitud);

        $listaDetalleFormulario = $formularioTCDAO->getDetalleFormularioTCDAO($formularioTC);
    }

    $formularioRegistroPago = true;
}

if(isset($_POST['grabarRegistroPago']) and $_POST['grabarRegistroPago'] == 'si') {
    $solicitudPagoDAO = new SolicitudPagoDAO();
    $pagoDAO = new PagoDAO();
    
    $registro = new ServicioRegistroPago($solicitudPagoDAO, $pagoDAO, $bitacoraDAO);
    $registro->registrar($_POST['idSolicitud'],
                         $_POST['precioTotal'],
                         $_POST['numeroAnticipo100'],
                         $_POST['facturaAnticipo100'],
                         $_POST['numeroAnticipo50'],
                         $_POST['numeroFactura50'],
                         $_POST['numeroSaldo50'],
                         $_POST['facturaSaldo50'],
                         $_POST['numeroAnticipo20'],
                         $_POST['numeroFactura20'],
                         $_POST['numeroSaldo80'],
                         $_POST['facturaSaldo20']);

    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}

//******************************* Ver Informacion completa de proyectos ************************************************
$informacionCompletaProyectoEL = false;
$informacionCompletaProyectoTC = false;

if(isset($_POST['grabarVerInformacionProyecto']) and $_POST['grabarVerInformacionProyecto'] == 'si') {

    $solicitud = new SolicitudModelo();
    $idSolicitud = intval($_POST['idSolicitud']);

    $solicitud->setIdSolicitud($idSolicitud);

    $tipoSolicitud = $solicitudDAO->getTipoSolicitudDAO($solicitud);

    if ("Ensayo de laboratorio" == $tipoSolicitud) {
        $proyectoEL = $solicitudDAO->getEnsayoLaboratorioDAO($solicitud);

        $ensayoLaboratorio = new EnsayoLaboratorioModelo();
        $ensayoLaboratorio->setSolicitudIdSolicitud($idSolicitud);

        $listEnsayosRegistrados =  $ensayoLaboratorioDAO->getTodoEnsayoRegistradoDAO($ensayoLaboratorio);

        $muestra = new MuestraModelo();
        $muestra->setEnsayoLaboratorioSolicitudIdSolicitud($idSolicitud);

        $muestraDAO = new MuestraDAO();
        $muestraRegistrada =$muestraDAO->getMuestraDAO($muestra);

        $informacionCompletaProyectoEL = true;
    } else {
        $proyectoTC = $solicitudDAO->getTrabajoCampoDAO($solicitud);

        $trabajoCampo = new TrabajoCampoModelo();
        $trabajoCampo->setSolicitudIdSolicitud($idSolicitud);

        $alcance = new AlcanceModelo();
        $alcance->setTrabajoCampoSolicitudIdSolicitud($idSolicitud);

        $alcanceDAO = new AlcanceDAO();
        $alcanceRegistrado =$alcanceDAO->getAlcanceDAO($alcance);

        $informacionCompletaProyectoTC = true;
    }
}
//******************************* Registro de un cliente para un proyecto EL *******************************************
if(isset($_POST['grabarFormRegistroClienteEL']) and $_POST['grabarFormRegistroClienteEL'] == 'si') {
    if(empty($_POST['nombreFactura']) or empty($_POST['nitCI']) or empty($_POST['nombreContacto'])
        or empty($_POST['ciContacto']) or empty($_POST['telefonoFijo']) or empty($_POST['telefonoCelular'])
        or empty($_POST['correo']) or empty($_POST['direccionFiscal'])) {
        // A qui un mensaje desplegable para este control
        $formularioRegistroClienteEL = true;
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }

    $clienteDAO = new ClienteDAO();

    $registro = new ServicioRegistroCliente($clienteDAO, $formularioELDAO, $formularioTCDAO, $solicitudDAO);
    $registro->registrar(intval($_POST['idEnsayoLaboratorio']),
        $_POST['nombreFactura'],
        $_POST['tipoCliente'],
        $_POST['nombreFactura'],
        $_POST['nitCI'],
        $_POST['nombreContacto'],
        $_POST['ciContacto'],
        $_POST['telefonoFijo'],
        $_POST['telefonoCelular'],
        $_POST['correo'],
        $_POST['direccionFiscal']);
    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}
//******************************* Registro de un cliente para un proyecto TC *******************************************
if(isset($_POST['grabarFormRegistroClienteTC']) and $_POST['grabarFormRegistroClienteTC'] == 'si') {
    if(empty($_POST['nombreFactura']) or empty($_POST['nitCI']) or empty($_POST['nombreContacto'])
        or empty($_POST['ciContacto']) or empty($_POST['telefonoFijo']) or empty($_POST['telefonoCelular'])
        or empty($_POST['correo']) or empty($_POST['direccionFiscal'])) {
        // A qui un mensaje desplegable para este control
        $formularioRegistroClienteEG = true;
        header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
    }

    $clienteDAO = new ClienteDAO();

    $registro = new ServicioRegistroCliente($clienteDAO, $formularioELDAO, $formularioTCDAO, $solicitudDAO);
    $registro->registrar(intval($_POST['idTrabajoCampo']),
        $_POST['nombreFactura'],
        $_POST['tipoCliente'],
        $_POST['nombreFactura'],
        $_POST['nitCI'],
        $_POST['nombreContacto'],
        $_POST['ciContacto'],
        $_POST['telefonoFijo'],
        $_POST['telefonoCelular'],
        $_POST['correo'],
        $_POST['direccionFiscal']);
    // A qui un mensaje desplegable para confirmar registro exit;
    header('Location: '.Conexion::ruta().'?accion=inicioContador'); exit;
}

require_once ('vista/inicioContador.phtml');
