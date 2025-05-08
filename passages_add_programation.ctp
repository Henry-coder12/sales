
<?php echo $this->Modal->header('NUEVA PROGRAMACION', ['close' => true]); ?>
<script type="text/javascript">
    function pad (str, max) {
      str = str.toString();
      return str.length < max ? pad("0" + str, max) : str;
    }
    function FCalculo_termino(dias_mas=0,horas_mas=0){       
        var fecha_inicio = $('#fechainicio').val();
        //console.log('Fecha_ini', fecha_inicio);
        var dias = dias_mas;

        //var horas = horas_mas;
        //console.log('Días', dias);
        //console.log('Horas', horas);


        //sumamos las horas
        //f=$('#horainicio').val();
        //campos=new Array($('#horainicio'),horas_mas);
        //horatotale=new Array(0,0,0);
        //for(b=0;b<campos.length;b++){
        var horas=$('#horainicio').val()+':00'; 
        horas_array=horas.split(":");
        //alert(horas_array[0]);
        var hora_sumada=parseInt(horas_array[0])+horas_mas;
        
        if (hora_sumada>=24) {
            dias=dias+1; //le sumamos un dia
            hora_sumada=hora_sumada-24;
        }
        //alert(dias_mas);
        //console.log('hora sumada', horatotale);
        
        
        $('#horafin').val(pad(hora_sumada,2)+":"+pad(horas_array[1],2));

        
        // Fecha
        // Dias en formato entero
        var diasNum = parseInt(dias);
        $('#dateend').val(editar_fecha(fecha_inicio,"+"+diasNum,"d"));

    }

    function editar_fecha(fecha, intervalo, dma, separador) {
 
      var separador = separador || "-";
      var arrayFecha = fecha.split(separador);
      var dia = arrayFecha[2];
      var mes = arrayFecha[1];
      var anio = arrayFecha[0]; 
      
      var fechaInicial = new Date(anio, mes - 1, dia);
      var fechaFinal = fechaInicial;
      if(dma=="m" || dma=="M"){
        fechaFinal.setMonth(fechaInicial.getMonth()+parseInt(intervalo));
      }else if(dma=="y" || dma=="Y"){
        fechaFinal.setFullYear(fechaInicial.getFullYear()+parseInt(intervalo));
      }else if(dma=="d" || dma=="D"){
        fechaFinal.setDate(fechaInicial.getDate()+parseInt(intervalo));
      }else{
        return fecha;
      }
      dia = fechaFinal.getDate();
      mes = fechaFinal.getMonth() + 1;
      anio = fechaFinal.getFullYear();
     
      dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
      mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
     
      return anio + "-" + mes + "-" + dia;
    }
    
</script>

<div class="modal-body">
    <h2>
        PROGRAMACION DE BUSES
    </h2>
    <p>
        Tenga cuidado al seleccionar la informacion.
    </p>

    <?php echo $this->Form->create($programation, ['id'=>'form','class'=>'wizard-big']); ?>
   	<div class="row">
        <div class="col-md-12">
            <?php 
            echo $this->Form->hidden('r', ['label'=>'r','value' => $r]);
            echo $this->Form->hidden('a', ['label'=>'a','value' => $a]);

            echo $this->Form->input('route_id', ['label'=>'ruta','options' => $routes]);
            echo $this->Ajax->observeField('route-id', array('url' => array('controller'=>'programations','action'=>'update_agenceidstart' ),'complete' => "actualiza_agencia_id_end();",'update' => 'agence-id-start')); 
             echo $this->Form->input('agence_id_start', ['label'=>'Term Salida','options' => $data_origen]);
                    echo $this->Form->input('agence_id_end', ['label'=>'Term Llegada','options' => $data_destino]);
                     ?>
                     <script type="text/javascript">
                        function actualiza_agencia_id_end(){
                            $.ajax({async:true, type:'post', beforeSend:function(request) {$(".btn-success").addClass("disabled");}, complete:function(request, json) {$('#agence-id-end').html(request.responseText);FCalculo_termino(sumadiasprogramation,sumahoraprogramation);$(".btn-success").removeClass("disabled");}, url:"<?php echo $this->Url->build('/');?>"+'programations/update_agenceidend', data:$('#route-id').serialize()});
                        }
                    </script>
             
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group text">
                <label class="control-label" for="fechainicio">Fecha Salida</label>
                <input id="fechainicio" class="form-control required" name="date" value="<?php echo date('Y-m-d'); ?>" type="text">
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group clockpicker" data-autoclose="true">
                <label class="control-label">Hora Salida</label>
                <div class="input-group">
                    <input type="text" id="horainicio" class="form-control" name='hour' data-mask='99:99' value="<?php echo date('H:i'); ?>" class="required">
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group text">
                <label class="control-label">Fecha Llegada</label>
                <input class="form-control required" id='dateend' name="date_end" value="<?php echo date('Y-m-d'); ?>" type="text"  readonly>
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <label class="control-label">Hora Llegada</label>
                <div class="input-group">
                    <input type="text" id="horafin" class="form-control" name='hour_end' data-mask='99:99' value="<?php echo date('H:i'); ?>" class="required"  readonly>
                    <span class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <label class="control-label">PRECIO ASIENTO NORMAL ( REDBUS )</label>
                <div class="input-group">
                    <input type="text" id="price_seat_normal" class="form-control" name='price_seat_normal' onkeydown="valNumeric(event)"  value="40" class="required">
                    <span class="input-group-addon">
                        <span class="fa fa-suitcase"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <label class="control-label">PRECIO ASIENTO CAMA ( REDBUS )</label>
                <div class="input-group">
                    <input type="text" id="price_seat_cama" class="form-control" name='price_seat_cama' onkeydown="valNumeric(event)"  value="60" class="required">
                    <span class="input-group-addon">
                        <span class="fa fa-suitcase"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">  
            <?php 
            echo $this->Form->input('buse_id', ['label'=>'Seleccione el BUS', 'class' => 'search-select']); 
            ?>
        </div>
    </div>
    <?php echo $this->Form->submit('GENERAR PROGRAMACION', ['class'=>'btn  btn-block btn-success']);  ?>
        
    <?php echo $this->Form->end(); ?>





</div>

<script type="text/javascript">
    var sumadiasprogramation=<?php echo $dataRoute->days_trip;?>;
            var sumahoraprogramation=<?php echo $dataRoute->hours_trip;?>;
        $(function(){    
            

            FCalculo_termino(sumadiasprogramation,sumahoraprogramation);
            $('#horainicio').bind('change', function(){
                FCalculo_termino(sumadiasprogramation,sumahoraprogramation);
            });
        });

</script>

<?php
    echo $this->Modal->footer([
        $this->Form->button('CERRAR', ['data-dismiss' => 'modal','class'=>'btn-sm']) 
    ]) ;
    echo $this->Form->end() ;
?>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    $(".search-select").chosen({});     //select2
</script>
<script>
    $(function () {
            $('#fechainicio').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD'
            }).on("dp.change", function (e) {  
                FCalculo_termino(sumadiasprogramation,sumahoraprogramation);
            });
            
            $('.clockpicker').clockpicker();

        });
</script>