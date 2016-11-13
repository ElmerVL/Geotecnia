<?php

require_once('fpdf/fpdf.php');

/**
 * Class ServicioPDF
 */
class ServicioPDF
{
    /** @var solicitudDAO */
    private $solicitudDAO;

    /** @var ensayoLaboratorioDAO */
    private $ensayoLaboratorioDAO;

    /** @var muestraDAO */
    private $muestraDAO;

    /** @var trabajoCampoDAO */
    private $trabajoCampoDAO;

    /**
     * Constructor del servicio pdf.
     *
     * @param SolicitudDAO $solicitud
     * @param EnsayoLaboratorioDAO $ensayoLaboratorio
     * @param MuestraDAO $muestra
     * @param TrabajoCampoDAO $trabajoCampo
     */
    public function __construct(
        SolicitudDAO $solicitud,
        EnsayoLaboratorioDAO $ensayoLaboratorio,
        MuestraDAO $muestra,
        TrabajoCampoDAO $trabajoCampo
    ) {
        $this->solicitudDAO = $solicitud;
        $this->ensayoLaboratorioDAO = $ensayoLaboratorio;
        $this->muestraDAO = $muestra;
        $this->trabajoCampoDAO = $trabajoCampo;
    }

    /**
     * Función para crear un archivo .pdf a partir de los parametros reporte y año.
     *
     * @param string $reporte
     * @param string $anio
     */
    public function crearPDF($reporte, $anio)
    {
        $pdf = new FPDF();
        if ($anio !== 'todo') {
            if ($reporte === 'solicitud') {
                $this->crearSolicitud($pdf, $anio);
            }
            if ($reporte === 'ensayoLaboratorio') {
                $this->crearEnsayoLaboratorio($pdf, $anio);
            }
            if ($reporte === 'muestra') {
                $this->crearMuestra($pdf, $anio);
            }
            if ($reporte === 'trabajoCampo') {
                $this->crearTrabajoCampo($pdf, $anio);
            }
        } else {
            if ($reporte === 'solicitud') {
                $this->crearTodoSolicitud($pdf);
            }
            if ($reporte === 'ensayoLaboratorio') {
                $this->crearTodoEnsayoLaboratorio($pdf);
            }
            if ($reporte === 'muestra') {
                $this->crearTodoMuestra($pdf);
            }
            if ($reporte === 'trabajoCampo') {
                $this->crearTodoTrabajoCampo($pdf);
            }
        }
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte solicitud y por cierto año.
     *
     * @param FPDF $pdf
     * @param string $anio
     */
    public function crearSolicitud($pdf, $anio)
    {
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetXY(15, 10);
        $pdf->MultiCell(60, 7, ' LABORATORIO DE GEOTECNIA', 1, 'C', false);
        $pdf->SetXY(75, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(80, 14, ' LISTA DE SOLICITUDES', 1, 'C', false);
        $pdf->SetXY(155, 10);
        $pdf->MultiCell(40, 14, utf8_decode("AÑO: $anio"), 1, 'C', false);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(235, 235, 235);
        $pdf->SetXY(15, 25);
        $pdf->MultiCell(20, 10, utf8_decode('Código'), 1, 'C', true);
        $pdf->SetXY(35, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Nombre del proyecto'), 1, 'C', true);
        $pdf->SetXY(80, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Responsable'), 1, 'C', true);
        $pdf->SetXY(125, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Tipo de la solicitud'), 1, 'C', true);
        $pdf->SetXY(170, 25);
        $pdf->MultiCell(25, 5, utf8_decode('Fecha de la solicitud'), 1, 'C', true);
        $pdf->SetFont('Times', null, 11);

        $ultimaPosicion = 36;

        $listaSolicitud = $this->solicitudDAO->getSolicitudPorAnioDAO($anio);

        for ($i = 0; $i < sizeof($listaSolicitud); $i = $i + 8) {
            $pdf->SetXY(15, $ultimaPosicion);
            $pdf->MultiCell(20, 6, utf8_decode($listaSolicitud[$i + 1]), 1, 'C', false);
            $pdf->SetXY(35, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 2]), 1, 'C', false);
            $pdf->SetXY(80, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 6]), 1, 'C', false);
            $pdf->SetXY(125, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 4]), 1, 'C', false);
            $pdf->SetXY(170, $ultimaPosicion);
            $pdf->MultiCell(25, 6, utf8_decode($listaSolicitud[$i + 7]), 1, 'C', false);

            $ultimaPosicion = $ultimaPosicion + 6;
        }

        $pdf->Output("../prueba.pdf");
        echo "<script language='javascript'>window.open('../prueba.pdf','_self');</script>"; //para ver el archivo pdf
        exit;
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte ensayo de laboratorio y  por cierto año.
     *
     * @param FPDF $pdf
     * @param string $anio
     */
    public function crearEnsayoLaboratorio($pdf, $anio)
    {
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte muestra y por cierto año.
     *
     * @param FPDF $pdf
     * @param string $anio
     */
    public function crearMuestra($pdf, $anio)
    {
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte trabajo de campo y por cierto año.
     *
     * @param FPDF $pdf
     * @param string $anio
     */
    public function crearTrabajoCampo($pdf, $anio)
    {
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte solicitud y por todos los años.
     *
     * @param FPDF $pdf
     */
    public function crearTodoSolicitud($pdf)
    {
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetXY(15, 10);
        $pdf->MultiCell(60, 7, ' LABORATORIO DE GEOTECNIA', 1, 'C', false);
        $pdf->SetXY(75, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(80, 14, ' LISTA DE SOLICITUDES', 1, 'C', false);
        $pdf->SetXY(155, 10);
        $pdf->MultiCell(40, 7, utf8_decode("ULTIMOS 3 AÑOS"), 1, 'C', false);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(235, 235, 235);
        $pdf->SetXY(15, 25);
        $pdf->MultiCell(20, 10, utf8_decode('Código'), 1, 'C', true);
        $pdf->SetXY(35, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Nombe del proyecto'), 1, 'C', true);
        $pdf->SetXY(80, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Responsable'), 1, 'C', true);
        $pdf->SetXY(125, 25);
        $pdf->MultiCell(45, 10, utf8_decode('Tipo de la solicitud'), 1, 'C', true);
        $pdf->SetXY(170, 25);
        $pdf->MultiCell(25, 5, utf8_decode('Fecha de la solicitud'), 1, 'C', true);
        $pdf->SetFont('Times', null, 11);

        $ultimaPosicion = 36;

        $listaSolicitud = $this->solicitudDAO->getSolicitudDAO();

        for ($i = 0; $i < sizeof($listaSolicitud); $i = $i + 8) {
            $pdf->SetXY(15, $ultimaPosicion);
            $pdf->MultiCell(20, 6, utf8_decode($listaSolicitud[$i + 1]), 1, 'C', false);
            $pdf->SetXY(35, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 2]), 1, 'C', false);
            $pdf->SetXY(80, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 6]), 1, 'C', false);
            $pdf->SetXY(125, $ultimaPosicion);
            $pdf->MultiCell(45, 6, utf8_decode($listaSolicitud[$i + 4]), 1, 'C', false);
            $pdf->SetXY(170, $ultimaPosicion);
            $pdf->MultiCell(25, 6, utf8_decode($listaSolicitud[$i + 7]), 1, 'C', false);

            $ultimaPosicion = $ultimaPosicion + 6;
        }

        $pdf->Output("../prueba.pdf");

        echo "<script language='javascript'>window.open('../prueba.pdf','_self');</script>"; //para ver el archivo pdf
        exit;
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte ensayo de laboratorio y por todos los años.
     *
     * @param FPDF $pdf
     */
    public function crearTodoEnsayoLaboratorio($pdf)
    {
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte muestra y por todos los años.
     *
     * @param FPDF $pdf
     */
    public function crearTodoMuestra($pdf)
    {
    }

    /**
     * Función para crear un archivo .pdf a partir de un tipo de reporte trabajo de campo y por todos los años.
     *
     * @param FPDF $pdf
     */
    public function crearTodoTrabajoCampo($pdf)
    {
    }
}
