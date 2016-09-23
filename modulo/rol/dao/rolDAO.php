<?php
class RolDAO extends Conexion
{
    public function getTipoRolDAO($idRol)
    {
        $valor = array();
        parent::conectar();
        $sql = sprintf
        (
            "SELECT tiporol FROM rol WHERE codrol = %s",
            parent::comillas_inteligentes($idRol)
        );
        $resultado = pg_query($sql);
        while ($fila = pg_fetch_assoc($resultado))
        {
            $valor[] = $fila;
        }
        return $valor[0]["tiporol"];
    }
}
?>