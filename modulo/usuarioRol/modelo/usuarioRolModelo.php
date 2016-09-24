<?php

/**
 * Class UsuarioRolModelo
 */
class UsuarioRolModelo
{
    /**
     * @var int $codUsuarioRol
     */
    private $codUsuarioRol;

    /**
     * @var int $rolCodRol
     */
    private $rolCodRol;

    /**
     * @var int $usuarioIdUsuario
     */
    private $usuarioIdUsuario;

    /**
     * @return int
     */
    public function getCodUsuarioRol()
    {
        return $this->codUsuarioRol;
    }

    /**
     * @param int $codUsuarioRol
     */
    public function setCodUsuarioRol($codUsuarioRol)
    {
        $this->codUsuarioRol = $codUsuarioRol;
    }

    /**
     * @return int
     */
    public function getRolCodRol()
    {
        return $this->rolCodRol;
    }

    /**
     * @param int $rolCodRol
     */
    public function setRolCodRol($rolCodRol)
    {
        $this->rolCodRol = $rolCodRol;
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
