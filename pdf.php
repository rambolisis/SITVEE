<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
if(isset($_GET['idInfoCliente']) && isset($_GET['idInfoEvento']) && $_GET['idInfoCliente'] != 'null' && $_GET['idInfoEvento'] != 'null'){
	$clienteIdGestion = $_GET['idInfoCliente'];
	$eventoIdGestion = $_GET['idInfoEvento'];

	$html=file_get_contents_curl("http://localhost/SITVEE/reportes/reporteInvitacionEnviada.php?idInfoCliente=".$clienteIdGestion."&&idInfoEvento=".$eventoIdGestion."");

	// Instanciamos un objeto de la clase DOMPDF.
	$pdf = new DOMPDF();
	
	// Definimos el tamaño y orientación del papel que queremos.
	$pdf->set_paper("letter", "portrait");
	//$pdf->set_paper(array(0,0,104,250));
	
	// Cargamos el contenido HTML.
	$pdf->load_html($html);
	
	// Renderizamos el documento PDF.
	$pdf->render();
	
	// Enviamos el fichero PDF al navegador.
	$pdf->stream('Invitaciones.pdf');
}

function file_get_contents_curl($url) {
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}
?>