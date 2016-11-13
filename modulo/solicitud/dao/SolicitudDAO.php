<?php

require_once('modulo/solicitud/modelo/SolicitudModelo.php');

/**
 * Class SolicitudDAO
 */
class SolicitudDAO extends Conexion
{
    /**
     * Función para obtener las solicitudes registradas en la tabla solicitud.
     *
     * @return array $solicitud
     */
    public function getSolicitudDAO()
    {
        $solicitud = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha, habilitado
FROM solicitud 
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $solicitud[] = $fila->idsolicitud;
            $solicitud[] = $fila->codigo;
            $solicitud[] = $fila->nombre;
            $solicitud[] = $fila->tipo;
            $solicitud[] = $fila->ubicacion;
            $solicitud[] = $fila->responsable;
            $solicitud[] = $fila->fecha;
            $solicitud[] = $fila->habilitado;
        }

        pg_close();

        return $solicitud;
    }

    /**
     *  Función para obtener los proyectos de tipo trabajo de campo con su cliente y pago registrado
     * a partir de la tabla solicitud.
     *
     * @return array $trabajoCampo
     */
    public function getSolicitudConClientePagoRegistradoDAO()
    {
        $solicitud = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud
WHERE registro_cliente = 'true' AND registro_pago = 'true' 
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $solicitud[] = $fila->idsolicitud;
            $solicitud[] = $fila->codigo;
            $solicitud[] = $fila->nombre;
            $solicitud[] = $fila->tipo;
            $solicitud[] = $fila->ubicacion;
            $solicitud[] = $fila->responsable;
            $solicitud[] = $fila->fecha;
        }

        return $solicitud;
    }

    /**
     *  Función para obtener los proyectos de tipo ensayo de laboratorio sin ningún pago registrado
     * a partir de la tabla solicitud.
     *
     * @return array $trabajoCampo
     */
    public function getSolicitudTipoELSinPagoRegistradoDAO()
    {
        $solicitud = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, ensayo_laboratorio
WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud AND ensayo_registrado = 'true' 
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $solicitud[] = $fila->idsolicitud;
            $solicitud[] = $fila->codigo;
            $solicitud[] = $fila->nombre;
            $solicitud[] = $fila->tipo;
            $solicitud[] = $fila->ubicacion;
            $solicitud[] = $fila->responsable;
            $solicitud[] = $fila->fecha;
        }

        return $solicitud;
    }

    /**
     *  Función para obtener los proyectos de tipo trabajo de campo sin ningún pago registrado
     * a partir de la tabla solicitud.
     *
     * @return array $trabajoCampo
     */
    public function getSolicitudTipoTCSinPagoRegistradoDAO()
    {
        $solicitud = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, tipo, ubicacion, responsable, fecha
FROM solicitud, trabajo_campo
WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud AND alcance_creado = 'true' 
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $solicitud[] = $fila->idsolicitud;
            $solicitud[] = $fila->codigo;
            $solicitud[] = $fila->nombre;
            $solicitud[] = $fila->tipo;
            $solicitud[] = $fila->ubicacion;
            $solicitud[] = $fila->responsable;
            $solicitud[] = $fila->fecha;
        }

        return $solicitud;
    }

    /**
     * Función para obtener las solicitudes ordenados por un determinado año.
     *
     * @param $anio
     * @return array $solicitud
     */
    public function getSolicitudPorAnioDAO($anio)
    {
        $solicitud = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idsolicitud, codigo, nombre, ubicacion, tipo, habilitado, responsable, fecha
FROM solicitud 
WHERE date_part('year', fecha) = '$anio'
ORDER BY idsolicitud DESC;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $solicitud[] = $fila->idsolicitud;
            $solicitud[] = $fila->codigo;
            $solicitud[] = $fila->nombre;
            $solicitud[] = $fila->ubicacion;
            $solicitud[] = $fila->tipo;
            $solicitud[] = $fila->habilitado;
            $solicitud[] = $fila->responsable;
            $solicitud[] = $fila->fecha;
        }

        return $solicitud;
    }

    /**
     * Función para modificar el estado del campo habilitado dela tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     */
    public function setHabilitadoSolicitudDAO(SolicitudModelo $solicitud)
    {
        $idSolicitud = $solicitud->getIdSolicitud();
        $habilitado = $solicitud->getHabilitado();

        parent::conectar();

        $sql = <<<SQL
UPDATE solicitud
SET habilitado = '$habilitado'
WHERE idsolicitud = '$idSolicitud';
SQL;

        pg_query($sql);

        pg_close();
    }

    /**
 * Función para modificar el codigo del proyecto en la tabla solicitud.
 *
 * @param SolicitudModelo $solicitud
 */
    public function setCodigoProyectoSolicitudDAO(SolicitudModelo $solicitud)
    {
        $idSolicitud = $solicitud->getIdSolicitud();
        $codigoProyecto = $solicitud->getCodigoProyecto();

        parent::conectar();

        $sql = <<<SQL
UPDATE solicitud
SET codigo_proyecto = '$codigoProyecto'
WHERE idsolicitud = '$idSolicitud';
SQL;

        pg_query($sql);

        pg_close();
    }

    /**
     * Función para modificar el el estado de registro del cliente del campo registro_cliente de la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     */
    public function setRegistroClienteSolicitudDAO(SolicitudModelo $solicitud)
    {
        $idSolicitud = $solicitud->getIdSolicitud();
        $registroCliente = $solicitud->getRegistroCliente();

        parent::conectar();

        $sql = <<<SQL
UPDATE solicitud
SET registro_cliente = '$registroCliente'
WHERE idsolicitud = '$idSolicitud';
SQL;

        pg_query($sql);

        pg_close();
    }

    /**
     * Función para obtener el tipo de solicitud a partir de la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     */
    public function getTipoSolicitudDAO(SolicitudModelo $solicitud)
    {
        $idSolicitud = $solicitud->getIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT tipo
FROM solicitud
WHERE idsolicitud = '$idSolicitud';
SQL;

        pg_query($sql);
    }

    /**
     * Función para obtener el codigo del proyecto de la solicitud a partir de la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     */
    public function getCodigoProyectoSolicitudDAO(SolicitudModelo $solicitud)
    {
        $idSolicitud = $solicitud->getIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT codigo_proyecto
FROM solicitud
WHERE idsolicitud = '$idSolicitud';
SQL;

        pg_query($sql);
    }

    /**
     * Función para obtener el codigo de la solicitud a partir de la tabla solicitud.
     *
     * @return string
     */
    public function getCodigoSolicitudParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM solicitud
WHERE date_part('year', fecha) = date_part('year', now());
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $cantidadFila = $fila->count;
        $cantidadFila = str_pad($cantidadFila, 3, "0", STR_PAD_LEFT);
        $codigo = "So-".($cantidadFila + 1)."_".date("y");
        return $codigo;
    }

    /**
     * Función para obtener el codigo de proyecto de la solicitud a partir de la tabla solicitud.
     *
     * @return string
     */
    public function getCodigoProyectoParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM solicitud
WHERE date_part('year', fecha) = date_part('year', now());
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $cantidadFila = $fila->count;
        $cantidadFila = str_pad($cantidadFila, 3, "0", STR_PAD_LEFT);
        $codigoProyecto = "PS-".($cantidadFila + 1)."_".date("y");
        return $codigoProyecto;
    }

    /**
     * Función para obtener el id de la solicitud a partir de la tabla solicitud.
     *
     * @return mixed idSolicitud
     */
    public function getIdSolicitudParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM solicitud;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idSolicitud = $fila->count;

        return $idSolicitud;
    }

    /**
     * Función para insertar toda la informacion de una solicitud en la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     */
    public function insertarSolicitudDAO(SolicitudModelo $solicitud)
    {
        $sidSolicitud = $solicitud->getIdSolicitud();
        $nombre = $solicitud->getNombre();
        $fecha = $solicitud->getFecha();
        $ubicacion = $solicitud->getUbicacion();
        $tipo = $solicitud->getTipo();
        $codigo = $solicitud->getCodigo();
        $habilitado = $solicitud->getHabilitado();
        $informeEntregado = $solicitud->getInformeEntregado();
        $informeAprobado = $solicitud->getInformeAprobado();
        $responsable = $solicitud->getResponsable();
        $codigoProyecto = $solicitud->getCodigoProyecto();
        $registroCliente = $solicitud->getRegistroCliente();
        $registroPago = $solicitud->getRegistroPago();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.solicitud(
idsolicitud, nombre, fecha, ubicacion, tipo, codigo, habilitado, informe_entregado, informe_aprobado, responsable,
codigo_proyecto, registro_cliente, registro_pago)
VALUES ('$sidSolicitud', '$nombre', '$fecha', '$ubicacion', '$tipo', '$codigo', '$habilitado', '$informeEntregado',
 '$informeAprobado', '$responsable', '$codigoProyecto', '$registroCliente', '$registroPago');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * Función para obtener el nombre a partir de la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     * @return mixed $nombreProyecto
     */
    public function getNombreSolicitudDAO(SolicitudModelo $solicitud)
    {
        $nombre= array();
        $idSolicitud = $solicitud->getIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT nombre
FROM solicitud
WHERE  idsolicitud = '$idSolicitud';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $nombre[] = $fila->nombre;

        return $nombre[0];
    }

    /**
     * Función para obtener la fecha a partir de la tabla solicitud.
     *
     * @param SolicitudModelo $solicitud
     * @return mixed $fechaProyecto
     */
    public function getFechaSolicitudDAO(SolicitudModelo $solicitud)
    {
        $fecha = array();
        $idSolicitud = $solicitud->getIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT fecha
FROM solicitud
WHERE  idsolicitud = '$idSolicitud';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $fecha[] = $fila->fecha;

        return $fecha[0];
    }
}
