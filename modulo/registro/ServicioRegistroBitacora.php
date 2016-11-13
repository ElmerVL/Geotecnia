<?php

include_once('modulo/bitacora/modelo/BitacoraModelo.php');

/**
 * Class ServicioRegistroBitacora
 */
class ServicioRegistroBitacora
{
    /** @var bitacoraDAO */
    private $bitacoraDAO;

    /**
     * Constructor del servicio registro.
     *
     * @@param BitacoraDAO $bitacora
     */
    public function __construct(BitacoraDAO $bitacora)
    {
        $this->bitacoraDAO = $bitacora;
    }

    public function registrar($idSolicitud, $actividad)
    {
        $idBitacora = $this->bitacoraDAO->getIdBitacoraParaInsertarDAO() + 1;
        
        $bitacora = new BitacoraModelo();
        $bitacora->setIdBitacora($idBitacora);
        $bitacora->setSolicitudIdSolicitud($idSolicitud);
        $bitacora->setActividad($actividad);
        $fecha = date('Y-m-d').' '.date('H:i:s', strtotime('now')+21600);
        $bitacora->setFechaBitacora($fecha);
        
        $this->bitacoraDAO->insertarBitacoraDAO($bitacora);
    }
}
