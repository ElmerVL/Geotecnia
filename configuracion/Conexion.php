<?php

session_start();

class Conexion
{
    public function conectar()
    {
        $host = 'localhost';
        $port = '5432';
        $dataBaseName = 'geotecnia';
        $user = 'postgres';
        $password = 'postgres';

        $cadena = 'host=\'' . $host . '\' '
            . 'port=\'' . $port . '\''
            . 'dbname=\'' . $dataBaseName .'\''
            . 'user =\'' . $user . '\''
            . 'password=\'' . $password . '\'';

        $con = pg_connect($cadena) or die('Error en la conexion');

        return $con;
    }
    
    public static function ruta()
    {
        return 'http://localhost/Geotecnia/';
    }
}
