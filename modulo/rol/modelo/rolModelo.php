<?php
require_once ("modulo/rol/dao/rolDAO.php");
class Rol extends RolDAO
{
    public function __construct()
    {

    }

    public function getTipoRol($idRol)
    {
        return parent::getTipoRolDAO($idRol);
    }
}
?>