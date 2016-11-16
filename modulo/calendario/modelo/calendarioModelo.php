<?php

/**
 * Class CalendarioModelo
 */
class CalendarioModelo
{
    /** @var int $idCalendario */
    private $idCalendario;

    /** @var string $fechaFin */
    private $fechaFin;

    /** @var string $fechaInicio */
    private $fechaInicio;

    /** @var int $solicitudDirectorIdDirector */
    private $solicitudDirectorIdDirector;

    /** @var int $solicitudDirectorUsuarioIdUsuario */
    private $solicitudDirectorUsuarioIdUsuario;

    /** @var int $solicitudIdSolicitud */
    private $solicitudIdSolicitud;

    /** @var int $solicitudIngenieroIdIngeniero */
    private $solicitudIngenieroIdIngeniero;

    /** @var int $solicitudIngenieroUsuarioIdUsuario */
    private $solicitudIngenieroUsuarioIdUsuario;

    /**
     * @return int
     */
    public function getIdCalendario()
    {
        return $this->idCalendario;
    }

    /**
     * @param int $idCalendario
     */
    public function setIdCalendario($idCalendario)
    {
        $this->idCalendario = $idCalendario;
    }

    /**
     * @return string
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * @param string $fechaFin
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    /**
     * @return string
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param string $fechaInicio
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return int
     */
    public function getSolicitudDirectorIdDirector()
    {
        return $this->solicitudDirectorIdDirector;
    }

    /**
     * @param int $solicitudDirectorIdDirector
     */
    public function setSolicitudDirectorIdDirector($solicitudDirectorIdDirector)
    {
        $this->solicitudDirectorIdDirector = $solicitudDirectorIdDirector;
    }

    /**
     * @return int
     */
    public function getSolicitudDirectorUsuarioIdUsuario()
    {
        return $this->solicitudDirectorUsuarioIdUsuario;
    }

    /**
     * @param int $solicitudDirectorUsuarioIdUsuario
     */
    public function setSolicitudDirectorUsuarioIdUsuario($solicitudDirectorUsuarioIdUsuario)
    {
        $this->solicitudDirectorUsuarioIdUsuario = $solicitudDirectorUsuarioIdUsuario;
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
     * @return int
     */
    public function getSolicitudIngenieroIdIngeniero()
    {
        return $this->solicitudIngenieroIdIngeniero;
    }

    /**
     * @param int $solicitudIngenieroIdIngeniero
     */
    public function setSolicitudIngenieroIdIngeniero($solicitudIngenieroIdIngeniero)
    {
        $this->solicitudIngenieroIdIngeniero = $solicitudIngenieroIdIngeniero;
    }

    /**
     * @return int
     */
    public function getSolicitudIngenieroUsuarioIdUsuario()
    {
        return $this->solicitudIngenieroUsuarioIdUsuario;
    }

    /**
     * @param int $solicitudIngenieroUsuarioIdUsuario
     */
    public function setSolicitudIngenieroUsuarioIdUsuario($solicitudIngenieroUsuarioIdUsuario)
    {
        $this->solicitudIngenieroUsuarioIdUsuario = $solicitudIngenieroUsuarioIdUsuario;
    }
}
