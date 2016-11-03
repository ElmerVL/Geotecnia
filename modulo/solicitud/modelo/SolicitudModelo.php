<?php

/**
 * Class SolicitudModelo
 */
class SolicitudModelo
{
    /**
     * @var int $idSolicitud
     */
    private $idSolicitud;

    /**
     * @var string $nombre
     */
    private $nombre;

    /**
     * @var string $fecha
     */
    private $fecha;

    /**
     * @var string $ubicacion
     */
    private $ubicacion;

    /**
     * @var string $tipo
     */
    private $tipo;

    /**
     * @var string $codigo
     */
    private $codigo;

    /**
     * @var string $habilitado
     */
    private $habilitado;

    /**
     * @var $informeEntregado;
     */
    private $informeEntregado;

    /**
     * @var string $informeAprobado
     */
    private $informeAprobado;

    /**
     * @var string $codigoProyecto
     */
    private $codigoProyecto;

    /**
     * @var string $responsable
     */
    private $responsable;

    /**
     * @var string $registroCliente
     */
    private $registroCliente;

    /**
     * @var string $registroPago
     */
    private $registroPago;

    /**
     * @return int
     */
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    /**
     * @param int $idSolicitud
     */
    public function setIdSolicitud($idSolicitud)
    {
        $this->idSolicitud = $idSolicitud;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * @param string $ubicacion
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * @param string $habilitado
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;
    }

    /**
     * @return mixed
     */
    public function getInformeEntregado()
    {
        return $this->informeEntregado;
    }

    /**
     * @param mixed $informeEntregado
     */
    public function setInformeEntregado($informeEntregado)
    {
        $this->informeEntregado = $informeEntregado;
    }

    /**
     * @return string
     */
    public function getInformeAprobado()
    {
        return $this->informeAprobado;
    }

    /**
     * @param string $informeAprobado
     */
    public function setInformeAprobado($informeAprobado)
    {
        $this->informeAprobado = $informeAprobado;
    }

    /**
     * @return string
     */
    public function getCodigoProyecto()
    {
        return $this->codigoProyecto;
    }

    /**
     * @param string $codigoProyecto
     */
    public function setCodigoProyecto($codigoProyecto)
    {
        $this->codigoProyecto = $codigoProyecto;
    }

    /**
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param string $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }

    /**
     * @return string
     */
    public function getRegistroCliente()
    {
        return $this->registroCliente;
    }

    /**
     * @param string $registroCliente
     */
    public function setRegistroCliente($registroCliente)
    {
        $this->registroCliente = $registroCliente;
    }

    /**
     * @return string
     */
    public function getRegistroPago()
    {
        return $this->registroPago;
    }

    /**
     * @param string $registroPago
     */
    public function setRegistroPago($registroPago)
    {
        $this->registroPago = $registroPago;
    }
}