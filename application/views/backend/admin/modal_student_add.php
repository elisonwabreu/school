<div class="row">
    <div class="col-md-12">
	   <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
            	<div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('addmission_form');?>
            	</div>
            </div>
            <div class="panel-body bg-info">
            <?php echo form_open('admin/student/create/' , array('class' => 'validate', 'enctype' => 'multipart/form-data'));?>    
                	<div class="col-md-12">
        				<div class="row">
        					<div class="col-md-2" style="margin-top: 12px">				
        						<!-- <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ1LjUiIHk9IjcwIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTQweDE0MDwvdGV4dD48L2c+PC9zdmc+" alt="..." class="img-thumbnail">-->
        						<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                    <div class="fileinput-new thumbnail" data-trigger="fileinput">
                                            <img src="http://placehold.it/200x200" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 6px;"></div>
                                    <div>
                                        <span class="col-md-12 btn btn-info btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="userfile" accept="image/*">
                                        </span>
                                        <a href="#" class="col-md-12 btn btn-orange fileinput-exists" style="margin-top: 3px"
                                             data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
        					</div>	
        				
        					<div class="col-md-8">
        						<div class="form-group">
        							<label><?php echo get_phrase('name');?></label>
        							<input type="text" class="form-control" name="name" data-validate="required" placeholder="nome" 
        							     data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus="autofocus" />
        						</div>
        					</div>	
        					<div class="col-md-2">
        						<div class="form-group">
        							<label><?php echo get_phrase('class');?></label>
        							<select name="class_id" class="form-control" data-validate="required" 
                                             data-message-required="<?php echo get_phrase('value_required');?>">
                                        <option value=""><?php echo get_phrase('select');?></option>
                                            <?php 
                                              $classes = $this->db->get('class')->result_array();
                                              foreach($classes as $row):                                            ?>
                                                  <option value="<?php echo $row['class_id'];?>">
                                                      <?php echo $row['name'];?>
                                                  </option>
                                            <?php
                                              endforeach;
                                            ?>
                                    </select>   							
        						</div>
        					</div>	
        					<div class="col-md-2">
        						<div class="form-group">
        							<label><?php echo get_phrase('phone');?></label>
        							<input type="text" class="form-control" name="phone" value="" placeholder="fone"/>
        						</div>
        					</div>	
        					<div class="col-md-2">
        						<div class="form-group">
        							<label><?php echo get_phrase('birthday');?></label>
        							<input type="text" class="form-control datepicker" name="birthday" placeholder="dd/mm/aaaa" 
        							             value="" data-start-view="2">
        						</div>
        					</div>	
        					<div class="col-md-4">
        						<div class="form-group">
        							<label><?php echo get_phrase('email');?></label>
        							<input type="text" class="form-control" name="email" value="" placeholder="e-mail"/>
        						</div>
        					</div>
        					
        					<div class="col-md-2">
        						<div class="form-group">
        							<label><?php echo get_phrase('gender');?></label>
        							<select name="sex" class="form-control">
                                        <option value=""><?php echo get_phrase('select');?></option>
                                        <option value="male"><?php echo get_phrase('male');?></option>
                                        <option value="female"><?php echo get_phrase('female');?></option>
                                    </select>							
        						</div>
        					</div>	
        					
        					<div class="col-md-6">
        						<div class="form-group">
        							<label><?php echo get_phrase('address');?></label>
        							<input type="text" class="form-control" name="address" value="" />
        						</div>
        					</div>
        					<div class="col-md-2">
        						<div class="form-group">
        							<label>Numero: </label>
        							<input class="form-control" type="text" placeholder="" />
        						</div>
        					</div>
        					<div class="col-xs-2">
        						<div class="form-group">
        							<label>Estado: </label>
        							<select class="form-control">
        								<option value="1">AM</option>
        								<option value="1">AP</option>
        								<option value="1">BH</option>
        								<option value="1">CE</option>								
        							</select>							
        						</div>
        					</div>
        					<div class="col-md-4 col-md-offset-2">
        						<div class="form-group">
        							<label>Cidade: </label>
        							<select class="form-control">
        								<option value="1">Fortaleza</option>
        								<option value="1">Belem</option>
        								<option value="1">Caucaia</option>
        								<option value="1">Maracanau</option>								
        								<option value="1">Sao Paulo</option>								
        							</select>							
        						</div>
        					</div>
                            <div class="col-md-offset-4 col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="col-md-offset-4 btn btn-info"><?php echo get_phrase('add_student');?></button>
                                </div>
                            </div>
                            <?php echo form_close();?>
        				</div>
        			</div>
        		</div>		
            </div>
        </div>
    </div>
</div>



