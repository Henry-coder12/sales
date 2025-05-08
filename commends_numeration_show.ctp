
<?php //print_r($dotcommends);?>
<?php  
//echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-pencil')).' &nbsp; Corregir correlativo ',['controller'=>'sales','action' => 'passages_numeration_edit',$numeracion['id'] ], ['data-toggle'=>"modal",'data-target'=>"#myModal",'id'=>'boton','class'=>'btn btn-info btn-xs panel-collapse position-relative','style'=>"float: right; margin-top:12px;margin-right:10px;",'escape' =>false]) ;
?>
<h3 style="margin-top: 12px;font-size:20px;"><b><?php echo $numeracion['numeration']['serie']?> - <?php echo str_pad($numeracion['numeration']['number'],7,'0',STR_PAD_LEFT)?></b></h3>
<input type="hidden" id="SerieSerie" value="<?php echo $numeracion['numeration']['serie'];?>">
<input type="hidden" id="SerieDocument" value="<?php echo $numeracion['numeration']['document'];?>">
<input type="hidden" id="SerieNumber" value="<?php echo $numeracion['numeration']['number'];?>">



<?php
if($numeracion['numeration']['document']=='01'){
	?>
	<script type="text/javascript">
	$(document).ready(function () { 
		$("#doclient").attr('maxlength', 11);
		$("#doclient").val('');

		$("#confactura").removeClass("hide");
		if($("#doclient").val()==''){
			$("#doclient").focus();
		}else{
			$("#nomclient").focus();
		}

		
		

		$("#remitente_data_ruc").removeClass("hide");
		$("#remitente_data_dni").addClass("hide");
	});
	
	</script>
	<?php
}else{
	?>
	<script type="text/javascript">
	$(document).ready(function () {
		$("#doclient").attr('maxlength', 8);
		$("#doclient").val('');

		$("#confactura").addClass("hide");
		if($("#doclient").val()==''){
			$("#doclient").focus();
		}else{
			$("#nomclient").focus();
		}




		$("#remitente_data_ruc").addClass("hide");
		$("#remitente_data_dni").removeClass("hide");
	});
	
	</script>
	<?php
}
?>