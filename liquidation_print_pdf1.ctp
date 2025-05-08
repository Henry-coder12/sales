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

// set document information
if ($tipo=='0') {
	$pdf->first_name=' Usuario : '.$user->names.' '.$user->surnames.' --- Fecha INICIO : '.date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' --- Fecha FINAL : '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN));
}else{
	$pdf->first_name=' Oficina : '.$agencia->name.' --- Fecha INICIO : '.date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' --- Fecha FINAL : '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN));
}
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
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, $razon_empresa->value, 0, 'C', 1, 1, '', '', true);
//$pdf->MultiCell(width, height, 'LIQUIDACION DE VENTA DIARIA', boderder, 'align', 1, 1, '', '', true);
$pdf->Ln(3);
//cuerpo de la hoja
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(0, 0, 'LIQUIDACION DE VENTA POR RANGO DE FECHAS', 0, 'C', 1, 1, '', '', true);
//$pdf->MultiCell(width, height, 'LIQUIDACION DE VENTA DIARIA', boderder, 'align', 1, 1, '', '', true);
$pdf->Ln(3);
// set some text for example


// Multicell test
$pdf->SetFont('helvetica', 'N', 8);
$pdf->MultiCell(60, 0, 'Fecha INICIO : '.date('d/m/Y h:i:s a',strtotime($dateConsultaINI)), 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(60, 0, 'Fecha FINAL : '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN)), 0, 'L', 1, 0, '', '', true);
if ($tipo=='0') {
	$pdf->MultiCell(72, 0, 'Usuario : '.$user->names.' '.$user->surnames, 0, 'L', 1, 0, '', '', true);
}else{
	$pdf->MultiCell(72, 0, 'Oficina : '.$agencia->name, 0, 'L', 1, 0, '', '', true);
}


$pdf->Ln(7);

//cabecera ventas
$pdf->SetFont('helvetica', 'B', 7);
$pdf->MultiCell(20, 0, 'FEC.VIAJE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15, 0, 'TURNO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(14, 0, 'BUS', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, 'RUTA', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(15, 0, 'IMPORTE', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(55, 0, 'PILOTO/COPILOTO', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10, 0, 'C/BUS', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10, 0, 'VDH', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10, 0, 'VCA', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10, 0, 'OCUP', 0, 'C', 1, 0, '', '', true);
$pdf->MultiCell(10, 0, 'LIBRE', 0, 'C', 1, 1, '', '', true);
//cabecera ventas
$pdf->Ln(2);
$pdf->SetFont('helvetica', 'N', 8);
// set cell margins
//$pdf->setCellMargins(1, 1, 1, 1);
$pdf->setCellPaddings(1, 1, 1, 1);
$sumCordY=20;

//$pdf->MultiCell(20, 0, 'coder', 1, 'L', 0, 0, '', '', true);
$total=0;
foreach($pass_data as $datos){
	$programationID=$datos->programation->id;
	$pdf->MultiCell(20, 0, $datos->programation->date->format('d-m-Y'), 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(15, 0, $datos->programation->hour->format('h:i A'), 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell(14, 0, $datos->programation->bus->plate, 1, 'L', 0, 0, '', '', true);
	$routeExplode=explode(' - ',$datos->programation->route->name);
	$pdf->SetFont('helvetica', 'N', 6);
	$pdf->MultiCell(30, 11,substr($routeExplode[0],0,8).' - '.substr($routeExplode[1],0,8), 1, 'L', 0, 0, '', '', true);
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->MultiCell(15, 0, number_format($datos->sum,2), 1, 'R', 0, 0, '', '', true);
	$crews='';
	foreach ($crewsProgramation[$programationID] as $value) {
        $crews=$crews.substr($value->crew->names.' '.$value->crew->surnames,0,12).' / ';
    }
    $pdf->SetFont('helvetica', 'N', 6);
	$pdf->MultiCell(55, 11,  substr($crews, 0, strlen($crews) - 3), 1, 'L', 0, 0, '', '', true);
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->MultiCell(10, 0, $datos->programation->bus->num_seats, 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(10, 0, $datos->contar, 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(10, 0, $countSaleAnterior[$programationID], 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(10, 0, $datos->contar+$countSaleAnterior[$programationID], 1, 'C', 0, 0, '', '', true);
	$pdf->MultiCell(10, 0, $datos->programation->bus->num_seats-($datos->contar+$countSaleAnterior[$programationID]), 1, 'C', 0, 1, '', '', true);
	$sumCordY=$sumCordY+5.5;
	$total=$total+$datos->sum;
	
}
$pdf->MultiCell(79, 0, 'T. PASAJES S/ ', 0, 'R', 0, 0, '', '', true);
$pdf->MultiCell(15, 0, number_format($total,2), 1, 'R', 0, 1, '', '', true);

$pdf->Ln(7);

//econmiendas/exesos/gastos
//FILA1
$pdf->SetFont('helvetica', 'B', 10);
//$pdf->Multicell(40, 0, 'EXCESOS', 0, 'C', 0, 0, '', '', true);
//$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);
$pdf->Multicell(40, 0, 'GASTOS', 0, 'C', 0, 1, '', '', true);
//fila 2
$pdf->SetFont('helvetica', 'B', 8);
//$pdf->Multicell(23, 0, 'N/Doc', 1, 'C', 0, 0, '', '', true);
//$pdf->Multicell(17, 0, 'Importe', 1, 'C', 0, 0, '', '', true);
//$pdf->Multicell(5, 0, '', 0, 'C', 0, 0, '', '', true);//espacio
$pdf->Multicell(10, 0, 'N°', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(15, 0, 'Bus', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(20, 0, 'Monto', 1, 'C', 0, 0, '', '', true);
$pdf->Multicell(155, 0, 'T/D - N° / Detalle / Autorización', 1, 'L', 0, 1, '', '', true);
//fila 3
$pdf->SetY($sumCordY+36.18);
//$pdf->Multicell(20, 0, 'coder', 1, 'C', 0, 0, '', '', true);


//2. Detalle EXCESOS

$pdf->SetFont('helvetica', 'N', 8);
$pdf->SetY($sumCordY+36.18);
$sumCordYexce=0;
/*$total_exceso=0;
foreach ($excesos as $exceso) {
	$pdf->SetX(5);		//cordenada Y
	$pdf->Multicell(23, 0, $exceso->num_doc, 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(17, 0, number_format($exceso->amount,2), 1, 'C', 0, 0, '', '', true);
	$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio
	$sumCordYexce += 5.5;
	$total_exceso=$total_exceso+$exceso->amount;
}
*/
//resumen EXCESOS
/*
$pdf->SetX(5);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(23, 0, 'Subtotal ', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(17, 0, number_format($total_exceso,2), 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(5, 0, '', 0, 'C', 0, 1, '', '', true);//espacio
*/

//3. Detalle GASTOS
$pdf->SetFont('helvetica', 'N', 8);
$pdf->SetY($sumCordY+36.18);
$sumCordYgasto=0;
$contGasto=1;
//debug($gastos->toarray());
$total_gastos=0;
foreach ($gastos as $gasto) {
	$pdf->SetX(5);		//cordenada Y
	$pdf->SetFont('helvetica', 'N', 8);
	$pdf->setCellPaddings(1, 1, 1, 1);
	$pdf->Multicell(10, 0, $contGasto, 1, 'C', 0, 0, '', '', true);
	if($gasto->buse_id!=''){
		$pdf->Multicell(15, 0, $gasto->bus->plate, 1, 'C', 0, 0, '', '', true);
	}else{
		$pdf->Multicell(15, 0,'', 1, 'C', 0, 0, '', '', true);
	}	
	$pdf->Multicell(20, 0, number_format($gasto->amount,2) , 1, 'C', 0, 0, '', '', true);
	$pdf->SetFont('helvetica', 'N', 6);
	$pdf->setCellPaddings(1, 2, 1, 1);
	if ($gasto->type_doc!='00') {
		$pdf->Multicell(155, 0, $gasto->serie_doc.'-'.$gasto->number_doc.' / '.$gasto->detail.' / '.$gasto->authorized, 1, 'L', 0, 1, '', '', true);
	} else {
		$pdf->Multicell(155, 0, $gasto->rc.' / '.$gasto->detail.' / '.$gasto->authorized, 1, 'L', 0, 1, '', '', true);
	}
	$sumCordYgasto += 5.5;
	$contGasto++;
	$total_gastos=$total_gastos+$gasto->amount;
}
//resumen GASTOS
$pdf->SetX(5);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(25, 0, 'T. GASTOS ', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, number_format($total_gastos,2), 1, 'C', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'N', 6);
$pdf->setCellPaddings(1, 2.7, 1, 2);
$pdf->Multicell(155, 0, 'Fecha de impresion:'.fechaCastellano(date('d-m-Y H:i:s')), 1, 'R', 0, 1, '', '', true);

//III. Resumen boletos vendidos
$maxCordY=max($sumCordYexce, $sumCordYgasto);
$pdf->setY($maxCordY+$sumCordY+36.18+12);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->SetFont('helvetica', 'N', 10);

//resumen
$total_gastos=0;
foreach ($gastos as $value) {
    //$Total=number_format($value->amount,2);
    $total_gastos=$total_gastos+$value->amount;
} 
$total_excesos=0;
$cant_excesos=0;
foreach ($excesos as $value) {
	$cant_excesos++;
	if ($value->canceled=='1') {
	}else{
	    //$Total=number_format($value->total,2);
	    $total_excesos=$total_excesos+$value->total;
	    
	}
}


$total_pasajes=0;
$total_pasajes_credito=0;
foreach ($ventas_pasajes as $value) {
    $id=$value->id;
    $numDoc=$value->serie.'-'.$value->number;
    //$Total=number_format($value->price,2);
    if ($value->cancel_sale=='1') {
    }elseif ($value->type_payment==0) {
        $total_pasajes=$total_pasajes+$value->price;
        $total_pasajes_credito=$total_pasajes_credito+$value->price;
    }elseif ($value->postpone_sales_free>0) {
        $total_pasajes=$total_pasajes+$value->price;
    }elseif ($value->postpone_sale_id>0) {
        $total_pasajes=$total_pasajes+$value->price;
    }else{
        $total_pasajes=$total_pasajes+$value->price;
    }
    
}


$sum_cantidad=0;
$sum_totales=0;
foreach ($resumen_pas as $key => $value) {
	$pdf->Multicell(40, 0, 'PASAJES '.$value->serie, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(45, 0, $value->inicial.' --> '.$value->final, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(15, 0, $value->cantidad, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(20, 0, number_format($resumen_pas_total[$key]->toArray()[0]->total,2), 1, 'R', 0, 1, '', '', true);
    $sum_totales=$sum_totales+$resumen_pas_total[$key]->toArray()[0]->total;
    $sum_cantidad=$sum_cantidad+$value->cantidad;
}
foreach ($resumen_enc as $key => $value) {
	$pdf->Multicell(40, 0, 'ENCOMIENDAS '.$value->serie, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(45, 0, $value->inicial.' --> '.$value->final, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(15, 0, $value->cantidad, 1, 'R', 0, 0, '', '', true);
	$pdf->Multicell(20, 0, number_format($resumen_enc_total[$key]->toArray()[0]->total,2), 1, 'R', 0, 1, '', '', true);
    $sum_totales=$sum_totales+$resumen_enc_total[$key]->toArray()[0]->total;
    $sum_cantidad=$sum_cantidad+$value->cantidad;
}
$pdf->Multicell(40, 0, 'EXCESOS', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(45, 0, '-', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(15, 0, $cant_excesos, 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, number_format($total_excesos,2), 1, 'R', 0, 1, '', '', true);

$pdf->Multicell(85, 0, 'TOTAL VENTAS', 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(15, 0, $sum_cantidad, 1, 'R', 0, 0, '', '', true);
$pdf->Multicell(20, 0, number_format($sum_totales+$total_excesos,2), 1, 'R', 0, 1, '', '', true);

$pdf->SetXY(130, $maxCordY+$sumCordY+36.18+12);
$pdf->Multicell(70, 0, 'RESUMEN DE DIA', 0, 'C', 0, 1, '', '', true);//titulo
//cuerpo
//SUB-TOTAL
$pdf->SetXY(130, $maxCordY+$sumCordY+36.18+12+6);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'T. VENTAS S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, number_format($sum_totales+$total_excesos,2), 1, 'R', 0, 0, '', '', true);
//GASTOS
$pdf->SetXY(130, $maxCordY+$sumCordY+36.18+12+6+6.4);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'GASTOS S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, number_format(-1*$total_gastos,2), 1, 'R', 0, 0, '', '', true);
//TOTAL
$pdf->SetXY(130, $maxCordY+$sumCordY+36.18+12+6+6.4+6.4);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'PAS CRED S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, number_format(-1*$total_pasajes_credito,2), 1, 'R', 0, 0, '', '', true);
//end cuerpo de la hoja
//TOTAL
$pdf->SetXY(130, $maxCordY+$sumCordY+36.18+12+6+6.4+6.4+6.4);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Multicell(35, 0, 'T. EFECTIVO S/', 1, 'R', 0, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Multicell(35, 0, number_format(($sum_totales+$total_excesos-$total_gastos-$total_pasajes_credito),2), 1, 'R', 0, 0, '', '', true);
//end cuerpo de la hoja





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
 
