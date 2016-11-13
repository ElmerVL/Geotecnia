<?php

/**
 * Class BitacoraModelo
 */
class BitacoraModelo
{
    /**@var int idBitacora */
    private $idBitacora;

    /** @var int solicitudIdSolicitud */
    private $solicitudIdSolicitud;

    /**@var string actividad */
    private $actividad;

    /**@var string fechaBitacora */
    private $fechaBitacora;

    /**
     * @return int
     */
    public function getIdBitacora()
    {
        return $this->idBitacora;
    }

    /**
     * @param int $idBitacora
     */
    public function setIdBitacora($idBitacora)
    {
        $this->idBitacora = $idBitacora;
    }

    /**
     * @return int
     */
    public function getSolicitudIdSolicitud()
    {
        return $this->solicitudIdSolicitud;
    }

    /**
     * @param int $solicitudIdSolicitud
     */
    public function setSolicitudIdSolicitud($solicitudIdSolicitud)
    {
        $this->solicitudIdSolicitud = $solicitudIdSolicitud;
    }

    /**
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * @param string $actividad
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
    }

    /**
     * @return string
     */
    public function getFechaBitacora()
    {
        return $this->fechaBitacora;
    }

    /**
     * @param string $fechaBitacora
     */
    public function setFechaBitacora($fechaBitacora)
    {
        $this->fechaBitacora = $fechaBitacora;
    }
}
