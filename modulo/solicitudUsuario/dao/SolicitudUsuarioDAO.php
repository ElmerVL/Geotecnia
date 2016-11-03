<?php

/**
 * Class SolicitudUsuarioDAO
 */
class SolicitudUsuarioDAO extends Conexion
{
    /**
     * Función para insertar los id de la solicitud y usuario en la tabla solicitud_usuario.
     *
     * @param SolicitudUsuarioModelo $solicitudUsuario
     */
    public function insertarSolicitudUsuarioDAO(SolicitudUsuarioModelo $solicitudUsuario)
    {
        $solicitudIdSolicitud = $solicitudUsuario->getSolicitudIdSolicitud();
        $usuarioIdUsuario = $solicitudUsuario->getUsuarioIdUsuario();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO solicitud_usuario(solicitud_idsolicitud, usuario_idusuario)
VALUES ('$solicitudIdSolicitud', '$usuarioIdUsuario')
SQL;
        pg_query($sql);
        
        pg_close();
    }
}