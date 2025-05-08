<style type="text/css">
    td {
        margin-top: 10px;
    }
</style>

<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h3 class="modal-title">DOCUMENTO : <div class="label" style="font-size: 17px;"><?php if($dato['agence_id_prepaid']==null){echo str_pad($dato['id'],7,'0',STR_PAD_LEFT);}else{echo $dato['serie'].'-'.$dato['number'];} ?></div></h3>
    <small class="font-bold">Detalle de ventas.</small>
</div>
<div class="modal-body" >
    <?php //debug($dato);
    if ($dato['commend_id_prepaid']==0) {    ?>
            <div class='table table-hover'>
                
                <div class='fila'>
                    <div class='col' style='width: 100%;font-size: 13px;text-align:center;'>
                        <select id='dotsale_id_selected_prepaid' class='input-medium'>
                            <?php
                            $contar_electronicos=0;
                            foreach ($data_dotsale_01 as $series){
                                if($series['numeration']['electronic']==1){
                                    $contar_electronicos++;
                                    if($series['numeration']['document']=='03'){
                                        $var='BOL';
                                    }elseif ($series['numeration']['document']=='01') {
                                        $var='FAC';
                                    }
                                    echo "<option value='".$series['id']."' typeDoc='".$series['numeration']['document']."'>".$var.' - '.$series['numeration']['serie']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                
                    <div class='col' style='width: 100%;'>   
                            <div id="client_div_prepaid"></div>                     
                            <div class="row" style="margin-top:6px;">
                                <?php echo $this->Ajax->form(['type' => 'post','options' => ['update'=>'client_div_prepaid','url' => ['controller' => 'sales','action' => 'commends_find_client_prepaid'],'class'=>'form-horizontal','before'=>"$('#type_doc_remit_prepaid').val($('#dotsale_id_selected_prepaid').find('option:selected').attr('typeDoc'));$('#buscar_remit_prepaid').attr('disabled','disabled');$('#update_select').focus();",'complete'=>"$('#buscar_remit_prepaid').prop('disabled', false)"]]);?> 
                                <input type="hidden" class="form-control" id='type_doc_remit_prepaid' name="type_doc_remit_prepaid">
                                <label class="col-md-3" for="client-doc" style="margin-top: 5px;text-align: right;">RUC o DNI - </label>
                                <div class="col-md-5">
                                    <input id="clientdoc" class="form-control input-sm" type="text" placeholder="NUM. DOC." value="<?php echo $dato['client']['document'];?>" name="client_doc">
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-primary btn-xs" id='buscar_remit_prepaid'>
                                        Buscar
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="row" style="margin-top:6px;">
                                <label class="col-md-3" for="client-name" style="margin-top: 5px;text-align: right;">CLIENTE - </label>
                                <div class="col-md-4">
                                    <input id="clientnames" class="form-control input-sm" type="text" placeholder="NOMBRES" value="<?php echo $dato['client']['names'];?>" name="client_name" style="text-transform:uppercase;">
                                </div>
                                <div class="col-md-5">
                                    <input id="clientsurnames" class="form-control input-sm" type="text" placeholder="APELLIDOS" value="<?php echo $dato['client']['surnames'];?>" name="client_surname" style="text-transform:uppercase;">
                                </div>
                            </div>
                            <div class="row" style="margin-top:6px;margin-bottom: 10px;">
                                <label class="col-md-3" for="client-razon" style="margin-top: 5px;text-align: right;">RAZON - </label>
                                <div class="col-md-9">
                                    <input id="clientrazon" class="form-control input-sm" type="text" placeholder="RAZON SOCIAL" value="<?php echo $dato['client']['razon'];?>" name="client_razon" style="text-transform:uppercase;">
                                </div>
                            </div>
                            <div class="row" style="margin-top:6px;margin-bottom: 10px;">
                                <label class="col-md-3" for="client-direccion" style="margin-top: 5px;text-align: right;">DIRECCION - </label>
                                <div class="col-md-9">
                                    <input id="clientdireccion" class="form-control input-sm" placeholder="DIRECCION" type="text" value="<?php echo $dato['client']['address'];?>" name="client_direccion" style="text-transform:uppercase;">
                                    <input id="clientcumple" class="form-control input-sm" type="hidden" value="<?php echo $dato->client->birthdate->format('Y-m-d');?>" name="client_direccion">
                                </div>
                            </div>
                    </div>
                </div>
                
                <div class='fila'>
                    <div class='col' style='width: 100%;'><b>CONSIGNATARIO : </b></div>
                </div>
                <div class='fila'>
                    <div class='col' style='width: 100%;'>NOMBRE : <?php echo substr(strtoupper($dato['consig_name']), 0, 60); ?></div>
                 </div>
                <div class='fila'>
                    <div class='col' style='width: 100%;font-weight: bold;'> <u>ORIG:</u>: <?php echo substr($dato['origen'],0,10); ?></div>
                    <div class='col' style='width: 100%;font-weight: bold;'> <u>DEST:</u>: <?php echo substr($dato['destino'],0,10); ?></div>             
                </div>
                
        </div>
            


            <div class="message-content" id="list_commends" >
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
                                        echo '<td>-</td>';
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
            <?php 
            if ($contar_electronicos>0) {
                echo $this->Html->alert('El cobro de la encomienda pasara a su cuenta de usuario', 'danger'); ?>
                <?php echo $this->Form->create(null, ['horizontal' => true,'url' => array('controller' => 'sales', 'action' => 'commends_print_prepaid'),'target'=>'hidden_iframe','id'=>'form_commends2']);  
                echo $this->Form->hidden('commends_id',['value' => $dato['id']]);?>
                <center><button class="btn btn-app btn-primary btn-mini" id="printer_prepaid"><i class="icon-save"></i>IMPRIMIR y HACER EL COBRO</button></center>
                <?php
                    echo $this->Form->hidden('dotsale_id_selected',['id'=>'IdDotsale']);
                    echo $this->Form->hidden('Remit.id',['id'=>'RemitIdPrepaid','value'=>$dato['client']['id']]);
                    echo $this->Form->hidden('Remit.document',['id'=>'RemitDocumentPrepaid']);
                    echo $this->Form->hidden('Remit.name',['id'=>'RemitNamePrepaid']);
                    echo $this->Form->hidden('Remit.surname',['id'=>'RemitSurnamePrepaid']);
                    echo $this->Form->hidden('Remit.razon',['id'=>'RemitRazonPrepaid']);
                    echo $this->Form->hidden('Remit.address',['id'=>'RemitAddressPrepaid']);
                    echo $this->Form->hidden('Remit.birthdate',['id'=>'RemitBirthdatePrepaid']);
                  echo $this->Form->end(); 

                
                    ?>
            <?php
            }else{
                echo $this->Html->alert('No se puede hacer el cobro por que no tiene documentos electronicos', 'info');  
            }
    
}else{
    echo $this->Html->alert('La encomienda a sido pagada en destino', 'success');
}


    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
</div>

<script type="text/javascript">



$("#printer_prepaid").click(function (){
    var tipo=$('#dotsale_id_selected_prepaid').find('option:selected').attr('typeDoc');
    //enviamos el Dotcomend.id
    //
    
    //alert(tipo);
    if (tipo=='01') {
        if($("#clientdoc").val().length<11){    
            alert('Si es FACTURA especifique el RUC');
            $("#clientdoc").focus();
            return false;       
        }
        if($("#clientrazon").val().length<3){
            alert('Ingrese la Razon de la empresa');
            $("#clientrazon").focus();
            return false;
        }
        if($("#clientdireccion").val().length<5){
            alert('Ingrese la direccion de la empresa');
            $("#clientdireccion").focus();
            return false;
        }
    }else if (tipo=='03') {
        if($("#clientdoc").val().length<8){    
            alert('Si es BOLETO especifique el Num DNI');
            $("#clientdoc").focus();
            return false;       
        }
        if($("#clientnames").val().length<3){
            alert('Ingrese el nombre del cliente');
            $("#clientnames").focus();
            return false;
        }
        if($("#clientsurnames").val().length<3){
            alert('Ingrese los apellidos del cliente');
            $("#clientsurnames").focus();
            return false;
        }
    }
    //
    //return false;
    desactivar();

    //llenamos los campos
    var valor=$('#dotsale_id_selected_prepaid').val();
    $('#IdDotsale').val(valor);

    $('#RemitDocumentPrepaid').val($('#clientdoc').val());
    $('#RemitNamePrepaid').val($('#clientnames').val());
    $('#RemitSurnamePrepaid').val($('#clientsurnames').val());
    $('#RemitAddressPrepaid').val($('#clientdireccion').val());
    $('#RemitRazonPrepaid').val($('#clientrazon').val());
    $('#RemitBirthdatePrepaid').val($('#clientcumple').val());
   
   var result = confirm("Generar Documento?");
    if (result) {
        $("#printer_prepaid").hide();
        return true;
    }else{
        return false;
    }
   
    
}); 

</script>
<?php
echo $this->Html->script('bootstrap-tooltip');
?>