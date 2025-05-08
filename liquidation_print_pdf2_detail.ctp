<?php 
//App::import('Vendor', 'Facebook', array('file' => 'Facebook' . DS . 'src'. DS. 'facebook.php'));
//App::import('Vendor','tcpdf',array('file'=>'tcpdf/tcpdf.php'));
require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');


class xtcpdf extends TCPDF {
    //Page header
    public function Header() {
        
    }
    public function Footer() {
        
    }
}

$pdf = new xtcpdf($orientation='P', $unit='mm', 'a4', $unicode=true, 'UTF-8', $diskcache=false, $pdfa=false);

// set document information
$pdf->SetCreator('CoderFac');
$pdf->SetAuthor('Grupo Coder SAC');
$pdf->SetTitle('Factura Electrónica');
$pdf->SetSubject('www.coder.com.pe');
$pdf->SetKeywords('Factura Electronica, Grupo Coder SAC, Facturación, Desarrollo de Sistemas de Información');

//establecer margenes
$pdf->SetMargins(5, 20, 5);
$pdf->SetHeaderMargin(5);

//Indicamos la creación de nuevas paginas automaticas al crecer el contenido
$pdf->SetAutoPageBreak(true, 15);

//agregamos la primera hoja al pdf
$pdf->AddPage();

//cuerpo de la hoja
$pdf->SetY(3);		//cordenada Y
$pdf->SetFont('helvetica', 'N', 11);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'LIQUIDACION DE VENTA DIARIA', 0, 'C', 1, 1, '', '', true);
//$pdf->MultiCell(width, height, 'LIQUIDACION DE VENTA DIARIA', boderder, 'align', 1, 1, '', '', true);
$pdf->Ln(3);
// set some text for example
$fecha = 'Jueves, 13/07/2017';
$oficce = 'TERMINAL TERRESTRE - PUNO';
$user = 'Angel Salasar';

// Multicell test
$pdf->SetFont('helvetica', 'N', 8);
$pdf->MultiCell(10, 0, 'Fecha', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(45, 0, ': '.$fecha, 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(12, 0, 'Oficina', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(65, 0, ': '.$oficce, 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(12, 0, 'Usuario', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(55, 0, ': '.$user, 0, 'L', 1, 0, '', '', true);

$pdf->Ln(7);

//cabecera ventas
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(20, 0, 'FEC.VIAJE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15, 0, 'TURNO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(12, 0, 'BUS', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'RUTA', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15, 0, 'IMPORTE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(55, 0, 'PILOTO/COPILOTO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(11, 0, 'C/BUS', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(11, 0, 'VCA', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(11, 0, 'OCUP', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(11, 0, 'VDH', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(11, 0, 'LIBRE', 0, 'C', 1, 1, '', '', true);
//cabecera ventas
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'N', 8);
// set cell margins
//$pdf->setCellMargins(1, 1, 1, 1);
$pdf->setCellPaddings(1, 1, 1, 1);
$sumCordY=20;

//$pdf->MultiCell(20, 0, 'coder', 1, 'L', 0, 0, '', '', true);
for ($i=1; $i < 12; $i++) { 
	$pdf->MultiCell(20, 0, '27/07/2017', 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(15, 0, '01:22pm', 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(12, 0, '888', 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(25, 0, 'J.MALDONADO', 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(15, 0, '88888.88', 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell(55, 0, 'JOSE LUIS J../CHURATA SUC..', 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(11, 0, '888', 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(11, 0, '888', 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(11, 0, '888', 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(11, 0, '888', 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(11, 0, '888', 1, 'C', 0, 1, '', '', true);
	$sumCordY=$sumCordY+5.5;
	
}
$pdf->MultiCell(72, 0, 'TOTAL VENTAS HOY S/ ', 0, 'R', 0, 0, '', '', true);
$pdf->MultiCell(15, 0, '88888.88', 1, 'R', 0, 1, '', '', true);

$pdf->Ln(7);

//econmiendas/exesos/gastos
//FILA1
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(40, 0, 'ENCOMIENDAS', 0, 'C', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);
$pdf->Multicell(35, 0, 'EXCESOS', 0, 'C', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);
$pdf->Multicell(110, 0, 'GASTOS', 0, 'C', 0, 1, '', '', true);
//fila 2
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Multicell(20, 0, 'N/Bol', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(20, 0, 'Importe', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);//espacio
$pdf->Multicell(18, 0, 'N/Ctrl', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(17, 0, 'Importe', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);//espacio
$pdf->Multicell(10, 0, 'N°', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(15, 0, 'Bus', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(20, 0, 'Monto', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(70, 0, 'T/D - N° / Detalle / Autorización', 1, 'C', 0, 1, '', '', true);
//fila 3
$pdf->SetY($sumCordY+28.18);
//$pdf->Multicell(20, 0, 'coder', 1, 'C', 0, 0, '', '', true);
//1. Detalle ENCOMIENDAS
$sumCordYenco=0;
for ($i=0; $i < 7; $i++) {
	$pdf->setCellPaddings(1, 1, 1, 1);
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->Multicell(20, 0, '002-0012345', 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(20, 0, '10.00', 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio
	$sumCordYenco += 5.5;
}
//resumen ENCOMIENDAS
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(20, 0, 'Subtotal ', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, '8888.00', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio


//2. Detalle EXCESOS
$pdf->SetFont('helvetica', 'N', 8);
$pdf->SetY($sumCordY+28.18);
$sumCordYexce=0;
for ($i=0; $i < 12; $i++) {	
	$pdf->SetX(50);		//cordenada Y
	$pdf->Multicell(18, 0, '1501', 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(17, 0, '5.00', 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio
	$sumCordYexce += 5.5;
}
//resumen EXCESOS
$pdf->SetX(50);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(18, 0, 'Subtotal ', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(17, 0, '8888.00', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio

//3. Detalle GASTOS
$pdf->SetFont('helvetica', 'N', 8);
$pdf->SetY($sumCordY+28.18);
$sumCordYgasto=0;
for ($i=0; $i < 9; $i++) {	
	$pdf->SetX(90);		//cordenada Y
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->setCellPaddings(1, 1, 1, 1);
	$pdf->Multicell(10, 0, '88', 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(15, 0, '888', 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(20, 0, '8888.88', 1, 'C', 0, 0, '', '', true);
	$pdf->SetFont('helvetica', 'N', 6);
	$pdf->setCellPaddings(1, 2, 1, 1);
	$pdf->Multicell(70, 0, 'SDC-0012345 / DR. WALDIR (PAGO DE HONORARIOS / SR. OSCAR)', 1, 'C', 0, 1, '', '', true);
	$sumCordYgasto += 5.5;
}
//resumen GASTOS
$pdf->SetX(90);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(25, 0, 'Subtotal ', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, '8888.00', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'N', 6);
$pdf->setCellPaddings(1, 2.7, 1, 2);
$pdf->Multicell(70, 0, 'Fecha de impresion: MIERCOLES, 26/07/2017 a las 4:00 pm', 1, 'R', 0, 1, '', '', true);

//III. Resumen boletos vendidos
$maxCordY=max($sumCordYenco, $sumCordYexce, $sumCordYgasto);
$pdf->setY($maxCordY+$sumCordY+28.18+12);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->SetFont('helvetica', 'N', 10);
for ($i=0; $i < 4; $i++) { 
	# code...
	$pdf->Multicell(40, 0, 'Boletos de Viaje (016)', 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(45, 0, '0123456 ---> 0123456', 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(15, 0, '8888', 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(20, 0, '8888.99', 1, 'R', 0, 1, '', '', true);
}

$pdf->Multicell(40, 0, 'Boletos Venta', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(45, 0, '0123456 ---> 0123456', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(15, 0, '8888', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, '8888.99', 1, 'R', 0, 1, '', '', true);

$pdf->Multicell(40, 0, 'Boletos Encomiendas', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(45, 0, '0123456 ---> 0123456', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(15, 0, '8888', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, '8888.99', 1, 'R', 0, 1, '', '', true);

$pdf->Multicell(40, 0, 'Boletos Excesos', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(45, 0, '0123456 ---> 0123456', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(15, 0, '8888', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, '8888.99', 1, 'R', 0, 1, '', '', true);

$pdf->SetXY(130, $maxCordY+$sumCordY+28.18+12);
$pdf->Multicell(70, 0, 'RESUMEN DE DIA', 0, 'C', 0, 1, '', '', true);//titulo
//cuerpo
//SUB-TOTAL
$pdf->SetXY(130, $maxCordY+$sumCordY+28.18+12+6);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'SUB TOTAL S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, '88888.88', 1, 'R', 0, 0, '', '', true);
//GASTOS
$pdf->SetXY(130, $maxCordY+$sumCordY+28.18+12+6+6.4);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'GASTOS S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, '88888.88', 1, 'R', 0, 0, '', '', true);
//TOTAL
$pdf->SetXY(130, $maxCordY+$sumCordY+28.18+12+6+6.4+6.4);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'TOTAL S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, '88888.88', 1, 'R', 0, 0, '', '', true);
//end cuerpo de la hoja

$pdf->Output('name.pdf', 'I');
 ?>
 
