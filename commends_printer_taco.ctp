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

?>
<?php if ($copia==1) { ?>
        <div style="position: absolute;z-index: -99999999;">
            <?php echo $this->Html->image('copia.png', ['style' => 'width:150px;']); ?>
        </div>
        <?php } ?>
  
        <div class='tabla'>
            <div class='fila' style='height:30px;'></div>
            <div class='fila'>
                <div class='col' style='width: 250px;text-align:center;font-weight: bold;'>**************** PEGAR CINTA *****************</div>
            </div>
            <div class='fila' style='height:40px;'></div>

            <div class='fila'>
                <div class='col' style='width: 250px;font-size: 16px;text-align:center;font-weight: bold;'><?php echo $numero; ?></div>
            </div>
            <div class="fila">
                <div class="col" style='width: 250px;font-size: 24px;text-align:center;font-weight: bold;'><?php 
                if ($datos['number']>0) {
                  echo $datos['serie'].' - '.str_pad($datos['number'],7,'0',STR_PAD_LEFT);
                }else{
                  if ($datos['client']['credit']==1) {
                      echo '<div style="height: 250px;font-size: 70px;margin-left:30px;margin-top:110px; text-align:center;font-weight: bold;-moz-transform: rotate(-90deg);">CREDITO <br>';
                    echo $datos['id'];
                  }else{
                      echo '<div style="height: 250px;font-size: 70px;margin-left:30px;margin-top:110px; text-align:center;font-weight: bold;-moz-transform: rotate(-90deg);">PAGO DESTINO <br>';
                    echo $datos['id'];
                  }
                  
                  echo '</div>';
                }              

                ?></div>
            </div> 
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
                <div class='col' style='width: 250px;font-weight: bold;font-size: 12px;'> <u>ORIG:</u>: <?php echo substr($datos['origen'],0,10); ?></div>
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;font-weight: bold;font-size: 24px;'> <u><?=$this->Html->image('phone.png',['width'=>'20px']); ?></u>: <?php echo substr($datos['consig_phone'],0,10); ?></div>             
            </div>
            <div class='fila'>
                <div class='col' style='width: 250px;font-weight: bold;font-size: 26px;'> <u>DEST:</u>: <?php echo substr($datos['destino'],0,10); ?></div>             
            </div>
            <div class='fila' style='height:7px;'></div>
            <div class='fila' style='height: 16px;'>
                <div class='col' style='width: 40px;'><b>CANT</b></div>
                <div class='col' style='width: 160px;'><b>DESC. </b>(DICE CONTENER)</div>
                <div class='col' style='width: 40px;'><b>PRECIO</b></div>
            </div>
            <?php 
            $total_pagar=0;
            foreach ($datos['detail_commends'] as $value) {
              $prec=$value['total'];
                $total_pagar=$total_pagar+$prec;
                ?>
                <div class='fila' style='height: 16px;'>
                    <div class='col' style='width: 40px;'><?php echo $value['quantity'];?></div>
                    <div class='col' style='width: 140px;'><?php echo $value['content']; ?></div>
          <div class='col' style='width: 60px;text-align: right;'>S/ <?php echo number_format($prec,2); ?></div>
                </div>
                <?php
            }
            ?>
        <div class='fila' style='height:8px;'></div>
        <?php 
            //$igvRecibido=intval($tributo);
            $igv = number_format('1.'.$impuesto['valor'],2);
            //echo "<b>".$igv."</b><br>";
            $igv1=$total_pagar/$igv;
        ?>
         
        <div class='fila' style='height:8px;'></div>
    </div>
        <script>
          
           jsPrintSetup.setPrinter('ticket');
           // set portrait orientation
           jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
           // set top margins in millimeters
           jsPrintSetup.setOption('marginTop', -5);
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



