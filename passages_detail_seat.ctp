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
                                    <th>Viaja con</th>      <!--'autoriza'-->
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
                                                echo "<td>".$value->autoriza."</td>";       //'autoriza'
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
                                                echo "<td>-----------------------</td>";        //'autoriza'
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>-----------------------</td>";
                                                echo "<td>".$value->created->format("d/m/Y g:i a")."</td>";
                                                echo "<td>BLOQUEADO POR =========> </td>";
                                                echo "<td>".$value->user->names.', '.$value->user->surnames."<td>";
                                                echo "<td>";
                                                if($user_id==382 or $user_id==100/*  or $user_id==411*/) {
                                                    echo $this->Ajax->link('DESBLOQUEAR',['controller' => 'sales', 'action' => 'passages_reserva_exit', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-info btn-xs btn-rounded','escape'=>false,'confirm'=>'DESBLOQUEAR?']).' ';

                                                }
                                                echo "</td>";
                                                echo "<td>";
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
                                                echo "<td>".$value->autoriza."</td>";       //'autoriza'
                                                echo "<td> S/. ".number_format($value->price,2)."</td>";
                                                echo "<td>";
                                                    //if($user_id==$value->user->id) { //si es el mismo vendedor ... solo puede anular si esta en la misma oficina origen

                                                        //debug(strtotime($value->date_travel->format('Y-m-d').' '.$value->hour_travel->format("H:i:s") ));
                                                        //debug(strtotime(date('Y-m-d H:i:s')));
                                                        $fecha_viaje=strtotime($value->date_travel->format('Y-m-d').' '.$value->hour_travel->format("H:i:s"))+7200;
                                                        $fecha_actual=strtotime(date('Y-m-d H:i:s'));

                                                        if($value->ubigeo_id_origin==$coder_ubigeo_id){
                                                            if($value->postpone==0){
                                                                if ( $fecha_viaje > $fecha_actual ) {
                                                                    if($user_id==169 or $user_id==167 or $user_id==136 or $user_id==233 or $user_id==234){ //atico,alto siguas, camana 
                                                                        echo "<div class='label label-warning'>SIN PERMISO DE POSTERGAR ( Comuniquese con CENTRAL AREQUIPA )</div>";
                                                                    }else{
                                                                        echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);
                                                                    }
                                                                }
                                                                    

                                                                
                                                                
                                                                /*if ( $fecha_viaje > $fecha_actual ) {
                                                                    if($user_id==169 or $user_id==167 or $user_id==136 or $user_id==233 or $user_id==234){ //atico,alto siguas, camana 
                                                                        echo "<div class='label label-warning'>SIN PERMISO DE ANULACION ( Comuniquese con CENTRAL AREQUIPA )</div>";
                                                                    }else{
                                                                        if ($value->sunat==false) {
                                                                            echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);
                                                                        }else{
                                                                            echo " <div class='label label-danger'>NO SE PUEDE ANULAR EN SUNAT</div>"; 
                                                                        }
                                                                    }
                                                                }else{
                                                                   echo " <div class='label label-danger'>NO SE PUEDE ANULAR</div>"; 
                                                                }*/

                                                               /* if ($value->sunat==false AND ($user_id==382 OR $user_id==100)) {
                                                                    echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);

                                                                }else{
                                                                    echo " <div class='label label-danger'>NO SE PUEDE ANULAR EN SUNAT</div>"; 
                                                                }*/

                                                                

                                                            }else{
                                                               echo "<div class='label label-warning'>POSTERGADO </div>"; 
                                                            }
                                                            
                                                        }/*else{
                                                            if ($value->sunat==false AND ($user_id==382)) {
                                                                echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);
                                                                echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);

                                                            
                                                        }*/
                                                        if ($value->sunat==false AND ($user_id==382 OR $user_id==175 OR $user_id==261 OR $user_id==417 OR $user_id==384  OR $user_id==366)) {    //384:Estefani
                                                                echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);
                                                                //echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);

                                                            }
                                                        /*else{
                                                            echo "<div class='label label-info'>NO ESTA EN ".$value->origin['cp'].'</div>';
                                                            
                                                            if($user_id==169 or $user_id==167 or $user_id==136 or $user_id==233 or $user_id==234){ //atico,alto siguas, camana 
                                                                echo "<div class='label label-warning'>SIN PERMISO DE ANULACION ( Comuniquese con CENTRAL AREQUIPA )</div>";
                                                            }else{
                                                                //echo ' '.$this->Ajax->link('ANULAR',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro anular boleto? ... NO HAY PASO ATRAS. ']);
                                                            }

                                                        }*/
                                                        
                                                    //}
                                                    if ($value->doc=='01' OR $value->doc=='03') {
                                                        //echo ' '.$this->Html->link('Reimprimir',['controller'=>'sales','action'=>'passages_reprint',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']);
                                                        //echo ' '.$this->Html->link('Reimprimir TACO',['controller'=>'sales','action'=>'passages_printer_taco',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-warning']);
                                                    }
                                                    //declaracion jurada
                                                    //echo ' '.$this->Html->link('IMP. DECLARACION',['controller'=>'sales','action'=>'passages_printer_declaration',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']); 
                                                    echo "<br><br>";
                                                    echo "<strong>";
                                                        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file-pdf-o')).' Pdf',"/admin/viewpdf/".base64_encode(base64_encode($value->id.'-0')),['escape' => false,'class'=>'btn btn-outline btn-danger btn-xs','target'=>'_black']);                                        
                                                    echo "</strong>";                                   
                                                echo "</td>";
                                                echo "<td> ";
                                                    if ($value->postpone_sale_id>0){
                                                        echo $this->Html->link('IMPRIMIR DOC REF.',['controller'=>'sales','action'=>'passages_print_sales_free',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn btn-xs btn-info']);
                                                    }                                                   
                                                echo "</td>";                                                
                                                echo "<td rowspan=2>";    //ini ticket de equipaje
                                                ?>
                                                <div class='col-md-12'><!--ticket equipaje-->
                                                    <?php if ($value->id>0) { ?>
                                                        <div class="widget-head-color-box navy-bg p-xs text-center">
                                                            <!--<div class="m-b-md">--><span>Ticket equipaje CLIENTE</span><br><br>
                                                                <h2 class="font-bold no-margins">
                                                                    <?php
                                                                    echo ' '.$this->Html->link($value->id.' <i class="fa fa-print fa"></i>',['controller'=>'sales','action'=>'passages_print_maleta',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'label','style'=>'font-size: 23px;font-weight: bold;']);
                                                                    ?>
                                                                </h2>
                                                                <!--<small>
                                                                    numero de EQUIPAJE
                                                                </small>-->
                                                            <!--</div>-->
                                                            <br>
                                                            <span>Ticket EQUIPAJE</span>
                                                            <?php 
                                                            echo ' '.$this->Html->link('<i class="fa fa-suitcase fa-3x"></i>',['controller'=>'sales','action'=>'passages_print_maleta_taco',$value->id],['escape'=>false,'target'=>'hidden_iframe_passages','class'=>'btn','style'=>'color:#fff;']);
                                                            ?>
                                                            <br>
                                                        </div>
                                                    <?php } ?>
                                                </div><!--FIN ticket equipaje-->
                                            <?php
                                                echo "</td>";   //FIN ticket de equipaje
                                            echo "</tr>";
                                            ?>
                                            <!--------------
                                            //BAJA INTERNA
                                            --------------->
                                            <?php if ($user_id==100 or $user_id==384 or $user_id==366): //384:Estefani?>
                                                <?php if ($value->sunat==false): ?>
                                                    <tr class='success'>
                                                        <td colspan=15 align=right id="div_sale_<?=$value->id?>">
                                                        <!------------------------------------------------->
                                                        <!--ADD-Anghel form de enviar motivo de anulacion-->
                                                        <!------------------------------------------------->
                                                        <?php echo $this->Ajax->form(['options' => ['update'=>"div_sale_".$value->id,'url' => ['controller'=>'admin', 'action' => 'passagesCancelSale'], 'class'=>'form-horizontal', 'indicator'=>'loading'.$value->id]]);?>
                                                        <div class="col-md-4">
                                                            <div class="input-group m-b"><span class="input-group-btn">
                                                                <button type="submit" class="btn btn-danger btn-md btn-outline">ANULAR</button> </span>
                                                                <input type="text" class="form-control input-md" required="required" placeholder="MOTIVO (minimo 2 palabras)" style="border: 1px solid #ed5565;" minlength="5" name="motivo_del" onkeydown="valAlphaNumericNbsp(event); aMays(this);">
                                                            </div>
                                                        </div>
                                                        <?php echo $this->Form->hidden('salesIdDel', ['value'=>$value->id]); ?>
                                                        <?php echo $this->Form->hidden('typeFormBaja', ['value'=>'2']); ?>
                                                        <?php echo $this->Form->end();?>
                                                        <!--END->Anghel, 30 jul 2020-->
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr class='success'>
                                                        <td colspan=15 align=right_ id="div_sale_<?=$value->id?>">
                                                            <h3><code>Documento enviado a la SUNAT!. No se puede anular.</code></h3>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>                                                
                                            <?php endif ?>
                                            <!----------------
                                            //END BAJA INTERNA
                                            //---------------->
                                        <?php
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
                                                echo "<td>".$value->autoriza."</td>";       //'autoriza'
                                                echo "<td> S/. ".number_format($value->price,2)."</td>";
                                                echo "<td>";
                                                echo "<div class='btn btn-danger btn-xs'>ANULADO</div>";
                                                //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

                                                
                                                echo "</td>";
                                            
                                            echo "</tr>";
                                        }elseif ($value->reserved==1) {
                                            debug($agence_ses);
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
                                                echo "<td>".$value->agence->name."</td>";
                                                echo "<td>";
                                                //echo "<div class='btn btn-danger btn-xs'>ANULADO</div>";
                                                //if($user_id==$value->user->id) {
                                                if($user_id==382 or $user_id==100 or $agence_ses==$value->agence_id) {
                                                    echo $this->Ajax->link('DESBLOQUEAR',['controller' => 'sales', 'action' => 'passages_reserva_exit', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-info btn-xs btn-rounded','escape'=>false,'confirm'=>'DESBLOQUEAR?']).' ';

                                                }

                                               
                                                
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                        if ($user_id==100 OR $user_id==384 OR $user_id==366) {   //384: Estefani
                                            echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_postpone_sale', $value->id,'?'=>['r'=>$CoderRouteId,'a'=>$CoderAgenceId] ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de postegar el asiento?']);
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

<script type="text/javascript">
    function aMays(campo){
            $(campo).keyup(function() {
                $(this).val($(this).val().toUpperCase());
            });
        }
</script>