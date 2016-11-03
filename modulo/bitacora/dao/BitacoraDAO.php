<?php

/**
 * Class BitacoraDAO
 */
class BitacoraDAO extends Conexion
{
    public function getIdBitacoraParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM bitacora;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);

        $idBitacora = $fila->count;

        return $idBitacora;
    }

    /**
     * @return array $bitacora
     */
    public function getBitacoraUltimasDiez()
    {
        $bitacora = array();

        parent::conectar();

        $sql = <<<SQL
SELECT idbitacora, solicitud_idsolicitud, actividad, fecha_bitacora, nombre, tipo, ubicacion, responsable, solicitud.fecha
FROM bitacora, solicitud 
WHERE bitacora.solicitud_idsolicitud = solicitud.idsolicitud 
ORDER BY bitacora.fecha_bitacora DESC LIMIT 10 OFFSET 0;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $bitacora[] = $fila->idbitacora;
            $bitacora[] = $fila->solicitud_idsolicitud;
            $bitacora[] = $fila->actividad;
            $bitacora[] = $fila->fecha_bitacora;
            $bitacora[] = $fila->nombre;
            $bitacora[] = $fila->tipo;
            $bitacora[] = $fila->ubicacion;
            $bitacora[] = $fila->responsable;
            $bitacora[] = $fila->fecha;
        }

        return $bitacora;
    }

    public function insertarBitacoraDAO(BitacoraModelo $bitacora)
    {
        $idBitacora = $bitacora->getIdBitacora();
        $solicitudIdSolicitud = $bitacora->getSolicitudIdSolicitud();
        $actividad = $bitacora->getActividad();
        $fechaBitacora = $bitacora->getFechaBitacora();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.bitacora(idbitacora, solicitud_idsolicitud, actividad, fecha_bitacora)
VALUES ('$idBitacora', '$solicitudIdSolicitud', '$actividad', '$fechaBitacora');
SQL;
        pg_query($sql);

        pg_close();
    }
}