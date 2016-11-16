<?php

/**
 * Class CalendarioDAO
 */
class CalendarioDAO extends Conexion
{
    public function inicializarCalendario(CalendarioModelo $calendario)
    {
        $ingenieroUser = $calendario->getSolicitudIngenieroUsuarioIdUsuario();
        $ingenieroId = $calendario->getSolicitudIngenieroIdIngeniero();
        $directorUser = $calendario->getSolicitudDirectorUsuarioIdUsuario();
        $directorId = $calendario->getSolicitudDirectorIdDirector();
        $idSolicitud = $calendario->getSolicitudIdSolicitud();

        $tiempoTotal = $this->calcularTiempoTotal($idSolicitud);

        $fechaActual = new DateTime();
        $fechaInicio = $fechaActual->format('Y-m-d');
        $duracion = new DateInterval('P' . $tiempoTotal . 'D');
        $fechaFin = $fechaActual->add($duracion);
        $fechaFin->format('Y-m-d');

        $sql = <<<SQL
INSERT INTO calendario(
            solicitud_ingeniero_usuario_idusuario, solicitud_ingeniero_idingeniero, 
            solicitud_director_usuario_idusuario, solicitud_director_iddirector, 
            solicitud_idsolicitud, fecha_inicio, fecha_fin)
    VALUES ($ingenieroUser, $ingenieroId, $directorUser, $directorId, $idSolicitud, '$fechaInicio', '$fechaFin');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * @param $idSolicitud
     *
     * @return int
     */
    private function calcularTiempoTotal($idSolicitud)
    {
        $detalleEnsayos = new DetalleEnsayoDAO();
        $tiempoTotal = $detalleEnsayos->obtenerTiempoTotalDeEnsayos($idSolicitud);

        if (!$tiempoTotal || $tiempoTotal <= 0) {
            $alcanceDao = new AlcanceDAO();
            $trabajocampoDao = new TrabajoCampoDAO();
            $trabajocampo = $trabajocampoDao->getTrabajoCampoPorIdSolicitud($idSolicitud);
            $alcance = $alcanceDao->recuperarAlcanceDAO($trabajocampo->getCodTrabajoCampo());

            $tiempoTotal = $alcance->getDuracion();
        }

        return $tiempoTotal;
    }
}
