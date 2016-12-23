<?php

/**
 * Class MuestraDAO
 */
class MuestraDAO extends Conexion
{
    /**
     * Función para obtener un id muestra a partir de la tabla muestra, para luego usarlo cuando
     * se quiere insertar un nuevo registro en la tabla muestra.
     *
     * @return mixed $idMuestra
     */
    public function getIdMuestraParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM muestra;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idMuestra = $fila->count;

        return $idMuestra;
    }

    /**
     *
     *
     * @param MuestraModelo $muestra
     */
    public function insertarMuestraDAO(MuestraModelo $muestra)
    {
        $idMuestra = $muestra->getIdMuestra();
        $ensayoLaboratorioSolicitudIdSolicitud = $muestra->getEnsayoLaboratorioSolicitudIdSolicitud();
        $ubicacionGeneral = $muestra->getUbicacionGeneral();
        $ubicacionEspecifico = $muestra->getUbicacionEspecifica();
        $profundidad = $muestra->getProfundidad();
        $fechaTomaMuestra = $muestra->getFechaTomaMuestra();
        $metodoExtraccion = $muestra->getMetodoExtraccion();
        $punto = $muestra->getPunto();
        $tipo = $muestra->getTipo();
        $descripcion = $muestra->getDescripcion();
        $codigo = $muestra->getCodigo();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.muestra(idmuestra, ensayo_laboratorio_solicitud_idsolicitud, ubicacion_general, ubicacion_especifica,
profundidad, fecha_toma_muestra, metodo_extraccion, punto, tipo, descripcion, codigo)
VALUES ('$idMuestra', '$ensayoLaboratorioSolicitudIdSolicitud', '$ubicacionGeneral', '$ubicacionEspecifico',
'$profundidad', '$fechaTomaMuestra', '$metodoExtraccion', '$punto', '$tipo', '$descripcion', '$codigo');
SQL;
        pg_query($sql);

        pg_close();
    }

    /**
     *
     *
     * @param MuestraModelo $muestra
     * @return mixed
     */
    public function getCantidadRegistrosMuestra(MuestraModelo $muestra)
    {
        $idEnsayoLaboratorio = $muestra->getEnsayoLaboratorioSolicitudIdSolicitud();
        
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM muestra
WHERE ensayo_laboratorio_solicitud_idsolicitud = '$idEnsayoLaboratorio';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $cantidadMuestra = $fila->count;

        return $cantidadMuestra;
    }

    /**
     * @param MuestraModelo $muestra
     * @return array
     */
    public function getMuestraDAO(MuestraModelo $muestra)
    {
        $muestraRegistrada = array();
        $idEnsayoLaboratorio = $muestra->getEnsayoLaboratorioSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT idmuestra, codigo, ubicacion_general, ubicacion_especifica, fecha_toma_muestra
FROM ensayo_laboratorio, muestra
WHERE ensayo_laboratorio.solicitud_idsolicitud = muestra.ensayo_laboratorio_solicitud_idsolicitud
AND ensayo_laboratorio.solicitud_idsolicitud = '$idEnsayoLaboratorio';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $muestraRegistrada[] = $fila->idmuestra;
            $muestraRegistrada[] = $fila->codigo;
            $muestraRegistrada[] = $fila->ubicacion_general;
            $muestraRegistrada[] = $fila->ubicacion_especifica;
            $muestraRegistrada[] = $fila->fecha_toma_muestra;
        }

        return $muestraRegistrada;
    }
}
