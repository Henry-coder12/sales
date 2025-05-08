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
    //Page header
    public function Header() {
        // Logo
		//$image_file = K_PATH_IMAGES.'tcpdf_logo.jpg';
		//$this->Image($image_file, 10, 2, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font

		$this->SetFont('times', 'B', 12);
		// Title
		$this->ln(3);

		
		$this->Cell(0, 10, 'LIQUIDACION DE VENTA BOLETOS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//$style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		//$this->Line(3, 9, 204, 9, $style);
    }
    public function Footer() {
        // Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$pdf->SetMargins(2, 5, 2);
$pdf->SetHeaderMargin(5);

//Indicamos la creación de nuevas paginas automaticas al crecer el contenido
$pdf->SetAutoPageBreak(true, 15);

//agregamos la primera hoja al pdf
$pdf->AddPage();

$pdf->ln(5);
$pdf->SetFont('helvetica', 'N', 11);
//$pdf->Cell(100, 0, 'Liq-Diaria Detallado', 0, 'L', 1, 0, '', '', true);
//$pdf->Cell(50,0,'Liq-Diaria Detallado',0,1,'L');
if ($tipo=='0') {
	$pdf->Cell(150,0,'Usuario : '.$user->names.' '.$user->surnames,0,1,'L');
}else{
	$pdf->Cell(150,0,'Oficina : '.$agencia->name,0,1,'L');
}

$pdf->Cell(100,0,'Fecha INICIO : '.date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' ----> '.'Fecha FINAL : '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN)),0,1,'L');
$pdf->ln(5);
//1. COLUMNA I


$cntCol1=0;
$sumHeightY2=0;
$sumHeightY1_2=0;//1ra columna de la 2da hoja
$sumHeightY1_3=0;//1ra columna de la 3da hoja
$sumHeightY1_4=0;//1ra columna de la 4da hoja
$sumHeightY1_5=0;//1ra columna de la 5da hoja

$sumHeightY2_2=0;//2da columna de la 2da hoja
$sumHeightY2_3=0;//2da columna de la 3ra hoja
$sumHeightY2_4=0;//2da columna de la 4ra hoja
$sumHeightY2_5=0;//2da columna de la 5ta hoja

$sumHeightY3_2=0;//3ra columna de la 2da hoja
$sumHeightY3_3=0;//3ra columna de la 3da hoja
$sumHeightY3_4=0;//3ra columna de la 4ta hoja
$sumHeightY3_5=0;//3ra columna de la 5ta hoja
$sumHeightY3=0;
/*$pdf->SetFont('helvetica', 'B', 8);
			$pdf->Cell(8,0,'Bus',0,0,'C');
			$pdf->Cell(7,0,'Asie',0,0,'C');
			$pdf->Cell(19,0,'Boleto',0,0,'C');
			$pdf->Cell(13,0,'Importe',0,0,'C');
			$pdf->Cell(17,0,'Fecha/V',0,1,'C');*/
//for ($i=0; $i < $ventas_pasajes->count(); $i++) { 
foreach ($ventas_pasajes as $value) {

	$cntCol1 += 1;
	if (($cntCol1<=70) OR ($cntCol1>210 AND $cntCol1<=285) OR ($cntCol1>435 AND $cntCol1<=510) OR ($cntCol1>660 AND $cntCol1<=735) OR ($cntCol1>885 AND $cntCol1<=960)) {		
		if (($cntCol1==1) OR ($cntCol1==211) OR ($cntCol1==436) OR ($cntCol1==661) OR ($cntCol1==886)) {
			//
			//1.1 cabecera
			/*if ($cntCol1==1) {
				$pdf->SetXY(1, 24.55);
			}else{
				$pdf->SetXY(1, 12);
			}	*/
			if ($cntCol1<>1) {
				$pdf->Cell(17,0,'',0,1,'C');
				$pdf->Cell(17,0,'',0,1,'C');
			}
			$pdf->SetFont('helvetica', 'B', 8);
			$pdf->Cell(8,0,'Bus',0,0,'C');
			$pdf->Cell(7,0,'Asie',0,0,'C');
			$pdf->Cell(19,0,'Boleto',0,0,'C');
			$pdf->Cell(13,0,'Importe',0,0,'C');
			$pdf->Cell(17,0,'Fecha/V',0,1,'C');
		}
		if ($cntCol1>209 AND $cntCol1<=285) {
			$pdf->SetY(15.4+$sumHeightY1_2);
			$sumHeightY1_2 += 3.525;
		}elseif ($cntCol1>210 AND $cntCol1<=285) {
			$pdf->SetY(15.4+$sumHeightY1_2);
			$sumHeightY1_2 += 3.525;
		}elseif ($cntCol1>435 AND $cntCol1<=510) {
			$pdf->SetY(15.4+$sumHeightY1_3);
			$sumHeightY1_3 += 3.525;
		}elseif ($cntCol1>660 AND $cntCol1<=735) {
			$pdf->SetY(15.4+$sumHeightY1_4);
			$sumHeightY1_4 += 3.525;
		}elseif ($cntCol1>885 AND $cntCol1<=960) {
			$pdf->SetY(15.4+$sumHeightY1_5);
			$sumHeightY1_5 += 3.525;
		}
		//1.2 body fila 1
		$pdf->SetFont('helvetica', 'N', 8);
		$pdf->Cell(8,0,$value->programation->bus->code,0,0,'L');
		$pdf->Cell(7,0,$value->bus_seat->name_seat,0,0,'L');
		if ($value->cancel_sale=='1') {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'A',0,0,'L'); //ANULADO
        }elseif ($value->type_payment==0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'C',0,0,'L'); //CREDITO
        }elseif ($value->postpone_sales_free>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'FL',0,0,'L'); //FECHA LIBRE
        }elseif ($value->postpone_sale_id>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'P',0,0,'L'); //POSTERGADO
        }else{
            $pdf->Cell(19,0,$value->serie.'-'.$value->number,0,0,'L'); //NORMAL
        }
		$pdf->Cell(13,0,number_format($value->price,2),0,0,'R');
		$pdf->Cell(17,0,$value->programation->date->format('d/m/Y'),0,1,'C');

	}elseif (($cntCol1>70 AND $cntCol1<=140) OR ($cntCol1>285 AND $cntCol1<=360) OR ($cntCol1>510 AND $cntCol1<=585) OR ($cntCol1>735 AND $cntCol1<=810) OR ($cntCol1>960 AND $cntCol1<=1035)) {//si es mas de 70 registros que genere la 2da columna
		//2. COLUMNA II		

		if (($cntCol1==71) OR ($cntCol1==286) OR ($cntCol1==511) OR ($cntCol1==736) OR ($cntCol1==961)) {
			//2.1 cabecera
			if ($cntCol1==71) {
				$pdf->SetXY(72, 24.55);
			}else{
				$pdf->SetXY(72, 12);
			}			
			$pdf->SetFont('helvetica', 'B', 8);
			$pdf->Cell(8,0,'Bus',0,0,'C');
			$pdf->Cell(7,0,'Asie',0,0,'C');
			$pdf->Cell(19,0,'Boleto',0,0,'C');
			$pdf->Cell(13,0,'Importe',0,0,'C');
			$pdf->Cell(17,0,'Fecha/V',0,1,'C');
		}	
		//2.2 body fila 1
		if (($cntCol1>70 AND $cntCol1<=140)) {
			$pdf->SetXY(72, 28.33+$sumHeightY2);
			$sumHeightY2 += 3.525;			
		}elseif($cntCol1>285 AND $cntCol1<=360){
			$pdf->SetXY(72, 15.525+$sumHeightY2_2);
			$sumHeightY2_2 += 3.525;			
		}elseif ($cntCol1>510 AND $cntCol1<=585) {
			$pdf->SetXY(72, 15.525+$sumHeightY2_3);
			$sumHeightY2_3 += 3.525;
		}elseif ($cntCol1>735 AND $cntCol1<=810) {
			$pdf->SetXY(72, 15.525+$sumHeightY2_4);
			$sumHeightY2_4 += 3.525;
		}else{
			$pdf->SetXY(72, 15.525+$sumHeightY2_5);
			$sumHeightY2_5 += 3.525;
		}
		
		$pdf->SetFont('helvetica', 'N', 8);
		$pdf->Cell(8,0,$value->programation->bus->code,0,0,'L');
		$pdf->Cell(7,0,$value->bus_seat->name_seat,0,0,'L');
		if ($value->cancel_sale=='1') {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'A',0,0,'L'); //ANULADO
        }elseif ($value->type_payment==0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'C',0,0,'L'); //CREDITO
        }elseif ($value->postpone_sales_free>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'FL',0,0,'L'); //FECHA LIBRE
        }elseif ($value->postpone_sale_id>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'P',0,0,'L'); //POSTERGADO
        }else{
            $pdf->Cell(19,0,$value->serie.'-'.$value->number,0,0,'L'); //NORMAL
        }
		$pdf->Cell(13,0,number_format($value->price,2),0,0,'R');
		$pdf->Cell(17,0,$value->programation->date->format('d/m/Y'),0,1,'C');
		
		
	}elseif (($cntCol1>140 AND $cntCol1<=210) OR ($cntCol1>360 AND $cntCol1<=435) OR ($cntCol1>585 AND $cntCol1<=660) OR ($cntCol1>810 AND $cntCol1<=885) OR ($cntCol1>1035 AND $cntCol1<=1110)) {//si es mas de 70 registros que genere la 2da columna
		//2. COLUMNA II		
		if (($cntCol1==141) OR ($cntCol1==361) OR ($cntCol1==586) OR ($cntCol1==811) OR ($cntCol1==1036)) {
			//2.1 cabecera
			if ($cntCol1==141) {
				$pdf->SetXY(142, 24.55);
			}else{
				$pdf->SetXY(142, 12);
			}
			$pdf->SetFont('helvetica', 'B', 8);
			$pdf->Cell(8,0,'Bus',0,0,'C');
			$pdf->Cell(7,0,'Asie',0,0,'C');
			$pdf->Cell(19,0,'Boleto',0,0,'C');
			$pdf->Cell(13,0,'Importe',0,0,'C');
			$pdf->Cell(17,0,'Fecha/V',0,1,'C');
		}		
		//2.2 body fila 1
		if (($cntCol1>140 AND $cntCol1<=210)) {
			$pdf->SetXY(142, 28.33+$sumHeightY3);
			$sumHeightY3 += 3.525;			
		}elseif($cntCol1>360 AND $cntCol1<=435){
			$pdf->SetXY(142, 15.525+$sumHeightY3_2);
			$sumHeightY3_2 += 3.525;			
		}elseif ($cntCol1>585 AND $cntCol1<=660) {
			$pdf->SetXY(142, 15.525+$sumHeightY3_3);
			$sumHeightY3_3 += 3.525;
		}elseif ($cntCol1>810 AND $cntCol1<=885) {
			$pdf->SetXY(142, 15.525+$sumHeightY3_4);
			$sumHeightY3_4 += 3.525;
		}else{
			$pdf->SetXY(142, 15.525+$sumHeightY3_5);
			$sumHeightY3_5 += 3.525;
		}

		
		$pdf->SetFont('helvetica', 'N', 8);
		$pdf->Cell(8,0,$value->programation->bus->code,0,0,'L');
		$pdf->Cell(7,0,$value->bus_seat->name_seat,0,0,'L');
		if ($value->cancel_sale=='1') {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'A',0,0,'L'); //ANULADO
        }elseif ($value->type_payment==0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'C',0,0,'L'); //CREDITO
        }elseif ($value->postpone_sales_free>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'FL',0,0,'L'); //FECHA LIBRE
        }elseif ($value->postpone_sale_id>0) {
            $pdf->Cell(19,0,$value->serie.'-'.$value->number.'P',0,0,'L'); //POSTERGADO
        }else{
            $pdf->Cell(19,0,$value->serie.'-'.$value->number,0,0,'L'); //NORMAL
        }
		$pdf->Cell(13,0,number_format($value->price,2),0,0,'R');
		$pdf->Cell(17,0,$value->programation->date->format('d/m/Y'),0,1,'C');
	}

	
}



//3. COLUMNA III
/*$pdf->SetXY(142, 24.55);
//3.1 cabecera
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(8,0,'Bus',0,0,'C');
$pdf->Cell(7,0,'Asie',0,0,'C');
$pdf->Cell(19,0,'Boleto',0,0,'C');
$pdf->Cell(13,0,'Importe',0,0,'C');
$pdf->Cell(17,0,'Fecha/V',0,1,'C');
//3.2 body fila 1
$pdf->SetXY(142, 28.33);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(8,0,'888',0,0,'L');
$pdf->Cell(7,0,'88',0,0,'L');
$pdf->Cell(19,0,'002-0123456',0,0,'L');
$pdf->Cell(13,0,'888.88',0,0,'R');
$pdf->Cell(17,0,'88/88/8888',0,1,'C');*/

//end cuerpo de la hoja



$pdf->Output('name', 'I');
 ?>
 
