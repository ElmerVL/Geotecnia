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

    public function addComillasSimples($valor)
    {
        // Retirar las barras
        if (get_magic_quotes_gpc()){
                $valor = stripslashes($valor);
        }
        // Colocar comillas si no es entero
        if (!is_numeric($valor)){
                $valor = "'". pg_escape_string($valor) ."'";
        }
        //Colocar comillas si es entero (pgSQL)
        if (is_numeric($valor)){
            $valor = "'". pg_escape_string($valor) ."'";
        }
        return $valor;
    }
}
