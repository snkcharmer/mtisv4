<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbas extends CI_Controller {
	
	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		//$this->load->model(array("inventory_model"));
		$this->load->library("pagination");
		$this->load->model(array('admin_model','training_model'));
		$this->load->library('table');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function inventory()
	{
		$this->check_session();
		$this->load->model('');
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
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
				'user_level' => $query['usertype'],
				'is_logged' => TRUE
				);
			$this->session->set_userdata($data);
			
			if ($query["usertype"] == 3)
			{
				redirect('cash');
			}
			else
			{
				redirect('home/admin');
			}
		} else {
			$data['msg'] = '<div class="errorMessage">Invalid username and/or password.</div>';
			$this->load->view('login', $data);
		}
	}
	
	public function admin()
	{
		$this->check_session();
		$this->load->view('admin_view');
	}
	
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}
	
	public function searchtrainee()
	{
		
		$this->check_session();
		$lname = $this->input->post('txtlname');
		$fname = $this->input->post('txtfname');
		
		if (empty($lname) && empty($fname))
		{
			$this->session->unset_userdata('lname');
			$this->session->unset_userdata('fname');
		}
		else
		{
			$this->session->set_userdata(array('lname' => $lname,'fname' => $fname));
		}
		
		$this->searchtrainee2();
	}
	
	public function searchtrainee2()
	{
		$this->check_session();
		
		$config['base_url'] = site_url('home/searchtrainee2/');
		$config['total_rows'] = $this->admin_model->search_total_trainee()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
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
	
	public function Edit($trid)
	{
		$this->check_session();
		$data['row'] = $this->admin_model->searchtrid($trid)->row_array();
		$data['town'] = $this->admin_model->getidnum($data['row']['locid'])->row_array();
		$data['civstat'] = $this->admin_model->getcivstat()->result_array();
		$data['courses'] = $this->admin_model->getcourse()->result_array();
		$data['religion'] = $this->admin_model->getreligion()->result_array();
		$this->session->set_userdata(array("trid" => $trid));
		#print_r($this->session->all_userdata());
		#print_r($data['town']);
		$this->load->view('GeneralInformation', $data);
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
		
		$this->admin_model->delete_table($code,'license','licid');
		redirect('home/License');
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
		
		$data['records'] = $this->admin_model->searchtable(10,'rank','rank')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('rank',$data);
	}
	
	public function deleterank($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$this->admin_model->delete_table($code,'rank','rankid');
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
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/rank');
		}
		else
		{
		   redirect('home/rank');
		}
		
	}
	
	//---------------------------Employer---------------------------
	//-------------------------------------------------------------
	public function employer()
	{
		$this->check_session();
		$config['base_url'] = site_url('home/employer/');
		$config['total_rows'] = $this->admin_model->total_table_result('sponsor')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$data['records'] = $this->admin_model->searchtable(10,'sponsor','name')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('employer',$data);
	}
	
	public function deleteemployer($code = NULL)
	{
		$this->check_session();
		if ($code == NULL) {
			redirect('home/admin');
		}
		
		$this->admin_model->delete_table($code,'ranks','rankid');
		redirect('home/rank');
	}
	
	function saveemployer()
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
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/rank');
		}
		else
		{
		   redirect('home/rank');
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
		
		$data['records'] = $this->admin_model->searchtable(10,'trainer','lname,fname')->result_array();
		$this->pagination->initialize($config);
		$this->load->view('trainer',$data);
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
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Schedule Saved!</strong></p></div>');	
			redirect('home/trainer');
		}
		else
		{
		   redirect('home/trainer');
		}
		
	}
	
	//-----------------------------------End of Trainers
	//--------------------------------------------------
	
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
		$selyear = $this->training_model->getselyear();
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
	
	public function getzip($zip)
	{	
		$data['zip'] = $this->admin_model->getzip($zip);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function getcertificateseries($module)
	{
		$data["series"] = $this->admin_model->getcertificateseries($module);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	//----------------End of On Change Event-----------------------
	
	
}
