<?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
<?php echo $this->Html->script('inspinia.js'); ?>
<br>
<div class="wrapper">
            <div id="transacciones"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h2>LISTA DE ENCOMIENDAS SIN ENTREGAR</h2>
                            <p>
                                Encomiendas que aun estan en almacen.
                            </p>
                            <div class="">
                                    <script type="text/javascript">
                                        <?php echo $this->Ajax->remoteFunction(array('url' => array( 'controller' => 'sales', 'action' => 'commends_list_entregar_all'),'update' => 'recibidos','indicator' => 'cargando')); ?>
                                    </script>
                                    <div class="full-height-scroll2" id='recibidos'>
                                            ...
                                    </div>
                                
                           

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>