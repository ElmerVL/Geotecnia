<?php
require_once ("modulo/usuario/modelo/usuarioModelo.php");
require_once ("modulo/usuario/dao/usuarioDAO.php");
require_once ("modulo/rol/modelo/rolModelo.php");
require_once ("modulo/usuarioRol/modelo/usuarioRolModelo.php");
require_once ("modulo/sesion/ServicioSesion.php");

/**
 * Este servicio se encarga de iniciar sesion
 */
class ServicioSesion
{
    /** @var UsuarioDAO */
    private $usuarioDao;

    /** @var UsuarioRol */
    private $usuarioRol;

    /** @var Rol */
    private $rol;

    /**
     * Constructor de la sesion.
     *
     * @param UsuarioDAO $usuario
     * @param UsuarioRol $usuarioRol
     * @param Rol $rol
     */
    public function __construct(UsuarioDAO $usuario, UsuarioRol $usuarioRol, Rol $rol)
    {
        $this->usuarioDao = $usuario;
        $this->usuarioRol = $usuarioRol;
        $this->rol = $rol;
    }

    /**
     * Esto sirve para iniciar sesion
     *
     * @param string $login
     * @param string $password
     */
    public function iniciar($login, $password){
        $usuario = new UsuarioModelo();
        $usuario->setLogin($login);
        $usuario->setPassword($password);
        $usuario->setEstado(true);

        if ($this->usuarioDao->iniciarSesionUsuarioDAO($usuario) == 1)
        {
            $idUsuario = $this->usuarioDao->getIdUsuarioDAO($_POST["email"], $_POST["passwd"], true);
            $idRol = $this->usuarioRol->getIdRol($this->usuarioDao->getIdUsuarioDAO($_POST["email"], $_POST["passwd"], true));
            $_SESSION["idUser"] = $idUsuario;
            $_SESSION["idRol"] = $idRol;
            header("Location: ".Conexion::ruta()."?accion=inicio".$this->rol->getTipoRol($idRol));exit;
        }
        else
        {
            header("Location: ".Conexion::ruta()."?accion=inicio&m=2");exit;
        }
    }
}