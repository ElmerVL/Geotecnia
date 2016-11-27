<?php

/**
 * Class EnsayoLaboratorioDAO
 */
class EnsayoLaboratorioDAO extends Conexion
{
    /**
 * Función para obtener los proyectos de tipo ensayo de laboratorio
 * a partir de la tabla solicitud y ensayo_laboratorio.
 *
 * @return array $ensayoLaboratorio
 */
    public function getEnsayoLaboratorioHabilitadoDAO()
    {
        $ensayoLaboratorio = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio 
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ensayoLaboratorio[] = $fila->idsolicitud;
            $ensayoLaboratorio[] = $fila->codigo;
            $ensayoLaboratorio[] = $fila->nombre;
            $ensayoLaboratorio[] = $fila->tipo;
            $ensayoLaboratorio[] = $fila->ubicacion;
            $ensayoLaboratorio[] = $fila->responsable;
            $ensayoLaboratorio[] = $fila->fecha;
        }

        return $ensayoLaboratorio;
    }

    /**
     * Función para obtener los proyectos de tipo ensayo de laboratorio
     * a partir de la tabla solicitud y ensayo_laboratorio.
     *
     * @return array $ensayoLaboratorio
     */
    public function getEnsayoLaboratorioDAO()
    {
        $ensayoLaboratorio = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio 
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ensayoLaboratorio[] = $fila->idsolicitud;
            $ensayoLaboratorio[] = $fila->codigo;
            $ensayoLaboratorio[] = $fila->nombre;
            $ensayoLaboratorio[] = $fila->tipo;
            $ensayoLaboratorio[] = $fila->ubicacion;
            $ensayoLaboratorio[] = $fila->responsable;
            $ensayoLaboratorio[] = $fila->fecha;
        }

        return $ensayoLaboratorio;
    }

    public function getEnsayoLaboratorioSinMuestraDAO()
    {
        $ensayoLaboratorio = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio 
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud 
AND ensayo_laboratorio.muestra_registrada = 'false'
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ensayoLaboratorio[] = $fila->idsolicitud;
            $ensayoLaboratorio[] = $fila->codigo;
            $ensayoLaboratorio[] = $fila->nombre;
            $ensayoLaboratorio[] = $fila->tipo;
            $ensayoLaboratorio[] = $fila->ubicacion;
            $ensayoLaboratorio[] = $fila->responsable;
            $ensayoLaboratorio[] = $fila->fecha;
        }

        return $ensayoLaboratorio;
    }

    public function getEnsayoLaboratorioSinEnsayoDAO()
    {
        $ensayoLaboratorio = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio 
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud 
AND ensayo_laboratorio.ensayo_registrado = 'false'
AND solicitud.habilitado = 'true'
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ensayoLaboratorio[] = $fila->idsolicitud;
            $ensayoLaboratorio[] = $fila->codigo;
            $ensayoLaboratorio[] = $fila->nombre;
            $ensayoLaboratorio[] = $fila->tipo;
            $ensayoLaboratorio[] = $fila->ubicacion;
            $ensayoLaboratorio[] = $fila->responsable;
            $ensayoLaboratorio[] = $fila->fecha;
        }

        return $ensayoLaboratorio;
    }

    /**
     * Función para obtener los proyectos de tipo ensayo de laboratorio sin ningún cliente registrado
     * a partir de la tabla solicitud y ensayo_laboratorio.
     *
     * @return array $ensayoLaboratorio
     */
    public function getEnsayoLaboratorioSinClienteRegistradoDAO()
    {
        $ensayoLaboratorio = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio 
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND registro_cliente = 'false'
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $ensayoLaboratorio[] = $fila->idsolicitud;
            $ensayoLaboratorio[] = $fila->codigo;
            $ensayoLaboratorio[] = $fila->nombre;
            $ensayoLaboratorio[] = $fila->tipo;
            $ensayoLaboratorio[] = $fila->ubicacion;
            $ensayoLaboratorio[] = $fila->responsable;
            $ensayoLaboratorio[] = $fila->fecha;
        }

        return $ensayoLaboratorio;
    }
    
    /**
     * Función para obtener el seguimiento de ensayos de laboratorio
     * a partir de la tabla solicitud, ensayo_laboratorio y solicitud_pago.
     *
     * @return array $seguimientoEL
     */
    public function getSeguimientoEnsayoLaboratorioDAO()
    {
        $seguimientoEL = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, fecha, responsable, nombre, habilitado, codigo_proyecto, muestra_registrada,
ensayo_registrado, anticipo_pagado, saldo_pagado, informe_entregado
FROM solicitud, ensayo_laboratorio, solicitud_pago
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud 
AND idsolicitud = solicitud_pago.solicitud_idsolicitud
AND solicitud.habilitado = 'true'
ORDER BY fecha DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $seguimientoEL[] = $fila->idsolicitud;
            $seguimientoEL[] = $fila->codigo;
            $seguimientoEL[] = $fila->fecha;
            $seguimientoEL[] = $fila->responsable;
            $seguimientoEL[] = $fila->nombre;
            $seguimientoEL[] = $fila->habilitado;
            $seguimientoEL[] = $fila->codigo_proyecto;
            $seguimientoEL[] = $fila->muestra_registrada;
            $seguimientoEL[] = $fila->ensayo_registrado;
            $seguimientoEL[] = $fila->anticipo_pagado;
            $seguimientoEL[] = $fila->saldo_pagado;
            $seguimientoEL[] = $fila->informe_entregado;
        }

        return $seguimientoEL;
    }

    /**
     * Función para obtener el nombre del proyecto a partir de la tabla solicitud y ensayo_laboratorio.
     *
     * @param EnsayoLaboratorioModelo $ensayoLaboratorio
     * @return mixed $nombreProyecto
     */
    public function getNombreProyectoDAO(EnsayoLaboratorioModelo $ensayoLaboratorio)
    {
        $nombreProyecto = array();
        $solicitudIdSolicitud = $ensayoLaboratorio->getSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT nombre
FROM solicitud, ensayo_laboratorio
WHERE  idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $nombreProyecto[] = $fila->nombre;
        }

        return $nombreProyecto[0];
    }

    /**
     * Función para obtener la fecha del proyecto a partir de la tabla solicitud y ensayo_laboratorio.
     *
     * @param EnsayoLaboratorioModelo $ensayoLaboratorio
     * @return mixed $fechaProyecto
     */
    public function getFechaProyectoDAO(EnsayoLaboratorioModelo $ensayoLaboratorio)
    {
        $fechaProyecto = array();
        $solicitudIdSolicitud = $ensayoLaboratorio->getSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT fecha
FROM solicitud, ensayo_laboratorio
WHERE  idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $fechaProyecto[] = $fila->fecha;
        }

        return $fechaProyecto[0];
    }

    /**
     * Función para insertar toda la informacion de un ensayo de laboratorio en la tabla ensayo_laboratorio.
     *
     * @param EnsayoLaboratorioModelo $ensayoLaboratorio
     */
    public function insertarEnsayoLaboratorioDAO(EnsayoLaboratorioModelo $ensayoLaboratorio)
    {
        $solicitudIdSolicitud = $ensayoLaboratorio->getSolicitudIdSolicitud();
        $muestraRegistrada = $ensayoLaboratorio->getMuestraRegistrada();
        $ensayoRegistrado = $ensayoLaboratorio->getEnsayoRegistrado();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.ensayo_laboratorio(solicitud_idsolicitud, muestra_registrada, ensayo_registrado)
VALUES ('$solicitudIdSolicitud', '$muestraRegistrada', '$ensayoRegistrado');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * @param EnsayoLaboratorioModelo $ensayoLaboratorio
     */
    public function setCampoMuestraRegistradaEnsayoLaboratorioDAO(EnsayoLaboratorioModelo $ensayoLaboratorio)
    {
        $solicitudIdSolicitud = $ensayoLaboratorio->getSolicitudIdSolicitud();
        $muestraRegistrada = $ensayoLaboratorio->getMuestraRegistrada();

        parent::conectar();

        $sql = <<<SQL
UPDATE public.ensayo_laboratorio
SET muestra_registrada = '$muestraRegistrada' 
WHERE solicitud_idsolicitud = '$solicitudIdSolicitud';
SQL;

        pg_query($sql);

        pg_close();
    }
}
