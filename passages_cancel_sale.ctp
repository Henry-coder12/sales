<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Num Doc</th>
        <th>Nombre</th>
        <th>Fecha Viaje</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Usuario Atendido</th>
        <th>Acciones</th>

    </tr>
    </thead>
    <tbody>
        <?php 
        $contar=1;
        
        foreach ($sales as $value) {
            if($value->locked==1 and $value->cancel_sale==0){ //si esta bloqueado
                echo "<tr>";
                    echo "<td>$contar</td>";
                    echo "<td>-----------------------</td>";
                    echo "<td>-----------------------</td>";
                    echo "<td>-----------------------</td>";
                    echo "<td>-----------------------</td>";
                    echo "<td>BLOQUEADO POR =========> </td>";
                    echo "<td>".$value->dotsale->user['names'].', '.$value->dotsale->user['surnames']."<td>";
                echo "</tr>";
            }elseif($value->locked==0 and $value->cancel_sale==0){ // si esta vendido 
                echo "<tr>";
                    echo "<td>$contar</td>";
                    echo "<td>".$value->client->document."</td>";
                    echo "<td>".$value->client->surnames.' '.$value->client->names."</td>";
                    echo "<td>".$value->date_travel.' - '.$value->hour_travel->format("g:i a")."</td>";
                    echo "<td>".$value->origin['cp']."</td>";
                    echo "<td>".$value->destine['cp']."</td>";
                    echo "<td>".$value->dotsale->user['names'].', '.$value->dotsale->user['surnames']."</td>";
                    echo "<td> S/. ".number_format($value->price,2)."</td>";
                    echo "<td>";
                    
                    echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

                    
                    echo "</td>";
                
                echo "</tr>";
            }elseif($value->locked==0 and $value->cancel_sale==1) { // si esta anulado
                echo "<tr class='danger'>";
                echo "<td>$contar</td>";
                echo "<td>".$value->id."</td>";
                echo "<td>".$value->client->document."</td>";
                echo "<td>".$value->client->surnames.' '.$value->client->names."</td>";
                echo "<td>".$value->date_travel.' - '.$value->hour_travel->format("g:i a")."</td>";
                echo "<td>".$value->origin['cp']."</td>";
                echo "<td>".$value->destine['cp']."</td>";
                echo "<td>".$value->dotsale->user['names'].', '.$value->dotsale->user['surnames']."</td>";
                echo "<td> S/. ".number_format($value->price,2)."</td>";
                echo "<td>";
                echo "<div class='btn btn-danger btn-xs'>ANULADO</div>";
                //echo $this->Ajax->link($this->Html->tag('i',' ',['class' => 'fa fa-times']),['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-danger btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']).' ';

                //echo $this->Ajax->link('Postergar',['controller' => 'sales', 'action' => 'passages_cancel_sale', $value->id ],['update' => 'contenidoseatdetail', 'indicator' => 'cargando','class'=>'btn btn-success btn-xs btn-rounded','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);

                
                echo "</td>";
            
            echo "</tr>";
        }
            
            $contar++;
        } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        //alert('asiento bloqueado por otro usuario');
        window.setTimeout(update_bus(),1000);
    });
</script>