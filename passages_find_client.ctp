<?php 
//print_r($data);
if ($count or $nodata) {
    ?>
    <script type="text/javascript">        
        //$("<?=$formId?> input[name=names]").attr("readonly","readonly");
        //$("<?=$formId?> input[name=surnames]").attr("readonly","readonly");
    </script>
    <?php
}else{
    ?>
    <script type="text/javascript">        
        $("<?=$formId?> input[name=names]").removeAttr("readonly");
        $("<?=$formId?> input[name=surnames]").removeAttr("readonly");
    </script>
    <?php
}

if ($count) {
    $tip_doc=$data->cod_document.'-'.$data->type_document;

    //para la edad
    $fechaExplode=explode('-',$data->birthdate->format("Y-m-d"));
    $edad=date('Y')-$fechaExplode[0];
    $nacimiento=$data->birthdate->format("Y-m-d");

    ?>
    <script type="text/javascript">
        
        $("<?=$formId?> select[name=type_document]").val("<?=$tip_doc;?>");
        $("<?=$formId?> input[name=client_id]").val("<?=$data->id;?>");
        $("<?=$formId?> input[name=document]").val("<?=$data->document;?>");
        $("<?=$formId?> input[name=names]").val("<?=$data->names;?>");
        $("<?=$formId?> input[name=surnames]").val("<?=$data->surnames;?>");
        $("<?=$formId?> input[name=client_birthdate]").val("<?=$nacimiento;?>");
        $("<?=$formId?> input[name=age]").val("<?=$edad;?>");
        $("<?=$formId?> select[name=gender]").val("<?=$data->gender;?>");
        $("<?=$formId?> select[name=nationality]").val("<?=$data->nationality;?>");
        $("<?=$formId?> input[name=num_phone]").val("<?=$data->num_phone;?>");
        $("<?=$formId?> input[name=obs]").val("<?=$data->obs;?>");
        $("<?=$formId?> input[name=address]").val("<?=$data->address;?>");
        $("<?=$formId?> input[name=email]").val("<?=$data->email;?>");
        $("<?=$formId?> input[name=ruc]").val("<?=$data->ruc;?>");
        $("<?=$formId?> input[name=razon]").val("<?=$data->razon;?>");
        $("<?=$formId?> div[name=cantviajes]").html("<div class='label'><?php echo $contClientInSales;?></div>");

        $("<?=$formId?> select[name=ubigeo_id_destine]").focus();


        $("<?=$formId?> input[name=names]").change(function() {
          $("<?=$formId?> input[name=client_id]").val('');
          $("<?=$formId?> input[name=ruc]").val('');
          $("<?=$formId?> input[name=razon]").val('');
          $("<?=$formId?> input[name=age]").val('');
        });
        $("<?=$formId?> input[name=surnames]").change(function() {
          $("<?=$formId?> input[name=client_id]").val('');
          $("<?=$formId?> input[name=ruc]").val('');
          $("<?=$formId?> input[name=razon]").val('');
          $("<?=$formId?> input[name=age]").val('');
        });
        $("<?=$formId?> input[name=ruc]").change(function() {
          $("<?=$formId?> input[name=client_id]").val('');
        });
        $("<?=$formId?> input[name=razon]").change(function() {
          $("<?=$formId?> input[name=client_id]").val('');
        });
    </script>
    <?php
}else{
        if ($DataOfWeb==1 and $nodata==1) {
            

            //para la edad
            if($data['fecha_nacimiento']!=''){
                $fechaExplode=explode('/',$data['fecha_nacimiento']);
                $edad=date('Y')-$fechaExplode[2];
            }else{
                $edad='';
            }
            
            $fech_mac   = $data['fecha_nacimiento'];
            $dni        = $data['dni'];
            $nombres    = $data['nombres'];
            $apellidos  = $data['ap_paterno'].' '.$data['ap_materno'];
            $gene     = substr($data['sexo'], 0, 1);
            $genero     = ($gene=='M') ? '1' : '2';
            ?>
            <script type="text/javascript">
                
                $("<?=$formId?> select[name=type_document]").val("1-DNI");
                $("<?=$formId?> input[name=client_id]").val("");
                $("<?=$formId?> input[name=names]").val("<?=$nombres;?>");
                $("<?=$formId?> input[name=surnames]").val("<?=$apellidos;?>");
                $("<?=$formId?> input[name=client_birthdate]").val("<?=$fech_mac;?>");
                $("<?=$formId?> input[name=age]").val("<?=$edad;?>");
                $("<?=$formId?> select[name=gender]").val("<?=$genero;?>");
                $("<?=$formId?> select[name=nationality]").val("PE");
                $("<?=$formId?> input[name=num_phone]").val("");
                $("<?=$formId?> input[name=obs]").val("");
                $("<?=$formId?> input[name=address]").val("");
                $("<?=$formId?> input[name=email]").val("");
                $("<?=$formId?> input[name=ruc]").val("");
                $("<?=$formId?> input[name=razon]").val("");
                $("<?=$formId?> div[name=cantviajes]").val("0");

                $("<?=$formId?> select[name=ubigeo_id_destine]").focus();
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                $("<?=$formId?> input[name=names]").val("");
                $("<?=$formId?> input[name=client_id]").val("0");
                $("<?=$formId?> input[name=surnames]").val("");
                $("<?=$formId?> input[name=age]").val("");
                $("<?=$formId?> select[name=gender]").val("1");
                $("<?=$formId?> select[name=nationality]").val("PE");
                $("<?=$formId?> input[name=num_phone]").val("");
                $("<?=$formId?> input[name=obs]").val("");
                $("<?=$formId?> input[name=address]").val("");
                $("<?=$formId?> input[name=email]").val("");
                $("<?=$formId?> input[name=ruc]").val("");
                $("<?=$formId?> input[name=razon]").val("");

                $("<?=$formId?> input[name=names]").focus();
            </script>
            <?php
        }
}
?>
