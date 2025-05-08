<?php echo $numeracion['numeration']['document'].' <i class="fa fa-arrow-circle-right"></i> '.$numeracion['numeration']['serie'].'-'.str_pad($numeracion['numeration']['number'],7,'0',STR_PAD_LEFT); ?>

<?php  
//echo $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-pencil')).' &nbsp; Corregir correlativo',['controller'=>'sales','action' => 'passages_numeration_edit',$numeracion['id'] ], ['data-toggle'=>"modal",'data-target'=>"#myModal",'id'=>'boton','class'=>'btn btn-xs btn-primary','escape' =>false]) ;
?>