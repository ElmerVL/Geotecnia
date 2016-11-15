<?php

require_once('modulo/resultado/modelo/ResultadoModelo.php');

/**
 * Class ServicioRegistroResultado
 */
class ServicioRegistroResultado
{
    /**
     * @var resultadoDAO
     */
    private $resultadoDAO ;

    /**
     * @var solicitudDAO
     */
    private $solicitudDAO;

    /**
     * ServicioRegistroResultado constructor.
     * @param ResultadoDAO $resultado
     * @param SolicitudDAO $solicitud
     */
    public function __construct(ResultadoDAO $resultado, SolicitudDAO $solicitud)
    {
        $this->resultadoDAO = $resultado;
        $this->solicitudDAO = $solicitud;
    }

    public function registrar($nombreArchivo, $idSolicitud, $descripcion, $tipo)
    {
        $idResultado = $this->resultadoDAO->getIdResultadoParaInsertarDAO() + 1;

        $resultado = new ResultadoModelo();
        $resultado->setIdResultado($idResultado);
        $resultado->setSolicitudIdSolicitud($idSolicitud);
        $resultado->setNombreArchivo($nombreArchivo);
        $resultado->setDescripcion($descripcion);
        if ('InformeFinal' == $tipo) {
            $resultado->setInformeFinal('true');
            $resultado->setResultadoProyecto('false');
        } else {
            $resultado->setInformeFinal('false');
            $resultado->setResultadoProyecto('true');
        }
        
        $this->resultadoDAO->insertarResultadoDAO($resultado);
    }
}
