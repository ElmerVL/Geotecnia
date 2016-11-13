<?php


/**
 * Class ServicioRegistroPago
 */
class ServicioRegistroPago
{
    /**
     * @var solicitudPagoDAO
     */
    private $solicitudPagoDAO;

    /**
     * @var pagoDAO
    */
    private $pagoDAO;

    /**
     * @var pagoDAO
     */
    private $bitacoraDAO;

    /**
     * ServicioRegistroPago constructor.
     * @param SolicitudPagoDAO $solicitudPago
     * @param PagoDAO $pago
     * @param BitacoraDAO $bitacora
     */
    public function __construct(SolicitudPagoDAO $solicitudPago, PagoDAO $pago, BitacoraDAO $bitacora)
    {
        $this->solicitudPagoDAO = $solicitudPago;
        $this->pagoDAO = $pago;
        $this->bitacoraDAO = $bitacora;
    }

    /**
     * @param $idSolicitud
     * @param $precioTotal
     * @param $numeroAnticipo100
     * @param $facturaAnticipo100
     * @param $numeroAnticipo50
     * @param $numeroFactura50
     * @param $numeroSaldo50
     * @param $facturaSaldo50
     * @param $numeroAnticipo20
     * @param $numeroFactura20
     * @param $numeroSaldo80
     * @param $facturaSaldo20
     */
    public function registrar($idSolicitud, $precioTotal, $numeroAnticipo100, $facturaAnticipo100, $numeroAnticipo50, $numeroFactura50, $numeroSaldo50, $facturaSaldo50, $numeroAnticipo20, $numeroFactura20, $numeroSaldo80, $facturaSaldo20)
    {
        $solicitudPago = new SolicitudPagoModelo();
        $pago = new PagoModelo();

        if (!empty($numeroAnticipo100) and !empty($facturaAnticipo100)) {
            $idPago = $this->pagoDAO->getIdPagoParaInsertarDAO() + 1;
            $pago->setIdPago($idPago);
            $pago->setMontoPago($precioTotal);
            $pago->setNumeroFactura($facturaAnticipo100);
            $pago->setNumeroPago($numeroAnticipo100);
            $pago->setPorcentajePago(100);
            
            $this->pagoDAO->insertarPagoDAO($pago);

            $solicitudPago->setSolicitudIdSolicitud($idSolicitud);
            $solicitudPago->setPagoIdPago($idPago);
            $solicitudPago->setPorcentajeAnticipo(0);
            $solicitudPago->setAnticipoPagado('true');
            $solicitudPago->setPorcentajeSaldo(100);
            $solicitudPago->setSaldoPagado($precioTotal);
            
            $this->solicitudPagoDAO->insertarSolicitudPagoDAO($solicitudPago);
        }
        if (!empty($numeroAnticipo50) and !empty($numeroFactura50)) {
            $saldoPago = $precioTotal * 0.5;

            $idPago = $this->pagoDAO->getIdPagoParaInsertarDAO() + 1;
            $pago->setIdPago($idPago);
            $pago->setMontoPago($precioTotal);
            $pago->setNumeroFactura($numeroFactura50);
            $pago->setNumeroPago($numeroAnticipo50);
            $pago->setPorcentajePago(50);

            $this->pagoDAO->insertarPagoDAO($pago);

            $solicitudPago->setSolicitudIdSolicitud($idSolicitud);
            $solicitudPago->setPagoIdPago($idPago);
            $solicitudPago->setPorcentajeAnticipo(50);
            $solicitudPago->setAnticipoPagado('true');
            $solicitudPago->setPorcentajeSaldo(50);
            $solicitudPago->setSaldoPagado($saldoPago);

            $this->solicitudPagoDAO->insertarSolicitudPagoDAO($solicitudPago);
        }
        if (!empty($numeroSaldo50) and !empty($facturaSaldo50)) {
            $saldoPago = $precioTotal * 0.5;

            $idPago = $this->pagoDAO->getIdPagoParaInsertarDAO() + 1;
            $pago->setIdPago($idPago);
            $pago->setMontoPago($precioTotal);
            $pago->setNumeroFactura($facturaSaldo50);
            $pago->setNumeroPago($numeroSaldo50);
            $pago->setPorcentajePago(50);

            $this->pagoDAO->insertarPagoDAO($pago);

            $solicitudPago->setSolicitudIdSolicitud($idSolicitud);
            $solicitudPago->setPagoIdPago($idPago);
            $solicitudPago->setPorcentajeAnticipo(50);
            $solicitudPago->setAnticipoPagado('true');
            $solicitudPago->setPorcentajeSaldo(50);
            $solicitudPago->setSaldoPagado($saldoPago);

            $this->solicitudPagoDAO->insertarSolicitudPagoDAO($solicitudPago);
        }
        if (!empty($numeroAnticipo20) and !empty($numeroFactura20)) {
            $saldoPago = $precioTotal * 0.8;

            $idPago = $this->pagoDAO->getIdPagoParaInsertarDAO() + 1;
            $pago->setIdPago($idPago);
            $pago->setMontoPago($precioTotal);
            $pago->setNumeroFactura($numeroFactura20);
            $pago->setNumeroPago($numeroAnticipo20);
            $pago->setPorcentajePago(20);

            $this->pagoDAO->insertarPagoDAO($pago);

            $solicitudPago->setSolicitudIdSolicitud($idSolicitud);
            $solicitudPago->setPagoIdPago($idPago);
            $solicitudPago->setPorcentajeAnticipo(20);
            $solicitudPago->setAnticipoPagado('true');
            $solicitudPago->setPorcentajeSaldo(80);
            $solicitudPago->setSaldoPagado($saldoPago);

            $this->solicitudPagoDAO->insertarSolicitudPagoDAO($solicitudPago);
        }
        if (!empty($numeroSaldo80) and !empty($facturaSaldo20)) {
            $saldoPago = $precioTotal * 0.2;

            $idPago = $this->pagoDAO->getIdPagoParaInsertarDAO() + 1;
            $pago->setIdPago($idPago);
            $pago->setMontoPago($precioTotal);
            $pago->setNumeroFactura($facturaSaldo20);
            $pago->setNumeroPago($numeroSaldo80);
            $pago->setPorcentajePago(80);

            $this->pagoDAO->insertarPagoDAO($pago);

            $solicitudPago->setSolicitudIdSolicitud($idSolicitud);
            $solicitudPago->setPagoIdPago($idPago);
            $solicitudPago->setPorcentajeAnticipo(80);
            $solicitudPago->setAnticipoPagado('true');
            $solicitudPago->setPorcentajeSaldo(20);
            $solicitudPago->setSaldoPagado($saldoPago);

            $this->solicitudPagoDAO->insertarSolicitudPagoDAO($solicitudPago);
        }

        $registroBitacora =  new ServicioRegistroBitacora($this->bitacoraDAO);
        $registroBitacora->registrar($idSolicitud, 'Nuevo pago');
    }
}
