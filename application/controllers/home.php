<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		//$this->load->model(array("inventory_model"));
		$this->load->library("pagination");
		$this->load->model(array('admin_model','training_model','statistics_model','nea_model'));
		$this->load->library('table');
		$this->load->helper('url');
		#print_r($this->session->all_userdata());
	}
	
	public function index()
	{
		#print_r($this->session->all_userdata());
		$this->load->view('login');
	}
	
	public function list_()
	{
		$config['base_url'] = site_url('home/list_/');
		$config['total_rows'] = $this->nea_model->search_total_list_()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		
		//$data['records'] = $this->admin_model->searchtrainee(10);
		$data['rec'] = $this->nea_model->list_(10);
		//$data["rec"] = $this->Nea_model->list_();
		$this->load->view('nea/queuinglist',$data);
	}

	public function alreadyhadrd($id = null)
	{
		$this->admin_model->alreadyhadrd($id);

		redirect('List');
	
	}

	public function start($id = null)
	{
		$this->admin_model->start_($id);

		redirect('List');
	
	}

	public function stop($id = null)
	{
		$this->admin_model->stop_($id);

		redirect('List');
	
	}
	
	public function inventory()
	{
		$this->check_session();
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
	
	function check_superuser() 
	{
		if($this->session->userdata("user_level") != 99)
		{
			$this->session->set_flashdata('message','Delete Function for SuperUser');
			redirect('home/index');
		}
	}
	
	function changeyear()
	{
		$this->check_session();
		$this->load->view("ChangeYear");
	}
	
	function confirmchangeyear()
	{
		$this->form_validation->set_rules('year','Year','required|trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("ChangeYear");
		}
		else
		{
			$year = $this->input->post("year");
			$this->session->set_userdata(array("currentyear" => $year));
			$this->session->set_flashdata('message','Successfully Change year to '.$year.'!');
			redirect('home/changeyear');
		}
	}
	
	function options()
	{
		$data["year"] = $this->training_model->getselyear();
		$this->load->view("Option",$data);
	}
	
	function viewpayments()
	{
		$data["year"] = $this->training_model->getselyear();
		$this->load->view("Option",$data);
	}
	
	function confirmchangeoption()
	{
		$this->form_validation->set_rules('year','Year','required|trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->options();
		}
		else
		{
			$this->admin_model->changesystemyear();
			$this->session->set_flashdata('message','Successfully Change System year to '.$year.'!');
			redirect('home/options');
		}
	}
	
	public function validate()
	{
		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('username','username','required|trim|xss_clean');
		//$this->form_validation->set_rules('password','password','required|md5');
		$this->load->model('admin_model');
		$query = $this->admin_model->checklogin();
		$data['msg'] = 'asd';
		
		if ($query->num_rows() > 0)
		{
			$query = $query->row_array();
			$data = array(
				'username' => $this->input->post('username'),
				'userid' => $query["idnum"],
				'user_level' => $query['priv'],
				'is_logged' => TRUE,
				'userfullname' => $query["fullname"],
				'currentyear' => date("Y"),
				'venid' => $query["venid"],
				);
			$this->session->set_userdata($data);
			
			if ($query["priv"] == 3 or $query["priv"] == 4)
			{
				redirect('cash');
			}
			else
			{
				//redirect('home/searchtrainee');
				redirect('home/list_');
			}
			
		} else {
			$data['msg'] = '<div class="errorMessage">Invalid username and/or password.</div>';
			$this->load->view('login', $data);
		}
	}
	
	public function addusers()
	{
		$this->check_session();
		$data['employees'] = $this->admin_model->get_employee();
		$data['venue'] = $this->admin_model->getvenue()->result_array();
		$this->load->view('UsersAdd',$data);
	}
	
	function confirmadduser()
	{
		$this->check_session();
		$this->form_validation->set_rules('empid', 'Employee', 'callback_empnamecheck');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[passwordf]|xss_clean');
		$this->form_validation->set_rules('passwordf', 'Password Confirmation', 'trim|min_length[5]|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['employees'] = $this->admin_model->get_employee();
			$this->load->view('UsersAdd',$data);
		}
		else
		{
			$this->admin_model->add_user();
			$this->admin_model->insertlogs($this->db->insert_id(),$this->db->last_query());
			$this->session->set_flashdata('message','Successfully added a new Account!');
			$data['employees'] = $this->admin_model->get_employee();
			redirect('home/addusers');
		}
		
	}
	
	public function empnamecheck($str)
	{
		if ($str == '#' or $str == '')
		{
			$this->form_validation->set_message('empnamecheck', 'Please select an employee');
			return FALSE;
		}
		return TRUE;
	}
	
	public function admin()
	{
		$this->check_session();
		
		$data["total_trainees"] = $this->statistics_model->total_trainees()->row_array();
		$data["total_unique_trainees"] = $this->statistics_model->get_total_trainees_unique()->row_array();
		$data["get_total_trainees"] = $this->statistics_model->get_total_trainees()->row_array();
		
		
		$data["unique_month"] = $this->statistics_model->get_total_trainees_month_unique()->row_array();
		
		$data["female"] = $this->statistics_model->get_female()->row_array();
		$data["male"] = $this->statistics_model->get_male()->row_array();
		
		$data["module"] = $this->statistics_model->get_most_taken_module()->result_array();
		
		$this->session->unset_userdata("trid");
		$this->load->view('admin_view',$data);
	}
	
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}
	
	public function searchtrainee()
	{
		
		$this->check_session();
		$this->session->unset_userdata("trid");
		$lname = $this->input->post('txtlname');
		$fname = $this->input->post('txtfname');
		
		if (empty($lname) && empty($fname))
		{
			$this->session->unset_userdata('lname');
			$this->session->unset_userdata('fname');
		}
		else
		{
			$this->session->set_userdata(array('lname' => $lname,'fname' => $fname,'reg' => 1));
		}
		
		$this->searchtrainee2();
	}
	
	public function searchtrainee2()
	{
		$this->check_session();
		
		$config['base_url'] = site_url('home/searchtrainee2/');
		$config['total_rows'] = $this->admin_model->search_total_trainee()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$this->pagination->initialize($config);
		
		//$data['records'] = $this->admin_model->searchtrainee(10);
		$query = $this->admin_model->searchtrainee(10)->result_array();
		
		foreach ($query as $key => $row )
		{
			//add new columns with a value
			$query[$key]['extra_column2'] = "<a href='delete/" . $row['trid'] . "'>Delete</a>";
			$query[$key]['extra_column'] = "<a href='edit'>Edit</a>";
			//...
			// Note: the original data for this row is in $row if you need data from it
		}
		
		$data['records'] = $query;
		
		#print_r($this->session->all_userdata());
		$this->load->view('admin', $data);
	}
	
	public function about()
	{
		$this->check_session();
		//print_r($this->session->all_userdata());
		$this->load->view('About');
	}
	
	//---------------------------License---------------------------
	//-------------------------------------------------------------
	public function License()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/license/');
		$config['total_rows'] = $this->admin_model->total_table_result('license')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'license','license')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('License',$data);
	}
	
	public function deletelicense($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$query = $this->admin_model->search_if_pk_is_used('license','training','licid',$code);
		if ($query->num_rows > 0)
		{
			$this->session->set_flashdata('message','CANNOT DELETE DATA, this RECORD is in USE.');
			redirect('home/license');
		}
		
		$this->admin_model->delete_table($code,'license','licid');
		$this->admin_model->insertlogs(0,"License " . $this->db->last_query());
		redirect('home/license');
	}
	
	function savelicense()
	{
		$this->check_session();
		$this->form_validation->set_rules('license','License', 'required');
		$this->form_validation->set_rules('licname','License Name',
		'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->admin_model->save_license();
			$this->admin_model->insertlogs($this->db->insert_id(),"License " . $this->db->last_query());
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/license');
		}
		else
		{
		   redirect('home/license');
		}
		
	}
	
	//---------------------------Rank---------------------------
	//-------------------------------------------------------------
	public function rank()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/rank/');
		$config['total_rows'] = $this->admin_model->total_table_result('rank')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'rank','rank')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('Rank',$data);
	}
	
	public function deleterank($code = NULL)
	{
		$this->check_session();
		$this->check_superuser();
		
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$query = $this->admin_model->search_if_pk_is_used('rank','training','rankid',$code);
		if ($query->num_rows > 0)
		{
			$this->session->set_flashdata('message','CANNOT DELETE DATA, this RECORD is in USE.');
			redirect('home/rank');
		}
		
		$this->admin_model->delete_table($code,'rank','rankid');
		$this->admin_model->insertlogs(0,"License " . $this->db->last_query());
		redirect('home/rank');
	}
	
	function saverank()
	{
		$this->check_session();
		$this->form_validation->set_rules('rank','Rank', 'required');
		$this->form_validation->set_rules('rankshort','Rank Short',
		'required');
		$this->form_validation->set_rules('ranktype','Rank Type',
		'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->save_rank();
			$this->admin_model->insertlogs($this->db->insert_id(),"Rank " . $this->db->last_query());
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/rank');
		}
		else
		{
		   redirect('home/rank');
		}
		
	}
	
	//---------------------------Position---------------------------
	//-------------------------------------------------------------
	public function position()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/position/');
		$config['total_rows'] = $this->admin_model->total_table_result('position')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'position','position')->result_array();
		$this->pagination->initialize($config);
		
		$this->load->view('Position',$data);
	}
	
	public function deleteposition($code = NULL)
	{
		$this->check_session();
		$this->check_superuser();
		
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$this->admin_model->delete_table($code,'position','posid');
		redirect('home/position');
	}
	
	function saveposition()
	{
		$this->check_session();
		$this->form_validation->set_rules('position','Position', 'required');
		$this->form_validation->set_rules('posshort','Position Short',
		'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->save_position();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/position');
		}
		else
		{
		   redirect('home/position');
		}
		
	}
	
	//---------------------------Sponsor---------------------------
	//-------------------------------------------------------------
	public function sponsor()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/sponsor/');
		$config['total_rows'] = $this->admin_model->total_table_result('sponsor_type')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		$data['records'] = $this->admin_model->searchtable(10,'sponsor_type','sptypename')->result_array();
		$this->pagination->initialize($config);
		
		$this->load->view('Sponsor',$data);
	}
	
	public function deletesponsor($code = NULL)
	{
		$this->check_session();
		$this->check_superuser();
		
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$query = $this->admin_model->search_if_pk_is_used('sponsor_type','training','sponid',$code);
		if ($query->num_rows > 0)
		{
			$this->session->set_flashdata('message','CANNOT DELETE DATA, this RECORD is in USE.');
			redirect('home/sponsor');
		}
		
		$this->admin_model->delete_table($code,'sponsor_type','sponid');
		$this->admin_model->insertlogs(0,"Sponsor " . $this->db->last_query());
		redirect('home/sponsor');
	}
	
	function savesponsor()
	{
		$this->check_session();
		$this->form_validation->set_rules('sponsor','Sponsor', 'required');
		$this->form_validation->set_rules('sponshort','Sponsor Short','required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->save_sponsor();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/sponsor');
		}
		else
		{
		   redirect('home/sponsor');
		}
		
	}
	
	function editsponsor()
	{
		$this->check_session();
		$this->form_validation->set_rules('sponid','Sponsor', 'required|xss');
		$this->form_validation->set_rules('sponsor','Sponsor Name','required|xss');
		$this->form_validation->set_rules('sponshort','Sponsor Short','required|xss');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->edit_sponsor();
			$this->admin_model->insertlogs(0,$this->db->last_query());
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/sponsor');
		}
		else
		{
		   redirect('home/sponsor');
		}
	}

	//---------------------------Employer---------------------------
	//-------------------------------------------------------------
	public function employer()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/employer/');
		$config['total_rows'] = $this->admin_model->total_table_result('employer')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'employer','name')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('Employer',$data);
	}
	
	public function deleteemployer($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$this->admin_model->delete_table($code,'employer','employid');
		$this->admin_model->insertlogs(0,$this->db->last_query());
		redirect('home/employer');
	}
	
	function saveemployer()
	{
		$this->check_session();
		$this->form_validation->set_rules('employer','Employer Name', 'required');
		$this->form_validation->set_rules('address1','Address 1','');
		$this->form_validation->set_rules('address2','Address 2','');
		$this->form_validation->set_rules('contactnum','Contact No.','');
		$this->form_validation->set_rules('contactname','Contact Name','');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->admin_model->save_employer();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/employer');
		}
		else
		{
		   $this->employer();
		}
		
	}
	
	//-----------------------------------End of Employer
	//--------------------------------------------------
	
	//---------------------------Courses---------------------------
	//-------------------------------------------------------------

	public function course()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/course/');
		$config['total_rows'] = $this->admin_model->total_table_result('course')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'course','course')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('Course',$data);
	}
	
	public function deletecourse($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$query = $this->admin_model->search_if_pk_is_used('course','courseid',$code);
		if ($query->num_rows > 0)
		{
			$this->session->set_flashdata('message','CANNOT DELETE DATA, this RECORD is in USE.');
			redirect('home/course');
		}
		
		$this->admin_model->delete_table($code,'course','courseid');
		redirect('home/course');
	}
	
	function savecourse()
	{
		$this->check_session();
		$this->form_validation->set_rules('course','Course', 'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->admin_model->save_course();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/course');
		}
		else
		{
		   redirect('home/course');
		}
		
	}
	
	//-----------------------------------End of Courses
	//--------------------------------------------------
	
	
	//---------------------------Schools---------------------------
	//-------------------------------------------------------------

	
	public function schoolsearch()
	{
		$this->check_session();
		$this->session->unset_userdata("school");
		$school = $this->input->post('school2');
		if (empty($school))
		{
			$this->session->unset_userdata('school');
		}
		else
		{
			$this->session->set_userdata(array('school' => $school));
		}
		
		$this->school();
	}
	
	public function school()
	{
		$this->check_session();
		$school = $this->session->userdata("school");
		$config['base_url'] = site_url('home/school/');
		$config['total_rows'] = $this->admin_model->total_table_result('school','school',$school)->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'school','school','school',$school)->result_array();
		$this->pagination->initialize($config);
		#print_r($this->session->all_userdata());
		$this->load->view('School',$data);
	}
	
	public function deleteschool($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$query = $this->admin_model->search_if_pk_is_used('school','trainee','schoolid',$code);
		if ($query->num_rows > 0)
		{
			$this->session->set_flashdata('message','CANNOT DELETE DATA, this RECORD is in USE.');
			redirect('home/school');
		}
		
		$this->admin_model->delete_table($code,'school','schoolid');
		redirect('home/school');
	}
	
	function saveschool()
	{
		$this->check_session();
		$this->form_validation->set_rules('school','school', 'required');
		$this->form_validation->set_rules('address','address', 'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->admin_model->save_school();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/school');
		}
		else
		{
		   redirect('home/school');
		}
		
	}
	
	//-----------------------------------End of School
	//--------------------------------------------------
	
	
	
	//---------------------------Trainers---------------------------
	//-------------------------------------------------------------

	public function trainer()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/trainer/');
		$config['total_rows'] = $this->admin_model->total_table_result('trainer')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$data['records'] = $this->admin_model->searchtable(10,'trainer','lname,fname')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('Trainer',$data);
	}
	
	public function deletetrainer($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$this->admin_model->delete_table($code,'trainer','trainerid');
		redirect('home/trainer');
	}
	
	function savetrainer()
	{
		$this->check_session();
		$this->form_validation->set_rules('lname','Last Name', 'required');
		$this->form_validation->set_rules('fname','First Name', 'required');
		$this->form_validation->set_rules('mname','Middle Name', 'required');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->admin_model->save_trainer();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Trainer has been Added!</strong></p></div>');	
			redirect('home/trainer');
		}
		else
		{
		   redirect('home/trainer');
		}
		
	}
	
	//-----------------------------------End of Trainers
	//--------------------------------------------------
	
	
	public function lastenrolled()
	{
		$this->check_session();
		$data['records'] = $this->admin_model->last_enrolled()->result_array();
		$this->load->view("Lastenrolled",$data);
	}
	
	//-----------------------On Change Event

    public function getfee($module)
	{
		$data['module_details'] = $this->admin_model->getmoduledetails($module);
		$data['schedule'] = $this->admin_model->getschedule($module);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	//-------------------------Trainee New-----------------
	public function getaddress($address)
	{	
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->admin_model->getaddress($address)));
	}
	
	public function getavailableschedule($module)
	{	
		$selyear = $this->session->userdata("currentyear");
		$data["backtrack"] = $this->session->userdata("backtrack");
		$data["selyear"] = $selyear;
		$data['module_details'] = $this->admin_model->getavailableschedule($module,$selyear);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function gettown($region)
	{	
		$data['region'] = $this->admin_model->gettown($region);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function gettown2($region)
	{	
		$data['region'] = $this->admin_model->gettown2($region);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getprovince($region)
	{	
		$data['region'] = $this->admin_model->getprovince($region);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getzip($zip)
	{	
		$data['zip'] = $this->admin_model->getzip($zip);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getcoursejson()
	{	
		$data['course'] = $this->admin_model->getcoursejson();
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getschooljson()
	{	
		$data['school'] = $this->admin_model->getschooljson();
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getcertificateseries($module)
	{
		$data["series"] = $this->admin_model->getcertificateseries($module);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getalladdress($string)
	{
		$data["alladdress"] = $this->admin_model->getalladdress($string);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getsponsor($sponid = 0)
	{
		
		$query = $this->admin_model->getsponsor($sponid);
		if($query->result())
		{
			foreach ($query->result() as $mod) 
			{
				$data[$mod->sponid] = array(
					'sptypename' => $mod->sptypename,
					'sptypeshort' => $mod->sptypeshort,
					);
			}
		}
		$lols["sponsor"] = $data;
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($lols));
	}
	
	public function getlicense_ajax()
	{
		$data["license"] = $this->admin_model->getlicense()->result_array();
		$data["rank"] = $this->admin_model->getrank()->result_array();
		$data["employer"] = $this->admin_model->getemployer()->result_array();
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getvessel_ajax()
	{
		$this->check_session();
		$data["vessel"] = $this->admin_model->getvessel()->result_array();
		$data["vessize"] = $this->admin_model->getvesselsize()->result_array();
		$data["vesflag"] = $this->admin_model->getvesselflag()->result_array();
		
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	//----------------End of On Change Event-----------------------
	
}
