<?php
class CalendarioDAO extends Conexion
{
    public function getFechaDAO()
    {
        $fecha = array();
        parent::conectar();
        $sql = sprintf
        (
            "SELECT * FROM user_rol "
        );
        $resultado = pg_query($sql);
        while ($fila = pg_fetch_assoc($resultado))
        {
            $fecha[] = $fila;
        }
        return $fecha;
    }
}
?>