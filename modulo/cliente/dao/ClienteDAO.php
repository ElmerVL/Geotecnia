<?php

/**
 * Class ClienteDAO
 */
class ClienteDAO extends Conexion
{
    /**
     * Función para insertar toda la informacion de un cliente en ala tabla cliente.
     *
     * @param ClienteModelo $cliente
     */
    public function insertarClienteDAO(ClienteModelo $cliente)
    {
        $idCliente = $cliente->getIdCliente();
        $nombreFactura = $cliente->getNombreFactura();
        $nitCI = $cliente->getNitCi();
        $nombreContacto = $cliente->getNombreContacto();
        $telefonoFijo = $cliente->getTelefonoFijo();
        $telefonoCelular = $cliente->getTelefonoCelular();
        $direccionFiscal = $cliente->getDireccionFiscal();
        $correo = $cliente->getCorreo();
        $tipoCliente = $cliente->getTipoCliente();
        $ciContacto = $cliente->getCiContacto();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.cliente(idcliente, nombre_factura, nit_ci, nombre_contacto, telefono_fijo, 
                           telefono_celular, direccion_fiscal, correo, tipo, ci_contacto)
VALUES ('$idCliente', '$nombreFactura', '$nitCI', '$nombreContacto', '$telefonoFijo', '$telefonoCelular',
'$direccionFiscal', '$correo', '$tipoCliente', '$ciContacto');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     * Función para obtener un id solicitud a partir de la tabla cliente, para luego usarlo cuando
     * se quiere insertar un nuevo cliente en la tabla cliente.
     *
     * @return mixed $idCliente
     */
    public function getIdClienteParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM cliente;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idCliente = $fila->count;

        return $idCliente;
    }
}
