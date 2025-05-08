<?php 
$idNumeration=$data['numeration_id'];
$idDotsale=$data['dotsale_id'];
if ($data['value_check']) {
	$checked='checked';
}else{
	$checked=false;
}
if($hecho==1){
	if ($contar_usados) {
		/*
		echo $this->Ajax->form(['type' => 'post','options' => ['update'=>"NumerationsId$idNumeration", 'url' => ['controller' => 'sales', 'action' => 'dotsale_activate']]]); 
		echo $this->Form->hidden('dotsale_id',['value'=>$idDotsale]);
		echo $this->Form->hidden('numeration_id',['value'=>$idNumeration]);
		echo $this->Form->submit('Usar',['class'=>'btn-primary btn-xs']);
		echo $this->Form->end();
		*/
		echo "<input type='checkbox' class='i-checks' id='ckeckNumerationsId$idNumeration'>";
		?>
		<script>
		alert('Solo se puede usar 1 serie del mismo tipo de documento');
		</script>
		<?php
	}else{
		if ($in_use==1) {
            echo "<input type='checkbox' class='i-checks' id='ckeckNumerationsId$idNumeration' $checked>";
            $value_check=0;                          
            
			/*
			echo $this->Ajax->form(['type' => 'post','options' => ['update'=>"NumerationsId$idNumeration", 'url' => ['controller' => 'sales', 'action' => 'dotsale_activate']]]);  
			echo $this->Form->hidden('dotsale_id',['value'=>$idDotsale]);
			echo $this->Form->hidden('numeration_id',['value'=>$idNumeration]);
			echo $this->Form->submit('quitar',['class'=>'btn-success btn-xs']);
			echo $this->Form->end();*/
		}else{
			echo "<input type='checkbox' class='i-checks' id='ckeckNumerationsId$idNumeration' $checked>";
            $value_check=1;

            
			/*
			echo $this->Ajax->form(['type' => 'post','options' => ['update'=>"NumerationsId$idNumeration", 'url' => ['controller' => 'sales', 'action' => 'dotsale_activate']]]); 
			echo $this->Form->hidden('dotsale_id',['value'=>$idDotsale]);
			echo $this->Form->hidden('numeration_id',['value'=>$idNumeration]);
			echo $this->Form->submit('Usar',['class'=>'btn-primary btn-xs']);
			echo $this->Form->end();*/
		}
		echo $this->Ajax->observeField("ckeckNumerationsId$idNumeration",['url' =>['controller' => 'sales','action' => 'dotsale_activate'],'with'=>null,'update' => "tdNumeration$idNumeration",'datos'=>['dotsale_id'=>$idDotsale,'numeration_id'=>$idNumeration,'value_check'=>$value_check],'before' => '$("#boton").attr("disabled", true)','complete' =>'$("#boton").removeAttr("disabled")']); 
	}
}else{
	echo "<input type='checkbox' class='i-checks' id='ckeckNumerationsId$idNumeration' disabled>";
}


 ?>
 <script>
	</script>