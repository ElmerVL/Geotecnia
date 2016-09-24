<?php

/**
 * Class UsuarioDAO
 */
class UsuarioDAO extends Conexion
{
    /**
     * Verifica la existencia del usuario en la tabla usuario
     *
     * @param UsuarioModelo $usuario
     * @return int
     */
    public function verificarExistenciaUsuarioDAO(UsuarioModelo $usuario)
    {
        $login = $usuario->getLogin();
        $password = $usuario->getPassword();
        $estado =  $usuario->getEstado();

        parent::conectar();

        $sql = <<<SQL
SELECT * FROM usuario 
WHERE login = '$login' 
AND passwd = '$password' 
AND habilitada = '$estado'
SQL;
        $resultado = pg_query($sql);

        return pg_num_rows($resultado);
    }

    /**
     * Función para obtener el id del usuario a partir de la tabla usuario
     *
     * @param UsuarioModelo $usuario
     * @return mixed idUsuario
     */
    public function getIdUsuarioDAO(UsuarioModelo $usuario)
    {
        $idUsuario = array();
        $login = $usuario->getLogin();
        $password = $usuario->getPassword();
        $estado =  $usuario->getEstado();

        parent::conectar();

        $sql = <<<SQL
SELECT idusuario FROM usuario 
WHERE login = '$login' 
AND passwd = '$password' 
AND habilitada = '$estado'
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_assoc($resultado)) {
            $idUsuario[] = $fila;
        }

        return $idUsuario[0]['idusuario'];
    }
}