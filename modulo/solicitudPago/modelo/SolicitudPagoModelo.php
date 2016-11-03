<?php


/**
 * Class SolicitudPagoModelo
 */
class SolicitudPagoModelo
{
    /**@var int $pagoIdPago */
    private $pagoIdPago;

    /**@var int $solicitudIdSolicitud */
    private $solicitudIdSolicitud;

    /**@var int $porcentajeAnticipo */
    private $porcentajeAnticipo;

    /**@var string $anticipoPagado */
    private $anticipoPagado;

    /**@var int $porcentajeSaldo */
    private $porcentajeSaldo;

    /**@var string $saldoPagado */
    private $saldoPagado;

    /**
     * @return int
     */
    public function getPagoIdPago()
    {
        return $this->pagoIdPago;
    }

    /**
     * @param int $pagoIdPago
     */
    public function setPagoIdPago($pagoIdPago)
    {
        $this->pagoIdPago = $pagoIdPago;
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
    public function getPorcentajeAnticipo()
    {
        return $this->porcentajeAnticipo;
    }

    /**
     * @param int $porcentajeAnticipo
     */
    public function setPorcentajeAnticipo($porcentajeAnticipo)
    {
        $this->porcentajeAnticipo = $porcentajeAnticipo;
    }

    /**
     * @return string
     */
    public function getAnticipoPagado()
    {
        return $this->anticipoPagado;
    }

    /**
     * @param string $anticipoPagado
     */
    public function setAnticipoPagado($anticipoPagado)
    {
        $this->anticipoPagado = $anticipoPagado;
    }

    /**
     * @return int
     */
    public function getPorcentajeSaldo()
    {
        return $this->porcentajeSaldo;
    }

    /**
     * @param int $porcentajeSaldo
     */
    public function setPorcentajeSaldo($porcentajeSaldo)
    {
        $this->porcentajeSaldo = $porcentajeSaldo;
    }

    /**
     * @return string
     */
    public function getSaldoPagado()
    {
        return $this->saldoPagado;
    }

    /**
     * @param string $saldoPagado
     */
    public function setSaldoPagado($saldoPagado)
    {
        $this->saldoPagado = $saldoPagado;
    }
}