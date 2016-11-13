<?php

/**
 * Class ContadorDAO
 */
class ContadorDAO extends Conexion
{
    /**
     * Función para obtener el id del contador de la tabla contador.
     *
     * @param ContadorModelo $contador
     * @return int
     */
    public function getIdContadorDAO(ContadorModelo $contador)
    {
        $idUsuario = $contador->getUsuarioIdUsuario();

        parent::conectar();

        $sql = <<<SQL
SELECT idcontador
FROM contador 
WHERE usuario_idusuario = '$idUsuario'
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $idContador = $fila->idcontador;

        return $idContador;
    }
}
