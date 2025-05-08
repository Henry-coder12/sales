<style type="text/css">
    td {
        margin-top: 10px;
    }
</style>
<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h3 class="modal-title">Lista de encomiendas <div class="label" style="font-size: 17px;"><?php //echo $bus_seat['name_seat'] ?></div></h3>
    <small class="font-bold">BUS: <i><?php echo $datos['programation']['bus']['plate']; ?></i>, FECHA ENVIO: <i><?php echo $datos['programation']['date']->format('d-m-Y').' a las '.$datos['programation']['hour']->format('H:i a'); ?></i>, ORIGEN: <i><?php echo $origen['ubigeo']['cp']; ?></i>.</small>
</div>
<div class="modal-body" >
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
	            	<h6>
	                <table class="table">
	                    <thead>
	                    <tr>
	                        <th>CANTIDAD</th>
	                        <th>DICE CONTENER</th>
	                        <th>PRECIO</th>
	                        <th>TOTAL PAGADO</th>
	                        <th>USUARIO QUE ENVIA</th>
	                        <th>AGREGADO AL MANIFIESTO EL</th>
	                        <th>ESTADO</th>
	                        <th>...</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                        <?php 
	                        
	                        foreach ($datos['manifesto_detail_commends'] as $value) {
	                        		$id=$value->id;
	                            	$var=explode('---',$value->detail_commend->commend->for_search);
	                            	if($value->status==0){
	                            		/*
	                            		echo "<tr class='danger'>";
		                                    echo "<td>-</td>";
		                                    echo "<td>".$var[1].'<br>'.$var[2]."</td>";
		                                    echo "<td>".$var[3].'<br>'.$var[4]."</td>";
		                                    echo "<td>".$value->detail_commend->quantity."</td>";
		                                    echo "<td>".$value->detail_commend->content."</td>";
		                                    echo "<td> S/. ".number_format($value->detail_commend->price,2)."</td>";
		                                    echo "<td> S/. ".number_format($value->detail_commend->total,2)."</td>";
		                                    echo "<td>".$value->user_id_add."</td>";
		                                    echo "<td>".$value->created->format("d-m-Y g:i a")."</td>";
		                                    echo "<td>";
		                                    echo "<div class='label'>ELIMINADO</div>";
		                                    //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

		                                    //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

		                                    
		                                    echo "</td>";
		                                
		                                echo "</tr>";
		                                */
	                            	}else{
		                                    //echo "<td>".$var[1].'<br>'.$var[2]."</td>";
		                                    //echo "<td>".$var[3].'<br>'.$var[4]."</td>";
		                                    echo "<td>".$value->detail_commend->quantity."</td>";
		                                    echo "<td>".$value->detail_commend->content."</td>";
		                                    echo "<td> S/. ".number_format($value->detail_commend->price,2)."</td>";
		                                    echo "<td> S/. ".number_format($value->detail_commend->total,2)."</td>";
		                                    echo "<td>".$value->user_id_add."</td>";
		                                    echo "<td>".$value->created->format("d-m-Y g:i a")."</td>";
		                                    echo "<td id='tdNumeration$id'>".$value->detail_commend->status->name."</td>";
		                                    echo "<td>";
		                                    if($value->detail_commend->status->id!=4 && $value->detail_commend->status->id!=5 ){ //si esta a reparto o ya fue entregado 
			                                    if ($value->detail_commend->status->id==2) {
			                                    	echo "<div><input type='checkbox' id='ckeckNumerationsId$id' value='1'></div>";
			                                    	$value_check=0;
			                                    }else{
			                                    	echo "<div><input type='checkbox' id='ckeckNumerationsId$id' value='1' checked></div>";
			                                    	$value_check=1;
			                                    }
			                                    ?>
			                                    
												<script type="text/javascript">
												//<![CDATA[
												$("#ckeckNumerationsId<?=$id?>").bind('change', function(){  $.ajax({async:true, type:'post', complete:function(request, json) {$("#tdNumeration<?=$id?>").html(request.responseText); }, url:"<?php echo $this->Url->build('/');?>"+'sales/commends_change_status', data:{"detail_commend_id":<?=$value->detail_commend->id;?>,"value_check":$("#ckeckNumerationsId<?=$id?>").is(":checked")}}) })
												//]]>
												</script>
		                                    	<?
		                                    }else{
		                                    	echo '<div class="label">'.$value->detail_commend->status->name.'</div>';
		                                    }
		                                    //echo $this->Ajax->observeField("ckeckNumerationsId$id",['url' =>['controller' => 'sales','action' => 'commends_change_status'],'confirm' => 'Are you sure?','with'=>null,'update' => "tdNumeration$id",'datos'=>['detail_commend_id'=>$value->detail_commend->id,'value_check'=>$value_check]]);

		                                    //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

		                                    //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

		                                    
		                                    echo "</td>";
		                                    
		                                
		                                echo "</tr>";
	                            	}
	                            
	                           
	                        }
							
	                         ?>
	                    </tbody>
	                </table>
	                </h6>
	    </div>
	    <div class="col-sm-1"></div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">cerrar</button>
</div>