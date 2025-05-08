<h3>Cambio de bus de <?php echo $programacion['bus']['plate'] ?> a <?php  echo $buses->plate;?></h3>
	<script type="text/javascript">
		function setSelectByText(eID,text)
		{ //Loop through sequentially//
		  var ele=document.getElementById(eID);
		  for(var ii=0; ii<ele.length; ii++)
		    if(ele.options[ii].text==text) { //Found!
		      ele.options[ii].selected=true;
		      return true;
		    }
		  return false;
		}
	</script>
					<?php echo $this->Ajax->form(array('type' => 'post',
            		            'options' => array(
            		                'update'=>'bus_change_body',
            		                'url' => array(
            		                    'controller' => 'sales',
            		                    'action' => 'passages_change_bus_save'
            		                ),
            		                'horizontal' => true,
            				        'cols' => [ 
            		                    'label' => 3,
            		                    'input' => 3,
            		                    'error' => 0
            		                ],
            		                'indicator' => 'cargando'    
            		            )
            		        )); 
					echo $this->Form->hidden("programation_id", ['value'=>$programacion->id,'label'=>'']);
					echo $this->Form->hidden("bus_id_change", ['value'=>$buses->id,'label'=>'']);
            		 ?>
            		<div class="col-md-4"></div>
            		<div class="col-md-4">
							<table class="table table-striped table-bordered table-hover table-full-width" id="users_dt">
						            <thead>
						                <tr>
						                    <th>ID</th>
						                    <th>Cant Registros</th>
						                    <th>ASIENTO En <?php echo $programacion['bus']['plate'] ?></th>
						                    <th>ENVIAR a <?php  echo $buses->plate;?></th>
						                </tr>
						            </thead>
						            <tbody>
									    <?php 
									    $permitirCambiar=true;
									    foreach ($seatsBusProgram as $value): 
									    	if ($CountSales[$value->id]>0) {
									    		if (in_array(trim($value->name_seat), $busSeats)==false) { //busca el asiento en el array
									    			$permitirCambiar=false;
									    		

											    	?>
											    	<tr>
								                        <td><?php echo $value->id; ?></td>
								                        <td><?php echo $CountSales[$value->id]; ?></td>
								                        <td><?php echo $value->name_seat; ?></td>
								                        <td><?php 
									                        echo 'ACOMODAR';
									                        echo $value->postpone;

									                        echo '<div class="hide">'.$this->Form->select("seat_bus_id_seat[$value->id]",$busSeats, ['default'=>$value->name_seat,'label'=>'','id'=>"seat_bus_id_seat_$value->id"]).'</div>';
									                        //debug(trim($value->name_seat));
									                        //debug($busSeats);
									                        //debug(in_array(trim($value->name_seat), $busSeats)); ?>
								                        	<script type="text/javascript">
								                        		setSelectByText('seat_bus_id_seat_<?=$value->id;?>',<?=trim($value->name_seat)?>);
								                        			
								                        	</script>
								                        </td>
								                        
								                    </tr>
											    	<?php 
											    }else{
									    			?>
											    	<tr class='hide'>
								                        <td><?php echo $value->id; ?></td>
								                        <td><?php echo $CountSales[$value->id]; ?></td>
								                        <td><?php echo $value->name_seat; ?></td>
								                        <td><?php 
								                        	echo $value->postpone;
									                        echo $this->Form->select("seat_bus_id_seat[$value->id]",$busSeats, ['default'=>$value->name_seat,'label'=>'','id'=>"seat_bus_id_seat_$value->id"]);
									                        //debug(trim($value->name_seat));
									                        //debug($busSeats);
									                        //debug(in_array(trim($value->name_seat), $busSeats)); ?>
								                        	<script type="text/javascript">
								                        		setSelectByText('seat_bus_id_seat_<?=$value->id;?>',<?=trim($value->name_seat)?>);
								                        			
								                        	</script>
								                        </td>
								                        
								                    </tr>
											    	<?php 
									    		}
									    	}
									    endforeach;?>
									</tbody>
							</table>
							<?php 
							if ($permitirCambiar==true) {
								echo $this->Form->submit('CAMBIAR EL BUS'); 
							}else{
								echo '<div class="label"> ACOMODE LOS ASIENTOS </div>';
							}
							

							?>
					</div>
					<div class="col-md-4"></div>

			<?php echo $this->Form->end();   ?>