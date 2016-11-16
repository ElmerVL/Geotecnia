<?php

/**
 * Class DetalleEnsayoDAO
 */
class DetalleEnsayoDAO extends Conexion
{


    /**
     * @return array $detalleEnsayo
     */
    public function getDetalleEnsayoDAO()
    {
        $detalleEnsayo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT ensayo_laboratorio_solicitud_idsolicitud, codigo, tipo, categoria, 
descripcion, cantidad_ensayo, precio_total, detalle_ensayo.precio_unitario, tiempo_total
FROM detalle_ensayo, ensayo
WHERE detalle_ensayo.ensayo_idensayo = ensayo.idensayo;
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $detalleEnsayo[] = $fila->ensayo_laboratorio_solicitud_idsolicitud;
            $detalleEnsayo[] = $fila->codigo;
            $detalleEnsayo[] = $fila->tipo;
            $detalleEnsayo[] = $fila->categoria;
            $detalleEnsayo[] = $fila->descripcion;
            $detalleEnsayo[] = $fila->cantidad_ensayo;
            $detalleEnsayo[] = $fila->precio_total;
            $detalleEnsayo[] = $fila->precio_unitario;
            $detalleEnsayo[] = $fila->tiempo_total;
        }

        return $detalleEnsayo;
    }

    /**
     *
     *
     * @param DetalleEnsayoModelo $detalleEnsayo
     */
    public function insertarDetalleEnsayo(DetalleEnsayoModelo $detalleEnsayo)
    {
        $ensayoIdEnsayo = $detalleEnsayo->getEnsayoIdEnsayo();
        $ensayoLaboratorioSolicitudIdSolicitud = $detalleEnsayo->getEnsayoLaboratorioSolicitudIdSolicitud();
        $cantidadEnsayo = $detalleEnsayo->getCantidadEnsayo();
        $precioTotal = $detalleEnsayo->getPrecioTotal();
        $precioUnitario = $detalleEnsayo->getPrecioUnitario();
        $tiempoTotal = $detalleEnsayo->getTiempoTotal();
        $tiempoUnitario = $detalleEnsayo->getTiempoUnitario();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.detalle_ensayo(ensayo_idensayo, ensayo_laboratorio_solicitud_idsolicitud, cantidad_ensayo,
precio_total, precio_unitario, tiempo_total, tiempo_unidad)
VALUES ('$ensayoIdEnsayo', '$ensayoLaboratorioSolicitudIdSolicitud', '$cantidadEnsayo', '$precioTotal',
'$precioUnitario', '$tiempoTotal', '$tiempoUnitario');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     *
     */
    public function obtenerTiempoTotalDeEnsayos($idSolicitud)
    {
        $detalleEnsayo = array();

        parent::conectar();

        $sql = <<<SQL
SELECT sum(tiempo_total)
FROM detalle_ensayos
WHERE ensayo_laboratorio_solicitud_idsolicitud = $idSolicitud;
SQL;
        $resultado = pg_query($sql);

        $tiempoTotal = pg_fetch_object($resultado);

        pg_close();

        return intval($tiempoTotal);
    }
}
