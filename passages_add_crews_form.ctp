<?php 
$horaINICIO=strtotime($hora_ini);
$horaFINAL=strtotime($programation->date_end->format('Y-m-d').' '.$programation->hour_end->format('H:i:s'));
if($horaINICIO!=$horaFINAL){ ?>

        <?php echo $this->Ajax->form(['type' => 'post',
                    'options' => [
                        'update'=>'nestable',
                        'url' => [
                            'controller' => 'sales',
                            'action' => 'passages_add_crews_save'
                        ],
                        'cols' => [ 
                            'label' => 2,
                            'input' => 7,
                            'error' => 0
                        ],
                        'complete'=>'$("#div_tripulation_action").html("");'
                        //'condition' => '$("#crewdateinit").val() != $("#crewdateend").val()'
                    ]
                ]);
            echo $this->Form->hidden('bus_id', ['value' => $bus_id]) ;
            echo $this->Form->hidden('programation_id', ['value' => $programation_id]) ;
            echo $this->Form->hidden('orden', ['value' => $orden]) ;
            echo $this->Form->input('crew_id', ['options' => $tripulacion,'label'=>'TRIPULACION','style'=>'font-size: 14px;height: 24px;', 'class'=>'search-select']) ;
            //echo $this->Form->hidden('date_time_programation', ['label' => 'FECHA-HORA PARTIDA DEL BUS','value'=>$programation->date->format('Y-m-d').' '.$programation->hour->format('H:i:s')]) ;
            echo $this->Form->input('datetime_start', ['label' => 'FECHA-HORA INICIO','id'=>'crewdateinit','style'=>'font-size: 14px;height: 24px;','value'=>$hora_ini]) ;
            echo $this->Form->input('datetime_end', ['label' => 'FECHA-HORA FINAL','id'=>'crewdateend','style'=>'font-size: 14px;height: 24px;','value'=>$hora_fin]) ;
            //echo $this->Form->input('datetime_end', ['label' => 'FECHA-HORA FINAL','id'=>'crewdateend']) ;
            echo $this->Form->submit('AGREGAR',['class'=>'btn btn-success  btn-block','onClick'=> "this.style.visibility= 'hidden';"]) ;
            echo $this->Form->end() ;

            //print_r($hora_fin);
        ?>
        
        <script type="text/javascript">
            
            $(function () {
                $('#crewdateinit').datetimepicker({
                    locale: 'es',
                    format: 'YYYY-MM-DD HH:mm:ss',
                    minDate : "<?php echo $hora_ini;?>",
                    sideBySide: true
                });
                <?php 
                    //para que escojan por lo menos 1 hora
                    $nuevahorafecha=strtotime($hora_ini);
                    $nuevahorafecha = strtotime("+1 hour",$nuevahorafecha);
                    $hora_fin_min=date('Y-m-d H:i:s', $nuevahorafecha );
                 ?>
                 $('#crewdateend').datetimepicker({
                    locale: 'es',
                    format: 'YYYY-MM-DD HH:mm:ss',
                    //minDate : "<?php //echo $hora_fin_min;?>",
                    <?php if($limit_hora==1){ ?>
                    maxDate : "<?php echo $programation->date_end->format('Y-m-d').' '.$programation->hour_end->format('H:i:s');?>",
                    <?php } ?>
                    sideBySide: true
                });
            });
            $(".search-select").chosen({}); //select2
            
        </script>

<?php }else{
    echo $this->Html->alert('Ya no se puede agregar mas choferes', 'danger');

    echo $this->Ajax->form(['type' => 'post',
                    'options' => [
                        'update'=>'nestable',
                        'url' => [
                            'controller' => 'sales',
                            'action' => 'passages_add_crews_save'
                        ],
                        'cols' => [ 
                            'label' => 2,
                            'input' => 7,
                            'error' => 0
                        ],
                        'complete'=>'$("#div_tripulation_action").html("");'
                        //'condition' => '$("#crewdateinit").val() != $("#crewdateend").val()'
                    ]
                ]);
            echo $this->Form->hidden('bus_id', ['value' => $bus_id]) ;
            echo $this->Form->hidden('programation_id', ['value' => $programation_id]) ;
            echo $this->Form->hidden('orden', ['value' => $orden]) ;
            echo $this->Form->input('crew_id', ['options' => $tripulacion,'label'=>'TRIPULACION','style'=>'font-size: 9px;height: 24px;']) ;
            //echo $this->Form->hidden('date_time_programation', ['label' => 'FECHA-HORA PARTIDA DEL BUS','value'=>$programation->date->format('Y-m-d').' '.$programation->hour->format('H:i:s')]) ;
            
            //echo $this->Form->input('datetime_end', ['label' => 'FECHA-HORA FINAL','id'=>'crewdateend']) ;
            echo $this->Form->submit('AGREGAR',['class'=>'btn btn-success  btn-block','onClick'=> "this.style.visibility= 'hidden';"]) ;
            echo $this->Form->end() ;

    } ?>