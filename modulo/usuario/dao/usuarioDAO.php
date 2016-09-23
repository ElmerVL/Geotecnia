<?php
class UsuarioDAO extends Conexion
{
    public function iniciarSesionUsuarioDAO(UsuarioModelo $usuario)
    {
        parent::conectar();
        $sql = sprintf
        (
            "SELECT * FROM usuario WHERE login = %s AND passwd = %s AND habilitada = %s",
            parent::comillas_inteligentes($usuario->getLogin()),
            parent::comillas_inteligentes($usuario->getPassword()),
            parent::comillas_inteligentes($usuario->getEstado())
        );
        $resultado = pg_query($sql);
        return pg_num_rows($resultado);
    }

    public function getIdUsuarioDAO($email, $password, $estado)
    {
        $valor = array();
        parent::conectar();
        $sql = sprintf
        (
            "SELECT idusuario FROM usuario WHERE login = %s AND passwd = %s AND habilitada = %s",
            parent::comillas_inteligentes($email),
            parent::comillas_inteligentes($password),
            parent::comillas_inteligentes($estado)
        );
        $resultado = pg_query($sql);
        while ($fila = pg_fetch_assoc($resultado))
        {
            $valor[] = $fila;
        }
        return $valor[0]["idusuario"];
    }
}
?>