<?php
$edit_data = $this->db->get_where('professor', array('pr_id' => $param2))->result_array();
foreach ($edit_data as $row):
    $data_nascimento = explode('-', $row['pr_data_nasc']);
    $row['pr_data_nasc'] = $data_nascimento[2] . '/' . $data_nascimento[1] . '/' . $data_nascimento[0];
    ?>
<div id="loading"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_teacher'); ?>
                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open('admin/teacher/do_update/' . $row['pr_id'], array('name' => 'formulario', 'class' => 'validate', 'enctype' => 'multipart/form-data')); ?>
                    <input type="hidden" value="<?php echo $row['pr_id'] ?>" />		
                    <div class="col-md-2" style="margin-top: 12px">				
                        <div class="fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;" data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('professor', $row['pr_id']); ?>" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px"></div>
                            <div>
                                <span class="col-md-12 btn btn-info btn-file">
                                    <span class="fileinput-new">Selecione a Imagem</span>
                                    <span class="fileinput-exists">Alterar</span>
                                    <input type="file" name="foto" accept="image/*">
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
                                        <input type="text" class="form-control" name="pr_nome" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                               value="<?php echo $row['pr_nome']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('mae'); ?></label>
                                        <input type="text" class="form-control" name="pr_nome_mae" data-validate="required" placeholder="Nome da mãe" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                               value="<?php echo $row['pr_nome_mae']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('Formação'); ?></label>
                                        <input type="text" class="form-control" name="pr_formacao" data-validate="required" placeholder="" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                               value="<?php echo $row['pr_formacao']; ?>" />							
                                    </div>
                                </div>	

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('birthday'); ?></label>
                                        <input type="text" class="form-control dt_aniversario" name="pr_data_nasc" placeholder="dd/mm/aaaa" 
                                               value="<?php echo $row['pr_data_nasc']; ?>" data-start-view="2" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>">
                                    </div>
                                </div>	

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('email'); ?></label>
                                        <input type="text" class="form-control" name="pr_email" value="<?php echo $row['pr_email']; ?>" 
                                               placeholder="e-mail"/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('gender'); ?></label>
                                        <select name="pr_sexo" class="form-control" data-validate="required" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>">
                                            <option value=""><?php echo get_phrase('select'); ?></option>
                                            <option value="m" <?php if ($row['pr_sexo'] == 'm') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
                                            <option value="f"<?php if ($row['pr_sexo'] == 'f') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
                                        </select>							
                                    </div>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('cep'); ?></label>
                                        <input class="form-control" name="pr_cep" 
                                               value="<?php echo $row['pr_cep'] ?>" type="text" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('address'); ?></label>
                                        <input type="text" class="form-control"
                                               value="<?php echo $row['pr_logradouro'] ?>" name="pr_logradouro" value="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('numero'); ?></label>
                                        <input class="form-control" type="text" 
                                               value="<?php echo $row['pr_numero'] ?>" name="pr_numero" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('complemento'); ?></label>
                                        <input class="form-control" name="pr_complemento" type="text" 
                                               value="<?php echo $row['pr_complemento'] ?>" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('estado'); ?></label>
                                        <select class="form-control" name="pr_uf" data-validate="required" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>">
                                            <option value="" >--Estados--</option>
                                            <?php
                                            $estados = $this->db->get('estado')->result_array();
                                            foreach ($estados as $estado):
                                                ?>
                                                <option value="<?php echo $estado['est_id']; ?>"
                                                            <?php if ($row['pr_uf'] == $estado['est_id']) echo 'selected'; ?>>
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
                                        <select class="form-control" name="pr_cidade" data-validate="required" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>">
                                                    <?php
                                                    $cidades = $this->db->get_where('cidade', array(
                                                                'cid_estado_id' => $row['pr_uf']
                                                            ))->result_array();
                                                    //$estados = $this->db->get('cidade')->result_array();
                                                    foreach ($cidades as $cidade):
                                                        ?>
                                                <option value="<?php echo $cidade['cid_id']; ?>" 
                                                <?php if ($cidade['cid_id'] == $row['pr_cidade']) echo 'selected'; ?>>
                                                <?php echo $cidade['cid_nome']; ?>
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
                                        <input class="form-control" name= "pr_bairro" type="text" 
                                               value="<?php echo $row['pr_bairro'] ?>" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" />
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('phone'); ?></label>
                                        <input type="text" class="form-control" name="pr_fone"                                            
                                               value="<?php echo $row['pr_fone'] ?>" placeholder="(99)9999-9999" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('celular'); ?></label>
                                        <input class="form-control" name="pr_celular" type="text"
                                               value="<?php echo $row['pr_celular'] ?>" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('rg'); ?></label>
                                        <input class="form-control" type="text" name="pr_rg"
                                               value="<?php echo $row['pr_rg'] ?>" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('emissor'); ?></label>
                                        <input class="form-control" type="text" name="pr_org_emissor"
                                               value="<?php echo $row['pr_org_emissor'] ?>" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo get_phrase('cpf'); ?></label>
                                        <input class="form-control" name="pr_cpf" type="text"
                                               value="<?php echo $row['pr_cpf'] ?>" placeholder="" data-validate="required" 
                                               data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <button type="submit" class="col-md-offset-4 btn btn-info"><?php echo get_phrase('edit_teacher'); ?></button>
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
    $(function () {

        $('.dt_aniversario').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });

        formataCampoProfessor();

        formulario = $('form[name="formulario"]');
        codigo = $('input[type="hidden"]').val();
        base_url = "<?php echo base_url(); ?>";
        url = base_url + 'index.php?admin/teacher/do_update/' + codigo;
        function sucesso(retorno) {
            //alert("retornou!" + retorno);
            var result = JSON.parse(retorno);

            if (result.msg == "validacao") {
                loader.fadeIn(4000);
                loader.addClass("alert alert-danger").html("Preencha os campos obrigatórios");
                loader.fadeOut(4000);
                //função que percorre os campos de preenchimento obrigatório
                /*$.each(result.validacao, function(i, item){
                 alert(result.validacao[i]);
                 });*/
            } else if (result.msg == "erro") {
                alert("Erro ao inserir registro no banco de dados" + result.mensagem);
            } else if (result.msg == "sucesso") {
                $('#modal_ajax').modal('hide');

                var novaURL = base_url + 'index.php?admin/professor';
                $(location).attr('href', novaURL);
                /*$('#mensagem').delay(2500).fadeIn('slow');
                 $('#mensagem').addClass('alert alert-success').attr('role', 'alert');
                 $('#mensagem').html("Dados inseridos com sucesso");
                 $('#mensagem').delay(1500).fadeOut('slow');*/

            }
        }

        function erro(data) {
            var result = JSON.parse(data);
            alert("erro ao tentar inserir registro");
        }

        formulario.submit(function () {
            $('#loading').addClass('carregando');
            $(this).ajaxSubmit({
                type: 'POST',
                url: url,
                success: sucesso,
                error: erro
            });
            return false;
        });


        $('select[name="pr_uf"]').change(function () {
            var select = $('.estados :selected').text();
            //alert(select);
            base = "<?php echo base_url(); ?>";
            $('select[name="pr_cidade"]').html("<option value=''>carregando...</option>")
            if (select !== "--Estados--") {
                $.ajax({
                    type: 'POST',
                    url: base + 'index.php?admin/getCidades/' + $(this).val(),
                    success: retorno,
                    error: function (dado) {
                        alert("erro");
                    }
                });
            } else {
                $('select[name="pr_cidade"]').html("<option value=''>Selecione</option>");
            }

            function retorno(data) {
                var result = JSON.parse(data);
                $('select[name="pr_cidade"]').html("<option value=''></option>");
                var options = "";
                $.each(result, function (i, item) {
                    options += '<option value="' + result[i].cid_id + '">' + result[i].cid_nome + '</option>'
                    //$(select[name="al_cidade"]).
                    //alert(result[i].cid_nome);
                })

                $('select[name="pr_cidade"]').html(options).show();
            }

        });


    });

</script>
