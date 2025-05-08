<?php
############################################
## SISTEMA DE TRASPORTES - Control de Boletos          
## Por: Jefferson Jon La Torre Flores  edit Edwin Leonardo....                 
## email: Yeffer2@hotmail.com                         
## geniu - coder   Date: 14/11/2009       
## Descripcion :           
############################################
?>
        <div class='tabla'>
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
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 160px;font-size: 15px;'>VENTA ENCOMIENDAS</div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 20px;text-align: left;'>#</div>
                <div class='col' style='width: 70px;text-align: left;'>NUM-DOC</div>
                <div class='col' style='width: 60px;text-align: right;'>TOTAL</div>
                <div class='col' style='width: 60px;text-align: right;'>ESTADO</div>
             </div>
            
            <?php 
            $total_commends=0;
            $i=1;
            foreach ($ventas_encomiendas as $value) {
                $id=$value->id;
                $Total=$value->total;
                if ($value->canceled=='1') {
                     echo "<div class='fila'>";
                        echo "<div class='col' style='height: 11px;width: 20px;text-align: left;'>".$i.'</div>';
                        echo "<div class='col' style='height: 11px;width: 70px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
                        echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
                        echo "<div class='col' style='height: 11px;width: 100px;text-align: right;'>ANULADO</div>";
                    echo '</div>';                   
                }elseif ($value->prepaid=='0') {
                    echo "<div class='fila'>";
                        echo "<div class='col' style='height: 11px;width: 20px;text-align: left;'>".$i.'</div>';
                        echo "<div class='col' style='height: 11px;width: 70px;text-align: left;'>".$value->id.'</div>';
                        echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
                        echo "<div class='col' style='height: 11px;width: 100px;text-align: right;'>P. destino</div>";
                    echo '</div>';
                }elseif ($value->not_manif==1) {
                    echo "<div class='fila'>";
                        echo "<div class='col' style='height: 11px;width: 20px;text-align: left;'>".$i.'</div>';
                        echo "<div class='col' style='height: 11px;width: 70px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
                        echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
                        echo "<div class='col' style='height: 11px;width: 100px;text-align: right;'>d.$value->origen -> ".$prep_orig[$id]->id."</div>";
                    echo '</div>';
                    $total_commends=$total_commends+$Total;
                }else{
                    echo "<div class='fila'>";
                        echo "<div class='col' style='height: 11px;width: 20px;text-align: left;'>".$i.'</div>';
                        echo "<div class='col' style='height: 11px;width: 70px;text-align: left;'>".$value->serie.'-'.$value->number.'</div>';
                        echo "<div class='col' style='height: 11px;width: 60px;text-align: right;'>".number_format($value->total,2).'</div>';
                        echo "<div class='col' style='height: 11px;width: 100px;text-align: right;'>-</div>";
                    echo '</div>';
                    $total_commends=$total_commends+$Total;
                }
                $i++;
                
             } ?>
         
            <div class='fila' style='height: 16px;' >
                <div class='col' style='width: 100px;font-size: 13px;'><b>TOTAL ENCOM.</b></div>
                <div class='col' style='width: 60px;font-size: 13px;text-align: right;'><b><?php echo number_format($total_commends,2); ?></b></div>
            </div>           
        <div class='fila' style='height:5px;'></div>
        
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


