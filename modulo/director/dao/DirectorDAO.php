<?php

/**
 * Class DirectorDAO
 */
class DirectorDAO extends Conexion
{

    /**
     * Función para obtener el id del director de la tabla director.
     *
     * @param DirectorModelo $director
     * @return int
     */
    public function getIdDirectorDAO(DirectorModelo $director)
    {
        $enCurso = $director->getEnCurso();

        parent::conectar();

        $sql = <<<SQL
SELECT iddirector
FROM director 
WHERE en_curso = '$enCurso'
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $idDirector = $fila->iddirector;

        return $idDirector;
    }


    /**
     * Función para obtener el id usuario del director de la tabla director.
     *
     * @param DirectorModelo $director
     * @return int
     */
    public function getIdUsuarioDAO(DirectorModelo $director)
    {
        $enCurso = $director->getEnCurso();

        parent::conectar();

        $sql = <<<SQL
SELECT usuario_idusuario
FROM director 
WHERE en_curso = '$enCurso'
SQL;
        $resultado = pg_query($sql);
        $fila = pg_fetch_object($resultado);
        $idUsuario = $fila->usuario_idusuario;

        return $idUsuario;
    }
}
