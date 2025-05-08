<style type="text/css">
	
		@page { size: A4 landscape; }
		body,input {
		    font-family: "arial";
		    font-size : 10pt;
		    float: none;
		    width: auto;
		    margin: 0;
		    padding: 0;
		    color: #000;
		    background: #fff;
		    /*letter-spacing: 0pt;*/
		    font-weight: bold;
		}
		div.tabla{
			clear: none;
			overflow: auto;
		}

		div.fila{
			clear: both;
		}

		div.col{
			float: left;
		}
	</style>

 <br><br>
<div class='tabla'>
	<div class='fila'>
		<div class='col' style='width: 490px;'>&nbsp;</div>
		<div class='col' style='width: 550px;font-size: 17px'>LIQUIDACION POR <?php if ($tipo=='0') { echo 'PERSONAL'; }else{ echo 'AGENCIA';} ?> </div>
	</div>
	<br></br>
</div>

<div class='tabla'>
	<div class='fila'>
		<div class='col' style='width: 200px;'>AGENCIA o PERSONAL </div>
		<div class='col' style='width: 450px;'>: <?php if ($tipo=='0') { echo $user->surnames.', '.$user->names; }else{ echo $agencia->name;} ?></div>
	</div>
	<div class='fila'>
		<div class='col' style='width: 200px;'>FECHA INICIO</div>
		<div class='col' style='width: 400px;'>: <?php echo $dateConsultaINI; ?></div>
		<div class='col' style='width: 150px;'>FECHA FINAL </div>
		<div class='col' style='width: 600px;'>: <?php echo $dateConsultaFIN; ?></div>
	</div>
	<div class='fila'>
		<div class='col' style='width: 900px;'> ----------------------------------------------------------------------------------------------------- ----------------------------------------------------------------------------------------------------- </div>
	</div>
	
	<br>
	<div class='fila' style="height: 20px;">
		<div class='col' style='width: 65PX;'><u>TD</u></div>
		<div class='col' style='width: 150px;'><u>NUMERO</u></div>
		<div class='col' style='width: 325px;'><u>CONSIGNADO</u></div>
		<div class='col' style='width: 425px;'><u>CANT. DESCRIPCION</u></div>
		<div class='col' style='width: 100px;'><u>TOTAL</u></div>
		<div class='col' style='width: 200px;'><u>TIPO</u></div>
	</div>
	
	<?php 
		$total_encomiendas=0;
		$total_commends=0;

		//primer destino ...
		$destino=$destino->name;
		echo "<div class='fila'><div class='col'><u><b>".$destino."</b></u></div></div>";


		//debug($ventas_encomiendas);
		foreach($ventas_encomiendas as $value){
			
			if ($value->canceled=='1') {
				echo "<div class='fila' style='height: 12px;'>";
	                echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>";
	                	if ($value->prepaid==1) {
							echo $value->doc;
						}else{
							echo 'PD';
						}
					echo '</div>';
	                echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
	                echo "<div class='col' style='width: 325px;'>".$value->consig_name."</div>";
	                echo "<div class='col' style='width: 425px;'>";
	                	foreach ($value->detail_commends as $detail) {
	                		echo '('.$detail->quantity.') '.$detail->content.' / ';
	                	}
	                echo "</div>";
	                echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
	                echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>ANULADO</div>";
	            echo '</div>';
			}elseif ($value->prepaid=='0') {
	            echo "<div class='fila' style='height: 12px;'>";
	                echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>";
	                	if ($value->prepaid==1) {
							echo $value->doc;
						}else{
							echo 'PD';
						}
					echo '</div>';
	                echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>".$value->id.'</div>';
	                echo "<div class='col' style='width: 325px;'>".$value->consig_name."</div>";
	                echo "<div class='col' style='width: 425px;'>";
	                	foreach ($value->detail_commends as $detail) {
	                		echo '('.$detail->quantity.') '.$detail->content.' / ';
	                		$total_encomiendas=$total_encomiendas+$detail->quantity;
	                	}
	                echo "</div>";
	                echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
	                echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>P. destino $value->destino</div>";
	            echo '</div>';
	        }elseif ($value->not_manif==1) {
	            echo "<div class='fila' style='height: 12px;'>";
	                echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>";
	                	if ($value->prepaid==1) {
							echo $value->doc;
						}else{
							echo 'PD';
						}
					echo '</div>';
	                echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
	                echo "<div class='col' style='width: 325px;'>".$value->consig_name."</div>";
	                echo "<div class='col' style='width: 425px;'>";
	                	foreach ($value->detail_commends as $detail) {
	                		echo '('.$detail->quantity.') '.$detail->content.' / ';
	                	}
	                echo "</div>";
	                echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
	                echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>d.$value->origen -> ".$prep_orig[$id]->id."</div>";
	            echo '</div>';
	            $total_commends=$total_commends+$value->total;
	        }else{
	            echo "<div class='fila' style='height: 12px;'>";
	                echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>";
	                	if ($value->prepaid==1) {
							echo $value->doc;
						}else{
							echo 'PD';
						}
					echo '</div>';
	                echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
	                echo "<div class='col' style='width: 325px;'>".$value->consig_name."</div>";
	                echo "<div class='col' style='width: 425px;'>";
	                	foreach ($value->detail_commends as $detail) {
	                		echo '('.$detail->quantity.') '.$detail->content.' / ';
	                		$total_encomiendas=$total_encomiendas+$detail->quantity;
	                	}
	                echo "</div>";
	                echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
	                echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>-</div>";
	            echo '</div>';
	            $total_commends=$total_commends+$value->total;
	        }
		}

		echo "<div class='fila' style='height: 12px;'>";
            echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>--------</div>";
            echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>-------</div>";
            echo "<div class='col' style='width: 325px;'>---------</div>";
            echo "<div class='col' style='width: 425px;'>--------</div>";
            echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>------</div>";
            echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>-------</div>";
        echo '</div>';
        echo "<div class='fila' style='height: 12px;font-size:16px;'>";
            echo "<div class='col' style='height: 11;width: 65px;text-align: left;'>--------</div>";
            echo "<div class='col' style='height: 11px;width: 150px;text-align: left;'>-------</div>";
            echo "<div class='col' style='width: 325px;'>---------</div>";
            echo "<div class='col' style='width: 425px;'> ------------------------------------ > TOTAL </div>";
            echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($total_commends,2)."</div>";
            echo "<div class='col' style='height: 11px;width: 200px;text-align: right;'>-------</div>";
        echo '</div>';
			
	?>
	
</div>

<br>

<div class='tabla'>
	<div class='fila'>
		<div class='col' style='width: 150px;'>&nbsp;</div>
		<div class='col' style='width: 600px; text-align: right;'>TOTAL ENCOMIENDAS RECEPCIONADAS --></div>
		<div class='col' style='width: 100px;'><?php echo $total_encomiendas; ?></div>
	</div>
</div>

<br><br><br><br>

<div class='tabla'>
	<div class='fila'>
		<div class='col' style='width: 150px;'>&nbsp;</div>
		<div class='col' style='width: 200px;'><center>--------------------------------</center></div>
	</div>
	<div class='fila'>
		<div class='col' style='width: 150px;'>&nbsp;</div>
		<div class='col' style='width: 200px;'><center><?php if ($tipo=='0') { echo $user->surnames.', '.$user->names; }else{ echo $agencia->name;} ?></center></div>
	</div>
	
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
   // set page header
		jsPrintSetup.setOption('headerStrLeft', '');
		jsPrintSetup.setOption('headerStrCenter', '');
		jsPrintSetup.setOption('headerStrRight', '');
		// set empty page footer
		jsPrintSetup.setOption('footerStrLeft', '');
		jsPrintSetup.setOption('footerStrCenter', '');
		jsPrintSetup.setOption('footerStrRight', '');
   //jsPrintSetup.definePaperSize(100, 100, 'boleta', 'boleta', 'prueba', 19.5, 8, jsPrintSetup.kPaperSizeInches);
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