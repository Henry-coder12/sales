<?php //debug($dato);?>

<div class="message-header">	
	<div class="message-from">
		<?php 
		if($dato['doc']=='03'){$es='BOL';echo $es;}elseif($dato['doc']=='01'){$es='FAC';echo $es;}
		?>
		<?php
		if ($dato['prepaid']=='1') {
			$serie_number=$dato['serie'].' - '.str_pad($dato['number'],7,'0',STR_PAD_LEFT);
		 	echo $serie_number;
		}else{
				echo str_pad($dato['id'],7,'0',STR_PAD_LEFT);
		}

		?>
		
		<?php
		
		if($dato['ubigeo_id_origen']==$ubigeo_id and $dato['canceled']==0){ //si es el ubigeo origen damos permisos de re-impresion
			//if ($dato['reprint']==null) {
				if ($dato['prepaid']=='1') {
					echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'commends_print'),'target'=>'hidden_iframe'));
					echo $this->Form->hidden('id_commends_reprint',['value'=>$dato['id']]);
					echo $this->Form->submit('RE-IMPRIMIR',['class'=>'btn btn-xs btn-primary']);
					//echo $this->Form->submit('RE-IMPRIMIR',['class'=>'btn btn-xs btn-primary','onclick'=>'$(this).hide();']);
					# code...
				}else{
					
					echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'commends_ticket'),'target'=>'hidden_iframe'));
					echo $this->Form->hidden('id_commends_reprint',['value'=>$dato['id']]);
					echo $this->Form->submit('RE-IMPRIMIR TICKET',['class'=>'btn btn-xs btn-primary']);
				
					# code...
				
				}
			//}
			
			echo $this->Html->link('TACO', ['action' => 'commends_printer_taco',$dato['id'].'-1'], ['target'=>'hidden_iframe','escape' => false,'class'=>'btn btn-xs btn-warning']);
			if ($dato['zip2']==null) {
				echo ' '.$this->Ajax->link(' ANULAR BOLETO ', array('controller'=>'sunat','action' => 'commend_baja_interna', $dato['id']),array('update' => 'view_commends', 'indicator' => 'loading','class'=>'btn btn-outline btn-danger btn-xs','confirm' => 'El registro no se enviara a la sunat?'));
			}else{
				echo ' <div class="label"> En SUNAT </div>';
			}
			//echo $this->Html->link('CAMBIO CLAVE', ['action' => 'commends_change_key_client',$dato['id']], ['data-toggle'=>'modal','data-target'=>'#myModal','escape' => false,'class'=>'btn btn-xs btn-warning']);
		}
		if ($dato['canceled']==1) {
			echo '<div class="alert alert-danger"><b>DOCUMENTO ANULADO</b></div>';
		}
		
		
		?>
	</div><br><br>
	<div class="message-to">
		<b>Enviar : </b> 
		<?php 
		if ($dato['doc']=='01') {
			echo $dato['client']['razon'];
		}else{
			echo $dato['client']['surnames'].' '.$dato['client']['names'];
		}
		
		?>
		<br>
		<b>Recibe : </b> <?php echo strtoupper($dato['consig_name']);?>
	</div>
	<div class="message-subject">
		<b>Origen :</b> <?php echo $dato['origen'];?>
		<br>
		<b>Destino :</b> <?php echo $dato['destino'];?>
	</div>
	<div class="message-subject">
		<b>Atendido por :</b> <?php echo $dato['user']['surnames'].' '.$dato['user']['names'];?>
		<br>
		<b>Fecha Registro :</b> <?php echo $dato['created']->format('d-m-Y h:i a');?>
		<br>
		<h3><b>CELULAR :</b> <?php echo $data_remit->num_phone;?></h3>
	</div><br>
	<div class="message-subject">
		<?php 
		// if para el destino
		// si aun no se ah pagado la encomienda y si no esta anulada y si la sede destino es la misma sede de la oficina
		if($dato['cancelado']=='0' and $dato['prepaid']=='0' and $dato['ubigeo_id_destino']==$ubigeo_id){
			echo $this->Ajax->link(' PAGO EN DESTINO, Desea pagar?',array( 'controller' => 'invoice', 'action' => 'pago_destino_commend', $dato['id'] ),array( 'update' => 'view_commends', 'confirm' => "Desea hacer el pago en destino del docuemnto \n $es $serie_number",'class'=>'btn btn-danger btn-xs'));
		}
		?>

		<?php 
		// if para el origen
		// si aun no se ah pagado la encomienda y si es de la sede origen
		if($dato['prepaid']=='0'){
			if($dato['ubigeo_id_destino']==$ubigeo_id){
				if ($dato['agence_id_prepaid']==null and $dato['commend_id_prepaid']==0) {
					if ($dato['client']['credit']==1) {
                    	echo '<a href="#" class="btn btn-info btn-xs">ENCOMIENDA AL CREDITO </a>';
	                }else{
	                   echo $this->Html->link(' PAGAR ENCOMIENDA EN DESTINO', ['action' => 'commends_pay_destine',$dato['id']], ['data-toggle'=>'modal','data-target'=>'#myModal','class'=>'btn btn-xs btn-danger']);
	                }
					
				}else{
					echo '<a href="#" class="btn btn-info btn-xs">LA ENCOMIENDA YA FUE PAGADA EN DESTINO </a>';
				}
				
			}else{
				if ($dato['commend_id_prepaid']==null  and $dato['canceled']==0) {
					//echo '<a href="#" class="btn btn-danger btn-xs">LA ENCOMIENDA SERA PAGADA EN DESTINO </a>';
					if ($dato['client']['credit']==1) {
                    	echo '<a href="#" class="btn btn-info btn-xs">ENCOMIENDA AL CREDITO </a>';
	                }else{
	                   echo $this->Html->link(' PAGAR ENCOMIENDA EN DESTINO', ['action' => 'commends_pay_destine',$dato['id']], ['data-toggle'=>'modal','data-target'=>'#myModal','class'=>'btn btn-xs btn-danger']);
	                }
					
				}elseif($dato['canceled']==1){
					echo '<div class="alert alert-danger"><b>DOCUMENTO ANULADO</b></div>';
				}else{
					echo $this->Html->link(' LA ENCOMIENDA YA FUE PAGADA CON '.$PrepaidData->serie.' - '.$PrepaidData->number, ['action' => 'viewpdf',$dato['commend_id_prepaid'].'-1'], ['target'=>'_black','class'=>'btn btn-xs btn-danger']);
				}
			}
		}elseif($dato['prepaid']=='1'){
			echo '<a href="#" class="btn btn-success btn-xs">LA ENCOMIENDA HA SIDO PAGADA</a>';
		}
		?>
	</div>
	<br>
</div>
<div class="message-content" style="font-size:11px;">
	<center>LISTA DE ENCOMIENDAS </center>
	<table class="table table-hover" id="sample-table-1">
		<thead>
			<tr>
				<th class="center">cant</th>
				<th>dice contener</th>
				<th>ESTADO</th>
				<th>ACCION</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//echo '<pre>';
			//debug($dato);
			//echo '</pre>';
			$suma=0;
			foreach ($dato['detail_commends'] as $value) {
				$idDetail=$value['id'];
				//print_r($value['Estado']['name']);
				$subtotal=$value['total'];
				$cant=$value['quantity'];
				$contiene=$value['content'];
				$precio=$value['price'];
				$estado=$value['status']['name'];
				$estado_id=$value['status']['id'];
				$suma=$suma+($subtotal);
				echo "<tr>
						<td class='center'>$cant</td>
						<td>$contiene</td>
						<td>$estado</td>";
						if($estado_id==3 and $dato['prepaid']=='0' and $dato['ubigeo_id_destino']==$ubigeo_id){ //si la encomienda ya llego y si la encomienda esta pagada
							if ($dato['agence_id_prepaid']==null) {
								echo '<td><div class="label"> SIN PAGAR </div></td>';
							}else{
								echo '<td>'.$this->Html->link(' ENTREGAR', ['action' => 'commends_give_detail',$dato['id']], ['data-toggle'=>'modal','data-target'=>'#myModal','class'=>'btn btn-xs btn-success']).'</td>';
							}
							
						}elseif($estado_id==3 and $dato['prepaid']=='1' and $dato['ubigeo_id_destino']==$ubigeo_id){ //si la encomienda ya llego y si la encomienda esta 	pagada
							echo '<td>'.$this->Html->link(' ENTREGAR', ['action' => 'commends_give_detail',$dato['id']], ['data-toggle'=>'modal','data-target'=>'#myModal','class'=>'btn btn-xs btn-success']).'</td>';
						}else{
							echo '<td>';
								if ($dateManifProgram[$idDetail]->count()==1) {
									//echo $dateManifProgram[$idDetail]->first()->manifesto->programation->id;
									echo $this->Html->link($this->Html->tag('span', '', [
                                                                            'class' => 'fa fa-file-pdf-o']), [
                                                                            'controller'=>'admin',
                                                                            'action' => 'commendProgramationPdf',$dateManifProgram[$idDetail]->first()->manifesto->programation->id], [
                                                                            'target'=>'_black',
                                                                            'class'=>'btn btn-danger btn-circle',
                                                                            'escape' => false]);
								}else{
									echo '-';
								}
							echo '</td>';
						}
				echo "</tr>";
			}
			?>
			<tr>
				<td colspan="2"><b>TOTAL BOLETA</b></td>
				<td><b><?php echo $suma?></b></td>
			</tr>
		</tbody>
	</table>
		
</div>
