<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('addmission_form'); ?>
                </div>
            </div>
            <div class="panel-body bg-info">
                <?php echo form_open('admin/student/create/', array('name' => 'formulario_add', 'class' => 'validate', 'enctype' => 'multipart/form-data')); ?>  
                <div class="col-md-2" style="margin-top: 12px">				
                    <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                        <div class="fileinput-new thumbnail" data-trigger="fileinput">
                            <img src="http://placehold.it/200x200" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 6px;"></div>
                        <div>
                            <span class="col-md-12 btn btn-info btn-file">
                                <span class="fileinput-new">Selecione Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file" name="foto" accept="image/*">
                            </span>
                            <a href="#" class="col-md-12 btn btn-orange fileinput-exists" style="margin-top: 3px"
                               data-dismiss="fileinput">Remover</a>
                        </div>
                    </div>
                </div>	
                <div class="col-md-10">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('name'); ?></label>
                                        <input type="text" class="form-control" name="al_nome" data-validate="required" placeholder="Nome Completo" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus="autofocus" />
                                    </div>
                                </div>
                            </div>    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo get_phrase('mae'); ?></label>
                                    <input type="text" class="form-control" name="al_nome_mae" data-validate="required" placeholder="Nome da mãe" 
                                           data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus="autofocus" />
                                </div>
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('class'); ?></label>
                                    <select name="al_codigo_classe" class="form-control" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                        <?php $classes = $this->db->get('class')->result_array();
                                        foreach ($classes as $row): ?>
                                        <option value="<?php echo $row['class_id']; ?>">
                                            <?php echo $row['name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>   							
                                </div>
                            </div>	

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('birthday'); ?></label>
                                    <input type="text" class="form-control datepicker" name="al_data_nasc" placeholder="dd/mm/aaaa" 
                                           data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" data-start-view="2">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo get_phrase('email'); ?></label>
                                    <input type="text" class="form-control" name="al_email" value="" placeholder="e-mail"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('gender'); ?></label>
                                    <select name="al_sexo" class="form-control"  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                        <option value="male"><?php echo get_phrase('male'); ?></option>
                                        <option value="female"><?php echo get_phrase('female'); ?></option>
                                    </select>							
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('cep'); ?></label>
                                <input class="form-control" name="al_cep" type="text" placeholder=""  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label><?php echo get_phrase('address'); ?></label>
                                <input type="text" class="form-control" name="al_logradouro" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('numero'); ?></label>
                                <input class="form-control" type="text" name="al_numero" placeholder="" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo get_phrase('complemento'); ?></label>
                                <input class="form-control" name="al_complemento" type="text" placeholder="" />
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('estado'); ?></label>
                                <select class="form-control" name="al_uf"  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                    <option value="">--Estados--</option>
                                    <?php $estados = $this->db->get('estado')->result_array();
    					foreach($estados as $estado): ?>
                                            <option value="<?php echo $estado['est_sigla'];?>">
						<?php echo $estado['est_nome'];?>
                                            </option>
                                        <?php
					endforeach;
    					?>
                               </select>							
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('cidade'); ?></label>
                                <select class="form-control" name="al_cidade" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <option value="1">Fortaleza</option>
                                    <option value="1">Belem</option>
                                    <option value="1">Caucaia</option>
                                    <option value="1">Maracanau</option>								
                                    <option value="1">Sao Paulo</option>								
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo get_phrase('bairro'); ?></label>
                                <input class="form-control" id="campoTelefone" name= "al_bairro" type="text" placeholder="" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('phone'); ?></label>
                                <input type="text" class="form-control" name="al_fone" value="" placeholder="Fone"  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('celular'); ?></label>
                                <input class="form-control" name="al_celular" type="text" placeholder="" />
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('blood_group'); ?></label>
                                <select class="form-control" name="al_fator_rh"  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <option value="1">A -</option>
                                    <option value="1">B -</option>
                                    <option value="1">AB -</option>
                                    <option value="1">O -</option>
                                    <option value="1">A +</option>
                                    <option value="1">B +</option>
                                    <option value="1">AB +</option>
                                    <option value="1">O +</option>								
                                    <option value="1">Não sabe</option>								
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo get_phrase('rg'); ?></label>
                                <input class="form-control" type="text" name="al_rg" placeholder=""  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo get_phrase('emissor'); ?></label>
                                <input class="form-control" type="text" name="al_org_emissor" placeholder=""  data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo get_phrase('cpf'); ?></label>
                                <input class="form-control" name="al_cpf" type="text" placeholder="" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                 <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <button type="submit" class="col-md-offset-4 btn btn-info"><?php echo get_phrase('add_student'); ?></button>
                            </div>
                        </div>
<?php echo form_close(); ?>
                </div>
            </div>		
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(function(){
        formulario = $('form[name="formulario_add"]');
          url         = "<?php echo base_url(); ?>" + 'index.php?admin/student/create/';
        //url         = "<?php echo base_url(); ?>" + 'index.php?admin/teste';
    
        formulario.submit(function(){

            
            
            function sucesso(retorno){
                var result = JSON.parse( retorno );
                alert("dados salvos com sucessoss" + result);
                formulario.each (function(){
                    this.reset();
                });
            }
            
            function erro(data){
                alert("deu merda");
                //$.loader('close');
               // $('#modal_ajax').modal('hide');
            }
            
             function carregando(data){                
                //$.loader({content:"<div>Loading Data form Server ...</div>"});
            }
            
            $.ajax({
                type: 'POST',
                url: url,
                data: $(this).serialize(),
                beforeSend: carregando,
                error: erro,
                success: sucesso
               // complete: complete
            });

            return false;
        }); 
        
        /*converte calendario em portugues*/
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',                
            language: 'pt-BR'
         });
         
         
    });
    
    
    
    /*
     * 
     *   
            
            function carregando(data){                
                $.loader({content:"<div>Loading Data form Server ...</div>"});
            }
            
            function complete(data){
               // $('#modal_ajax').modal('hide');
                
            }
            
            

            
     * 
     */

</script>