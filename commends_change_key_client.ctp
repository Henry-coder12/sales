<div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h3 class="modal-title">CAMBIO DE CLAVE </h3>
    <small class="font-bold">ID DOC: <div class="label" style="font-size: 10px;"><?php echo $commend['id']; ?></div> NUM DOC: <div class="label" style="font-size: 10px;"><?php echo $commend['serie'].'-'.$commend['number']; ?></small>
</div>
<div class="modal-body" >
        
            <div class="p-w-md m-t-sm">
                <div class="row text-center">
                    <h3><?php echo $commend->created; ?></h3>
                </div>
            </div>
            <div id="change_clave">  
                
                        <?php 
                        //debug($commend);
                        echo $this->Form->create(null, ['onsubmit'=>'return false;','id'=>'formkey',
                            'horizontal' => true,
                            'cols' => [ 
                                    'label' => 3,
                                    'input' => 4,
                                    'error' => 4
                                
                            ]
                        ]);
                        /*echo $this->Ajax->form(['type' => 'post',
                                'options' => [
                                    'update'=>'change_clave',
                                    'url' => [
                                        'controller' => 'sales',
                                        'action' => 'commends_change_key_save'
                                    ],
                                    'horizontal' => true,
                                    'cols' => [ 
                                        'label' => 3,
                                        'input' => 4,
                                        'error' => 0
                                    ],
                                    'condition' => '$("#key_client").val() == $("#key_client_re").val()'
                                ]
                            ]);*/
                        echo $this->Form->hidden('id_commend', ['value' => $commend->id]) ;
                        echo $this->Form->input('key_client', ['id'=>'key_client','type' => 'password','value'=>base64_decode($commend->key_client),'label'=>'CLAVE']) ;
                        echo $this->Form->input('key_client_re', ['id'=>'key_client_re','type' => 'password','value'=>base64_decode($commend->key_client),'label'=>'RE_CLAVE']) ;

                        echo $this->Form->submit('Cambiar CLAVE',['id'=>"btnchange"]) ;
                        echo $this->Form->end();
                        ?>
                    
            </div>
            <script type="text/javascript">
            //<![CDATA[
            $('#formkey').bind('submit', function(){ 
                if ($("#key_client").val() == $("#key_client_re").val()) { 
                    $.ajax({async:true, type:'post', complete:function(request, json) {$('#change_clave').html(request.responseText); }, data:$('#formkey').serialize(), url:"<?php echo $this->Url->build('/');?>"+'sales/commends-change-key-save'}); 
                }else{
                    alert('no coinciden las contraseñas');
                    $("#key_client_re").select();
                    $("#key_client_re").focus();
                } 
            });
            //]]>
            </script>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">cerrar</button>
</div>
<script type="text/javascript">
    $(function () {
        $("#key_client").focus();

        $('body').on('keydown', 'input, select, textarea', function(e) {
            var self = $(this)
              , form = self.parents('form:eq(0)')
              , focusable
              , next
              ;
            if (e.keyCode == 13) {
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.select();
                    next.focus();
                } else {
                    form.submit();
                }
                return false;
            }
        });
        
    });

     
</script>