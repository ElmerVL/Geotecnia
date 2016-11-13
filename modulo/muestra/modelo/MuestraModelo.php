<?php

/**
 * Class MuestraModelo
 */
class MuestraModelo
{
    /**@var int $idMuestra */
    private $idMuestra;

    /**@var int $ensayoLaboratorioSolicitudIdSolicitud */
    private $ensayoLaboratorioSolicitudIdSolicitud;

    /**@var string $ubicacionGeneral */
    private $ubicacionGeneral;

    /**@var string $ubicacionEspecifica */
    private $ubicacionEspecifica;

    /**@var double $profundidad */
    private $profundidad;

    /**@var string $fechaTomaMuestra */
    private $fechaTomaMuestra;

    /**@var string $metodoExtraccion */
    private $metodoExtraccion;

    /**@var int $punto */
    private $punto;

    /**@var string $tipo */
    private $tipo;

    /**@var string $descripcion */
    private $descripcion;

    /**@var string $codigo */
    private $codigo;

    /**
     * @return int
     */
    public function getIdMuestra()
    {
        return $this->idMuestra;
    }

    /**
     * @param int $idMuestra
     */
    public function setIdMuestra($idMuestra)
    {
        $this->idMuestra = $idMuestra;
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
     * @return string
     */
    public function getUbicacionGeneral()
    {
        return $this->ubicacionGeneral;
    }

    /**
     * @param string $ubicacionGeneral
     */
    public function setUbicacionGeneral($ubicacionGeneral)
    {
        $this->ubicacionGeneral = $ubicacionGeneral;
    }

    /**
     * @return string
     */
    public function getUbicacionEspecifica()
    {
        return $this->ubicacionEspecifica;
    }

    /**
     * @param string $ubicacionEspecifica
     */
    public function setUbicacionEspecifica($ubicacionEspecifica)
    {
        $this->ubicacionEspecifica = $ubicacionEspecifica;
    }

    /**
     * @return float
     */
    public function getProfundidad()
    {
        return $this->profundidad;
    }

    /**
     * @param float $profundidad
     */
    public function setProfundidad($profundidad)
    {
        $this->profundidad = $profundidad;
    }

    /**
     * @return string
     */
    public function getFechaTomaMuestra()
    {
        return $this->fechaTomaMuestra;
    }

    /**
     * @param string $fechaTomaMuestra
     */
    public function setFechaTomaMuestra($fechaTomaMuestra)
    {
        $this->fechaTomaMuestra = $fechaTomaMuestra;
    }

    /**
     * @return string
     */
    public function getMetodoExtraccion()
    {
        return $this->metodoExtraccion;
    }

    /**
     * @param string $metodoExtraccion
     */
    public function setMetodoExtraccion($metodoExtraccion)
    {
        $this->metodoExtraccion = $metodoExtraccion;
    }

    /**
     * @return int
     */
    public function getPunto()
    {
        return $this->punto;
    }

    /**
     * @param int $punto
     */
    public function setPunto($punto)
    {
        $this->punto = $punto;
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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
}
