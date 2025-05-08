<?= $this->Html->css('plugins/chosen/chosen', ['block' => true]) ?>
<?= $this->Html->script('plugins/chosen/chosen.jquery', ['block' => true]) ?>

<script type="text/javascript">
$(function () {
    $('#agence_list_id').chosen({});
    $("#boton_hora").show();
    $('#right-sidebar').addClass('animated slideInLeft');
    $('#right-sidebar').toggleClass('sidebar-open');
}); 
</script>
<style type="text/css">
    .form-group {
        margin-bottom: 10px;
    }
</style>
<script type="text/javascript">
<?php 
$fecha=date('Y-m-d'); //fecha de hoy
//actualizamos
echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'passages_list_hours'),'update' => 'horarios','datos'=>['route_id'=>$route_id,'agence_id'=>$agence_id],'complete'=>'update_lista_horario();'));

?>

function update_lista_horario(){
	$.ajax({async:true, type:'post', complete:function(request, json) {$('#lista_horarios').html(request.responseText); }, url:<?php echo $this->Url->build('/');?>+'sales/passages_view_hours', data:{ fecha_salida: '<?php echo $fecha; ?>', route_id: <?php echo $route_id; ?>, agence_id: <?php echo $agence_id; ?> }});	
}


//$('#form1181489380').bind('submit', function(){ $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#container_route').html(request.responseText); $('#cargando').hide()}, data:$('#form1181489380').serialize(), url:'/cake_inspinia/sales/passages-horarios'}) })

</script>
<script type="text/javascript">
    <?php echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'passages_list_agences'),'update' => 'list_agences')); ?>
</script>
<script type="text/javascript">
    <?php echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'passages_list_routes'),'update' => 'list_routes_agences')); ?>
</script>
<?php //echo $this->Ajax->remoteTimer(array('url' => array( 'controller' => 'demo', 'action' => 'view', 1 ),'update' => 'post9', 'frequency' => 4 )); ?>

<div class="container">
    <div id='container_route'>
        <div class="animated fadeIn" id="passages_view_horario">
        	<div class="p-w-md m-t-sm">
                <div class="row text-center">
                	<h1><?php echo $Routes->Routes->name ?></h1>
                	<small>
                		<?php 
                		foreach ($ListOrderRoute[$Routes->Routes->id] as $orderotes) {
                            $distrito=$orderotes->ubigeo->distrito;
                            $color=$orderotes->ubigeo->color;
                            $orden=$orderotes->orden;
                            $id_ubigeo=$orderotes->ubigeo->id;
                            //echo $orderotes;
                            if($coder_ubigeo_id==$id_ubigeo){
                                echo " <span style='padding:2.5px;padding-bottom:5px;border:1px solid $color; border-radius: 5px'>".$this->Html->tag('span',$orden.' '.$distrito, array('class' => 'label label-success','style'=>"background-color:$color; font-size:6pt;")).'</span>';
                            }else{
                                echo ' '.$this->Html->tag('span',$orden.' '.$distrito, array('class' => 'label label-success','style'=>"background-color:$color; font-size:6pt;"));
                            }
                        }
                		?>
                	</small><br>
                    <h4><?php echo $data_dotsale_16->agence->name; ?></h4>
                </div>
            </div>
            <div class="p-w-md m-t-sm">
                <div class="row">

                    <div class="col-sm-5">
                        <h1 class="m-b-xs ">
                            26,900
                        </h1>
                        <small>
                            Sales in current month
                        </small>
                        <div id="sparkline1" class="m-b-sm"></div>
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>236 321.80</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>46.11%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>432.021</h4>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-5">
                        <h1 class="m-b-xs">
                            98,100
                        </h1>
                        <small>
                            Sales in last 24h
                        </small>
                        <div id="sparkline2" class="m-b-sm"></div>
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>166 781.80</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>22.45%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>862.044</h4>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="small pull-left col-md-3 m-l-lg m-t-md">
                            <strong>Sales char</strong> have evolved over the years sometimes.
                        </div>
                        <div class="small pull-right col-md-3 m-t-md text-right">
                            <strong>There are many</strong> variations of passages of Lorem Ipsum available, but the majority have suffered.
                        </div>
                        <div class="flot-chart m-b-xl">
                            <div class="flot-chart-content" id="flot-dashboard5-chart"></div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>

 <script>
        $(document).ready(function() {

            var sparklineCharts = function(){
                $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();




            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                        data1,  data2
                    ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 2,
                            color: 'transparent'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                        },
                        tooltip: false
                    }
            );

        });
    </script>


<? echo $this->Html->script('plugins/flot/jquery.flot', ['block' => true]) ?>
<? echo $this->Html->script('plugins/chartJs/Chart.min', ['block' => true]) ?>
<? echo $this->Html->script('plugins/flot/jquery.flot.spline.js', ['block' => true]) ?>

<?php echo $this->Html->script('plugins/sparkline/jquery.sparkline.min.js', ['block' => true]); ?>

<div id="myModal" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> </div>
  </div>
</div>
<?php echo $this->Html->script('plugins/footable/footable.all.min.js', ['block' => true]); ?>

<?php echo $this->Html->css('plugins/footable/footable.core.css', ['block' => true]); ?>

<?php echo $this->Html->script('plugins/staps/jquery.steps.min.js', ['block' => true]); ?>
<?php echo $this->Html->css('plugins/steps/jquery.steps.css', ['block' => true]); ?>

<?php echo $this->Html->script('plugins/validate/jquery.validate.min.js', ['block' => true]); ?>

<script type="text/javascript">
  $('#myModal').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>
<script>
    $(document).ready(function() {

        $('.footable').footable();

        $('.file-box').each(function() {
            animationHover(this, 'pulse');
        });

    });

</script>

