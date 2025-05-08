<div class="row">
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>POSTERGAR A PROGRAMACION <small>Simple postergacion a una programacion hecha</small></h5>
            </div>
            <div class="ibox-content">
                <div id="post12"></div>
                <div class="row" id="post13">
                    <form id="form_postpone" method="post" accept-charset="utf-8" onsubmit="return false;" update="post12" indicator="loading" role="form" action="#">
                    <div class="col-sm-5 b-r">
                            <div class="form-group select">
                                <label class="control-label"><div class=' btn-xs label-danger'>ADVERTENCIA</div></label><br>
                                <div class="label label-warning">Cambiaran los datos en sistema mas no el documento XML</div>
                            </div>
                            
                            <?php //echo $this->Form->input('agence_id',['label'=>'AGENCIA EMBARQUE','value'=>$sale['agence_id_embarkation'],'options'=>$agences]);?>
                            <div class="form-group select">
                                <label class="control-label" for="agence-id">AGENCIA EMBARQUE</label>
                                <div><?php echo $agence['name'] ?></div>
                            </div>
                            <?php echo $this->Form->hidden('route_id_postpone',['id'=>'route_id_postpone','label'=>'RUTA','value'=>$sale['programation']['route_id'],'options'=>$rutas]);?>
                            <div class="form-group select">
                                <label class="control-label" for="agence-id">RUTA</label>
                                <div><?php echo $sale['programation']['route']['name']; ?></div>
                            </div>

                            <script type="text/javascript">
                            //<![CDATA[
                            $('#route_id_postpone').bind('change', function(){ $("#boton").attr("disabled", true); $.ajax({async:true, type:'post', complete:function(request, json) {$('#programation_id_postpone_div').html(request.responseText); $("#boton").removeAttr("disabled")}, url:"<?=$this->Url->build('/');?>"+'sales/passages_postpone_change_route', data:{ route_id:$('#route_id_postpone').val(),fecha:$('#date_travel_postpone').val(),agence_id_embarkation:<?php echo $agence->id; ?>} }) })
                            //]]>
                            </script>

                            <?php //echo $this->Ajax->observeField("route_id_postpone",['url' =>['controller' => 'sales','action' => 'passages_postpone_change_route'],'with'=>null,'update' => "programation_id_postpone",'before' => '$("#boton").attr("disabled", true)','complete' =>'$("#boton").removeAttr("disabled")']); ?>
                            
                            
                            
                            
                      
                    </div>
                    <div class="col-sm-7">
                            <?php echo $this->Form->input('date_travel_postpone',['id'=>"date_travel_postpone",'label'=>'FECHA VIAJE','value'=>$nuevafecha]);?> 

                            <?php //echo $this->Form->input('hour_travel',['id'=>"hora_viaje",'value'=>$nuevahora_send]);?> 
                             
                            <div class="form-group select" id='programation_id_postpone_div'>
                                <label class="control-label" for="programation_id_postpone">PROGRAMACION</label>
                                <select name="programation_id_postpone" class="form-control" id="programation_id_postpone">
                                    <?php 
                                    $suma_dia=$sumaHora['sum_day'];
                                    $suma_hora=$sumaHora['sum_hour'];
                                    $suma_min=$sumaHora['sum_min'];

                                    foreach ($programaciones as $value) {
                                        $fecha_hora=$value->date->format("Y-m-d").' '.$value->hour->format("H:i:s");
                                        $fecha_hora_mostrar=$value->hour->format("g:i a").' '.$value->date->format("Y-m-d");
                                        $nuevahorafecha=strtotime($fecha_hora);
                                        if($suma_dia>0){$nuevahorafecha = strtotime("+$suma_dia day",$nuevahorafecha);}
                                        if($suma_hora>0){$nuevahorafecha = strtotime("+$suma_hora hour",$nuevahorafecha);}
                                        if($suma_min>0){$nuevahorafecha = strtotime("+$suma_min minute",$nuevahorafecha);}
                                        $nuevahora = date('g:i a', $nuevahorafecha );
                                        $nuevahora_send = date('H:i:s', $nuevahorafecha );
                                        $nuevafecha = date('Y-m-d',$nuevahorafecha);


                                        //print_r($value->bus->plate);
                                        if($nuevafecha==$fecha_seleccionada){
                                            
                                                            //echo $this->Ajax->form(['type' => 'post','options' =>['update'=>'container_route','url' => array('controller' => 'sales','action' => 'passages_sales'),'indicator' => 'cargando','complete'=>"$('#right-sidebar').removeClass('sidebar-open');"]]);
                                                            //echo $this->Form->hidden('bus_id',['value'=>$value->bus->id]); 
                                                            //echo $this->Form->hidden('programation_id',['value'=>$value->id]);
                                                            //echo $this->Form->hidden('date_travel',['value'=>$nuevafecha]);
                                                            //echo $this->Form->hidden('hour_travel',['value'=>$nuevahora_send]); 
                                                if ($nuevahora_send==$hora_in_sales) {
                                                    echo '<option value="'.$value->id.'"  data-hour="'.$nuevahora_send.'" selected="selected">'.$nuevahora.' -- '.$nuevafecha.' -- ('.$fecha_hora_mostrar.') </option>';
                                                }else {
                                                    echo '<option value="'.$value->id.'" data-hour="'.$nuevahora_send.'">'.$nuevahora.' -- '.$nuevafecha.' -- ('.$fecha_hora_mostrar.') </option>';
                                                }
                                                            
                                                            //echo $this->Form->end();
                                                            
                                                                               
                                        }
                                        
                                    }
                                     ?>
                                </select>
                            </div>
                            <script type="text/javascript">
                            //<![CDATA[
                            $('#programation_id_postpone').bind('change', function(){ $("#boton").attr("disabled", true);$.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#bus_seat_id_postpone_div').html(request.responseText);$('#cargando').hide();$("#boton").removeAttr("disabled") }, url:"<?=$this->Url->build('/');?>"+'sales/passages_postpone_load_seats', data:{ programation_id:$('#programation_id_postpone').val() } })

                            })
                            //]]>
                            </script>
                            <div class="form-group select" id="bus_seat_id_postpone_div">
                                <label class="control-label" for="bus_seat_id_postpone">ASIENTO BLOQUEADO</label>
                                <select name="bus_seat_id_postpone" class="form-control" id="bus_seat_id_postpone">
                                    <?php 
                                    foreach ($lista_seats as $value) {
                                        echo '<option value="'.$value->bus_seat->id.'"  data-sale-id="'.$value->id.'">'.$value->bus_seat->name_seat.' </option>';
                                    }
                                     ?>
                                </select>
                            </div>
                            

                            <?php echo $this->Form->submit('POSTERGAR ASIENTO',['id'=>'btn_postpone1']); ?>
                            
                    </div>
                    <?php echo $this->Form->end()?>

                    <script type="text/javascript">
                    //<![CDATA[
                    function isValidDate(dateString){
                        // revisar el patrón
                        if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
                            return false;

                        // convertir los numeros a enteros
                        var parts = dateString.split("-");
                        var day = parseInt(parts[2], 10);
                        var month = parseInt(parts[1], 10);
                        var year = parseInt(parts[0], 10);

                        // Revisar los rangos de año y mes
                        if( (year < 1000) || (year > 3000) || (month == 0) || (month > 12) )
                            return false;

                        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

                        // Ajustar para los años bisiestos
                        if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
                            monthLength[1] = 29;

                        // Revisar el rango del dia
                        return day > 0 && day <= monthLength[month - 1];
                    };

                    $('#form_postpone').bind('submit', function(){ 
                        if (confirm('Postergar asiento?')) { 
                            if($('#bus_seat_id_postpone').val()!=null && isValidDate($('#date_travel_postpone').val()) && $('#programation_id_postpone').val()!=null ){
                                $("#post12").html("Expere un momento"); 
                                $.ajax({
                                    async:true, 
                                    type:'post', 
                                    beforeSend:function(request) {$('#loading').show();}, 
                                    complete:function(request, json) {
                                        $('#post12').html(request.responseText);
                                        $('#post13').hide(); //escondemos el formulario 1
                                        $('#post15').hide(); //escondemos el formulario 2
                                        $('#loading').hide();
                                        var busIdSeat=$('#bus_seat_id_postpone').val();
                                        update_bus(); //actualiza el bus
                                        $('#seat_select_'+busIdSeat).remove(); //elimina el asiento de la lista seleccionada
                                        $('#miform'+busIdSeat).remove(); //elimina el asiento de la lista seleccionada
                                    }, 
                                    data:{
                                        route_id_postpone:$('#route_id_postpone').val(),
                                        date_travel_postpone:$('#date_travel_postpone').val(),
                                        hour_travel_postpone:$('#programation_id_postpone').find('option:selected').attr('data-hour'),
                                        programation_id_postpone:$('#programation_id_postpone').val(),
                                        bus_seat_id_postpone:$('#bus_seat_id_postpone').val(),
                                        sale_id_postpone:$('#bus_seat_id_postpone').find('option:selected').attr('data-sale-id'),
                                        ubigeo_id_destine:$('#ubigeo_id_destine').val(),
                                        sale_id_anterior:<?php echo $sale_id_anterior; ?>,
                                    }, 
                                    url:"<?=$this->Url->build('/');?>"+'sales/passages_postpone_sale_save'
                                }); 
                                
                                //alert('true');
                            }else{
                                alert('Complete todo los campos');
                            }
                            
                        }else{
                            return false; 
                        } 
                    })
                    //]]>
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 hide">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>POSTERGAR FECHA LIBRE</h5>
            </div>
            <div class="ibox-content">
                <div class="row" id="post14"></div>
                <div class="row" id="post15">
                    <form id="form_postpone_free" method="post" accept-charset="utf-8" onsubmit="return false;" update="post12" indicator="loading" role="form" action="#">
                        <?php echo $this->Html->alert('Al postegar con fecha libre el pasajero tendra que retornar con el boleto fisico para que pueda viajar en el mismo ORIGEN y DESTINO pero en una fechas y hora diferente.') ; ?>
                        <div class="widget style1 lazur-bg"><center><h2 class="font-bold"><?php echo $sale['serie'].' - '.$sale['number']; ?></h2></center></div>
                        <center><?php echo $this->Form->submit('FECHA LIBRE',['id'=>'btn_postpone2','class'=>'btn-primary btn-rounded btn-lg']); ?></center>
                    </form>

                    <script type="text/javascript">
                        //<![CDATA[
                       
                        $('#form_postpone_free').bind('submit', function(){ 
                            if (confirm('Postergar asiento a fecha libre?')) { 
                               
                                    $("#post14").html("Expere un momento"); 
                                    $.ajax({
                                        async:true, 
                                        type:'post', 
                                        beforeSend:function(request) {$('#loading').show();}, 
                                        complete:function(request, json) {
                                            $('#post14').html(request.responseText);
                                            $('#post13').hide(); //escondemos el formulario 1
                                            $('#post15').hide(); //escondemos el formulario 2
                                            $('#loading').hide();                                            
                                            update_bus(); //actualiza el bus
                                        }, 
                                        data:{
                                            sale_id_anterior:<?php echo $sale_id_anterior; ?>,
                                        }, 
                                        url:"<?=$this->Url->build('/');?>"+'sales/passages_postpone_sale_free'
                                    }); 
                                    
                                 
                                
                            }else{
                                return false; 
                            } 
                        })
                        //]]>
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
            $('#date_travel_postpone').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD',
                minDate : "<?php echo date('Y-m-d');?>"
            }).on("dp.change", function (e) {   
                fecha=$('#date_travel_postpone').datetimepicker().data('date');     

                 $.ajax({async:true, type:'post', complete:function(request, json) {$('#programation_id_postpone_div').html(request.responseText); $("#boton").removeAttr("disabled")}, url:"<?=$this->Url->build('/');?>"+'sales/passages_postpone_change_route', data:{ route_id:$('#route_id_postpone').val(),fecha:fecha,agence_id_embarkation:<?php echo $agence->id; ?>} });
            });

        });
</script>