<script type="text/javascript">
   
    $("<?=$formId?> div[name=priceref]").html('<div class="label"><?php echo $precios_ultimo_ubigeo->price_min."-".$precios_ultimo_ubigeo->price_max;?></div>');
    /*
     $(function () {
        $("<?//=$formId?> input[name=price]").off("change"); // eliminamos el anterior enevento CHANGE 
        $("<?//=$formId?> input[name=price]").val('');
        //$("<?//=$formId?> input[name=price]").val(<?php //echo $precios_ultimo_ubigeo->price_max;?>);
        $("<?//=$formId?> input[name=price]").on('change',function() {
          var max = <?php //echo $precios_ultimo_ubigeo->price_max;?>;
          var min = <?php //echo $precios_ultimo_ubigeo->price_min;?>;

          //console.debug(max);
          //console.debug(min);
          //console.debug($(this).val());
          if ($(this).val() > max){
              alert('El precio debe estar dentro del rango');
              return false;
          }else if ($(this).val() < min){
              alert('El precio debe estar dentro del rango');
              return false;

          }       
        }); 
        
    });
    */
</script>