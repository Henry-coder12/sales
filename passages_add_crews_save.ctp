<ol class="dd-list">
    <?php foreach ($lista as $value): 
            if ($value['crew']['type']=='1') {
                $tipo=$value->crew->num_licence;
            }else{
                $tipo='Terramoso(a)';
            }

            ?>
        <li class="dd-item row" data-id=<?=$value->id?>  style="font-size: 13px;" name="agences_list">
            <div class="col-xs-5"><i class="fa fa-caret-right"></i> <?=$value['crew']['surnames'].' '.$value['crew']['names'].' ( '.$tipo.' )Lic.: <code>'.$value['crew']['num_licence'].'</code>';?></div>
            <div class="col-xs-1"><div class="col-xs-12"><b><?=$value->orden;?></b></div></div>
            <div class="col-xs-2"><div class="col-xs-12"><?=$value->datetime_start->format('Y-m-d g:i a');?></div></div>
            <div class="col-xs-2"><div class="col-xs-12"><?=$value->datetime_end->format('Y-m-d g:i a');?></div></div>
            <div class="col-xs-1">
                <div class="col-xs-12">
                    <?php 
                    if ($orden_del==$value->orden or $value->orden==0) {
                        echo $this->Ajax->link('Eliminar',[ 'controller' => 'sales', 'action' => 'passages_detail_crews_del'],['datos'=>['detailcrews_id'=>$value->id,'programation_id'=>$programation_id],'update' => 'nestable','class'=>'btn btn-xs btn-danger']); 
                    }
                    ?>
                </div>

                <div class="col-xs-12" style="display: none;">
                    <input type="text" id="detailcrewid<?=$value->id?>" class="form-control" value="<?=$value->hours?>">
                </div>
                
            </div>
        </li>
    <?php endforeach; ?>
</ol>