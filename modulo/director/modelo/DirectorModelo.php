<?php

/**
 * Class DirectorModelo
 */
class DirectorModelo
{
    /**@var string $apellido */
    private $apellido;

    /**@var boolean $enCurso */
    private $enCurso;

    /** @var int $idDirector */
    private $idDirector;

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
     * @return boolean
     */
    public function getEnCurso()
    {
        return $this->enCurso;
    }

    /**
     * @param boolean $enCurso
     */
    public function setEnCurso($enCurso)
    {
        $this->enCurso = $enCurso;
    }

    /**
     * @return int
     */
    public function getIdDirector()
    {
        return $this->idDirector;
    }

    /**
     * @param int $idDirector
     */
    public function setIdDirector($idDirector)
    {
        $this->idDirector = $idDirector;
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
