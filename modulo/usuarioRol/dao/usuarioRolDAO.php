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
    public function getCodRolDAO(UsuarioRolModelo $usuarioRol)
    {
        $codRol = array();
        $idUsuario = $usuarioRol->getUsuarioIdUsuario();

        parent::conectar();

        $sql = <<<SQL
SELECT rol_codrol FROM user_rol 
WHERE usuario_idusuario = '$idUsuario'
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_assoc($resultado)) {
            $codRol[] = $fila;
        }

        return $codRol[0]['rol_codrol'];
    }
}
