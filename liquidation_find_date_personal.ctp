<?//= $this->Html->script('jquery-2.1.1') ?>
<?php //echo $this->Html->script('plugins/dataTables/datatables.min');
      //echo $this->Html->css('plugins/dataTables/datatables.min');
 ?>
 <div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="clip-stats"></i>
            VENTA POR SALIDAS DE VIAJE      
        </div>
        <div class="panel-body" id='offices_ss'>
            <table class="table table-bordered" id="dataTables-example-passages-salidas">
                <thead>
                    <tr>
                        <th>FECHA VIAJE</th>
                        <th>HORA VIAJE</th>
                        <th>BUS</th>
                        <th>RUTA</th>
                        <th>IMPORTE</th>
                        <th>Piloto / Copiloto</th>
                        <th title="Capacidad del Bus">(C/BUS)</th>
                        <th title="Ventas del dia de hoy">(VDH)</th>
                        <th title="Ventas con anterioridad">(VCA)</th>
                        <th title="Total ocupados">(OCUP)</th>
                        <th title="total libres">LIBRES</th>

                        <?php if ($tipo=='1'): ?>
                        <th title="Imprimir detalle">TODO</th> <!--LIQUIDACION POR BUS-->
                        <?php endif ?>
                        
                    </tr>    
                </thead>
                <tbody>                            
                     <?php 
                        $total=0;
                        foreach($pass_data as $datos):
                            $programationID=$datos->programation->id;
                            $seatBuss = $datos['Buse']['seats'];
                            $seatOcupados = $datos['0']['seatFull'];
                            $cantidadSoles = $datos['0']['cantidad'];
                            $pilotoBuseID = $datos['Ticket']['buse_id'];
                            $pilotoRouteId = $datos['Ticket']['route_id'];
                            $pilotoFecha = $datos['Ticket']['dateroute'];
                            $pilotoHora = $datos['Ticket']['hour'];


                            $chofID1='';
                            $chofID2='';
                            $namePiloto1_1='-';
                            $namePiloto1_2='-';

                           
                        ?>
                        <tr>        
                            <td class='td1'><?php echo $datos->programation->date->format('d-m-Y');?></td>
                            <td class='td1'><?php echo $datos->programation->hour->format('h:i A');?></td>
                            <td class='td1'><?php echo $datos->programation->bus->plate;?></td>
                            <td class='td1'><?php echo $datos->programation->route->name;?></td>
                            <td class='td1'>S/. <? echo "<b>".number_format($datos->sum,2)."</b>";?></td>
                            <td class='td1'>
                            <?php
                            foreach ($crewsProgramation[$programationID] as $value) {
                                echo $value->crew->names.' '.$value->crew->surnames.'<b> /</b> ';
                            }    
                            ?>
                            </td>
                            <td class='td1'><? echo $datos->programation->bus->num_seats;?></td>
                            <td class='td1'><? echo $datos->contar;?></td>
                            <td class='td1'><? echo $countSaleAnterior[$programationID];?></td>
                            <td class='td1'><? echo $datos->contar+$countSaleAnterior[$programationID];?></td>
                            <td class='td1'><? echo $datos->programation->bus->num_seats-($datos->contar+$countSaleAnterior[$programationID]);?></td>
                             <!--/////////////
                                LIQUIDACION POR BUS
                            ////////////////-->
                            <?php if ($tipo=='1'): ?>
                            <td class="td1">    <!--matricial-->
                                <table>
                                    <tr>
                                        <td style="display:none;">
                                            <?php echo $this->Form->create(null, ['url'=>['controller' => 'sales', 'action' => 'liquidPorBusPrint'], 'target' => '_blank']); ?>
                                                <?php //echo $this->Form->input('print', ['value' => 'print']); ?>
                                                <?php echo $this->Form->hidden('fecha', ['value' => $datos->programation->date->format('Y-m-d')]); ?>
                                                <?php echo $this->Form->hidden('hour', ['value' => $datos->programation->hour->format('H:i:s')]); ?>
                                                <?php echo $this->Form->hidden('bus', ['value' => $datos->programation->buse_id]); ?>
                                                <?php echo $this->Form->hidden('prog', ['value' => $programationID]); ?>
                                                <?php echo $this->Form->hidden('tipo', ['value' => $tipo]); ?>
                                                <?php echo $this->Form->hidden('file', ['value' => '0']); //matricial?>
                                                <?php echo $this->Form->hidden('doc', ['value' => '0']); //[Boleta & Factura(1)]/[all(0)] ?>
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                            <?php echo $this->Form->end(); ?>
                                        </td>
                                        <td>&nbsp;&nbsp;</td>
                                        <td>
                                            <?php echo $this->Form->create(null, ['url'=>['controller' => 'sales', 'action' => 'liquidPorBusPrint'], 'target' => '_blank']); ?>
                                                <?php //echo $this->Form->input('print', ['value' => 'print']); ?>
                                                <?php echo $this->Form->hidden('fecha', ['value' => $datos->programation->date->format('Y-m-d')]); ?>
                                                <?php echo $this->Form->hidden('hour', ['value' => $datos->programation->hour->format('H:i:s')]); ?>
                                                <?php echo $this->Form->hidden('bus', ['value' => $datos->programation->buse_id]); ?>
                                                <?php echo $this->Form->hidden('prog', ['value' => $programationID]); ?>
                                                <?php echo $this->Form->hidden('tipo', ['value' => $tipo]); ?>
                                                <?php echo $this->Form->hidden('file', ['value' => '1']); //pdf?>
                                                <?php echo $this->Form->hidden('doc', ['value' => '1']); //[Boleta & Factura(1)]/[all(0)] ?>
                                                <?php echo $this->Form->input('porcentaje',array('size'=>'3','required'=> 'required','class'=>'form-control input-sm','placeholder'=>'%'));?>
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-file-pdf-o"></i>
                                                    </button>
                                            <?php echo $this->Form->end(); ?>
                                        </td>
                                    </tr>
                                </table>                                
                            </td>
                            <?php endif ?>
                            <!--/////////////
                                end LIQUIDACION POR BUS
                            ////////////////-->
                        </tr>
                        
                        <?php 
                        $total=$total+$datos->sum;
                        endforeach;
                        ?>

                        <tr>
                            <td colspan='4'><div style='text-align: right'>TOTAL VENTAS :</div></td><td><b><?=number_format($total,2);?></a></td><td></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-stats"></i>
                    ENCOMIENDAS    
                    
                    <span class="pull-right">
                        <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_detail_commends'),'target'=>'hidden_iframe_liquidation','id'=>'form_commends','style'=>'float:left;padding-left:10px;')); ?>
                            <button class="btn btn-app btn-warning btn-xs" id="printer">
                                <i class="icon-save"></i>
                                IMPRIMIR DETALLES
                            </button>   
                            <?php
                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                            
                            ?>
                            &nbsp;&nbsp;
                            <?php echo $this->Form->end(); ?>

                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_detail_commends_a4'),'target'=>'hidden_iframe_liquidation','id'=>'form_commends','style'=>'float:left;')); ?>
                            <button class="btn btn-app btn-warning btn-xs" id="printer">
                                <i class="icon-save"></i>
                                MATRICIAL 
                            </button>   
                            <?php
                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                            
                            ?>
                            &nbsp;&nbsp;
                            <?php echo $this->Form->end(); ?>
                            

                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_detail_commends_pdf'),'target'=>'_blank','id'=>'form_commends','style'=>'float:left;')); ?>
                            <button class="btn btn-app btn-warning btn-xs" id="printer">
                                <i class="icon-save"></i>
                                PDF 
                            </button>   
                            <?php
                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                            
                            ?>

                            <?php echo $this->Form->end(); ?>
                    </span>
                                      
                </div>
                <div class="panel-body" id='offices_ss'>
                    <table class="table table-bordered" id="dataTables-example-commends">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Num-Doc</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>    
                        </thead>
                        <tbody>                            
                        <?php 
                        //debug($prep_orig);
                        $total_commends=0;
                        foreach ($ventas_encomiendas as $value) {
                            $id=$value->id;
                            $numDoc=$value->serie.'-'.$value->number;
                            $Total=number_format($value->total,2);
                            if ($value->canceled=='1') {
                                echo "<tr class='danger'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>ANULADO</td></tr>";
                            }elseif ($value->prepaid=='0') {
                                echo "<tr class='success'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>PAGO DESTINO $value->destino</td></tr>";    
                            }elseif ($value->not_manif==1) {
                                echo "<tr class='info'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>PAGO DE $value->origen -> ".$prep_orig[$id]->id." </td></tr>";    
                                $total_commends=$total_commends+$value->total;
                            }else{
                                echo "<tr><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td></td></tr>";
                                $total_commends=$total_commends+$value->total;
                            }
                            
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>        
</div>
<div class="col-sm-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-stats"></i>
                    PASAJES        
                    <span class="pull-right">
                        <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_detail_passages'),'target'=>'hidden_iframe_liquidation','id'=>'form_commends')); ?>
                            <button class="btn btn-app btn-warning btn-xs" id="printer">
                                <i class="icon-save"></i>
                                IMPRIMIR DETALLES PASAJES
                            </button>   
                            <?php
                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                            
                            ?>

                            <?php echo $this->Form->end(); ?>
                    </span>                
                </div>
                <div class="panel-body" id='offices_ss'>
                    <table class="table table-bordered" id="dataTables-example-passages">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Num-Doc</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>    
                        </thead>
                        <tbody>                            
                        <?php 
                        $total_pasajes=0;
                        $total_pasajes_yape=0;
                        $total_pasajes_credito=0;
                        foreach ($ventas_pasajes as $value) {
                            $id=$value->id;
                            $numDoc=$value->serie.'-'.$value->number;
                            $Total=number_format($value->price,2);
                            if ($value->cancel_sale=='1') {
                                echo "<tr class='danger'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>ANULADO</td>
                                <td></td></tr>";
                            }elseif ($value->type_payment==0) {
                                echo "<tr class='success'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>CREDITO</td>
                                <td></td></tr>";
                                $total_pasajes=$total_pasajes+$Total;
                                $total_pasajes_credito=$total_pasajes_credito+$value->price;
                            }elseif ($value->type_payment==3) {
                                echo "<tr class='success'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>YAPE</td>
                                <td></td></tr>";
                                $total_pasajes=$total_pasajes+$Total;
                                $total_pasajes_yape=$total_pasajes_yape+$value->price;
                            }elseif ($value->postpone_sales_free>0) {
                                echo "<tr class='info'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>FECHA LIBRE</td>
                                <td></td></tr>";
                                $total_pasajes=$total_pasajes+$value->price;
                            }elseif ($value->postpone_sale_id>0) {
                                echo "<tr class='warning'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>POSTERGADO</td>
                                <td></td></tr>";
                                $total_pasajes=$total_pasajes+$value->price;
                            }else{
                                echo "<tr><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>-</td>
                                <td></td></tr>";
                                $total_pasajes=$total_pasajes+$value->price;
                            }
                            
                            
                        }

                        
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>        
</div>

<div class="col-sm-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-stats"></i>
                    INGRESOS EXTRA    
                    
                    <span class="pull-right">
                        <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_detail_incomes'),'target'=>'hidden_iframe_liquidation','id'=>'form_commends')); ?>
                            <button class="btn btn-app btn-warning btn-xs" id="printer">
                                <i class="icon-save"></i>
                                IMPRIMIR INGRESOS EXTRA
                            </button>   
                            <?php
                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                            
                            ?>

                            <?php echo $this->Form->end(); ?>
                    </span>
                                      
                </div>
                <div class="panel-body" id='offices_ss'>
                    <table class="table table-bordered" id="dataTables-example-incomes">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Num-Doc</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>    
                        </thead>
                        <tbody>                            
                        <?php 
                        $total_excesos=0;
                        foreach ($excesos as $value) {
                            $id=$value->id;
                            $numDoc=$value->serie.'-'.$value->number;
                            $Total=number_format($value->total,2);
                            if ($value->canceled=='1') {
                                echo "<tr class='danger'><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td>ANULADO</td></tr>";
                            }else{
                                echo "<tr><td>$id</td>
                                <td>$numDoc</td>
                                <td>$Total</td>
                                <td></td></tr>";
                                $total_excesos=$total_excesos+$Total;
                            }
                            
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>        
</div>
<?php 
$total_gastos=0;
foreach ($gastos as $value) {
    //$Total=number_format($value->amount,2);
    $total_gastos=$total_gastos+$value->amount;
} 
$total_excesos=0;
$cant_excesos=0;
foreach ($excesos as $value) {
    $cant_excesos=$cant_excesos+1;
    if($value->canceled!='1') {
        //$Total=number_format($value->total,2);
        $total_excesos=$total_excesos+$value->total;
    }
}
?>






<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-stats"></i>
                    RESUMEN DE VENTAS SEGUN RANGO DE FECHAS                
                </div>
                <div class="panel-body" id='offices_ss'>
                    <table class="table table-bordered" id="resumen">
                        <thead>
                            <tr>
                                <th>SISTEMA</th>
                                <th>DOCUMENTO</th>
                                <th>INICIO</th>
                                <th>FINAL</th>
                                <th>CANT</th>
                                <th>IMPORTE</th>
                            </tr>    
                        </thead>
                        <tbody>                            
                            <?php 
                            $sum_cantidad=0;
                            $sum_totales=0;
                            foreach ($resumen_pas as $key => $value) {
                                echo '<tr>';
                                    echo '<td>PASAJES</td>';
                                    echo '<td>'.$value->serie.'</td>';
                                    echo '<td>'.$value->inicial.'</td>';
                                    echo '<td>'.$value->final.'</td>';
                                    echo '<td>'.$value->cantidad.'</td>';
                                    echo '<td>'.number_format($resumen_pas_total[$key]->toArray()[0]->total,2).'</td>';
                                echo '</tr>';
                                $sum_totales=$sum_totales+$resumen_pas_total[$key]->toArray()[0]->total;
                                $sum_cantidad=$sum_cantidad+$value->cantidad;
                            }

                            foreach ($resumen_enc as $key => $value) {
                                echo '<tr>';
                                    echo '<td>ENCOMIENDAS</td>';
                                    echo '<td>'.$value->serie.'</td>';
                                    echo '<td>'.$value->inicial.'</td>';
                                    echo '<td>'.$value->final.'</td>';
                                    echo '<td>'.$value->cantidad.'</td>';
                                    echo '<td>'.number_format($resumen_enc_total[$key]->toArray()[0]->total,2).'</td>';
                                echo '</tr>';
                                $sum_totales=$sum_totales+$resumen_enc_total[$key]->toArray()[0]->total;
                                $sum_cantidad=$sum_cantidad+$value->cantidad;
                            }
                                echo '<tr>';
                                    echo '<td>EXCESOS</td>';
                                    echo '<td>-</td>';
                                    echo '<td>-</td>';
                                    echo '<td>-</td>';
                                    echo '<td>'.$cant_excesos.'</td>';
                                    echo '<td>'.number_format($total_excesos,2).'</td>';
                                echo '</tr>';
                             ?>
                             <tr>
                                 <td colspan="4" style="text-align: right;">TOTALES</td>
                                 <td><?php echo $sum_cantidad; ?></td>
                                 <td><?php echo number_format($sum_totales+$total_excesos,2); ?></td>
                             </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="clip-pie"></i>
                            RESUMEN
                        </div>
                        <div class="panel-body"><!--dotcommends-->
                            <table class="table table-bordered dataTables-example-passages">
                                <tbody>                            
                                    <tr class="info ">
                                        <td>ENCOMIENDAS</td>
                                        <td>S/. <?php echo number_format($total_commends,2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr class="info ">
                                        <td>PASAJES TOTAL</td>
                                        <td>S/. <?php echo number_format($total_pasajes,2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr class="info ">
                                        <td>EXCESOS</td>
                                        <td>S/. <?php echo number_format($total_excesos,2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr class="success ">
                                        <td>PASAJES YAPE</td>
                                        <td>S/. <?php echo number_format($total_pasajes_yape,2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>GASTOS</td>
                                        <td>S/. <?php echo number_format(-1*$total_gastos,2); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr class="info">
                                        <th>TOTAL LIQUIDACION</th>
                                        <th>S/. <?php echo number_format($total_commends+$total_pasajes+$total_excesos-$total_pasajes_credito-$total_gastos,2); ?></th>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                                <center>
                                    <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print'),'target'=>'hidden_iframe_liquidation','id'=>'form_commends')); ?>
                                    <button class="btn btn-app btn-success btn-mini btn-rounded" id="printer">
                                        <i class="icon-save"></i>
                                        IMPRIMIR LIQUIDACION (ticket)
                                    </button>   
                                    <?php
                                    echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                    echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                    echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                    echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                    echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                    
                                    ?>

                                    <?php echo $this->Form->end(); ?>
                                    <br>
                                    <div class="row">
                                        <h2>FORMATO 1</h2>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_pdf1'),'target'=>'_black','id'=>'form_commends')); ?>
                                            <button class="btn btn-app btn-primary btn-xs btn-rounded" id="printer">
                                                <i class="icon-save"></i>
                                                Liquidacion
                                            </button>   
                                            <?php
                                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_point'),'target'=>'_black','id'=>'form_commends')); ?>
                                            <button class="btn btn-app btn-primary btn-xs btn-rounded" id="printer">
                                                <i class="icon-save"></i>
                                                Liquidacion en Matricial
                                            </button>   
                                            <?php
                                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_pdf1_detail'),'target'=>'_black','id'=>'form_commends')); ?>
                                            <button class="btn btn-app btn-primary btn-xs btn-rounded" id="printer">
                                                <i class="icon-save"></i>
                                                Detalle de ventas
                                            </button>   
                                            <?php
                                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                    </div>
                                    <h2>FORMATO 2</h2>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_pdf2'),'target'=>'_black','id'=>'form_commends')); ?>
                                            <button class="btn btn-app btn-primary btn-xs btn-rounded" id="printer">
                                                <i class="icon-save"></i>
                                                Liquidacion
                                            </button>   
                                            <?php
                                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'liquidation_print_pdf2_detail'),'target'=>'_black','id'=>'form_commends')); ?>
                                            <button class="btn btn-app btn-primary btn-xs btn-rounded" id="printer">
                                                <i class="icon-save"></i>
                                                Detalle de pasajes
                                            </button>   
                                            <?php
                                            echo $this->Form->hidden('date_hour_ini',['value'=>$dateConsultaINI]);
                                            echo $this->Form->hidden('date_hour_fin',['value'=>$dateConsultaFIN]);
                                            echo $this->Form->hidden('user_id',['value'=>$user_id]);
                                            echo $this->Form->hidden('agencia_id',['value'=>$AgencesLogin->id]);
                                            echo $this->Form->hidden('tipo',['value'=>$tipo]);
                                            echo $this->Form->end();
                                            ?>
                                        </div>
                                    </div>

                                   
                                </center>
                           


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end -->
    </div>        
</div>


<script>
        $(document).ready(function(){

            //datatables
            
            $('#dataTables-example-commends').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                ordering: false,
                buttons: [
                    {extend: 'excel', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_ENCOMIENDAS"},
                    {extend: 'pdf', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_ENCOMIENDAS"},
                    
                ]

            });
            $('#dataTables-example-passages').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                ordering: false,
                buttons: [
                    {extend: 'excel', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_PASAJES"},
                    {extend: 'pdf', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_PASAJES"},
                    
                ]

            });
            
            $('#dataTables-example-incomes').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                ordering: false,
                buttons: [
                    {extend: 'excel', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_PASAJES"},
                    {extend: 'pdf', title: "<?//=$usuario;?>_(<?//=$dateConsultaINI.'-'.$dateConsultaFIN;?>)_PASAJES"},
                    
                ]

            });
        
            
            
        });


       
    </script>