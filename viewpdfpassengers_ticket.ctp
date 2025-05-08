<?
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }
 
    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }
 
            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                             
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                             
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                             
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO
 
        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";
 
        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = " $xdecimales/100 CERO SOLES";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = " CON $xdecimales/100 SOL ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON $xdecimales/100 SOLES "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}
 
// END FUNCTION
 
function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}


require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');


class xtcpdf extends TCPDF {
    //Page header
    public function Header() {
        
    }
    public function Footer() {
        
    }
}


$pdf = new xtcpdf($orientation='P', $unit='mm', array(350,105), $unicode=true, 'UTF-8', $diskcache=false, $pdfa=false);
//$pdf = new xtcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('IFAC');
$pdf->SetAuthor('IFAC PERU SAC');
$pdf->SetTitle('Factura Electrónica');
$pdf->SetSubject('www.ifac.pe');
$pdf->SetKeywords('Factura Electronica, IFAC PERU SAC');


// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();

// Logo de Empresa
$image_file = WWW_ROOT.'img'.DS.'logo.png';
$pdf->Image($image_file, 25, 10, 60, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
//Datos del Emisor
$pdf->SetY(45);
$pdf->SetFont ('helvetica', 'B', 13);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(80, 0, $razon_empresa['value'], 0, 'C', 1, 1, '', '', true);
$pdf->SetFont ('helvetica', '', 12);
$pdf->MultiCell(80, 3, $direccion_empresa['value'], 0, 'C', 1, 1, '', '', true);
$pdf->MultiCell(80, 0, 'RUC : '.$ruc_empresa['value'], 0, 'C', 1, 1, '', '', true);
if ($datos['doc']=='01') { $tipoD='FACTURA'; }else{ $tipoD='BOLETA';}
$pdf->Ln();
$pdf->MultiCell(80, 3,  $tipoD.' ELECTRONICA', 0, 'C', 1, 1, '', '', true);
$pdf->MultiCell(80, 3, $datos['serie'].' - '.str_pad($datos['number'],7,'0',STR_PAD_LEFT), 0, 'C', 1, 1, '', '', true);
$pdf->Ln();

$pdf->SetFont ('helvetica', 'B', 11);
$pdf->MultiCell(80, 3, 'CLIENTE:', 0, 'L', 1, 1, '', '', true);
if ($datos['doc']=='01') { $remitD='RUC : '.substr(strtoupper($datos['client']['ruc']), 0, 50); }else{ $remitD='NUM.DOC. : '.substr(strtoupper($datos['client']['document']), 0, 50); }
$pdf->MultiCell(80, 3, $remitD, 0, 'L', 1, 1, '', '', true);
if ($datos['doc']=='01') { $remitN=substr(strtoupper($datos['client']['razon']), 0, 60); }else{ $remitN=substr(strtoupper($datos['client']['surnames'].' '.$datos['client']['names']), 0, 60); } 
$pdf->MultiCell(80, 3, 'SR(A) :'.$remitN, 0, 'L', 1, 1, '', '', true);

$pdf->SetFont ('helvetica', 'B', 12);
$pdf->Ln(2);
$pdf->MultiCell(80, 3, 'DATOS DE PASAJERO', 0, 'C', 1, 1, '', '', true);
$pdf->SetFont ('helvetica', 'B', 13);
$pdf->Ln(2);
$client_dni='Num.Doc : '.substr(strtoupper($datos['client']['document']), 0, 50); 
$pdf->MultiCell(80, 3, $client_dni, 0, 'L', 1, 1, '', '', true);
$nombre_pas=substr(strtoupper($datos['client']['surnames'].' '.$datos['client']['names']), 0, 60);  
$pdf->MultiCell(80, 3, 'SR(A) :'.$nombre_pas, 0, 'L', 1, 1, '', '', true);

$pdf->MultiCell(80, 3, 'AGENCIA DE EMBARQUE', 0, 'L', 1, 1, '', '', true);
$pdf->MultiCell(80, 3, $embarcation, 0, 'L', 1, 1, '', '', true);


$origenArray=explode('-', $origen);
$destinoArray=explode('-', $destino);
$pdf->MultiCell(80, 3, 'ORIGEN: '.substr($origenArray[0],0,10), 0, 'L', 1, 1, '', '', true);
$pdf->MultiCell(80, 3, 'DESTINO: '.substr($destinoArray[0],0,10), 0, 'L', 1, 1, '', '', true);
$pdf->MultiCell(80, 3, 'FECHA VIAJE: '.$datos['date_travel']->format('d-m-Y'), 0, 'L', 1, 1, '', '', true);
$pdf->MultiCell(80, 3, 'HORA: '.$datos['hour_travel']->format("g:i A"), 0, 'L', 1, 1, '', '', true);
$pdf->SetFont ('helvetica', 'B', 24);
$pdf->MultiCell(80, 3, 'ASIENTO:'.$datos['bus_seat']['name_seat'], 0, 'L', 1, 1, '', '', true);


$total_gravada=$datos['price']-$datos['impuesto'];
$total_igv=$datos['price']-$total_gravada;
$igv = number_format('1.'.$impuesto['valor'],2);
$total_pagar=$datos['price'];
$pdf->Ln(2);
$pdf->SetFont ('helvetica', '', 12);
$pdf->Cell(40, 4, 'OPERACION NO GRAVADA', 'T', 0, 'L', 0, '', 0);
$pdf->Cell(40, 4, 'S/.'.number_format($total_gravada,2) , 'T', 0, 'R', 0, '', 0);
$pdf->Ln();
$pdf->Cell(40, 4, 'IGV '.$impuesto['valor'].'%', '', 0, 'L', 0, '', 0);
$pdf->Cell(40, 4, 'S/.'.number_format($total_igv,2) , '', 0, 'R', 0, '', 0);
$pdf->Ln();
$pdf->Cell(40, 4, 'TOTAL', 'B', 0, 'L', 0, '', 0);
$pdf->Cell(40, 4, 'S/.'.number_format($total_pagar,2) , 'B', 0, 'R', 0, '', 0);

$pdf->Ln(6);


$pdf->SetFont ('helvetica', '', 12);
$pdf->MultiCell(90, 10,'SON : '.numtoletras($total_pagar).' SOLES', '', 'L', 0, 0, '', '');
$pdf->Ln();
$pdf->Cell(80, 3, 'FECHA EMISION: '.$datos['created']->format('d/m/Y g:i a'), 0, 1, 'L', 0, '', 0, false);
$pdf->Cell(80, 4, 'ATENDIDO POR: '.$datos['user']['names'], 0, 1, 'L', 0, '', 0, false);
$pdf->Ln();
$pdf->Cell(80, 5, $datos['digestvalue'], '', 1, 'C', 0, '', 0);
$pdf->Ln();
$pdf->SetFont ('helvetica', 'B', 10);
$pdf->MultiCell(80, 10, 'Asegurado con SOAT '.$programationData->bus->companie.' POLIZA '.$programationData->bus->poliza, '','J',0,0, '', '');
$pdf->Ln();
$pdf->SetFont ('helvetica', '', 10);
$pdf->MultiCell(80, 10, '     Representación impresa del COMPROBANTE ELECTRONICO, para consultar el documento visita '.$pagina_cpe['value'].', Autorizado mediante SUNAT, al recibir el presente DOCUMENTO, acepto todos los términos y condiciones del contrato de transporte detallado en el letrero, banner y/o panel a la vista ubicados en el counter de ventas al momento de la compra, los cuales también se encuentran publicados en la página web.', '', 'J', 0, 0, '', '');



//$pdf->SetLineStyle(array('width' => 0.1, 'color' => array(102, 102, 102)));
//Detalle de los items - encabezado








// ---------------------------------------------------------
$time = time();
$file_name = $ruc_empresa['value'].'_'.$datos['serie'].'_'.$datos['number']."_".$time.".pdf";
//Close and output PDF document
$pdf->Output($file_name, 'I');

//============================================================+
// END OF FILE
//============================================================+

?>
