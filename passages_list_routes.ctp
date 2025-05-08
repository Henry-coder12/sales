<div style="margin:10px 7px -7px 7px;">
	
	<?php 
	echo $this->Form->create(null,['url' => ['controller' => 'sales','action' => 'passages'],'type'=>'get']);
		echo "<table><tr>";
		echo '<td>
		<div class="form-group select"><select name="r" class="form-control" id="routes_list" style="">';
			foreach ($Routes as $value) {
				$idRoute=$value->Routes->id;
				if ($MostrarRuta[$idRoute]){
					if($route_id_session==$idRoute){
						echo '<option value="'.$idRoute.'" selected>'.$value->Routes->name.'</option>';
					}else{
						echo '<option value="'.$idRoute.'">'.$value->Routes->name.'</option>';
					}
				}
			}
		echo '</select></div></td><td>';
		echo $this->Form->hidden('a',['value'=>$agencia_id]);
        echo "<button style='margin-left:15px;margin-top:-12px' type='submit' class='btn btn-xs btn-warning'><i class='fa fa-refresh'></i></button>";
        echo "</td></tr></table>";
    echo $this->Form->end();
	?>
	
</div>
<div id="prueba5"></div>
<script type="text/javascript">
//<![CDATA[
//$('#routes_list').bind('change', function(){ $.ajax({async:true, type:'post', complete:function(request, json) {$('#prueba5').html(request.responseText); }, url:<?php //echo $this->Url->build('/');?>+'sales/passages-observer-routes-list', data:{ route_id:$('#routes_list').val(),agence_id: $('#agences_list').val() } }) })
//]]>
//var SessionRuta=<?php //echo $route_id_session; ?>;


</script>

<?php //echo $this->Ajax->observeField('routes_list', ['url'=>['controller'=>'sales','action'=>'passages_observer_routes_list'],'update' => 'prueba5','datos'=>['agence_id'=>33]]); ?>
<script>
    $(document).ready(function () {
        //$('#routes_list').chosen({});
    });
</script>

