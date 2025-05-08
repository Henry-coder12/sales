<?php 
//App::import('Vendor', 'Facebook', array('file' => 'Facebook' . DS . 'src'. DS. 'facebook.php'));
//App::import('Vendor','tcpdf',array('file'=>'tcpdf/tcpdf.php'));
require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');
$paises=array("PE"=>'Peru',
"AF"=>'Afganistan',
"AX"=>'Islas Gland',
"AL"=>'Albania',
"DE"=>'Alemania',
"AD"=>'Andorra',
"AO"=>'Angola',
"AI"=>'Anguilla',
"AQ"=>'Antartida',
"AG"=>'Antigua y Barbuda',
"AN"=>'Antillas Holandesas',
"SA"=>'Arabia Saudi',
"DZ"=>'Argelia',
"AR"=>'Argentina',
"AM"=>'Armenia',
"AW"=>'Aruba',
"AU"=>'Australia',
"AT"=>'Austria',
"AZ"=>'Azerbaiyan',
"BS"=>'Bahamas',
"BH"=>'Bahrein',
"BD"=>'Bangladesh',
"BB"=>'Barbados',
"BY"=>'Bielorrusia',
"BE"=>'Belgica',
"BZ"=>'Belice',
"BJ"=>'Benin',
"BM"=>'Bermudas',
"BT"=>'Bhutan',
"BO"=>'Bolivia',
"BA"=>'Bosnia y Herzegovina',
"BW"=>'Botsuana',
"BV"=>'Isla Bouvet',
"BR"=>'Brasil',
"BN"=>'Brunei',
"BG"=>'Bulgaria',
"BF"=>'Burkina Faso',
"BI"=>'Burundi',
"CV"=>'Cabo Verde',
"KY"=>'Islas Caiman',
"KH"=>'Camboya',
"CM"=>'Camerun',
"CA"=>'Canada',
"CF"=>'Republica Centroafricana',
"TD"=>'Chad',
"CZ"=>'Republica Checa',
"CL"=>'Chile',
"CN"=>'China',
"CY"=>'Chipre',
"CX"=>'Isla de Navidad',
"VA"=>'Ciudad del Vaticano',
"CC"=>'Islas Cocos',
"CO"=>'Colombia',
"KM"=>'Comoras',
"CD"=>'Republica Democratica del Congo',
"CG"=>'Congo',
"CK"=>'Islas Cook',
"KP"=>'Corea del Norte',
"KR"=>'Corea del Sur',
"CI"=>'Costa de Marfil',
"CR"=>'Costa Rica',
"HR"=>'Croacia',
"CU"=>'Cuba',
"DK"=>'Dinamarca',
"DM"=>'Dominica',
"DO"=>'Republica Dominicana',
"EC"=>'Ecuador',
"EG"=>'Egipto',
"SV"=>'El Salvador',
"AE"=>'Emiratos Árabes Unidos',
"ER"=>'Eritrea',
"SK"=>'Eslovaquia',
"SI"=>'Eslovenia',
"ES"=>'España',
"UM"=>'Islas ultramarinas de Estados Unidos',
"US"=>'Estados Unidos',
"EE"=>'Estonia',
"ET"=>'Etiopia',
"FO"=>'Islas Feroe',
"PH"=>'Filipinas',
"FI"=>'Finlandia',
"FJ"=>'Fiyi',
"FR"=>'Francia',
"GA"=>'Gabon',
"GM"=>'Gambia',
"GE"=>'Georgia',
"GS"=>'Islas Georgias del Sur y Sandwich del Sur',
"GH"=>'Ghana',
"GI"=>'Gibraltar',
"GD"=>'Granada',
"GR"=>'Grecia',
"GL"=>'Groenlandia',
"GP"=>'Guadalupe',
"GU"=>'Guam',
"GT"=>'Guatemala',
"GF"=>'Guayana Francesa',
"GN"=>'Guinea',
"GQ"=>'Guinea Ecuatorial',
"GW"=>'Guinea-Bissau',
"GY"=>'Guyana',
"HT"=>'Haiti',
"HM"=>'Islas Heard y McDonald',
"HN"=>'Honduras',
"HK"=>'Hong Kong',
"HU"=>'Hungria',
"IN"=>'India',
"ID"=>'Indonesia',
"IR"=>'Iran',
"IQ"=>'Iraq',
"IE"=>'Irlanda',
"IS"=>'Islandia',
"IL"=>'Israel',
"IT"=>'Italia',
"JM"=>'Jamaica',
"JP"=>'Japon',
"JO"=>'Jordania',
"KZ"=>'Kazajstan',
"KE"=>'Kenia',
"KG"=>'Kirguistan',
"KI"=>'Kiribati',
"KW"=>'Kuwait',
"LA"=>'Laos',
"LS"=>'Lesotho',
"LV"=>'Letonia',
"LB"=>'Libano',
"LR"=>'Liberia',
"LY"=>'Libia',
"LI"=>'Liechtenstein',
"LT"=>'Lituania',
"LU"=>'Luxemburgo',
"MO"=>'Macao',
"MK"=>'ARY Macedonia',
"MG"=>'Madagascar',
"MY"=>'Malasia',
"MW"=>'Malawi',
"MV"=>'Maldivas',
"ML"=>'Mali',
"MT"=>'Malta',
"FK"=>'Islas Malvinas',
"MP"=>'Islas Marianas del Norte',
"MA"=>'Marruecos',
"MH"=>'Islas Marshall',
"MQ"=>'Martinica',
"MU"=>'Mauricio',
"MR"=>'Mauritania',
"YT"=>'Mayotte',
"MX"=>'Mexico',
"FM"=>'Micronesia',
"MD"=>'Moldavia',
"MC"=>'Monaco',
"MN"=>'Mongolia',
"MS"=>'Montserrat',
"MZ"=>'Mozambique',
"MM"=>'Myanmar',
"NA"=>'Namibia',
"NR"=>'Nauru',
"NP"=>'Nepal',
"NI"=>'Nicaragua',
"NE"=>'Niger',
"NG"=>'Nigeria',
"NU"=>'Niue',
"NF"=>'Isla Norfolk',
"NO"=>'Noruega',
"NC"=>'Nueva Caledonia',
"NZ"=>'Nueva Zelanda',
"OM"=>'Oman',
"NL"=>'Paises Bajos',
"PK"=>'Pakistan',
"PW"=>'Palau',
"PS"=>'Palestina',
"PA"=>'Panama',
"PG"=>'Papua Nueva Guinea',
"PY"=>'Paraguay',
"PN"=>'Islas Pitcairn',
"PF"=>'Polinesia Francesa',
"PL"=>'Polonia',
"PT"=>'Portugal',
"PR"=>'Puerto Rico',
"QA"=>'Qatar',
"GB"=>'Reino Unido',
"RE"=>'Reunion',
"RW"=>'Ruanda',
"RO"=>'Rumania',
"RU"=>'Rusia',
"EH"=>'Sahara Occidental',
"SB"=>'Islas Salomon',
"WS"=>'Samoa',
"AS"=>'Samoa Americana',
"KN"=>'San Cristobal y Nevis',
"SM"=>'San Marino',
"PM"=>'San Pedro y Miquelon',
"VC"=>'San Vicente y las Granadinas',
"SH"=>'Santa Helena',
"LC"=>'Santa Lucia',
"ST"=>'Santo Tome y Principe',
"SN"=>'Senegal',
"CS"=>'Serbia y Montenegro',
"SC"=>'Seychelles',
"SL"=>'Sierra Leona',
"SG"=>'Singapur',
"SY"=>'Siria',
"SO"=>'Somalia',
"LK"=>'Sri Lanka',
"SZ"=>'Suazilandia',
"ZA"=>'Sudafrica',
"SD"=>'Sudan',
"SE"=>'Suecia',
"CH"=>'Suiza',
"SR"=>'Surinam',
"SJ"=>'Svalbard y Jan Mayen',
"TH"=>'Tailandia',
"TW"=>'Taiwan',
"TZ"=>'Tanzania',
"TJ"=>'Tayikistan',
"IO"=>'Territorio Britanico del Oceano Índico',
"TF"=>'Territorios Australes Franceses',
"TL"=>'Timor Oriental',
"TG"=>'Togo',
"TK"=>'Tokelau',
"TO"=>'Tonga',
"TT"=>'Trinidad y Tobago',
"TN"=>'Tunez',
"TC"=>'Islas Turcas y Caicos',
"TM"=>'Turkmenistan',
"TR"=>'Turquia',
"TV"=>'Tuvalu',
"UA"=>'Ucrania',
"UG"=>'Uganda',
"UY"=>'Uruguay',
"UZ"=>'Uzbekistan',
"VU"=>'Vanuatu',
"VE"=>'Venezuela',
"VN"=>'Vietnam',
"VG"=>'Islas Virgenes Britanicas',
"VI"=>'Islas Virgenes de los Estados Unidos',
"WF"=>'Wallis y Futuna',
"YE"=>'Yemen',
"DJ"=>'Yibuti',
"ZM"=>'Zambia',
"ZW"=>'Zimbabue');

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
$pdf->first_name=' Usuario : '.$user->names.' '.$user->surnames.' --- Fecha IMPRESION : '.date('d/m/Y h:i:s a');

$pdf->SetCreator('IFAC PERU SAC');
$pdf->SetAuthor('IFAC PERU SAC');
$pdf->SetTitle('encomiendas');
$pdf->SetSubject('www.ifac.pe');
$pdf->SetKeywords('Factura Electronica, IFAC PERU SAC, Facturación, Desarrollo de Sistemas de Información');

//establecer margenes
$pdf->SetMargins(5, 20, 5);
$pdf->SetHeaderMargin(5);

//Indicamos la creación de nuevas paginas automaticas al crecer el contenido
$pdf->SetAutoPageBreak(true, 15);

//agregamos la primera hoja al pdf
$pdf->AddPage();


$pdf->Ln(8);
//cuerpo de la hoja
$pdf->SetY(10);		//cordenada Y
$pdf->SetFont('helvetica', 'BI', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(210, 0, $razon_empresa->value, 0, 'C', 1, 0, '', '', true);
$pdf->SetFont('helvetica', 'BI', 9);
$pdf->MultiCell(90, 0, '', 0, 'C', 1, 1, '', '', true);
//$pdf->MultiCell(width, height, 'LIQUIDACION DE VENTA DIARIA', boderder, 'align', 1, 1, '', '', true);
$pdf->Ln(3);
//cuerpo de la hoja
$pdf->SetFont('helvetica', 'BI', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(210, 0, 'LISTA TOTAL DE ENCOMIENDAS RECEPCIONADAS SEGUN RANGO DE FECHA', 0, 'C', 1, 0, '', '', true);
$pdf->SetFont('helvetica', 'BI', 9);


$pdf->MultiCell(90, 0, '', 0, 'C', 1, 1, '', '', true);

//
// set some text for example


// Multicell test
$pdf->Ln(3);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->MultiCell(20, 0, '', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'OFICINA', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(170, 0, ': '.$agencia->name, 0, 'L', 1, 0, '', '', true);
$pdf->Ln(3);
$pdf->MultiCell(20, 0, '', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'FECHA INICIO', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(80, 0, ': '.date('d-m-Y H:i:s',strtotime($dateConsultaINI)) , 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 0, 'FECHA FIN', 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, ': '.date('d-m-Y H:i:s',strtotime($dateConsultaFIN)), 0, 'L', 1, 0, '', '', true);
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'N', 7);
$tbl = '
<table border="0" cellpadding="1" cellspacing="0" nobr="false">
	<tr style="background-color:#bbb;color:#000000;">
	  <td width="30" align="center"><b>T.D.</b></td>
	  <td width="70" align="left"><b>N. DOC.</b></td>
	  <td width="150" align="left"><b>CONSIGNATARIO</b></td>
	  <td width="170" align="left"><b>CANT./ DESCRIPCIONES</b></td>
	  <td width="50" align="right"><b>PREC.</b></td>
	  <td width="50" align="right"><b>DESTINO.</b></td>
	  <td width="50" align="right"><b>ESTADO.</b></td>
	</tr> ';
	$total=0;
	$totalPrecio=0;
	
	foreach($ventas_encomiendas as $value){ 
		if ($value->canceled==1) {
			$cantidadContenido='';
			foreach ($value->detail_commends as $detail) {
        		$cantidadContenido =$cantidadContenido.' ('.$detail->quantity.') '.$detail->content.' / ';
        	}
			$tbl .='	<tr>
			  <td width="30" align="center">'.$value->doc.'</td>
			  <td width="70" align="left">'.$value->serie.' - '.str_pad($value->number,7,'0',STR_PAD_LEFT).'</td>
			  <td width="150" align="left">'.$value->consig_name.'</td>
			  <td width="170" align="left">'.$cantidadContenido.'</td>
			  <td width="50" align="right">S/ '.number_format($value->total,2).'</td>
			  <td width="50" align="right">'.$value->destino.'</td>
			  <td width="50" align="right">ANULADO</td>
			</tr>';
		}else{
			$cantidadContenido='';
			foreach ($value->detail_commends as $detail) {
        		$cantidadContenido =$cantidadContenido.' ('.$detail->quantity.') '.$detail->content.' / ';
        		$total=$total+$detail->quantity;
        	}
			$tbl .='	<tr>
			  <td width="30" align="center">'.$value->doc.'</td>
			  <td width="70" align="left">'.$value->serie.' - '.str_pad($value->number,7,'0',STR_PAD_LEFT).'</td>
			  <td width="150" align="left">'.$value->consig_name.'</td>
			  <td width="170" align="left">'.$cantidadContenido.'</td>
			  <td width="50" align="right">S/ '.number_format($value->total,2).'</td>
			  <td width="50" align="right">'.$value->destino.'</td>
			  <td width="50" align="right">-</td>
			</tr>';
		} 
		
		
		$totalPrecio=$totalPrecio+$value->detail_commend->commend->total;
	}
	
	

$tbl .='</table>';


$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetFont('helvetica', 'I', 9);
$pdf->Ln(4);
$pdf->MultiCell(55, 0, 'TOTAL ENCOMIENDAS', 0, 'R', 0, 0, '', '', true);
$pdf->MultiCell(15, 0, ': '.$total, 0, 'L', 0, 1, '', '', true);

$pdf->Ln(7);
$pdf->Output('name.pdf', 'I');
 ?>
 
