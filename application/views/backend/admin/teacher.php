
            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_add/');" 
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('add_new_teacher');?>
                </a> 
                <br><br>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th width="280"><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('formacao');?></div></th>
                            <th width="80"><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $teachers	=	$this->db->get('professor' )->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('professor',$row['pr_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['pr_nome'];?></td>
                            <td><?php echo $row['pr_email'];?></td>
                            <td><?php echo $row['pr_fone'];?></td>
                            <td><?php echo $row['pr_formacao'];?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Ação <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_edit/<?php echo $row['pr_id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/teacher/delete/<?php echo $row['pr_id'];?>');">
                                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
                                               	</a>
                                        				</li>
                                    </ul>
                                </div>
                                
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!--  DATA TABLE EXPORT CONFIGURATIONS -->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
	
		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3,4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
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
                
                //listarProfessor();
	});
        
        
        //função que lista os professores via ajax
        function listarProfessor(){
            base_url = "<?php echo base_url(); ?>";
            url         = base_url + 'index.php?admin/teacher/listar';
            $(this).ajaxSubmit({
                type: 'POST',
                url: url,
                success: sucesso,
                error: erro
            });
            
            function erro(data){
                alert("erro");
            }
            
            function sucesso(retorno){
                var table = $('#table_export tbody');                    
                //var tr = table.find('tr');
                //var td = tr.find('td');
                //alert($(td[0]).text());
                
                base_url = "<?php echo base_url(); ?>";
                url         = base_url + 'uploads/professor_image/';
                
                var result = JSON.parse( retorno );
                
                $.each(result, function(i, item) {
                    var codigo = result[i].pr_id;
                    var endereco = url.trim() + codigo.trim() + '.jpg';                    
                    var img = $('<img>'); //Equivalent: $(document.createElement('img'))
                    img.attr({src: endereco, width: 30}).addClass("img-circle");
                    tr = $('<tr>');
                    $('<td>').append(img).appendTo(tr);                    
                    $('<td>').append(result[i].pr_nome).appendTo(tr);
                    $('<td>').append(result[i].pr_email).appendTo(tr);
                    $('<td>').append(result[i].pr_fone).appendTo(tr);
                    $('<td>').append(result[i].pr_formacao).appendTo(tr);
                    $('<td>').append(montaBotao(result[i].pr_id)).appendTo(tr);
                   /* */
                    
                    
                    $(table).append(tr);
                });
               
            }
           
           function pegaImagemProfessor(codigo){
                
                base_url = "<?php echo base_url(); ?>";
                url         = base_url + 'index.php?admin/teacher/imagem/' + codigo;
                
                $(this).ajaxSubmit({
                    type: 'POST',
                    url: url,
                    success: sucesso,
                    error: erro
                });
           
           }
           
        function montaBotao(codigo){
            /*div = $('<div>').addClass('btn-group');
                    
            botao = $('button').addClass('btn btn-default btn-sm dropdown-toggle');
            botao.attr({
                type:           "button",
                "data-toggle":    "dropdown"
            });
            botao.append('Ação <span class="caret"></span>');
            ul = $('<ul>').addClass('dropdown-menu dropdown-default pull-right').attr('role', 'menu');
            li = $('<li>');
            a = $('<a>');
            a.attr({
                href: '#',
                onclick: showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_edit/' + codigo)
            });
            li.append(a);
            ul.append(li);
            div.append(botao);
            div.append(ul);*/
                                
            td = '<div class="btn-group">' +
                    '<button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">' +
                        'Ação <span class="caret"></span>' +
                    '</button>' +
                    '<ul role="menu" class="dropdown-menu dropdown-default pull-right">' +
                        '<li>' +
                                '<a onclick="showAjaxModal(\'http://localhost/school/index.php?modal/popup/modal_teacher_edit/'+codigo+'\');" href="#">' +
                                '<i class="entypo-pencil"></i>' +
                                    'Editar </a>' +
                            '</li>' +
                        '<li class="divider"></li>' +                        
                        '<li>' +
                            '<a onclick="confirm_modal(\'http://localhost/school/index.php?admin/teacher/delete/\');" href="#">' +
                            '<i class="entypo-trash"></i>' +
                                'Deletar </a>' +
                            '</li>' +
                    '</ul>' +
                '</div>' ;
        
            return td;
        }
           
           
           
           
           
            
        }
		
</script>

