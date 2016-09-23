<?php
class UsuarioRolDAO extends Conexion
{
    public function getIdRolDAO($idUsuario)
    {
        $valor = array();
        parent::conectar();
        $sql = sprintf
        (
            "SELECT rol_codrol FROM user_rol WHERE usuario_idusuario = %s",
            parent::comillas_inteligentes($idUsuario)
        );
        $resultado = pg_query($sql);
        while ($fila = pg_fetch_assoc($resultado))
        {
            $valor[] = $fila;
        }
        return $valor[0]["rol_codrol"];
    }
}
?>