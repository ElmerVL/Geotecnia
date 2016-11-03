<?php

/**
 * Class AlcanceModelo
 */
class AlcanceModelo
{
    /**@var int $idAlcance */
    private $idAlcance;

    /**@var int $trabajoCampoSolicitudIdSolicitud */
    private $trabajoCampoSolicitudIdSolicitud;

    /** @var string $antecedente */
    private $antecedente;

    /**@var string $objetivo */
    private $objetivo;

    /**@var string $trabajoCampo */
    private $trabajoCampo;

    /**@var string $trabajoGabinete */
    private $trabajoGabinete;

    /**@var string $trabajoLaboratorio */
    private $trabajoLaboratorio;

    /**@var int $duracion */
    private $duracion;

    /**@var double $precio */
    private $precio;

    /**@var string $forma_pago */
    private $forma_pago;

    /**@var string $requerimiento_adicional */
    private $requerimiento_adicional;

    /**@var $observacion */
    private $observacion;

    /**@var $conObservacion */
    private $conObservacion;

    /**
     * @return int
     */
    public function getIdAlcance()
    {
        return $this->idAlcance;
    }

    /**
     * @param int $idAlcance
     */
    public function setIdAlcance($idAlcance)
    {
        $this->idAlcance = $idAlcance;
    }

    /**
     * @return int
     */
    public function getTrabajoCampoSolicitudIdSolicitud()
    {
        return $this->trabajoCampoSolicitudIdSolicitud;
    }

    /**
     * @param int $trabajoCampoSolicitudIdSolicitud
     */
    public function setTrabajoCampoSolicitudIdSolicitud($trabajoCampoSolicitudIdSolicitud)
    {
        $this->trabajoCampoSolicitudIdSolicitud = $trabajoCampoSolicitudIdSolicitud;
    }

    /**
     * @return string
     */
    public function getAntecedente()
    {
        return $this->antecedente;
    }

    /**
     * @param string $antecedente
     */
    public function setAntecedente($antecedente)
    {
        $this->antecedente = $antecedente;
    }

    /**
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * @param string $objetivo
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }

    /**
     * @return string
     */
    public function getTrabajoCampo()
    {
        return $this->trabajoCampo;
    }

    /**
     * @param string $trabajoCampo
     */
    public function setTrabajoCampo($trabajoCampo)
    {
        $this->trabajoCampo = $trabajoCampo;
    }

    /**
     * @return string
     */
    public function getTrabajoGabinete()
    {
        return $this->trabajoGabinete;
    }

    /**
     * @param string $trabajoGabinete
     */
    public function setTrabajoGabinete($trabajoGabinete)
    {
        $this->trabajoGabinete = $trabajoGabinete;
    }

    /**
     * @return string
     */
    public function getTrabajoLaboratorio()
    {
        return $this->trabajoLaboratorio;
    }

    /**
     * @param string $trabajoLaboratorio
     */
    public function setTrabajoLaboratorio($trabajoLaboratorio)
    {
        $this->trabajoLaboratorio = $trabajoLaboratorio;
    }

    /**
     * @return int
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @param int $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getFormaPago()
    {
        return $this->forma_pago;
    }

    /**
     * @param string $forma_pago
     */
    public function setFormaPago($forma_pago)
    {
        $this->forma_pago = $forma_pago;
    }

    /**
     * @return string
     */
    public function getRequerimientoAdicional()
    {
        return $this->requerimiento_adicional;
    }

    /**
     * @param string $requerimiento_adicional
     */
    public function setRequerimientoAdicional($requerimiento_adicional)
    {
        $this->requerimiento_adicional = $requerimiento_adicional;
    }

    /**
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * @param mixed $observacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    }

    /**
     * @return mixed
     */
    public function getConObservacion()
    {
        return $this->conObservacion;
    }

    /**
     * @param mixed $conObservacion
     */
    public function setConObservacion($conObservacion)
    {
        $this->conObservacion = $conObservacion;
    }
}