<style type="text/css">
    td {
        margin-top: 10px;
    }
</style>
<?php if ($programationData->status==0) { //programation_Bloqueado ?>
    <script type="text/javascript">
        $('#load_bus').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#selected_seat').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#actions_users').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#myModal2').modal('hide');
    </script>
<?php }else{ ?>

            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Asiento Numero <div class="label" style="font-size: 17px;"><?php echo $bus_seat['name_seat'] ?></div></h3>
                <small class="font-bold">Detalle de ventas.</small>
            </div>
            <div class="modal-body" >
                    
                       
                        <div id="contenidoseatdetail">  
                             <div class="p-w-md m-t-sm">
                                <div class="row text-center">
                                    <h3><?php echo $Routes->name ?></h3>
                                </div>
                            </div>
                            <h6>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>cod</th>
                                    <th>BOLETO</th>
                                    <th>Num Doc</th>
                                    <th>Nombre</th>
                                    <th>Num Teléfono</th>
                                    <th>Fecha Viaje</th>
                                    <th>Fecha Registro</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Usuario Atendido</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $contar=1;
                                    
                                    foreach ($sales as $value) {
                                        if($value->postpone==1){ //si esta POSTERGADO
                                            echo "<tr class='danger'>";
                                                echo "<td>$contar</td>";
                                                echo "<td>".$value->id."</td>";
                                                echo "<td>".$value->serie.'-'.$value->number."</td>";
                                                echo "<td>".$value->client->document."</td>";
                                                echo "<td>".$value->client->surnames.' '.$value->client->names."</td>";
                                                echo "<td style='font-weight: bold;font-size: 14px;color:#2979ff;'>".$value->client->num_phone."</td>";
                                                echo "<td>".$value->date_travel->format('d/m/Y').' - '.$value->hour_travel->format("g:i a")."</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td>".$value->origin['cp']."</td>";
                                                echo "<td>".$value->destine['cp']."</td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."</td>";
                                                echo "<td> S/. ".number_format($value->price,2)."</td>";
                                                echo "<td>";
                                                echo "<div class='btn btn-danger btn-xs'>POSTERGADO POR (".$value->user_pospone['username'].")</div>";
                                                //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

                                                //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

                                                
                                                echo "</td>";
                                            
                                            echo "</tr>";
                                        }elseif($value->locked==1 and $value->cancel_sale==0 and $value->reserved<>1){ //si esta bloqueado
                                            echo "<tr class='warning'>";
                                                echo "<td>$contar</td>";
                                                echo "<td>".$value->id."</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td>BLOQUEADO POR =========> </td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."<td>";
                                            echo "</tr>";
                                        }elseif($value->locked==0 and $value->cancel_sale==0 and $value->reserved<>1){ // si esta vendido 
                                            echo "<tr class='success'>";
                                                echo "<td>$contar</td>";
                                                echo "<td>".$value->id."</td>";
                                                echo "<td>".$value->serie.'-'.$value->number."</td>";
                                                echo "<td>".$value->client->document."</td>";
                                                echo "<td>".$value->client->surnames.' '.$value->client->names."</td>";
                                                echo "<td style='font-weight: bold;font-size: 14px;color:#2979ff;'>".$value->client->num_phone."</td>";
                                                echo "<td>".$value->date_travel->format('d/m/Y').' - '.$value->hour_travel->format("g:i a")."</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td>".$value->origin['cp']."</td>";
                                                echo "<td>".$value->destine['cp']."</td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."</td>";
                                                echo "<td> S/. ".number_format($value->price,2)."</td>";
                                                echo "<td>";
                                                    
                                                    //if($user_id==$value->user->id) { //si es el mismo vendedor ... solo puede anular si esta en la misma oficina origen
                                                        
                                                        if($value->ubigeo_id_origin==$coder_ubigeo_id){
                                                            if($value->postpone==0){

                                                                $fecha_viaje=strtotime($value->date_travel->format('Y-m-d').' '.$value->hour_travel->format("H:i:s"))+300; // 5 min
                                                                $fecha_actual=strtotime(date('Y-m-d H:i:s'));
                                                                
                                                                if ( $fecha_viaje > $fecha_actual ) {

                                                                    echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);

                                                                    if ($value->sunat==false or $value->doc=='16') {
                                                                         if ($user_id==217) {
                                                                            echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);
                                                                        }
                                                                    }else{
                                                                         echo " <div class='label label-danger'>NO SE PUEDE ANULAR EN SUNAT</div>"; 
                                                                    }
                                                                    
                                                                }else{
                                                                   echo " <div class='label label-danger'>NO SE PUEDE ANULAR</div>"; 
                                                                }

                                                                

                                                            }else{
                                                               echo "<div class='label label-warning'>POSTERGADO </div>"; 
                                                            }
                                                            
                                                        }else{
                                                            echo "<div class='label label-info'>NO ESTA EN ".$value->origin['cp'].'</div>';

                                                            //echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);

                                                        }
                                                        
                                                    //}
                                                    if ($value->doc=='01' OR $value->doc=='03' OR $value->doc=='12') {
                                                        echo ' '.$this->Html->link('Reimprimir',['controller'=>'sales','action'=>'passages_reprint',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']);
                                                        echo ' '.$this->Html->link('Reimprimir TACO',['controller'=>'sales','action'=>'passages_printer_taco',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-warning']);

                                                    }

                                                    echo ' '.$this->Html->link('IMP. DECLARACION',['controller'=>'sales','action'=>'passages_printer_declaration',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']);

                                                    //---- FROM RED BUS ----
                                                    if ($value->serie=='TP99') {
                                                    	if($value->ubigeo_id_origin==$coder_ubigeo_id){
                                                            if($value->postpone==0){

                                                                $fecha_viaje=strtotime($value->date_travel->format('Y-m-d').' '.$value->hour_travel->format("H:i:s"))+300; // 5 min
                                                                $fecha_actual=strtotime(date('Y-m-d H:i:s'));
                                                                
                                                                if ( $fecha_viaje > $fecha_actual ) {

                                                    				echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);
                                                    			}
                                                    		}
                                                    	}else{
                                                            echo "<div class='label label-info'>NO ESTA EN ".$value->origin['cp'].'</div>';
                                                        }
                                                    }
                                                    //---- END FRON RED BUS ------

                                                    
                                                echo "</td>";
                                                echo "<td> ";
                                                    if ($value->postpone_sale_id>0){
                                                        echo $this->Html->link('IMPRIMIR DOC REF.',['controller'=>'sales','action'=>'passages_print_sales_free',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']);
                                                    }
                                                echo "</td>";
                                            echo "</tr>";
                                        }elseif($value->locked==0 and $value->cancel_sale==1 and $value->reserved<>1) { // si esta anulado
                                            echo "<tr class='danger'>";
                                                echo "<td>$contar</td>";
                                                echo "<td>".$value->id."</td>";
                                                echo "<td>".$value->serie.'-'.$value->number."</td>";
                                                echo "<td>".$value->client->document."</td>";
                                                echo "<td>".$value->client->surnames.' '.$value->client->names."</td>";
                                                echo "<td style='font-weight: bold;font-size: 14px;color:#2979ff;'>".$value->client->num_phone."</td>";
                                                echo "<td>".$value->date_travel->format('d/m/Y').' - '.$value->hour_travel->format("g:i a")."</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td>".$value->origin['cp']."</td>";
                                                echo "<td>".$value->destine['cp']."</td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."</td>";
                                                echo "<td> S/. ".number_format($value->price,2)."</td>";
                                                echo "<td>";
                                                echo "<div class='btn btn-danger btn-xs'>ANULADO</div>";
                                                //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

                                                //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

                                                
                                                echo "</td>";
                                            
                                            echo "</tr>";
                                        }elseif ($value->reserved==1) {
                                            echo "<tr class='warning'>";
                                                echo "<td>$contar</td>";
                                                echo "<td>".$value->id."</td>";
                                                echo "<td>-----------------------</td>";                                    
                                                echo "<td>-----------------------</td>";
                                                echo "<td>".$value->reference_client."</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td colspan='2'>RESERVADO POR : ==>  </td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."<td>";
                                                echo "<td>";
                                                //echo "<div class='btn btn-danger btn-xs'>ANULADO</div>";
                                                echo $this->Ajax->link('DESBLOQUEAR',['controller' => 'sales', 'action' => 'passages_reserva_exit', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-info btn-xs btn-rounded','escape'=>false,'confirm'=>'DESBLOQUEAR?']).' ';

                                                //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

                                                
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                        
                                        $contar++;
                                    } ?>
                                </tbody>
                            </table>
                            </h6>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">cerrar</button>
            </div>

<?php } ?>