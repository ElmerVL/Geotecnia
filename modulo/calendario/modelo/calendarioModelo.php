<?php
require_once ("modulo/calendario/dao/calendarioDAO.php");
class Calendario extends CalendarioDAO
{
    public function __construct()
    {

    }

    public function getFecha()
    {
        return parent::getFechaDAO();
    }
}
?>