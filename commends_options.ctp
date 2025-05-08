<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
    <i class="fa fa-bus"></i> OPERACIONES <i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu dropdown-alerts">
    <li>
    	<?php echo $this->Html->link('<div><i class="fa fa-list-alt"></i> VENTAS </div>',['controller' => 'sales', 'action' => 'commends'],['indicator' => 'loading','update' => 'content_sales','escape'=>false]);?>
    </li>
    <li class="divider"></li>
    <li>
        <?php echo $this->Html->link('<div><i class="fa fa-th-list"></i> MANIFIESTOS </div>',['controller' => 'sales', 'action' => 'commendsListManifie'],['indicator' => 'loading','update' => 'content_sales','escape'=>false]);?>
    </li>
    <li class="divider"></li>
    <li>
    	<?php echo $this->Ajax->link('<div><i class="fa fa-list-alt"></i> SIN ENVIAR</div>',['controller' => 'sales', 'action' => 'commends_list_all'],['indicator' => 'loading','update' => 'content_sales','escape'=>false]);?>
    </li>
    <li class="divider"></li>
    <li>
        <?php echo $this->Ajax->link('<div><i class="fa fa-list-alt"></i> SIN RECOGER</div>',['controller' => 'sales', 'action' => 'commends_list_get'],['indicator' => 'loading','update' => 'content_sales','escape'=>false]);?>
    </li>
    <li class="divider"></li>
    <li>
    	<?php echo $this->Ajax->link('<div><i class="fa fa-share-square-o"></i> RECIBIR MANIFIESTOS</div>',['controller' => 'sales', 'action' => 'commends_list_deliver'],['indicator' => 'loading','update' => 'content_sales','escape'=>false]);?>
    </li>
</ul>
