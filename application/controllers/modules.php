<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends CI_Controller {
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('admin_model','trainee_model','schedule_model','training_model'));
		$this->load->library('table');
		$this->load->helper('url');
		$this->check_session();
		//print_r($this->session->all_userdata());
	}
	
	public function search()
	{
		$modcode = $this->input->post('modcode');
		
		if (empty($modcode))
		{
			$this->session->unset_userdata('modcode');
		}
		else
		{
			$this->session->set_userdata(array('modcode' => $modcode));
		}
		
		$this->search2();
	}
	
	public function search2()
	{
		$config['base_url'] = site_url('modules/search2/');
		$config['total_rows'] = $this->admin_model->search_total_module()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$query = $this->admin_model->searchmodule(10)->result_array();
		
		$data['records'] = $query;
		
		#print_r($this->session->all_userdata());
		$this->load->view('Modules', $data);
	}
	
	public function edit($modcode = NULL)
	{
		$this->session->set_userdata(array('modcode' => $modcode));
		#print_r($this->session->all_userdata());
		$data["mod"] = $this->admin_model->get_selected_module($modcode)->row();
		$this->load->view('ModulesEdit', $data);
	}
	
	public function add()
	{
		#print_r($this->session->all_userdata());
		$this->load->view('ModulesAdd');
	}
	
	public function validatemodule()
	{
		$this->form_validation->set_rules('descriptn','Module Name', 'required|xss');
		$this->form_validation->set_rules('modsht','Short Name', 'required|xss');
		$this->form_validation->set_rules('ndays','No. of Days', 'required|xss');
		$this->form_validation->set_rules('hours','Hours', 'required|xss');
		$this->form_validation->set_rules('fee','Fee', 'required|xss');
		$this->form_validation->set_rules('venue','Venue', 'required|xss');
		$this->form_validation->set_rules('section','No. of Section', 'required|xss');
		$this->form_validation->set_rules('max','Max no. of trainee', 'required|xss');
		$this->form_validation->set_rules('certnum','Certificate Number', 'required|xss');
		$this->form_validation->set_rules('compendium','Compendium', 'xss');
		$this->form_validation->set_rules('assessment','Assessment Fee', 'xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function edit_module()
	{
		$result = $this->validatemodule();
		if ($result == TRUE)
		{
			$year = $this->training_model->getselyear();
			$this->admin_model->editmodule($year);
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Successfully Update Module!</strong></p></div>');	
			redirect('modules/edit/'.$this->session->userdata("modcode"));
		}
		else
		{
			$this->edit($this->session->userdata("modcode"));
		}
	}
	
	public function add_module()
	{
		$result = $this->validatemodule();
		if ($result == TRUE)
		{
			$year = $this->training_model->getselyear();
			$this->admin_model->addmodule($year);
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Record Saved!</strong></p></div>');	
			redirect('modules/add');
		}
		else
		{
			$this->add();
		}
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
}