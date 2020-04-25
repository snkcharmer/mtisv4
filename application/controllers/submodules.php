<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submodules extends CI_Controller {
		
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
		$modcode = $this->input->post('submodid');
		
		if (empty($submodid))
		{
			$this->session->unset_userdata('submodid');
		}
		else
		{
			$this->session->set_userdata(array('submodid' => $submodid));
		}
		
		$this->search2();
	}
	
	public function search2()
	{
		$config['base_url'] = site_url('submodules/search2/');
		$config['total_rows'] = $this->admin_model->search_total_submodule()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->admin_model->searchsubmodule(10)->result_array();
		
		$data['records'] = $query;
		
		#print_r($this->session->all_userdata());
		$this->load->view('Submodules', $data);
	}
	
	public function edit($submodid = NULL)
	{
		$this->session->set_userdata(array("submodid" => $submodid));
		$data["modules"] = $this->admin_model->get_all_modules();
		$data["mod"] = $this->admin_model->get_selected_submodule($submodid)->row();
		$this->load->view('SubmodulesEdit', $data);
	}
	
	public function add()
	{
		$data["modules"] = $this->admin_model->get_all_modules();
		$this->load->view('SubmodulesAdd',$data);
	}
	
	public function validatemodule()
	{
		$this->form_validation->set_rules('modcode','Module Name', 'required|xss');
		$this->form_validation->set_rules('submodule','Short Name', 'required|xss');
		$this->form_validation->set_rules('description','No. of Days', 'required|xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{
			return TRUE;
		}
		
		return FALSE;

	}
	
	public function edit_module()
	{
		$result = $this->validatemodule();
		if ($result == TRUE)
		{
			$this->admin_model->editsubmodule();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Record Saved!</strong></p></div>');	
			redirect('submodules/edit/'.$this->session->userdata("submodid"));
		}
		else
		{
			$this->edit();
		}
	}
	
	public function add_module()
	{
		$result = $this->validatemodule();
		if ($result == TRUE)
		{
			$this->admin_model->addsubmodule();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Record Saved!</strong></p></div>');	
			redirect('submodules/add');
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