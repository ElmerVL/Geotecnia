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
    public function getDescripcionDAO(RolModelo $rol)
    {
        $descripcion = array();
        $idRol = $rol->getIdRol();

        parent::conectar();

        $sql = <<<SQL
SELECT descripcion FROM rol 
WHERE idrol = '$idRol'
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $descripcion[] = $fila->descripcion;
        }

        return $descripcion[0];
    }
}
