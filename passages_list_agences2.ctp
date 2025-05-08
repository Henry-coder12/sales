<form class="form-inline" role="form">
    <?php echo $this->Form->input('agences_list',['options'=>$agencias,'id'=>'agences_list','label' =>'LUGAR DE EMBARQUE :','default' => $agencia_id_session,'style'=>'']); ?>
    <div class="input-group">
	    <input type="text" class="form-control date input-sm input-mask-date" name="date" value='<?php echo date("m-d-Y", strtotime($date_select));?>' required>
	    <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
	</div>
	<button type="submit" class="btn btn-white">BUSCAR</button>
</form>
<script>
    $(document).ready(function () {
        //$('#agences_list').chosen({});
    });
</script>

<?php //echo $this->Ajax->observeField('agences_list', ['url'=>['controller'=>'sales','action'=>'passages_list_routes'],'update' => 'list_routes_agences2','before'=>"$('#container_route').text('');"]); ?>


