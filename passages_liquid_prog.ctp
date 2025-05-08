<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
    	<div class="col-md-4">
    		<h4><i class="fa fa-bus"></i> Asientos <a class="text-navy" style="font-size:25px;text-decoration:underline;"><?=$fndProg[0]->seats;?></a></h4>
    	</div>
    	<div class="col-md-4">
    		<h4><i class="fa fa-circle"></i> Vendidos <a class="text-navy" style="font-size:25px;text-decoration:underline;"><?=$fndProg[0]->contar;?></a></h4>
    	</div>
    	<div class="col-md-4">
    		<h4><i class="fa fa-circle-o"></i> Libres <a class="text-navy" style="font-size:25px;text-decoration:underline;"><?=($fndProg[0]->seats)-($fndProg[0]->contar);?></a></h4>
    	</div>
    </div>
	<div class="row">
    	<div class="col-lg-12">
    		<div class="tabs-container">
    			<ul class="nav nav-tabs" role="tablist">
	                <li><a class="nav-linK" data-toggle="tab" href="#tab-1"> V. POR USUARIO</a></li>
	                <li><a class="nav-link active" data-toggle="tab" href="#tab-2"> V. POR DESTINO</a></li>
	                <li><a class="nav-link" data-toggle="tab" href="#tab-3"> V. POR OFICINA</a></li>
	            </ul>
	            <div class="tab-content table-responsive">
                    <div role="tabpanel" id="tab-1" class="tab-pane">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>EMITIDO</th>
                                    <th>RESERVADO</th>
                                    <!--<th>P.VENDIDO</th>-->
                                    <th>POSTERGADO</th>
                                    <th>ANULADO</th>
                                </tr>
                            <?php foreach ($fndProgUser as $value): 
                                $reserveVal = ($value->reserve==0) ? '' : $value->reserve;
                                $postergVal = ($value->posterga==0) ? '' : $value->posterga;
                                $anulaVal   = ($value->anula==0) ? '' : $value->anula;
                                ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?= strtoupper($value->user);?></td>
                                    <td style="text-align:center; font-size:20px;" class="text-navy"><?= $value->contar; ?></td>
                                    <td style="text-align:center; font-size:20px;" class="text-navy"><?=$reserveVal;?></td>
                                    <!--<td>&nbsp;</td>-->
                                    <td style="text-align:center; font-size:20px;" class="text-navy"><?=$postergVal;?></td>
                                    <td style="text-align:center; font-size:20px;" class="text-navy"><?=$anulaVal;?></td>
                                </tr>
                            <?php endforeach ?>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" id="tab-2" class="tab-pane active">
                        <div class="panel-body">
                            <!--<center><strong>Ventas por DESTINOS</strong></center>-->
                            <?php //debug($fndProg); ?>
                            <div class="row">
                                <?php foreach ($fndProgDestine as $value): 
                                    $colorUbi = $value->Ubigeos['color'];
                                    ?>
                                    <div class='col-md-4'>
                                        <h5>
                                            <span style="background-color: <?=$colorUbi;?>; padding:3px 10px 3px 10px; border-radius: 5px;">&nbsp</span>&nbsp;
                                            <span style="font-size: 16px; text-decoration: underline;"><?= str_pad($value->contar, 2, '0', STR_PAD_LEFT);?></span>&nbsp;
                                            <span class="text-success"><?= $value->Ubigeos['cp'];?></span></h5>
                                    </div>
                                <?php endforeach ?>                           
                            </div>
                        </div>
                    </div>
                     <div role="tabpanel" id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach ($fndProgOrigen as $value): 
                                    ?>
                                    <div class='col-md-4'>
                                        <h5>
                                            <span style="font-size: 16px; text-decoration: underline;"><?= str_pad($value->contar, 2, '0', STR_PAD_LEFT);?></span>&nbsp;
                                            <span class="text-success"><?= $value->abrev;?></span></h5>
                                    </div>
                                <?php endforeach ?>                           
                            </div>
                        </div>
                    </div>
                </div><!--TAB CONTENT-->
    		</div>
    	</div>
    </div>
</div>