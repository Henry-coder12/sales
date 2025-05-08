<?php 
//print_r($data);
if ($count) {
    $tip_doc=$data->cod_document.'-'.$data->type_document;

    //para la edad
    $fechaExplode=explode('-',$data->birthdate->format("Y-m-d"));
    $edad=date('Y')-$fechaExplode[0];
    $nacimiento=$data->birthdate->format("Y-m-d");

    ?>
    <script type="text/javascript">
        $("<?=$formId?> input[name=address]").val("<?=$data->address;?>");
        $("<?=$formId?> input[name=ruc]").val("<?=$data->ruc;?>");
        $("<?=$formId?> input[name=razon]").val("<?=$data->razon;?>");

        $("<?=$formId?> select[name=ubigeo_id_destine]").focus();
    </script>
    <?php
}else{
        if ($DataOfWeb==1 and $nodata==1) {
            

            
            $razon=$data['razon_social'];
            $direccion=$data['direccion'];
            
            ?>
            <script type="text/javascript">
                $("<?=$formId?> input[name=address]").val("<?=$direccion;?>");
                $("<?=$formId?> input[name=razon]").val("<?=$razon;?>");

                $("<?=$formId?> select[name=ubigeo_id_destine]").focus();
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
            $("<?=$formId?> input[name=razon]").val("");
                $("<?=$formId?> input[name=razon]").focus();
            </script>
            <?php
        }
}
?>
