<div id="div_update_numeration"> 
    <style type="text/css">
        td {
            margin-top: 10px;
        }
    </style>
    <?php 
    if ($numeracion['numeration']['document']==16) {
        $tipo='BOLETA VIAJE';
    }elseif ($numeracion['numeration']['document']==01) {
        $tipo='FACTURA';
    }elseif ($numeracion['numeration']['document']==03) {
        $tipo='BOLETA VENTA';
    }
     ?>

    
    <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title"> <div class="label" style="font-size: 17px;"><?php echo $tipo.' - '.$numeracion['numeration']['name'] ?></div></h3>
        <small class="font-bold">Cambio de correlativo.</small>
    </div>
    <div class="modal-body" >
                <?php if($save==1){
                        echo '<div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Numeracion cambiada correctamente.
                                </div>';

                    } ?>
                    <script type="text/javascript">
                    //<![CDATA[
                    $.ajax({async:true, type:'post', complete:function(request, json) {$('#numeracion_activa').html(request.responseText); $(".btn").removeAttr("disabled")}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages-numeration-show', data:{dotsale_id_selected:<?php echo $numeracion['id'];?>}}) 
                    //]]>
                    </script>
                                         <td><font size="3"><b><u><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-home')).' &nbsp; Inicio',['controller'=>'sales','action' => 'index'], ['class'=>'btn btn-xs btn-success','escape' =>false]) ;?></u></b></font></td>
                                         <td><font size="3" style="margin-left: 10px;"><b><u><?php echo $Routes->Routes->name ?></u></b></font></td>
                    <?php echo $this->Ajax->form(array('type' => 'post',
    		            'options' => array(
    		                'update'=>'div_update_numeration',
    		                'url' => array(
    		                    'controller' => 'sales',
    		                    'action' => 'passages_numeration_edit'
    		                ),
    		                'horizontal' => true,
    				        'cols' => [ 
    		                    'label' => 3,
    		                    'input' => 4,
    		                    'error' => 0
    		                ],
    		                'indicator' => 'cargando'
    		                    
    		            )
    		        ));
    		        ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">CORRELATIVO </label>
                        <div class="col-sm-9">
                            <div class="col-md-5 input-group"><? echo $this->Form->text('Numerations.number',['class'=>'input-sm','value'=>$numeracion['numeration']['number'],'onkeypress'=>"return numeros(event)"]);?></div>
                        </div>
                    </div>
                    
                    
                    <?php
                    echo $this->Form->hidden('dotsale_id', ['value'=>$numeracion['id']]);
                    echo $this->Form->hidden('numeration_id', ['value'=>$numeracion['numeration']['id']]);
                    echo $this->Form->submit('Cambiar');
                    echo $this->Form->end() ;
                ?>
               
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
    </div>
 </div>

 <script type="text/javascript">
    function numeros(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "0123456789";
        especiales = [8,37,39,46];
     
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            } 
        }
     
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
            return false;
    }
 </script>