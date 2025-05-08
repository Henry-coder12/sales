<?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
<?php echo $this->Html->script('inspinia.js'); ?>
<br>
<div class="wrapper">
            <div id="transacciones"></div>
            <div class="row">
                    <div class="panel-heading col-sm-12" style="padding:16px;">
                         
                        <div class="form-group">
                            <div class="col-sm-2">
                                <?php echo $this->Ajax->form(['options' => ['update'=>'manifestos','url' => ['action' => 'commends_manif_deliver_all'], 'class'=>'form-inline', 'indicator'=>'cargando']]);?>   
                                <p style="margin-bottom: 0px;">
                                    Numero de Manifiesto/Guia
                                </p>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="find" placeholder='123/001-3456'>
                                    <span class="input-group-addon"> <i class="fa fa-search"></i> </span>
                                </div>
                                <?php echo $this->Form->end();?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $this->Ajax->form(['options' => ['update'=>'filterliquidation_x_pagar','url' => ['action' => 'liquidationFilterPorPagar'], 'class'=>'form-inline', 'indicator'=>'cargando']]);?>   
                                    <p style="margin-bottom: 0px;">
                                        Fecha envio de emcomienda
                                    </p>
                                    <div class="input-group">
                                        <input type="text" class="form-control date input-sm input-mask-date" name="date_fin" value='<?php echo date("Y-m-d")?>' required>
                                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <div class="input-group clockpicker"  data-autoclose="true">
                                        <input type="text" class="form-control"  name="hour_fin" value="<?php echo "23:59"; ?>" required>
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <div class="col-sm-1">
                                        <p style="margin-bottom: 0px;">
                                            .
                                        </p>
                                        <?php echo $this->Form->submit('Buscar',['class'=>'btn btn-blue']);?>
                                    </div>
                                <?php echo $this->Form->end();?>
                            </div>

                            <div class="col-sm-3">
                                <p style="margin-bottom: 0px;">
                                    Seleccione PERSONAL
                                </p>
                                <select class="form-control" name="user_id" style="width:250px;">
                                    <?php 
                                    
                                    foreach ($users as $value) {
                                        $id=$value->id;
                                        $name=$value->surnames.' '.$value->names;                      
                                        echo "<option value='$id'>$name </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <p style="margin-bottom: 0px;">
                                    Seleccione OFICINA
                                </p>
                                <select class="form-control" name="agence_id" style="width:250px;">
                                    <?php 
                                    
                                    foreach ($Agencias as $value) {
                                        $id=$value->id;
                                        $name=$value->code.' - '.$value->name;                      
                                        echo "<option value='$id'>$name </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            
                        </div>
                        
                </div>
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h2>LISTA DE PROXIMOS MANIFIESTOS</h2>
                            <p>
                                Lista de manifiestos con destino a su Oficina.
                            </p>
                            <div class="">
                                     <script type="text/javascript">
                                        <?php echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'commends_manif_deliver_all'),'update' => 'manifestos','indicator' => 'cargando')); ?>
                                    </script>
                                    <div class="full-height-scroll2" id="manifestos">
                                        
                                    </div>
                                
                           

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="ibox">
                        
                    </div>
                </div>
                
            </div>

        </div>