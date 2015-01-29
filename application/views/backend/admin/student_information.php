
<a href="javascript:;"
	onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_add/'+'<?= $this->uri->segment(3, 1); ?>');"
	class="btn btn-primary pull-right"> <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_student');?>
    </a>
<br>
<br>
<div id="mensagem"></div>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th width="50"><div><?php echo get_phrase('roll');?></div></th>
			<th width="50"><div><?php echo get_phrase('photo');?></div></th>
			<th width="280"><div><?php echo get_phrase('name');?></div></th>
			<th width="280"><div><?php echo get_phrase('mae');?></div></th>
                        <th width="280"><div><?php echo get_phrase('endereco');?></div></th>
			<th><div><?php echo get_phrase('phone');?></div></th>
			<th width="50"><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
	<tbody>
        <?php
        $students = $this->db->get_where('aluno', array('al_codigo_classe' => $class_id))->result_array();        
        foreach ($students as $row) :
            ?>
        <tr>
			<td></td>
			<td><img
				src="<?php echo $this->crud_model->get_image_url('aluno',$row['al_id']);?>"
				class="img-circle" width="30" /></td>
			<td><?php echo $row['al_nome'];?></td>
			<td><?php echo $row['al_nome_mae'];?></td>
                        <td><?php echo $row['al_logradouro'];?></td>
                        <td><?php echo $row['al_fone'];?></td>
			
			<td>

				<div class="btn-group">
					<button type="button"
						class="btn btn-default btn-sm dropdown-toggle"
						data-toggle="dropdown">	Ação <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">

						<!-- STUDENT PROFILE LINK -->
						<li><a href="#"
							onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_profile/<?php echo $row['al_id'];?>');">
								<i class="entypo-user"></i>
                                    <?php echo get_phrase('profile');?>
                                </a>
                       </li>

						<!-- STUDENT EDITING LINK -->
						<li><a href="#"
							onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['al_id'];?>');">
								<i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                       </li>
						<li class="divider"></li>

						<!-- STUDENT DELETION LINK -->
						<li><a href="#"
							onclick="confirm_modal('<?php echo base_url();?>index.php?admin/student/<?php echo $class_id;?>/delete/<?php echo $row['al_id'];?>');">
								<i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                                </a></li>
					</ul>
				</div>

			</td>
		</tr>
        <?php endforeach;?>
    </tbody>
</table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{	
           
            
                 $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',                
                    language: 'pt-BR'
                });

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
                
                //$('#mensagem').html("Dados Editados com sucesso");
                
            /*    function sucesso(data){
                    var result = JSON.parse( data );
                    var resultado = result.result[0];
                    alert(result.result.length);
                    alert(resultado.al_nome);
                }
            
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url();?>"+'index.php?admin/teste_information/'+"<?php echo $class_id ?>",
                //data: ,
                //beforeSend: carregando,
                //error: erro,
                success: sucesso
                //complete: complete
            });*/
            
	});
        
        
		
</script>