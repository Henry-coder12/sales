<style type="text/css">
	body{
		/*letter-spacing: 5px;*/
	}
</style>
<div class="tabla">
	<div class="fila">
		<div class="col" style="width: 1100px; text-align: center;">LIQUIDACION POR BUS</div>		
	</div>
	<div class="fila">
		<div class="col" style="width: 1100px; text-align: center;">------------------------------</div><!--30-->
	</div>
	<div class="fila" style="height: 10px;"></div>
	<div class="fila">
		<div class="col" style="width: 150px;">FECHA</div>
		<div class="col" style="width: 200px;">: <?php echo date('d-m-Y', strtotime($fndPro_varDate)); ?></div>
		<div class="col" style="width: 200px;">&nbsp;</div>
		<div class="col" style="width: 250px;">HORA</div>
		<div class="col" style="">: <?php echo date('g:i a', strtotime($fndPro_varHour)); ?></div>		
	</div>
	<div class="fila" style="height: 5px;"></div>
	<div class="fila">
		<div class="col" style="width: 150px;">VEHICULO</div>
		<div class="col" style="width: 200px;">: <?php echo $fndSales[0]['buses']['plate']; ?></div>
		<div class="col" style="width: 200px;">&nbsp;</div>
		<div class="col" style="width: 250px;">ORIGEN - DESTINO</div>
		<div class="col" style="">: <?php echo $fndSales[0]['routes']['name']; ?></div>
	</div>
	<div class="fila" style="height: 5px;"></div>
	<div class="fila">
		<div class="col" style="width: 1100px; text-align: center;">
			<?php for ($i=0; $i < 125; $i++) { 
				echo "-";
			} ?>
		</div>		
	</div>
	<div class="fila" style="height: 15px;"></div>
</div><!--tabla-->
<table border="0">
	<tr>
		<td rowspan="5" style="vertical-align: top;">
			<!--subtotal(1)-->
			<div class="tabla">
				<div class="fila">
					<div class="col" style="width: 40px;">N°</div>
					<div class="col" style="width: 190px;">N° BOLETO</div>
					<div class="col" style="text-align:right;">IMPORTE</div>
				</div>
				<div class="fila">
					<div class="col" style="width: 40px;">---</div>
					<div class="col" style="width: 190px;">------------------</div><!--20-->
					<div class="col" style="text-align:right;">-------------</div><!--15-->
				</div>
				<div class="fila" style="height: 10px;"></div>
				<?php $num=0; ?>
                <?php //for ($i=0; $i < 45; $i++): ?>
                <?php //debug($fndSales); ?>
                <?php $subtotal1=0; ?>
                <?php foreach ($fndSales as $key => $value): ?>
                	<?php if ($key<45): ?>                		
                		<?php $num+=1;?>
		                <div class="fila" style="height: 15px;">
		                    <div class="col" style="width: 40px;"><?= str_pad($num, '2', STR_PAD_LEFT, '0'); ?></div>
		                    <div class="col" style="width: 190px;"><?=$value['sales']['serie'].'-'.str_pad($value['sales']['number'], '7', STR_PAD_LEFT, '0'); ?></div>
		                    <div class="col" style="text-align:right;">S/ <?php echo number_format($value['sales']['price'], 2); ?></div>
		                </div>
		                <?php $subtotal1 += $value['sales']['price']; ?>
                	<?php endif ?>
                <?php endforeach ?>
                <?php //endfor; ?>
                <div class="fila">
                    <div class="col" style="width: 230px; text-align: center;">-----------------</div>
                    <div class="col" style="text-align: right;">-----------</div>
                </div>
                <div class="fila">
                    <div class="col" style="width: 230px; text-align: center;"><b>SUB TOTAL (1)</b></div>
                    <div class="col" style="text-align: right;">S/ <b><?php echo number_format($subtotal1,2); ?></b></div>
                </div>
			</div><!--tabla subtotal(1)-->
		</td>
		<td rowspan="5" style="width: 20px;">&nbsp;</td>
		<td rowspan="2" style="vertical-align: top;">
			<!--subtotal(2)-->
			<div class="tabla">
				<div class="fila">
					<div class="col" style="width: 40px;">N°</div>
					<div class="col" style="width: 190px;">N° BOLETO</div>
					<div class="col" style="text-align:right;">IMPORTE</div>
				</div>
				<div class="fila">
					<div class="col" style="width: 40px;">---</div>
					<div class="col" style="width: 190px;">------------------</div><!--20-->
					<div class="col" style="text-align:right;">-------------</div><!--15-->
				</div>
				<div class="fila" style="height: 10px;"></div>
				<?php $num=45; ?>
                <?php //for ($i=0; $i < 25; $i++): ?>
                <?php $subtotal2=0; ?>
                <?php foreach ($fndSales as $key => $value): ?>
                	<?php if ($key>45): ?>	                	
	                	<?php $num+=1;?>
			                <div class="fila">
			                    <div class="col" style="width: 40px;"><?= str_pad($num, '2', STR_PAD_LEFT, '0'); ?></div>
			                    <div class="col" style="width: 190px;"><?=$value['sales']['serie'].'-'.str_pad($value['sales']['number'], '7', STR_PAD_LEFT, '0'); ?></div>
			                    <div class="col" style="text-align:right;">S/ <?php echo number_format($value['sales']['price'], 2); ?></div>
			                </div>
		               	<?php $subtotal2 += $value['sales']['price']; ?>
		            <?php endif; ?>
                <?php endforeach; ?>
                <div class="fila">
                    <div class="col" style="width: 230px; text-align: center;">----------------</div>
                    <div class="col" style="text-align: right;">-----------</div>
                </div>
                <div class="fila">
                    <div class="col" style="width: 230px; text-align: center;"><b>SUB TOTAL (2)</b></div>
                    <div class="col" style="text-align: right;">S/ <b><?php echo number_format($subtotal2,2); ?></b></div>
                </div>
			</div>		
		</td>
		<td rowspan="2" style="width: 20px;">&nbsp;</td>
		<td style="vertical-align: top;">
			<!--enco-->
			<div class="tabla">
				<div class="fila">
					<div class="col" style="width: ">ENCOMIENDAS</div>
				</div>
				<div class="fila">
					<div class="col" style="width: 350px; text-align: center;">
						<?php for ($i=0; $i < 35; $i++) { 
							echo "-";
						} ?>
					</div>	
				</div>
				<div class="fila" style="height: 10px;"></div>
				<?php $numEnco=0; ?>
				<?php $sumEnco=0; ?>
				<?php foreach ($fndCommend as $key => $value): ?>
                	<?php if ($key<14): ?>	
						<?php $numEnco+=1; ?>
			            <div class="fila" style="height: 10px;">
			            	<div class="col" style="width: 40px;"><?= str_pad($numEnco, '2', STR_PAD_LEFT, '0'); ?></div>
			            	<div class="col" style="width: 190px;"><?=$value['Commends']['serie'].'-'.str_pad($value['Commends']['number'], '7', STR_PAD_LEFT, '0'); ?></div>	                
			                <div class="col" style="width: 120px; text-align:right;">S/ <?php echo number_format($value['Commends']['total'], 2); ?></div>
			            </div>
			            <?php $sumEnco += $value['Commends']['total']; ?>
			        <?php endif ?>
	            <?php endforeach ?>
	            
	            <div class="fila">
	                <div class="col" style="width: 200px; text-align: center;">-------------------</div>
	                <div class="col" style="width: 150px; text-align: right;">------------</div>
	            </div>
	            <div class="fila" style="height: 5px;"></div>
	            <div class="fila">
	                <div class="col" style="width: 200px; text-align: center;"><b>TOTAL</b></div>
	                <div class="col" style="width: 150px; text-align: right;">S/ <b><?php echo number_format($sumEnco,2); ?></b></div>
	            </div>
			</div>			
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;">
			<!--excesos-->
			<div class="tabla">
				<div class="fila">
					<div class="col">EXCESO EQUIPAJE</div>
				</div>
				<div class="fila" style="height: 10px;"></div>
				<?php $numEnco=0; ?>
				<?php for ($i=0; $i < 8; $i++): ?>
					<?php $numEnco+=1; ?>
	            <div class="fila" style="height: 10px;">
	            	<div class="col" style="width: 40px;"><?= str_pad($numEnco, '2', STR_PAD_LEFT, '0'); ?></div>
	            	<div class="col" style="width: 190px;">&nbsp;</div>	                
	                <div class="col" style="width: 120px; text-align:left;">S/ &nbsp;</div>
	            </div>
	            <?php endfor; ?>
	            
	            <div class="fila">
	                <div class="col" style="width: 200px; text-align: center;">-------------------</div>
	                <div class="col" style="width: 150px; text-align: right;">------------</div>
	            </div>
	            <div class="fila" style="height: 5px;"></div>
	            <div class="fila">
	                <div class="col" style="width: 200px; text-align: center;"><b>TOTAL</b></div>
	                <div class="col" style="width: 150px; text-align: right;">S/ <b>&nbsp;</b></div>
	            </div>
			</div>		
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<!--resu-->
			<div class="fila">
				<div class="col" style="width: 650px; text-align: center;">RESUMIENDO</div>
			</div>
			<div class="fila">
				<div class="col" style="width: 650px; text-align: center;">--------------------------------------------------------------------</div>
			</div>
			<div class="fila">
				
				<div class="col" style="width: 250px;">SUB TOTAL (1)</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: right;">S/ <?php echo number_format($subtotal1,2); ?></div>
			</div>
			<div class="fila">
				<div class="col" style="width: 250px;">SUB TOTAL (2)</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: right;">S/ <?php echo number_format($subtotal2,2); ?></div>
			</div>
			<div class="fila">
				<div class="col" style="width: 250px;">ENCOMIENDAS</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: right;">S/ <?php echo number_format($sumEnco,2); ?></div>
			</div>
			<div class="fila">
				<div class="col" style="width: 250px;">EXCESO DE EQUIPAJE</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: right;">S/ 0.00</div>
			</div>			
			<div class="fila">
				<?php $total = $subtotal1 + $subtotal2 + $sumEnco; ?>
				<div class="col" style="width: 250px;">TOTAL GENERAL</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: right;">S/ <?php echo number_format($total,2); ?></div>
			</div>
			<div class="fila">
				<div class="col" style="width: 650px; text-align: center;">DESCUENTOS</div>
			</div>
			<div class="fila">
				<div class="col" style="width: 650px; text-align: center;">--------------------------------------------------------------------</div>
			</div>
			<div class="fila">
				<div class="col" style="width: 250px;">COMISION OF.</div>
				<div class="col" style="width: 250px;">--------------------------- </div>
				<div class="col" style="width: 150px; text-align: left;">S/</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<!--liquido-->
			<div class="fila" style="height: 10px;"></div>
			<div class="fila">
				<div class="col" style="vertical-align: middle; width: 100px;">OTROS </div>
				<div class="col">
					<div class="fila"><div class="col" style="height: 25px;"> ----------------------------------------------------- </div></div>
					<div class="fila"><div class="col" style="height: 25px;"> ----------------------------------------------------- </div></div>
					<div class="fila"><div class="col" style="height: 25px;"> ----------------------------------------------------- </div></div>
				</div>
			</div>
			<div class="fila">
				<div class="col" style="width: 350px;">LIQUIDO A RECIBIR</div>
				<div class="col" style="width: 250px; text-align: right;"> ----------------------- </div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<!--firma-->
			<div class="tabla">
				<div class="fila" style="height: 50px;"></div>
				<div class="fila">
					<div class="col" style="width: 150px; text-align: center;"> ------------------------- </div>
					<div class="col" style="width: 200px;"> &nbsp; </div>
					<div class="col" style="width: 250px; text-align: center;"> ------------------------- </div>
				</div>
				<div class="fila">
					<div class="col" style="width: 150px; text-align: center;"> EMPLEADO </div>
					<div class="col" style="width: 200px;"> &nbsp; </div>
					<div class="col" style="width: 250px; text-align: center;"> RECIBI CONFORME </div>
				</div>
			</div>
		</td>
	</tr>
</table>


<script>
        	
   jsPrintSetup.setPrinter('coder_oficio');
   // set portrait orientation
   jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
   // set top margins in millimeters
   jsPrintSetup.setOption('marginTop', 5);
   jsPrintSetup.setOption('marginBottom', 0);
   jsPrintSetup.setOption('marginLeft', 1);

   <?php /*if($is_linux==1) { ?>
        jsPrintSetup.setOption('marginLeft', -3);
   <?php }else{ ?>
        jsPrintSetup.setOption('marginLeft', 4);
   <?php }*/ ?>
   
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