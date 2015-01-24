<?php
$edit_data = $this->db->get_where('aluno', array('al_id' => $param2))->result_array();
$codigo = $row['al_id'];
$codigo_classe = $row['al_codigo_class'];
foreach ($edit_data as $row):

    $telefone = $row[al_fone];

    $novo = '(';
    if (strlen($telefone) == 8) {
        $telefone = '00' . $telefone;
    }

    for ($i = 0; $i < strlen($telefone); $i++) {
        $novo .= $telefone[$i];
        if ($i == 1) {
            $novo .= ')';
        }
        if ($i == 5) {
            $novo .= '-';
        }
    }
    ?>
<div class="mensagemErro"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('edit_student'); ?>
                    </div>
                </div>
                <div class="panel-body bg-info">

    <?php echo form_open('admin/student/' . $row['al_id'] . '/do_update/' . $row['al_id'], array('name' => 'formulario', 'class' => 'validate', 'enctype' => 'multipart/form-data')); ?>
                    <input type="hidden" id="txtCodigo" value="<?php echo $row['al_id']; ?>" />
                    <input type="hidden" id="txtCodigoClasse" value="<?php echo $row['al_codigo_classe']; ?>" />
                    <div class="col-md-2" style="margin-top: 12px">				
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('aluno', $row['al_id']); ?>" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Selecione a Imagem</span>
                                    <span class="fileinput-exists">Alterar</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remover</a>
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
                                    <input type="text" class="form-control datepicker" name="al_data_nasc" placeholder="dd/mm/aaaa" 
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
                                    <select class="form-control" name="al_uf" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value="" >--Estados--</option>
                                        <?php $estados = $this->db->get('estado')->result_array();
                                        foreach ($estados as $estado):
                                            ?>
                                            <option value="<?php echo $estado['est_sigla']; ?>"
                                                    <?php if ($row['al_uf'] == $estado['est_sigla']) echo 'selected'; ?>>
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
                                    <input class="form-control" name= "al_bairro" type="text" 
                                           value="<?php echo $row['al_bairro'] ?>" placeholder="" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>" />
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo get_phrase('phone'); ?></label>
                                    <input type="text" class="form-control" name="al_fone" onkeypress="mascara(this)"                                           
                                           value="<?php echo $novo; ?>" placeholder="(99)9999-9999" data-validate="required" 
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
                                    <select class="form-control" name="al_fator_rh" data-validate="required" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>">
                                        <option value="1"></option>
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
                    <!--                    <div class="row">
                                            <div class="alert alert-danger col-md-offset-1 col-md-10" role="alert">erro de cpf</div>
                                       </div>    -->
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">
   
     $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',                
            language: 'pt-BR'
         });
    
    formulario = $('form[name="formulario"]');
    formulario.submit(function(){  
        
        codigo_classe = $('#txtCodigoClasse').val();
        codigo = $('#txtCodigo').val();
        dados = $(this).serialize();
        editarAluno(codigo, this, codigo_classe, "<?php echo base_url() ?>", dados);
        
        return false;
    });
  
  
</script>
