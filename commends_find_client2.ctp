<?php //print_r($data);?>
<?php 
if(isset($data['id'])){
	$idClient2=$data['id'];
	$nameClient2=$data['surnames'].' '.$data['names'];
	$direccionClient2=$data['address'];
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("#numphone").focus();
		});

		
		$('#doclient').numeric();
		$('#reseptdoc').numeric();

		//llenamos la info
		$("#idresept").val("<?=$idClient2;?>");
		$("#recptapellido").val("<?=$data['surnames'];?>");
		$('#recptnombre').val("<?=$data['names'];?>");
		$('#receptdireccion').val("<?=$data['address'];?>");
		$('#recptbirth').val("<?=$data['birthdate']->format('Y-m-d');?>");

	</script>
	<?php
}elseif($data['respuesta']=='ok'){
	//debug($data['data']['razon']);
	$idClient=0;
	
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("#numphone").focus();
			<?php
			if(isset($data['dni'])){
				$ApellidoClient=$data['ap_paterno'].' '.$data['ap_materno'];
				$NameClient=$data['nombres'];
				$birthClient=$data['fecha_nacimiento'];
				$direccionClient='';
				?>
				

				$("#idresept").val("0");
				$("#recptapellido").val("<?=$ApellidoClient;?>");
				$('#recptnombre').val("<?=$NameClient;?>");
				$('#recptbirth').val("<?=$birthClient;?>");
				<?php
			}
			?>
				
			
			
		});

		$('#doclient').numeric();
		$('#reseptdoc').numeric();



	</script>
	<?php
}else{
	$idClient2=0;
	$nameClient2='';
	$direccionClient2='';
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
		$("#recptapellido").focus();
		});

		
		$('#doclient').numeric();
		$('#reseptdoc').numeric();

	</script>
	<?php
}
?>

<script type="text/javascript">
	$('#reseptdoc').keyup(function(){
		$("#idresept").val(0);
		$("#recptapellido").val('');
		$("#recptnombre").val('');
		$("#receptdireccion").val('');
	});
</script>