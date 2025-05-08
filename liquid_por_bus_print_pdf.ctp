<?php 
//App::import('Vendor', 'Facebook', array('file' => 'Facebook' . DS . 'src'. DS. 'facebook.php'));
//App::import('Vendor','tcpdf',array('file'=>'tcpdf/tcpdf.php'));
require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');

function fechaCastellano ($fecha) {
  	$fecha = substr($fecha, 0, 10);
  	$numeroDia = date('d', strtotime($fecha));
  	$dia = date('l', strtotime($fecha));
  	$mes = date('F', strtotime($fecha));
  	$anio = date('Y', strtotime($fecha));
  	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
	$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  	return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

class xtcpdf extends TCPDF {
	var $first_name;
    //Page header
    public function Header() {
        
    }
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 7);
        // Page number
        $this->Cell(0, 10, '* '.$this->first_name, 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
    }
}

$pdf = new xtcpdf($orientation='P', $unit='mm', 'a4', $unicode=true, 'UTF-8', $diskcache=false, $pdfa=false);

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

$pdf->Ln(3);
//cuerpo de la hoja
$pdf->SetY(3);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'LIQUIDACION DIARIA DE BUS     ( '.$fndSales[0]['buses']['plate'].' )', 0, 'C', 1, 1, '', '', true);

$pdf->Ln(2);
//$pdf->SetY(5);		//cordenada Y
$pdf->SetFont('helvetica', 'N', 9);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(40, 0, 'FECHA DE VIAJE', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(60, 0, ': '.date('d/m/Y',strtotime($fndPro_varDate)), 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, 'HORARIO', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, ': '.date('g:i a',strtotime($fndPro_varHour)), 0, 'L', 1, 0, '', '', true);

$pdf->Ln();
$route_exp 	= explode('-', $fndSales[0]['routes']['name']);
$pdf->MultiCell(40, 0, 'ORIGEN', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(60, 0, ': '.$route_exp[0] , 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, 'DESTINO', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, ': '.$route_exp[1] , 0, 'L', 1, 0, '', '', true);

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'PASAJES', 0, 'L', 1, 0, '', '', true);

$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 6);
//$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->MultiCell(8, 3, 'N°', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 3, 'B/VIAJE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(18, 3, 'IMPORTE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(8, 3, 'N°', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 3, 'B/VIAJE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(18, 3, 'IMPORTE', 1, 'C', 1, 0, '', '', true);

$pdf->SetFont('helvetica', 'N', 7);
$num=0;
$sumSales_1	= 0;
foreach ($fndSales as $key => $value) {
	if ($key<55){
		$num+=1;
		$pdf->Ln();
		$pdf->SetFont('helvetica', 'N', 8);
		//$pdf->setCellPaddings(1, 1, 1, 1);
		$pdf->MultiCell(8, 4, $num, 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, $value['sales']['serie'].'-'.str_pad($value['sales']['number'], '7', STR_PAD_LEFT, '0'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(18, 4, number_format($value['sales']['price'], 2), 1, 'C', 1, 0, '', '', true);	
		$sumSales_1	+= $value['sales']['price'];
	}	
}
//subtotal1
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 10);
$pdf->MultiCell(30, 0, 'SUBTOTAL', 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(18, 0, number_format($sumSales_1, 2), 1, 'R', 1, 0, '', '', true);

$num=55;
$cordY=25.8;
$sumSales_2	= 0;
foreach ($fndSales as $key => $value) {
	if ($key>=55){
		$pdf->SetXY(53,$cordY);
		$num+=1;

		$pdf->SetFont('helvetica', 'N', 8);
		//$pdf->setCellPaddings(1, 1, 1, 1);
		$pdf->MultiCell(8, 4, $num, 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, $value['sales']['serie'].'-'.str_pad($value['sales']['number'], '7', STR_PAD_LEFT, '0'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(18, 4, number_format($value['sales']['price'], 2), 1, 'C', 1, 0, '', '', true);	
		$pdf->Ln();
		$cordY+=4;
		$sumSales_2	+= $value['sales']['price'];
	}	
}
//SUBTOTAL2
$pdf->SetXY(53, 245.8);
if ($key>38) {	
	$pdf->SetFont('helvetica', 'B', 10);
	$pdf->MultiCell(30, 0, 'SUBTOTAL', 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(18, 0, number_format($sumSales_2, 2), 1, 'R', 1, 0, '', '', true);
}
//TOTAL
$sumSalesTotal	= $sumSales_1+$sumSales_2;
$pdf->Ln();
$pdf->MultiCell(78, 0, 'VENTA TOTAL', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(18, 0, number_format($sumSalesTotal, 2), 1, 'R', 1, 0, '', '', true);

//RESUMEN
/*$pdf->Ln(10);
$pdf->MultiCell(48, 0, 'INGRESOS: ', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(48, 0, '88888.88', 1, 'R', 1, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(48, 0, '', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(48, 0, '88888.88', 1, 'R', 1, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(48, 0, '', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(48, 0, '88888.88', 1, 'R', 1, 0, '', '', true);*/

//------------------------------
//COLUMNA DE ENCOMIENDAS
//------------------------------
//$pdf->Ln();

//a. FACTURAS ENCOMIENDAS
$cordYfe	= 17.3;		//cordenada Y factura encomienda
$cordYln	= 4;	//cordenada Y salto de linea
$cordXfe	= 107;		//cordenada X factura encomienda
$pdf->SetXY($cordXfe, $cordYfe);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'ENCOMIENDAS', 0, 'L', 1, 0, '', '', true);

$pdf->Ln();
$pdf->SetXY($cordXfe, $cordYfe+$cordYln);
$pdf->SetFont('helvetica', 'B', 8);
//$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->MultiCell(22, 4, 'N°/FACTURA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'IMPORTE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'N°/FACTURA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'IMPORTE', 1, 'C', 1, 0, '', '', true);

$pdf->SetFont('helvetica', 'N', 8);
//menores a 5 documentos
$cordY	= $cordYfe+($cordYln*2);
$sumComFac_1	= 0;
foreach ($fndCommend as $key => $value) {
	if ($key<27) {
		$pdf->SetXY($cordXfe,$cordY);		
		$pdf->MultiCell(22, 4, $value['serie'].'-'.str_pad($value['number'], '7', STR_PAD_LEFT, '0'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, number_format($value['total'], 2), 1, 'C', 1, 0, '', '', true);
		$cordY 			+= $cordYln;
		$sumComFac_1	+= $value['total'];
	}
}

//mayores a 5 documentos
$cordXfe	= $cordXfe+44;
$cordY		= $cordYfe+($cordYln*2);
$sumComFac_2	= 0;
foreach ($fndCommend as $key => $value) {
	if ($key>=27 AND $key<54) {
		$pdf->SetXY($cordXfe,$cordY);		
		$pdf->MultiCell(22, 4, $value['serie'].'-'.str_pad($value['number'], '7', STR_PAD_LEFT, '0'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, number_format($value['total'], 2), 1, 'C', 1, 0, '', '', true);
		$cordY 			+= $cordYln;
		$sumComFac_2	+= $value['total'];
	}
}





//---totales BOLETA
$pdf->Ln();
$pdf->SetXY($cordXfe-44, $cordYfe+116);	//38
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(22, 0, 'SUBTOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumComFac_1, 2), 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, 'SUBTOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumComFac_2, 2), 1, 'C', 1, 0, '', '', true);

$sumaTotalComBol	= $sumComFac_1+$sumComFac_2;
$pdf->SetXY($cordXfe, $cordYfe+120);
$pdf->MultiCell(22, 0, 'TOTAL', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumaTotalComBol, 2), 1, 'C', 1, 0, '', '', true);
//-------------------

//c. EXCESOS
$cordYfe	= 145;		//cordenada Y factura encomienda
$cordYln	= 4;	//cordenada Y salto de linea
$cordXfe	= 107;		//cordenada X factura encomienda
$pdf->SetXY($cordXfe, $cordYfe);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'EXCESOS', 0, 'L', 1, 0, '', '', true);

$pdf->Ln();
$pdf->SetXY($cordXfe, $cordYfe+$cordYln);
$pdf->SetFont('helvetica', 'B', 8);
//$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->MultiCell(22, 4, 'N°/FACTURA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'IMPORTE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'N°/FACTURA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 4, 'IMPORTE', 1, 'C', 1, 0, '', '', true);

$pdf->SetFont('helvetica', 'N', 8);
//menores a 5 documentos
$cordY	= $cordYfe+($cordYln*2);
$sumInc_1	= 0;
foreach ($fndIncomes as $key => $value) {
	$incDoc	= $value['doc'];
	if ($incDoc=='12') {
		$incDocRes	= str_pad($value['number'], '7', STR_PAD_LEFT, '0').' '.'(t)';
	}else{
		$incDocRes	= $value['serie'].'-'.str_pad($value['number'], '7', STR_PAD_LEFT, '0').' '.'';
	}
	if ($key<13) {
		$pdf->SetXY($cordXfe,$cordY);		
		$pdf->MultiCell(22, 4, $incDocRes, 1, 'L', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, number_format($value['total'], 2), 1, 'C', 1, 0, '', '', true);
		$cordY 			+= $cordYln;
		$sumInc_1	+= $value['total'];
	}
}

//mayores a 5 documentos
$cordXfe	= $cordXfe+44;
$cordY		= $cordYfe+($cordYln*2);
$sumInc_2	= 0;
foreach ($fndIncomes as $key => $value) {
	$incDoc	= $value['doc'];
	if ($incDoc=='12') {
		$incDocRes	= str_pad($value['number'], '7', STR_PAD_LEFT, '0').' '.'(t)';
	}else{
		$incDocRes	= $value['serie'].'-'.str_pad($value['number'], '7', STR_PAD_LEFT, '0').' '.'';
	}
	if ($key>=13 AND $key<26) {
		$pdf->SetXY($cordXfe,$cordY);		
		$pdf->MultiCell(22, 4, $incDocRes, 1, 'L', 1, 0, '', '', true);
		$pdf->MultiCell(22, 4, number_format($value['total'], 2), 1, 'C', 1, 0, '', '', true);
		$cordY 			+= $cordYln;
		$sumInc_2		+= $value['total'];
	}
}

//---totales EXCESOS
$pdf->Ln();
$pdf->SetXY($cordXfe-44, $cordYfe+60);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(22, 0, 'SUBTOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumInc_1, 2), 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, 'SUBTOTAL', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumInc_2, 2), 1, 'C', 1, 0, '', '', true);

$sumaTotalInc	= $sumInc_1+$sumInc_2;
$pdf->SetXY($cordXfe, $cordYfe+64);
$pdf->MultiCell(22, 0, 'TOTAL', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(22, 0, number_format($sumaTotalInc, 2), 1, 'C', 1, 0, '', '', true);
//-------------------


//sumar ingresos
$ingresos 	= $sumSalesTotal+$sumaTotalComBol+$sumaTotalInc;

//para sumar los egresos
$egresos	= 0;
foreach ($fndExpenses as $key => $value) {
	$egresos	+= $value->amount;
}
//diferencia
$diferencia = $ingresos-$egresos;
$pdf->Ln(13);
$pdf->SetX(139);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->MultiCell(56, 0, 'RESUMEN', 0, 'C', 1, 0, '', '', true);
$pdf->Ln();
$pdf->SetX(139);
$pdf->MultiCell(28, 0, 'INGRESOS: ', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(28, 0, number_format($ingresos, 2), 1, 'R', 1, 0, '', '', true);
$pdf->Ln();
$pdf->SetX(139);
$pdf->MultiCell(28, 0, 'EGRESOS: ', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(28, 0, number_format($egresos,2), 1, 'R', 1, 0, '', '', true);
$pdf->Ln();
$pdf->SetX(139);
$pdf->MultiCell(28, 0, "$porcentaje %: ", 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(28, 0, number_format($diferencia*($porcentaje/100),2), 1, 'R', 1, 0, '', '', true);
$pdf->Ln();
$pdf->SetX(139);
$pdf->MultiCell(28, 0, 'DIFERENCIA: ', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(28, 0, number_format($diferencia-($diferencia*($porcentaje/100)),2), 1, 'R', 1, 0, '', '', true);

//end columna encomiendas
//-------------------

$pdf->AddPage();
//$pdf->Ln();
//cuerpo de la hoja
$pdf->SetY(7);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'HOJA DE EGRESOS     ( '.$fndSales[0]['buses']['plate'].' )', 0, 'C', 1, 1, '', '', true);

$pdf->Ln(1);
//$pdf->SetY(5);		//cordenada Y
$pdf->SetFont('helvetica', 'N', 9);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(130, 0, '', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'OFICINA', 0, 'L', 1, 0, '', '', true);
//$pdf->MultiCell(30, 0, ': '.$fndExpenses[0]['agence']['abrev'] , 0, 'L', 1, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(130, 0, 'NOTA: adjuntar gastos autorizados', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'FECHA', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, ': '.date('d/m/Y',strtotime($fndPro_varDate)), 0, 'L', 1, 0, '', '', true);

$pdf->Ln(8);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->MultiCell(8, 0, 'N°', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(20, 0, 'FECHA', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(44, 0, 'N° REC. (FAC/BOL/TIC)', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(64, 0, 'DESCRIPCION DEL GASTO AUTORIZADO', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(26, 0, 'IMPORTE', 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(32, 0, 'RESPONSABLE', 1, 'C', 1, 0, '', '', true);

$numExp			= 1;
$sumTotExpence	= 0;
$pdf->Ln();
foreach ($fndExpenses as $key => $value) {
	$varTypeDoc		= $value->type_doc;
	$varSerieDoc	= $value->serie_doc;
	$varNumberDoc	= $value->number_doc;
	if ($varTypeDoc!='00') {
		switch ($varTypeDoc) {
			case '01':
				$docType	= "FAC.";
				break;	
			case '02':
				$docType	= "R.HO.";
				break;
			case '03':
				$docType	= "BOL.";
				break;
			case '12':
				$docType	= "TIC.";
				break;
			case '13':
				$docType	= "VOU.";
				break;		
			default:
				$docType	= "";
				break;
		}
		$docExpense	= '('.$docType.' '.$varSerieDoc.' - '.str_pad($varNumberDoc, '7', STR_PAD_LEFT, '0').')';
	}else{
		$docExpense	= '';
	}
	
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->MultiCell(8, 0, $numExp, 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(20, 0, $value->date->format('d-m-Y'), 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(44, 0, str_pad($value->rc, '7', STR_PAD_LEFT, '0').' '.$docExpense, 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(64, 0, $value->detail, 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(26, 0, number_format($value->amount, 2), 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(32, 0, $value->response, 1, 'L', 1, 0, '', '', true);
	$sumTotExpence	+= $value->amount;
	$numExp	+=1;
	$pdf->Ln();
}
$pdf->SetFont('helvetica', 'B', 9);
$pdf->MultiCell(72, 0, '', 0, '', 1, 0, '', '', true);
$pdf->MultiCell(64, 0, 'TOTAL EGRESOS', 0, 'R', 1, 0, '', '', true);
$pdf->MultiCell(26, 0, number_format($sumTotExpence,2), 1, 'R', 1, 0, '', '', true);


//$pdf->Cell(15, 6, '10, 35', 0 , 1);
$pdf->SetXY(15, 40);$pdf->Output('name.pdf', 'I');
?>