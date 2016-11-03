<?php


/**
 * Class ResultadoModelo
 */
class ResultadoModelo
{
    /**
     * @var int $idResultado
     */
    private $idResultado;

    /**
     * @var int $solicitudIdSolicitud
     */
    private $solicitudIdSolicitud;

    /**
     * @var string $nombreArchivo
     */
    private $nombreArchivo;

    /**
     * @var string $descripcion
     */
    private $descripcion;

    /**
     * @var string $informeFinal
     */
    private $informeFinal;

    /**
     * @var string $resultadoProyecto
     */
    private $resultadoProyecto;

    /**
     * @return int
     */
    public function getIdResultado()
    {
        return $this->idResultado;
    }

    /**
     * @param int $idResultado
     */
    public function setIdResultado($idResultado)
    {
        $this->idResultado = $idResultado;
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
     * @return string
     */
    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    /**
     * @param string $nombreArchivo
     */
    public function setNombreArchivo($nombreArchivo)
    {
        $this->nombreArchivo = $nombreArchivo;
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
    public function getInformeFinal()
    {
        return $this->informeFinal;
    }

    /**
     * @param string $informeFinal
     */
    public function setInformeFinal($informeFinal)
    {
        $this->informeFinal = $informeFinal;
    }

    /**
     * @return string
     */
    public function getResultadoProyecto()
    {
        return $this->resultadoProyecto;
    }

    /**
     * @param string $resultadoProyecto
     */
    public function setResultadoProyecto($resultadoProyecto)
    {
        $this->resultadoProyecto = $resultadoProyecto;
    }
}