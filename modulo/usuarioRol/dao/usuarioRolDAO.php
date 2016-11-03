<?php

/**
 * Class UsuarioRolDAO
 */
class UsuarioRolDAO extends Conexion
{
    /**
     * Obtiene el código del rol a partir de la tabla usuario_rol
     *
     * @param UsuarioRolModelo $usuarioRol
     * @return mixed $codRol
     */
    public function getIdRolDAO(UsuarioRolModelo $usuarioRol)
    {
        $idRol = array();
        $idUsuario = $usuarioRol->getUsuarioIdUsuario();

        parent::conectar();

        $sql = <<<SQL
SELECT rol_idrol FROM usuario_rol 
WHERE usuario_idusuario = '$idUsuario'
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $idRol[] = $fila->rol_idrol;
        }

        return $idRol[0];
    }
}
