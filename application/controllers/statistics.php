<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends CI_Controller {

	private $limit = 10;
	var $terms = array();
	
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('schedule_model','admin_model','training_model','trainee_model','statistics_model'));
		$this->load->library('table');
		$this->load->helper('url');
		$this->check_session();
	}
	
	function trainees($mode = NULL)
	{
		
		$this->statistics_model->get_total_trainees($start,$end);
		
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
	
	//-----------------------Advanced Search
	function search($mode = "")
	{
		if ($mode == "location")
		{
			$data["total"] = $this->statistics_model->get_by_location()->row_array();
			$data["byregion"] = $this->statistics_model->get_by_location_group_by_region();
			$this->load->view("print/location",$data);
		}
		else
		{
			$data["modcode"] = $this->admin_model->get_all_modules()->result_array();
			$data["region"] = $this->admin_model->getregion()->result_array();
			#print_r($data["region"]); die();
			$this->load->view("AdvancedSearch",$data);
		}
	}
	//-----------------------End of Advanced Search
}