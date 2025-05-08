<?php 
if ($msn==1) {
	?>
		<h6>
		<form id="form_postpone_return" method="post" accept-charset="utf-8" onsubmit="return false;" indicator="loading" role="form" action="#">
			<div class="form-group select">
			    <label class="control-label"><div class=' btn-xs label'>PASAJERO</div></label><br>
			    <div><?php echo $data['sale']['client']['document'].' - '.$data['sale']['client']['names'].' '.$data['sale']['client']['surnames']; ?></div>
			</div>
			<div class="form-group select">
			    <label class="control-label"><div class=' btn-xs label'>AGENCIA DE EMBARQUE</div></label><br>
			    <div><?php echo $agence_emb_free->name; ?></div>
			</div>
			<div class="form-group select">
			    <label class="control-label"><div class=' btn-xs label'>RUTA -- PROGRAMACION</div></label><br>
			    <div><?php echo $data['sale']['programation']['route']['name'].' -- '.$data['sale']['programation']['date']->format('m-d-Y').' '.$data['sale']['programation']['hour']->format("g:i A").'<br> O :'.$origin->cp.' --> D :'.$destine->cp; ?></div>
			</div>
			<div class="form-group select">
			    <label class="control-label"><div class=' btn-xs label'>ASIENTO -- FECHA VIAJE</div></label><br>
			    <div><div class="label label-info"><?php echo $data['sale']['bus_seat']['name_seat'];?></div> -- <?php echo $data['sale']['date_travel']->format('m-d-Y').' '.$data['sale']['hour_travel']->format("g:i A"); ?></div>
			</div>
			
			<?php 
			if($data['status']==1){
				//echo $this->Html->alert('El boleto ya fue usado por el usuario '.$user_use->surnames.', '.$user_use->names);
				echo $this->Html->link('IMPR.',['controller'=>'sales','action'=>'passages_print_sales_free',$data['sale_id_use']],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-info']) ;
				echo ' '.$this->Ajax->link('Ver Doc Ref.',[ 'controller' => 'sales', 'action' => 'passages_view_postpone_data',$data['sale_id_use']],['update' => 'find_sales_free_form','class'=>'btn btn-primary']);
				
			}else{
				//debug($data);
				if ($agende_id_session==$data['sale']['agence_id_embarkation']) {
					?>
					<div class="form-group">
						<input id="btn_postpone_return" class="btn btn-primary" value="RECUPERAR" type="submit">
						<?php //echo $this->Html->link('IMPR.',['controller'=>'sales','action'=>'passages_print_sales_free',$data['id']],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-info']) ;?> 
					</div>
					<?php
				}else{
					echo $this->Html->alert('No se encuentra en mismo origen de embarque u oficina');
				}
				
			}
			?>
		</form>

		<script type="text/javascript">
                    //<![CDATA[
                    $('#form_postpone_return').bind('submit', function(){ 
                        if (confirm('Esta seguro que desea recuperar al asiento?')) {  
                                $.ajax({
                                    async:true, 
                                    type:'post', 
                                    beforeSend:function(request) {$('#loading').show();}, 
                                    complete:function(request, json) {
                                        $('#find_sales_free_form').html(request.responseText);
                                        $('#loading').hide();
                                    }, 
                                    data:{
                                        sale_id_anterior:<?php echo $data['sale_id']; ?>,
                                        salefree_id:<?php echo $data['id']; ?>,
                                        agence_id:<?php echo $agende_id_session; ?>
                                    }, 
                                    url:"<?=$this->Url->build('/');?>"+'sales/passages_sales_free_form'
                                });
                            
                            
                        }else{
                            return false; 
                        } 
                    })
                    //]]>
                    </script>
		</h6>
	<?php
}else{
	echo $this->Html->alert('No existe el documento en la lista de FECHA LIBRE', ['id' => 'alert_info','type' => 'info']);
}

?>

