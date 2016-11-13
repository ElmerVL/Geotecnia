<?php

/**
 * Class SolicitudUsuarioModelo
 */
class SolicitudUsuarioModelo
{
    /**
     * @var int $solicitudIdSolicitud
     */
    private $solicitudIdSolicitud;

    /**
     * @var int $usuarioIdUsuario
     */
    private $usuarioIdUsuario;

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
    public function getUsuarioIdUsuario()
    {
        return $this->usuarioIdUsuario;
    }

    /**
     * @param int $usuarioIdUsuario
     */
    public function setUsuarioIdUsuario($usuarioIdUsuario)
    {
        $this->usuarioIdUsuario = $usuarioIdUsuario;
    }
}
