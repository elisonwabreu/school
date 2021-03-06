<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 1 August, 2014
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{
    

	function __construct()
	{
            parent::__construct();
            $this->load->database();
            $this->load->helper('funcoes');
		
       /*cache control*/
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
                
       /* echo '<pre>';
        print_r($this->session->all_userdata());
        echo '</pre>';*/
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
	function student_add()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_information($class_id = '')
	{
		if ($this->session->userdata('admin_login') != 1)
                    redirect('login', 'refresh');
			
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
		$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
        
    function teste_information($class_id){
        $students = $this->db->get_where('aluno', array('al_codigo_classe' => $class_id))->result_array();
        echo json_encode( array( 'result' => $students) );
        //echo json_encode( $students );
    }
	
    function student_marksheet($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_name']  = 'student_marksheet';
        $page_data['page_title'] 	= get_phrase('student_marksheet'). " - ".get_phrase('class')." : ".
                                                                                $this->crud_model->get_class_name($class_id);
        $page_data['class_id'] 	= $class_id;
        $this->load->view('backend/index', $page_data);
    }

    
    function imagem(){
        print_r($this->input->post());
        print_r($_FILES['userfile']);
        exit;

    }
        
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');  
        
        //retorna um array contendo os campos que são not null no banco de dados
        $array = camposNotNull('aluno');
        //verifica se os campos not null estão preenchidos
        $validados = validaCamposNotNull($this->input->post(), $array);
        
        if(!empty($validados)){
            //print_r($validados);
            echo json_encode(array("msg" => "validacao", "validacao" => $validados));
            return;                       
        }
        
        
        if ($param1 == 'create') { 
            
            $data['al_bairro']          = $this->input->post('al_bairro');
            $data['al_celular']         = formataCpfCepRgFone($this->input->post('al_celular'));
            $data['al_cep']             = formataCpfCepRgFone($this->input->post('al_cep'));
            $data['al_cidade']          = $this->input->post('al_cidade');
            $data['al_cod_usuario']     = $this->input->post('al_cod_usuario');
            $data['al_complemento']     = $this->input->post('al_complemento');
            
           /*if(!validaCPF($this->input->post('al_cpf'))){
                echo '1';
            }*/          
            
            $data['al_cpf']             = formataCpfCepRgFone($this->input->post('al_cpf'));           
            $data['al_data_nasc']       = formataDataParaBanco($this->input->post('al_data_nasc'));            
            $data['al_email']           = $this->input->post('al_email');
            $data['al_fator_rh']        = $this->input->post('al_fator_rh');
            $data['al_fone']            = formataCpfCepRgFone($this->input->post('al_fone'));
            $data['al_foto']            = $this->input->post('al_foto');
            $data['al_logradouro']      = $this->input->post('al_logradouro');        
            
            $data['al_nome']            = htmlspecialchars(mysql_real_escape_string($this->input->post('al_nome')));
            $data['al_nome_mae']        = $this->input->post('al_nome_mae');
            $data['al_numero']          = $this->input->post('al_numero');
            $data['al_org_emissor']     = $this->input->post('al_org_emissor');
            $data['al_rg']              = formataCpfCepRgFone($this->input->post('al_rg'));
            $data['al_sexo']            = $this->input->post('al_sexo');
            $data['al_status']          = $this->input->post('al_status');
            $data['al_uf']              = $this->input->post('al_uf');
            $data['al_codigo_classe']   = $this->input->post('al_codigo_classe');
            
            
            if($this->db->insert('aluno', $data)){
                $student_id = mysql_insert_id();
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/aluno_image/' . $student_id . '.jpg');
                echo json_encode( array( 'msg' => 'sucesso') );                
            }else{
                echo json_encode( array( 'msg' => 'erro', 'mensagem' => $this->db->_error_message() . " - " . $this->db->_error_number()) );                
            }
            
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            //echo json_encode( array( 'erro' => "nao") );
            //redirect(base_url() . 'index.php?admin/student_add/' . $data['class_id'], 'refresh');

        }
        if ($param2 == 'do_update') {
            $data['al_bairro']          = $this->input->post('al_bairro');
            $data['al_celular']         = formataCpfCepRgFone($this->input->post('al_celular'));
            $data['al_cep']             = formataCpfCepRgFone($this->input->post('al_cep'));
            $data['al_cidade']          = $this->input->post('al_cidade');
            $data['al_cod_usuario']     = $this->input->post('al_cod_usuario');
            $data['al_complemento']     = $this->input->post('al_complemento');
            $cpf = 
            $data['al_cpf']             = formataCpfCepRgFone($this->input->post('al_cpf'));
            $data['al_data_nasc']       = formataDataParaBanco($this->input->post('al_data_nasc'));            
            
            
            $data['al_email']           = $this->input->post('al_email');
            $data['al_fator_rh']        = $this->input->post('al_fator_rh');
            
            
            
            $data['al_fone']            = formataCpfCepRgFone($this->input->post('al_fone'));
            $data['al_foto']            = $this->input->post('al_foto');
            $data['al_logradouro']      = $this->input->post('al_logradouro');
            $data['al_nome']            = $this->input->post('al_nome');
            $data['al_nome_mae']        = $this->input->post('al_nome_mae');
            $data['al_numero']          = $this->input->post('al_numero');
            $data['al_org_emissor']     = $this->input->post('al_org_emissor');
            $data['al_rg']              = formataCpfCepRgFone($this->input->post('al_rg'));
            $data['al_sexo']            = $this->input->post('al_sexo');
            $data['al_status']          = $this->input->post('al_status');
            $data['al_uf']              = $this->input->post('al_uf');
            $data['al_codigo_classe']   = $this->input->post('al_codigo_classe');
            
            $this->db->where('al_id', $param3);
            
            
            if($this->db->update('aluno', $data)){                
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/aluno_image/' . $param3 . '.jpg');
                echo json_encode( array( 'msg' => 'sucesso') );                
            }else{
                echo json_encode( array( 'msg' => 'erro', 'mensagem' => $this->db->_error_message() . " - " . $this->db->_error_number()) );                
            }
            
            $this->crud_model->clear_cache();
            //echo json_encode( array( 'dados' => $this->input->post()) );
            //redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');
        } 
		
        if ($param2 == 'delete') {
            $this->db->where('al_id', $param3);
            $this->db->delete('aluno');
            $foto = 'uploads/aluno_image/'.$param3.'.jpg';
            if(file_exists($foto)){                
                unlink($foto);                
            }
            redirect(base_url() . 'index.php?admin/student_information/' . $param1, 'refresh');
        }
    }
    
    function getCidades($param1 = ""){
        if ($this->session->userdata('admin_login') != 1)
                    redirect('login', 'refresh');
        
        $cidade = $this->db->get_where('cidade', array(
                'cid_estado_id' => $param1
            ))->result_array();
        
        echo json_encode($cidade);
    }
     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        			= $this->input->post('name');
            $data['email']       			= $this->input->post('email');
            $data['password']    			= $this->input->post('password');
            $data['student_id']  			= $param2;
            $data['relation_with_student']  = $this->input->post('relation_with_student');
            $data['phone']       			= $this->input->post('phone');
            $data['address']     			= $this->input->post('address');
            $data['profession']  			= $this->input->post('profession');
            $this->db->insert('parent', $data);
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			
			 $class_id	=	$this->db->get_where('student', array('student_id'=>$data['student_id']))->row()->class_id;
            redirect(base_url() . 'index.php?admin/parent/' . $class_id , 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        			= $this->input->post('name');
            $data['email']       			= $this->input->post('email');
			
			 if ($this->input->post('password') != "")
            		$data['password']    		=  $this->input->post('password');
            $data['relation_with_student']  = $this->input->post('relation_with_student');
            $data['phone']       			= $this->input->post('phone');
            $data['address']     			= $this->input->post('address');
            $data['profession']  			= $this->input->post('profession');
            
            $this->db->where('parent_id', $param2);
            $this->db->update('parent', $data);
            
            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('parent', array(
                'parent_id' => $param3
            ))->result_array();
        } 
        if ($param1 == 'delete') {
            $this->db->where('parent_id', $param2);
            $this->db->delete('parent');
            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        }
        $page_data['class_id']   = $param1;
        $page_data['students']   = $this->db->get_where('student', array(
											'class_id' => $param1	))->result_array();
        $page_data['page_title'] 	= get_phrase('parent_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($param1);
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }
	
    
    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
    
        if ($param1 == 'create') {
            
            //retorna um array contendo os campos que são not null no banco de dados
            $array = camposNotNull('professor');
            //verifica se os campos not null estão preenchidos
            $validados = validaCamposNotNull($this->input->post(), $array);

            if(!empty($validados)){
                //print_r($validados);
                echo json_encode(array("msg" => "validacao", "validacao" => $validados));
                return;                       
            }
            
            $data['pr_nome']        = $this->input->post('pr_nome');
            $data['pr_nome_mae']    = $this->input->post('pr_nome_mae');
            $data['pr_cpf']         = formataCpfCepRgFone($this->input->post('pr_cpf'));           
            $data['pr_data_nasc']   = formataDataParaBanco($this->input->post('pr_data_nasc'));
            $data['pr_rg']          = $this->input->post('pr_rg');
            $data['pr_org_emissor'] = $this->input->post('pr_org_emissor');
            $data['pr_sexo']        = $this->input->post('pr_sexo');
            $data['pr_cep']         = formataCpfCepRgFone($this->input->post('pr_cep'));
            $data['pr_logradouro']  = $this->input->post('pr_logradouro');
            $data['pr_numero']      = $this->input->post('pr_numero');
            $data['pr_complemento'] = $this->input->post('pr_complemento');
            $data['pr_bairro']      = $this->input->post('pr_bairro');
            $data['pr_fone']        = formataCpfCepRgFone($this->input->post('pr_fone'));            
            $data['pr_celular']     = formataCpfCepRgFone($this->input->post('pr_fone'));
            $data['pr_email']       = $this->input->post('pr_email');
            $data['pr_formacao']    = $this->input->post('pr_formacao');
            $data['pr_foto']        = $this->input->post('pr_foto');
            $data['pr_cidade']      = $this->input->post('pr_cidade');
            $data['pr_uf']          = $this->input->post('pr_uf'); 
            
            
            if($this->db->insert('professor', $data)){
                $professor_id = mysql_insert_id();
                move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/professor_image/' . $professor_id . '.jpg');
                echo json_encode( array( 'msg' => 'sucesso') );      
                return;
            }else{
                echo json_encode( array( 'msg' => 'erro', 'mensagem' => $this->db->_error_message() . " - " . $this->db->_error_number()) );
                return;
            }
           
        }
        if ($param1 == 'do_update') {
            //sleep(1000);
            //retorna um array contendo os campos que são not null no banco de dados
            $array = camposNotNull('professor');
            //verifica se os campos not null estão preenchidos
            $validados = validaCamposNotNull($this->input->post(), $array);

            if(!empty($validados)){
                //print_r($validados);
                echo json_encode(array("msg" => "validacao", "validacao" => $validados));
                return;                       
            }
            
           $data['pr_nome']        = $this->input->post('pr_nome');
            $data['pr_nome_mae']    = $this->input->post('pr_nome_mae');
            $data['pr_cpf']         = formataCpfCepRgFone($this->input->post('pr_cpf'));           
            $data['pr_data_nasc']   = formataDataParaBanco($this->input->post('pr_data_nasc'));
            $data['pr_rg']          = $this->input->post('pr_rg');
            $data['pr_org_emissor'] = $this->input->post('pr_org_emissor');
            $data['pr_sexo']        = $this->input->post('pr_sexo');
            $data['pr_cep']         = formataCpfCepRgFone($this->input->post('pr_cep'));
            $data['pr_logradouro']  = $this->input->post('pr_logradouro');
            $data['pr_numero']      = $this->input->post('pr_numero');
            $data['pr_complemento'] = $this->input->post('pr_complemento');
            $data['pr_bairro']      = $this->input->post('pr_bairro');
            $data['pr_fone']        = formataCpfCepRgFone($this->input->post('pr_fone'));            
            $data['pr_celular']     = formataCpfCepRgFone($this->input->post('pr_celular'));
            $data['pr_email']       = $this->input->post('pr_email');
            $data['pr_formacao']    = $this->input->post('pr_formacao');
            $data['pr_foto']        = $this->input->post('pr_foto');
            $data['pr_cidade']      = $this->input->post('pr_cidade');
            $data['pr_uf']          = $this->input->post('pr_uf');
            $data['pr_status']      = $this->input->post('pr_status');
   
            
            $this->db->where('pr_id', $param2);
            
            
            if($this->db->update('professor', $data)){                
                move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/professor_image/' . $param2 . '.jpg');
                echo json_encode( array( 'msg' => 'sucesso') );                
            }else{
                echo json_encode( array( 'msg' => 'erro', 'mensagem' => $this->db->_error_message() . " - " . $this->db->_error_number()) );                
            }
            
            $this->crud_model->clear_cache();           
            return;
            //redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('professor', array(
                'pr_id' => $param2
            ))->result_array();
            
        }
        if ($param1 == 'delete') {
            $this->db->where('pr_id', $param2);
            $this->db->delete('professor');
            
            $foto = 'uploads/professor_image/'.$param2.'.jpg';
            if(file_exists($foto)){                
                unlink($foto);                
            }
            redirect(base_url() . 'index.php?admin/professor/','refresh');
            
            return;
           // redirect(base_url() . 'index.php?admin/teacher/',$param2,  'refresh');
        }if($param1 == 'listar'){
            
            $professor	= $this->db->get('professor' )->result_array();
            
            echo json_encode($professor);                
        }
        
        if($param1 == 'imagem'){
            echo json_encode($this->crud_model->get_image_url('professor',$param2));            
        }
        
    }
    
    
    function professor(){
        $page_data['teacher']   = $this->db->get('professor')->result_array();

        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['dis_descricao']       = $this->input->post('dis_descricao');
            $data['dis_sala_id']         = $this->input->post('dis_sala_id');
            $data['dis_professor_id']    = $this->input->post('dis_professor_id');
            $this->db->insert('disciplina', $data);
            redirect(base_url() . 'index.php?admin/subject/'.$data['dis_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['dis_descricao']       = $this->input->post('dis_descricao');
            $data['dis_sala_id']         = $this->input->post('dis_sala_id');
            $data['dis_professor_id']    = $this->input->post('dis_professor_id');
            
            $this->db->where('dis_id', $param2);
            $this->db->update('disciplina', $data);
            redirect(base_url() . 'index.php?admin/subject/'.$data['dis_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('disciplina', array(
                'dis_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dis_id', $param2);
            $this->db->delete('disciplina');
            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');
        }
        $page_data['dis_sala_id']   = $param1;
        $page_data['disciplina_get']   = $this->db->get_where('disciplina' , array('dis_sala_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['sl_descricao']   = $this->input->post('sl_descricao');
            $data['sl_desc_num']    = $this->input->post('sl_desc_num');
            $data['sl_prof_id']     = $this->input->post('sl_prof_id');
            $this->db->insert('sala', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['sl_descricao']   = $this->input->post('sl_descricao');
            $data['sl_desc_num']    = $this->input->post('sl_desc_num');
            $data['sl_professor']   = $this->input->post('sl_professor');
            
            $this->db->where('sl_id', $param2);
            $this->db->update('sala', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('sala', array(
                'sl_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('sl_id', $param2);
            $this->db->delete('sala');
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes_sala']    = $this->db->get('sala')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['comment'] = $this->input->post('comment');
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $data['mark_obtained'] = $this->input->post('mark_obtained');
            $data['attendance']    = $this->input->post('attendance');
            $data['comment']       = $this->input->post('comment');
            
            $this->db->where('mark_id', $this->input->post('mark_id'));
            $this->db->update('mark', $data);
            
            redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    
    
    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            $this->db->insert('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            $data['comment']     = $this->input->post('comment');
            
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                'grade_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['day']        = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']   = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['day']        = $this->input->post('day');
            
            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
	
	/****** DAILY ATTENDANCE *****************/
	function manage_attendance($date='',$month='',$year='',$class_id='')
	{
		if($this->session->userdata('admin_login')!=1)redirect('login' , 'refresh');
		
		if($_POST)
		{
			$verify_data	=	array(	'student_id' 		=> $this->input->post('student_id'),
										'date' 				=> $this->input->post('date'));
			$attendance = $this->db->get_where('attendance' , $verify_data)->row();
			$attendance_id		= $attendance->attendance_id;
			
			$this->db->where('attendance_id' , $attendance_id);
			$this->db->update('attendance' , array('status' => $this->input->post('status')));
			
			redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id , 'refresh');
		}
		$page_data['date']			=	$date;
		$page_data['month']		=	$month;
		$page_data['year']			=	$year;
		$page_data['class_id']	=	$class_id;
		
		$page_data['page_name']		=	'manage_attendance';
		$page_data['page_title']		=	get_phrase('manage_daily_attendance');
		$this->load->view('backend/index', $page_data);
	}
	function attendance_selector()
	{
		redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year').'/'.
							$this->input->post('class_id') , 'refresh');
	}
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->insert('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
            $this->db->insert('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']      = $this->input->post('status');
            
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['description']       = $this->input->post('description');
            $data['route_fare']        = $this->input->post('route_fare');
            
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            redirect(base_url() . 'index.php?admin/transport', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'do_update') {
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_title');
			 $this->db->where('type' , 'system_title');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('address');
			 $this->db->where('type' , 'address');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('phone');
			 $this->db->where('type' , 'phone');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('paypal_email');
			 $this->db->where('type' , 'paypal_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('currency');
			 $this->db->where('type' , 'currency');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_email');
			 $this->db->where('type' , 'system_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('buyer');
			 $this->db->where('type' , 'buyer');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('purchase_code');
			 $this->db->where('type' , 'purchase_code');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('language');
			 $this->db->where('type' , 'language');
			 $this->db->update('settings' , $data);
                         $this->session->set_userdata('current_language' , $data['description']);
			 
                         
			 $data['description'] = $this->input->post('text_align');
			 $this->db->where('type' , 'text_align');
			 $this->db->update('settings' , $data);
			 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
                            //$data[$language]	=	$this->input->post('phrase').$i;
                            $this->db->where('phrase_id' , $i);
                            $this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
}
