<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment extends CI_Controller 
{
	function __construct ()
	{
		parent:: __construct();
		$this->load->library(array("pagination","table","session"));
		$this->load->model(array('admin_model','employment_model'));
		$this->load->helper('url');
		$this->check_session();
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
	
	public function getemploymentprofile_all_ajax($empid = 0,$emprofid = 0)
	{
		$this->check_session();
		if ($emprofid == 0) {
			$data = $this->employment_model->get_employment_profile_all($empid,$emprofid)->result_array();
		} else {
			$data = $this->employment_model->get_employment_profile_all($empid,$emprofid)->row_array();
		}
		// var_dump($data);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function addemployment_ajax()
	{
		$this->check_session();
		$data = $this->input->post("empid");
		$this->employment_model->add_employment_profile($data);
		// $data = $this->input->post("empid");
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function updateemployment_ajax()
	{
		$this->check_session();
		$this->employment_model->update_employment_profile();
		$data = $this->input->get("emprofid");
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function connectemployment_ajax()
	{
		$this->check_session();
		$trainingid = $this->input->post("trainingid");
		$emprofid = $this->input->post("emprofid");
		// $data = $trainingid . " " . $emprofid;
		// print_r($trainingid);
		$data = $this->employment_model->connect_employment_profile($trainingid,$emprofid);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function deleteemployment_ajax()
	{
		$this->check_session();
		$this->load->model('trainee_model');
	}
}