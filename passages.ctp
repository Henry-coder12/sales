<?= $this->Html->script('plugins/nestable/jquery.nestable', ['block' => true]) ?>
<?= $this->Html->css('plugins/chosen/chosen', ['block' => true]) ?>
<?= $this->Html->script('plugins/chosen/chosen.jquery', ['block' => true]) ?>
<?= $this->Html->css('plugins/clockpicker/clockpicker', ['block' => true]) ?>
<?= $this->Html->script('plugins/clockpicker/clockpicker', ['block' => true]) ?>
<script type="text/javascript">
$(function () {
    
    
    /*
    $('#agence_list_id').chosen({});
    $("#boton_hora").show();
    $('#right-sidebar').addClass('animated slideInLeft');
    $('#right-sidebar').toggleClass('sidebar-open');
    */
}); 
</script>
<style type="text/css">
    .form-group {
        margin-bottom: 10px;
    }
    .form-control:focus {
      box-shadow: none;
      border: 1px dotted #598CCC;
      background-color: #EAF2FF;
    }
    .input-sm {
        height: 28px;
    }
    select.input-sm {
        height: 38px;  
    }

    @font-face {
      font-family: Montserrat-Bold;
      src: url('../fonts/montserrat/Montserrat-Bold.ttf'); 
    }

    @font-face {
      font-family: Poppins-Medium;
      src: url('../fonts/poppins/Poppins-Medium.ttf'); 
    }
    .form-control, .single-line {
        font-family: Poppins-Medium;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #cccccc;
        border-radius: 0.90m;
        color: inherit;
        display: block;
        font-size: 15px;
        padding: 3px 6px;
        height: 38px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
        border-radius: 25px;   
    }
    .btn {
        font-family: Montserrat-Bold;
        border-radius: 20px;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
        font-size: 13px;
    }
</style>
<script type="text/javascript">
<?php 
//$fecha=date('Y-m-d'); //fecha de hoy
//actualizamos
echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'passages_list_hours'),'update' => 'horarios2','datos'=>['fecha_salida'=>$date_select,'route_id'=>$route_id,'agence_id'=>$agence_id],'complete'=>'update_lista_horario();'));

?>

function update_lista_horario(){
    $.ajax({async:true, type:'post', complete:function(request, json) {$('#lista_horarios').html(request.responseText); }, url:"<?php echo $this->Url->build('/');?>"+'sales/passages_view_hours', data:{ fecha_salida: '<?php echo $date_select; ?>', route_id: <?php echo $CoderRouteId; ?>, agence_id: <?php echo $CoderAgenceId; ?> }});   
}


//$('#form1181489380').bind('submit', function(){ $.ajax({async:true, type:'post', beforeSend:function(request) {$('#cargando').show();}, complete:function(request, json) {$('#container_route').html(request.responseText); $('#cargando').hide()}, data:$('#form1181489380').serialize(), url:'/cake_inspinia/sales/passages-horarios'}) })

</script>
<script type="text/javascript">
    <?php echo $this->Ajax->remoteFunction(array('url' => ['controller' => 'sales', 'action' => 'passages_list_agences',null,'?' => ['a'=>$CoderAgenceId,'r'=>$CoderRouteId]],'update' => 'list_agences2')); ?>
</script>
<script type="text/javascript">
    <?php echo $this->Ajax->remoteFunction(['url' =>['controller' => 'sales', 'action' => 'passages_list_routes',null,'?' => ['a'=>$CoderAgenceId,'r'=>$CoderRouteId]],'update' => 'list_routes_agences2']); ?>
</script>
<?php //echo $this->Ajax->remoteTimer(array('url' => array( 'controller' => 'demo', 'action' => 'view', 1 ),'update' => 'post9', 'frequency' => 4 )); ?>
<div class="row">
    <div  class="sidebar-container" style="overflow: hidden; width: auto; height: 100%;float: left;position: fixed;width: 250px;">
        <div class="miscroll">
            <div ><h3><center><?php echo substr($name_complete_user,0,18); ?></center></h3></div>
            <div id="list_agences2"></div>
            <div id="list_routes_agences2"></div>
            <div id="horarios2"></div>
            <br><br><br><br><br><br>
        </div>
    </div>
    
    <div class='gray-bg dashbard-1' style="float: left;width: 100%;margin-left: 250px;padding-right: 250px;position: absolute;height: 100%;background-image: url('../img/brackground.jpg');no-repeat; background-size: 88%;">
    <div class="row"> 
            <div class="col-lg-12" style="margin-left: 10px;margin-top: 10px; ">
                <table style="margin-left: 10px;">
                    <tr>
                        <td><font size="3"><b><u><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-home')).' &nbsp; Inicio',['controller'=>'sales','action' => 'index'], ['class'=>'btn btn-xs btn-success','escape' =>false]) ;?></u></b></font></td>
                        <td><small style="margin-left: 10px;"><FONT FACE="cambria" SIZE=+2>(<?php echo $agenceName; ?>)</small></td></FONT> 
                        <td>
                            <small style="margin-left: 10px;">
                                <?php 
                                foreach ($ListOrderRoute[$Routes->Routes->id] as $orderotes) {
                                    $distrito=$orderotes->ubigeo->cp;
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
                            </small>
                        </td>
                    </tr>
                </table>
                
                
            </div>
        </div>

        <div class="row">
                            <div class="container">
                                <div id='container_route'>
                                    <div class="animated fadeIn" id="passages_view_horario">
                                        


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

<?php
echo $this->Html->script('bootstrap-tooltip',array('inline'=>false));

?>
<? echo $this->Html->script('plugins/flot/jquery.flot', ['block' => true]) ?>
<? echo $this->Html->script('plugins/chartJs/Chart.min', ['block' => true]) ?>
<? echo $this->Html->script('plugins/flot/jquery.flot.spline.js', ['block' => true]) ?>

<?php echo $this->Html->script('plugins/sparkline/jquery.sparkline.min.js', ['block' => true]); ?>

<div id="myModal" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content"> </div>
  </div>
</div>
<div id="myModal2" class="modal inmodal in" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceInRight">
        
    </div>
  </div>
</div>
<?php echo $this->Html->script('plugins/footable/footable.all.min.js', ['block' => true]); ?>

<?php echo $this->Html->css('plugins/footable/footable.core.css', ['block' => true]); ?>

<?php echo $this->Html->script('plugins/staps/jquery.steps.min.js', ['block' => true]); ?>
<?php echo $this->Html->css('plugins/steps/jquery.steps.css', ['block' => true]); ?>

<?php echo $this->Html->script('plugins/validate/jquery.validate.min.js', ['block' => true]); ?>

<script type="text/javascript">
  $('#myModal2').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>
<script type="text/javascript">
  $('#myModal').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>
<script type="text/javascript">

    $(document).ready(function() {
        

        $('.footable').footable();

        $('.file-box').each(function() {
            animationHover(this, 'pulse');
        });

        $('#navcoder').hide();

    });

</script>

<script type="text/javascript">


    $(document).ready(function () {
        //$(document).idleTimer(20000); // tiempo de espera en el sistema 20 seg despues actualiza bus un segundo vale 1000
    });
    
    $(document).on( "idle.idleTimer", function(event, elem, obj){
        
        window.setTimeout(update_bus(),1000);
        
    });


</script>



<script type="text/javascript">
    function valNumeric(evt){
        evt = (evt) ? evt : ((window.event) ? window.event : null);
        if(
        ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
        ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
        ( evt.keyCode==8   ||
        evt.keyCode==9   ||
        evt.keyCode==13  ||
        evt.keyCode==16  ||
        evt.keyCode==17  ||
        evt.keyCode==36  ||
        evt.keyCode==35  ||
        evt.keyCode==46  ||
        evt.keyCode==37  ||
        evt.keyCode==39  ||
        evt.keyCode==110 ||
        evt.keyCode==119)
        ){
            //Lets that key value pass
        } else {
            if(document.all) {
                evt.returnValue = false
            } else evt.preventDefault()
        }
    }

    function valAlphaNumeric(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }

    function valAlphaNumericNbsp(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=48&&evt.keyCode<=57)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==32  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }

    function valAlpha(evt){
      evt = (evt) ? evt : ((window.event) ? window.event : null);
      if(
      ((evt.keyCode>=65&&evt.keyCode<=90)&&evt.shiftKey==false&&evt.altKey==false)||
      ((evt.keyCode>=96&&evt.keyCode<=105)&&evt.shiftKey==false&&evt.altKey==false) ||
      ( evt.keyCode==8   ||
      evt.keyCode==9   ||
      evt.keyCode==13  ||
      evt.keyCode==16  ||
      evt.keyCode==17  ||
      evt.keyCode==32  ||
      evt.keyCode==36  ||
      evt.keyCode==35  ||
      evt.keyCode==46  ||
      evt.keyCode==37  ||
      evt.keyCode==39  ||
      evt.keyCode==110 ||
      evt.keyCode==119 ||
      evt.keyCode==55 ||
      evt.keyCode==0)
      ){
        //Lets that key value pass
      } else {
        if(document.all) {
          evt.returnValue = false
        } else evt.preventDefault()
      }
    }
</script>