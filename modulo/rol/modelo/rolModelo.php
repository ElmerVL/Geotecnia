<?php

/**
 * Class Rol
 */
class RolModelo
{
    /**@var codRol */
    private $codRol;

    /**@var tipoRol */
    private $tipoRol;

    /**
     * @return tipoRol
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

    /**
     * @return codRol
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
}