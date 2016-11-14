<?php

/**
 * Class ResultadoDAO
 */
class ResultadoDAO extends Conexion
{
    /**
     *  Función para obtener todos los resultados de cada proyecto registrado
     * a partir de la tabla resultado.
     *
     * @param ResultadoModelo $resultado
     * @return array $listaResultado
     */
    public function getResultadoDAO(ResultadoModelo $resultado)
    {
        $listaResultado = array();
        $solicitudIdSolicitud = $resultado->getSolicitudIdSolicitud();

        parent::conectar();

        $sql = <<<SQL
SELECT idresultado,nombre_archivo, descripcion
FROM resultado
WHERE solicitud_idsolicitud = '$solicitudIdSolicitud' 
AND informe_final = 'true' 
OR resultado_proyecto = 'true';
SQL;
        $resultado = pg_query($sql);

        while ($fila = pg_fetch_object($resultado)) {
            $listaResultado[] = $fila->idresultado;
            $listaResultado[] = $fila->nombre_archivo;
            $listaResultado[] = $fila->descripcion;
        }

        return $listaResultado;
    }

    /**
     * Función para obtener un id resultado a partir de la tabla resultado, para luego usarlo cuando
     * se quiere insertar un nuevo registro en la tabla registro.
     *
     * @return mixed $idResultado
     */
    public function getIdResultadoParaInsertarDAO()
    {
        parent::conectar();

        $sql = <<<SQL
SELECT count(*) 
FROM resultado;
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idResultado = $fila->count;

        return $idResultado;
    }

    /**
     * Función para insertar toda la informacion de un resultado en la tabla resultado.
     *
     * @param ResultadoModelo $resultado
     */
    public function insertarResultadoDAO(ResultadoModelo $resultado)
    {
        $idResultado = $resultado->getIdResultado();
        $solicitudIdSolicitud = $resultado->getSolicitudIdSolicitud();
        $nombreArchivo = $resultado->getNombreArchivo();
        $descripcion = $resultado->getDescripcion();
        $informeFinal = $resultado->getInformeFinal();
        $resultadoProyecto = $resultado->getResultadoProyecto();

        parent::conectar();

        $sql = <<<SQL
INSERT INTO public.resultado(idresultado, solicitud_idsolicitud, nombre_archivo, descripcion, informe_final,
resultado_proyecto)
VALUES ('$idResultado', '$solicitudIdSolicitud', '$nombreArchivo', '$descripcion', '$informeFinal',
'$resultadoProyecto');
SQL;
        pg_query($sql);

        pg_close();
    }
}
