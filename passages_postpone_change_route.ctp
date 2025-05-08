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
                    
                echo '<option value="'.$value->id.'" data-hour="'.$nuevahora_send.'">'.$nuevahora.' -- '.$nuevafecha.' -- ('.$fecha_hora_mostrar.') </option>';
            }
            
        }   
        ?>
</select>
<script type='text/javascript'>
    //cargar los asientos del combo dinamicamente
    $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#bus_seat_id_postpone_div').html(request.responseText);$('#cargando').hide(); }, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_postpone_load_seats', data:{ programation_id:$('#programation_id_postpone').val() } });
</script>
<script type="text/javascript">
//<![CDATA[
$('#programation_id_postpone').bind('change', function(){ $("#boton").attr("disabled", true);$.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#bus_seat_id_postpone_div').html(request.responseText);$('#cargando').hide();$("#boton").removeAttr("disabled") }, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_postpone_load_seats', data:{ programation_id:$('#programation_id_postpone').val() } })

})
//]]>
</script>