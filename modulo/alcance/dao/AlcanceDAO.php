<?php

/**
 * Class AlcanceDAO
 */
class AlcanceDAO extends Conexion
{
    /**
     * Función para obtener un id alcance a partir de la tabla alcance, para luego usarlo cuando
     * se quiere insertar un nuevo registro en la tabla alcance.
     *
     * @return mixed $idMuestra
     */
    public function getIdAlcanceParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM alcance;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idAlcance = $fila->count;

        return $idAlcance;
    }


    /**
     * @param AlcanceModelo $alcance
     * @return mixed $idAlcance
     */
    public function getIdAlcanceDAO(AlcanceModelo $alcance)
    {
        $trabajoCampoSolicitudIdSolicitud = $alcance->getTrabajoCampoSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT idalcance
FROM alcance 
WHERE trabajo_campo_solicitud_idsolicitud = '$trabajoCampoSolicitudIdSolicitud'
ORDER BY idalcance DESC
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idAlcance[] = $fila->idalcance;

        return $idAlcance[0];
    }

    /**
     *
     *
     * @param AlcanceModelo $alcance
     */
    public function insertarAlcanceDAO(AlcanceModelo $alcance)
    {
        $idAlcance = $alcance->getIdAlcance();
        $trabajoCampoSolicitudIdSolicitud = $alcance->getTrabajoCampoSolicitudIdSolicitud();
        $antecedente = $alcance->getAntecedente();
        $objetivo = $alcance->getObjetivo();
        $duracion = $alcance->getDuracion();
        $precio = $alcance->getPrecio();
        $formaPago = $alcance->getFormaPago();
        $requerimientoAdicional = $alcance->getRequerimientoAdicional();
        $trabajoCampo = $alcance->getTrabajoCampo();
        $trabajoLaboratorio =$alcance->getTrabajoLaboratorio();
        $trabajoGabinete = $alcance->getTrabajoGabinete();
        $observacion = $alcance->getObservacion();
        $conObservacion = $alcance->getConObservacion();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.alcance(idalcance, trabajo_campo_solicitud_idsolicitud, antecedente, objetivo,
trabajo_campo, trabajo_gabinete, trabajo_laboratorio, duracion, precio, forma_pago, 
requerimiento_adicional, observacion, conobservacion)
VALUES ('$idAlcance', '$trabajoCampoSolicitudIdSolicitud', '$antecedente', '$objetivo', '$duracion', '$precio',
'$formaPago', '$requerimientoAdicional', '$trabajoCampo', '$trabajoLaboratorio', '$trabajoGabinete', '$observacion',
'$conObservacion');
SQL;
        pg_query($sql);

        pg_close();
    }
}
