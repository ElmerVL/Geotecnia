<?php

require_once('modulo/solicitud/modelo/SolicitudModelo.php');
require_once('modulo/solicitudUsuario/modelo/SolicitudUsuarioModelo.php');
require_once('modulo/ensayoLaboratorio/modelo/EnsayoLaboratorioModelo.php');
require_once('modulo/trabajoCampo/modelo/TrabajoCampoModelo.php');
require_once('modulo/registro/ServicioRegistroBitacora.php');

/**
 * Este servicio se encarga de registrar una solicitud.
 */
class ServicioRegistroSolicitud
{
    /** @var solicitudDAO */
    private $solicitudDAO;
    
    /** @var solicitudUsuarioDAO */
    private $solicitudUsuarioDAO;

    /** @var usuarioDAO */
    private $usuarioDAO;

    /** @var ensayoLaboratorioDAO */
    private $ensayoLaboratorioDAO;

    /** @var trabajoCampoDAO */
    private $trabajoCampoDAO;
    
    /** @var BitacoraDAO */
    private $bitacoraDAO;
    
    /**
     * Constructor del servicio registro.
     *
     * @param SolicitudDAO $solicitud
     * @param SolicitudUsuarioDAO $solicitudUsuario
     * @param UsuarioDAO $usuario
     * @param EnsayoLaboratorioDAO $ensayoLaboratorio
     * @param TrabajoCampoDAO $trabajoCampo
     * @param BitacoraDAO $bitacora
     */
    public function __construct(
        SolicitudDAO $solicitud,
        SolicitudUsuarioDAO $solicitudUsuario,
        UsuarioDAO $usuario,
        EnsayoLaboratorioDAO $ensayoLaboratorio,
        TrabajoCampoDAO $trabajoCampo,
        BitacoraDAO $bitacora
    ) {
        $this->solicitudDAO = $solicitud;
        $this->solicitudUsuarioDAO = $solicitudUsuario;
        $this->usuarioDAO = $usuario;
        $this->ensayoLaboratorioDAO = $ensayoLaboratorio;
        $this->trabajoCampoDAO = $trabajoCampo;
        $this->bitacoraDAO = $bitacora;
    }
    
    public function registrar($idUsuario, $nombreProyecto, $ubicacionProyecto, $tipoProyecto, $responsable)
    {
        $idSolicitud = $this->solicitudDAO->getIdSolicitudParaInsertarDAO() + 1;
        $codigo = $this->solicitudDAO->getCodigoSolicitudParaInsertarDAO();
        
        $solicitud = new SolicitudModelo();
        $solicitud->setIdSolicitud($idSolicitud);
        $solicitud->setNombre($nombreProyecto);
        $solicitud->setFecha(date('Y-m-d'));
        $solicitud->setUbicacion($ubicacionProyecto);
        $solicitud->setTipo($tipoProyecto);
        $solicitud->setCodigo($codigo);
        $solicitud->setHabilitado('false');
        $solicitud->setInformeEntregado('false');
        $solicitud->setInformeAprobado('false');
        $solicitud->setResponsable($responsable);
        $solicitud->setCodigoProyecto('N - P');
        $solicitud->setRegistroCliente('false');
        $solicitud->setRegistroPago('false');
        
        $this->solicitudDAO->insertarSolicitudDAO($solicitud);
        
        $solicitudUsuario = new SolicitudUsuarioModelo();
        $solicitudUsuario->setSolicitudIdSolicitud($idSolicitud);
        $solicitudUsuario->setUsuarioIdUsuario($idUsuario);
        
        $this->solicitudUsuarioDAO->insertarSolicitudUsuarioDAO($solicitudUsuario);
        
        if ('Ensayo Laboratorio' == $tipoProyecto) {
            $ensayoLaboratorio = new EnsayoLaboratorioModelo();
            $ensayoLaboratorio->setSolicitudIdSolicitud($idSolicitud);
            $ensayoLaboratorio->setMuestraRegistrada('false');
            $ensayoLaboratorio->setEnsayoRegistrado('false');

            $this->ensayoLaboratorioDAO->insertarEnsayoLaboratorioDAO($ensayoLaboratorio);
        } else {
            $trabajoCampo = new TrabajoCampoModelo();
            $trabajoCampo->setSolicitudIdSolicitud($idSolicitud);
            $trabajoCampo->setAlcanceCreado('false');
            $trabajoCampo->setAlcanceAprobado('false');

            $this->trabajoCampoDAO->insertarTrabajoCampoDAO($trabajoCampo);
        }

        $registroBitacora =  new ServicioRegistroBitacora($this->bitacoraDAO);
        $registroBitacora->registrar($idSolicitud, 'Nueva solicitud');
    }
}
