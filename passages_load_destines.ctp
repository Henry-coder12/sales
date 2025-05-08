<script type="text/javascript">
    var jsonData = <?=$destinos?>;
    //console.log(jsonData);
    var $select = $("<?=$formId?> select[name=ubigeo_id_destine]");

    $.each(jsonData , function (index, value){
        //console.log(index + ':' + value); 
        var $option = $("<option/>").attr("value", index).text(value);
        $select.append($option);

    });


// Outputs: 1 2 3 4 5

    //$(jsonData).each(function (index, o) { 
    	//console.log(o.0);   
        //var $option = $("<option/>").attr("value", o.Ubigeos.id).text(o.Ubigeos.cp);
        //$select.append($option);
    //});
    
    $("<?=$formId?> select[name=ubigeo_id_destine]").val('<?php echo $ultimo_ubigeo;?>');
    

    //papa los precio max y min FALTA
    //$("<?//=$formId?> input[name=document]").focus();
    $("<?=$formId?> div[name=priceref]").html('<div class="label"><?php echo $precios_ultimo_ubigeo->price_min."-".$precios_ultimo_ubigeo->price_max;?></div>');
     
        //$("<?//=$formId?> input[name=price]").val(<?php //echo $precios_ultimo_ubigeo->price_max;?>);
        /*
        $("<?//=$formId?> input[name=price]").val('');
        $("<?//=$formId?> input[name=price]").change(function() {
          var max = <?php //echo $precios_ultimo_ubigeo->price_max;?>;
          var min = <?php //echo $precios_ultimo_ubigeo->price_min;?>;
          if ($(this).val() > max){
              alert('El precio debe estar dentro del rango');
              return false;
          }else if ($(this).val() < min){
              alert('El precio debe estar dentro del rango');
              return false;
          }       
        }); 
        */

    //<![CDATA[
        $("<?=$formId?> select[name=ubigeo_id_destine]").bind('change', function(){$(".btn").addClass("disabled"); $.ajax({async:true, type:'post', complete:function(request, json) {$("<?=$formId?> div[name=priceref]").html(request.responseText); $(".btn").removeClass("disabled");}, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_change_destine_form', data:{'ubigeo_id_destine' : $("<?=$formId?> select[name=ubigeo_id_destine]").val(), 'form_id':'<?=$formId?>' , 'agence_id':'<?=$AgenceId?>' ,'route_id':'<?=$RouteId?>'  } }) })
    //]]>
</script>


