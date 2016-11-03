<?php

require_once ('modulo/usuario/modelo/UsuarioModelo.php');
require_once ('modulo/rol/modelo/RolModelo.php');
require_once ('modulo/usuarioRol/modelo/UsuarioRolModelo.php');

/**
 * Este servicio se encarga de iniciar sesión
 */
class ServicioSesion
{
    /** @var usuarioDAO */
    private $usuarioDAO;

    /** @var usuarioRolDAO */
    private $usuarioRolDAO;

    /** @var rolDAO */
    private $rolDAO;

    /**
     * Constructor de la sesion.
     *
     * @param UsuarioDAO $usuario
     * @param UsuarioRolDAO $usuarioRol
     * @param RolDAO $rol
     */
    public function __construct(UsuarioDAO $usuario, UsuarioRolDAO $usuarioRol, RolDAO $rol)
    {
        $this->usuarioDAO = $usuario;
        $this->usuarioRolDAO = $usuarioRol;
        $this->rolDAO = $rol;
    }

    /**
     * Función para iniciar sesion
     *
     * @param string $login
     * @param string $password
     */
    public function iniciar($login, $password)
    {
        $usuario = new UsuarioModelo();
        $usuario->setLogin($login);
        $usuario->setPassword($password);
        $usuario->setHabilitado('true');

        if ($this->usuarioDAO->verificarExistenciaUsuarioDAO($usuario) == 1) {
            $this->crearSesion($usuario);
        } else {
            header('Location: '.Conexion::ruta().'?accion=inicio&m=2');exit;
        }
    }

    /**
     * Crear la sesión usando el id del usuario y el codigo del rol
     *
     * @param UsuarioModelo $usuario
     */
    public function crearSesion(UsuarioModelo $usuario)
    {
        $idUsuario = $this->usuarioDAO->getIdUsuarioDAO($usuario);

        $usuarioRol = new UsuarioRolModelo();
        $usuarioRol->setUsuarioIdUsuario($idUsuario);

        $idRol = $this->usuarioRolDAO->getIdRolDAO($usuarioRol);

        $rol = new RolModelo();
        $rol->setIdRol($idRol);

        session_start();

        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['idRol'] = $idRol;

        header('Location: '.Conexion::ruta().'?accion=inicio'.$this->rolDAO->getDescripcionDAO($rol));exit;
    }
}
