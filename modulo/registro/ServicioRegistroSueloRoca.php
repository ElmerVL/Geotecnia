<?php

require_once('modulo/ensayo/modelo/EnsayoModelo.php');
require_once('modulo/detalleEnsayo/modelo/DetalleEnsayoModelo.php');
require_once('modulo/ensayoLaboratorio/modelo/EnsayoLaboratorioModelo.php');

/**
 * Class ServicioRegistroSuelo
 */
class ServicioRegistroSueloRoca
{
    /**
     * @var ensayoDAO
     */
    private $ensayoDAO;

    /**
     * @var ensayoLaboratorioDAO
     */
    private $ensayoLaboratorioDAO;

    /**
     * @var detalleEnsayoDAO
     */
    private $detalleEnsayoDAO;

    /**
     * ServicioRegistroSuelo constructor.
     *
     * @param EnsayoDAO $ensayo
     * @param EnsayoLaboratorioDAO $ensayoLaboratorio
     * @param DetalleEnsayoDAO $detalleEnsayo
     */
    public function __construct(EnsayoDAO $ensayo, EnsayoLaboratorioDAO $ensayoLaboratorio, DetalleEnsayoDAO $detalleEnsayo)
    {
        $this->ensayoDAO = $ensayo;
        $this->ensayoLaboratorioDAO = $ensayoLaboratorio;
        $this->detalleEnsayoDAO = $detalleEnsayo;
    }

    /**
     * @param $idEnsayoLaboratorio
     * @param $codigoEnsayo
     * @param $cantidadEnsayo
     */
    public function registrar($idEnsayoLaboratorio, $codigoEnsayo, $cantidadEnsayo)
    {
        $ensayo = new EnsayoModelo();
        $ensayo->setCodigo($codigoEnsayo);

        $idEnsayo = $this->ensayoDAO->getIdEnsayoDAO($ensayo);

        if (10 <= $cantidadEnsayo) {
            $precioUnitario = $this->ensayoDAO->getPrecioDiesMuestraDAO($ensayo);
        } else {
            $precioUnitario = $this->ensayoDAO->getPrecioUnitarioDAO($ensayo);
        }

        $precioTotal = $precioUnitario * $cantidadEnsayo;

        $tiempoUnitario = $this->ensayoDAO->getDuracionDAO($ensayo);
        
        $tiempoTotal = $tiempoUnitario * $cantidadEnsayo;
        
        $detalleEnsayo = new DetalleEnsayoModelo();
        $detalleEnsayo->setEnsayoIdEnsayo($idEnsayo);
        $detalleEnsayo->setEnsayoLaboratorioSolicitudIdSolicitud($idEnsayoLaboratorio);
        $detalleEnsayo->setCantidadEnsayo($cantidadEnsayo);
        $detalleEnsayo->setPrecioTotal($precioTotal);
        $detalleEnsayo->setPrecioUnitario($precioUnitario);
        $detalleEnsayo->setTiempoTotal($tiempoTotal);
        $detalleEnsayo->setTiempoUnitario($tiempoUnitario);

        $this->detalleEnsayoDAO->insertarDetalleEnsayo($detalleEnsayo);

        $ensayoLaboratorio =  new EnsayoLaboratorioModelo();
        $ensayoLaboratorio->setSolicitudIdSolicitud($idEnsayoLaboratorio);
        $ensayoLaboratorio->setEnsayoRegistrado('true');

        $this->ensayoLaboratorioDAO->setCampoEnsayoRegistradoEnsayoLaboratorioDAO($ensayoLaboratorio);
    }
}
