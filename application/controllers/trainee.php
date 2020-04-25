<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trainee extends CI_Controller {

	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library(array("pagination","table","session"));
		$this->load->model(array('admin_model','trainee_model','schedule_model','training_model','cash_model'));
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
	
	public function newtrainee() {
		$this->session->unset_userdata("reg");
		$data["religion"] = $this->admin_model->getreligion();
		$data["citizenship"] = $this->admin_model->getcitizenship();
		$data["citizenship"] = $this->admin_model->getcitizenship();
		$data['civstat'] = $this->admin_model->getcivstat()->result_array();
		$data['religion'] = $this->admin_model->getreligion()->result_array();

		$this->load->view('GeneralInformationNew',$data);
		#$this->load->view('GeneralInformationNew2',$data);
	}
	
	function addtrainee()
	{
		$this->form_validation->set_rules('lname','Last Name', 'required|xss');
		$this->form_validation->set_rules('fname','First Name', 'required|xss');
		$this->form_validation->set_rules('mname','Middle Name', 'xss');
		$this->form_validation->set_rules('suffix','Suffix', 'xss');
		$this->form_validation->set_rules('sex','Sex', 'required|xss');
		$this->form_validation->set_rules('civilstat','Civil Stat', 'required|xss');
		$this->form_validation->set_rules('religion','Religion', 'xss');
		$this->form_validation->set_rules('bdate','Birth Date', 'required|xss');
		$this->form_validation->set_rules('bplace','Birth Place', 'xss');
		$this->form_validation->set_rules('address','Address', 'required|xss');
		$this->form_validation->set_rules('zip','Zip', 'required|xss');
		$this->form_validation->set_rules('mobile','Emergency Phone', 'required|xss');
		$this->form_validation->set_rules('landline','Emergency Phone', 'xss');
		$this->form_validation->set_rules('region','Region', 'required|xss');
		$this->form_validation->set_rules('course','Course', 'required|xss');
		$this->form_validation->set_rules('school','School', 'required|xss');
		$this->form_validation->set_rules('town','Municipality', 'required|xss');
		$this->form_validation->set_rules('eadd','Email Address', 'required|xss');
		$this->form_validation->set_rules('emname','Emergency Name', 'required|xss');
		$this->form_validation->set_rules('emaddr','Emergency Address', 'xss');
		$this->form_validation->set_rules('emphone','Emergency Phone', 'required|xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{  
			$lastid = $this->trainee_model->addtrainee();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Record Updated!</strong></p></div>');	
			redirect('trainee/edit/'.$lastid);
		}
		else
		{
		   $this->newtrainee();
		}
	}

	public function addtrainee2()
	{
		$this->form_validation->set_rules('lname','Last Name', 'required|xss');
		$this->form_validation->set_rules('fname','First Name', 'required|xss');
		$this->form_validation->set_rules('mname','Middle Name', 'xss');
		$this->form_validation->set_rules('suffix','Suffix', 'xss');
		$this->form_validation->set_rules('sex','Sex', 'required|xss');
		$this->form_validation->set_rules('bdate','Birth Date', 'xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{  
			$lastid = $this->trainee_model->addtrainee2();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Record Saved!</strong></p></div>');	
			redirect('trainee/edit/'.$lastid);
		}
		else
		{
		   $this->newtrainee();
		}
	}
	
	function update()
	{
		$this->form_validation->set_rules('trid','Training ID', 'required|xss');
		$this->form_validation->set_rules('lname','Last Name', 'required|xss');
		$this->form_validation->set_rules('fname','First Name', 'required|xss');
		$this->form_validation->set_rules('mname','Middle Name', 'xss');
		$this->form_validation->set_rules('suffix','Suffix', 'xss');
		$this->form_validation->set_rules('sex','Sex', 'required|xss');
		$this->form_validation->set_rules('civilstat','Civil Stat', 'xss');
		$this->form_validation->set_rules('religion','Religion', 'xss');
		$this->form_validation->set_rules('bdate','Birth Date', 'xss');
		$this->form_validation->set_rules('bplace','Birth Place', 'xss');
		$this->form_validation->set_rules('address','Address', 'xss');
		$this->form_validation->set_rules('zip','Zip', 'xss');
		$this->form_validation->set_rules('mobile','Emergency Phone', 'xss');
		$this->form_validation->set_rules('landline','Emergency Phone', 'xss');
		$this->form_validation->set_rules('region','Region', 'xss');
		$this->form_validation->set_rules('course','Course', 'xss');
		$this->form_validation->set_rules('school','School', 'xss');
		$this->form_validation->set_rules('schaddr','School Address', 'xss');
		$this->form_validation->set_rules('town','Municipality', 'xss');
		$this->form_validation->set_rules('eadd','Email Address', 'xss');
		$this->form_validation->set_rules('emname','Emergency Name', 'xss');
		$this->form_validation->set_rules('emaddr','Emergency Address', 'xss');
		$this->form_validation->set_rules('emphone','Emergency Phone', 'xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{  
			$this->trainee_model->update_information();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Record Updated!</strong></p></div>');	
			redirect('trainee/edit/'.$this->session->userdata("trid"));
		}
		else
		{
		   $this->edit($this->input->post('trid'));
		}
	}
	
	public function edit($trid)
	{
		$this->check_session();
		$data['row'] = $this->admin_model->searchtrid($trid)->row_array();
		$data['town'] = $this->admin_model->getidnum($data['row']['locid'])->row_array();
		$data["citizenship"] = $this->admin_model->getcitizenship();
		$data['civstat'] = $this->admin_model->getcivstat()->result_array();
		$data['courses'] = $this->admin_model->getcourse()->result_array();
		$data['schools'] = $this->admin_model->getschool()->result_array();
		$data['religion'] = $this->admin_model->getreligion()->result_array();
		$this->session->set_userdata(array("trid" => $trid));

		$this->load->view('GeneralInformation', $data);
	}
	
	function delete($trid = NULL)
	{
		$result = $this->trainee_model->searchtrainingdel($trid);
		if ($result->num_rows() > 0)
		{
			#echo "lols"; die();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px; color:red"><p><span style="float: left; margin-right: .3em;"></span><strong>Cannot delete record. Please delete all training of this trainee before deleting this record or contact Administrator!</strong></p></div>');
			redirect('home/searchtrainee');
		}
		else
		{
			##print_r($result); die();
			$this->trainee_model->delete_trainee($trid);
			$this->admin_model->insertlogs($trid,$this->db->last_query());
			redirect('home/searchtrainee');
		}
	}
	
	function enroll($trid = 0)
	{
		#print_r($this->session->all_userdata()); die();
		if($this->admin_model->searchtrid($trid)->row_array())
		{
			$this->session->set_userdata('trid',$trid);
			$this->session->unset_userdata('cartitems');
			$this->session->unset_userdata('paycatid');
			$this->session->unset_userdata("ofee");
			$data['records'] = $this->admin_model->searchtrid($trid)->row_array();
			$data['training'] = $this->trainee_model->searchtraining($trid)->result();
			$data['ranks'] = $this->admin_model->getrank()->result_array();
			$data['licenses'] = $this->admin_model->getlicense()->result_array();
			//$data['position'] = $this->admin_model->getposition()->result_array();
			$data['employer'] = $this->admin_model->getemployer()->result_array();
		}
		
		$this->load->view('Enroll',$data);
	}
	
	function proceedenroll($backtrack = NULL)
	{
		$this->session->unset_userdata("backtrack");
		$cartitems = $this->session->userdata('cartitems');
		
		if (!empty($backtrack))
		{
			$this->session->set_userdata(array("backtrack" => 1));
		}
		
		$this->trainee_model->updateenroll();
		
		$data["fees"] = $this->admin_model->getfee();
		$data["fees2"] = $this->admin_model->getfee_not_on_paycatid();
		$data["sponsors"] = $this->admin_model->getsponsor();
		$data['module'] = $this->admin_model->getmodule2();
		$data['schedules'] = $this->schedule_model->getmultipleschedule($cartitems)->result_array();
		#print_r($this->session->all_userdata());
		#print_r($data["schedules"]);
		$this->load->view('Training',$data);
	}
	
	function addotherfee()
	{
		$fees = $this->input->post("fees");
		$this->session->unset_userdata("ofee");
		
		foreach($fees as $row => $key)
		{
			if ((!empty($key)) or ($key != 0)) #---para han textbox
			{
				$sex[$row] = $key;
			} else {	
				$price = $this->admin_model->getprice($row)->row_array();
				if ($price["amount"] != 0) 
				{
					$sex[$row] = $price["amount"];
				}			
			}
		}
		
		$this->session->set_userdata(array("ofee" => $sex));
		redirect('trainee/proceedenroll');
	}
	
	function addcart()
	{
		$trid = $this->session->userdata("trid");
		$cartitems = $this->session->userdata('cartitems');
		
		$sponsor = $this->input->post("sponsor");
		$record = $this->input->post("code");
		
		$explode = explode("*",$record);
		$code = $explode[0];
		
		if (!$trid)
		{
			redirect('home/index');	
		}
		
		if (($cartitems) == NULL)
		{
			$data['cartitems'][] = array("code" => $code,"sponsor" => $sponsor);
			$this->session->set_userdata(array("paycatid" => $explode[1]));
			$this->session->set_userdata($data);
		}
		else 
		{
			$key = array_search($code, array_column($cartitems, 'code'));
			
			if ($key === 0)
			{
				$this->session->set_flashdata('message_type', 'warning'); 
				$this->session->set_flashdata('message', '<div>Course already in cart</div>');	
			}
			else
			{
				
				array_push($cartitems,array("code" => $code,"sponsor" => $sponsor));
			}
			
			$this->session->set_userdata('cartitems', $cartitems);  
		}
		
		redirect('trainee/proceedenroll');
	}
	
	function confirm_enroll()
	{
		$records = array();
		if (!$this->session->userdata("cartitems")){
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background:#ad0c0c; margin-top:5px; color:#fff;">You did not Select a Course</div>');	
			redirect('trainee/proceedenroll');
		}
		else
		{
			$data = $this->session->userdata("cartitems");
			$this->trainee_model->confirm_enroll($data);
			$this->session->set_flashdata('message','Successfully added a training');
			$trid = $this->session->userdata("trid");
			$this->session->unset_userdata('cartitems');
			$this->session->unset_userdata('paycatid');
			#print_r($this->session->all_userdata()); die();
			redirect('trainee/enroll/'.$trid);
			
		}
	}
	
	function deletetraining()
	{
		$training = explode("*",$this->input->post("trainingid2"));
		$trid = $training[0];
		$trainingid = $training[1];
		
		#print_r($training); die();
		$status = $this->cash_model->getornum($trainingid)->result_array();
		$payid1 = $status[0]["ornum_id"];
		$payid2 = (!empty($status[1]["ornum_id"]) ? $status[1]["ornum_id"] : 0); 
		
		if(empty($payid1) and empty($payid2)) 
		{
			#If Training has no OR, it can be removed/deleted
			$this->trainee_model->delete_training($trid,$trainingid);
			// $this->admin_model->insertlogs($trid,$this->db->last_query());
			$this->session->set_flashdata('message', '<div style="background:#ad0c0c; margin-top:5px; color:#fff;">Training Deleted</div>');	
		}
		else 
		{
			$this->session->set_flashdata('message', '<div style="background:#ad0c0c; margin-top:5px; color:#fff;">Cannot delete record, OR# already issued. Please contact Cash Section.</div>');	
		}
		redirect('trainee/enroll/'.$trid);
		
	}
	
	#-------------CTIDS------------
	function createid($trid)
	{
		$this->session->set_userdata(array("trid" => $trid));
		$data["trainee"] = $this->trainee_model->searchtrainee($trid);
		#print_r($this->session->all_userdata());
		$this->load->view('CreateID',$data);
	}
	
	function adddatevalidation()
	{
		$trid = $this->session->userdata("trid");
		$this->form_validation->set_rules('valid','Valid Date', 'xss');
		$this->form_validation->set_rules('expire','Expiration Date', 'xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{
			$this->trainee_model->add_date_validation($trid);
			$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Successfully Updated ID info!</div>');
			redirect("trainee/createid/".$trid);
		}
		else
		{
			redirect("trainee/createid/".$trid);
		}
	}
	
	function saveid()
	{
		#header( "Content-type: image/png" );
		$trid = $this->session->userdata("trid");
		$rawData = $_POST['imgBase64'];
		$filteredData = explode(',', $rawData);

		$unencoded = base64_decode($filteredData[1]);
		$datime = date("Y-m-d-H.i.s", time()); # - 3600*7
		//Create the image 
		$fp = fopen('photos/'.$trid.'.jpg', 'w');
		fwrite($fp, $unencoded);
		fclose($fp);
		
	}
	
	function savesignature()
	{
		#header( "Content-type: image/png" );
		$trid = $this->session->userdata("trid");
		$rawData = $_POST['imgBase64'];
		$filteredData = explode(',', $rawData);
		
		$unencoded = base64_decode($filteredData[1]);
		$datime = date("Y-m-d-H.i.s", time()); # - 3600*7
		//Create the image

		
		$fp = fopen('photos/'.$trid.'sig.jpg', 'w');
		fwrite($fp, $unencoded);
		fclose($fp);
	}
	
	
	function training($trid)
	{
		$data['training'] = $this->trainee_model->searchtraining($trid)->result();
		#print_r($this->db->last_query());
		$this->load->view('TraineeRecords',$data);
	}
	
	function trainingedit($trainingid)
	{
		$data["record"] = $record = $this->training_model->get_training($trainingid)->row_array();
		#print_r($data["record"]); die();
		$data['records'] = $this->admin_model->searchtrid($record["trid"])->row_array();
		$data['training'] = $this->trainee_model->searchtraining($record["trid"])->result();
		$data['ranks'] = $this->admin_model->getrank()->result_array();
		$data['licenses'] = $this->admin_model->getlicense()->result_array();
		$data['employer'] = $this->admin_model->getemployer()->result_array();
		$data['sponsor'] = $this->admin_model->getsponsor()->result_array();
		$data["code"] = $this->schedule_model->getschedule($record["code"])->row_array();
		$this->load->view('TrainingEdit',$data);
	}
	
	function trainingconfirmedit()
	{
		$this->form_validation->set_rules('trid','Trainee ID', 'required|xss');
		$this->form_validation->set_rules('trainingid','Training ID', 'required|xss');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{
			//$lols = $this->schedule_model->checkifverified($this->input->post("code"))->row_array();
			#print_r($this->db->last_query()); die();
			//if ($lols["gradeok"] == "N" and $lols["certiok"] == "N")
			//{
				$this->training_model->training_edit($this->input->post('trainingid'));
				$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Successfully Updated Training info!</div>');
			//}
			//else
			//{
			//	$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Please unconfirm schedule first before editing.</div>');
			//}
		}
		
		redirect("trainee/trainingedit/".$this->input->post("trainingid"));
		
	}
	
	
	function removecode($trainingid,$code)
	{
		$this->trainee_model->remove_code($trainingid,$code);
		$this->session->set_flashdata('message', '<div style="background:#ad0c0c; margin-top:5px; color:#fff;">Removed from ORL</div>');	
		redirect('trainee/enroll/'.$this->session->userdata("trid"));
	}
	
	function transfersched()
	{
		$this->form_validation->set_rules('trainingid','Trainee ID', 'required|xss');
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{
			$this->trainee_model->transfer_sched();
		}
		redirect('trainee/enroll/'.$this->session->userdata("trid"));
	}
}