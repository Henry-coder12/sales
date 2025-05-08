<br>
<div class='col titulos' >
	<center><b><h3>MANIFIESTOS DE : <?php echo date('Y-m-d');?></h3></b></center>

</div>
<h6>		
<table class="table table-striped table-bordered table-hover table-full-width dataTable" id='the_table'> 
	<thead>
		<th>OFICINA</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>ORIGEN</th>
		<th>DESTINO</th>
		<th>BUS</th>
		<th>
			<table width="100%">
				<tr>
					<th width="60%"">SERIE - CORRELATIVO</th>
					<th width="40%"> GUIA</th>
				</tr>
			</table>
		</th>
		<th>Organizar</th>
		<th>Manifiesto</th>
		<th><i class="fa fa-users fa-lg"></i></th>
		<th>PDF</th>
	</thead>
	<tbody>
		<?php
		//$buss=array();
		//foreach ($buses as $value) { //echo "$value['bus'][]"
			//$buss=array_push($value[''][]);
		//	}
		//print_r($buss);
		//echo $officesId;
		foreach ($datos as $value):
			$id=$value['programation']['id']; //programations id
				/////////
				// Filtro por oficinas:
				// '3' => Oficina de TERMINAL TERRESTRE de AREQUIPA
				////////////
				
				
				echo '<tr>';
				
					?>
					<td><?php								
					 echo $origen[$value['id']]['name']; ?></td>
					<td><?php 
						echo '<div id="fechas'.$id.'">';
					 	echo $value['programation']->date->format("d-m-Y"); 
					 	//echo $value['programation']->date; 
					 	echo '</div>';
					 	echo $this->Ajax->editor("fechas$id",array('controller' => 'programations','action' =>'change_fecha'),array('submit' =>'cambiar','submitdata'=> array('id_prog'=> $id),'type' => 'text'));
					 	?>
					</td>
					<td><?php 
						echo '<div id="time'.$id.'">';
					 	echo $value['programation']->hour->format("H:i:s"); 
					 	echo '</div>';
					 	echo $this->Ajax->editor("time$id",array('controller' => 'programations','action' =>'change_hora'),array('submit' =>'cambiar','submitdata'=> array('id_prog'=> $id),'type' => 'text'));
					 	?>
					</td>
		            <td><?php echo $origen[$value['id']]['ubigeo']['cp']; ?></td>
					<td><?php echo $destino[$value['id']]['ubigeo']['cp']; ?></td>
					<td>
						<?php
						echo '<div id="buses'.$id.'">';
					 	echo $value['programation']['bus']['plate'];
					 	echo '</div>';
						echo $this->Ajax->editor("buses$id",array('controller' => 'programations','action' =>'change_buss'),array('submit' =>'OK','submitdata'=> array('id_prog'=> $id),'data' => $buses,'type' => 'select'));
					 	?>
					</td>							

					<td style="padding:5px 0 5px 5px;">
					<?php 
					echo $this->Form->create(null, array('url' => array('controller' => 'programations', 'action' => 'printer_guia'),'target'=>'manif_iframe','class'=>'form-inline'));?>
					<table width="100%">					
						<tr>
							<td width="60%">
								<?php echo $this->Form->hidden('prog_id',array('size'=>'8','value'=>$id,'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Serie'));
								if ($value['programation']['serie']==''){
									echo $this->Form->text('serie',array('size'=>'8','value'=>$value['programation']['serie'],'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Serie'));
								}else{
									echo 'SERIE : <b id="serie'.$id.'">';
								 	echo $value['programation']['serie']; 
								 	echo '</b> ';
									echo $this->Ajax->editor("serie$id",array('controller' => 'programations','action' =>'change_serie'),array('submit' =>'cambiar','submitdata'=> array('id_prog'=> $id),'type' => 'text'));
								}	 
								if ($value['programation']['number']==''){
									echo ' '.$this->Form->text('number',array('size'=>'8','value'=>$value['programation']['number'],'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Correlativo'));
								}else{
									echo 'CORRELATIVO : <b id="number'.$id.'">';
								 	echo $value['programation']['number']; 
								 	echo '</b>';
									echo $this->Ajax->editor("number$id",array('controller' => 'programations','action' =>'change_number'),array('submit' =>'cambiar','submitdata'=> array('id_prog'=> $id),'type' => 'text'));
								}?>
							</td>
							<td width="40%">
								<?php echo ' <button type="submit" class="btn btn-warning btn-xs">IMPRIMIR GUIA TRANS</button>';?>	
							</td>
						</tr>						
					</table>
					<?php echo $this->Form->end(); ?>
					</td>					
					<td>
					<?php
						echo $this->Ajax->link('ORGANIZAR LISTA',['controller' => 'programations', 'action' => 'return_detail', $value['id']],['update' => 'content_sales','class'=>'btn btn-info btn-xs','confirm' => "Tenga cuidado con cambiar la LISTA? ... \n todo quedara registrado a su nombre de cuenta"]);
					?>		
					</td>
					<td>
					<?php
						/*echo $this->Form->postLink(__('IMPRIMIR'), ['controller' => 'programations','action' => 'delete', $value['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $value['id']),'class'=>'btn btn-danger btn-xs']);*/
					?>		
					<?php 
					echo $this->Form->create(null, array('url' => array('controller' => 'programations', 'action' => 'printer_manifest'),'target'=>'manif_iframe','class'=>'form-inline'));
						echo $this->Form->hidden('prog_id',array('size'=>'8','value'=>$id,'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Serie'));
						echo $this->Form->hidden('serie',array('size'=>'8','value'=>$value['programation']['serie'],'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Serie'));
						echo $this->Form->hidden('number',array('size'=>'8','value'=>$value['programation']['number'],'required'=> 'required','class'=>'form-control input-sm','placeholder'=>'Correlativo'));
						echo '<button type="submit" class="btn btn-danger btn-xs">MANIFIESTO</button>';
						echo $this->Form->end();
					?>
					</td>
					<td>	
						<?php echo $this->Ajax->link($this->Html->tag('span', '', array('class' => 'fa fa-user')),['controller' => 'programations', 'action' => 'commendDetailCrewsAdd', $id],['indicator' => 'cargando', 'data-toggle'=>"modal", 'data-target'=>"#myModal", 'class'=>'btn btn-primary btn-xs', 'escape'=>false]);?>
					</td>
					<td><?php echo $this->Html->link($this->Html->tag('span', '', [
                                                                            'class' => 'fa fa-file-pdf-o']), [
                                                                            'controller'=>'admin',
                                                                            'action' => 'commendProgramationPdf',$id], [
                                                                            'target'=>'_black',
                                                                            'class'=>'btn btn-danger btn-circle',
                                                                            'escape' => false]); ?></td>
				</tr>
				
		<?php endforeach ?>
	</tbody>
</table>
</h6>