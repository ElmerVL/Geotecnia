<?php

require_once ('modulo/alcance/modelo/AlcanceModelo.php');
require_once ('modulo/trabajoCampo/modelo/TrabajoCampoModelo.php');


/**
 * Class ServicioRegistroAlcance
 */
class ServicioRegistroAlcance
{
    /**
     * @var alcanceDAO
     */
    private $alcanceDAO;

    /**
     * @var trabajoCampoDAO
     */
    private $trabajoCampoDAO;

    /**
     * ServicioRegistroAlcance constructor.
     * 
     * @param AlcanceDAO $alcance
     * @param TrabajoCampoDAO $trabajoCampo
     */
    public function __construct(AlcanceDAO $alcance, TrabajoCampoDAO $trabajoCampo)
    {
        $this->alcanceDAO = $alcance;
        $this->trabajoCampoDAO = $trabajoCampo;
    }

    /**
     * @param $idTrabajoCampo
     * @param $antecedente
     * @param $objetivo
     * @param $duracionEstudio
     * @param $precioEstudio
     * @param $formaPago
     * @param $requerimientoAdicional
     * @param $trabajoRealizadoTC
     * @param $trabajoRealizadoTL
     * @param $trabajoRealizadoTG
     */
    public function registrar($idTrabajoCampo, $antecedente, $objetivo, $duracionEstudio, $precioEstudio, $formaPago, $requerimientoAdicional, $trabajoRealizadoTC, $trabajoRealizadoTL, $trabajoRealizadoTG)
    {
        $idAlcance = $this->alcanceDAO->getIdAlcanceParaInsertarDAO() + 1;
        
        $alcance = new AlcanceModelo();
        $alcance->setIdAlcance($idAlcance);
        $alcance->setTrabajoCampoSolicitudIdSolicitud($idTrabajoCampo);
        $alcance->setAntecedente($antecedente);
        $alcance->setObjetivo($objetivo);
        $alcance->setDuracion($duracionEstudio);
        $alcance->setPrecio($precioEstudio);
        $alcance->setFormaPago($formaPago);
        $alcance->setRequerimientoAdicional($requerimientoAdicional);
        $alcance->setTrabajoCampo($trabajoRealizadoTC);
        $alcance->setTrabajoLaboratorio($trabajoRealizadoTL);
        $alcance->setTrabajoGabinete($trabajoRealizadoTG);
        $alcance->setObservacion('NINGUNA');
        $alcance->setConObservacion('false');
        
        $this->alcanceDAO->insertarAlcanceDAO($alcance);

        $trabajoCampo = new TrabajoCampoModelo();
        $trabajoCampo->setSolicitudIdSolicitud($idTrabajoCampo);
        $trabajoCampo->setAlcanceCreado('true');
        $trabajoCampo->setAlcanceAprobado('true');
        
        $this->trabajoCampoDAO->setTrabajoCampoDAO($trabajoCampo);
    }
}