


<?php echo $this->Html->script('plugins/jasny/jasny-bootstrap.min.js'); ?>

<?php
	echo $this->Html->script('backbone/underscore');
    echo $this->Html->script('jquery.number',array('inline'=>false));
    echo $this->Html->script('jquery.gritter.min',array('inline'=>false));
    echo $this->Html->script('jquery.pulsate/jquery.pulsate.min',array('inline'=>false));
    echo $this->Html->css('jquery.gritter');
    echo $this->Html->css('clipone/main');
    echo $this->Html->script('highcharts');
    echo $this->Html->script('blockUI/jquery.blockUI');
    
?>
<script type="text/javascript">
    <?php echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'commends_options'),'update' => 'list_agences')); ?>
</script>
<style type="text/css">
	.container {
	    width: 100%;
	}
	select {
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 0 #ccc, 0 -1px #fff inset;
	-moz-box-shadow: 0 1px 0 #ccc, 0 -1px #fff inset;
	box-shadow: 0 1px 0 #ccc, 0 -1px #fff inset;
	background: #f8f8f8;
	color: #888;
	border: 1px solid;
	border-color: #DDD;
	cursor: pointer;
	font-size: 17px;
	}
	</style>
<!-- start: PANEL CONFIGURATION MODAL FORM -->
<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Panel Configuration</h4>
			</div>
			<div class="modal-body">
				Here will be a configuration form
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary">
					Save changes
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- start: PANEL CONFIGURATION MODAL FORM -->
<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Panel Configuration</h4>
			</div>
			<div class="modal-body">
				Here will be a configuration form
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" class="btn btn-primary">
					Save changes
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModal2" class="modal inmodal in" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceInRight">
        
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#myModal2').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>


<div class="container"  style="background-color: #fff;">

			<!-- start: PAGE -->
			<div class="main-content col-md-6">				
				
					<!-- start: PAGE CONTENT -->
					<div class="row">
					
						<div class="col-sm-12">
								<div class="widget-box transparent invoice-box">
											<div class="widget-header row" style="margin-right:25px;">
												<h3 class="grey lighter  position-relative" style="float: right !important;margin-top: 10px;margin-bottom: 5px;">
													<i class="icon-leaf green"></i>
													<select name="dotsale_id_selected" id='dotsale_id_selected' class='input-medium'>
														<?php
														foreach ($data_dotsale_01 as $series){
															//recuerda que esto es el id de dotcommend o del punto de venta
															echo "<option value='".$series['id']."' typeDoc='".$series['numeration']['document']."'>".$series['numeration']['serie']."</option>";
														}
														?>
													</select>
													
												</h3>
												<?php 
												echo $this->Ajax->observeField('dotsale_id_selected', array( 'url' => array('controller'=>'sales','action' =>'commends_numeration_show' ),'update' => 'update_select','before'=>"$('.btn').attr('disabled', true); $('#printer').attr('disabled','disabled'); $('#update_select').focus();",'complete'=>"$('.btn').removeAttr('disabled'); $('#printer').removeAttr('disabled');")); 
												?>

												<script type="text/javascript">

												//esto funciona para cuando el ususario hace F5 y actuliza automaticamente el observer field
												//var DotcommendID='data[Dotcommend][id]='+ $('#numerations').val();
												//console.log(DotcommendID);
												//<![CDATA[
													$.ajax({async:true, type:'post', complete:function(request, json) {$('#update_select').html(request.responseText); }, url:<?php echo $this->Url->build('/');?>+'sales/commends_numeration_show', data:{dotsale_id_selected:$('#dotsale_id_selected').val()}}) 
												//]]>
												</script>

												<div class="no-border invoice-info"  id='update_select' style="float: right;width: 310px;">
													
												</div>

												<div class="widget-toolbar no-border invoice-info">
													
												</div>

											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-6">
															<div class="row" style="margin:10px;">
																<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
																	<b>Quien Envia</b>
																</div>
															</div>

															<div class="row" id='clientid'>
																<div id="client_div"></div>
																<ul class="list-unstyled spaced">
																	<li>
																		<?php echo $this->Ajax->form(['type' => 'post','options' => ['update'=>'client_div','url' => ['controller' => 'sales','action' => 'commends_find_client'],'class'=>'form-horizontal','before'=>"$('#type_doc_remit').val($('#dotsale_id_selected').find('option:selected').attr('typeDoc'));$('#buscar_remit').attr('disabled','disabled');$('#update_select').focus();",'complete'=>"$('#buscar_remit').prop('disabled', false)"]]);?> 
																			<input type="hidden" class="form-control" id='type_doc_remit' name="type_doc_remit">
																			<input type="hidden" class="form-control" id='idclient' name="id" value='0'>
																			<input type="hidden" class="form-control" id='birthclient' name="birthclient" value=''>
																			<div class="form-group" style="margin-bottom: 5px;">
									                                            <div class="col-sm-12">
									                                              <div class="col-sm-7" style="padding-left: 0px;">
									                                                <input type="text" class="form-control input-sm" id='doclient' name="document" placeholder="Dni o Ruc" style="text-transform:uppercase;" title='Ingrese DNI o RUC del remitente VALIDO!' required>
									                                              </div>
									                                              <div class="col-xs-4">
									                                                <button class="btn btn-primary btn-xs" id='buscar_remit'>
																						Buscar
																					</button>
									                                              </div>
									                                            </div>
									                                        </div>
																		</form>
																		
								                                         
																		<form class="form-horizontal" role="form">
								                                          <div id="remitente_data_dni" class="form-group" style="margin-bottom: 5px;" >
								                                            <div class="col-xs-6" style="padding-right: 5px;">
								                                              <input type="text" class="form-control input-sm nopalote" id="apeclient" placeholder="Apellidos" style="text-transform:uppercase;" title='Ingrese Apellidos del remitente' onkeypress="if (event.keyCode==13) { getElementById('nomclient').focus(); }">
								                                            </div>
								                                            <div class="col-xs-5" style="padding-left: 5px;">
								                                              <input type="text" class="form-control input-sm nopalote" id="nomclient" placeholder="Nombres" style="text-transform:uppercase;" title='Ingrese Nombres del remitente' onkeypress="if (event.keyCode==13) { getElementById('dirclient').focus(); }">
								                                            </div>

								                                          </div>
								                                          <div id="remitente_data_ruc" class="form-group" style="margin-bottom: 5px;">
								                                            <div class="col-sm-10">
								                                              <input type="text" class="form-control input-sm nopalote" id="razonclient" placeholder="Razon Social" style="text-transform:uppercase;" title='Ingrese direccion del remitente' onkeypress="if (event.keyCode==13) { getElementById('dirclient').focus(); }">
								                                            </div>
								                                          </div>
								                                          <div class="form-group" style="margin-bottom: 5px;">
								                                            <div class="col-sm-11">
								                                              <input type="text" class="form-control input-sm nopalote" id="dirclient" placeholder="Direccion" style="text-transform:uppercase;" title='Ingrese direccion del remitente' onkeypress="if (event.keyCode==13) { getElementById('reseptdoc').focus(); }">
								                                            </div>
								                                          </div>
								                                          
								                                        </form>
																	</li>
																</ul>
															</div>
														</div><!-- /row -->

														<div class="col-sm-6">
															<div class="row"  style="margin:10px;">
																<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
																	<b>Quien Recibe</b>
																</div>
															</div>

															<div class="row" id='clientid2'>
																<div id="client2_div"></div>
																<ul class="list-unstyled  spaced">
																	<li>
																		<?php echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'client2_div','url' => array('controller' => 'sales','action' => 'commends_find_client2'),'class'=>'form-horizontal','before'=>"$('#buscar_consig').attr('disabled','disabled');$('#update_select').focus();",'complete'=>"$('#buscar_consig').prop('disabled', false)")));?> 
																			<input type="hidden" class="form-control" id='idresept' name="id" value='0'>
																			<input type="hidden" class="form-control" id='recptbirth' name="recptbirth" value=''>
																			<div class="form-group" style="margin-bottom: 5px;">
									                                            <div class="col-sm-12">
									                                              <div class="col-sm-7" style="padding-left: 0px;">
									                                                <input type="text" class="form-control input-sm" id='reseptdoc' name="document" placeholder="Dni o Ruc" style="text-transform:uppercase;"  title='Ingrese DNI o RUC del consignatario'>
									                                              </div>
									                                              <div class="col-xs-4">
									                                                <button class="btn btn-primary btn-xs" id="buscar_consig">
																						Buscar
																					</button>
									                                              </div>
									                                            </div>
									                                        </div>
																		</form>
																		
								                                         
																		<form class="form-horizontal" role="form">
								                                          <div class="form-group" style="margin-bottom: 5px;">

								                                            <div class="col-xs-6" style="padding-right: 5px;"> 
								                                              <input type="text" class="form-control input-sm" id="recptapellido" placeholder="Apellidos"  style="text-transform:uppercase;"  title='Ingrese Apellidos del consignatario' onkeypress="if (event.keyCode==13) { getElementById('recptnombre').focus(); }">
								                                            </div>
								                                            <div class="col-xs-5" style="padding-left: 5px;">
								                                              <input type="text" class="form-control input-sm" id="recptnombre" placeholder="Nombres"  style="text-transform:uppercase;"  title='Ingrese Nombres del consignatario' onkeypress="if (event.keyCode==13) { getElementById('receptdireccion').focus(); }">
								                                            </div>

								                                          </div>
								                                          <div class="form-group" style="margin-bottom: 5px;">
								                                            <div class="col-sm-11">
								                                              <input type="text" class="form-control input-sm" id="receptdireccion" placeholder="Direccion"  style="text-transform:uppercase;"  title='Ingrese direccion del consignatario' onkeypress="if (event.keyCode==13) { getElementById('DestineId').focus(); }">
								                                            </div>
								                                          </div>
								                                          
								                                        </form>

								                                        
																	</li>
																</ul>
															</div>
														</div><!-- /span -->

													</div><!-- row -->
													
													<div class="alert alert-block alert-info fade in">
														<div class="form-group" style="margin-bottom: 5px;">
				                                            <label for="inputPassword3" class="col-sm-1 control-label" style="padding-left: 0px;">Domic.</label>
				                                            <div class="col-sm-3">
				                                              	<select class="form-control input-sm" id="domicilio" >
													          		<option value="0">NO</option>
													          		<option value="1">SI</option>
													        	</select>
				                                            </div>
				                                            <label for="inputPassword3" class="col-sm-1 control-label">Dest.</label>
				                                            <div class="col-sm-4">
				                                            	<select class="form-control input-sm" id='DestineId'  onkeypress="if (event.keyCode==13) { getElementById('DetailCantidad2').focus(); }">
				                                            		<?php 
				                                            		foreach ($destinos as $value) {
				                                            			echo "<option value='".$value->ubigeo->id."'>".$value->ubigeo->cp."</option>";
				                                            		}?>
													        	</select>
				                                            </div>
				                                            <div class="col-sm-3">
				                                              <input type="checkbox" id="PagoDestino"> Pago Dest.
				                                            </div>
				                                            
				                                        </div>
														<br>
													</div>
													
													<div class="space"></div>
													<div id="list_document">
														<?php
															if($contar<3){
															echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_document','url' => array('controller' => 'sales','action' => 'commends_add_detail'),'class'=>'form-horizontal','confirm' => 'Desea agregar el detalle?','complete' => 'calcular_valor_compra();','id'=>'agregarform')));
															}
															?>
														<table class="table table-striped table-bordered"  id='lista'>
															<thead>
																<tr>
																	<th class="center">CANT</th>
																	<th>DICE CONTENER </th>
																	<th>PRECIO UNITARIO</th>
																	<th class="hidden-480">PRECIO TOTAL</th>
																	<th>Acciones</th>
																</tr>
															</thead>

															<tbody>
																<?php
																if($contar<3){
																		echo '<tr>';
																			echo '<td class="center">'.$this->Form->text('Detail.cantidad2',array('label'=>'','style'=>'width:50px;','title'=>'Ingrese cantidad','id'=>'DetailCantidad2')).'</td>';
																			echo '<td>'.$this->Form->text('Detail.contener2',array('label'=>'','title'=>'Ingrese contenido', 'style'=>"text-transform:uppercase;width:100%;",'id'=>'DetailContener2')).'</td>';
																			echo '<td><div id="precio">'.$this->Form->text('Detail.precio_unit2',array('label'=>'','style'=>'width:100%;','title'=>'Ingrese Precio por unidad','id'=>'DetailPrecioUnit2')).'</div></td>';
																			echo '<td><div id="total">'.$this->Form->text('Detail.precio_total2',array('label'=>'','style'=>'width:100%;','title'=>'Ingrese Precio Total','id'=>'DetailPrecioTotal2')).'</div></td>'; 
																			echo '<td><div>';																			
																				echo $this->Form->hidden('Detail.id',array('value'=>''));
																				echo $this->Form->button('Agregar',array('id'=>'agregar','type'=>'submit','class'=>'btn btn-success  btn-sm'));
																			echo '</div></td>';
																		
																		echo '</tr>';
																		echo '</form>';
																	}
																?>
																<?php
																	foreach ($detail as $pro) {
																		//para cantidad
																		
																		$detalleID=$pro->id;

																		echo '<tr>';
																			echo '<td class="center">'.$pro->quantity.'</td>';
																			echo '<td>'.$pro->content.'</td>';
																			echo '<td><div id="precio'.$detalleID.'" class="peciounit">'.number_format($pro->price, 2, '.', '').'</div></td>';
																			$subtotal=$pro->total;

																			echo '<td><div id="total'.$detalleID.'" class="subtotal">'.number_format($subtotal, 2, '.', '').'</div></td>'; 
																			echo '<td><div>';
																			echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_document','url' => array('controller' => 'sales','action' => 'commends_del_detail'),'class'=>'form-horizontal','confirm' => 'Desea eliminar el producto?','complete' => 'calcular_valor_compra();','before'=>"$('#del$detalleID').attr('disabled','disabled');")));
																				echo $this->Form->hidden('Detail.id',array('value'=>$detalleID));
																				echo '<button class="btn btn-danger btn-xs" id="del'.$detalleID.'"><i class="fa fa-times fa fa-white"></i></button>';
																				echo '</form>';
																			echo '</div></td>';
																		echo '</tr>';
																	}
																	?>
															</tbody>
														</table>
													</div>
													<?php //print_r($sede_name['cp']) ?>
													<script type="text/javascript">

																	
														function monto_total(){
															  var suma =0;
															  var papi = $('#lista');
															  var hijos = papi.find('.subtotal');
															  
															  _.each(hijos, function(hijo){
															    var value = parseFloat($(hijo).html());
															    //console.log(value+'-');
															   suma=suma+value;									    
															  });
															  return suma;
														}
														function calcular_valor_compra(){
																var impuestoporcentual = 100+<?php echo $impuesto['valor'];?>;
																var montotal2=monto_total();
																var subtotal2=(montotal2/impuestoporcentual)*100;
																var impuesto2=montotal2-subtotal2;
																
																$('#subtotal2').html(subtotal2.toFixed(2));
																$('#impuesto2').html(impuesto2.toFixed(2));										
																$('#totaltotal').html(montotal2.toFixed(2));
																$('#DocumentMontoTotal').val(montotal2.toFixed(2));
																
																//console.log(monto_total());
														}
													</script>
													<div class="hr hr8 hr-double hr-dotted"></div>
													<div class="row-fluid">
														<div class="span3 pull-right">
															<blockquote class="pull-right">										
																<p>
																	<span id='confactura' class='hide'>
																	Subtotal : <span class="red" id='subtotal2'>S/. 0</span><br>
																	<?php echo $impuesto['name']?> <?php echo $impuesto['valor']?> %: <span class="red" id='impuesto2'>S/. 0</span><br>
																	</span>
																TOTAL : <span class="Blue" id='totaltotal'>S/. 0</span></p>										
															</blockquote>
														</div>
														<div class="span9 pull-left">
															<table>
																<tr>
																	<td>
																	<?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'commends_print'),'target'=>'_black','id'=>'form_commends')); ?>
																	<button class="btn btn-app btn-primary btn-mini" id="printer">
																		<i class="icon-save"></i>
																		IMPRIMIR
																	</button>	
																	<?php
																	echo $this->Form->hidden('Remit.id',['id'=>'RemitId']);
																	echo $this->Form->hidden('Remit.document',['id'=>'RemitDocument']);
																	echo $this->Form->hidden('Remit.name',['id'=>'RemitName']);
																	echo $this->Form->hidden('Remit.surname',['id'=>'RemitSurname']);
																	echo $this->Form->hidden('Remit.razon',['id'=>'RemitRazon']);
																	echo $this->Form->hidden('Remit.address',['id'=>'RemitAddress']);
																	echo $this->Form->hidden('Remit.birthdate',['id'=>'RemitBirthdate']);


																	echo $this->Form->hidden('Consig1.id',['id'=>'Consig1Id']);
																	echo $this->Form->hidden('Consig1.document',['id'=>'Consig1Document']);
																	echo $this->Form->hidden('Consig1.surname',['id'=>'Consig1Surname']);
																	echo $this->Form->hidden('Consig1.name',['id'=>'Consig1Name']);
																	echo $this->Form->hidden('Consig1.address',['id'=>'Consig1Address']);
																	echo $this->Form->hidden('Consig1.birthdate',['id'=>'Consig1Birthdate']);

																	echo $this->Form->hidden('Commends.id',['value' => $documentid]);
																	//echo $this->Form->text('Commends.doc',['id'=>'CommendDoc']);
																	//echo $this->Form->text('Commends.serie',['id'=>'CommendSerie']);
																	//echo $this->Form->text('Commends.number',['id'=>'CommendNumber']);
																	echo $this->Form->hidden('Commends.destine_id',['id'=>'CommendDestineId']);
																	echo $this->Form->hidden('Commends.agence_id',['value'=>$agence_id]);
																	echo $this->Form->hidden('Commends.domicilio',['id'=>'CommendDomicilio']);
																	echo $this->Form->hidden('Commends.pago_destino',['id'=>'CommendPagoDestino']);
																	echo $this->Form->hidden('Commends.origen',['value'=>$sede_name['cp']]);
																	echo $this->Form->hidden('Commends.destino',['id'=>'CommendDestino']);
																	echo $this->Form->hidden('Commends.ubigeo_id_origen',['value'=>$coder_ubigeo_id]);
																	echo $this->Form->hidden('Commends.total',['id'=>'totalinput']);
																	//echo $this->Form->text('Commend.sede_id_destino',array('value'=>'8'));


																	echo $this->Form->hidden('Dotsale.id',['id'=>'DotsaleId'])

																
																	?>

																	<?php echo $this->Form->end(); ?>
																	
																	<script type="text/javascript">	
																	function pregunta(){
																		if($('#doc-client').val()==''){
																			$('#idclient').val('1');
																			$('#name-client').val('');
																			$('#direccion-client').val('');
																		}
																		/*
																		bootbox.confirm("Are you sure?", function(result) {
																			if(result) {
																				bootbox.alert("You are sure!");
																			}
																		});
																		*/
																	    if (confirm('¿Estas seguro de GUARDAR?')){
																	    	$('#DocumentFecha').val($('#fecha').val());
																	    	$('#ClienteId').val($('#idclient').val());
																	    	$('#DotsaleId').val($('#dotsale_id_selected').val());
																	    	$('#ClienteName').val($('#name-client').val());
																	    	$('#ClienteDocument').val($('#doc-client').val());								    	
																	    	$('#ClienteDireccion').val($('#direccion-client').val());
																	       	return true;
																	    }else{
																	    	return false;
																	    }
																	}


																	//para el evento de pago destino
																	$("#PagoDestino").bind('change', function(){
																		if($("#PagoDestino").is(":checked")){
																			$('#form_commends').attr('action', <?php echo $this->Url->build('/');?>+"sales/commends_ticket");
																		}else{
																			$('#form_commends').attr('action', <?php echo $this->Url->build('/');?>+"sales/commends_print");
																		}
																	});


																																		
																	</script>
																	
																	</td>
																	<td>
																	<?php //echo $this->Html->link('<span class="title"> NUEVO </span>',array('controller' => 'invoice', 'action' => 'index'), array('class'=>'btn btn-light-grey','escape'=>false,'disabled'=>true,'id'=>'nuevo'));?>
																	<?php echo $this->Html->link($this->Form->button('NUEVO',array('class'=>'btn btn-light-grey','id' => "nuevo")), array('controller' => 'sales','action' => 'commends'), array('style'=>'margin-left:10px;','escape'=>false,'id'=>'link_nuevo'));?>
																	</td>
																</tr>
															</table>
														</div>
													</div>



												</div>
											</div>
										</div>


						</div>
					</div>
					<!-- end: PAGE CONTENT-->
			</div>
			<!-- end: PAGE -->
			<div class="main-content col-md-6" id='otro'>
				<br>
				<!-- start: INBOX PANEL -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-search"></i>
						<?php echo $sede_name->cp.' - '.$agence->name;?>
						
					</div>
					<div class="panel-body messages full-height-scroll-commends" style="height:400px;">
						<ul class="messages-list" id="list_search" style="width: 280px;height:400px;">
							<li class="messages-search">
								<?php echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_search','url' => array('controller' => 'sales','action' => 'commends_buscar'),'class'=>'form-inline','before'=>"$('.panel').block({ overlayCSS: { backgroundColor: '#fff'}, message: '<img src=\'../img/loading.gif\'> Buscando...', css: { border: 'none', color: '#333', background: 'none'} })",'after'=>"window.setTimeout(function () { $('.panel').unblock() }, 1000);")));?> 
									<div class="input-group col-md-3">
										<input type="text" class="form-control" placeholder="Serie" name="data[serie]" onchange="aMays(event, this);" style='text-transform: uppercase;'>
									</div>
									<div class="input-group col-md-5">
										<input type="text" class="form-control" placeholder="Correlativo" name="data[number]" onkeydown="valNumeric(event)">
									</div>
									<div class="input-group col-md-3">
										<button class="btn btn-primary" type="submit">
												<i class="fa fa-search"></i>
										</button>
									</div>
									<br><br>
									<div class="input-group col-md-12">
										<input type="text" class="form-control" placeholder="Quien envia o recibe" name="data[buscar]" onchange="aMays(event, this);" style='text-transform: uppercase;'>
									</div>
									
								</form>
							</li>
							
						</ul>
						<div class="messages-content" style="margin-left: 280px;" id="view_commends">
							          <div id="container23" style="height: 400px; margin: 0 auto"></div>
							          
				                          <script type="text/javascript">
							                    $(function () {
							                            $('#container23').highcharts({
							                            	chart: {
												                plotBackgroundColor: null,
												                plotBorderWidth: null,
												                plotShadow: false
												            },

							                                title: {
							                                    text: 'VENTAS POR OFICINA'
							                                },
							                                subtitle: {
							                                    text: 'fuente: Sistena Encomiendas'
							                                },
												            tooltip: {
												        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
												            },
												            plotOptions: {
												                pie: {
												                    allowPointSelect: true,
												                    cursor: 'pointer',
												                    dataLabels: {
												                        enabled: false
												                    },
												                    showInLegend: true
												                }
												            },
												            series: [{
												                type: 'pie',
												                name: 'porcentaje de ventas',
												                data: [
												                	<?php 
								                                    foreach($ventas as $value) {
								                                    	echo "['".$value['nombre_agence']."',".$value['total_ventas']."],";
								                                    } 
								                                    
								                                    ?>
												                ]
												            }]

							                            });
							                        });
							                        

							                        </script>
						</div>
					</div>
				</div>
				<!-- end: INBOX PANEL -->
				<br>
					
	        </div>
</div>


<!-- end: MODAL -->
<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<script type="text/javascript">

var $modal = $('#ajax-modal');



$modal.on('click', '.update', function(){
  $modal.modal('loading');
  setTimeout(function(){
    $modal
      .modal('loading')
      .find('.modal-body')
        .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '</div>');
  }, 1000);
});
</script>
<!-- end: MODAL -->


		<!-- start: MAIN JAVASCRIPTS -->
<script type="text/javascript">
	$(document).ready(function(){ 
		calcular_valor_compra();
		$("#doclient").focus(); //focus inicial
	});

	//si cambia algo en los detalles habilitamos el boton ya que se desabilita al momento de enviar el formulario
	$("#DetailCantidad2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailContener2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailPrecioUnit2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailPrecioTotal2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
</script>
<script type="text/javascript">
$('#doclient').numeric();
$('#reseptdoc').numeric();

$('#DetailCantidad2').number(true, 0);
$('#DetailPrecioUnit2').number(true,2);
$('#DetailPrecioTotal2').number(true,2);
</script>
<script>
//cambio de datos del documento
$('#doclient').keyup(function(){
	$("#idclient").val(0);
	$("#nomclient").val('');
	$("#dirclient").val('');
});
$('#reseptdoc').keyup(function(){
	$("#idresept").val(0);
	$("#recptnombre").val('');
	$("#receptdireccion").val('');
});
//--------------



$("#agregar").click(function (){
	$(".errors").remove();	
	if($("#DetailCantidad2").val() <= 0){
		$('#DetailCantidad2').tooltip({placement: "top"});        
        $("#DetailCantidad2").focus();
        return false;
	}else if($("#DetailContener2").val() == ""){
		$('#DetailContener2').tooltip({placement: "top"});        
        $("#DetailContener2").focus();
        return false;
	}else if($("#DetailPrecioUnit2").val() <= 0 && $("#DetailPrecioTotal2").val() <= 0){
		$('#DetailPrecioUnit2').tooltip({placement: "top"});        
        $("#DetailPrecioUnit2").focus();
        return false;
	}
	//desabilitamos el boton 
	$('#agregar').attr('disabled','disabled');
	// y para que no envie doble mandamos el foco a cualquier otra parte
	$('#update_select').focus();
	//if($('#agregarform').submit()){
	//	$('#agregar').attr('disabled','disabled');
	//}
	$('#agregarform').submit();
	//$("#agregarform").submit(function() {

	//});
	return false;
	//$('#printer').removeAttr('disabled');
});
</script>
<script type="text/javascript">
	//Validación de SUNAT
	function valruc(valor){
	  valor = trim(valor)
	  if ( esnumero( valor ) ) {
	    if ( valor.length == 8 ){
	      suma = 0
	      for (i=0; i<valor.length-1;i++){
	        digito = valor.charAt(i) - '0';
	        if ( i==0 ) suma += (digito*2)
	        else suma += (digito*(valor.length-i))
	      }
	      resto = suma % 11;
	      if ( resto == 1) resto = 11;
	      if ( resto + ( valor.charAt( valor.length-1 ) - '0' ) == 11 ){
	        return true
	      }
	    } else if ( valor.length == 11 ){
	      suma = 0
	      x = 6
	      for (i=0; i<valor.length-1;i++){
	        if ( i == 4 ) x = 8
	        digito = valor.charAt(i) - '0';
	        x--
	        if ( i==0 ) suma += (digito*x)
	        else suma += (digito*x)
	      }
	      resto = suma % 11;
	      resto = 11 - resto
	      
	      if ( resto >= 10) resto = resto - 10;
	      if ( resto == valor.charAt( valor.length-1 ) - '0' ){
	        return true
	      }      
	    }
	  }
	  return false
	}
	function trim(cadena){
	  cadena2 = "";
	  len = cadena.length;
	  for ( var i=0; i <= len ; i++ )
	    if (cadena.charAt(i) != " "){
	      cadena2+=cadena.charAt(i);
	    }
	  return cadena2;
	}
	function esnumero(campo){
	  return (!(isNaN( campo )));
	}
</script>

<script type="text/javascript">

function serie_correlativo(){
	  var papi = $('#update_select');
	  var hijos = papi.find('b').html();
	  
	  
	  //console.log(hijos);
	   
	  return hijos;
}

$("#printer").click(function (){

	$('#RemitId').val($('#idclient').val()); 
	$('#RemitDocument').val($('#doclient').val());
	$('#RemitSurname').val($('#apeclient').val());
	$('#RemitName').val($('#nomclient').val());
	$('#RemitRazon').val($('#razonclient').val());
	$('#RemitAddress').val($('#dirclient').val());
	$('#RemitBirthdate').val($('#birthclient').val());

	$('#Consig1Id').val($('#idresept').val());	
	$('#Consig1Document').val($('#reseptdoc').val());
	$('#Consig1Surname').val($('#recptapellido').val());
	$('#Consig1Name').val($('#recptnombre').val());
	$('#Consig1Address').val($('#receptdireccion').val());
	$('#Consig1Birthdate').val($('#recptbirth').val());

	//$('#CommendDoc').val($('#SerieDocument').val());
	//$('#CommendSerie').val($('#SerieSerie').val());
	//$('#CommendNumber').val($('#SerieNumber').val());
	$('#CommendDestineId').val($('#DestineId').val());
	$('#CommendDomicilio').val($('#domicilio').val());

	$('#totalinput').val($('#totaltotal').text());
	


	if($('#PagoDestino').is(":checked")){
		$('#CommendPagoDestino').val(1);	
	}else{
		$('#CommendPagoDestino').val(0);
	}
	
	
	$('#CommendDestino').val($('#DestineId option:selected').html());
	
	/*
	else if($("#reseptdoc").val().length<8){
		$('#reseptdoc').tooltip({placement: "top"});        
        $("#reseptdoc").focus();
		return false;		
	}
	*/
	

	if($('#SerieDocument').val()=='03' && $("#doclient").val().length<8){
		$('#doclient').tooltip({placement: "top"});        
        $("#doclient").focus();
		return false;	
	}else if($('#dotsale_id_selected').find('option:selected').attr('typeDoc')=='01' && valruc($("#doclient").val())==false){
		
			$('#doclient').tooltip({placement: "top"});        
        	$("#doclient").focus();
			return false;
		
	}else if($('#SerieDocument').val()=='01' && $("#doclient").val().length<11){	
		$('#doclient').tooltip({placement: "top"});        
        $("#doclient").focus();
		return false;		
	}else if($("#nomclient").val() == '' && $('#SerieDocument').val()=='03'){
		$('#nomclient').tooltip({placement: "top"});        
        $("#nomclient").focus();
        return false;
	}else if($("#apeclient").val() == '' && $('#SerieDocument').val()=='03'){
		$('#apeclient').tooltip({placement: "top"});        
        $("#apeclient").focus();
        return false;
	}else if($("#razonclient").val() == '' && $('#SerieDocument').val()=='01'){
		$('#razonclient').tooltip({placement: "top"});        
        $("#razonclient").focus();
        return false;
	}else if($("#dirclient").val() == "" && $('#SerieDocument').val()=='01'){
		$('#dirclient').tooltip({placement: "top"});        
        $("#dirclient").focus();
        return false;
	}else if($("#recptnombre").val() == ''){
		//console.log($("#doclient").val().length);
		$('#recptnombre').tooltip({placement: "top"});        
        $("#recptnombre").focus();
		return false;
	}else if($("#domicilio").val() == 1 && $("#receptdireccion").val() == ''){
		$('#receptdireccion').tooltip({placement: "top"});        
        $("#receptdireccion").focus();
        return false;
	}else if($("#CommendDoc").val() == '' || $("#CommendSerie").val() == '' || $("#CommendNumber").val() == ''){
        alert('Faltan datos se va actualizar la pagina');
        location.reload();
        return false;
	}else if(monto_total()==0){
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'AVISO!',
            // (string | mandatory) the text inside the notification
            text: 'No tiene ninguna encomienda en lista ... para continuar agregue en detalle.',
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
			 }, 5000)
			$('#DetailCantidad2').focus();		 
        	return false;

	}

	//enviamos el Dotcomend.id
	$('#DotsaleId').val($('#dotsale_id_selected').val());
	desactivar();

	// --- cambio de clave --->
	//$('#myModal').modal('show');
	//$('#myModal').find(".modal-content").load(<?php //echo $this->Url->build('/');?>+'sales/commendsChangeKeyClient/<?//=$documentid;?>');
	// --- fin de cambio de clave --->
	//return false;
	
	
});	

</script>

<script type="text/javascript">
   function desactivar(){
   	$('#printer').hide();
	$('#lista').hide();
	$('#nuevo').pulsate({
        color: '#C43C35', // set the color of the pulse
        reach: 30, // how far the pulse goes in px
        speed: 1, // how long one pulse takes in ms
        pause: 0, // how long the pause between pulses is in ms
        glow: true, // if the glow should be shown too
        repeat: true, // will repeat forever if true, if given a number will repeat for that many times
        onHover: false // if true only pulsate if user hovers over the element
    });
   }     
   


</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('.nopalote').keypress(function(tecla) {
	        if(tecla.charCode == 124) return false;
	    });
	});
</script>
<script type="text/javascript">

function aMays(e, elemento) {
    tecla=(document.all) ? e.keyCode : e.which; 
        elemento.value = elemento.value.toUpperCase();
        $('input').removeClass('error');
    }


    $('body').on('keydown', 'input, select, textarea', function(e) {
        var self = $(this)
          , form = self.parents('form:eq(0)')
          , focusable
          , next
          ;
        if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });
</script>

<script type="text/javascript">
    function valNumeric(evt){
        evt = (evt) ? evt : ((window.event) ? window.event : null);
        if(
        ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
        ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
        ( evt.keyCode==8   ||
        evt.keyCode==9   ||
        evt.keyCode==13  ||
        evt.keyCode==16  ||
        evt.keyCode==17  ||
        evt.keyCode==36  ||
        evt.keyCode==35  ||
        evt.keyCode==46  ||
        evt.keyCode==37  ||
        evt.keyCode==39  ||
        evt.keyCode==110 ||
        evt.keyCode==119)
        ){
            //Lets that key value pass
        } else {
            if(document.all) {
                evt.returnValue = false
            } else evt.preventDefault()
        }
    }

    function valAlphaNumeric(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }

    function valAlphaNumericNbsp(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==32  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }

    function valAlpha(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==32  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119 ||
      evt.keyCode==55 ||
      evt.keyCode==0)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }
</script>

<?php
echo $this->Html->script('bootstrap-tooltip',array('inline'=>false));

?>
<?php echo $this->Html->script('plugins/staps/jquery.steps.min.js', ['block' => true]); ?>
<?php echo $this->Html->css('plugins/steps/jquery.steps.css', ['block' => true]); ?>

<?php echo $this->Html->script('plugins/validate/jquery.validate.min.js', ['block' => true]); ?>


<div id="myModal" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content"> </div>
  </div>
</div>
<script type="text/javascript">
  $('#myModal').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>

<iframe width="1400" height="1200" src="" name="hidden_iframe" allowfullscreen style="display:none;" ></iframe>
