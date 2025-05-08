<div class="clock">
    <div id="Date"></div>

    <ul>
        <li id="hours"> </li>
        <li id="point">:</li>
        <li id="min"> </li>
        <li id="point">:</li>
        <li id="sec"> </li>
    </ul>

</div>
<br><br>
<div class="container">
    <h2>Bienvenido: <?php echo $name_user;?></h2>
            <?php echo $this->Html->tag('h4',$agence->name); ?>
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-4">
                    <?= $this->Html->link('<div class="widget btn-primary text-center widget style1"><i class="fa fa-bus fa-4x"></i><br><br><h3 class="font-bold no-margins">PASAJES </h3><small>Venta de pasajes</small></div>', ['controller'=>'sales','action' => 'passages_load_dotsales',1], ['data-toggle'=>'modal','data-target'=>'#myModal875','escape' => false]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Html->link('<div class="widget btn-warning text-center widget style1"><i class="fa fa-truck fa-4x"></i><br><br><h3 class="font-bold no-margins">ENCOMIENDAS </h3><small>courier / encomiendas </small></div>', ['controller'=>'sales','action' => 'passages_load_dotsales',2], ['data-toggle'=>'modal','data-target'=>'#myModal875','escape' => false]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Html->link('<div class="widget btn-danger text-center widget style1"><i class="fa fa-money fa-4x"></i><br><br><h3 class="font-bold no-margins">EGRESOS </h3><small>gastos de oficina </small></div>', ['controller'=>'expenses','action' => 'index'], ['escape' => false]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Html->link('<div class="widget btn-info text-center widget style1"><i class="fa fa-ticket fa-4x"></i><br><br><h3 class="font-bold no-margins">MAS INGRESOS </h3><small>otros ingresos </small></div>', ['controller'=>'incomes','action' => 'index'], ['escape' => false]) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Html->link('<div class="widget btn-success text-center widget style1"><i class="fa fa-calculator fa-4x"></i><br><br><h3 class="font-bold no-margins"> LIQUIDACION </h3><small>gastos de oficina </small></div>', ['controller'=>'sales','action' => 'liquidation'], ['escape' => false]) ?>
                </div>
                <div class="col-md-4 hide">
                    <div class="col-xs-12">
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block">
                                <?php
                                $total=0;
                                $venta_hoy=0;
                                //debug($pass_sum->toarray());
                                foreach ($pass_sum as $key => $value) {
                                   $total=$total+$value->sum;
                                   if(date('Y-m-d')==$value->fecha){
                                        $venta_hoy=$value->sum;
                                   }
                                }
                                echo 'S/. '.number_format($total,2);
                                ?>
                            </span>
                            <small class="text-muted m-b block"><b>VENTAS EN PASAJE</b></small>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block">
                                <?php
                                $total=0;
                                $venta_hoy=0;
                                //debug($pass_sum->toarray());
                                foreach ($com_sum as $key => $value) {
                                   $total=$total+$value->sum;
                                   if(date('Y-m-d')==$value->fecha){
                                        $venta_hoy=$value->sum;
                                   }
                                }
                                echo 'S/. '.number_format($total,2);
                                ?>
                            </span>
                            <small class="text-muted m-b block"><b>VENTAS ENCOMIENDA</b></small>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="widget lazur-bg no-padding">
                <div class="row">
                    <div class="widget blue-bg">
                        <center><?php echo $this->Html->image("ifac_logo.png",['width'=>'150']); ?></center>
                        <h2>
                            <center>SOPORTE INFORMATICO</center>
                        </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-phone m-r-xs"></span>
                                <label>Celular: </label>
                                (051) 917587923
                            </li>
                            <li>
                                <span class="fa fa-envelope m-r-xs"></span>
                                <label>Email:</label>
                                niodeymi.dc@gmail.com
                            </li>                                                       
                            <li>
                                <span class="fa fa-external-link m-r-xs"></span>
                                <label>Página web: </label>
                                <a href="http://www.ifac.pe" target="blank" style="color: #ffffff;">www.ifac.pe</a>
                            </li>
                            <li>
                                <span class="fa fa-home m-r-xs"></span>
                                <label>Dirección:</label>
                                Jr. Carabaya 722 2do Piso (edificio JICAR). Juliaca-Puno
                            </li> 
                        </ul>
                    </div>
                </div>  
            </div>
        </div>    
    </div>
</div>
<style type="text/css">
.clock { position: absolute;left:50%;width:400px;margin-left:-200px;height:60px;margin-top:-50px;border:0px solid #808080;padding:5px;z-index: 999999; }

#Date { font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; }

.clock ul { margin:0 auto; padding:0px; list-style:none; text-align:center; }
.clock ul li { display:inline; font-size:20px; text-align:center; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif;  }

#point { position:relative; -moz-animation:mymove 1s ease infinite; -webkit-animation:mymove 1s ease infinite;  }


</style>
<div class="container">
    <div class="row white-bg dashboard-header">
        <div class="col-sm-12">
            <div class="row text-center solo SAN LUIS">
                <div class="col-lg-12"> 
                    <h4>VENTAS TOTALES DE <?php echo date('d-m-Y'); ?> SEGUN PROGRAMACION (solo pasajes)</h4> 

                        <table class="table table-striped table-bordered table-hover table-full-width datable_all" >
                            <thead>
                                <tr>
                                    <th>TIPO</th>
                                    <th>FECHA Y HORA VIAJE</th>
                                    <th>RUTA</th>
                                    <th>PLACA</th>
                                    <th>VENTAS POR OFICINA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                foreach ($programaciones as $value) :
                                    $fecha=$value->date->format("d-m-Y");
                                    $hora=$value->hour->format("g:i a");
                                    $IdUser=$value->user_id;
                                    $status=$value->status;
                                    $IdProgramation=$value->id;
                                    $div_junto = "div_u_".$IdProgramation;
                                    ?>
                                    <tr id="uptUser<?php echo $IdProgramation; ?>">
                                        <td><?php if($value->only_commend==1){echo '<span class="badge badge-success">ENCOMIENDAS</span>';}else{echo '<span class="badge badge-primary">PASAJES</span>';} ?></td>
                                        <td><?php echo $fecha.' '.$hora; ?></td>
                                        <td>
                                            <?php 
                                            if ($value->only_commend==0) {
                                                echo $value->route->name;
                                            }else{
                                                echo $origenes[$value->id]->ubigeo->cp.' - '.$destinos[$value->id]->ubigeo->cp;
                                            } 
                                            ?>
                                        </td>
                                        <td><?php echo $value->bus->plate; ?></td>
                                        
                                        <td>
                                            <small style="margin-left: 10px;">
                                                <?php 
                                                foreach ($ListOrderRoute[$value->id] as $orderotes) {
                                                    $distrito=$orderotes->ubigeo->cp;
                                                    $color=$orderotes->ubigeo->color;
                                                    $orden=$orderotes->orden;
                                                    $id_ubigeo=$orderotes->ubigeo->id;
                                                    //echo $orderotes;
                                                    $sumaSede[$orderotes->id]=0;
                                                    $cont_sede[$orderotes->id]=0;

                                                    foreach ($ventas_pasajes[$value->id][$orderotes->id] as $ventas) {
                                                         $sumaSede[$orderotes->id]=$sumaSede[$orderotes->id] + $ventas->price;
                                                         $cont_sede[$orderotes->id]=$cont_sede[$orderotes->id] + 1;
                                                    }
                                                    //debug($sumaSede[$orderotes->id]);
                                                    if ($sumaSede[$orderotes->id]>0) {
                                                       echo ' '.$this->Html->tag('span',$distrito.' - S/. '.$sumaSede[$orderotes->id].' - '.$cont_sede[$orderotes->id], array('class' => 'label label-success','style'=>"background-color:$color; font-size:6pt;"));
                                                    }
                                                        
                                                }
                                                ?>
                                            </small>
                                        </td>
                                    </tr>
                                 <?php endforeach;?>
                            </tbody>
                        </table>
                </div>
            </div>
            
            <div class="row hide">
                <div class="col-xs-5">
                    <canvas id="lineChart" ></canvas>
                </div>
                <div class="col-xs-1">
                    <canvas id="lineChart" ></canvas>
                </div>
                <div class="col-xs-5">
                    <canvas id="lineChart2"></canvas>
                </div>
                <div class="col-xs-1">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <canvas id="polarChart" width="80" height="80"></canvas>
                        <h5 >Kolter</h5>
                    </div>
                    <div class="col-lg-6">
                        <canvas id="doughnutChart" width="78" height="78"></canvas>
                        <h5 >Maxtor</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="myModal875" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog" style="margin: 70px auto;">
    <div class="modal-content"> </div>
  </div>
</div>



<script type="text/javascript">
  $('#myModal875').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>
    
<? echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js', ['block' => true]) ?>
<? echo $this->Html->script('plugins/flot/jquery.flot', ['block' => true]) ?>
<? //echo $this->Html->script('inspinia', ['block' => true]) ?>
<? //echo $this->Html->script('plugins/flot/jquery.flot.tooltip.min.js', ['block' => true]) ?>
<? echo $this->Html->script('plugins/flot/jquery.flot.spline.js', ['block' => true]) ?>
<? //echo $this->Html->script('plugins/flot/jquery.flot.resize.js', ['block' => true]) ?>
<? //echo $this->Html->script('plugins/flot/jquery.flot.pie.js', ['block' => true]) ?>
<? echo $this->Html->script('plugins/chartJs/Chart.min.js', ['block' => true]) ?>


    <script>
        $(document).ready(function() {
            

        //data passages
        var lineData = {
            labels: [
            <?php 
            foreach ($pass_sum as $key => $value) {
                $date=explode('-', $value->fecha);
                echo '"'.$date[2].'",';
            }
            ?>
            ],
            datasets: [
                {
                    label: "Example dataset",
                    fillColor: "rgba(0,153,255,0.5)",
                    strokeColor: "rgba(0,94,255,1)",
                    pointColor: "rgba(0,80,255,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php 
            foreach ($pass_sum as $key => $value) {
               echo '"'.$value->sum.'",';
            }
            ?>]
                }
            ]
        };

        //data commends
        var lineData2 = {
            labels: [
            <?php 
            foreach ($com_sum as $key => $value) {
                $date=explode('-', $value->fecha);
                echo '"'.$date[2].'",';
            }
            ?>
            ],
            datasets: [
                {
                    label: "Example dataset2",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,90,148,0.7)",
                    pointColor: "rgba(26,80,148,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [<?php 
            foreach ($com_sum as $key => $value) {
               echo '"'.$value->sum.'",';
            }
            ?>]
                }
            ]
        };

        var lineOptions = {
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            bezierCurve: true,
            bezierCurveTension: 0.4,
            pointDot: true,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            responsive: true,
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        var ctx = document.getElementById("lineChart2").getContext("2d");
        var myNewChart = new Chart(ctx).Line(lineData2, lineOptions);


        var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });
    </script>

<script type="text/javascript">

$(document).ready(function() {
         $('.clock').draggable();

// Create two variable with the names of the months and days in an array
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]; 
var dayNames= ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year    
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
    // Create a newDate() object and extract the seconds of the current time on the visitor's
    var seconds = new Date().getSeconds();
    // Add a leading zero to seconds value
    $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    },1000);
    
setInterval( function() {
    // Create a newDate() object and extract the minutes of the current time on the visitor's
    var minutes = new Date().getMinutes();
    // Add a leading zero to the minutes value
    $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
    
setInterval( function() {
    // Create a newDate() object and extract the hours of the current time on the visitor's
    var hours = new Date().getHours();
    // Add a leading zero to the hours value
    $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);
    
}); 
</script>