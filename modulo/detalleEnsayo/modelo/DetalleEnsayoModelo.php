<?php

/**
 * Class DetalleEnsayoModelo
 */
class DetalleEnsayoModelo
{
    /**@var int $ensayoIdEnsayo */
    private $ensayoIdEnsayo;

    /** @var int $ensayoLaboratorioSolicitudIdSolicitud */
    private $ensayoLaboratorioSolicitudIdSolicitud;

    /**@var int $cantidadEnsayo */
    private $cantidadEnsayo;

    /**@var double $precioTotal */
    private $precioTotal;

    /**@var double $precioUnitario */
    private $precioUnitario;

    /**@var int $tiempoTotal */
    private $tiempoTotal;

    /**@var int $tiempoUnitario */
    private $tiempoUnitario;

    /**
     * @return int
     */
    public function getEnsayoIdEnsayo()
    {
        return $this->ensayoIdEnsayo;
    }

    /**
     * @param int $ensayoIdEnsayo
     */
    public function setEnsayoIdEnsayo($ensayoIdEnsayo)
    {
        $this->ensayoIdEnsayo = $ensayoIdEnsayo;
    }

    /**
     * @return int
     */
    public function getEnsayoLaboratorioSolicitudIdSolicitud()
    {
        return $this->ensayoLaboratorioSolicitudIdSolicitud;
    }

    /**
     * @param int $ensayoLaboratorioSolicitudIdSolicitud
     */
    public function setEnsayoLaboratorioSolicitudIdSolicitud($ensayoLaboratorioSolicitudIdSolicitud)
    {
        $this->ensayoLaboratorioSolicitudIdSolicitud = $ensayoLaboratorioSolicitudIdSolicitud;
    }

    /**
     * @return int
     */
    public function getCantidadEnsayo()
    {
        return $this->cantidadEnsayo;
    }

    /**
     * @param int $cantidadEnsayo
     */
    public function setCantidadEnsayo($cantidadEnsayo)
    {
        $this->cantidadEnsayo = $cantidadEnsayo;
    }

    /**
     * @return float
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * @param float $precioTotal
     */
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    }

    /**
     * @return float
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * @param float $precioUnitario
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    }

    /**
     * @return int
     */
    public function getTiempoTotal()
    {
        return $this->tiempoTotal;
    }

    /**
     * @param int $tiempoTotal
     */
    public function setTiempoTotal($tiempoTotal)
    {
        $this->tiempoTotal = $tiempoTotal;
    }

    /**
     * @return int
     */
    public function getTiempoUnitario()
    {
        return $this->tiempoUnitario;
    }

    /**
     * @param int $tiempoUnitario
     */
    public function setTiempoUnitario($tiempoUnitario)
    {
        $this->tiempoUnitario = $tiempoUnitario;
    }
}
