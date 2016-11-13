<?php

/**
 * Class FormularioTCModelo
 */
class FormularioTCModelo
{
    /**@var int $clienteIdCliente */
    private $clienteIdCliente;

    /**@var int $trabajoCampoSolicitudIdSolicitud */
    private $trabajoCampoSolicitudIdSolicitud;

    /** @var string $formularioRegistrado */
    private $formularioRegistrado;

    /**
     * @return int
     */
    public function getClienteIdCliente()
    {
        return $this->clienteIdCliente;
    }

    /**
     * @param int $clienteIdCliente
     */
    public function setClienteIdCliente($clienteIdCliente)
    {
        $this->clienteIdCliente = $clienteIdCliente;
    }

    /**
     * @return int
     */
    public function getTrabajoCampoSolicitudIdSolicitud()
    {
        return $this->trabajoCampoSolicitudIdSolicitud;
    }

    /**
     * @param int $trabajoCampoSolicitudIdSolicitud
     */
    public function setTrabajoCampoSolicitudIdSolicitud($trabajoCampoSolicitudIdSolicitud)
    {
        $this->trabajoCampoSolicitudIdSolicitud = $trabajoCampoSolicitudIdSolicitud;
    }

    /**
     * @return string
     */
    public function getFormularioRegistrado()
    {
        return $this->formularioRegistrado;
    }

    /**
     * @param string $formularioRegistrado
     */
    public function setFormularioRegistrado($formularioRegistrado)
    {
        $this->formularioRegistrado = $formularioRegistrado;
    }
}
