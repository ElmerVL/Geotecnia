<?php

/**
 * Class ClienteModelo
 */
class ClienteModelo
{
    /**@var int $ciContacto */
    private $ciContacto;

    /**@var string $correo */
    private $correo;

    /** @var string $direccionFiscal */
    private $direccionFiscal;

    /**@var int $idCliente */
    private $idCliente;

    /**@var int $nitCi */
    private $nitCi;

    /**@var string $nombreContacto */
    private $nombreContacto;

    /**@var string $nombreFactura */
    private $nombreFactura;

    /**@var int $telefonoCelular */
    private $telefonoCelular;

    /**@var int $telefonoFijo */
    private $telefonoFijo;

    /**@var string $tipoCliente */
    private $tipoCliente;

    /**
     * @return int
     */
    public function getCiContacto()
    {
        return $this->ciContacto;
    }

    /**
     * @param int $ciContacto
     */
    public function setCiContacto($ciContacto)
    {
        $this->ciContacto = $ciContacto;
    }

    /**
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return string
     */
    public function getDireccionFiscal()
    {
        return $this->direccionFiscal;
    }

    /**
     * @param string $direccionFiscal
     */
    public function setDireccionFiscal($direccionFiscal)
    {
        $this->direccionFiscal = $direccionFiscal;
    }

    /**
     * @return int
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param int $idCliente
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return int
     */
    public function getNitCi()
    {
        return $this->nitCi;
    }

    /**
     * @param int $nitCi
     */
    public function setNitCi($nitCi)
    {
        $this->nitCi = $nitCi;
    }

    /**
     * @return string
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }

    /**
     * @param string $nombreContacto
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;
    }

    /**
     * @return string
     */
    public function getNombreFactura()
    {
        return $this->nombreFactura;
    }

    /**
     * @param string $nombreFactura
     */
    public function setNombreFactura($nombreFactura)
    {
        $this->nombreFactura = $nombreFactura;
    }

    /**
     * @return int
     */
    public function getTelefonoCelular()
    {
        return $this->telefonoCelular;
    }

    /**
     * @param int $telefonoCelular
     */
    public function setTelefonoCelular($telefonoCelular)
    {
        $this->telefonoCelular = $telefonoCelular;
    }

    /**
     * @return int
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * @param int $telefonoFijo
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;
    }

    /**
     * @return string
     */
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }

    /**
     * @param string $tipoCliente
     */
    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;
    }
}
