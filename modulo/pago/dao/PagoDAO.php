<?php

/**
 * Class PagoDAO
 */
class PagoDAO extends Conexion
{
    /**
     * @return mixed $idPago
     */
    public function getIdPagoParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM pago;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idPago = $fila->count;

        return $idPago;
    }

    /**
     * @param PagoModelo $pago
     */
    public function insertarPagoDAO(PagoModelo $pago)
    {
        $idPago = $pago->getIdPago();
        $montoPago = $pago->getMontoPago();
        $numeroPago = $pago->getNumeroPago();
        $numeroFactura = $pago->getNumeroFactura();
        $porcentajePago = $pago->getPorcentajePago();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.pago(idpago, numero_pago, numero_factura, porcentaje_pago, monto_pago)
VALUES ('$idPago', '$numeroPago', '$numeroFactura', '$porcentajePago', '$montoPago');
SQL;
        pg_query($sql);

        pg_close();
    }
}
