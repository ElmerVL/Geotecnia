<?php
require_once ("modulo/usuario/dao/usuarioDAO.php");
require_once ("modulo/rol/modelo/rolModelo.php");
require_once ("modulo/usuarioRol/modelo/usuarioRolModelo.php");
require_once ("modulo/sesion/ServicioSesion.php");

if(isset($_POST['grabar']) and $_POST['grabar'] == "si")
{
    if(empty($_POST["email"]) or empty($_POST["passwd"]))
    {
        header("Location: ".Conexion::ruta()."?accion=inicio&m=1");exit;
    }
    $usuario = new UsuarioDAO();
    $usuarioRol = new UsuarioRol();
    $rol = new Rol();
    
    $sesion = new ServicioSesion($usuario, $usuarioRol, $rol);
    $sesion->iniciar($_POST["email"], $_POST["passwd"]);
   
    exit;
}
require_once ("vista/inicio.phtml");
?>