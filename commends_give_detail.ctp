<style type="text/css">
    td {
        margin-top: 10px;
    }
</style>

<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h3 class="modal-title">DOCUMENTO : <div class="label" style="font-size: 17px;"><?php //echo $dato['serie'].'-'.$dato['number'] ?></div></h3>
    <small class="font-bold">Detalle de ventas.</small>
</div>
<div class="modal-body" >
        
            
            <div id="update_client">  
                <div class="p-w-md m-t-sm">
                    <div class="row text-center">
                        <h3>QUIEN RECIBE: </h3>
                    </div>
                </div>
                <?php echo $this->Ajax->form(array('type' => 'post',
		            'options' => array(
		                'update'=>'update_client',
		                'url' => array(
		                    'controller' => 'sales',
		                    'action' => 'commends_consig_save'
		                ),
		                'horizontal' => true,
				        'cols' => [ 
		                    'label' => 3,
		                    'input' => 7,
		                    'error' => 0
		                ],
		                'indicator' => 'cargando'
		                    
		            )
		        ));
                    $sexo = [ 1 => 'MASCULINO', 2 => 'FEMENINO'];
                    echo $this->Form->hidden('saved', ['type' => 'text','value'=>0]) ;
                    echo $this->Form->hidden('id_client', ['type' => 'text','value'=>$consig['id']]);
                    echo $this->Form->hidden('key_val', ['type' => 'text','value'=>$dato['key_client']]);
                    echo $this->Form->input('document', ['type' => 'text','label'=>'NUM. DOC.','value'=>$consig['document'],'required'=>true]) ;
                    echo $this->Form->input('surnames', ['type' => 'text','label'=>'APELLIDOS','value'=>$consig['surnames'],'required'=>true]) ;
                    echo $this->Form->input('names', ['type' => 'text','label'=>'NOMBRES','value'=>$consig['names'],'required'=>true]) ;
                    echo $this->Form->input('gender',[ 'options' => $sexo ,'label'=>'GENERO','value'=>$consig['gender']]);
                    echo $this->Form->input('address', ['type' => 'text','label'=>'DIRECCION','value'=>$consig['address']]) ;
                    echo $this->Form->input('obs', ['type' => 'text','label'=>'OBS.','value'=>$consig['obs']]) ;
                    echo $this->Form->submit('GUARDAR DATOS DE CLIENTE');
                echo $this->Form->end() ;
            ?>
            </div>


            <div class="message-content" id="list_commends" style="font-size:11px;display:none;">
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
                            //print_r($value['Estado']['name']);
                            $id=$value['id']; //id detail_commend
                            $cant=$value['quantity'];
                            $contiene=$value['content'];
                            $precio=$value['price'];
                            $estado=$value['status']['name'];
                            $estado_id=$value['status']['id'];
                            $suma=$suma+($cant*$precio);
                            echo "<tr>
                                    <td class='center'>$cant</td>
                                    <td>$contiene</td>
                                    <td id='estado$id'>$estado</td>";
                                    if($estado_id==3 and $dato['prepaid']=='1' and $dato['ubigeo_id_destino']==$ubigeo_id){ //si la encomienda ya llego y si la encomienda esta  pagada
                                        echo "<td id='msn$id'>";
                                        echo $this->Ajax->link('entregar',['controller' => 'sales', 'action' => 'commends_give_client', $id ],['update' => "estado$id", 'indicator' => 'cargando','class'=>'btn btn-xs btn-success','escape'=>false]);
                                        echo '</td>';
                                    }else{
                                        if ($dato['agence_id_prepaid']==null) {
                                                echo '<td>-</td>';
                                            }elseif($estado_id==3 and $dato['ubigeo_id_destino']==$ubigeo_id ){
                                                echo "<td id='msn$id'>";
                                                echo $this->Ajax->link('entregar',['controller' => 'sales', 'action' => 'commends_give_client', $id ],['update' => "estado$id", 'indicator' => 'cargando','class'=>'btn btn-xs btn-success','escape'=>false]);
                                                echo '</td>';
                                            }
                                        
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
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
</div>

<script>
        $(document).ready(function(){
			$('.clockpicker').clockpicker();
		});
</script>