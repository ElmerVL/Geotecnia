<?php

/**
 * Class EnsayoLaboratorioModelo
 */
class EnsayoLaboratorioModelo
{
    /**@var int $solicitudIdSolicitud */
    private $solicitudIdSolicitud;

    /**@var string $muestraRegistrada */
    private $muestraRegistrada;

    /** @var string $ensayoRegistrado */
    private $ensayoRegistrado;

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
    public function getMuestraRegistrada()
    {
        return $this->muestraRegistrada;
    }

    /**
     * @param string $muestraRegistrada
     */
    public function setMuestraRegistrada($muestraRegistrada)
    {
        $this->muestraRegistrada = $muestraRegistrada;
    }

    /**
     * @return string
     */
    public function getEnsayoRegistrado()
    {
        return $this->ensayoRegistrado;
    }

    /**
     * @param string $ensayoRegistrado
     */
    public function setEnsayoRegistrado($ensayoRegistrado)
    {
        $this->ensayoRegistrado = $ensayoRegistrado;
    }
}
