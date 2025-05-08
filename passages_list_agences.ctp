<div style="margin:10px 7px -7px 7px;">
    <?php echo $this->Form->input('agences_list',['options'=>$agencias,'id'=>'agences_list','label' => false,'default' => $agencia_id_session,'style'=>'']); ?>
</div>
<script>
    $(document).ready(function () {
        //$('#agences_list').chosen({});
    });
</script>

<?php echo $this->Ajax->observeField('agences_list', ['url'=>['controller'=>'sales','action'=>'passages_list_routes'],'update' => 'list_routes_agences2','before'=>"$('#container_route').text('');"]); ?>


