<?php //print_r($data);?>
<?php 
if(isset($data['id'])){ 
	$idClient=$data['id'];
	$nameClient=$data['surnames'].' '.$data['names'];
	$direccionClient=$data['address'];
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 			
			$("#clientnames").focus();
		});

		$('#clientdoc').numeric();

		//llenamos la info
		$("#RemitIdPrepaid").val("<?=$idClient;?>");
		$("#clientsurnames").val("<?=$data['surnames'];?>");
		$('#clientnames').val("<?=$data['names'];?>");
		$("#clientrazon").val("<?=$data['razon'];?>");
		$('#clientdireccion').val("<?=$data['address'];?>");
		$('#clientcumple').val("<?=$data['birthdate']->format('Y-m-d');?>");
		
		
	</script>
	<?php
}elseif(isset($data['data'])){
	//debug($data['data']['razon']);
	$idClient=0;
	
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			if($("#dotsale_id_selected_prepaid").find('option:selected').attr('typeDoc')=='03'){
				<?php
				if(isset($data['data']['dni'])){
					$ApellidoClient=$data['data']['paterno'].' '.$data['data']['materno'];
					$NameClient=$data['data']['nombres'];
					$birthClient=$data['data']['nacimiento'];
					$direccionClient='';
					?>
					$("#clientnames").focus();

					$("#RemitIdPrepaid").val("0");
					$("#clientsurnames").val("<?=$ApellidoClient;?>");
					$('#clientnames').val("<?=$NameClient;?>");
					$('#clientcumple').val("<?=$birthClient;?>");
					<?php
				}
				?>
				
			}
			if($("#dotsale_id_selected_prepaid").find('option:selected').attr('typeDoc')=='01') {
				<?php
				if(isset($data['data']['ruc'])){
					$razonClient=$data['data']['razon'];
					$direccionClient=$data['data']['direccion'];
					?>
					$("#clientnames").focus();

					$("#RemitIdPrepaid").val("0");
					$("#clientrazon").val("<?=$razonClient;?>");
					$('#clientdireccion').val("<?=$direccionClient;?>");
					<?php
				}
				?>
			}
		});

		$('#clientdoc').numeric();

	</script>
	<?php
}else{
	$idClient=0;
	$nameClient='';
	$direccionClient='';
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			if($("#dotsale_id_selected_prepaid").find('option:selected').attr('typeDoc')=='03'){
				$("#clientnames").focus();
			}
			if($("#dotsale_id_selected_prepaid").find('option:selected').attr('typeDoc')=='01'){
				$("#clientrazon").focus();
			}
		});

		$('#clientdoc').numeric();

	</script>
	<?php
}
?>

