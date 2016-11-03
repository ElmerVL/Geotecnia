<?php

/**
 * Class ContadorModelo
 */
class ContadorModelo
{
    /**@var string $apellido */
    private $apellido;

    /**@var int $idContador */
    private $idContador;

    /** @var string $nombre */
    private $nombre;

    /**@var int $usuarioIdUsuario */
    private $usuarioIdUsuario;

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return int
     */
    public function getIdContador()
    {
        return $this->idContador;
    }

    /**
     * @param int $idContador
     */
    public function setIdContador($idContador)
    {
        $this->idContador = $idContador;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getUsuarioIdUsuario()
    {
        return $this->usuarioIdUsuario;
    }

    /**
     * @param int $usuarioIdUsuario
     */
    public function setUsuarioIdUsuario($usuarioIdUsuario)
    {
        $this->usuarioIdUsuario = $usuarioIdUsuario;
    }
}