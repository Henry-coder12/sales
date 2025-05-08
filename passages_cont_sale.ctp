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
        $('#myModal').modal('hide');
    </script>
<?php }else{ 
    if ($user_id<>169) { ?>
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">Asiento Numero <div class="label" style="font-size: 17px;"><?php echo $bus_seat['name_seat'] ?></div></h3>
                    <small class="font-bold">VENTAS EN RUTA.</small>
                </div>
                <div class="modal-body" id="rutabody">
                    <div id="rutaform">
                        <div class="alert alert-danger">
                            Los documentos de contingencia desde ahora seran enviados a la SUNAT directamente. Por favor ingrese los datos correctos de la serie correcta.
                        </div>
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
                <?php 
                //debug($seat_id); ?>
                
                <?php $field=$this->Form->select('serie',$ListSeries,['class'=>'input-sm','id'=>'serie_obj_ruta','default'=>$FirstSeriesCont['serie']]); ?>
                <?php $firstNameSerie=$FirstSeriesCont['name']; ?>
                <?php $firstValueSerie=$FirstSeriesCont['number']; ?>
                <script>
                        var seat='<?php echo $bus_seat['name_seat'];?>';
                        var seat_id=<?php echo $seat_id;?>;
                        //var firtsSerieValue = '<?php echo $firstValueSerie; ?>';

                        var FieldSerieNum = '<div class="form-group"><label class="col-sm-2 control-label">SERIE Y CORRELATIVO</label><div class="col-sm-8"><div class="col-md-4">';
                        var fieldSelectSerie = '<?php echo $field; ?>';
                        FieldSerieNum= FieldSerieNum + fieldSelectSerie ;
                        FieldSerieNum= FieldSerieNum + '</div><div class="col-md-2"><input class="form-control input-sm" type="text" onchange="aMays(event, this);" style="text-transform: uppercase;" placeholder="CORRELATIVO" name="number" ></div><div id="label_cont_ruta" class="col-md-8 label badge-warning" style="font-size: 16px;margin-top:2px;">';
                        var firtsSerie = '<?php echo $firstNameSerie; ?>';
                        //FieldSerieNum= FieldSerieNum + firtsSerie + '</div></div></div>';
                        FieldSerieNum= FieldSerieNum + '</div></div></div>';
                        //$(cuadrito).appendTo($list);
                        $("#rutaform").append("<div id='rutaform"+seat_id+"'></div>");
                        $('#miform').clone().appendTo('#rutaform'+seat_id);
                        $('#rutaform'+seat_id).find('form').prepend(FieldSerieNum);
                        $('#rutaform'+seat_id).addClass('formularios');

                        //cambiamos los datos del formulario
                        $('#rutaform'+seat_id).find('#seat_edit').html('<i class=""></i> '+seat);
                        //cambiamos el valor de los input 
                        $('#rutaform'+seat_id+' input[id=bus_seat_id]').val(seat_id);

                        //evencto change para el buscador del cliente por NUM DOC                    
                        $('#rutaform'+seat_id+' input[name=document]').bind('change', function(){ $('#cargando').show(); $.ajax({async:true, type:'post', complete:function(request, json) {$('#buscar_client').html(request.responseText); $('#cargando').hide();}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_find_client', data:{type_cod_document:$('#rutaform'+seat_id+' select[name=type_cod_document]').val() , document:$('#rutaform'+seat_id+' input[name=document]').val() , form_id: '#rutaform'+seat_id } }) });
                        //--- fin --->

                        $('#rutaform'+seat_id+' input[name=number]').bind('change', function(){ $('#cargando').show(); $.ajax({async:true, type:'post', complete:function(request, json) {$('#buscar_client').html(request.responseText); $('#cargando').hide();}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_find_cont_sales', data:{ serie_document:$('#rutaform'+seat_id+' select[name=serie]').val() , number:$('#rutaform'+seat_id+' input[name=number]').val() , form_id: '#rutaform'+seat_id  } }) });


                        $('#rutaform'+seat_id+' select[name=serie]').bind('change', function(){ $('#rutaform'+seat_id+' input[name=number]').val('') });

                        //evencto change para el buscador de                     
                        $('#rutaform'+seat_id+' input[name=ruc]').bind('change', function(){ $('#cargando').show(); $.ajax({async:true, type:'post', complete:function(request, json) {$('#buscar_client').html(request.responseText); $('#cargando').hide();}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_find_client_ruc', data:{ruc:$('#rutaform'+seat_id+' input[name=ruc]').val() , form_id: '#rutaform'+seat_id} }) });
                        //--- fin --->

                        //cargamos los destinos del combo dinamicamente
                        var CoderRoute=<?php echo $CoderRouteId;?>;
                        var CoderAgence=<?php echo $CoderAgenceId;?>;

                        $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#buscar_client').html(request.responseText);$('#cargando').hide(); }, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_consult_seat?r='+CoderRoute+'&a='+CoderAgence, data:{ programation_id: <?php echo $programation_id; ?>, bus_seat_id: seat_id , is_ruta: 1, load_bus: 0} });
                        

                        //evencto click en IMPRIMIR
                        $('#rutaform'+seat_id+' button[id=btn_printer]').html('GUARDAR');
                        $('#rutaform'+seat_id+' button[id=btn_printer]').on("click", function () {
                            if(validar_ruta(seat_id)==true){
                                $('#rutaform'+seat_id).find('form').attr('action', "<?php echo $this->Url->build('/');?>"+"sales/passages_ruta_save_cont").submit();    
                                $('#rutaform'+seat_id+' button[id=btn_printer]').attr('disabled','disabled');
                                $('#rutaform'+seat_id+' button[id=btn_pre_sales]').attr('disabled','disabled');
                                $('#idhidden').focus();          
                            }else{
                                return false;
                            }
                        });

                        //escondemos campos no necesarios
                        $('#rutaform'+seat_id+' button[id=btn_pre_sales]').hide();
                        $('#rutaform'+seat_id).find('#div_agence_id_external').hide();
                        $('#rutaform'+seat_id).find('#div_type_payment').hide();
                   
                        $('#rutaform'+seat_id+' input[name=number]').focus();

                       function validar_ruta($item_form){
                            $('#rutaform'+$item_form+' input[name=dotsale_id]').val($('#dotsale_id_selected').val());
                            $('input').removeClass('error');
                            if($('#rutaform'+$item_form+' input[name=number]').val()==''){
                                alert ('Ingrese el correlativo del boleto \n EJM: 123');            
                                $('#rutaform'+$item_form+' input[name=number]').focus();
                                $('#rutaform'+$item_form+' input[name=number]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=document]').val()=='' || $('#rutaform'+$item_form+' input[name=document]').val().length <=7){
                                alert ('El campo Numero de Documento esta vacio \n minimo 8 digitos');            
                                $('#rutaform'+$item_form+' input[name=document]').focus();
                                $('#rutaform'+$item_form+' input[name=document]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=names]').val()==''){
                                alert ('Ingrese el nombre del pasajero.');            
                                $('#rutaform'+$item_form+' input[name=names]').focus();
                                $('#rutaform'+$item_form+' input[name=names]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=surnames]').val()==''){
                                alert ('Ingrese el apellido del pasajero.');            
                                $('#rutaform'+$item_form+' input[name=surnames]').focus();
                                $('#rutaform'+$item_form+' input[name=surnames]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=age]').val()==''){
                                alert ('Ingrese la edad del pasajero.');            
                                $('#rutaform'+$item_form+' input[name=age]').focus();
                                $('#rutaform'+$item_form+' input[name=age]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' select[name=gender]').val()==null){
                                alert ('Seleccione el GENERO del pasajero.');            
                                $('#rutaform'+$item_form+' select[name=gender]').focus();
                                $('#rutaform'+$item_form+' select[name=gender]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=names]').val()==''){
                                alert ('Ingrese el nombre del pasajero.');            
                                $('#rutaform'+$item_form+' input[name=names]').focus();
                                $('#rutaform'+$item_form+' input[name=names]').addClass('error');
                                return false;
                            }else if($('#rutaform'+$item_form+' input[name=price]').val()==''){
                                alert ('Ingrese el Precio.');            
                                $('#rutaform'+$item_form+' input[name=price]').focus();
                                $('#rutaform'+$item_form+' input[name=price]').addClass('error');
                                return false;
                            }else{
                                //desactivar($item_form);

                                $('#miform'+$item_form).remove();
                                $('#seat_select_'+$item_form).remove();
                                
                                //console.log($item_form);
                                setTimeout("update_bus();actualiza_numeracion();", 3000);

                                $('#rutaform'+$item_form).hide();

                                return true;

                            }
                            return false;
                        }
                </script>
   <?php 
    }else{ ?>
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">Asiento Numero <div class="label" style="font-size: 17px;"><?php echo $bus_seat['name_seat'] ?></div></h3>
                    <small class="font-bold">VENTAS EN RUTA.</small>
                </div>
                <div class="modal-body" id="rutabody">
                    <div>
                        <div class="alert alert-danger">NO TIENE AUTORIZACION PARA INGRESAR MANUALES. ... </div>
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
    <?}

} ?>
