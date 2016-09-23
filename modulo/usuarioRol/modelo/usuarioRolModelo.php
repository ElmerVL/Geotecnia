<?php
require_once ("modulo/usuarioRol/dao/usuarioRolDAO.php");
class UsuarioRol extends UsuarioRolDAO
{
    public function __construct()
    {

    }

    public function getIdRol($idUsuario)
    {
        return parent::getIdRolDAO($idUsuario);
    }
}
?>