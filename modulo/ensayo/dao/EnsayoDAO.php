<?php

/**
 * Class EnsayoDAO
 */
class EnsayoDAO extends Conexion
{
    /**
     * Función para obtener el id del ensayo a partir de la tabla ensayo.
     *
     * @param EnsayoModelo $ensayo
     * @return mixed $idEnsayo
     */
    public function getIdEnsayoDAO(EnsayoModelo $ensayo)
    {
        $codigo = $ensayo->getCodigo();

        parent::conectar();

        $sql = <<<SQL
SELECT idensayo
FROM ensayo
WHERE codigo = '$codigo';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $idEnsayo = $fila->idensayo;

        return $idEnsayo;
    }

    /**
     * Función para obtener el precio unitario del ensayo a partir de la tabla ensayo.
     *
     * @param EnsayoModelo $ensayo
     * @return mixed $precioUnitario
     */
    public function getPrecioUnitarioDAO(EnsayoModelo $ensayo)
    {
        $codigo = $ensayo->getCodigo();

        parent::conectar();

        $sql = <<<SQL
SELECT precio_unitario
FROM ensayo
WHERE codigo = '$codigo';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $precioUnitario = $fila->precio_unitario;

        return $precioUnitario;
    }

    /**
     * Función para obtener el precio que supere las 10 muestras de ensayo a partir de la tabla ensayo.
     *
     * @param EnsayoModelo $ensayo
     * @return mixed $precioDiesMuestra
     */
    public function getPrecioDiesMuestraDAO(EnsayoModelo $ensayo)
    {
        $codigo = $ensayo->getCodigo();

        parent::conectar();

        $sql = <<<SQL
SELECT precio_dies_muestra
FROM ensayo
WHERE codigo = '$codigo';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $precioDiesMuestra = $fila->precio_dies_muestra;

        return $precioDiesMuestra;
    }

    /**
     * Función para obtener el tiempo de duracion de un ensayo a partir de la tabla ensayo.
     *
     * @param EnsayoModelo $ensayo
     * @return mixed $duracion
     */
    public function getDuracionDAO(EnsayoModelo $ensayo)
    {
        $codigo = $ensayo->getCodigo();

        parent::conectar();

        $sql = <<<SQL
SELECT duracion
FROM ensayo
WHERE codigo = '$codigo';
SQL;
        $resultado = pg_query($sql);

        $fila = pg_fetch_object($resultado);
        $duracion = $fila->duracion;

        return $duracion;
    }
}
