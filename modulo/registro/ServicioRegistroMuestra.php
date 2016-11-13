<?php

require_once('modulo/muestra/modelo/MuestraModelo.php');
require_once('modulo/ensayoLaboratorio/modelo/EnsayoLaboratorio.php');

/**
 * Class ServicioRegistroMuestra
 */
class ServicioRegistroMuestra
{
    /**
     * @var muestraDAO
     */
    private $muestraDAO;

    /**
     * @var ensayoLaboratorioDAO
     */
    private $ensayoLaboratorioDAO;

    /**
     * @var BitacoraDAO
     */
    private $bitacoraDAO;

    /**
     * ServicioRegistroMuestra constructor.
     * @param MuestraDAO $muestra
     * @param EnsayoLaboratorioDAO $ensayoLaboratorio
     * @param BitacoraDAO $bitacora
     */
    public function __construct(MuestraDAO $muestra, EnsayoLaboratorioDAO $ensayoLaboratorio, BitacoraDAO $bitacora)
    {
        $this->muestraDAO = $muestra;
        $this->ensayoLaboratorioDAO = $ensayoLaboratorio;
        $this->bitacoraDAO = $bitacora;
    }

    public function registrar(
        $idEnsayoLaboratorio,
        $tipoMuestra,
        $ubicacionGeneral,
        $ubicacionEspecifica,
        $profundidad,
        $fechaTomaMuestra,
        $metodoExtraccion,
        $puntoExtraccion,
        $descripcion
    ) {
        $idMuestra= $this->muestraDAO->getIdMuestraParaInsertarDAO() + 1;

        $codigo = $this->generarCodigo(
            $idEnsayoLaboratorio,
            $metodoExtraccion,
            $puntoExtraccion,
            $tipoMuestra,
            $profundidad,
            $descripcion
        );
        
        $muestra = new MuestraModelo();
        $muestra->setIdMuestra($idMuestra);
        $muestra->setEnsayoLaboratorioSolicitudIdSolicitud($idEnsayoLaboratorio);
        $muestra->setUbicacionGeneral($ubicacionGeneral);
        $muestra->setUbicacionEspecifica($ubicacionEspecifica);
        $muestra->setProfundidad($profundidad);
        $muestra->setFechaTomaMuestra($fechaTomaMuestra);
        $muestra->setMetodoExtraccion($metodoExtraccion);
        $muestra->setPunto($puntoExtraccion);
        $muestra->setTipo($tipoMuestra);
        $muestra->setDescripcion($descripcion);
        $muestra->setCodigo($codigo);
        
        $this->muestraDAO->insertarMuestraDAO($muestra);
        
        $ensayoLaboratorio =  new EnsayoLaboratorioModelo();
        $ensayoLaboratorio->setSolicitudIdSolicitud($$idEnsayoLaboratorio);
        $ensayoLaboratorio->setMuestraRegistrada('true');
        
        $this->ensayoLaboratorioDAO->setCampoMuestraRegistradaEnsayoLaboratorioDAO($ensayoLaboratorio);

        $registroBitacora =  new ServicioRegistroBitacora($this->bitacoraDAO);
        $registroBitacora->registrar($idEnsayoLaboratorio, 'Nueva muestra');
    }

    public function generarCodigo(
        $idEnsayoLaboratorio,
        $metodoExtraccion,
        $puntoExtraccion,
        $tipoMuestra,
        $profundidad,
        $descripcion
    ) {
        $muestra = new MuestraModelo();
        $muestra->setEnsayoLaboratorioSolicitudIdSolicitud($idEnsayoLaboratorio);
        
        $correlativoMuestra = $this->muestraDAO->getCantidadRegistrosMuestra($muestra) + 1;
        $numeroMuestra = str_pad($correlativoMuestra, 3, "0", STR_PAD_LEFT);

        $codigoMetodoExtraccion = $this->codigoMetodoExtraccion($metodoExtraccion);

        $punto = str_pad($puntoExtraccion, 3, "0", STR_PAD_LEFT);

        $codigoTipoMuestra = $this->codigoTipoMuestra($tipoMuestra);

        $descripcion = $this->codigoDescripcion($descripcion);

        $codigo = $numeroMuestra.'-'.$codigoMetodoExtraccion.'-'.$punto.'-'.$codigoTipoMuestra.'-'.$profundidad.'-'.$descripcion;

        return $codigo;
    }

    public function codigoMetodoExtraccion($metodoExtraccion)
    {
        $codigo = "NaN";

        if ('Cuchara bipartita' === $metodoExtraccion) {
            $codigo = "TZG";
        }
        if ('Tubo shelby' === $metodoExtraccion) {
            $codigo = "SHB";
        }
        if ('Manual' === $metodoExtraccion) {
            $codigo = "HND";
        }
        if ('Mostap' === $metodoExtraccion) {
            $codigo = "MTP";
        }
        if ('Extraccion nucleo rocas' === $metodoExtraccion) {
            $codigo = "ENR";
        }

        return $codigo;
    }

    public function codigoTipoMuestra($tipoMuestra)
    {
        $codigo = "NaN";

        if ('Disturbada' === $tipoMuestra) {
            $codigo = "D";
        }
        if ('No disturbada' === $tipoMuestra) {
            $codigo = "U";
        }

        return $codigo;
    }

    public function codigoDescripcion($descripcion)
    {
        $codigo = "NaN";

        if ('Organico' === $descripcion) {
            $codigo = "O";
        }
        if ('Arcilla' === $descripcion) {
            $codigo = "C";
        }
        if ('Limo' === $descripcion) {
            $codigo = "M";
        }
        if ('Grava' === $descripcion) {
            $codigo = "G";
        }
        if ('Bolones' === $descripcion) {
            $codigo = "B";
        }
        if ('Rocas' === $descripcion) {
            $codigo = "R";
        }
        if ('Arena' === $descripcion) {
            $codigo = "S";
        }

        return $codigo;
    }
}
