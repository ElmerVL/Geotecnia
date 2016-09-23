<?php
session_start();
class Conexion
{
    public function conectar()
    {
        $cadena = "host='localhost' port='5432' dbname='geotecnia' user ='postgres' password='postgres'";
        $con = pg_connect($cadena) or die('Error en la conexion');
        return $con;
    }
    
    public static function ruta()
    {
        return "http://localhost/Geotecnia/";
    }


    public function comillas_inteligentes($valor)
    {
        // Retirar las barras
        if (get_magic_quotes_gpc())
        {
                $valor = stripslashes($valor);
        }
        // Colocar comillas si no es entero
        if (!is_numeric($valor))
        {
                $valor = "'". pg_escape_string($valor) ."'";
        }
        //Colocar comillas si es entero (pgSQL)
        if (is_numeric($valor))
        {
            $valor = "'". pg_escape_string($valor) ."'";
        }
        return $valor;
    }
    
    public static function valida_correo($email)
    {
        $mail_correcto = 0;
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@"))
        {
            if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " ")))
            {
                //miro si tiene caracter .
                if (substr_count($email, ".") >= 1)
                {
                    //obtengo la terminacion del dominio
                    $term_dom = substr(strrchr($email, '.'), 1);
                    //compruebo que la terminaci�n del dominio sea correcta
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@")))
                    {
                        //compruebo que lo de antes del dominio sea correcto
                        $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != "@" && $caracter_ult != ".")
                        {
                            $mail_correcto = 1;
                        }
                    }
                }
            }
        }
        if ($mail_correcto)
            return true;
        else
            return false;
    }
}
