<?php echo $this->Html->script('jquery-2.1.1',array('inline'=>false)); ?>
<?php
############################################
## SISTEMA DE TRASPORTES - Control de Boletos          
## Por: Jefferson Jon La Torre Flores  edit Edwin Leonardo....                 
## email: Yeffer2@hotmail.com                         
## geniu - coder   Date: 14/11/2009       
## Descripcion :           
############################################
//App::import('View/Vendor', 'Cnumeroaletra');
//App::import('Vendor', 'cnumeroaletra');
//$numalet= new CNumeroaletra;
//$numalet->setNumero(str_replace(",","",$precio));
//$numalet->setMayusculas(1);
//$numalet->setGenero(1);
//$numalet->setMoneda("NUEVOS SOLES CON");
//
//$OrigenDestino=explode("-",$SaleDestinetitle);
//$FechaEmisionHora=explode(" ",$fechaventa)
//debug($datos);
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

?>
<?php if($autori==true){ ?>
		
        <div class='tabla'>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;font-size: 15px;font-weight: bold;'><b><?=$razon_empresa['value'];?></b></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;'><?=$direccion_empresa['value'];?></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;'>RUC:<?=$ruc_empresa['value'];?> </div>
            </div>
            <div class='fila' style='height:10px;'></div>
            <div class='fila'>
                <div class='col' style='width: 250px;font-size: 13px;text-align:center;'>
                <?php 
                if ($datos['client']['credit']==1) {
                    echo 'ENCOMIENDA CREDITO';
                }else{
                    echo 'ENCOMIENDA PAGO DESTINO';
                }
                ?>
                </div>
            </div>
        	<div class='fila'>
        		<div class='col' style='width: 250px;font-size: 13px;text-align:center;'><?php echo '('.$datos['agence']['code'].') - '.str_pad($datos['id'],7,'0',STR_PAD_LEFT);?></div>
        	</div>
            
			<div class='fila' style='height:8px;'></div>
            <div class='fila'>
                <div class='col' style='width: 250px;'><b>REMITENTE : </b></div>
            </div>
        	<div class='fila'>
                <div class='col' style='width: 250px;'><?php echo 'RUC : '.substr(strtoupper($datos['client']['ruc']), 0, 50); ?></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;'>RAZON : <?php echo substr(strtoupper($datos['client']['razon']), 0, 60); ?> </div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;'><?php echo 'NUM DOC : '.substr(strtoupper($datos['client']['document']), 0, 50); ?></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;'>SR(A) : <?php echo substr(strtoupper($datos['client']['surnames'].' '.$datos['client']['names']), 0, 60); ?> </div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;'><b>CONSIGNATARIO : </b></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;'>NOMBRE : <?php echo substr(strtoupper($datos['consig_name']), 0, 60); ?></div>
             </div>
            <div class='fila'>
                <div class='col' style='width: 125px;font-weight: bold;'> <u>ORIG:</u>: <?php echo substr($datos['origen'],0,10); ?></div>
                <div class='col' style='width: 125px;font-weight: bold;'> <u>DEST:</u>: <?php echo substr($datos['destino'],0,10); ?></div>             
            </div>
        	<div class='fila' style='height:7px;'></div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 40px;'><b>CANT</b></div>
                <div class='col' style='width: 160px;'><b>DICE CONTENER</b></div>
                <div class='col' style='width: 60px;'><b>PRECIO</b></div>
            </div>
            <?php 
            $total_pagar=0;
            $TotalCommends=0;
            foreach ($datos['detail_commends'] as $value) {
            	$prec=$value['total'];
                $total_pagar=$total_pagar+$prec;
                ?>
                <div class='fila' style='height: 16px;' >
                    <div class='col' style='width: 40px;'><?php echo $value['quantity'];?></div>
                    <div class='col' style='width: 140px;'><?php echo $value['content']; ?></div>
					<div class='col' style='width: 60px;text-align: right;'>S/ <?php echo number_format($prec,2); ?></div>
                </div>
                <?php
                $TotalCommends=$TotalCommends+$value['quantity'];
            }
            ?>
        <div class='fila' style='height:7px;'></div>  
        <div class='fila'>
            <div class='col' style='width: 180px;font-weight: bold;'><b>TOTAL</b></div>
            <div class='col' style='width: 60px;text-align: right;px;font-weight: bold;'>S/ <?php echo number_format($total_pagar,2);?></div>
        </div> 
        <div class='fila' style='height:8px;'></div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>SON : <?php echo numtoletras($total_pagar);?></div>
        </div>
        <div class='fila' style='height:8px;'></div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>Fecha-Hora EMI. <?php echo $datos['created']->format('d/m/Y g:i a');?></div>
        </div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>Fecha-Hora IMP. <?php echo date('d/m/Y g:i a')?></div>
        </div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>ATENDIDO POR: <?php echo $datos['user']['username'];?></div>
        </div>
    	<div class='fila'>
			<div class='col' style='width: 250px;'>IMPRIMIDO POR: <?php echo $user_name;?></div>
    	</div>
        <div class='fila'>
            <div class='col' style='width: 250px;text-align:center;font-weight: bold;'>*********************************</div>
        </div>
        <script>
        	
           jsPrintSetup.setPrinter('ticket');
           // set portrait orientation
           jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
           // set top margins in millimeters
           jsPrintSetup.setOption('marginTop', 0);
           jsPrintSetup.setOption('marginBottom', 0);
           <?php if($is_linux==1) { ?>
                jsPrintSetup.setOption('marginLeft', -3);
           <?php }else{ ?>
                jsPrintSetup.setOption('marginLeft', 4);
           <?php } ?>
           jsPrintSetup.setOption('marginRight', 0);
           //jsPrintSetup.definePaperSize(100, 100, 'boleta', 'boleta', 'prueba', 19.5, 8, jsPrintSetup.kPaperSizeInches);


           // set page header
			jsPrintSetup.setOption('headerStrLeft', '');
			jsPrintSetup.setOption('headerStrCenter', '');
			jsPrintSetup.setOption('headerStrRight', '');
			// set empty page footer
			jsPrintSetup.setOption('footerStrLeft', '');
			jsPrintSetup.setOption('footerStrCenter', '');
			jsPrintSetup.setOption('footerStrRight', '');

           jsPrintSetup.clearSilentPrint();
           // Suppress print dialog (for this context only)
           jsPrintSetup.setOption('printSilent', 1);


           // Do Print 
           // When print is submitted it is executed asynchronous and
           // script flow continues after print independently of completetion of print process! 
           //jsPrintSetup.print();
           jsPrintSetup.printWindow(window);
            // next commands
            //var ventana = window.self; 
            //ventana.opener = window.self; 
            //setTimeout("window.close()", 100);
            
        </script>


        <?php 
        //debug($print_taco);
        if ($print_taco==true) { 
              ?>
                <script type="text/javascript">
                    $(document).ready(function () {    //es para imprimir el taco
                        <?php for ($i=1; $i <= $TotalCommends; $i++) {  
                                if($i<=10){?>
                                setTimeout(function() {$("#frame_taco3").attr("src", "<?php echo $this->Url->build('/');?>sales/commendsPrinterTaco/<?php echo $datos['id'];?>?num=<?php echo $i;?>")}, <?php echo $i+2;?>000);
                            <?php }
                        } ?>
                    });
                </script>
        <?php } ?>

<?php
}
?>

<iframe width="1000" height="1000" src="" id='frame_taco3' allowfullscreen style="display: none;"></iframe>