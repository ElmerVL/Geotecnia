<?php


/**
 * Class SolicitudPagoDAO
 */
class SolicitudPagoDAO extends Conexion
{
    /**
     * @param SolicitudPagoModelo $solicitudPago
     */
    public function insertarSolicitudPagoDAO(SolicitudPagoModelo $solicitudPago)
    {
        $solicitudIdSolicitud = $solicitudPago->getSolicitudIdSolicitud();
        $pagoIdPago = $solicitudPago->getPagoIdPago();
        $porcentajeAnticipo = $solicitudPago->getPorcentajeAnticipo();
        $anticipoPagado = $solicitudPago->getAnticipoPagado();
        $porcentajeSaldo = $solicitudPago->getPorcentajeSaldo();
        $saldoPagado = $solicitudPago->getSaldoPagado();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.solicitud_pago(pago_idpago, solicitud_idsolicitud, porcentaje_anticipo, anticipo_pagado, porcentaje_saldo, saldo_pagado)
VALUES ('$solicitudIdSolicitud', '$pagoIdPago', '$porcentajeAnticipo', '$anticipoPagado', '$porcentajeSaldo', '$saldoPagado');
SQL;
        pg_query($sql);

        pg_close();
    }
}