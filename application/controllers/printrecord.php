<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PrintRecord extends CI_Controller {
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('cash_model','admin_model','trainee_model','schedule_model'));
		$this->load->library('table');
		$this->load->helper('url');
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
	
	function proofofregistration($trainingid)
	{
		$this->check_session();
		$data['trainee'] = $this->trainee_model->complete_trainee_info($this->session->userdata('trid'))->row_array();
		$payid = $this->cash_model->getpayid($trainingid)->row_array();
		$data['training'] = $this->cash_model->get_portrainingfees($payid["payid"]);
		$data['misc'] = $this->cash_model->get_pormiscfees($payid["payid"],$payid["payid2"]);
		$this->load->view('print/proofofregistration',$data);
	}
	
	function printregistrationform($code = 0)
	{
		$this->check_session();
		$data['trainee'] = $this->trainee_model->printregistrationform($code);
		$this->load->view('print/printregistrationform',$data);
		#print_r($this->db->last_query()); die();
	}
	
	function printregformtrainee($trainingid = 0)
	{
		$this->check_session();
		$data['trainee'] = $this->trainee_model->printregformtrainee($trainingid);
		$this->load->view('print/printregistrationform2',$data);
		#print_r($this->db->last_query()); die();
	}
	
	function idfront()
	{
		$this->check_session();
		$data["trainee"] = $this->trainee_model->searchtrainee($this->session->userdata("trid"))->row_array();
		$this->load->view("print/idfront",$data);
	}
	
	function idback()
	{
		$this->check_session();
		$data["trainee"] = $this->trainee_model->searchtrainee($this->session->userdata("trid"))->row_array();
		$this->load->view("print/idback",$data);	
	}
	
}