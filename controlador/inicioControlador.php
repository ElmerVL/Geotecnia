<?php
require_once ('modulo/usuario/dao/UsuarioDAO.php');
require_once ('modulo/rol/dao/RolDAO.php');
require_once ('modulo/usuarioRol/dao/UsuarioRolDAO.php');
require_once ('modulo/sesion/ServicioSesion.php');

if(isset($_POST['grabar']) and $_POST['grabar'] == 'si'){
    if(empty($_POST['login']) or empty($_POST['passwd'])){
        header('Location: '.Conexion::ruta().'?accion=inicio&m=1');exit;
    }
    $usuario = new UsuarioDAO();
    $usuarioRol = new UsuarioRolDAO();
    $rol = new RolDAO();
    
    $sesion = new ServicioSesion($usuario, $usuarioRol, $rol);
    $sesion->iniciar($_POST['login'], $_POST['passwd']);
   
    exit;
}
require_once ('vista/inicio.phtml');
