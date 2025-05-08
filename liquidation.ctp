<?php echo $this->Html->script('plugins/dataTables/datatables.min',array('inline'=>false));
      echo $this->Html->css('plugins/dataTables/datatables.min',array('inline'=>false));
 ?>

<br>
<div class="row">
    <div class="col-sm-12" id='div_liquidation'>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                LIQUIDACION ----- ><b>(<?php echo $AgencesLogin->name ?>) </b>
                            </div>
                            <div class="panel-body" id='destines'>
                                    <?php echo $this->Ajax->form(['type' => 'post','options' => ['update'=>'update_div_liquidation','url' => ['controller' => 'sales','action' => 'liquidation_find_date_personal'],'class'=>'form-inline','before'=>"$('.btn').attr('disabled','disabled');",'complete'=>"$('.btn').prop('disabled', false)"]]);
                                            echo ' INI '.$this->Form->input('date_ini',['append' => '<i class="fa fa-calendar"></i>','id'=>'date_ini','label'=>'','value'=>date('Y-m-d')]); ?>
                                            <div class="form-group text">
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <label class="control-label" for="hour_fin"></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name='hour_ini' data-mask='99:99' value="00:00" class="required">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            echo ' FIN '.$this->Form->input('date_fin',['append' => '<i class="fa fa-calendar"></i>','id'=>'date_fin','label'=>'','value'=>date('Y-m-d')]); ?>
                                            <div class="form-group text">
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <label class="control-label" for="hour_fin"></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name='hour_fin' data-mask='99:99' value="23:59" class="required">
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            echo $this->Form->hidden('tipo',['value'=>'0','id'=>'tipo_consult']);
                                            echo ' '.$this->Form->button('Consultar PERSONAL',array('id'=>'consul_personal','class'=>'btn btn-success'));
                                            //if ($tipoadmin==1) {
                                                echo ' '.$this->Form->button('Consultar OFICINA',array('id'=>'consul_office','class'=>'btn btn-blue'));
                                            //}
                                            echo $this->Form->end();
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
            <div id="update_div_liquidation">
                            
            </div>
    </div>
</div>

<iframe width="500" height="200" src="" name="hidden_iframe_liquidation" allowfullscreen style="display:none;"></iframe>
 

<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>

<script type="text/javascript">
//funcion para las ventanas modales
var $modal = $('#ajax-modal');
$modal.on('click', '.update', function(){
  $modal.modal('loading');
  setTimeout(function(){
    $modal
      .modal('loading')
      .find('.modal-body')
        .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '</div>');
  }, 1000);
});
</script>
<script>
    $(function () {
        $('#date_ini').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
        $('#date_fin').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
        $('.clockpicker').clockpicker();
    });
</script>

<script>
        $(document).ready(function(){
            //para los botonos de consulta
            $('#consul_personal').on("click", function () {
                $('#tipo_consult').val('0');
            })
            $('#consul_office').on("click", function () {
                $('#tipo_consult').val('1');
            })

           
            
        });


       
    </script>