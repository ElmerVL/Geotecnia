<?php

/**
 * Class TrabajoCampoModelo
 */
class TrabajoCampoModelo
{
    /**@var int $solicitudIdSolicitud */
    private $solicitudIdSolicitud;

    /**@var string $alcanceCreado */
    private $alcanceCreado;

    /** @var string $alcanceAprobado */
    private $alcanceAprobado;

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
    public function getAlcanceCreado()
    {
        return $this->alcanceCreado;
    }

    /**
     * @param string $alcanceCreado
     */
    public function setAlcanceCreado($alcanceCreado)
    {
        $this->alcanceCreado = $alcanceCreado;
    }

    /**
     * @return string
     */
    public function getAlcanceAprobado()
    {
        return $this->alcanceAprobado;
    }

    /**
     * @param string $alcanceAprobado
     */
    public function setAlcanceAprobado($alcanceAprobado)
    {
        $this->alcanceAprobado = $alcanceAprobado;
    }
}
