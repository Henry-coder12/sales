<li class="messages-search">
<?php echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_search','url' => array('controller' => 'sales','action' => 'commends_buscar'),'class'=>'form-inline','before'=>"$('.panel').block({ overlayCSS: { backgroundColor: '#fff'}, message: '<img src=\'../img/loading.gif\'> Buscando...', css: { border: 'none', color: '#333', background: 'none'} })",'after'=>"window.setTimeout(function () { $('.panel').unblock() }, 1000);")));?> 

    
     <form action="#" class="form-inline">
        <div class="input-group col-md-3">
            <input type="text" class="form-control" placeholder="Serie" name="data[serie]" style='text-transform: uppercase;'>
        </div>
        <div class="input-group col-md-5">
            <input type="text" class="form-control" placeholder="Correlativo" name="data[number]" onkeydown="valNumeric(event)">
        </div>
        <div class="input-group col-md-3">
            <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
            </button>
        </div>
        <br><br>
        <div class="input-group col-md-12">
            <input type="text" class="form-control" placeholder="Quien envia o recibe" name="data[buscar]" style='text-transform: uppercase;'>
        </div>
                                
                                    
    </form>
</li>
<?php foreach ($busqueda as $busq): 
    $idCommends=$busq['id'];
    if ($tipo_busqueda==0) {
        $recibeName=$busq['consig_surnames'].' '.$busq['consig_names'];
        if($busq['doc']=='01'){
            $enviaName=$busq['razon'];    
        }else{
            $enviaName=$busq['remit_surnames'].' '.$busq['remit_names'];
        }
    }else{
        $recibeName=$busq['consig_name'];
        if($busq['doc']=='01'){
            $enviaName=$busq['client']['razon'];    
        }else{
            $enviaName=$busq['client']['surnames'].' '.$busq['client']['names'];
        }
    }
    
    
    ?>
    <script type="text/javascript">
    //<![CDATA[
    $('#commenid<?php echo $idCommends;?>').bind('click', function(){ $('#view_commends').empty(); $('.panel').block({ overlayCSS: { backgroundColor: '#fff'}, message: '<img src=\'../img/loading.gif\'> Buscando...', css: { border: 'none', color: '#333', background: 'none'} }); $.ajax({async:true, type:'post', complete:function(request, json) {$('#view_commends').prepend(request.responseText); }, url:'commends_view_commend/<?php echo $idCommends;?>'}); window.setTimeout(function () { $('.panel').unblock() }, 1000); })

    //]]>
    </script>
    <li class="messages-item starred" id="commenid<?php echo $idCommends;?>">
        <span title="Mark as starred" class="messages-item-star"><i class="fa fa-cube"></i></i></span>
        <img alt="" src="../img/user.png" class="messages-item-avatar" style="height: 28px;width: 24px;">
        <span class="messages-item-from" style="text-transform: capitalize;font-size: 13px;margin-top: 0px;line-height:13px;margin-left: 28px;">
        <?php 
        if ($busq['prepaid']=='1') { 
            echo $busq['serie'].' - '.str_pad($busq['number'],7,'0',STR_PAD_LEFT);
        }else{
           
            echo str_pad($busq['id'],7,'0',STR_PAD_LEFT);
            
            
        }?></span>
        <span class="messages-item-from" style="text-transform: capitalize;font-size: 11px;;margin-top: 0px;line-height:13px;margin-left: 28px;"><?php echo $recibeName;?></span>
        
        <span class="messages-item-subject" style="margin-bottom: 0px;"><?php echo $busq['created'];?></span>
        <span class="messages-item-preview" style="font-size: 10px;">Envia: <?php echo strtolower($enviaName);?> </span>
    </li>
<?php endforeach; ?>

