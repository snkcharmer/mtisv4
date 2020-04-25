<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('schedule_model','admin_model','training_model','trainee_model'));
		$this->load->library('table');
		$this->load->helper('url');
		$this->check_session();
		//print_r($this->session->all_userdata());
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('home/index');
		}
	}
	
	function check_admin() 
	{
		if($this->session->userdata("user_level")!=1)
		{
			redirect('home/index');
		}
	}
	
	function check_registrar() 
	{
		if($this->session->userdata("user_level") == 1 or $this->session->userdata("user_level") == 2)
		{
			
		} else { redirect('home/index'); }
	}
	
	public function index()
	{
		$search = $this->input->post('search');
		
		if (empty($search))
		{
			$this->session->unset_userdata('search');
		}
		else
		{
			$this->session->set_userdata(array('search' => $search));
		}
		
		$this->index2();
	}
	
	public function index2()
	{
		$config['base_url'] = site_url('schedule/index2');
		$config['total_rows'] = $this->schedule_model->search_total_schedule()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->schedule_model->searchschedule(10)->result_array();

		$data['records'] = $query;
		#print_r($this->session->all_userdata());
		$this->load->view('Schedule', $data);
	}
	
	public function add()
	{
		$data['module'] = $this->admin_model->getmodule();
		$data["venue"] = $this->admin_model->getvenue()->result_array();
		$this->load->view('ScheduleAdd',$data);
	}
	
	public function Edit($code)
	{
		$this->session->set_userdata(array("code" => $code));
		$data['module'] = $this->admin_model->getmodule();
		$data['mod'] = $this->admin_model->getmod($code)->row();
		$data['records'] = $this->schedule_model->getschedule($code);
		$data['venue1'] = $this->admin_model->getvenue1();
		
		
		#print_r($this->session->all_userdata());
		$this->load->view('ScheduleEdit',$data);
	}
	
	public function validateschedule()
	{
		//$this->form_validation->set_rules('code','Code', 'required|xss');
		$this->form_validation->set_rules('batch','Batch', 'required|xss');
		$this->form_validation->set_rules('start','Start', 'required|xss');
		$this->form_validation->set_rules('end','End', 'required|xss');
		$this->form_validation->set_rules('ndays','No. of Days', 'required|xss');
		$this->form_validation->set_rules('hours','Hours', 'xss');
		$this->form_validation->set_rules('fee','Fee', 'required|xss');
		$this->form_validation->set_rules('room','Room', 'required|xss');
		$this->form_validation->set_rules('venue','Venue', 'required|xss');
		$this->form_validation->set_rules('max','Max', 'required|xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
	
		if($this->form_validation->run()==TRUE)
		{ 
			$this->schedule_model->addschedule();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Added New Schedule!</div>');	
			redirect('schedule/add');
		}
		else
		{
		   $this->add();
		}
	}
	
	public function validateedit()
	{
		$this->form_validation->set_rules('batch','Batch', 'required|xss');
		$this->form_validation->set_rules('start','Start', 'required|xss');
		$this->form_validation->set_rules('end','End', 'required|xss');
		$this->form_validation->set_rules('ndays','No. of Days', 'required|xss');
		$this->form_validation->set_rules('hours','Hours', 'xss');
		$this->form_validation->set_rules('fee','Fee', 'required|xss');
		$this->form_validation->set_rules('room','Room', 'required|xss');
		$this->form_validation->set_rules('venue','Venue', 'required|xss');
		$this->form_validation->set_rules('max','Max', 'required|xss');
		
		if($this->form_validation->run()==TRUE)
		{ 
			$this->schedule_model->editschedule();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Schedule has been successfully updated!</div>');
			redirect('schedule/edit/'.$this->session->userdata("code"));
		}
		else
		{
		   $this->edit($this->session->userdata("code"));
		}
	}
	
	#--------------------------- Grades ---------------------------------
	public function grades($code = NULL)
	{
		$this->session->set_userdata(array("code" => $code));
		$data["code"] = $code;
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		#$data['withSubmod'] = $this->training_model->check_submodules($code)->num_rows();
		
		$data['records'] = $this->training_model->get_training_records($code)->result_array();
		$data['schedule'] = $this->schedule_model->get_schedule_complete($code)->row_array();
		#print_r($this->session->all_userdata());
		$this->load->view('Grades',$data);
	}
	
	public function editgrades()
	{
		$code = $this->session->userdata("code");
		
		#$data['records'] = $this->training_model->get_training_records($code)->result_array();
		$data['records'] = $this->training_model->get_training_records($code);
		$data['schedule'] = $this->schedule_model->get_schedule_complete($code)->row_array();
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		#$data['code'] = $code;
		#$data['submodsched'] = $this->training_model->get_submodules_of_sched($code);
		
		#print_r($data['records1']); die();
		$this->load->view('GradesEdit',$data);
	}
	
	public function confirmeditgrades()
	{
		$code = $this->session->userdata("code");
		$this->training_model->editgrade($code);
		
		$this->session->set_flashdata('message_type', 'warning'); 
		$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Schedule has been successfully updated!</div>');
		redirect('schedule/grades/'.$code);
	}
	
	public function printgrade($code = NULL)
	{
		$data["trainercount"] = $this->schedule_model->trainer_count($code)->row();
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		
		$data['records'] = $this->training_model->get_training_records($code)->result_array();
		// $this->load->view('print/printgrades',$data);
		$html = $this->load->view('print/printgrades',$data,true);
		$this->printthis($html);
	}
	
	public function verifygrade($code = 0)
	{
		$this->check_admin();
		$this->schedule_model->verify_grade($code);
		redirect("schedule/grades/".$code);
	}
	
	public function uncheckgrade($code = 0)
	{
		$this->check_registrar();
		$result = $this->schedule_model->uncheck_grade($code);
		if ($result == FALSE)
		{
			$this->session->set_flashdata("error","Schedule is already verified! Request admin to unverify schedule.");
		}
		redirect("schedule/grades/".$code);
	}
	
	public function checkgrade($code = 0)
	{
		$this->check_registrar();
		$this->schedule_model->check_grade($code);
		
		redirect("schedule/grades/".$code);
	}
	
	
	#--------------------------- End of Grades ---------------------------------
	#--------------------------- Certificate ---------------------------------
	
	public function certificate($code = NULL)
	{
		$this->session->set_userdata(array("code" => $code));
		$data['records'] = $this->training_model->get_training_records($code);
		$data['schedule'] = $this->schedule_model->get_schedule_complete($code)->row_array();
		$this->session->set_userdata(array("mjcode" => $data['schedule']['modcode']));
		#print_r($this->session->all_userdata());
		$this->load->view('Certificate',$data);
	}
	
	public function editcertificate()
	{
		$code = $this->session->userdata("code");
		$data['records'] = $this->training_model->get_training_records($code);
		$data['schedule'] = $this->schedule_model->get_schedule_complete($code)->row_array();
		$data['end'] = $this->admin_model->getmod($code)->row();
		
		#print_r($this->session->all_userdata());
		$this->load->view('CertificateEdit',$data);
	}
	
	public function reissuance_certificate(){
		
		$code = $this->session->userdata("code");
		$data['records'] = $this->training_model->get_reissuance_certificate();
		$data['schedule'] = $this->schedule_model->get_schedule_complete($code)->row_array();
		$data['end'] = $this->admin_model->getmod($code)->row();

		$this->load->view('nea/reissuance_cert',$data);		
	}
	
	public function confirmreissuedcert()
	{
		$code = $this->session->userdata("code");
		$data = $this->training_model->get_training_data_()->result_array();
		$this->training_model->confirmreissuedcert($code,$data);
		
		redirect('schedule/certificate/'.$code);
	}
	
	public function confirmeditcertificate()
	{
		$code = $this->session->userdata("code");
		$this->training_model->editcertificate($code);
		
		$this->session->set_flashdata('message_type', 'warning'); 
		$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Schedule has been successfully updated!</div>');
		redirect('schedule/certificate/'.$code);
	}
	
	public function printcertificate($code = NULL)
	{
		$code = $this->session->userdata("code");
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['records'] = $this->training_model->get_training_records($code);
		##print_r($this->session->all_userdata());
		$this->load->view('print/printcertificate',$data);
		// $html = $this->load->view('print/printcertificate',$data,true);
		// $this->printthis($html);
	}
	
	public function printcertificatewithcertnum()
	{
		/*$xxx = array(
			'trid_data' => $this->input->post('trid_data')
		);*/
		//$this->session->set_userdata($xxx);
		$code = $this->session->userdata("code");
		$mjcode = $this->session->userdata("mjcode");
		//print_r($mjcode);
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['records'] = $this->training_model->get_training_recordsssss($code)->result_array();
		$data['numrows'] = $this->training_model->get_training_recordsssss($code)->num_rows();
		$data['template'] = $this->training_model->get_cert_template($mjcode)->row_array();

		$html = $this->load->view("moduletemplate/certificate_template",$data,true);
		//print_r($this->session->all_userdata());die();
		
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		//$pdf->setFooter('{PAGENO} / {nb}');
		$pdf->AddPage('P', // L - landscape, P - portrait
        '', '', '', '',
        	7, // margin left
	        7, // margin right
	        7, // margin top
	        7, // margin bottom
	        5, // margin header
	        7);
		$pdf->WriteHTML($html);
		ob_clean();
		$pdf->Output(); 
		exit;

	}
	
	public function confirmcertificate($code = 0)
	{
		$this->check_admin();
		$this->schedule_model->confirm_certificate($code);
		$this->admin_model->insertlogs(0,$this->db->last_query());
		redirect("schedule/certificate/".$code);
	}
	
	public function unconfirmcertificate($code = 0)
	{
		$this->check_admin();
		$result = $this->schedule_model->unconfirm_certificate($code);
		$this->admin_model->insertlogs(0,$this->db->last_query());
		redirect("schedule/certificate/".$code);
	}
	#--------------------------- End of Certificate ---------------------------------
	#--------------------------- ORL/Blank Grade Sheet/Preliminary ---------------------------------
	
	public function printblankgradesheet($code = NULL)
	{
		$data["trainercount"] = $this->schedule_model->trainer_count($code)->row();
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		
		$data['records'] = $this->training_model->get_training_records($code)->result_array();
		// $this->load->view('print/printblankgradesheet',$data);
		$html = $this->load->view('print/printblankgradesheet',$data,true);
		$this->printthis($html);
	}
	
	public function printORL($code = NULL)
	{
		$data["trainercount"] = $this->schedule_model->trainer_count($code)->row();
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		
		$data['records'] = $this->training_model->get_training_records($code)->result_array();
		#$this->load->view('print/printORL',$data);
		$html = $this->load->view('print/printORL',$data, true);
		$this->printthis($html);
	}
	
	public function printpreliminarylist($code = NULL)
	{
		$data["trainercount"] = $this->schedule_model->trainer_count($code)->row();
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code);
		$data['submodule'] = $this->training_model->get_submodule($code);
		$data['submodgrades'] = $this->training_model->get_submodules_grades($code);
		
		$data['records'] = $this->training_model->get_training_records($code)->result_array();
		$this->load->view('print/printpreliminarylist',$data);
	}
	#------------- End of ORL/Blank Grade Sheet/Preliminary ---------------------
	#--------------------------- Trainer ---------------------------------
	
	public function trainer($code = NULL)
	{
		$this->session->set_userdata(array("code" => $code));
		$data["code"] = $code;
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code)->row();
		$data['trainers'] = $this->admin_model->getrainers();
		
		$lols = $this->training_model->check_submodules($code);
		
		if ($lols->num_rows() > 0)
		{
			$code = $lols->row_array();
			#print_r($code);
			$data["submodules"] = $this->admin_model->getsubmodule($code["modcode"]);
			$data["withsubmod"] = TRUE;
		} 
		else 
		{ 
			$data["withsubmod"] = false; 
		}
		#print_r($this->session->all_userdata());
		
		$this->load->view('TrainerAssign',$data);
	}
	
	public function assigntrainer()
	{
		$code = $this->session->userdata("code");
		$this->form_validation->set_rules('trainer','Trainer', 'required|xss|callback_checktrainer');
		
		#check of has submodules;------
		$lols = $this->training_model->check_submodules($code);
		
		if ($lols->num_rows() > 0)
		{
			$this->form_validation->set_rules('submod','Submodule', 'required|xss');
		}
		#end of check------------------
		
		if($this->form_validation->run()==TRUE)
		{
			$this->schedule_model->assign_trainer($code);
			$this->admin_model->insertlogs(0,$this->db->last_query());
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Successfully added Trainer!</div>');
			redirect('schedule/trainer/'.$this->session->userdata("code"));
		}
		else
		{
		   $this->trainer($this->session->userdata("code"));
		}
	}
	
	public function checktrainer($trainer)
	{
		if ($trainer == "#")
		{
			$this->form_validation->set_message('checktrainer', 'Please Select Trainer');
			return FALSE;
		}
	}
	
	public function deltrainer($code = NULL)
	{
		$data["code"] = $code;
		$data["schedule"] = $this->schedule_model->get_schedule_complete($code)->row();
		#print_r($this->db->last_query());die();
		$data["trainers"] = $this->schedule_model->get_schedule_trainer($code);
		
		$this->load->view("TrainerDelete",$data);
	}
	
	public function confirmdeltrainer($code = NULL)
	{

		$this->form_validation->set_rules('trainer','Trainer', 'required|xss');
		
		if($this->form_validation->run()==TRUE)
		{
			$this->schedule_model->delete_trainer($code);
			$this->admin_model->insertlogs($code,$this->db->last_query());
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Successfully Deleted Trainer!</div>');
			redirect('schedule/deltrainer/'.$code);
		}
		else
		{
		   $this->deltrainer($code);
		}
	}
	
	public function printthis($html)
	{
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->setFooter('{PAGENO} / {nb}');
		$pdf->AddPage('Letter-P', // L - landscape, P - portrait
        '', '', '', '',
        10, // margin left
        10, // margin right
        10, // margin top
        20, // margin bottom
        10, // margin header
        12);
		$pdf->WriteHTML($html);
		$pdf->Output(); 
	}
	
	#--------------------------- End of Trainers ---------------------------------
}