<?php //print_r($data);?>
<?php 
if(isset($data['id'])){
	$idClient=$data['id'];
	$nameClient=$data['surnames'].' '.$data['names'];
	$direccionClient=$data['address'];

	$textoReemplazadoRazon=str_replace('"','\"',$data['razon']);
	$textoReemplazadoDir=str_replace('"','\"',$data['address']); 
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			if($("#reseptdoc").val().length>=8){
				$("#DetailCantidad2").focus();
			}else{
				$("#reseptdoc").focus();
			}
			
		});

		$('#doclient').numeric();
		$('#reseptdoc').numeric();

		//llenamos la info
		$("#idclient").val("<?=$idClient;?>");
		$("#apeclient").val("<?=$data['surnames'];?>");
		$('#nomclient').val("<?=$data['names'];?>");
		razonClientjs="<?=$textoReemplazadoRazon;?>";
		dirClientjs="<?=$textoReemplazadoDir;?>";

		$("#razonclient").val(razonClientjs);
		$('#dirclient').val(dirClientjs);
		$('#birthclient').val("<?=$data['birthdate']->format('Y-m-d');?>");
		<?php 
		if ($data['credit']==1) { ?>
			$('#divcreditclient').show();
			$('#divpagodestino').hide();
			$('#creditClient').prop('checked',true);
			$('#creditClient').attr('disabled','disabled');
			$('#PagoDestino').prop('checked',true);
			$('#form_commends').attr('action', "<?php echo $this->Url->build('/');?>"+"sales/commends_ticket");
		<?php }else{ ?>
			$('#divpagodestino').show();
			$('#divcreditclient').hide();
			$('#creditClient').prop('checked',false);
			$('#creditClient').removeAttr('disabled');
			$('#PagoDestino').prop('checked',false);
			$('#form_commends').attr('action', "<?php echo $this->Url->build('/');?>"+"sales/commends_print");
		<?php } ?>
		
		
	</script>
	<?php
}elseif($data['respuesta']=='ok'){
	//debug($data['data']['razon']);
	$idClient=0;
	
	?>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$('#divpagodestino').show();
			$('#divcreditclient').hide();
			$('#creditClient').prop('checked',false);
			$('#PagoDestino').prop('checked',false);
			$('#form_commends').attr('action', "<?php echo $this->Url->build('/');?>"+"sales/commends_print");

			if($("#dotsale_id_selected").find('option:selected').attr('typeDoc')=='03'){
				<?php
				if(isset($data['dni'])){
					$ApellidoClient=$data['ap_paterno'].' '.$data['ap_materno'];
					$NameClient=$data['nombres'];
					$birthClient=$data['fecha_nacimiento'];
					$direccionClient='';
					?>
					$("#reseptdoc").focus();

					$("#idclient").val("0");
					$("#apeclient").val("<?=$ApellidoClient;?>");
					$('#nomclient').val("<?=$NameClient;?>");
					$('#birthclient').val("<?=$birthClient;?>");
					<?php
				}
				?>
				
			}
			if($("#dotsale_id_selected").find('option:selected').attr('typeDoc')=='12'){
				<?php
				if(isset($data['dni'])){
					$ApellidoClient=$data['ap_paterno'].' '.$data['ap_materno'];
					$NameClient=$data['nombres'];
					$birthClient=$data['fecha_nacimiento'];
					$direccionClient='';
					?>
					$("#reseptdoc").focus();

					$("#idclient").val("0");
					$("#apeclient").val("<?=$ApellidoClient;?>");
					$('#nomclient').val("<?=$NameClient;?>");
					$('#birthclient').val("<?=$birthClient;?>");
					<?php
				}
				?>
				
			}
			if($("#dotsale_id_selected").find('option:selected').attr('typeDoc')=='01') {
				<?php
				if(isset($data['ruc'])){
					$textoReemplazadoRazon=str_replace('"','\"',$data['razon_social']);
					$textoReemplazadoDir=str_replace('"','\"',$data['direccion']); 
					?>
					razonClientjs="<?=$textoReemplazadoRazon;?>";
					dirClientjs="<?=$textoReemplazadoDir;?>";

					$("#reseptdoc").focus();

					$("#idclient").val("0");
					$('#razonclient').val(razonClientjs);
					$('#dirclient').val(dirClientjs);
					<?php
				}
				?>
			}
		});

		$('#doclient').numeric();
		$('#reseptdoc').numeric();



	</script>
	<?php
}else{
	$idClient=0;
	$nameClient='';
	$direccionClient='';
	?>
	<script type="text/javascript">
		$('#divpagodestino').show();
		$('#divcreditclient').hide();
		$('#creditClient').prop('checked',false);
		$('#PagoDestino').prop('checked',false);
		$('#form_commends').attr('action', "<?php echo $this->Url->build('/');?>"+"sales/commends_print");

		$(document).ready(function(){ 
			if($("#dotsale_id_selected").find('option:selected').attr('typeDoc')=='03'){
				$("#apeclient").focus();
			}
			if($("#dotsale_id_selected").find('option:selected').attr('typeDoc')=='01'){
				$("#razonclient").focus();
			}
		});

		$('#doclient').numeric();
		$('#reseptdoc').numeric();

	</script>
	<?php
}
?>


<script type="text/javascript">
	$('#doclient').keyup(function(){
		$("#idclient").val(0);
		$("#razonclient").val('');
		$("#nomclient").val('');
		$("#apeclient").val('');
		$("#dirclient").val('');
	});
</script>