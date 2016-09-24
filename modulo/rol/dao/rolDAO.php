<?php

/**
 * Class RolDAO
 */
class RolDAO extends Conexion
{
    /**
     * Función para obtener el tipo de rol a partir de la tabla rol
     * 
     * @param RolModelo $rol
     * @return mixed tipoRol
     */
    public function getTipoRolDAO(RolModelo $rol)
    {
        $tipoRol = array();
        $codRol = $rol->getCodRol();

        parent::conectar();

        $sql = <<<SQL
SELECT tiporol FROM rol 
WHERE codrol = '$codRol'
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_assoc($resultado)) {
            $tipoRol[] = $fila;
        }

        return $tipoRol[0]['tiporol'];
    }
}
