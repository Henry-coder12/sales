<?php
//debug($cambiobus);
    if ($cambiobus==true) { ?>
        <script type="text/javascript">
            location.reload();
        </script>
    <?php }
?>
<style type="text/css">
  @keyframes reservas {
      from  { fill: #F9478A;}
      to { fill: #FCA9C8;}
    }
  @keyframes reservas2 {
      from  { fill: #B873FC;}
      to { fill: #D3A9FC;}
    }
</style>

<style type="text/css">
  .tabs-container .panel-body {
  	/* opacity: 0.9;  para opacidad de imagen de buses*/
  }
</style>


<?php if ($programationData->status==0) { //programation_Bloqueado ?>
    <script type="text/javascript">
        $('#load_bus').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#selected_seat').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#actions_users').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
    </script>
<?php }else{ ?>

			<div class="tabs-container"  > <!-- style="transform: rotate(-90deg);" -->
				<ul class="nav nav-tabs">
					<script type="text/javascript">
			                function update_tab_session($id_floor){
			                    $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();$(".btn-danger").addClass("disabled");}, complete:function(request, json) {$('#buscar_client').html(request.responseText); $(".btn-danger").removeClass("disabled");$('#cargando').hide();}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_change_tab', data:{ new_tab_session: $id_floor}});
			                }
			        </script>
			    	<?php 
			    	$primero=$tab_session;
			    	foreach ($floors as $floor) {
			    		$idFloor=$floor->id;
			    		if($primero==0){
			    			$primero=$idFloor;
			    		}
			    		if ($primero==$idFloor) {
			    			echo '<li class="active"><a data-toggle="tab" href="#tab-'.$idFloor.'" aria-expanded="true" style="padding: 6px 15px;" onclick="update_tab_session('.$idFloor.');">'.$floor->name.'</a></li>';
			    			
			    		}else{
			    			echo '<li class=""><a data-toggle="tab" href="#tab-'.$idFloor.'" aria-expanded="false" onclick="update_tab_session('.$idFloor.');" style="padding: 6px 15px;">'.$floor->name.'</a></li>';
			    		}
			    	}
			    	?>
			    	<li>
			    		<a data-toggle="tab" href="#resumen" aria-expanded="false" style="padding: 1px 15px;">
			    			<?php $totVendido=$ocuCount+$ocupRuta ?>
			    			<small>Avance : <?= $totVendido.' de '.$numSeat?></small>
			    			<?php $porcAvan = $totVendido*100/$numSeat ?>
			    			<?php $porcAvan = number_format($porcAvan,0); ?>
                            <div class="progress progress-mini">
                                <div style="width: <?=$porcAvan?>%;" class="progress-bar"></div>
                            </div>
			    		</a></li>
			       
			       		<li>
			    		<a data-toggle="tab" href="#redbusconfig" aria-expanded="false" style="padding: 6px 15px;">
			    			CONFIGURACION PRECIOS
			    		</a></li>
			        
			        
			    </ul>
			    <div class="tab-content">
			    	<div id="resumen" class="tab-pane">
			    		<div class="panel-body" style="padding: 2px;">
			    			<div class="ibox-content" style="width:1077px; height:210px;float:left;">			    				
		    					<div class="col-sm-4">
		    						<div class="col-sm-6">
		    							<div class="scroll_content">
		    							<table class="table-striped">
										  <!--<thead><tr><th colspan="2" style="text-align:center;">Progresos</th></tr></thead>-->
										  <tbody>
										    <tr class="success"><td style="text-align:right;padding:3px;">Vendidos</td><td style="padding:3px;"><span class="h5 font-bold"><?= str_pad($ocuCount, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr class="success"><td style="text-align:right;padding:3px;">Vend. Ruta</td><td style="padding:3px;"><span class="h5 font-bold"><?= str_pad($ocupRuta, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Libres</td><td style="padding:3px;"><span class="h5 font-bold"><?= str_pad($vacios, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Reservados</td><td style="padding:3px;"><span><?= str_pad($reserved, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Bloqueados</td><td style="padding:3px;"><span><?= str_pad($locCount, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Anulados</td><td style="padding:3px;"><span><?= str_pad($canceled, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Postergado Ext.</td><td style="padding:3px;"><span><?= str_pad($contPosp, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    <tr><td style="text-align:right;padding:3px;">Postergado Int.</td><td style="padding:3px;"><span><?= str_pad($contPospInt, 2, '0', STR_PAD_LEFT)?></span></td></tr>
										    
										  </tbody>
										</table>
										</div><!--scroll_content-->
		    						</div>
		    						<div class="col-sm-6">
		    							<div class="ibox">
				                            <div style="text-align:center;">
				                                <h5>Vendidos / Libres</h5>
				                                <?php $totVendido=str_pad($totVendido, 2, '0', STR_PAD_LEFT)?>
				                                <?php $numSeat=str_pad($numSeat, 2, '0', STR_PAD_LEFT)?>
				                                <h2><?=$totVendido.' / '.$vacios?></h2>
				                                <div class="text-center">
				                                    <div id="sparkline6"></div>
				                                </div>
				                            </div>
				                        </div>
		    						</div>
		    					</div>

		    					<div class="col-sm-5">
		    						<div class="scroll_content">
			    						<div class="col-sm-8">
			    						<table class="">
			    							<thead class="hide">
			    								<tr>
			    									<th style="text-align:center; padding:0 10px 10px 10px;">OFICINA(S)</th>
			    									<th style="text-align:center; padding:0 10px 10px 10px;">CANT.</th>
			    								</tr>
			    							</thead>
			    							<tbody>
			    							<?php //debug($fndOrderRou); ?>
			    								<?php $contTD=0; ?>
			    								<?php $contArray=count($fndOrderRou); ?>
			    								<?php foreach ($fndOrderRou as $key): ?>
			    									<?php $contTD+=1; ?>
			    									<?php $idAgence=$key['id']; ?>
			    									<?php $colorUbi=$key->ubigeo->color; ?>
			    									<tr style="border-bottom:1px dotted <?=$colorUbi?>;">
			    											    										
			    										<td style="text-align:right; padding:0 0 0 10px; color:<?=$colorUbi?>;"><?php echo $key->orden.' :' ?></td>
			    										<td style="text-align:right; padding:0 10px 0 10px; color:<?=$colorUbi?>;">
			    											<?=$key['ubigeo']['cp']?>		    												
			    										</td>
			    										<?php if ($contTD==1): ?>
			    										<td style="background-color:#23C6C8; color:#fff; text-align:left; height:120px;>" rowspan="<?php echo $contArray?>">
			    											<div class="vertical_text" style="letter-spacing:4px; word-spacing:4px;">
			    											EMBARQ
			    											</div>
			    										</td>	    											
			    										<?php endif ?>
			    										<td style="padding:0 10px 0 10px; width:35px; font-weight:bold;">
			    											<?php if ($arrAgen[$idAgence]==[]): ?>
			    												<?php echo ''; ?>
			    											<?php else: ?>
			    												<?php echo $arrAgen[$idAgence][0]['contagen']?>
			    											<?php endif ?>													    												
			    										</td>
			    										<?php if ($contTD==1): ?>
			    										<td style="background-color:#1AB394; color:#fff; text-align:left;" rowspan="<?php echo $contArray?>">
			    											<div class="vertical_text" style="letter-spacing:4px; word-spacing:4px;">
			    												VENTAS
			    											</div>
			    										</td>	    											
			    										<?php endif ?>
			    										<td style="padding:0 10px 0 10px; width:35px; font-weight:bold;">
			    											<?php if ($arrAgen2[$idAgence]==[]): ?>
			    												<?php echo ''; ?>
			    											<?php else: ?>
			    												<?php echo $arrAgen2[$idAgence][0]['contdot']?>
			    											<?php endif ?>													    												
			    										</td>
			    									</tr>
			    								<?php endforeach ?>
			    							</tbody>
			    						</table>
			    						</div><!--col-sm-7-->
			    						<div class="col-sm-4">
			    							<div class="row text-center">
				    							<h3>VENTAS</h3><br>
				                                <canvas id="doughnutChart" width="120" height="120"></canvas>
				                           	</div>
			                            </div><!--col-sm-6-->
		    						</div><!--scroll-->
		    					</div>

		    					<div class="col-sm-3">

		    					</div>
			    				    			
			    			</div>
			    		</div>
			    	</div>

			    	<div id="redbusconfig" class="tab-pane">

			    		<div class="panel-body" style="padding: 2px;">
			    			<div class="ibox-content" style="width:1077px; height:210px;float:left;">			    				
		    					<div class="col-sm-12">
	    							<div class="scroll_content">
		    							<table class="table-striped">
										  <thead>
										  	<tr>
										  		<th style="text-align:center;padding:6px;">Nro</th>
										  		<th style="text-align:center;padding:6px;">ORIGEN</th>
										  		<th style="text-align:center;padding:6px;">DESTINO</th>
										  		<th style="text-align:center;padding:6px;">PRECIO NORMAL</th>
										  		<th style="text-align:center;padding:6px;">PRECIO CAMA</th>
										  	</tr>
										  </thead>
										  <tbody>
										  	<?php
										  	//debug($arrayDestinos);
										  	$contador=1;
										  	foreach ($arrayDestinos as $key => $value) { ?>
										  		<tr>
										  			<td style="text-align:right;padding:3px;"><?=$contador;?></td>
										  			<td style="text-align:right;padding:3px;"><?=$value->sourceName;?></td>
										  			<td style="text-align:right;padding:3px;"><?=$value->destinationName;?></td>
										  			<td style="text-align:right;padding:3px;"><div class="edit" id="div_pnormal_<?=$value->programationprice_id?>"><?=$value->precio_normal;?></div></td>
										  			<td style="text-align:right;padding:3px;"><div class="edit" id="div_pcama_<?=$value->programationprice_id?>"><?=$value->precio_cama;?></td>
										  		</tr>		

										  		<?php
										  		echo $this->Ajax->editor( "div_pnormal_".$value->programationprice_id, array( 'controller' => 'sales', 'action' => 'passages_edit_programationprice_normal'),array('indicator' => '<img src="../img/indicator.gif">','submit' => 'guardar','submitdata' => array('programationprice_id'=> $value->programationprice_id)));

										  		echo $this->Ajax->editor( "div_pcama_".$value->programationprice_id, array( 'controller' => 'sales', 'action' => 'passages_edit_programationprice_cama'),array('indicator' => '<img src="../img/indicator.gif">','submit' => 'guardar','submitdata' => array('programationprice_id'=> $value->programationprice_id)));
										  		?>								    
											    
										  	<?php 
										  	$contador++;
										  	} ?>
										    
										  </tbody>
										</table>
									</div><!--scroll_content-->
		    					</div>

		    					
			    				    			
			    			</div>
			    		</div>

			    	</div>
			    	
					<?php
					$primero=$tab_session;
					foreach ($floors as $floor) {
						$idFloor=$floor->id;
						if($primero==0){
			    			$primero=$idFloor;
			    		}
						if ($primero==$idFloor) {
							echo '<div id="tab-'.$idFloor.'" class="tab-pane active">';
						}else {
							echo '<div id="tab-'.$idFloor.'" class="tab-pane">';
						}


						echo '<div class="panel-body" style="padding: 2px;">';



							echo '<div id="bus'.$floor->id.'" style="width:'.$floor->width.'px; height:210px;float:left;" class="bus">';
								
								foreach ($seatsbus[$floor->id] as $seat) {
									$id_seat=$seat->id;
									$id_elem=$elements[$floor->id][$seat->id]->id;
									$name_elem=$elements[$floor->id][$seat->id]->name;
									$width_elem=$elements[$floor->id][$seat->id]->width;
									$height_elem=$elements[$floor->id][$seat->id]->height;
									//print_r($seat);
									if ($seat->static==1) {
										echo '<div id="seat'.$seat->id.'" class="node" style="position: absolute; width:'.$width_elem.'px; height:'.$height_elem.'px ;top: '.$seat->x.'px; left: '.$seat->y.'px;">';
									}else{
										echo '<div id="seat'.$seat->id.'" class="node" style="z-index: 50;position: absolute; width:'.$width_elem.'px; height:'.$height_elem.'px ;top: '.$seat->x.'px; left: '.$seat->y.'px;">';
									}
									
									
									//echo $this->element($name_elem,['color_sexo'=>'#fff','color'=>'#fff','id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
									if($CountSalesData[$id_seat]){  //cantidad de registros en sales del mismo asiento
										//print_r($CountSalesData[$id_seat]);
										for ($i=0; $i < $CountSalesData[$id_seat]; $i++) {  

											if($SalesDataFirst[$id_seat][$i]['reserved']=='1'){ // si esta reservado
												//if(){ //serserva normal 
												//	$asiento=$this->element($name_elem,['reservado'=>1,'id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
												//}else{ //reserva con bloqueo
													$width_elem_ref=$width_elem-48;
													if ($SalesDataFirst[$id_seat][$i]['locked']==1) {
														$asiento=$this->element($name_elem,['reservado'=>1,'locked'=>'1','id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
													}else{
														$asiento=$this->element($name_elem,['reservado'=>1,'locked'=>'0','id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
													}
													
													//echo '<span class="circle2" style="margin-top:15px;right: '.$width_elem_ref.'px;font-size:6px;">'.substr($SalesDataFirst[$id_seat][$i]['reference_client'],0,8).'</span>';
													
												//}
											}elseif($SalesDataFirst[$id_seat][$i]['locked']==false and $SalesDataFirst[$id_seat][$i]['reserved']<>'1'){ //si esta vendido
												if($SalesDataFirst[$id_seat][$i]['client']['gender']==1){
													$color_sexo='#00AEFF'; //hombre
												}else{
													$color_sexo='#FF8E8E'; //mujer
												}

												//si (orden_ubigeo_actual > orden_ubigeo_vendido_anteriormente) PONE EN BLANCO
												//if($orderoute_coder_ubigeo_id >= $OrderRouteDestine[$id_seat][$i]['ubigeo_destine']['orden']){
												//	$asiento=$this->element($name_elem,['color_sexo'=>$color_sexo,'color'=>'#fff','id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
												//}else{
													$asiento=$this->element($name_elem,['color_sexo'=>$color_sexo,'color'=>$SalesDataFirst[$id_seat][$i]['ubigeo_destine']['color'],'id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);


												//para el telefono
												if($SalesDataFirst[$id_seat][$i]['client']['num_phone']!=''){
													$positionSeat2=$width_elem-55;
													echo '<div style="right: '.$positionSeat2.'px;position: absolute;z-index:1;top: -10px;color: red;text-align: center;font-weight: bold;font-size: 20px;cursor: default;opacity: 0.8;">'.$this->html->image('phone.png',['width'=>18]).'</div>';
												}
												//esto es para el logo de redbus
												if ($SalesDataFirst[$id_seat][$i]['user_id']==1000) {
													$rbposition=$width_elem-18;
													echo '<div style="right: '.$rbposition.'px;position: absolute;z-index:1;top: -15px;color: red;text-align: center;font-weight: bold;font-size: 20px;cursor: default;">'.$this->html->image('redbus.png',['width'=>18]).'</div>';
												}
												//}
												//------>
											}elseif($SalesDataFirst[$id_seat][$i]['locked']==true and $SalesDataFirst[$id_seat][$i]['reserved']<>'1'){ //sino esta bloqueado
												$asiento=$this->element($name_elem,['color_sexo'=>'#ccc','color'=>'#ccc','id'=>'miid'.$id_elem,'data'=>['var'=>'mivar']]);
												

												//si el asiento le pertenece al usuario logueado en el mismo punto de venta (dotsale_id) ... le ponemos los seats en el cuadrito
												if($id_user==$SalesDataFirst[$id_seat][$i]['user_id']){
													?>
													<script type="text/javascript">
													addseat_no_data($("#seat<?php echo $id_seat;?>"));
													</script>
													<?php
												}
												
											}

											//letra de la sede que vendio
											$VendidoPor=substr($SalesDataFirst[$id_seat][$i]['ubigeo_origin']['cp'], 0, 1);
											
												
											
											
										}
										$positionLugar=$width_elem-18;
										echo '<span class="circle2" style="right: '.$positionLugar.'px;">'.$VendidoPor.'</span>'; //esto muestra la letra de la venta en el elemnto
										//print_r($id_seat)
										?>
										<script type="text/javascript">
										$("#seat<?=$seat->id;?>").dblclick(function () {
										  $('#myModal2').modal('show');
										  var routeid=<?php echo $CoderRouteId ?>;
										  var agenceid=<?php echo $CoderAgenceId ?>;
										  var seatid=<?php echo $id_seat?>;
										  var progid=<?php echo $SalesDataFirst[$id_seat][0]['programation_id']?>;

										  $('#myModal2').find(".modal-content").load("<?php echo $this->Url->build('/');?>"+'sales/passagesDetailSeat?r='+routeid+'&a='+agenceid+'&seatid='+seatid+'&progid='+progid);
										});
										</script>
										<?php
										
										echo '<span class="pdf btn-conf node-tool">
											'.$this->Html->link($this->html->image('pdf.png',['height'=>13]), ['controller'=>'sales','action' => 'viewpdf_ticket',base64_encode(base64_encode($SalesDataFirst[$id_seat][0]['id'].'-3')) ], ['target'=>'_black','escape' => false]).'
										</span>';
										
										
									}else{ //si esta vacio
										$asiento=$this->element($name_elem,['color_sexo'=>'#fff','color'=>'#fff']);	
									}
			                        
									//imprimimos el asiento
									echo $asiento;

									if ($seat->static==0) {
										if($seat->covid==1){
											$positionSeat=$width_elem-30;
											echo '<span class="circle" style="right: '.$positionSeat.'px;">COVID</span>';
											echo '<span class="id_seat" style="display:none;">'.$seat->id.'</span>';
				                            echo $this->Ajax->drag('seat'.$seat->id,array('revert' => true,'helper' => 'clone','cursor' => 'move'));
										}else{
											$positionSeat=$width_elem-48;
											echo '<span class="circle" style="right: '.$positionSeat.'px;">'.$seat->name_seat.'</span>';
				                            echo '<span class="id_seat" style="display:none;">'.$seat->id.'</span>';
				                            echo $this->Ajax->drag('seat'.$seat->id,array('revert' => true,'helper' => 'clone','cursor' => 'move'));
				                        }
									}    										
									echo '</div>';	
								}
								?>
								<?php echo '</div>'; ?>

								<script type="text/javascript">
									//variable para el bus del drag and drop
									//var bus_drop_selected=$('#bus'+<?//=$floor->id;?>);
								</script>
							
							<?php
							

			            echo '</div></div>';
					} ?>

			        


			    </div>
			</div>
			<?php echo $this->Ajax->drop('selected_seat',array('activeClass'=> 'ui-state-highlight', 'drop'=> 'addseat(ui.draggable);' ))?>

<?php } ?>


<?php 
echo $this->Html->script('jquery.gritter.min',array('inline'=>false));
echo $this->Html->css('jquery.gritter');
?>
<script type="text/javascript">
$(document).ready(function() {

	$( ".node" ).click(function() {
				
				$('.bus').find('.pdf').css( "display", "none");
				hijos_edit = $(this).children('.pdf');
				hijos_edit.css( "display", "block" );
			  //alert( hijos );
			});
	
	$('#myModal').on('hide.bs.modal', function(e) {
	    $(this).removeData('bs.modal');
	  });

	//chart 'cake' vendido/libres
	var sparklineCharts = function(){
		$("#sparkline6").sparkline([<?=$totVendido?>, <?=$vacios?>], {
	         type: 'pie',
	         height: '110',
	         sliceColors: ['#1ab394', '#F5F5F5']
	     });
	};
	
	//--
	//chart 'cake' destinos
	var doughnutData = [
		<?php foreach ($fndOrderRou as $key): ?>
			<?php 
			$contTD+=1;
			$idAgence=$key['id'];
			$colorUbi=$key->ubigeo->color;
			$cpUbigeo=$key->ubigeo->cp;

			if ($arrAgen2[$idAgence]==[]){
				$valDot = 0; 
			}else{
				$valDot = $arrAgen2[$idAgence][0]['contdot'];
			}?>
			{
	            value: <?=$valDot?>,
	            color: "<?=$colorUbi?>",
	            highlight: "<?=$colorUbi?>",
	            label: "<?=$cpUbigeo?>"
	        },
		<?php endforeach ?>
    ];

    var doughnutOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 45, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false
    };

    var ctx = document.getElementById("doughnutChart").getContext("2d");
    var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
	//--

	var sparkResize;

    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineCharts, 500);
    });

    sparklineCharts();

    //agregando para slimScroll element
    $('.scroll_content').slimScroll({
    	height: '187px',
    	/*width: '165'*/
    });

});

</script>
<?php if($msn==1){ ?>
	<script type="text/javascript">

		var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'AVISO!',
            // (string | mandatory) the text inside the notification
            text: 'SE LIBERO ALGUNOS ASIENTOS. EXCESO DE TIEMPO BLOQUEADOS! ... ',
            // (string | optional) the image to display on the left
            image: '../css/images/warning.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });	
        
        // You can have it return a unique id, this can be used to manually remove it later using
        
		 	setTimeout(function(){
			 $.gritter.remove(unique_id, {
				 fade: true,
				 speed: 'slow'
				 });
			 }, 5000);
	</script>
<?php } ?>

