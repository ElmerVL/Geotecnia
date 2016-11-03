<?php

/**
 * Class FormularioTCDAO
 */
class FormularioTCDAO extends Conexion
{
    /**
     * Función para insertar toda la informacion de un formulario de trabajo de campo en la tabla formulario_tc.
     *
     * @param FormularioTCModelo $formularioTC
     */
    public function insertarFormularioTCDAO(FormularioTCModelo $formularioTC)
    {
        $clienteIdCliente = $formularioTC->getClienteIdCliente();
        $tCSolicitudIdSolicitud = $formularioTC->getTCSolicitudIdSolicitud();
        $formularioRegistrado = $formularioTC->getFormularioRegistrado();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.formulario_el(cliente_idcliente, trabajo_campo_solicitud_idsolicitud, formulario_registrado)
VALUES ('$clienteIdCliente', '$tCSolicitudIdSolicitud', '$formularioRegistrado');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * @param FormularioTCModelo $formularioTC
     * @return array $detalleFormularioTC
     */
    public function getDetalleFormularioTCDAO(FormularioTCModelo $formularioTC)
    {
        $detalleFormularioTC = array();
        $trabajoCampoSolicitudIdSolicitud = $formularioTC->getTrabajoCampoSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT nombre, nombre_factura, nit_ci, nombre_contacto, fecha, precio, cliente.tipo, anticipo_pagado, saldo_pagado, solicitud.tipo
FROM public.formulario_tc, public.cliente, public.trabajo_campo, public.solicitud, public.solicitud_pago, public.alcance
WHERE formulario_tc.cliente_idcliente = cliente.idcliente 
AND formulario_tc.trabajo_campo_solicitud_idsolicitud = trabajo_campo.solicitud_idsolicitud
AND trabajo_campo.solicitud_idsolicitud = solicitud.idsolicitud
AND trabajo_campo.solicitud_idsolicitud = alcance.trabajo_campo_solicitud_idsolicitud 
AND solicitud.idsolicitud = solicitud_pago.solicitud_idsolicitud 
AND formulario_tc.trabajo_campo_solicitud_idsolicitud = '$trabajoCampoSolicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $detalleFormularioTC[] = $fila->nombre;
            $detalleFormularioTC[] = $fila->nombre_factura;
            $detalleFormularioTC[] = $fila->nit_ci;
            $detalleFormularioTC[] = $fila->nombre_contacto;
            $detalleFormularioTC[] = $fila->fecha;
            $detalleFormularioTL[] = $fila->precio;
            $detalleFormularioTL[] = $fila->tipo;
            $detalleFormularioTL[] = $fila->anticipo_pagado;
            $detalleFormularioTL[] = $fila->saldo_pagado;
            $detalleFormularioTL[] = $fila->tipo;
        }

        return $detalleFormularioTC;
    }
}