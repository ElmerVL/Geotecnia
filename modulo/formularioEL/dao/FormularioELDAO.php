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
SELECT nombre, nombre_factura, nit_ci, nombre_contacto, fecha, sum(precio_total), 
cliente_bitacora.tipo as tipo_cliente, solicitud.tipo, cliente_bitacora.telefono_fijo,
cliente_bitacora.telefono_celular, cliente_bitacora.correo,
cliente_bitacora.direccion_fiscal, cliente_bitacora.ci_contacto, solicitud.codigo_proyecto
FROM public.formulario_el, public.cliente_bitacora, public.ensayo_laboratorio, public.solicitud ,public.detalle_ensayo
WHERE formulario_el.ensayo_laboratorio_solicitud_idsolicitud = {$ensayoLaboratorioSolicitudIdSolicitud}
AND formulario_el.cliente_idcliente = cliente_bitacora.idcliente 
AND formulario_el.ensayo_laboratorio_solicitud_idsolicitud = ensayo_laboratorio.solicitud_idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = solicitud.idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = detalle_ensayo.ensayo_laboratorio_solicitud_idsolicitud
GROUP BY nombre, nombre_factura, nit_ci, nombre_contacto, fecha, cliente_bitacora.tipo, solicitud.tipo,
cliente_bitacora.telefono_fijo,
cliente_bitacora.telefono_celular, cliente_bitacora.correo,
cliente_bitacora.direccion_fiscal, cliente_bitacora.ci_contacto, solicitud.codigo_proyecto
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $detalleFormularioEL[] = $fila->nombre;
            $detalleFormularioEL[] = $fila->nombre_factura;
            $detalleFormularioEL[] = $fila->nit_ci;
            $detalleFormularioEL[] = $fila->nombre_contacto;
            $detalleFormularioEL[] = $fila->telefono_fijo;
            $detalleFormularioEL[] = $fila->telefono_celular;
            $detalleFormularioEL[] = $fila->correo;
            $detalleFormularioEL[] = $fila->direccion_fiscal;
            $detalleFormularioEL[] = $fila->fecha;
            $detalleFormularioEL[] = $fila->sum;
            $detalleFormularioEL[] = $fila->tipo_cliente;
            $detalleFormularioEL[] = $fila->codigo_proyecto;
        }

        return $detalleFormularioEL;
    }
}
