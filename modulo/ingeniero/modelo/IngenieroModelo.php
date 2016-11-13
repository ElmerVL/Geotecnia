<?php

/**
 * Class IngenieroModelo
 */
class IngenieroModelo
{
    /**@var int $usuarioIdUsuario */
    private $usuarioIdUsuario;
    
    /**@var string $cargo */
    private $cargo;

    /**
     * @return int
     */
    public function getUsuarioIdUsuario()
    {
        return $this->usuarioIdUsuario;
    }

    /**
     * @param int $usuarioIdUsuario
     */
    public function setUsuarioIdUsuario($usuarioIdUsuario)
    {
        $this->usuarioIdUsuario = $usuarioIdUsuario;
    }

    /**
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }
}
