<?php

/**
 * Class FormularioELDAO
 */
class FormularioELDAO extends Conexion
{
    /**
     * Función para insertar toda la informacion de un formulario de ensayo de laboratorio en la tabla formulario_el.
     *
     * @param FormularioELModelo $formularioEL
     */
    public function insertarFormularioELDAO(FormularioELModelo $formularioEL)
    {
        $clienteIdCliente = $formularioEL->getClienteIdCliente();
        $eLSolicitudIdSolicitud = $formularioEL->getEnsayoLaboratorioSolicitudIdSolicitud();
        $formularioRegistrado = $formularioEL->getFormularioRegistrado();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.formulario_el(cliente_idcliente, ensayo_laboratorio_solicitud_idsolicitud, formulario_registrado)
VALUES ('$clienteIdCliente', '$eLSolicitudIdSolicitud', '$formularioRegistrado');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * @param FormularioELModelo $formularioEL
     * @return array $detalleFormularioEL
     */
    public function getDetalleFormularioELDAO(FormularioELModelo $formularioEL)
    {
        $detalleFormularioEL = array();
        $ensayoLaboratorioSolicitudIdSolicitud = $formularioEL->getEnsayoLaboratorioSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT nombre, nombre_factura, nit_ci, nombre_contacto, fecha, precio_total, cliente.tipo, anticipo_pagado,
saldo_pagado, solicitud.tipo
FROM public.formulario_el, public.cliente, public.ensayo_laboratorio, public.solicitud, public.detalle_ensayo,
public.solicitud_pago
WHERE formulario_el.cliente_idcliente = cliente.idcliente 
AND formulario_el.ensayo_laboratorio_solicitud_idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = solicitud.idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = detalle_ensayo.ensayo_laboratorio_solicitud_idsolicitud 
AND solicitud.idsolicitud = solicitud_pago.solicitud_idsolicitud 
AND formulario_el.ensayo_laboratorio_solicitud_idsolicitud = '$ensayoLaboratorioSolicitudIdSolicitud';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $detalleFormularioEL[] = $fila->nombre;
            $detalleFormularioEL[] = $fila->nombre_factura;
            $detalleFormularioEL[] = $fila->nit_ci;
            $detalleFormularioEL[] = $fila->nombre_contacto;
            $detalleFormularioEL[] = $fila->fecha;
            $detalleFormularioEL[] = $fila->precio_total;
            $detalleFormularioEL[] = $fila->tipo;
            $detalleFormularioEL[] = $fila->anticipo_pagado;
            $detalleFormularioEL[] = $fila->saldo_pagado;
            $detalleFormularioEL[] = $fila->tipo;
        }

        return $detalleFormularioEL;
    }
}
