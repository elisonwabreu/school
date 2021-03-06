<?php
$edit_data = $this->db->get_where('aluno', array('al_id' => $param2))->result_array();
$codigo = $row['al_id'];
$codigo_classe = $row['al_codigo_class'];
foreach ($edit_data as $row):
    
    $data_nascimento = explode('-', $row['al_data_nasc']);
    $row['al_data_nasc'] = $data_nascimento[2].'/'.$data_nascimento[1].'/'.$data_nascimento[0];
    
    
    ?>
<div class="resposta"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('edit_student'); ?>
                    </div>
                </div>
                <div class="panel-body">

    <?php echo form_open('admin/student/' . $row['al_id'] . '/do_update/' . $row['al_id'], array('name' => 'formulario', 'class' => 'validate', 'enctype' => 'multipart/form-data')); ?>
                    <input type="hidden" id="txtCodigo" value="<?php echo $row['al_id']; ?>" />
                    <input type="hidden" id="txtCodigoClasse" value="<?php echo $row['al_codigo_classe']; ?>" />
                    <div class="col-md-2" style="margin-top: 12px">				
                        <div class="fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('aluno', $row['al_id']); ?>" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="col-md-12 btn btn-info btn-file">
                                    <span class="fileinput-new">Selecione a Imagem</span>
                                    <span class="fileinput-exists">Alterar</span>
                                    <input type="file" name="userfile" accept="image/*">
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
                                    <input type="text" class="form-control" name="al_nome" data-validate="required"  
                                           data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                           value="<?php echo $row['al_nome']; ?>">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo get_phrase('mae'); ?></label>
                                    <input type="text" class="form-control" name="al_nome_mae" data-validate="required" placeholder="Nome da mãe" 
                                           data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                           value="<?php echo $row['al_nome_mae']; ?>" />
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
                                        foreach ($classes as $row2):
                                            ?>
                                            <option value="<?php echo $row2['class_id']; ?>"
                                                    <?php if ($row['al_codigo_classe'] == $row2['class_id']) echo 'selected'; ?>>
                                                    <?php echo $row2['name']; ?>
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
                                    <input type="text" class="form-control" name="al_data_nasc" placeholder="dd/mm/aaaa" 
                                           value="<?php echo $row['al_data_nasc']; ?>" data-start-view="2" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                </div>
                            </div>	

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo get_phrase('email'); ?></label>
                                    <input type="text" class="form-control" name="al_email" value="<?php echo $row['al_email']; ?>" 
                                           placeholder="e-mail"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('gender'); ?></label>
                                    <select name="al_sexo" class="form-control" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                        <option value="m" <?php if ($row['al_sexo'] == 'm') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
                                        <option value="f"<?php if ($row['al_sexo'] == 'f') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
                                    </select>							
                                </div>
                            </div>	
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('cep'); ?></label>
                                    <input class="form-control" name="al_cep" 
                                           value="<?php echo $row['al_cep'] ?>" type="text" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label><?php echo get_phrase('address'); ?></label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $row['al_logradouro'] ?>" name="al_logradouro" value="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('numero'); ?></label>
                                    <input class="form-control" type="text" 
                                           value="<?php echo $row['al_numero'] ?>" name="al_numero" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo get_phrase('complemento'); ?></label>
                                    <input class="form-control" name="al_complemento" type="text" 
                                           value="<?php echo $row['al_complemento'] ?>" placeholder="" />
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('estado'); ?></label>
                                    <select class="form-control" name="al_uf" data-validate="required" class="estados" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value="" >--Estados--</option>
                                        <?php $estados = $this->db->get('estado')->result_array();
                                        foreach ($estados as $estado):
                                            ?>
                                            <option value="<?php echo $estado['est_id']; ?>"
                                                    <?php if ($row['al_uf'] == $estado['est_id']) echo 'selected'; ?>>
                                                        <?php echo $estado['est_nome']; ?>
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
                                    <select class="form-control" name="al_cidade" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <?php 
                                        $cidades = $this->db->get_where('cidade', array(
                                                                'cid_estado_id' => $row['al_uf']
                                                            ))->result_array();                                        
                                        //$estados = $this->db->get('cidade')->result_array();
    					foreach($cidades as $cidade): ?>
                                            <option value="<?php echo $cidade['cid_id'];?>" 
                                                <?php if($cidade['cid_id'] == $row['al_cidade']) echo 'selected';?>>
						<?php echo $cidade['cid_nome'];?>
                                            </option>
                                        <?php
					endforeach;
    					?>								
                                    </select>							
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo get_phrase('bairro'); ?></label>
                                    <input class="form-control" name= "al_bairro" type="text" 
                                           value="<?php echo $row['al_bairro'] ?>" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>" />
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('phone'); ?></label>
                                    <input type="text" class="form-control" name="al_fone"                                           
                                           value="<?php echo $row['al_fone']; ?>" placeholder="(99)9999-9999"  
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('celular'); ?></label>
                                    <input class="form-control" name="al_celular" type="text"
                                           value="<?php echo $row['al_celular'] ?>" placeholder="" />
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('blood_group'); ?></label>
                                    <select class="form-control" name="al_fator_rh"  
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value="">Grupo Sanguineo</option>
                                        <option value="A -" <?php echo $row['al_fator_rh'] == 'A -' ? 'selected' : "" ?> >A -</option>
                                        <option value="B -" <?php echo $row['al_fator_rh'] ==  'B -' ? 'selected' : "" ?> >B -</option>
                                        <option value="AB -" <?php echo $row['al_fator_rh'] ==  'AB -' ? 'selected' : "" ?> >AB -</option>
                                        <option value="O -" <?php echo $row['al_fator_rh'] ==  'O -' ? 'selected' : ""?>>O -</option>
                                        <option value="A +" <?php echo  $row['al_fator_rh'] ==  'A +' ? 'selected' : ""?> >A +</option>
                                        <option value="B +" <?php echo $row['al_fator_rh'] ==  'B +' ? 'selected' : "" ?>>B +</option>
                                        <option value="AB +" <?php echo  $row['al_fator_rh'] ==  'AB +' ? 'selected' : ""?> >AB +</option>
                                        <option value="O +" <?php echo $row['al_fator_rh'] ==  'O +' ? 'selected' : "" ?> >O +</option>								
                                        <option value="1">Não sabe</option>								
                                    </select>							
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo get_phrase('rg'); ?></label>
                                    <input class="form-control" type="text" name="al_rg"
                                           value="<?php echo $row['al_rg'] ?>" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('emissor'); ?></label>
                                    <input class="form-control" type="text" name="al_org_emissor"
                                           value="<?php echo $row['al_org_emissor'] ?>" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo get_phrase('cpf'); ?></label>
                                    <input class="form-control" name="al_cpf" type="text"
                                           value="<?php echo $row['al_cpf'] ?>" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <button type="submit" class="col-md-offset-4 btn btn-info"><?php echo get_phrase('edit_student'); ?></button>
                            </div>
                        </div>
                    </div>    
                    <?php echo form_close(); ?>                    
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">
   
    $(function(){    
        
        formataCampoAluno();
        
        
        $('input[name="al_data_nasc"]').datepicker({
            format: 'dd/mm/yyyy',                
            language: 'pt-BR'
         });
        
        var base_url = "<?= base_url() ?>";
        var codigo_classe = $('#txtCodigoClasse').val();
        var codigo = $('#txtCodigo').val();       
        var formulario  = $('form[name="formulario"]');
        var loader  = $('.resposta');
        var url         = base_url + 'index.php?admin/student/'+codigo+'/do_update/' + codigo;
        
        function sucesso(retorno){
            //alert("retornou!" + retorno);
            var result = JSON.parse( retorno );

            if(result.msg == "validacao"){
                loader.fadeIn("fast");
                loader.addClass("alert alert-danger").html("Preencha os campos obrigatórios");
                loader.fadeOut(4000);
                //função que percorre os campos de preenchimento obrigatório
                /*$.each(result.validacao, function(i, item){
                    alert(result.validacao[i]);
               });*/ 
            }else if(result.msg == "erro"){
                alert("Erro ao editar registro no banco de dados" + result.mensagem );
            }else if(result.msg == "sucesso"){
                $('#modal_ajax').modal('hide');  
            }                
        }
        
        $('#modal_ajax').on('hidden.bs.modal', function (e) {
            $('#mensagem').delay(5000).fadeIn('4000');
            $('#mensagem').addClass('alert alert-success').attr('role', 'alert');
            $('#mensagem').html("Dados Editados com sucesso");
            $('#mensagem').delay(5000).fadeOut('4000');
            setTimeout(5000);
            var novaURL = base_url + 'index.php?admin/student_information/'+codigo_classe;
            $(location).attr('href',novaURL);
          });
                
        function erro(data){
            var result = JSON.parse( data );
            alert("erro ao tentar inserir registro");
        }
        
        formulario.submit(function(){
            $(this).ajaxSubmit({
                url: url,
                success: sucesso,
                error: erro
            });                        
            return false;
        });
        
        
        
        $('select[name="al_uf"]').change(function(){             
            var select = $('.estados :selected').text();
            //alert(select);
            base = "<?php echo base_url(); ?>";
            if(select !== "--Estados--"){
                $.ajax({
                    type: 'POST',
                     url: base + 'index.php?admin/getCidades/' + $(this).val(),                
                     success: retorno,
                     error: function(dado){
                         alert("erro");
                     }
                 }); 
            }else{
                $('select[name="al_cidade"]').html("<option value=''>Selecione</option>");
            }
                
            
            
            function retorno(data){
                var result = JSON.parse( data );  
                $('select[name="al_cidade"]').html("<option value=''></option>");
                var options = "";
                $.each(result, function(i, item) {
                    options += '<option value="' + result[i].cid_id + '">' + result[i].cid_nome + '</option>'
                    //$(select[name="al_cidade"]).
                    //alert(result[i].cid_nome);
                })
                
                $('select[name="al_cidade"]').html(options).show();
            }
        });
         
    
         
    });
  
  
</script>
