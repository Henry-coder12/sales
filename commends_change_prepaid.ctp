<?php 
if ($value=='true') {
 	echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'commends_ticket'),'target'=>'hidden_iframe')); ?>
	<button class="btn btn-app btn-primary btn-mini" id="printer"><i class="icon-save"></i>TICKET</button>
	<?php
 }else{
 	echo $this->Form->create(null, array('url' => array('controller' => 'sales', 'action' => 'commends_print'),'target'=>'hidden_iframe')); ?>
	<button class="btn btn-app btn-primary btn-mini" id="printer"><i class="icon-save"></i>IMPRIMIR</button>
	<?php
 }
  ?>