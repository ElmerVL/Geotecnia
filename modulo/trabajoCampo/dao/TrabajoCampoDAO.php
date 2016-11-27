<?php

/**
 * Class TrabajoCampoDAO
 */
class TrabajoCampoDAO extends Conexion
{
    /**
 *  Función para obtener los proyectos de tipo trabajo de campo
 * a partir de la tabla solicitud y trabajo_campo.
 *
 * @return array $trabajoCampo
 */
    public function getTrabajoCampoHabilitadoDAO()
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo 
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo[] = $fila->idsolicitud;
            $trabajoCampo[] = $fila->codigo;
            $trabajoCampo[] = $fila->nombre;
            $trabajoCampo[] = $fila->tipo;
            $trabajoCampo[] = $fila->ubicacion;
            $trabajoCampo[] = $fila->responsable;
            $trabajoCampo[] = $fila->fecha;
        }

        return $trabajoCampo;
    }

    /**
     *  Función para obtener los proyectos de tipo trabajo de campo
     * a partir de la tabla solicitud y trabajo_campo.
     *
     * @return array $trabajoCampo
     */
    public function getTrabajoCampoDAO()
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo 
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud
ORDER BY idsolicitud DESC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo[] = $fila->idsolicitud;
            $trabajoCampo[] = $fila->codigo;
            $trabajoCampo[] = $fila->nombre;
            $trabajoCampo[] = $fila->tipo;
            $trabajoCampo[] = $fila->ubicacion;
            $trabajoCampo[] = $fila->responsable;
            $trabajoCampo[] = $fila->fecha;
        }

        return $trabajoCampo;
    }

    /**
     *
     *
     * @param int $idSolicitud
     *
     * @return TrabajoCampoModelo $trabajoCampo
     */
    public function getTrabajoCampoPorIdSolicitud($idSolicitud)
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT *
FROM trabajo_campo 
WHERE solicitud_idsolicitud = $idSolicitud;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo = new TrabajoCampoModelo();
            $trabajoCampo->setSolicitudIdSolicitud($fila->idsolicitud);
            $trabajoCampo->setCodTrabajoCampo($fila->codigo);
        }

        return $trabajoCampo;
    }

    /**
     * @return array
     */
    public function getTrabajoCampoSinAlcanceDAO()
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo 
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud 
AND trabajo_campo.alcance_creado = 'false' 
AND trabajo_campo.alcance_aprobado = 'false'
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo[] = $fila->idsolicitud;
            $trabajoCampo[] = $fila->codigo;
            $trabajoCampo[] = $fila->nombre;
            $trabajoCampo[] = $fila->tipo;
            $trabajoCampo[] = $fila->ubicacion;
            $trabajoCampo[] = $fila->responsable;
            $trabajoCampo[] = $fila->fecha;
        }

        return $trabajoCampo;
    }

    public function getTrabajoCampoConAlcanceDAO()
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo 
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud 
AND trabajo_campo.alcance_creado = 'true' 
AND trabajo_campo.alcance_aprobado = 'true' 
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo[] = $fila->idsolicitud;
            $trabajoCampo[] = $fila->codigo;
            $trabajoCampo[] = $fila->nombre;
            $trabajoCampo[] = $fila->tipo;
            $trabajoCampo[] = $fila->ubicacion;
            $trabajoCampo[] = $fila->responsable;
            $trabajoCampo[] = $fila->fecha;
        }

        return $trabajoCampo;
    }

    /**
     *  Función para obtener los proyectos de tipo trabajo de campo sin ningún cliente registrado
     * a partir de la tabla solicitud y trabajo_campo.
     *
     * @return array $trabajoCampo
     */
    public function getTrabajoCampoSinClienteRegistradoDAO()
    {
        $trabajoCampo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo 
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud
AND registro_cliente = 'false' 
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $trabajoCampo[] = $fila->idsolicitud;
            $trabajoCampo[] = $fila->codigo;
            $trabajoCampo[] = $fila->nombre;
            $trabajoCampo[] = $fila->tipo;
            $trabajoCampo[] = $fila->ubicacion;
            $trabajoCampo[] = $fila->responsable;
            $trabajoCampo[] = $fila->fecha;
        }

        return $trabajoCampo;
    }

    /**
     * Función para obtener el seguimiento de trabajos de campo
     * a partir de la tabla solicitud, trabajo_campo y solicitud_pago.
     *
     * @return array $seguimientoTC
     */
    public function getSeguimientoTrabajoCampoDAO()
    {
        $seguimientoTC = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, fecha, responsable, nombre, habilitado, codigo_proyecto, alcance_creado,
anticipo_pagado, saldo_pagado, informe_entregado
FROM solicitud, trabajo_campo, solicitud_pago
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud 
AND idsolicitud = solicitud_pago.solicitud_idsolicitud
AND solicitud.habilitado = 'true'
ORDER BY fecha DESC
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $seguimientoTC[] = $fila->idsolicitud;
            $seguimientoTC[] = $fila->codigo;
            $seguimientoTC[] = $fila->fecha;
            $seguimientoTC[] = $fila->responsable;
            $seguimientoTC[] = $fila->nombre;
            $seguimientoTC[] = $fila->habilitado;
            $seguimientoTC[] = $fila->codigo_proyecto;
            $seguimientoTC[] = $fila->alcance_creado;
            $seguimientoTC[] = $fila->anticipo_pagado;
            $seguimientoTC[] = $fila->saldo_pagado;
            $seguimientoTC[] = $fila->informe_entregado;
        }

        return $seguimientoTC;
    }

    /**
     * Función para insertar toda la informacion de un trabajo de campo en la tabla trabajo_campo.
     *
     * @param TrabajoCampoModelo $trabajoCampo
     */
    public function insertarTrabajoCampoDAO(TrabajoCampoModelo $trabajoCampo)
    {
        $solicitudIdSolicitud = $trabajoCampo->getSolicitudIdSolicitud();
        $alcanceCreado = $trabajoCampo->getAlcanceCreado();
        $alcanceAprobado = $trabajoCampo->getAlcanceAprobado();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.trabajo_campo(solicitud_idsolicitud, alcance_creado, alcance_aprobado)
VALUES ('$solicitudIdSolicitud', '$alcanceCreado', '$alcanceAprobado');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * Función para obtener el nombre del proyecto a partir de la tabla solicitud y trabajo_campo.
     *
     * @param TrabajoCampoModelo $trabajoCampo
     * @return mixed $nombreProyecto
     */
    public function getNombreProyectoDAO(TrabajoCampoModelo $trabajoCampo)
    {
        $nombreProyecto = array();
        $solicitudIdSolicitud = $trabajoCampo->getSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT nombre
FROM solicitud, trabajo_campo
WHERE  idsolicitud = trabajo_campo.solicitud_idsolicitud
AND trabajo_campo.solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $nombreProyecto[] = $fila->nombre;
        }

        return $nombreProyecto[0];
    }

    /**
     * Función para obtener la fecha del proyecto a partir de la tabla solicitud y trabajo_campo.
     *
     * @param TrabajoCampoModelo $trabajoCampo
     * @return mixed $fechaProyecto
     */
    public function getFechaProyectoDAO(TrabajoCampoModelo $trabajoCampo)
    {
        $fechaProyecto = array();
        $solicitudIdSolicitud = $trabajoCampo->getSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT fecha
FROM solicitud, trabajo_campo
WHERE  idsolicitud = trabajo_campo.solicitud_idsolicitud
AND trabajo_campo.solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $fechaProyecto[] = $fila->fecha;
        }

        return $fechaProyecto[0];
    }

    /**
     * @param TrabajoCampoModelo $trabajoCampo
     */
    public function setTrabajoCampoDAO(TrabajoCampoModelo $trabajoCampo)
    {
        $solicitudIdSolicitud = $trabajoCampo->getSolicitudIdSolicitud();
        $alcanceAprobado = $trabajoCampo->getAlcanceAprobado();
        $alcanceCreado = $trabajoCampo->getAlcanceCreado();

        parent::conectar();

        $sql = <<<SQL
UPDATE public.trabajo_campo
SET alcance_creado = '$alcanceCreado', alcance_aprobado = '$alcanceAprobado' 
WHERE solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;

        pg_query($sql);

        pg_close();
    }
}
