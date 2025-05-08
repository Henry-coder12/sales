<?php
//debug($cambiobus);
    if ($cambiobus==true) { ?>
        <script type="text/javascript">
            location.reload();
        </script>
    <?php }
?>
<?php if ($programationData->status==0) { //programation_Bloqueado ?>
    <script type="text/javascript">
        $('#load_bus').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#selected_seat').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
        $('#actions_users').html('<div class="alert alert-danger">PROGRAMACION BLOQUEADA.</div>');
    </script>
<?php }else{ //si no esta bloqueado el bus
            if($bloqueado==1){ // si encontramos el asiento bloqueado por otro usuario
                ?>
                <script>
                    $(document).ready(function() {
                        removeseat_no_data(seat_select_<?=$bus_seat['id'];?>,<?=$bus_seat['id'];?>);
                        alert('asiento bloqueado por otro usuario');
                        window.setTimeout(update_bus(),1000);
                    });
                </script>
                <?php
            }else{
                if ($access==false) {
                    ?>
                    <script>
                        $(document).ready(function() {
                            removeseat(seat_select_<?=$bus_seat['id'];?>,<?=$bus_seat['id'];?>);
                            alert('Asiento ocupado');
                            window.setTimeout(update_bus(),1000);
                        });
                    </script>
                    <?php
                }else{
                    ?>
                    <script type='text/javascript'>
                        //cargar los destinos del combo dinamicamente ya sea para boleto de ruta o boleto normal
                        var is_ruta=<?=$is_ruta;?>;
                        if (is_ruta==0){
                            var formid='#miform'+<?=$seat_id;?>;
                        }else{
                            var formid='#rutaform'+<?=$seat_id;?>;
                        }

                        var CoderRoute=<?php echo $CoderRoute;?>;
                        var CoderAgence=<?php echo $CoderAgence;?>;

                        var loadBus = <?php echo $loadbus;?>;
                        if (loadBus==1) {
                            $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {update_bus();$('#buscar_client').html(request.responseText);$('#cargando').hide(); }, url:"<?=$this->Url->build('/');?>"+'sales/passages_load_destines?r='+CoderRoute+'&a='+CoderAgence , data:{ programation_id: <?=$programation_id;?>, bus_seat_id: <?=$seat_id;?>, form_id: formid } });   
                        }else{
                            $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#buscar_client').html(request.responseText);$('#cargando').hide(); }, url:"<?=$this->Url->build('/');?>"+'sales/passages_load_destines?r='+CoderRoute+'&a='+CoderAgence , data:{ programation_id: <?=$programation_id;?>, bus_seat_id: <?=$seat_id;?>, form_id: formid } });
                        }
                        
                    </script>
                    <?php
                }
            }
} ?>


