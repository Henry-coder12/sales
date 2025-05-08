<?php 
use Cake\Routing\Router;
//App::import('Vendor', 'Facebook', array('file' => 'Facebook' . DS . 'src'. DS. 'facebook.php'));
//App::import('Vendor','tcpdf',array('file'=>'tcpdf/tcpdf.php'));
//require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf_include.php');
require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');



class xtcpdf extends TCPDF {
    //Page header
    public function Header() {
        // Logo
        //$url=$this->Url->build('/');
        $image_file = 'http://127.0.0.1/'.Router::url('/img/logo.png');
        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 8, 3, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->Ln(6);
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'GRUPO CODER SAC', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
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
$pdf->SetFont('helvetica','B',14);
$pdf->Cell(60);
$pdf->Cell(10,6,'LIQUIDACIÓN DE VENTA');

//Variable Altura
//Variable Altura
$pdf->Ln(6);

//$pdf->cuadro('OFICINA:  '.$oficina,10,20+$Y,"L",60); 
//$pdf->cuadro("DÍA:  ".$dia,76,20+$Y,"L",60);
//$pdf->cuadro("FECHA:  ".$fecha,142,20+$Y,"L",60);
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(3,3,3)));
$pdf->RoundedRect(10, 30, 85, 10, 3.5, '1111', '');
$pdf->RoundedRect(100, 30, 40, 10, 3.5, '1111', '');
$pdf->RoundedRect(145, 30, 55, 10, 3.5, '1111', '');

$pdf->Ln(6);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(10,6,'');
$pdf->Cell(90,6,'OFICINA:',0,0,'L');
$pdf->Cell(45,6,'DÍA:',0,0,'L');
$pdf->Cell(50,6,'FECHA:',0,0,'L');
$pdf->ln(2);
// set some text for example
$fecha = 'Jueves, 13/07/2017';
$oficce = 'TERMINAL TERRESTRE - PUNO';
$user = 'Angel Salasar';
/****************** SISTEMA *******************************/
$pdf->Ln(8);
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(190,6,'BOLETOS DE SISTEMA',0,0);


$pdf->Ln(6);
$pdf->SetFont('helvetica','B',9);
$pdf->Cell(10,6,'');
$pdf->Cell(30,6,'SERIES',0,0,'C');
$pdf->Cell(9,6,'');
$pdf->Cell(40,6,'DEL Nº',0,0,'C');
$pdf->Cell(9,6,'');
$pdf->Cell(40,6,'AL Nº',0,0,'C');
$pdf->Cell(9,6,'');
$pdf->Cell(40,6,'TOTAL S/.',0,0,'C');


//series
$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'B001',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000001',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000123',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('3412',2),1,0,'R');

$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'B001',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000001',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000123',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('3412',2),1,0,'R');

$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'B001',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000001',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000123',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('3412',2),1,0,'R');


//total ventas 
$pdf->Ln(6);
$pdf->Cell(138,5,'TOTAL S/.',0,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('123423',2),1,0,'R');

/****************** RUTA *******************************/
$pdf->Ln(2);
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(190,6,'BOLETOS DE RUTA',0,0);

$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'B002',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000001',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'002342',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('1253',2),1,0,'R');

$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'B002',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'000001',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'002342',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('1253',2),1,0,'R');

$pdf->Ln(6);
$pdf->Cell(138,5,'TOTAL S/.',0,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('6565765',2),1,0,'R');

//excesos
$pdf->Ln(2);
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(190,6,'BOLETOS DE EXCESO',0,0);

$pdf->Ln(6);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(10,5,'');
$pdf->Cell(30,5,'001',1,0,'C');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'123',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,'5342',1,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('12322',2),1,0,'R');


$pdf->Ln(6);
$pdf->Cell(138,5,'TOTAL S/.',0,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('124112',2),1,0,'R');
// TOTAL VENTAS
$tota_ventas='1234112';
$pdf->Ln(8);
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(138,5,'TOTAL INGRESOS S/.',0,0,'R');
$pdf->Cell(9,5,'');
$pdf->Cell(40,5,number_format('532348',2),1,0,'R');

//ventas por personal
//$pdf->SetY(100);
$pdf->Ln(8);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,6,'VENTAS POR PERSONAL');
$pdf->SetFont('helvetica','B',9);
$pdf->Ln(5);
$pdf->Cell(70,5,'Nombres',0,0,'L');
$pdf->Cell(20,5,'Serie',0,0,'C');
$pdf->Cell(20,5,'Cantidad',0,0,'C');
$pdf->Cell(20,5,'Total',0,0,'R');
$pdf->Cell(20,5,'Excesos',0,0,'R');
$pdf->Cell(20,5,'Gastos',0,0,'R');
$pdf->Cell(20,5,'Efectivo',0,0,'R');


$pdf->Ln(5);
$pdf->SetFont('helvetica','',9);
$pdf->Cell(8,5,'1.-',0,0,'R',0);
$pdf->Cell(62,5,'jefferson job la torre flores ',0,0,'L',0);
$pdf->Cell(20,5,'003',0,0,'C',0);
$pdf->Cell(20,5,number_format('7',0),0,0,'C',0); //cantidad
$pdf->Cell(20,5,number_format('105',2),0,0,'R',0); //total ventas
$pdf->Cell(20,5,number_format('0',2),0,0,'R'); //gastos en excesos
$pdf->Cell(20,5,number_format('231',2),0,0,'R'); //total gastos
$pdf->Cell(20,5,number_format('12331',2),0,0,'R'); //total efectivo

$pdf->Ln(5);
$pdf->SetFont('helvetica','',9);
$pdf->Cell(8,5,'2.-',0,0,'R',0);
$pdf->Cell(62,5,'jefferson job la torre flores ',0,0,'L',0);
$pdf->Cell(20,5,'003',0,0,'C',0);
$pdf->Cell(20,5,number_format('7',0),0,0,'C',0); //cantidad
$pdf->Cell(20,5,number_format('105',2),0,0,'R',0); //total ventas
$pdf->Cell(20,5,number_format('0',2),0,0,'R'); //gastos en peaje
$pdf->Cell(20,5,number_format('231',2),0,0,'R'); //total gastos
$pdf->Cell(20,5,number_format('12331',2),0,0,'R'); //total efectivo


$pdf->Ln(6);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(110,5,'TOTALES S/.',0,0,'R');
$pdf->Cell(20,5,number_format('32234',2),'T',0,'R');
$pdf->Cell(20,5,number_format('12331',2),'T',0,'R');
$pdf->Cell(20,5,number_format('2321',2),'T',0,'R');
$pdf->Cell(20,5,number_format('122123',2),'T',0,'R');


// TOTALES

$pdf->Ln(10);
$pdf->SetFont('helvetica','B',10);
$pdf->Cell(50,7,'TOTAL VENTAS S/.',0,0,'C');
$pdf->Cell(20,7,' ',0,0,'R');
$pdf->Cell(50,7,'TOTAL GASTOS S/.',0,0,'C');
$pdf->Cell(20,7,'',0,0,'R');
$pdf->Cell(50,7,'TOTAL NETO S/.',0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(50,7,number_format('1232',2),1,0,'R');
$pdf->Cell(20,7,' ',0,0,'R');
$pdf->Cell(50,7,number_format('24123',2),1,0,'R');
$pdf->Cell(20,7,'',0,0,'R');
$pdf->Cell(50,7,number_format('3243',2),1,0,'R');

//pagina de gatos
$pdf->AddPage('L', 'A4');
$pdf->SetFont('helvetica','',6);
$miinfo='esto es un texto muy muy largo esto es un texto muy muy largo esto es un texto muy muy largo esto es un texto muy muy largo esto es un texto muy muy largo esto es un texto muy muy largo esto es un texto muy muy cubrid_load_from_glo(esto es un texto muy muy cubrid_load_from_glo(esto es un texto muy muy ';
$tbl = '
<table border="1" cellpadding="1" cellspacing="0" nobr="false">
	<tr style="background-color:#00ddff;color:#000000;">
	  <td width="30" align="center"><b>FECHA</b></td>
	  <td width="70" align="center"><b>TIPO DE OPERACION</b></td>
	  <td width="40" align="center"><b>RECIBO DE CAJA</b></td>
	  <td width="30" align="center"><b>TIPO DOC</b></td>
	  <td width="30" align="center"><b>SERIE</b></td>
	  <td width="50" align="center"> <b>Nro COMPROBANTE</b></td>
	  <td width="50" align="center"><b>RUC</b></td>
	  <td width="80" align="center"><b>PROVEEDOR</b></td>
	  <td width="20" align="center"><b>CANT</b></td>
	  <td width="150" align="center"><b>DESCRIPCION</b></td>
	  <td width="50" align="center"><b>PRECIO UNIT</b></td>
	  <td width="50" align="center"><b>PLACA</b></td>
	  <td width="50" align="center"><b>AUTORIZADO</b></td>
	  <td width="50" align="center"><b>RESPONSABLE</b></td>
	  <td width="50" align="center"><b>TOTAL</b></td>
	</tr> ';

	for ($i=0; $i <30 ; $i++) { 
		$tbl .='	<tr>
			  <td width="30" align="center">12/12/12 9:00pm</td>
			  <td width="70" align="center">VIATICOS DE PERSONAL</td>
			  <td width="40" align="center">123212</td>
			  <td width="30" align="center">03</td>
			  <td width="30" align="center">001</td>
			  <td width="50" align="center">42423</td>
			  <td width="50" align="center">20448179375</td>
			  <td width="80" align="center">GRUPO CODER SAC</td>
			  <td width="20" align="center">20 </td>
			  <td width="150" align="center">'.$miinfo.'</td>
			  <td width="50" align="center">12</td>
			  <td width="50" align="center">CFV-342</td>
			  <td width="50" align="center">Sr. Wilbert quispe cabna</td>
			  <td width="50" align="center">Jefferson</td>
			  <td width="50" align="center">118.00</td>
			</tr>';
	}
$tbl .='</table>';


$pdf->writeHTML($tbl, true, false, false, false, '');


	# code...



//otra pagina

$pdf->AddPage('P', 'A4');

$pdf->SetFont('helvetica','B',12);

$pdf->Cell(30);
$pdf->Cell(800,4,'DETALLE DE VENTAS DE PASAJE POR PERSONAL SEGUN SERIE');

$pdf->SetFont('helvetica','B',9);
$pdf->Ln(10);
$pdf->Cell(70,5,'Nombres',0,0,'L');
$pdf->Cell(20,5,'Serie',0,0,'C');
$pdf->Cell(20,5,'desde',0,0,'R');
$pdf->Cell(20,5,'hasta',0,0,'R');
$pdf->Cell(20,5,'Cantidad',0,0,'C');
$pdf->Cell(20,5,'anulados',0,0,'R');
$pdf->Cell(20,5,'Efectivo',0,0,'R');

$userSelect=0;
$contarItems=0;
$contarCantidad=0;
$contarAnulados=0;
$contarMontos=0;
foreach ($resumen_pas_2 as $key => $value) {
	$pdf->Ln(5);
	$pdf->SetFont('helvetica','',8);
	if ($userSelect==0 or $userSelect<>$value->user_id) {
		$pdf->Cell(70,5, strtoupper($value->user->names.' '.$value->user->surnames) ,0,0,'L',0);
		if ($userSelect==0) {
			$contarCantidad=$contarCantidad+$value->cantidad;
			$contarAnulados=$contarAnulados+($value->cantidad-$resumen_pas_total_2[$key]->toArray()[0]->cantidad);
			$contarMontos=$contarMontos+$resumen_pas_total_2[$key]->toArray()[0]->total;
		}else{
			$contarCantidad=$value->cantidad;
			$contarAnulados=$value->cantidad-$resumen_pas_total_2[$key]->toArray()[0]->cantidad;
			$contarMontos=$resumen_pas_total_2[$key]->toArray()[0]->total;
		}
	}else{
		$pdf->Cell(70,5, ' ' ,0,0,'L',0);
		$contarCantidad=$contarCantidad+$value->cantidad;
		$contarAnulados=$contarAnulados+($value->cantidad-$resumen_pas_total_2[$key]->toArray()[0]->cantidad);
		$contarMontos=$contarMontos+$resumen_pas_total_2[$key]->toArray()[0]->total;
	}
		
	$pdf->Cell(20,5,$value->serie,0,0,'C',0);
	$pdf->Cell(20,5,$value->inicial,0,0,'R'); //desde
	$pdf->Cell(20,5,$value->final,0,0,'R'); //hasta
	$pdf->Cell(20,5,$value->cantidad,0,0,'C',0); //cantidad
	$pdf->Cell(20,5,$value->cantidad-$resumen_pas_total_2[$key]->toArray()[0]->cantidad,0,0,'R',0); //total ventas
	$pdf->Cell(20,5,number_format($resumen_pas_total_2[$key]->toArray()[0]->total,2),0,0,'R'); //total efectivo
	
	/*
	if ($userSelect<>0 or $userSelect==$value->user_id) {	
		$pdf->Ln(5);
		$pdf->SetFont('helvetica','B',8);
		$pdf->Cell(50,5,'',0,0,'L',0);
		$pdf->Cell(30,5,'',0,0,'R'); //desde
		$pdf->Cell(30,5,'',0,0,'R'); //hasta
		$pdf->Cell(20,5,'TOTAL','B',0,'R',0);
		$pdf->Cell(20,5,$contarCantidad,'B',0,'C',0); //cantidad
		$pdf->Cell(20,5,$contarAnulados,'B',0,'R',0); //total ventas
		$pdf->Cell(20,5,number_format($contarMontos,2),'B',0,'R'); //total efectivo
	}
	*/
	$userSelect=$value->user_id;

}




$pdf->Ln(12);
$pdf->Cell(190,4,'ANULACIONES DE PASAJES POR DETALLE','B',0,'C');
$pdf->SetFont('helvetica','',9);


foreach ($ventas_pasajes_anulados as $key => $value) {
	$pdf->Ln(5);
	$pdf->Cell(10,5,$key+1,0,0,'C',0);
	$pdf->Cell(70,5,strtoupper($value->user->names.' '.$value->user->surnames),0,0,'L',0);
	$pdf->Cell(35,5,$value->serie.'-'.$value->number,0,0,'L',0);
	$pdf->Cell(10,5,number_format($value->price,2),0,0,'R',0);
	$pdf->Cell(40,5,$value->modified->format('d-m-Y H:i:s'),0,0,'R',0);
}



$pdf->Output('name.pdf', 'I');
 ?>
 
