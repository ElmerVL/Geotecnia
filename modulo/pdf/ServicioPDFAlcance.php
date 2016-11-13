<?php

require_once ('modulo/alcance/dao/AlcanceDAO.php');
require_once ('html2pdf/html2pdf.class.php');

class ServicioPDFAlcance
{
    public function crearPDF($idTrabajoCampo)
    {
        $alcanceDao = new AlcanceDAO();
        $alcance = $alcanceDao->recuperarAlcanceDAO($idTrabajoCampo);
        $antecedente = $alcance->getAntecedente();
        $objetivo = $alcance->getObjetivo();
        $duracion = $alcance->getDuracion();
        $precio = $alcance->getPrecio();
        $formaPago = $alcance->getFormaPago();
        $requerimientoAdicional = $alcance->getRequerimientoAdicional();
        $trabajoCampo = $alcance->getTrabajoCampo();
        $trabajoLaboratorio =$alcance->getTrabajoLaboratorio();
        $trabajoGabinete = $alcance->getTrabajoGabinete();
        $ruta = Conexion::ruta();
        $content = "
<page backtop=\"25mm\" backbottom=\"20mm\" backleft=\"20mm\" backright=\"20mm\" >
    
    <page_header>
        <table style=\"width: 100%; border: none;\">
            <tr>
                <td style=\"text-align: left;    width: 33%\"><img src=\"$ruta/images/fcyt.jpg\" alt=\"An image\" /></td>
                <td style=\"text-align: center;    width: 34%\">UNIVERSIDAD MAYOR DE SAN SIMON<br />FACULTAD DE CIENCIAS Y TECNOLOGIA<br />
                                                                LABORATORIO DE GEOTECNIA</td>
                <td style=\"text-align: right;    width: 33%\"><img src=\"$ruta/images/logo2.png\" alt=\"An image\" /></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style=\"width: 100%; border: none;\">
            <tr>
                <td style=\"text-align: left;    width: 33%\">Av. Petrolera, Km. 4,2<br />Casilla 6760</td>
                <td style=\"text-align: right;    width: 34%\">Cochabamba – Bolivia</td>
                <td style=\"text-align: right;    width: 34%\">Teléfono/Fax : +/591/(0)4+4236858<br />e-mail: gtumss@fcyt.umss.edu.bo</td>
            </tr>
        </table>
    </page_footer>
    <h1 style=\"text-align: center;\">ALCANCE DE TRABAJO</h1>
            <h4>1. Antecedente</h4> $antecedente
<h4>2. Objetivo</h4><p> $objetivo </p>

<h4>3. Trabajos a realizar</h4>
<h4>3.1 Trabajo de campo.</h4>
    <p> $trabajoCampo </p>
<h4>3.2 Trabajo de gabinete.</h4>
    <p> $trabajoGabinete </p>
<h4>3.3 Trabajo de laboratorio.</h4>
    <p> $trabajoLaboratorio </p>

<h4>4. Inicio y duración</h4>
<p>El inicio de los trabajos de campo será programado de acuerdo a la disponibilidad
de personal y equipo del Laboratorio de Geotecnia. El estudio tendrá una duración 
de $duracion calendario después de haber iniciado el trabajo de campo.</p>
<h4>5. Precio del estudio</h4>
<p>El precio total del trabajo descrito
es de Bs. $precio que incluye los gastos de movilización, 
desmovilización, instalación del equipo, suministro de materiales y herramientas. 
El precio estipulado incluye los impuestos de ley.</p>
<h4>6. Forma de pago</h4>
<p> $formaPago </p>
<h4>7. Requerimientos adicionales</h4>
$requerimientoAdicional

</page>";


        $html2pdf = new HTML2PDF('P','A4','fr');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('exemple.pdf');
        //header('Location: '.Conexion::ruta().'?accion=alcancePdf&TC='.$idTrabajoCampo.'&ANTECEDENTE='.$alcance->getAntecedente().'&OBJETIVO='.$alcance->getObjetivo().'&TRABAJO_CAMPO='.$alcance->getTrabajoCampo().'&TRABAJO_GABINETE='.$alcance->getTrabajoGabinete() .'&TRABAJO_LABORATORIO='.$alcance->getTrabajoLaboratorio() .'&DURACION='.$alcance->getDuracion() .'&PRECIO='.$alcance->getPrecio() .'&FORMA_PAGO='.$alcance->getFormaPago() .'&ADICIONALES='.$alcance->getRequerimientoAdicional());
    }
}
?>
