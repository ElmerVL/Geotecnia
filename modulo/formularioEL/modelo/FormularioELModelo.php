<?php

/**
 * Class FormularioELModelo
 */
class FormularioELModelo
{
    /**@var int $clienteIdCliente */
    private $clienteIdCliente;

    /**@var int $ensayoLaboratorioSolicitudIdSolicitud */
    private $ensayoLaboratorioSolicitudIdSolicitud;

    /**@var string $formularioRegistrado */
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
    public function getEnsayoLaboratorioSolicitudIdSolicitud()
    {
        return $this->ensayoLaboratorioSolicitudIdSolicitud;
    }

    /**
     * @param int $ensayoLaboratorioSolicitudIdSolicitud
     */
    public function setEnsayoLaboratorioSolicitudIdSolicitud($ensayoLaboratorioSolicitudIdSolicitud)
    {
        $this->ensayoLaboratorioSolicitudIdSolicitud = $ensayoLaboratorioSolicitudIdSolicitud;
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