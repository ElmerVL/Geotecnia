<?php

/**
 * Class IngenieroDAO
 */
class IngenieroDAO extends Conexion
{
    /**
     * Función para obtener los nombres completos de los ingenieros registrados,
     * a partir de las tablas usuario y ingeniero.
     *
     * @return array $ingeniero
     */
    public function getIngenieroDAO()
    {
        $ingeniero = array();

        parent::conectar();

        $sql = <<<SQL
SELECT usuario_idusuario, nombre, apellido
FROM ingeniero, usuario
WHERE usuario_idusuario = usuario.idusuario 
ORDER BY usuario_idusuario ASC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ingeniero[] = $fila->usuario_idusuario;
            $ingeniero[] = $fila->nombre.' '.$fila->apellido;
        }

        return $ingeniero;
    }

    /**
     * Función para obtener el id usuario del ingeniero de la tabla ingeniero.
     *
     * @param IngenieroModelo $ingeniero
     * @return int
     */
    public function getIdUsuarioDAO(IngenieroModelo $ingeniero)
    {
        $idIngeniero = $ingeniero->getIdIngeniero();
        
        parent::conectar();

        $sql = <<<SQL
SELECT usuario_idusuario
FROM ingeniero 
WHERE idingeniero = '$idIngeniero'
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $idUsuario = $fila->usuario_idusuario;

        return $idUsuario;
    }
}