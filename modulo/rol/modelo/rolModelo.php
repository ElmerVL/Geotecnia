<?php

/**
 * Class Rol
 */
class RolModelo
{
    /**@var int $codRol */
    private $codRol;

    /**@var string $tipoRol */
    private $tipoRol;

    /**
     * @return int
     */
    public function getCodRol()
    {
        return $this->codRol;
    }

    /**
     * @param int $codRol
     */
    public function setCodRol($codRol)
    {
        $this->codRol = $codRol;
    }

    /**
     * @return string
     */
    public function getTipoRol()
    {
        return $this->tipoRol;
    }

    /**
     * @param string $tipoRol
     */
    public function setTipoRol($tipoRol)
    {
        $this->tipoRol = $tipoRol;
    }
}