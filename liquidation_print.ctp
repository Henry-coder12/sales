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

//debug($datos);

?>
    
        <div class='tabla'>
            <!--<div class='fila'>
                <div class='col' style='width: 230px;text-align:center;font-size: 15px;font-weight: bold;'>-->
                <?php //echo $this->Html->image('logo.png', ['width' => '220px;']);?>
                    
                <!--</div>
            </div>-->
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;font-size: 15px;font-weight: bold;'><b><?=$razon_empresa['value'];?></b></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;font-size: 9px;'><?=$direccion_empresa['value'];?></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;'>RUC:<?=$ruc_empresa['value'];?> </div>
            </div>
            <div class='fila' style='height:10px;'></div>
            <div class='fila'>
                <div class='col' style='width: 250px;font-size: 13px;text-align:center;'>LIQUIDACION POR <?php if ($tipo=='0') { echo 'PERSONAL'; }else{ echo 'AGENCIA';} ?> </div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;font-size: 13px;text-align:center;'><?php if ($tipo=='0') { echo $user->surnames.', '.$user->names; }else{ echo $agencia->name;} ?></div>
            </div>
            
            <div class='fila' style='height:7px;'></div>
            <div class='fila'>
                <div class='col' style='width: 260px;font-size: 13px;'> FECHA INICIO: <?php echo $dateConsultaINI; ?></div>
            </div>
            <div class='fila' style='height:10px;'>
                <div class='col' style='width: 260px;font-size: 13px;'> FECHA FINAL : <?php echo $dateConsultaFIN; ?></div>             
            </div>
            <div class='fila' style='height:10px;'></div>
            <hr>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 240px;font-size: 14px;text-align: center;font-weight: bold;'>DETALLE DE EGRESOS</div>
            </div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 210px;font-size: 12px;font-weight: bold;'>RC / DETALLE / AUTORIZA</div>
                <div class='col' style='width: 40px;font-size: 12px;text-align: right;font-weight: bold;'>TARIFA</div>
            </div>
            <?php 
            $total_gastos=0;
            foreach ($gastos as $gasto) { 
                $total_gastos=$total_gastos+$gasto->amount;
                ?>
                <div class='fila'>
                    <div class='col' style='width: 210px;font-size: 10px;'>
                        <?php if ($gasto->type_doc!='00') {
                                echo $gasto->serie_doc.'-'.$gasto->number_doc.' / '.$gasto->detail.' / '.$gasto->authorized;
                            } else {
                                echo $gasto->rc.' / '.$gasto->detail.' / '.$gasto->authorized;
                            } ?>
                    </div>
                    <div class='col' style='width: 40px;font-size: 10px;text-align: right;'><?php echo number_format(-1*$gasto->amount,2); ?></div>
                </div>
            <?php } ?>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 210px;font-size: 12px;text-align: right;font-weight: bold;'>SUB-TOTAL</div>
                <div class='col' style='width: 40px;font-size: 12px;text-align: right;font-weight: bold;'><?php echo number_format(-1*$total_gastos,2); ?></div>
            </div>
            <hr>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 240px;font-size: 14px;text-align: center;font-weight: bold;'>RESUMEN DE DEUDA</div>
            </div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 210px;font-size: 11px;font-weight: bold;'>AGENCIA / N. BOLETA / PASAJERO</div>
                <div class='col' style='width: 40px;font-size: 12px;text-align: right;font-weight: bold;'>(S/.)</div>
            </div>
            <?php 
            $total_pasajes=0;
            $total_pasajes_credito=0;
            //debug($ventas_pasajes);
            foreach ($ventas_pasajes as $value) {
                $Total=$value->price;
                $boleto=$value->serie.'-'.$value->number;
                $pasajero=$value->client->surnames.' '.$value->client->names;
                $Total=$value->price;
                if ($value->cancel_sale=='1') {
                }elseif ($value->postpone_sales_free>0) {
                    $total_pasajes=$total_pasajes+$Total;
                }elseif ($value->type_payment==0) {
                     $total_pasajes_credito=$total_pasajes_credito+$Total;
                     echo "<div class='fila'>
                            <div class='col' style='width: 210px;font-size: 9px;'>".$agent_ext[$value->id]->abrev." / ".$boleto." / ".$pasajero."</div>
                            <div class='col' style='width: 40px;font-size: 10px;text-align: right;'>".number_format($Total,2)."</div>
                        </div>";
                }elseif ($value->postpone_sale_id>0) {
                    $total_pasajes=$total_pasajes+$Total;
                }else{
                    $total_pasajes=$total_pasajes+$Total;
                }
                
             } ?>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 210px;font-size: 12px;text-align: right;font-weight: bold;'>SUB-TOTAL</div>
                <div class='col' style='width: 40px;font-size: 12px;text-align: right;font-weight: bold;'><?php echo number_format(-1*$total_pasajes_credito,2); ?></div>
            </div>
            <hr>


            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 15px;'>VENTA ENCOMIENDAS</div>
                <?php 
                $total_commends=0;
                foreach ($ventas_encomiendas as $value) {
                    $Total=$value->total;
                    if ($value->canceled=='0' and $value->prepaid=='1') {
                        $total_commends=$total_commends+$Total;
                    }
                    
                 } ?>
                <div class='col' style='width: 60px;font-size: 15px;text-align: right;'><?php echo number_format($total_commends,2); ?></div>
            </div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 15px;'>VENTA PASAJES.</div>
                <div class='col' style='width: 60px;font-size: 15px;text-align: right;'><?php echo number_format($total_pasajes,2); ?></div>
            </div>
            <div class='fila' style='height: 16px;' >
                
                <?php 
                $total_gastos=0;
                foreach ($gastos as $value) {
                    $Total=$value->amount;
                    if ($value->status==1) {
                        $total_gastos=$total_gastos+$Total;
                    }
                    
                } 
                $total_excesos=0;
                foreach ($excesos as $value) {
                    $Total=$value->total;
                    if ($value->canceled=='1') {
                    }else{
                        $total_excesos=$total_excesos+$Total;
                    }
                }
                ?>
                <div class='col' style='width: 160px;font-size: 15px;'>TOTAL EXCESOS</div>
                <div class='col' style='width: 60px;font-size: 15px;text-align: right;'><?php echo number_format($total_excesos,2); ?></div>
            </div>
            <div class='fila' style='height:5px;'></div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 13px;'>PASAJES CREDITO</div>
                <div class='col' style='width: 60px;font-size: 14px;text-align: right;'><?php echo number_format(-1*$total_pasajes_credito,2); ?></div>
            </div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 13px;'>TOTAL EGRESOS</div>
                <div class='col' style='width: 60px;font-size: 14px;text-align: right;'><?php echo number_format(-1*$total_gastos,2); ?></div>
            </div>
            <div class='fila' style='height:5px;'></div>
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 15px;'><b>LIQUIDACION TOTAL</b></div>
                <?php 
                $total=$total_commends+$total_pasajes+$total_excesos-$total_gastos;
                ?>
                <div class='col' style='width: 60px;font-size: 15px;text-align: right;'><b><?php echo number_format($total,2); ?></b></div>
            </div>           
        <div class='fila' style='height:5px;'></div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>SON : <?php echo numtoletras($total);?></div>
        </div>
        <div class='fila' style='height:8px;'></div>
        <div class='fila'>
            <div class='col' style='width: 250px;'>Fecha-Hora IMP. <?php echo date('d/m/Y g:i a')?></div>
        </div>
        <div class='fila' style='height:65px;'></div>
        <div class='fila'>
            <div class='col' style='width: 250px;text-align:center;font-weight: bold;'>*********************************</div>
        </div>
        <div class='fila'>
            <div class='col' style='width: 250px;text-align:center;font-weight: bold;'><?php if ($tipo=='0') { echo $user->surnames.', '.$user->names; }else{ echo $agencia->name;} ?></div>
        </div>
        <div class='fila'>
            <div class='col' style='width: 250px;text-align:center;font-weight: bold;'>*********************************</div>
        </div>
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


