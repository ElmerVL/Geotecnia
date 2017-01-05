<?php

require_once('modulo/cliente/modelo/ClienteModelo.php');
require_once('modulo/formularioEL/modelo/FormularioELModelo.php');
require_once('modulo/formularioTC/modelo/FormularioTCModelo.php');
require_once('modulo/detalleEnsayo/dao/DetalleEnsayoDAO.php');
require_once('modulo/pdf/cuantias/PdfCuantiasServicio.php');

/**
 * Class ServicioRegistroClienteEL
 */
class ServicioRegistroCliente
{
    /**
     * @var clienteDAO
     */
    private $clienteDAO;

    /**
     * @var formularioELDAO
     */
    private $formularioELDAO;

    /**
     * @var formularioTCDAO
     */
    private $formularioTCDAO;

    /**
     * @var solicitudDAO
     */
    private $solicitudDAO;

    /**
     * ServicioRegistroClienteEL constructor.
     * @param ClienteDAO $cliente
     * @param FormularioELDAO $formularioEL
     * @param FormularioTCDAO $formularioTC
     * @param SolicitudDAO $solicitud
     */
    public function __construct(
        ClienteDAO $cliente,
        FormularioELDAO $formularioEL,
        FormularioTCDAO $formularioTC,
        SolicitudDAO $solicitud
    ) {
        $this->clienteDAO = $cliente;
        $this->formularioELDAO = $formularioEL;
        $this->formularioTCDAO = $formularioTC;
        $this->solicitudDAO = $solicitud;
    }

    /**
     * @param int $idSolicitud
     * @param string $nombreFactura
     * @param string $tipoCliente
     * @param string $nombreFactura
     * @param int $nitCI
     * @param string $nombreContacto
     * @param int $ciContacto
     * @param int $telefonoFijo
     * @param int $telefonoCelular
     * @param string $correo
     * @param string $direccionFiscal
     */
    public function registrar(
        $idSolicitud,
        $nombreFactura,
        $tipoCliente,
        $nombreFactura,
        $nitCI,
        $nombreContacto,
        $ciContacto,
        $telefonoFijo,
        $telefonoCelular,
        $correo,
        $direccionFiscal
    ) {
        $idCliente = $this->clienteDAO->getIdClienteParaInsertarDAO() + 1;
        
        $cliente = new ClienteModelo();
        $cliente->setIdCliente($idCliente);
        $cliente->setCiContacto($ciContacto);
        $cliente->setCorreo($correo);
        $cliente->setDireccionFiscal($direccionFiscal);
        $cliente->setNitCi($nitCI);
        $cliente->setNombreContacto($nombreContacto);
        $cliente->setNombreFactura($nombreFactura);
        $cliente->setTelefonoCelular($telefonoCelular);
        $cliente->setTelefonoFijo($telefonoFijo);
        $cliente->setTipoCliente($tipoCliente);
        
        $this->clienteDAO->insertarClienteDAO($cliente);

        $solicitud =  new SolicitudModelo();
        $solicitud->setIdSolicitud($idSolicitud);
        $solicitud->setRegistroCliente('true');
        
        $this->solicitudDAO->setRegistroClienteSolicitudDAO($solicitud);

        $tipoSolicitud = $this->solicitudDAO->getTipoSolicitudDAO($solicitud);

        if ('Ensayo de laboratorio' === $tipoSolicitud) {
            $intTipoProyecto = 1;
            $formularioEL = new FormularioELModelo();
            $formularioEL->setClienteIdCliente($idCliente);
            $formularioEL->setEnsayoLaboratorioSolicitudIdSolicitud($idSolicitud);
            $formularioEL->setFormularioRegistrado('false');

            $this->formularioELDAO->insertarFormularioELDAO($formularioEL);
        } else {
            $intTipoProyecto = 2;
            $formularioTC = new FormularioTCModelo();
            $formularioTC->setClienteIdCliente($idCliente);
            $formularioTC->setTrabajoCampoSolicitudIdSolicitud($idSolicitud);
            $formularioTC->setFormularioRegistrado('false');

            $this->formularioTCDAO->insertarFormularioTCDAO($formularioTC);
        }

        $cuantias = new PdfCuantiasServicio();
        $cuantias->imprimir_formulario($idSolicitud, $intTipoProyecto, $idCliente);
    }
}
