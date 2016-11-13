<?php

/**
 * Class EnsayoModelo
 */
class EnsayoModelo
{
    /**@var int $idEnsayo */
    private $idEnsayo;

    /**@var string $codigo */
    private $codigo;

    /** @var string $tipo */
    private $tipo;

    /**@var string $categoria */
    private $categoria;

    /**@var string $descripcion */
    private $descripcion;

    /**@var string $unidad */
    private $unidad;

    /**@var double $precioUnitario */
    private $precioUnitario;

    /**@var double $precioDiezMuestra */
    private $precioDiezMuestra;

    /**@var int $duracion */
    private $duracion;

    /**
     * @return int
     */
    public function getIdEnsayo()
    {
        return $this->idEnsayo;
    }

    /**
     * @param int $idEnsayo
     */
    public function setIdEnsayo($idEnsayo)
    {
        $this->idEnsayo = $idEnsayo;
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
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
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
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * @param string $unidad
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
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
     * @return float
     */
    public function getPrecioDiezMuestra()
    {
        return $this->precioDiezMuestra;
    }

    /**
     * @param float $precioDiezMuestra
     */
    public function setPrecioDiezMuestra($precioDiezMuestra)
    {
        $this->precioDiezMuestra = $precioDiezMuestra;
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
}
