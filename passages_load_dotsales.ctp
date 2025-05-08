<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h3 class="modal-title">LISTA DE SERIES <div class="label" style="font-size: 17px;"><i class="fa fa-sort-numeric-asc"></i></div></h3>
    <h3 class="font-bold">Seleccione las series.</h3>
</div>
<div class="modal-body" >
        
            
            <div id="update_reserva">  
                
                <div class="mail-box">

                    <table class="table table-hover table-mail" >
                        <thead>
                            <tr>
                                <th></th>
                                <th>TIPO</th>
                                <th>OFICINA</th>
                                <th>EN USO POR</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        //echo '<pre>';
                        //debug($dotsales->toArray());
                        //echo '</pre>';
                            foreach ($dotsales as $value) {
                                $numerationId=$value->numeration->id;
                                if ($access==1) { //si es pasajes
                                    if($value->numeration->passages=='1' or $value->numeration->document=='16' or $value->numeration->document=='12'){
                                            //en el caso de que entre a passajes 
                                            //debug($value);
                                            echo "<tr class='unread'>";
                                                echo "<td class='check-mail' id='tdNumeration$numerationId'>";
                                                    if($UserIdAccessNumerationId[$numerationId]==$value->user->id){
                                                        $value_check=0;
                                                        echo "<input type='radio' class='i-checks' id='ckeckNumerationsId$numerationId' checked>";
                                                        //echo $this->Javascript->codeBlock($this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'dotsale_activate'),'update' => "tdNumeration$numerationId",'datos'=>['dotsale_id'=>$value->id,'numeration_id'=>$numerationId,'value_check'=>1],'complete'=>'$("#boton").removeAttr("disabled")','before'=>'$("#boton").attr("disabled", true)')));
                                                    }else{
                                                        
                                                        echo "<input type='radio' class='i-checks' id='ckeckNumerationsId$numerationId'>";
                                                        $value_check=1;

                                                    }

                                                    echo $this->Ajax->observeField("ckeckNumerationsId$numerationId",['url' =>['controller' => 'sales','action' => 'dotsale_activate'],'with'=>null,'update' => "tdNumeration$numerationId",'datos'=>['dotsale_id'=>$value->id,'numeration_id'=>$numerationId,'value_check'=>$value_check],'before' => '$("#boton").attr("disabled", true)','complete' =>'$("#boton").removeAttr("disabled")']); 
                                                    
                                                echo "</td>";
                                                echo "<td class='mail-ontact'>";
                                                    if ($value->numeration->document==16) { //boletas de viaje
                                                        echo $this->Html->tag('div',$this->Html->tag('i','',['class'=>'fa fa-bus']).' BOL VIAJE '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }elseif ($value->numeration->document==03) { //boletas de venta
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' BOL VENTA '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }elseif ($value->numeration->document==01) { //facturas
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' FACTURA '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }elseif ($value->numeration->document==12) { //facturas
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' TICKET VIAJE '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }else{ //otros
                                                        echo $this->Html->tag('span','Otros',['class' => 'label label-success']);
                                                    }
                                                //echo $value->numeration->name;
                                                echo "</td>";
                                                echo "<td class='mail-subject'>".$value->numeration->name."</td>";
                                                echo "<td id='tdusopor$numerationId'>";
                                                    //debug($NameAccessNumerationId);
                                                    if($CountAccessNumerationId[$numerationId]>0){
                                                        foreach ($NameAccessNumerationId[$value->numeration->id] as $valueInUse) {
                                                             echo ' <span class="label label-warning">'.$valueInUse->user->username.'</span>';
                                                        }
                                                        /*if($value->user->id!=$UserIdAccessNumerationId[$numerationId]){
                                                            echo ' '.$this->Ajax->link('<i class="fa fa-check-square-o"></i>',['controller' => 'sales', 'action' => 'dotsale_activate'],['datos'=>['dotsale_id'=>$UserIdAccessData[$numerationId]['id'],'numeration_id'=>$numerationId,'value_check'=>0],'update' => "tdusopor$numerationId", 'indicator' => 'cargando','class'=>'btn btn-xs btn-danger','escape'=>false,'confirm'=>'Estas seguro que desea usar la serie?']);
                                                        }*/
                                                    }
                                                echo "</td>";
                                            echo "</tr>";
                                    }        
                                }
                                if($access==2){ //si es encomiendas
                                    if(($value->numeration->document==03 or $value->numeration->document==01 or $value->numeration->document==12) and $value->numeration->passages=='0' and $value->numeration->excesos=='0'){      
                                            //debug($value);
                                            //debug($UserIdAccessNumerationId[$numerationId]);
                                            echo "<tr class='unread'>";
                                                echo "<td class='check-mail' id='tdNumeration$numerationId'>";
                                                    if($UserIdAccessNumerationId[$numerationId]==$value->user->id){
                                                        $value_check=0;
                                                        echo "<input type='radio' class='i-checks' id='ckeckNumerationsId$numerationId' checked>";
                                                        //echo $this->Javascript->codeBlock($this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'dotsale_activate'),'update' => "tdNumeration$numerationId",'datos'=>['dotsale_id'=>$value->id,'numeration_id'=>$numerationId,'value_check'=>1],'complete'=>'$("#boton").removeAttr("disabled")','before'=>'$("#boton").attr("disabled", true)')));
                                                    }else{
                                                        echo "<input type='radio' class='i-checks' id='ckeckNumerationsId$numerationId'>";
                                                        $value_check=1;

                                                    }

                                                    echo $this->Ajax->observeField("ckeckNumerationsId$numerationId",['url' =>['controller' => 'sales','action' => 'dotsale_activate'],'with'=>null,'update' => "tdNumeration$numerationId",'datos'=>['dotsale_id'=>$value->id,'numeration_id'=>$numerationId,'value_check'=>$value_check],'before' => '$("#boton").attr("disabled", true)','complete' =>'$("#boton").removeAttr("disabled")']); 
                                                    
                                                echo "</td>";
                                                echo "<td class='mail-ontact'>";
                                                    if ($value->numeration->document==16) { //boletas de viaje
                                                        echo $this->Html->tag('div',$this->Html->tag('i','',['class'=>'fa fa-bus']).' BOL VIAJE '.$value->numeration->serie,['class' => 'label','style'=>'font-size:1px;']);
                                                    }elseif ($value->numeration->document==03) { //boletas de venta
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' BOL VENTA '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }elseif ($value->numeration->document==01) { //facturas
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' FACTURA '.$value->numeration->serie,['class' => 'label','style'=>'font-size:18px;']);
                                                    }else{ //otros
                                                        echo $this->Html->tag('span',$this->Html->tag('i','',['class'=>'fa fa-truck']).' GUIA '.$value->numeration->serie,['class' => 'label label-success','style'=>'font-size:18px;']);
                                                    }
                                                //echo $value->numeration->name;
                                                echo "</td>";
                                                echo "<td class='mail-subject'>".$value->numeration->name."</td>";
                                                echo "<td id='tdusopor$numerationId'>";
                                                    if($CountAccessNumerationId[$numerationId]>0){
                                                        //debug($NameAccessNumerationId[$value->numeration->id]);
                                                        foreach ($NameAccessNumerationId[$value->numeration->id] as $valueInUse) {
                                                             echo ' <span class="label label-warning">'.$valueInUse->user->username.'</span>';
                                                        }
                                                       
                                                        /*if($value->user->id!=$UserIdAccessNumerationId[$numerationId]){
                                                            echo ' '.$this->Ajax->link('<i class="fa fa-check-square-o"></i>',['controller' => 'sales', 'action' => 'dotsale_activate'],['datos'=>['dotsale_id'=>$UserIdAccessData[$numerationId]['id'],'numeration_id'=>$numerationId,'value_check'=>0],'update' => "tdusopor$numerationId", 'indicator' => 'cargando','class'=>'btn btn-xs btn-danger','escape'=>false,'confirm'=>'Estas seguro que desea usar la serie?']);
                                                        }*/
                                                    }
                                                echo "</td>";
                                            echo "</tr>";
                                    }
                                }
                                
                            
                            }
                         ?>
                        
                       
                        </tbody>
                    </table>

                </div>
                
                <center><?
                if ($access==1) {
                    echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-bus')).' &nbsp; IR A VENTA PASAJE',['controller'=>'sales','action' => 'passages',null,'?' => ['a' => $CoderAgenceId, 'r' => $CoderRouteId, 'date' => date('Y-m-d')]], ['id'=>'boton','class'=>'btn btn-lg btn-primary','escape' => false]) ;
                 }elseif ($access==2) {
                    echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-bus')).' &nbsp; IR A ENCOMIENDAS',['controller'=>'sales','action' => 'commends'], ['id'=>'boton','class'=>'btn btn-lg btn-warning','escape' => false]) ;
                 }
                 ?>
                </center>
            </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
</div>

    <!-- iCheck -->
    <script>
        $(document).ready(function(){
            /*$('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            */
        });
    </script>