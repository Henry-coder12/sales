<h6>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>FECHA CREACION</th>
        <th>TIPO</th>
        <th>NUMERO</th>
        <th>CONSIGNATARIO</th>
        <th>CANT</th>
        <th>DICE CONTENET</th>
        <th>PRECIO</th>
        <th>TOTAL</th>
        <th>ORIGEN</th>
        <th>DESTINO</th>
        <th>...</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($lista as $value) { 
            //debug($value);?>
    <tr>
        <td><?php echo $value->commend->created->format('d-m-Y h:i a');?></td>
        <td class="contact-type"><?php if($value['commend']['doc']=='01') {echo 'FACTURA';}elseif($value['commend']['doc']=='03'){echo 'BOLETA';}else{echo 'TICKET';}?></td>
        <td><a data-toggle="tab" href="#contact-1" class="client-link">
            <?php 
            if ($value['commend']['prepaid']=='1') {
                echo $value['commend']['serie'].'-'.str_pad($value['commend']['number'],7,'0',STR_PAD_LEFT);
            }else{
                if ($value['commend']['agence_id_prepaid']==null) {
                    echo str_pad($value['commend']['id'],7,'0',STR_PAD_LEFT);
                }else{
                    echo $value['commend']['serie'].'-'.str_pad($value['commend']['number'],7,'0',STR_PAD_LEFT);
                }
            }
            ?>
            
            </a></td>
        <td><?php echo $value['commend']['consig_name']?></td>
        <td><?php echo $value['quantity'];?></td>
        <td><?php echo $value['content'];?></td>
        <td>S/. <?php echo number_format($value['price'],2);?></td>
        <td>S/. <?php echo number_format($value['total'],2);?></td>
        <td><b> <?php echo $value['commend']['origen'];?> </b></td>
        <td><b> <?php echo $value['commend']['destino'];?> </b></td>
        <td class="client-status">
        <?php //echo $this->Ajax->link('...',['controller' => 'programations', 'action' => 'a_enviados', $value->id ],['datos'=>['detail_commend_id'=>$value['id']],'update' => 'transacciones', 'indicator' => 'cargando','class'=>'label label-primary','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);?>
        </td>
    </tr>
    <? } ?>
    </tbody>
</table>
</h6>