<?php

/**
 * Class UsuarioRolModelo
 */
class UsuarioRolModelo
{
    /**@var  codUsuarioRol */
    private $codUsuarioRol;

    /**@var rolCodRol */
    private $rolCodRol;

    /**@var usuarioIdUsuario */
    private $usuarioIdUsuario;
    
    /**
     * @return codUsuarioRol
     */
    public function getCodUsuarioRol()
    {
        return $this->codUsuarioRol;
    }

    /**
     * @param codUsuarioRol $codUsuarioRol
     */
    public function setCodUsuarioRol($codUsuarioRol)
    {
        $this->codUsuarioRol = $codUsuarioRol;
    }

    /**
     * @return rolCodRol
     */
    public function getRolCodRol()
    {
        return $this->rolCodRol;
    }

    /**
     * @param rolCodRol $rolCodRol
     */
    public function setRolCodRol($rolCodRol)
    {
        $this->rolCodRol = $rolCodRol;
    }

    /**
     * @return usuarioIdUsuario
     */
    public function getUsuarioIdUsuario()
    {
        return $this->usuarioIdUsuario;
    }

    /**
     * @param usuarioIdUsuario $usuarioIdUsuario
     */
    public function setUsuarioIdUsuario($usuarioIdUsuario)
    {
        $this->usuarioIdUsuario = $usuarioIdUsuario;
    }
}
