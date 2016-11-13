<?php

/**
 * Class PagoModelo
 */
class PagoModelo
{
    /**@var int $idPago */
    private $idPago;

    /**@var int $numeroPago */
    private $numeroPago;

    /** @var int $numeroFactura */
    private $numeroFactura;

    /**@var int $porcentajePago */
    private $porcentajePago;

    /**@var int $montoPago */
    private $montoPago;

    /**
     * @return int
     */
    public function getIdPago()
    {
        return $this->idPago;
    }

    /**
     * @param int $idPago
     */
    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }

    /**
     * @return int
     */
    public function getNumeroPago()
    {
        return $this->numeroPago;
    }

    /**
     * @param int $numeroPago
     */
    public function setNumeroPago($numeroPago)
    {
        $this->numeroPago = $numeroPago;
    }

    /**
     * @return int
     */
    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }

    /**
     * @param int $numeroFactura
     */
    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;
    }

    /**
     * @return int
     */
    public function getPorcentajePago()
    {
        return $this->porcentajePago;
    }

    /**
     * @param int $porcentajePago
     */
    public function setPorcentajePago($porcentajePago)
    {
        $this->porcentajePago = $porcentajePago;
    }

    /**
     * @return int
     */
    public function getMontoPago()
    {
        return $this->montoPago;
    }

    /**
     * @param int $montoPago
     */
    public function setMontoPago($montoPago)
    {
        $this->montoPago = $montoPago;
    }
}
