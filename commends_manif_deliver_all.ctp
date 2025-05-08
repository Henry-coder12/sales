
<table class="table table-bordered">
    <thead>
    <tr>
        <th>NUM MANIFIESTO</th>
        <th>NUMERO GUIA</th>
        <th>ORIGEN</th>
        <th>DESTINO</th>
        <th>BUS</th>
        <th>CONDUCTORES</th>
        <th>FECHA y HORA envio</th>
        <th>CANT</th>
        <th>...</th>
        
    </tr>
    </thead>
    <tbody>
    <?php 
    //debug($datos);
    foreach ($datos as $value) { ?>
    <tr>
        <td><?php echo $value['id'];?></td>
        <td><?php echo $value['programation']['serie'].'-'.$value['programation']['number'];?></td>
        <td class="client-status"><?php echo $origen[$value['id']]['ubigeo']['cp'];?></td>
        <td><?php echo $destino[$value['id']]['ubigeo']['cp'];?></td>
        <td><a data-toggle="tab" href="#contact-1" class="client-link"><?php echo $value['programation']['bus']['plate'];?></a></td>
        <td>
            <?php foreach ($countDetailCrew[$value['id']] as $crew) {
                echo $crew['crew']['surnames'].' '.$crew['crew']['names']." / ";
            } ?>
        </td>
        <td><b><?php echo $value['programation']['date']->format('d-m-Y').' a las '.$value['programation']['hour']->format('h:i a');?></b></td>
        <td><?php echo $countListInManifie[$value['id']];?></td>
        <td class="client-status">
        <?php 
        echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-plus')).' &nbsp; ver lista', ['controller' => 'sales','action' => 'commends_manif_list_detail',$value['id']], ['data-toggle'=>'modal','data-target'=>'#myModaDetailManifes','class'=>'btn btn-xs btn-success','escape' => false]);
        //echo $this->Ajax->link('<i class="fa fa-arrow-circle-left"></i> enviar',['controller' => 'programations', 'action' => 'a_enviados', $value->id ],['datos'=>['detail_commend_id'=>$value['id']],'update' => 'transacciones', 'indicator' => 'cargando','class'=>'label label-primary','escape'=>false,'confirm'=>'Estas seguro de anular la venta?']);?>
        </td>
    </tr>
    <? } ?>
    </tbody>
</table>


<div id="myModaDetailManifes" class="modal inmodal in" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceInRight">
        
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#myModaDetailManifes').on('hide.bs.modal', function(e) {
    $(this).removeData('bs.modal');
  });
</script>
