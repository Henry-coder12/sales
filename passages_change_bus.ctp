

			<? echo $this->Modal->header('CAMBIO DEL BUS ---- "'.$programacion->bus->plate.'"', ['close' => true]); ?>
			<div class="modal-body">
				<div class="row" id="bus_change_body">
				
								<?php echo $this->Ajax->form(array('type' => 'post',
							            		            'options' => array(
							            		                'update'=>'bus_change_body',
							            		                'url' => array(
							            		                    'controller' => 'sales',
							            		                    'action' => 'passages_change_bus_comparation'
							            		                ),
							            		                'horizontal' => true,
							            				        'cols' => [ 
							            		                    'label' => 6,
							            		                    'input' => 3,
							            		                    'error' => 0
							            		                ],
							            		                'indicator' => 'cargando'    
							            		            )
							            		        )); 
							            echo $this->Form->input('buse_id', ['options'=>$buses,'label'=>'Seleccione el BUS a CAMBIAR']); 
							            echo $this->Form->hidden('programation_id', ['value'=>$programation_id]); 
							            echo $this->Form->submit('COMPARAR');
							            echo $this->Form->end() ;
							            ?>

							            <hr>

							         
				
			    </div>
			</div>
			<?
			    echo $this->Modal->footer([
			        $this->Form->button('Cerrar', ['data-dismiss' => 'modal','class'=>'btn-sm']) 
			    ]) ;
			?>

