<style type="text/css">
    body{
        font-family: Arial, Helvetica, sans-serif;
        font-size : 9pt;
        float: none;
        width: auto;
        margin: 0;
        padding: 0;
        color: #000;
        background: #fff;
        <? echo ($spacingLetter == true) ? "letter-spacing: 4pt;":"";?>
        /*letter-spacing: 4pt;       para separar entgre letras */
        /*word-spacing: 0pt;        para separacion entre palabras */
    }
    .Table{
        display: table;
    }
    .Title{
        display: table-caption;
        text-align: center;
        font-weight: bold;
        font-size: larger;
    }
    .Heading{
        display: table-row;
        font-weight: bold;
        text-align: center;
    }
    .Row{
        display: table-row;
    }
    .Cell{
        display: table-cell;
        border: solid;
        border-width: 0 1px 0 1px;
        padding-left: 2px;
        padding-right: 2px;
    }
    .Cell2{
        display: table-cell;
        border: solid;
        border-width: thin;
        padding-left: 2px;
        padding-right: 2px;
    }

</style>

<br>
<div class="Table">
    <div class="Title"><?=$razon_empresa->value;?></div>
    <div class="Heading">
        <div class="Cell" style="width: 35%;border: 0"></div>
        <div class="Cell" style="border: 0">LIQUIDACION DE VENTA</div>
        <div class="Cell" style="width: 35%;border: 0"></div>
    </div>
    <div class="Row">
        <div class="Cell" style="border: 0">FECHA INICIO: </div>
        <div class="Cell" style="border: 0"><?=date('d/m/Y h:i a',strtotime($dateConsultaINI))?></div>
        <div class="Cell" style="border: 0"></div>
    </div>
    <div class="Row">
        <div class="Cell" style="border: 0">FECHA FINAL:</div>
        <div class="Cell" style="border: 0"><?=date('d/m/Y h:i a',strtotime($dateConsultaFIN))?></div>
        <div class="Cell" style="border: 0"></div>
    </div>
    <div class="Row">
        <?
            if ($tipo=='0') {
                echo "<div class=\"Cell\" style=\"border: 0\">USUARIO: </div>";
                echo "<div class=\"Cell\" style=\"border: 0\">".$user->names.' '.$user->surnames."</div>";
            }else{
                echo "<div class=\"Cell\" style=\"border: 0\">OFICINA: </div>";
                echo "<div class=\"Cell\" style=\"border: 0\">".$agencia->name."</div>";
            }
        ?>
        <div class="Cell" style="border: 0"></div>
    </div>
</div>
<div class="Table">
    <div class="Heading">
        <div class="Cell2">FEC.VIAJE</div>
        <div class="Cell2">TURNO</div>
        <div class="Cell2">BUS</div>
        <div class="Cell2">RUTA</div>
        <div class="Cell2">IMPORTE</div>
        <div class="Cell2">PILOTO/COPILOTO</div>
        <div class="Cell2">C/BUS</div>
        <div class="Cell2">VDH</div>
        <div class="Cell2">VCA</div>
        <div class="Cell2">OCUP</div>
        <div class="Cell2">LIBRE</div>
    </div>

    <?
    $total=0;
    foreach($pass_data as $datos){
        $programationID=$datos->programation->id;
        echo " <div class=\"Row\">";
        echo "<div class=\"Cell\">".$datos->programation->date->format('d-m-Y')."</div>";
        echo "<div class=\"Cell\">".$datos->programation->hour->format('h:i A')."</div>";
        echo "<div class=\"Cell\">".$datos->programation->bus->plate."</div>";
        $routeExplode=explode(' - ',$datos->programation->route->name);
        echo "<div class=\"Cell\">".substr($routeExplode[0],0,8).' - '.substr($routeExplode[1],0,8)."</div>";

        echo "<div class=\"Cell\"  style=\"text-align: right\">".number_format($datos->sum,2)."</div>";
        $crews='';
        foreach ($crewsProgramation[$programationID] as $value) {
            $crews=$crews.substr($value->crew->names.' '.$value->crew->surnames,0,12).' / ';
        }

        echo "<div class=\"Cell\">".substr($crews, 0, strlen($crews) - 3)."</div>";

        echo "<div class=\"Cell\">".$datos->programation->bus->num_seats."</div>";
        echo "<div class=\"Cell\">".$datos->contar."</div>";
        echo "<div class=\"Cell\">".$countSaleAnterior[$programationID]."</div>";
        $ocu=$datos->contar+$countSaleAnterior[$programationID];
        $libre = $datos->programation->bus->num_seats-($datos->contar+$countSaleAnterior[$programationID]);
        echo "<div class=\"Cell\">".$ocu."</div>";
        echo "<div class=\"Cell\">".$libre."</div>";
        echo "</div>";
        $total=$total+$datos->sum;
    }
    ?>
    <div class="Heading">
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2">T. PASAJES S/ </div>
        <div class="Cell2" style="text-align: right"><?=number_format($total,2)?></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
    </div>
</div>
<br>
<div class="Table">
    <div class="Title">GASTOS</div>
    <div class="Heading">
        <div class="Cell2">N°</div>
        <div class="Cell2">BUS</div>
        <div class="Cell2">MONTO</div>
        <div class="Cell2">TD N°    /  DETALLE  /  AUTORIZACION</div>
        <div class="Cell2"></div>
    </div>
    <?
    $contGasto=1;
    $total_gastos=0;
    foreach ($gastos as $gasto) {
        echo " <div class=\"Row\">";
        echo "<div class=\"Cell\">".$contGasto."</div>";
        if($gasto->buse_id!=''){
            echo "<div class=\"Cell\">".$gasto->bus->plate."</div>";
        }else{
            echo "<div class=\"Cell\">".''."</div>";
        }
        echo "<div class=\"Cell\" style=\"text-align: right\">".number_format($gasto->amount,2)."</div>";

        if ($gasto->type_doc!='00') {
            echo "<div class=\"Cell\" style='text-transform:uppercase;'>".$gasto->serie_doc.'-'.$gasto->number_doc.' / '.$gasto->detail.' / '.$gasto->authorized."</div>";
        } else {
            echo "<div class=\"Cell\" style='text-transform:uppercase;'>".$gasto->rc.' / '.$gasto->detail.' / '.$gasto->authorized."</div>";
        }
        $contGasto++;
        $total_gastos=$total_gastos+$gasto->amount;
        echo "<div class=\"Cell\"></div>";
        echo "</div>";
    }
    ?>
    <div class="Heading">
        <div class="Cell2"></div>
        <div class="Cell2">T. GASTOS</div>
        <div class="Cell2" style="text-align: right"><?=number_format($total_gastos,2)?></div>
        <div class="Cell2"></div>
        <div class="Cell2"></div>
    </div>
    <div class="Row">
        <div class="Cell" style="border: 0">&nbsp;</div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
    </div>
    <?
    //III. Resumen boletos vendidos

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
        echo " <div class=\"Row\">";
        echo "<div class=\"Cell2\"></div>";
        echo "<div class=\"Cell2\">".'PASAJES '.$value->serie."</div>";
        echo "<div class=\"Cell2\">".$value->inicial.' --> '.$value->final."</div>";
        echo "<div class=\"Cell2\">".$value->cantidad."</div>";
        echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format($resumen_pas_total[$key]->toArray()[0]->total,2)."</div>";
        $sum_totales=$sum_totales+$resumen_pas_total[$key]->toArray()[0]->total;
        $sum_cantidad=$sum_cantidad+$value->cantidad;
        echo " </div>";
    }
    foreach ($resumen_enc as $key => $value) {
        echo " <div class=\"Row\">";
        echo "<div class=\"Cell2\"></div>";
        echo "<div class=\"Cell2\">".'ENCOMIENDAS '.$value->serie."</div>";
        echo "<div class=\"Cell2\">".$value->inicial.' --> '.$value->final."</div>";
        echo "<div class=\"Cell2\">".$value->cantidad."</div>";
        echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format($resumen_enc_total[$key]->toArray()[0]->total,2)."</div>";
        $sum_totales=$sum_totales+$resumen_enc_total[$key]->toArray()[0]->total;
        $sum_cantidad=$sum_cantidad+$value->cantidad;
        echo " </div>";
    }

    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'EXCESOS'."</div>";
    echo "<div class=\"Cell2\">".'-'."</div>";
    echo "<div class=\"Cell2\">".$cant_excesos."</div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format($total_excesos,2)."</div>";
    echo "</div>";

    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'TOTAL VENTAS'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".$sum_cantidad."</div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format($sum_totales+$total_excesos,2)."</div>";
    echo " </div>";
    ?>
    <div class="Row">
        <div class="Cell" style="border: 0">&nbsp;</div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
        <div class="Cell" style="border: 0"></div>
    </div>
    <?
    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'RESUMEN DEL DIA'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "</div>";

        //cuerpo
       //SUB-TOTAL
    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'T. VENTAS S/'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format($sum_totales+$total_excesos,2)."</div>";
    echo "</div>";


       //GASTOS
    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'GASTOS S/'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format(-1*$total_gastos,2)."</div>";
    echo "</div>";

         //TOTAL
    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'PAS CRED S/'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format(-1*$total_pasajes_credito,2)."</div>";
    echo "</div>";

        //end cuerpo de la hoja
       //TOTAL
    echo "<div class=\"Row\">";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\">".'T. EFECTIVO S/'."</div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\"></div>";
    echo "<div class=\"Cell2\" style=\"text-align: right\">".number_format(($sum_totales+$total_excesos-$total_gastos-$total_pasajes_credito),2)."</div>";
    echo "</div>";

    ?>

</div>
<script>
    jsPrintSetup.setPrinter('coder_a4');
    // set portrait orientation
    jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

    // set top margins in millimeters
    jsPrintSetup.setOption('marginTop', 0);
    jsPrintSetup.setOption('marginBottom', 1);
    jsPrintSetup.setOption('marginLeft', 0);
    jsPrintSetup.setOption('marginRight', 1);

    jsPrintSetup.clearSilentPrint();
    // Suppress print dialog (for this context only)
    jsPrintSetup.setOption('printSilent', 1);
    // Do Print
    // When print is submitted it is executed asynchronous and
    // script flow continues after print independently of completetion of print process!
    jsPrintSetup.print();
    // next commands

    /*var ventana = window.self;
    ventana.opener = window.self;
    setTimeout("window.close()", 100);*/
</script>
