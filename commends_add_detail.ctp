<?php
if($contar<3){
echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_document','url' => array('controller' => 'sales','action' => 'commends_add_detail'),'class'=>'form-horizontal','confirm' => 'Desea agregar el detalle?','complete' => 'calcular_valor_compra();','id'=>'agregarform')));
}
?>
<table class="table table-striped table-bordered" id='lista'>
<thead>
	<tr>
		<tr>
			<th class="center">CANT</th>
			<th>DICE CONTENER </th>
			<th>PRECIO UNITARIO</th>
			<th class="hidden-480">PRECIO TOTAL</th>
			<th>Acciones</th>
		</tr>
</thead>

<tbody>
	<?php
		if($contar<3){
			
			echo '<tr>';
				echo '<td class="center">'.$this->Form->text('Detail.cantidad2',array('label'=>'','style'=>'width:50px;','title'=>'Ingrese cantidad','value'=>'','id'=>'DetailCantidad2')).'</td>';
				echo '<td>'.$this->Form->text('Detail.contener2',array('label'=>'','title'=>'Ingrese contenido', 'style'=>"text-transform:uppercase;width:100%;",'value'=>'','id'=>'DetailContener2')).'</td>';
				echo '<td><div id="precio">'.$this->Form->text('Detail.precio_unit2',array('label'=>'','style'=>'width:100%;','title'=>'Ingrese Precio','value'=>'','id'=>'DetailPrecioUnit2')).'</div></td>';
				echo '<td><div id="total">'.$this->Form->text('Detail.precio_total2',array('label'=>'','style'=>'width:100%;','title'=>'Ingrese Precio','id'=>'DetailPrecioTotal2')).'</div></td>'; 
				echo '<td><div>';																			
					echo $this->Form->hidden('Detail.id',array('value'=>''));
					echo $this->Form->button('Agregar',array('id'=>'agregar','type'=>'submit','class'=>'btn btn-success btn-sm'));
				echo '</div></td>';
			
			echo '</tr>';
			echo '</form>';
		}
	?>
	<?php
		foreach ($detail as $pro) {
			//para cantidad
			
			$detalleID=$pro->id;

			echo '<tr>';
				echo '<td class="center">'.$pro->quantity.'</td>';
				echo '<td>'.$pro->content.'</td>';
				echo '<td><div id="precio'.$detalleID.'" class="peciounit">'.number_format($pro->price, 2, '.', '').'</div></td>';
				$subtotal=$pro->total;

				echo '<td><div id="total'.$detalleID.'" class="subtotal">'.number_format($subtotal, 2, '.', '').'</div></td>'; 
				echo '<td><div>';
				echo $this->Ajax->form(array('type' => 'post','options' => array('update'=>'list_document','url' => array('controller' => 'sales','action' => 'commends_del_detail'),'class'=>'form-horizontal','confirm' => 'Desea eliminar el producto?','complete' => 'calcular_valor_compra();','before'=>"$('#del$detalleID').attr('disabled','disabled');")));
					echo $this->Form->hidden('Detail.id',array('value'=>$detalleID));
					echo '<button class="btn btn-danger btn-xs" id="del'.$detalleID.'"><i class="fa fa-times fa fa-white"></i></button>';
					echo '</form>';
				echo '</div></td>';
			echo '</tr>';
		}
		?>
</tbody>
</table>
<script type="text/javascript">
$(document).ready(function(){ 
	calcular_valor_compra();
	$("#DetailCantidad2").focus();

	//si cambia algo en los detalles habilitamos el boton ya que se desabilita al momento de enviar el formulario
	
	$("#DetailCantidad2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailContener2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailPrecioUnit2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});
	$("#DetailPrecioTotal2").change( function() {
  		$('#agregar').removeAttr('disabled');
	});

	$("#DetailPrecioTotal2").val('');


});
$('#doclient').numeric();
$('#reseptdoc').numeric();


$('#DetailCantidad2').number( true, 0);
//$('#DetailPrecioUnit2').number(true,2);
//$('#DetailPrecioTotal2').number(true,2);
</script>
<script>
$("#agregar").click(function (){
	$(".errors").remove();	
	if($("#DetailCantidad2").val() <= 0){
		$('#DetailCantidad2').tooltip({placement: "top"});        
        $("#DetailCantidad2").focus();
        return false;
	}else if($("#DetailContener2").val() == ""){
		$('#DetailContener2').tooltip({placement: "top"});        
        $("#DetailContener2").focus();
        return false;
	}else if($("#DetailPrecioUnit2").val() <= 0 && $("#DetailPrecioTotal2").val() <= 0){
		$('#DetailPrecioUnit2').tooltip({placement: "top"});        
        $("#DetailPrecioUnit2").focus();
        return false;
	}
	//desabilitamos el boton 
	$('#agregar').attr('disabled','disabled');
	// y para que no envie doble mandamos el foco a cualquier otra parte
	$('#update_select').focus();
	$('#agregarform').submit();
	return false;
});
</script>