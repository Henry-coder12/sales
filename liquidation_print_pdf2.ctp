<?

//require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'fpdf' . DS . 'fpdf.php');

require_once(ROOT . '/src' . DS  . 'Vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');

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


class xtcpdf extends TCPDF {
	    var $colonnes;
		var $format;
		var $angle=0;
		// Page header
		public function Header()
		{
		    // Logo
		    //$this->Image('http://localhost/encopass_jatsa_cpe/img/logo.png',10,6,60);
			
		    // Line break
		    $this->Ln(20);
		}
		// private functions
		public function Footer() {
	        // Position at 15 mm from bottom
	        
			
	    }
			
		public function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
		{
			$h = $this->h;
			$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
								$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
		}

		public function Rotate($angle, $x=-1, $y=-1)
		{
			if($x==-1)
				$x=$this->x;
			if($y==-1)
				$y=$this->y;
			if($this->angle!=0)
				$this->_out('Q');
			$this->angle=$angle;
			if($angle!=0)
			{
				$angle*=M_PI/180;
				$c=cos($angle);
				$s=sin($angle);
				$cx=$x*$this->k;
				$cy=($this->h-$y)*$this->k;
				$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
			}
		}

		public function _endpage()
		{
			if($this->angle!=0)
			{
				$this->angle=0;
				$this->_out('Q');
			}
			parent::_endpage();
		}

		// public functions
		public function sizeOfText( $texte, $largeur )
		{
			$index    = 0;
			$nb_lines = 0;
			$loop     = TRUE;
			while ( $loop )
			{
				$pos = strpos($texte, "\n");
				if (!$pos)
				{
					$loop  = FALSE;
					$ligne = $texte;
				}
				else
				{
					$ligne  = substr( $texte, $index, $pos);
					$texte = substr( $texte, $pos+1 );
				}
				$length = floor( $this->GetStringWidth( $ligne ) );
				$res = 1 + floor( $length / $largeur) ;
				$nb_lines += $res;
			}
			return $nb_lines;
		}

		// Company
		public function addSociete( $nom, $adresse )
		{
			$x1 = 45;
			$y1 = 10;
			//Positionnement en bas
			$this->SetXY( $x1, $y1 );
			$this->SetFont('helvetica','B',8);
			$length = $this->GetStringWidth( $nom );
			//$this->Line($x1,28,90,28);
			$this->Cell( $length, 2, $nom);
			$this->SetXY( $x1, $y1 + 4 );
			$this->SetFont('helvetica','',6);
			$length = 80;
			//Coordonnées de la société
			$lignes = $this->sizeOfText( $adresse, $length) ;
			$this->MultiCell($length, 3, $adresse,'','L');
		}
		public function companyDetails($detils) {
			$r1     = $this->w - 80;
			$r2     = $r1 + 68;
			$y1     = 6;
			$this->SetXY( $r1, $y1);
			$this->MultiCell( 60, 4, $detils);
		}
		// Label and number of invoice/estimate
		public function fact_dev( $libelle, $num )
		{
		    $r1  = $this->w - 80;
		    $r2  = $r1 + 68;
		    $y1  = 6;
		    $y2  = $y1 + 2;
		    $mid = ($r1 + $r2 ) / 2;
		    
		    $texte  = $libelle . " EN " . EURO . " N° : " . $num;    
		    $szfont = 12;
		    $loop   = 0;
		    
		    while ( $loop == 0 )
		    {
		       $this->SetFont( "helvetica", "B", $szfont );
		       $sz = $this->GetStringWidth( $texte );
		       if ( ($r1+$sz) > $r2 )
		          $szfont --;
		       else
		          $loop ++;
		    }

		    $this->SetLineWidth(0.1);
		    $this->SetFillColor(192);
		    $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 2.5, 'DF');
		    $this->SetXY( $r1+1, $y1+2);
		    $this->Cell($r2-$r1 -1,5, $texte, 0, 0, "C" );
		}

		// Estimate
		public function addDevis( $numdev )
		{
			$string = sprintf("DEV%04d",$numdev);
			$this->fact_dev( "Devis", $string );
		}

		// Invoice
		public function addFacture( $numfact )
		{
			$string = sprintf("FA%04d",$numfact);
			$this->fact_dev( "Facture", $string );
		}

		public function addDataDocument( $ruc , $tipo , $num_doc)
		{
			
			$r1  = $this->w - 70;
			$r2  = $r1+10;
			$y1  = 5;
			$y2  = $y1 ;		
			//$this->RoundedRect($r1, $y1, 60, 30, 0, 'D');
			$this->SetXY( $r1, $y1+6 );
			$this->SetFont( "helvetica", "B", 12);
			$this->MultiCell(60,0,$ruc,'','C');
			$this->SetXY( $r1 , $y1+12 );
			$this->SetFont( "helvetica", "", 9);
			$this->MultiCell(60,0,$tipo,'','C');
			$this->SetXY( $r1 , $y1+21 );
			$this->SetFont( "helvetica", "", 7);
			$this->MultiCell(60,25,$num_doc,'','C');

		}

		public function addClient( $ref )
		{
			$r1  = $this->w - 31;
			$r2  = $r1 + 19;
			$y1  = 17;
			$y2  = $y1;
			$mid = $y1 + ($y2 / 2);
			$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
			$this->Line( $r1, $mid, $r2, $mid);
			$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
			$this->SetFont( "helvetica", "B", 10);
			$this->Cell(10,5, "CLIENT", 0, 0, "C");
			$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
			$this->SetFont( "helvetica", "", 10);
			$this->Cell(10,5,$ref, 0,0, "C");
		}

		public function addPageNumber( $page )
		{
			$r1  = $this->w - 80;
			$r2  = $r1 + 19;
			$y1  = 17;
			$y2  = $y1;
			$mid = $y1 + ($y2 / 2);
			$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
			$this->Line( $r1, $mid, $r2, $mid);
			$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
			$this->SetFont( "helvetica", "B", 10);
			$this->Cell(10,5, "PAGE", 0, 0, "C");
			$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
			$this->SetFont( "helvetica", "", 10);
			$this->Cell(10,5,$page, 0,0, "C");
		}

		// Client address
		public function addClientAdresse( $adresse )
		{
			$r1     = $this->w - 80;
			$r2     = $r1 + 68;
			$y1     = 40;
			$this->SetXY( $r1, $y1);
			$this->MultiCell( 60, 4, $adresse);
		}

		// Mode of payment
		public function clientData($tipo,$num_doc )
		{
			$r1  = 10;
			$r2  = $r1 + 150;
			$y1  = 30;
			$y2  = $y1;
			$mid = $y1 + (($y2-$y1) / 2);
			$this->SetXY( $r1+5, $y1+1 );
			$this->SetFont( "helvetica", "", 8);
			$this->Cell(20,4, "SEÑOR : ", 0, 0, "");		
			$this->MultiCell(200, 4.2, $tipo,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 9 );
			$this->Cell(20,4, "ASUNTO:", 0, 0, "");
			$this->MultiCell(200, 4.2, $num_doc,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 17 );
		}

		// VAT number
		public function docDetail($fech_emi,$fech_ven,$cond_venta,$n_prof,$name_vend,$hora_emi)
		{
			$this->SetFont( "helvetica", "B", 9);
			$r1  = $this->w - 90;
			$r2  = $r1 + 78;
			$y1  = 40;
			$y2  = $y1+10;
			$mid = $y1 + (($y2-$y1) / 2);
			$this->RoundedRect($r1, $y1, 80, 27, 0, 'D');
			$this->SetXY( $r1 + 5 , $y1+1 );
			$this->SetFont( "helvetica", "", 7);

			$this->Cell(25,4, utf8_decode("Fecha de Emision:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $fech_emi);
			$this->SetXY( $r1 + 5 , $y1 + 5 );
			$this->Cell(25,4, utf8_decode("Vencimiento:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $fech_ven,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 9 );
			$this->Cell(25,4, utf8_decode("Condicion de Venta:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $cond_venta,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 13 );
			$this->Cell(25,4, utf8_decode("Nro. de proforma:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $n_prof,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 17 );
			$this->Cell(25,4, utf8_decode("Vendedor:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $name_vend,'','L');
			$this->SetXY( $r1 + 5 , $y1 + 21 );
			$this->Cell(25,4, utf8_decode("Hora de Emision:"), 0, 0, "");
			$this->MultiCell(80, 4.2, $hora_emi,'','L');
		}

		public function DocData($Doc_rem,$name_remi,$doc_con ,$name_con, $num_guia_client, $peso_env, $origen, $destino )
		{
			$r1  = 10;
			$r2  = $r1 + 100;
			$y1  = 69;
			$y2  = $y1+100;
			$mid = $y1 + (($y2-$y1) / 2);
			$this->RoundedRect($r1, $y1, 190, 19, 0, 'D');
			$this->SetXY( $r1+5, $y1+1 );
			$this->SetFont( "helvetica", "", 7);
			
			$this->Cell(25,4, "Doc.Remitente:", 0, 0, "");
			$this->MultiCell(80, 4.2, $Doc_rem,'','L');

			$this->SetXY( $r1 + 65 , $y1 + 1 );
			$this->Cell(25,4, "Nomb.Remitente:", 0, 0, "");		
			$this->MultiCell(80, 25, $name_remi,'','L');

			$this->SetXY( $r1 + 5 , $y1 + 5 );
			$this->Cell(25,4, "Doc.Consignatario:", 0, 0, "");		
			$this->MultiCell(80, 4.2, $doc_con,'','L');

			$this->SetXY( $r1 + 65 , $y1 + 5 );
			$this->Cell(25,4, "Nomb.Consignatario:", 0, 0, "");		
			$this->MultiCell(80, 25, $name_con,'','L');

			$this->SetXY( $r1 + 5 , $y1 + 9 );
			$this->Cell(25,4, "Num.Guia.Cliente:", 0, 0, "");		
			$this->MultiCell(80, 4.2, $num_guia_client,'','L');

			$this->SetXY( $r1 + 65 , $y1 + 9 );
			$this->Cell(25,4, "Peso envio:", 0, 0, "");		
			$this->MultiCell(80, 25, $peso_env,'','L');

			$this->SetXY( $r1 + 5 , $y1 + 13 );
			$this->Cell(25,4, "ORIGEN ENVIO:", 0, 0, "");		
			$this->MultiCell(80, 4.2, $origen,'','L');

			$this->SetXY( $r1 + 65 , $y1 + 13 );
			$this->Cell(25,4, "DESTINO ENVIO:", 0, 0, "");		
			$this->MultiCell(80, 25, $destino,'','L');


			
		}


		// Expiry date
		public function addEcheance( $date )
		{
			$r1  = 80;
			$r2  = $r1 + 40;
			$y1  = 80;
			$y2  = $y1+10;
			$mid = $y1 + (($y2-$y1) / 2);
			$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
			$this->Line( $r1, $mid, $r2, $mid);
			$this->SetXY( $r1 + ($r2 - $r1)/2 - 5 , $y1+1 );
			$this->SetFont( "helvetica", "B", 10);
			$this->Cell(10,4, "DATE D'ECHEANCE", 0, 0, "C");
			$this->SetXY( $r1 + ($r2-$r1)/2 - 5 , $y1 + 5 );
			$this->SetFont( "helvetica", "", 10);
			$this->MultiCell(60,5,$date);
		}

		
		public function addReference($ref)
		{
			$this->SetFont( "helvetica", "", 10);
			$length = $this->GetStringWidth( "Références : " . $ref );
			$r1  = 10;
			$r2  = $r1 + $length;
			$y1  = 92;
			$y2  = $y1+5;
			$this->SetXY( $r1 , $y1 );
			$this->Cell($length,4, "Références : " . $ref);
		}

		public function addCols( $tab,$tipo_commend=0)
		{
			global $colonnes;
			
			$r1  = 10;
			$r2  = $this->w - ($r1 * 2) ;
			if ($tipo_commend==1) {
				$y1  = 90;
			}else{
				$y1  = 70;
			}
			
			$y2  = $this->h - 120 - $y1;
			$this->SetXY( $r1, $y1 );
			$this->Rect( $r1, $y1, $r2, $y2, "D");
			$this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
			$colX = $r1;
			$colonnes = $tab;
			while ( list( $lib, $pos ) = each ($tab) )
			{
				$this->SetXY( $colX, $y1+2 );
				$this->Cell( $pos, 1, $lib, 0, 0, "C");
				$colX += $pos;
				$this->Line( $colX, $y1, $colX, $y1+$y2);
			}
		}

		public function addLineFormat( $tab )
		{
			global $format, $colonnes;
			
			while ( list( $lib, $pos ) = each ($colonnes) )
			{
				if ( isset( $tab["$lib"] ) )
					$format[ $lib ] = $tab["$lib"];
			}
		}

		public function lineVert( $tab )
		{
			global $colonnes;

			reset( $colonnes );
			$maxSize=0;
			while ( list( $lib, $pos ) = each ($colonnes) )
			{
				$texte = $tab[ $lib ];
				$longCell  = $pos -2;
				$size = $this->sizeOfText( $texte, $longCell );
				if ($size > $maxSize)
					$maxSize = $size;
			}
			return $maxSize;
		}

		// add a line to the invoice/estimate
		/*    $ligne = array( "REFERENCE"    => $prod["ref"],
		                      "DESIGNATION"  => $libelle,
		                      "QUANTITE"     => sprintf( "%.2F", $prod["qte"]) ,
		                      "P.U. HT"      => sprintf( "%.2F", $prod["px_unit"]),
		                      "MONTANT H.T." => sprintf ( "%.2F", $prod["qte"] * $prod["px_unit"]) ,
		                      "TVA"          => $prod["tva"] );
		*/
		public function addLine( $ligne, $tab )
		{
			global $colonnes, $format;

			$ordonnee     = 10;
			$maxSize      = $ligne;

			reset( $colonnes );
			while ( list( $lib, $pos ) = each ($colonnes) )
			{
				$longCell  = $pos -2;
				$texte     = $tab[ $lib ];
				$length    = $this->GetStringWidth( $texte );
				$tailleTexte = $this->sizeOfText( $texte, $length );
				$formText  = $format[ $lib ];
				$this->SetXY( $ordonnee, $ligne-1);
				$this->MultiCell( $longCell, 4 , $texte, 0, $formText);
				if ( $maxSize < ($this->GetY()  ) )
					$maxSize = $this->GetY() ;
				$ordonnee += $pos;
			}
			return ( $maxSize - $ligne );
		}

		public  function detailDoc($monto,$web,$hash)
		{
			$this->SetFont( "helvetica", "", 8);
			$length = 150;
			$r1  = 10;
			$r2  = $r1 + $length;
			$y1  = $this->h - 115;
			$y2  = $y1+5;
			$this->SetXY( $r1 , $y1 );
			$this->Cell($length,4, "SON : " .numtoletras($monto));
			$this->SetXY( $r1 , $y1+5 );
			$this->Cell($length,4, "Para consultar el comprobante ingrese a  ".$web);
			$this->SetXY( $r1 , $y1+9 );
			$this->Cell($length,4, "Codigo HASH : ".$hash);
		}

		public function addCadreTVAs()
		{
			$this->SetFont( "helvetica", "B", 8);
			$r1  = 10;
			$r2  = $r1 + 120;
			$y1  = $this->h - 40;
			$y2  = $y1+20;
			$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
			$this->Line( $r1, $y1+4, $r2, $y1+4);
			$this->Line( $r1+5,  $y1+4, $r1+5, $y2); // avant BASES HT
			$this->Line( $r1+27, $y1, $r1+27, $y2);  // avant REMISE
			$this->Line( $r1+43, $y1, $r1+43, $y2);  // avant MT TVA
			$this->Line( $r1+63, $y1, $r1+63, $y2);  // avant % TVA
			$this->Line( $r1+75, $y1, $r1+75, $y2);  // avant PORT
			$this->Line( $r1+91, $y1, $r1+91, $y2);  // avant TOTAUX
			$this->SetXY( $r1+9, $y1);
			$this->Cell(10,4, "BASES HT");
			$this->SetX( $r1+29 );
			$this->Cell(10,4, "REMISE");
			$this->SetX( $r1+48 );
			$this->Cell(10,4, "MT TVA");
			$this->SetX( $r1+63 );
			$this->Cell(10,4, "% TVA");
			$this->SetX( $r1+78 );
			$this->Cell(10,4, "PORT");
			$this->SetX( $r1+100 );
			$this->Cell(10,4, "TOTAUX");
			$this->SetFont( "helvetica", "B", 6);
			$this->SetXY( $r1+93, $y2 - 8 );
			$this->Cell(6,0, "H.T.   :");
			$this->SetXY( $r1+93, $y2 - 3 );
			$this->Cell(6,0, "T.V.A. :");
		}

		public function addTotals($data)
		{
			$r1  = $this->w - 100;
			$r2  = $r1 + 60;
			$y1  = $this->h - 115;
			$y2  = $y1+25;
			$rf  = $this->w - 35;
			//$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 0, 'D');
			$this->SetFont( "helvetica", "", 8);
			
			$this->SetXY( $r1, $y1 );
			$this->Cell(65,4, "Operaciones Gravadas : S/ ", 0, 0, "R");
			
			$this->SetXY( $r1, $y1+4 );
			$this->Cell(65,4, "Operaciones Inafectas : S/ ", 0, 0, "R");
			
			$this->SetXY( $r1, $y1+8 );
			$this->Cell(65,4, "Operaciones Gratuitas : S/ ", 0, 0, "R");
			
			$this->SetXY( $r1, $y1+12 );
			$this->Cell(65,4, "Operaciones Exoneradas : S/ ", 0, 0, "R");

			$this->SetXY( $r1, $y1+16 );
			$this->Cell(65,4, "Descuento Total : S/ ", 0, 0, "R");

			$this->Line( $r1+90, $y1+21, $r2+10, $y1+21);

			$this->SetXY( $r1, $y1+22 );
			$this->Cell(65,4, "Sub-Total : S/ ", 0, 0, "R");

			$this->SetXY( $r1, $y1+26 );
			$this->Cell(65,4, "I.G.V.: S/ ", 0, 0, "R");
			
			$this->SetFont( "helvetica", "B", 8);
			$this->SetXY( $r1, $y1+30 );
			$this->Cell(65,4, "Importe Total.: S/ ", 0, 0, "R");
			
			$this->SetFont( "helvetica", "", 8);
			$this->SetXY( $rf, $y1 );
			$this->Cell( 25,4, number_format($data['grav'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+4 );
			$this->Cell( 25,4, number_format($data['inaf'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+8 );
			$this->Cell( 25,4, number_format($data['grat'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+12 );
			$this->Cell( 25,4, number_format($data['exon'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+16 );
			$this->Cell( 25,4, number_format($data['desc'],2), 0, '', 'R');

			$this->SetXY( $rf, $y1+22 );
			$this->Cell( 25,4, number_format($data['subto'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+26 );
			$this->Cell( 25,4, number_format($data['igv'],2), 0, '', 'R');
			$this->SetXY( $rf, $y1+30 );
			$this->SetFont( "helvetica", "B", 8);
			$this->Cell( 25,4, number_format($data['total'],2), 0, '', 'R');
			/*
			$centralExcise = $sub_total['central_excise_rs']." (".$sub_total['central_excise']."%)";
			$this->SetXY( $rf, $y1+6 );
			$this->Cell( 25,4, $centralExcise, '', '', 'R');
			$vatRupees = $sub_total['vat_rupees']." (".$sub_total['vat']."%)";
			$this->SetXY( $rf, $y1+11 );
			$this->Cell( 25,4, $vatRupees, '', '', 'R');
			
			$this->SetXY( $rf, $y1+16 );
			$this->Cell( 25,4, $sub_total['freight'], '', '', 'R');
			
			$this->SetXY( $rf, $y1+21 );
			$this->Cell( 25,4, "INR ".$sub_total['final_amount'], '', '', 'R');
			*/
		}
		public function addTVAs( $params, $tab_tva, $invoice )
		{
			$this->SetFont('helvetica','',8);
			
			reset ($invoice);
			$px = array();
			while ( list( $k, $prod) = each( $invoice ) )
			{
				$tva = $prod["tva"];
				@ $px[$tva] += $prod["qte"] * $prod["px_unit"];
			}

			$prix     = array();
			$totalHT  = 0;
			$totalTTC = 0;
			$totalTVA = 0;
			$y = 261;
			reset ($px);
			natsort( $px );
			while ( list($code_tva, $articleHT) = each( $px ) )
			{
				$tva = $tab_tva[$code_tva];
				$this->SetXY(17, $y);
				$this->Cell( 19,4, sprintf("%0.2F", $articleHT),'', '','R' );
				if ( $params["RemiseGlobale"]==1 )
				{
					if ( $params["remise_tva"] == $code_tva )
					{
						$this->SetXY( 37.5, $y );
						if ($params["remise"] > 0 )
						{
							if ( is_int( $params["remise"] ) )
								$l_remise = $param["remise"];
							else
								$l_remise = sprintf ("%0.2F", $params["remise"]);
							$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
							$articleHT -= $params["remise"];
						}
						else if ( $params["remise_percent"] > 0 )
						{
							$rp = $params["remise_percent"];
							if ( $rp > 1 )
								$rp /= 100;
							$rabais = $articleHT * $rp;
							$articleHT -= $rabais;
							if ( is_int($rabais) )
								$l_remise = $rabais;
							else
								$l_remise = sprintf ("%0.2F", $rabais);
							$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
						}
						else
							$this->Cell( 14.5,4, "ErrorRem", '', '', 'R' );
					}
				}
				$totalHT += $articleHT;
				$totalTTC += $articleHT * ( 1 + $tva/100 );
				$tmp_tva = $articleHT * $tva/100;
				$a_tva[ $code_tva ] = $tmp_tva;
				$totalTVA += $tmp_tva;
				$this->SetXY(11, $y);
				$this->Cell( 5,4, $code_tva);
				$this->SetXY(53, $y);
				$this->Cell( 19,4, sprintf("%0.2F",$tmp_tva),'', '' ,'R');
				$this->SetXY(74, $y);
				$this->Cell( 10,4, sprintf("%0.2F",$tva) ,'', '', 'R');
				$y+=4;
			}

			if ( $params["FraisPort"] == 1 )
			{
				if ( $params["portTTC"] > 0 )
				{
					$pTTC = sprintf("%0.2F", $params["portTTC"]);
					$pHT  = sprintf("%0.2F", $pTTC / 1.196);
					$pTVA = sprintf("%0.2F", $pHT * 0.196);
					$this->SetFont('helvetica','',6);
					$this->SetXY(85, 261 );
					$this->Cell( 6 ,4, "HT : ", '', '', '');
					$this->SetXY(92, 261 );
					$this->Cell( 9 ,4, $pHT, '', '', 'R');
					$this->SetXY(85, 265 );
					$this->Cell( 6 ,4, "TVA : ", '', '', '');
					$this->SetXY(92, 265 );
					$this->Cell( 9 ,4, $pTVA, '', '', 'R');
					$this->SetXY(85, 269 );
					$this->Cell( 6 ,4, "TTC : ", '', '', '');
					$this->SetXY(92, 269 );
					$this->Cell( 9 ,4, $pTTC, '', '', 'R');
					$this->SetFont('helvetica','',8);
					$totalHT += $pHT;
					$totalTVA += $pTVA;
					$totalTTC += $pTTC;
				}
				else if ( $params["portHT"] > 0 )
				{
					$pHT  = sprintf("%0.2F", $params["portHT"]);
					$pTVA = sprintf("%0.2F", $params["portTVA"] * $pHT / 100 );
					$pTTC = sprintf("%0.2F", $pHT + $pTVA);
					$this->SetFont('helvetica','',6);
					$this->SetXY(85, 261 );
					$this->Cell( 6 ,4, "HT : ", '', '', '');
					$this->SetXY(92, 261 );
					$this->Cell( 9 ,4, $pHT, '', '', 'R');
					$this->SetXY(85, 265 );
					$this->Cell( 6 ,4, "TVA : ", '', '', '');
					$this->SetXY(92, 265 );
					$this->Cell( 9 ,4, $pTVA, '', '', 'R');
					$this->SetXY(85, 269 );
					$this->Cell( 6 ,4, "TTC : ", '', '', '');
					$this->SetXY(92, 269 );
					$this->Cell( 9 ,4, $pTTC, '', '', 'R');
					$this->SetFont('helvetica','',8);
					$totalHT += $pHT;
					$totalTVA += $pTVA;
					$totalTTC += $pTTC;
				}
			}

			$this->SetXY(114,266.4);
			$this->Cell(15,4, sprintf("%0.2F", $totalHT), '', '', 'R' );
			$this->SetXY(114,271.4);
			$this->Cell(15,4, sprintf("%0.2F", $totalTVA), '', '', 'R' );

			$params["totalHT"] = $totalHT;
			$params["TVA"] = $totalTVA;
			$accompteTTC=0;
			if ( $params["AccompteExige"] == 1 )
			{
				if ( $params["accompte"] > 0 )
				{
					$accompteTTC=sprintf ("%.2F", $params["accompte"]);
					if ( strlen ($params["Remarque"]) == 0 )
						$this->addBanckDetails( "Accompte de $accompteTTC Euros exigé à la commande.");
					else
						$this->addBanckDetails( $params["Remarque"] );
				}
				else if ( $params["accompte_percent"] > 0 )
				{
					$percent = $params["accompte_percent"];
					if ( $percent > 1 )
						$percent /= 100;
					$accompteTTC=sprintf("%.2F", $totalTTC * $percent);
					$percent100 = $percent * 100;
					if ( strlen ($params["Remarque"]) == 0 )
						$this->addBanckDetails( "Accompte de $percent100 % (soit $accompteTTC Euros) exigé à la commande." );
					else
						$this->addBanckDetails( $params["Remarque"] );
				}
				else
					$this->addBanckDetails( "Drôle d'acompte !!! " . $params["Remarque"]);
			}
			else
			{
				if ( strlen ($params["Remarque"]) > 0 )
					$this->addBanckDetails( $params["Remarque"] );
			}
			$re  = $this->w - 50;
			$rf  = $this->w - 29;
			$y1  = $this->h - 48;
			$this->SetFont( "helvetica", "", 8);
				
			/* $this->SetXY( $rf, $y1+1 );
			$this->Cell( 17,4, "Rs2000000", '', '', 'R');
			
			$this->SetXY( $rf, $y1+6 );
			$this->Cell( 17,4, "Rs2000000", '', '', 'R');
			
			$this->SetXY( $rf, $y1+11 );
			$this->Cell( 17,4, "Rs2000000", '', '', 'R');
			
			$this->SetXY( $rf, $y1+15.5 );
			$this->Cell( 17,4, "Rs2000000", '', '', 'R'); */
		}

		// add a watermark (temporary estimate, DUPLICATA...)
		// call this method first
		public function temporaire( $texte )
		{
			$this->SetFont('helvetica','B',50);
			$this->SetTextColor(203,203,203);
			$this->Rotate(45,55,190);
			$this->Text(55,190,$texte);
			$this->Rotate(0);
			$this->SetTextColor(0,0,0);
		}
}


//$pdf = new xtcpdf($orientation='P', $unit='mm', array(260,105), $unicode=true, 'UTF-8', $diskcache=false, $pdfa=false);
//$pdf = new xtcpdf($orientation='P', $unit='mm', 'a4', '', 'UTF-8', $diskcache=false, $pdfa=false);
//$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf = new xtcpdf($orientation='P', $unit='mm', 'a4', $unicode=true, 'UTF-8', $diskcache=false, $pdfa=false);


// set document information
$pdf->SetCreator('CoderFac');
$pdf->SetAuthor('Grupo Coder SAC');
$pdf->SetTitle('Factura Electrónica');
$pdf->SetSubject('www.coder.com.pe');
$pdf->SetKeywords('Factura Electronica, Grupo Coder SAC, Facturación, Desarrollo de Sistemas de Información');

 


//Indicamos la creación de nuevas paginas automaticas al crecer el contenido
$pdf->SetAutoPageBreak(true, 15);
 
//agregamos la primera hoja al pdf
$pdf->AddPage ();
// Logo de Empresa
//$image_file = WWW_ROOT.'img'.DS.'logo.png';
		//$pdf->Image('..//', 17, 10, 60, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
	
		
		$pdf->Image($url_base.'/img/logo.png',10,6,30,18,'PNG'); //logo de la empresa
		
		$pdf->addSociete($razon_empresa->value,$direccion_empresa->value."\n".$urb_empresa->value.' -- '.$dist_empresa->value.' - '.$prov_empresa->value.' - '.$dep_empresa->value."\n \n"."\n");
				// Set font
		if ($tipo=='0') {
			$pdf->addDataDocument( 'INFORME DE VENTAS' , $user->names , date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' - '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN)) );
		}else{
			$pdf->addDataDocument( 'INFORME DE VENTAS' , $agencia->name , date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' - '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN)));
		}
		

		$pdf->SetFont('helvetica','B',12);

		$pdf->clientData($rep_legal->value."\n GERENTE GENERAL DE ".$razon_empresa->value, 'LIQUIDACION del '. date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' al '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN)) );

		$pdf->SetFont('helvetica', '', 7);

		$tbl = '
<table cellspacing="0" cellpadding="2" border="1">
	<tr>
	  <th height="13" colspan="9" align="center" style="padding;">RESUMEN GENERAL DE INGRESOS Y GASTOS</th>
	</tr>
    <tr>
        <td width="40" height="13" align="center">FECHA</td>
        <td width="100" align="center">DOC.</td>
        <td width="27" align="center">SERIE</td>
        <td width="80" align="center" colspan="2">CORRELATIVO</td>
        <td width="48" align="center" style="background-color:#85C1E9;">INGRESOS</td>
        <td width="65" align="center" style="background-color:#CD6155;">OTR. INGRESOS</td>
        <td width="50" align="center" style="background-color:#F8C471;">GASTOS</td>
        <td width="70" align="center" style="background-color:#FF99FF;">CRED.x COBRAR</td>
        <td align="center" style="background-color:#FFEE58;">TOTAL</td>
    </tr>';

    $sum_cantidad=0;
	$sum_totales=0;

	if ( strtotime(date('Y-m-d',strtotime($dateConsultaINI))) == strtotime(date('Y-m-d',strtotime($dateConsultaFIN))) ) {
		$fecha_rep=date('d/m/Y',strtotime($dateConsultaINI));
	}else{
		$fecha_rep='-';
	}

	foreach ($resumen_pas as $key => $value) {				
    	$tbl .='<tr>
			  <td align="center">'.$fecha_rep.'</td>
			  <td align="left">PASAJES '.$value->serie.'</td>
			  <td align="center">'.$value->serie.'</td>
			  <td align="center">'.$value->inicial.'</td>
			  <td align="center">'.$value->final.'</td>
			  <td align="right">'.number_format($resumen_pas_total[$key]->toArray()[0]->total,2).'</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			</tr>';

		$sum_totales=$sum_totales+$resumen_pas_total[$key]->toArray()[0]->total;
    	$sum_cantidad=$sum_cantidad+$value->cantidad;
    }

    foreach ($resumen_enc as $key => $value) {			
    	$tbl .='<tr>
			  <td align="center">'.$fecha_rep.'</td>
			  <td align="left">ENCOMIENDAS '.$value->serie.'</td>
			  <td align="center">'.$value->serie.'</td>
			  <td align="center">'.$value->inicial.'</td>
			  <td align="center">'.$value->final.'</td>
			  <td align="right">'.number_format($resumen_enc_total[$key]->toArray()[0]->total,2).'</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			  <td align="center">-</td>
			</tr>';

		$sum_totales=$sum_totales+$resumen_enc_total[$key]->toArray()[0]->total;
    	$sum_cantidad=$sum_cantidad+$value->cantidad;
    }
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
    $tbl.='<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">'.number_format($total_excesos,2).'</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">'.number_format($total_gastos,2).'</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    	<td width="40" height="13" align="center"></td>
        <td width="100" align="center"></td>
        <td width="27" align="center"></td>
        <td width="80" align="center" colspan="2"></td>
        <td width="48" align="right" style="background-color:#85C1E9;">'.number_format($sum_totales,2).'</td>
        <td width="65" align="right" style="background-color:#CD6155;">'.number_format($total_excesos,2).'</td>
        <td width="50" align="right" style="background-color:#F8C471;">'.number_format($total_gastos,2).'</td>
        <td width="70" align="right" style="background-color:#FF99FF;"></td>
        <td align="right" style="background-color:#FFEE58;">'.number_format(($sum_totales+$total_excesos)-$total_gastos,2).'</td>
        
    </tr>


</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetFont('helvetica', 'I', 9);
$pdf->MultiCell(120, 0, 'Nro. DE DEPOSITO : ___________________________________ ', 0, 'L', 0, 0, '', '', true);

$pdf->Ln(15);
$pdf->SetFont('helvetica', 'N', 7);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 0, '_________________________________', 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 0, '_________________________________', 0, 'C', 0, 0, '', '', true);

$pdf->Ln(4);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 0, $rep_legal->value, 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
if ($tipo=='0') {
	$pdf->MultiCell(50, 0, $user->names.' '.$user->lasname, 0, 'C', 0, 0, '', '', true);
}else{
	$pdf->MultiCell(50, 0, '________________________', 0, 'C', 0, 0, '', '', true);
}


$pdf->Ln(4);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 0, 'GERENTE GENERAL', 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true);
if ($tipo=='0') {
	$pdf->MultiCell(50, 0, 'PERSONAL DE OFICINA', 0, 'C', 0, 0, '', '', true);
}else{
	$pdf->MultiCell(50, 0, 'ENCARGADO(A) DE OFICINA', 0, 'C', 0, 0, '', '', true);
}



if (count($resumen_enc_2)) {
	$pdf->Ln(10);
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(20,3, "VENTA EN ENCOMIENDAS ", 0, 0, "");
	$pdf->Ln();
	$pdf->Cell(50,3,'NOMBRES',1,0,'L');
	$pdf->Cell(25,3,'EFECTIVO',1,0,'R',0,1);
	foreach ($resumen_enc_2 as $key => $value) {
		$pdf->SetFont('helvetica','',7);
		$pdf->Ln();
		$pdf->Cell(50,3,substr(strtoupper($value->user->names.' '.$value->user->surnames),0,27) ,1,0,'L',0);	
		$pdf->Cell(25,3,number_format($value->total,2),1,0,'R'); //total efectivo	
	}
}


if (count($resumen_pas_2)) {
	$pdf->Ln(8);
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(20,3, "VENTA EN PASAJES ", 0, 0, "");
	$pdf->Ln();
	$pdf->Cell(50,3,'NOMBRES',1,0,'L');
	$pdf->Cell(25,3,'EFECTIVO',1,0,'R');
	foreach ($resumen_pas_2 as $key => $value) {
		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(50,3,substr(strtoupper($value->user->names.' '.$value->user->surnames),0,27) ,1,0,'L',0);	
		$pdf->Cell(25,3,number_format($value->total,2),1,0,'R'); //total efectivo	
	}
}


if (count($resumen_exc_2)) {
	$pdf->Ln(8);
	$pdf->SetFont('helvetica','B',7);
	$pdf->Cell(20,3, "VENTA EN INGRESOS EXTRA", 0, 0, "");
	$pdf->Ln();
	$pdf->Cell(50,3,'NOMBRES',1,0,'L');
	$pdf->Cell(25,3,'EFECTIVO',1,0,'R');
	foreach ($resumen_exc_2 as $key => $value) {
		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(50,3,substr(strtoupper($value->user->names.' '.$value->user->surnames),0,27) ,1,0,'L',0);	
		$pdf->Cell(25,3,number_format($value->total,2),1,0,'R'); //total efectivo	
	}
}


/*

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
} */


/*
		$pdf->docDetail($datos['created']->format('d/m/Y'),$datos['created']->format('d/m/Y'),'CONTADO','-',substr($datos['user']['names'].' '.$datos['user']['surnames'],0,25),$datos['created']->format('H:i a'));
		if ($tipo==1) {
			$cols=array( "CODIGO"    => 15,
					 "CANTIDAD"    => 15,
					 "UNI"    => 10,
					 "DESCRIPCION (Dice contener)"  => 100,
					 "PRECIO UNITARIO"      => 25,
					 "TOTAL" => 25);
			$pdf->addCols( $cols,1);
			$pdf->DocData(($datos->doc=='01') ? $datos['client']['ruc']:$datos['client']['document'], ($datos->doc=='01') ? $datos['client']['razon']:$datos['client']['surnames'].' '.$datos['client']['names'], '-', $datos['consig_name'], '-', '-', $datos['origen'], $datos['destino']);
			$cols=array("CODIGO"    => "C",
					 "CANTIDAD"  => "C",
					 "UNI"     => "C",
					 "DESCRIPCION (Dice contener)"  => "L",
					 "PRECIO UNITARIO" => "C",
					 "TOTAL"      => "C");
		}else{
			$cols=array( "CODIGO"    => 15,
					 "CANTIDAD"    => 15,
					 "UNI"    => 10,
					 "DESCRIPCION"  => 100,
					 "PRECIO UNITARIO"      => 25,
					 "TOTAL" => 25);
			$pdf->addCols( $cols);
			$cols=array("CODIGO"    => "C",
					 "CANTIDAD"  => "C",
					 "UNI"     => "C",
					 "DESCRIPCION"      => "L",
					 "PRECIO UNITARIO" => "C",
					 "TOTAL"      => "C");

		}
		

		$pdf->addLineFormat($cols);
		$pdf->addLineFormat($cols);

		
		$sno = 1;
		

		$total_pagar=0;
		$uni_arry=array();
		$decript_arry=array();
		$quantity=array();
		$unit_cost=array();
		$total_amount=array();
		if ($tipo==1) {
			$y    = 100;
	        foreach ($datos['detail_commends'] as $value) {
	            $prec=$value['total'];
	            $total_pagar=$total_pagar+$prec;
	            array_push($uni_arry,'UNI');
	            array_push($decript_arry,$value['content']);
	            array_push($quantity,$value['quantity']);
	            array_push($unit_cost,$value['price']);
	            array_push($total_amount,$value['total']);           
	        }
	    }else{
	    	$y    = 80;
	    	array_push($uni_arry,'UNI');
            array_push($decript_arry,$datos['content']);
            array_push($quantity,'1');
            array_push($unit_cost,$datos['price']);
            array_push($total_amount,$datos['price']);
            $total_pagar=$datos['price'];
	    }

		foreach($decript_arry AS $key=>$val) {	
			if ($tipo==1) {		
				$line = array( "CODIGO"    => '-',				
	               "CANTIDAD"     => $quantity[$key],
				   "UNI"    => $uni_arry[$key],
	               "DESCRIPCION (Dice contener)"  => $decript_arry[$key],
	               "PRECIO UNITARIO"      => number_format($unit_cost[$key],2),
	               "TOTAL" => number_format($total_amount[$key],2));
			}else{
				$line = array( "CODIGO"    => '-',				
	               "CANTIDAD"     => $quantity[$key],
				   "UNI"    => $uni_arry[$key],
	               "DESCRIPCION"  => $decript_arry[$key],
	               "PRECIO UNITARIO"      => number_format($unit_cost[$key],2),
	               "TOTAL" => number_format($total_amount[$key],2));
			}
			$size = $pdf->addLine( $y, $line );
			$y   += $size + 1;
			$sno++;
		}

		
            //$igvRecibido=intval($tributo);
            $igv = '1.'.$impuesto['valor'];
            

        if ($con_igv==1) {
        	$subto=$total_pagar/$igv;
            $sub_total_details = array("grav"=>$subto,"inaf"=>0,"grat"=>0,"exon"=>0,"desc"=>0,"subto"=>$subto,"igv"=>$datos['impuesto'],"total"=>$total_pagar);
        }else{ 
        	$subto=$total_pagar;
        	$sub_total_details = array("grav"=>0,"inaf"=>0,"grat"=>0,"exon"=>$subto,"desc"=>0,"subto"=>$subto,"igv"=>$datos['impuesto'],"total"=>$total_pagar);
        }

		
		$pdf->detailDoc($total_pagar,$pagina_web['value'],$datos['digestvalue']);
		$pdf->addTotals($sub_total_details);

		// set style for barcode
		$style = array(
		    'border' => 1,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		$clientDOC=($datos->doc=='01') ? $datos['client']['ruc']:$datos['client']['document'];

		$hub3_code = $ruc_empresa['value'].'|'.$datos['doc'].'|'.$datos['serie'].'|'.$datos['number'].'|'.number_format($datos['impuesto'],2).'|'.number_format($total_pagar,2).'|'.date('d-m-Y').'|-|'.$clientDOC.'|'.$datos['digestvalue']; 

		$pdf->write2DBarcode($hub3_code,'QRCODE',22,198,35,35,$style,'N');

		//$pdf->first_name=' Oficina : '.$agencia->name.' --- Fecha INICIO : '.date('d/m/Y h:i:s a',strtotime($dateConsultaINI)).' --- Fecha FINAL : '.date('d/m/Y h:i:s a',strtotime($dateConsultaFIN));
		//$url=$this->Url->build('/');
		$pdf->Ln(20);
		$pdf->SetFont('helvetica', 'I', 7);
		$pdf->Cell(0, 10, '* Fecha IMPRESION : '.date('d/m/Y h:i:s a'), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		*/
		$time = time();
		$file_name = "LIQUIDACION_".$time.".pdf";

$pdf->Output($file_name, 'I');
?>

