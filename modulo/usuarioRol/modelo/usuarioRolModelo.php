<?php

/**
 * Class UsuarioRolModelo
 */
class UsuarioRolModelo
{
    /**
     * @var int $rolCodRol
     */
    private $rolIdRol;

    /**
     * @var int $usuarioIdUsuario
     */
    private $usuarioIdUsuario;

    /**
     * @return int
     */
    public function getRolIdRol()
    {
        return $this->rolIdRol;
    }

    /**
     * @param int $rolIdRol
     */
    public function setRolIdRol($rolIdRol)
    {
        $this->rolIdRol = $rolIdRol;
    }

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
}
