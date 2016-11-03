<?php

/**
 * Class Rol
 */
class RolModelo
{
    /**@var int $idRol */
    private $idRol;

    /**@var string $descripcion */
    private $descripcion;

    /**
     * @return int
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * @param int $idRol
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
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
}