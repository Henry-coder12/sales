<?php 
if ($countInSales==0) {
}else{
    ?>
    <script type="text/javascript">  
    	$("<?=$formId?> input[name=number]").val('');     	      
        alert('El documento ya existe');
        $("<?=$formId?> input[name=number]").focus();
    </script>
    <?php
}
?>