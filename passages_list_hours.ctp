
<div class="sidebar-title">
    <?= $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-plus')).' &nbsp; Programar salida', ['controller'=>'sales','action' => 'passages_add_programation',null,'?'=>['r'=>$route_id,'a'=>$agence_id] ], ['data-toggle'=>'modal','data-target'=>'#myModal','class'=>'btn  btn-block btn-info','escape' => false]) ?>
    <div id="datetimepicker12"></div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                locale: 'es',
                format: 'YYYY-MM-DD',
                //minDate : Date('YYYY-MM-DD') //now
                minDate: "<?php echo date('Y-m-d',strtotime('-60 day',strtotime(date('Y-m-d'))));?>"
            }).on("dp.change", function (e) {   
                fecha=$('#datetimepicker12').datetimepicker().data('date');                
                $.ajax({async:true, type:'post', beforeSend:function(request) {$('#lista_horarios').html('');$('#load_horarios').show();} ,complete:function(request, json) {$('#load_horarios').hide(), $('#lista_horarios').html(request.responseText); }, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_view_hours', data:{ fecha_salida: fecha , route_id: <?php echo $route_id; ?>, agence_id: <?php echo $agence_id; ?>} });
            });

        });

    </script>
</div>
<div>
    <div id='load_horarios' style="display:none;"><center><?php echo $this->Html->image('indicator.gif'); ?></center></div>
    <div id='lista_horarios'>
        
    </div>
</div>
