<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash extends CI_Controller {

	private $limit = 10;
	protected $kiss;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('schedule_model','admin_model','training_model','trainee_model','cash_model'));
		$this->load->library('table');
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
	
	function check_if_cash()
	{
		if($this->session->userdata("user_level") == 3 or $this->session->userdata("user_level") == 4)
		{
			
		}
		else
		{
			redirect('home/index');
		}
	}
	
	function check_admin()
	{
		if($this->session->userdata("user_level") != 4)
		{
			redirect('home/index');
		}
	}
	
	#--------All Payments
	public function allpayments2()
	{
		$search = $this->input->post('search');
		
		if (empty($search))
		{
			$this->session->unset_userdata('searchterm');
		}
		else
		{
			$this->session->set_userdata(array('searchterm' => $search));
		}
		
		$this->index2();
	}
	
	public function allpayments()
	{
		$config['base_url'] = site_url('cash/allpayments');
		$config['total_rows'] = $this->cash_model->get_currentdate_payments("all",1)->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->cash_model->get_currentdate_payments("all");

		$data['records'] = $query;
		
		#print_r($this->db->last_query());
		#print_r($this->session->all_userdata());
		$this->load->view('cash/AllPayments', $data);
	}
	
	#--------End of All Payments
	
	
	#--------Unpaid payments
	public function index($num = 3)
	{
		$this->session->unset_userdata("paystat");
		$data['records'] = $this->cash_model->get_currentdate_payments($num,0);
		#print_r($this->session->all_userdata());
		$this->load->view('cash/Cash',$data);
	}
	
	public function viewall()
	{
		$this->session->unset_userdata("paystat");
		redirect("cash/index");
	}
	
	public function paid($num = 1)
	{
		$this->session->set_userdata(array("paystat" => "paid"));
		$data['records'] = $this->cash_model->get_currentdate_payments($num,0);
		$this->load->view('cash/Cash',$data);
	}
	
	public function unpaid($num = 2)
	{
		$this->session->set_userdata(array("paystat" => "unpaid"));
		$data['records'] = $this->cash_model->get_currentdate_payments($num,0);
		$this->load->view('cash/Cash',$data);
	}
	
	public function changepaymentdate($mydate)
	{
		if ($this->session->userdata("paystat") == "paid") { $num = 1; }
		elseif($this->session->userdata("paystat") == "unpaid"){ $num = 2; }
		else{ $num = 3; }
		$data['records'] = $this->cash_model->get_currentdate_payments($num,0,$mydate)->result_array();
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function paymentlist($payid = NULL)
	{
		$this->check_if_cash();
		$data["paymentlist"] = $this->cash_model->get_paymentlist($payid);
		$data["category"] = $this->cash_model->get_cash_cat();
		#print_r($this->db->last_query()); die();
		$data["lols"] = $data["paymentlist"]->row_array();
		
		$cutoff = $data["cutoff"] = $this->cash_model->get_cutoff()->row_array();
		$data["dateused"] = $this->cash_model->check_cutoff($cutoff["cutoff"],$data["lols"]);
		$this->session->set_userdata(array("payid" => $payid));
		$this->session->set_userdata(array("paycatid" => $data["lols"]["paycatid"]));
		
		$data["fees"] = $this->admin_model->getfee(1);
		$data["feestr"] = $this->admin_model->getfee_training();
		$totalam = 0;
		foreach($data["paymentlist"]->result_array() as $lols)
		{
			$totalam = $totalam + $lols['amount'];
		}
		
		#print_r($this->session->all_userdata());
		$data["towords"] = $this->convert_number_to_words($totalam);
		$this->load->view('cash/PaymentList',$data);
	}
	
	public function confirmpayment()
	{
		$this->check_if_cash();
		$payid = $this->session->userdata("payid");
		// $cutoff = $this->cash_model->get_cutoff()->row_array();
		// $dateused = $this->cash_model->check_cutoff($cutoff["cutoff"]);
		$lols = $this->cash_model->update_payment($payid);
		if ($lols == 1)
		{
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color:white">Payment Confirmation Failed, need to input new set of OR No.!</div>');
		}
		elseif ($lols == 2)
		{
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: #22bb0d; color:white">Successfully confirmed the payment!</div>');
		}
		else
		{
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: #red; color:white">This payment already has an OR!</div>');
		}
		redirect("cash/paymentlist/".$payid);
	}
	
	public function unverify($payid = 0)
	{
		$this->check_admin();
		
		$this->cash_model->unverify($payid);
		redirect("cash/paymentlist/".$payid);
	}
	
	public function deletepayment($payid = 0,$paylistid = 0)
	{
		$this->cash_model->delete_payment_list($paylistid);
		$this->session->set_flashdata('message_type', 'warning'); 
		$this->session->set_flashdata('message', '<div style="background: red; color:white">Successfully Deleted a payment!</div>');
		redirect("cash/paymentlist/".$payid);	
	}
	
	public function editpayment($paylistid = 0)
	{
		$this->check_if_cash();
		$data["record"] = $this->cash_model->get_specific_payment_list($paylistid)->row_array();
		$this->load->view("cash/PaymentListEdit",$data);
	}
	
	public function confirmeditpayment()
	{
		$this->form_validation->set_rules('amount','Amount', 'required|xss');
		$this->form_validation->set_rules('paylistid','ID', 'required|xss');
		$this->form_validation->set_rules('payid','Pay ID', 'required|xss');
		$this->form_validation->set_error_delimiters("<div>", "/div>");
		if($this->form_validation->run()==TRUE)
		{
			$this->cash_model->update_payment_list();
		}
		redirect("cash/paymentlist/".$this->input->post("payid"));
	}
	
	public function addremarks($paylistid = 0)
	{
		$this->check_if_cash();
		$data["record"] = $this->cash_model->get_specific_payment_list($paylistid)->row_array();
		$this->load->view("cash/PaymentListAddRemarks",$data);
	}
	
	public function confirmaddremarks()
	{
		$this->form_validation->set_rules('remarks','Remarks', 'required|xss');
		$this->form_validation->set_rules('paylistid','ID', 'required|xss');
		$this->form_validation->set_rules('payid','Pay ID', 'required|xss');
		$this->form_validation->set_error_delimiters("<div>", "/div>");
		if($this->form_validation->run()==TRUE)
		{
			$this->cash_model->add_remarks();
		}
		redirect("cash/paymentlist/".$this->input->post("payid"));
	}
	
	public function payment($mode)
	{
		switch ($mode)
		{
			case "search":
				$this->load->view('cash/PaymentSearch');
				break;
			case "searchresult":
				$this->form_validation->set_rules('trid','Training ID', 'xss');
				$this->form_validation->set_rules('ornum','OR No.', 'xss');
				$this->form_validation->set_rules('payor','Payor', 'xss');
				$this->form_validation->set_rules('paydate','Date of Payment', 'xss');
				$this->form_validation->set_error_delimiters("<div>", "/div>");
				
				if($this->form_validation->run()==TRUE)
				{
					$query = $this->cash_model->get_specific_payment_search();

					$data['records'] = $query;
					
					#print_r($this->session->all_userdata());
					$this->load->view('cash/AllPayments', $data);
				}
				else
				{
					$this->payment("search");
				}
				break;
			default:
				break;
		}
	}
	
	public function advancedsearch()
	{
		$this->check_if_cash();
		$this->load->view('cash/Search',$data);
	}
	
	public function printor_cash($payid = 0)
	{
		// date_default_timezone_set("Asia/Manila");
		// echo date_default_timezone_get();
		// echo date("Y-m-d H:i:s");
		$data["paymentlist"] = $this->cash_model->get_paymentlist($payid);
		$totalam = 0;
		foreach($data["paymentlist"]->result_array() as $lols)
		{
			$totalam = $totalam + $lols['amount'];
		}
		
		#print_r($this->session->all_userdata());
		$data["towords"] = $this->convert_number_to_words($totalam);
		$words = explode(".",$totalam);
		$data["pesos"] = $this->convert_number_to_words($words[0]);
		if (!empty($words[1]))
		{
			$centavo = $this->convert_number_to_words(substr(number_format($totalam,2),-2));
			$data["centavo"] = " and " .$centavo . " Centavos";
		} else {
			$data["centavo"] = "";
		}
		#$data["record"] = $this->cash_model->print_or();
		if ($this->session->userdata("venid") == 1){
			$this->load->view('cash/Print/Printor_Cash',$data);
		} else if ($this->session->userdata("venid") == 2) {
			$this->load->view('cash/Print/Printor_Cash_mnl',$data);
		} else {
			echo "Login exceeded. Please relog to system";
		}
		
	}
	
	public function printor_check($payid = 0)
	{
		$data["paymentlist"] = $this->cash_model->get_paymentlist($payid);
		$totalam = 0;
		foreach($data["paymentlist"]->result_array() as $lols)
		{
			$totalam = $totalam + $lols['amount'];
		}
		
		#print_r($this->session->all_userdata());
		$data["towords"] = $this->convert_number_to_words($totalam);
		
		$words = explode(".",$totalam);
		$data["pesos"] = $this->convert_number_to_words($words[0]);
		if (!empty($words[1]))
		{
			$centavo = $this->convert_number_to_words(substr(number_format($totalam,2),-2));
			$data["centavo"] = " and " .$centavo . " Centavos";
		} else {
			$data["centavo"] = "";
		}
		#$data["record"] = $this->cash_model->print_or();
		$this->load->view('cash/Print/Printor_Check',$data);
	}
	
	public function addpayment1()
	{
		$this->check_if_cash();
		$data["categories"] = $this->cash_model->get_cash_cat();
		$this->load->view("cash/PaymentAdd1",$data);
	}
	
	public function addpayment2()
	{
		$this->check_if_cash();
		$this->check_session();
		
		#if (empty($this->input->post('lname')) and empty($this->input->post('fname')) and empty($this->input->post('trid')))
		$lname = $this->input->post('lname');
		$fname = $this->input->post('fname');
		$trid = $this->input->post('trid');
		
		if (empty($lname) and empty($fname) and empty($trid))
		{
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Please fill-up a field!</div>');
			redirect("cash/addpayment1");
		}
		else
		{
			
			if ($this->cash_model->searchtrainee()->num_rows() > 0)
			{
				$config['base_url'] = site_url('home/addpayment2/');
				$config['total_rows'] = $this->cash_model->searchtrainee()->num_rows();
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
				$query = $this->cash_model->searchtrainee()->result_array();
				$data['records'] = $query;
				#print_r($this->session->all_userdata());
				$this->load->view("cash/PaymentAdd2",$data);
			}
			else 
			{
				$this->session->set_flashdata('message', '<div style="background: red; color: white;">No Record Found.</div>');
				redirect("cash/addpayment1");
			}
		}
	}
	
	public function addpayment3($mode = 0, $payor = 0)
	{	
		$this->check_if_cash();
		$data["record"] = $this->cash_model->get_cash_cat();
		
		if ($mode == 1)
		{
			
			$rec = $this->trainee_model->searchtrainee($payor)->row_array();
			#print_r($this->db->last_query());
			$data["trid"] = $payor;
			$data["payor"] = $rec["lname"].", ".$rec["fname"]." ".$rec["mname"];
		}
		elseif ($mode == 2)
		{
			$data["trid"] = "0";
			$data["payor"] =  $this->input->post("fullname");
		}
		else
		{
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Error Transaction</div>');
			redirect("cash/addpayment1");
		}
		
		
		$this->load->view("cash/PaymentAdd3",$data);
	}
	
	public function confirm_addpayment()
	{
		#$this->form_validation->set_rules('ornum','OR Number', 'required|xss');
		$this->form_validation->set_rules('payor','Payor', 'required|xss');
		$this->form_validation->set_rules('trid','Trainee ID', 'xss');
		#$this->form_validation->set_rules('remarks','Remarks', 'xss');
		$this->form_validation->set_error_delimiters("<div>", "/div>");
		if($this->form_validation->run()==TRUE)
		{
			$this->cash_model->add_payment();
		}
		redirect("cash/index");
	}
	
	public function controlno($mode = 0,$cnid = NULL)
	{
		$this->check_if_cash();
		switch ($mode)
		{
			case "search":
				$config['base_url'] = site_url('cash/controlno/search');
				$config['total_rows'] = $this->cash_model->get_controlno_pagination(1)->num_rows();
				$config['per_page'] = 10;
				$config['num_links'] = 1;
				$config['full_tag_open'] = '<div id="pagination">';
				$config['full_tag_close'] = '</div>';
				$config['cur_tag_open'] = '<span class="page active">';
				$config['cur_tag_close'] = '</span>';
				$config['next_link'] = 'Next';
				$config['prev_link'] = 'Prev';
				$config['uri_segment'] = 4;
				
				$this->pagination->initialize($config);
				
				$data["result"] = $this->cash_model->get_controlno_pagination(2,$config['per_page']);
				#print_r($this->db->last_query()); die();
				$this->load->view("cash/ControlNoSearch",$data);
				break;
			case "edit":
				$data["record"] = $this->cash_model->get_cash_cat();
				$data["row"] = $this->cash_model->get_controlno_edit($cnid)->row_array();
				$this->load->view("cash/ControlNoEdit",$data);
				break;
			case "delete":
				$this->cash_model->delete_controlno($cnid);
				$this->session->set_flashdata('message_type', 'warning'); 
				$this->session->set_flashdata('message', '<div style="background: red; color:white">Successfully Deleted a Control No.!</div>');
				redirect("cash/controlno/search");
				break;
			default:
				$data["record"] = $this->cash_model->get_cash_cat();
				$this->load->view("cash/ControlNoAdd",$data);
				break;
		}
		
	}
	
	public function addcontrolno()
	{
		$this->form_validation->set_rules('controlno','Control No', 'is_unique[cash_controlno.controlno]|required|xss');
		$this->form_validation->set_rules('firstornum','OR No.', 'required|xss');
		$this->form_validation->set_rules('amount','Amount', 'required|xss');
		$this->form_validation->set_rules('ornum','OR No. from Bank', 'required|xss');
		#$this->form_validation->set_rules('remamount','Amount', 'required|xss');
		$this->form_validation->set_rules('dateadded','Date', 'required|xss');
		$this->form_validation->set_rules('cat','Category', 'required|xss');
		if($this->form_validation->run() == TRUE)
		{
			$this->cash_model->add_controlno();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Successfully added Control No.!</div>');
			redirect("cash/controlno/add");
		}
		else
		{
			$data["record"] = $this->cash_model->get_cash_cat();
			$this->load->view("cash/ControlNoAdd",$data);
		}
	}
	
	public function editcontrolno()
	{
		$this->form_validation->set_rules('cnid','Control No', 'required|xss');
		$this->form_validation->set_rules('controlno','Control No', 'required|xss');
		$this->form_validation->set_rules('firstornum','OR No.', 'required|xss');
		$this->form_validation->set_rules('amount','Amount', 'required|xss');
		$this->form_validation->set_rules('ornum','OR No. from Bank', 'required|xss');
		$this->form_validation->set_rules('dateadded','Date', 'required|xss');
		$this->form_validation->set_rules('cat','Category', 'required|xss');
		if($this->form_validation->run() == TRUE)
		{
			$this->cash_model->edit_controlno();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Successfully updated Control No.!</div>');
			redirect("cash/controlno/edit/".$this->input->post("cnid"));
		}
		else
		{
			$data["record"] = $this->cash_model->get_cash_cat();
			$data["row"] = $this->cash_model->get_controlno_edit($this->input->post("cnid"))->row_array();
			$this->load->view("cash/ControlNoEdit",$data);
		}
	}
	
	public function ornum($mode = NULL,$idnum = 0)
	{
		$this->check_if_cash();
		$this->check_admin();
		switch ($mode)
		{
			case "add":
				$data["record"] = $this->cash_model->get_cash_cat();
				$data["venue"] = $this->admin_model->getvenue();
				$this->load->view("cash/ORAdd",$data);
				break;
			case "addconfirm":
				$this->form_validation->set_rules('firstornum','First OR Number', 'required|xss');
				$this->form_validation->set_rules('lastornum','Last OR Numberr', 'required|xss');
				$this->form_validation->set_rules('cat','Category', 'required|xss');
				$this->form_validation->set_rules('venue','Venue', 'required|xss');
				$total = $this->isAccepted();
				if($this->form_validation->run()==TRUE and ($total) >= 0)
				{
					#print_r($this->input->post("firstornum")); die();
					$this->cash_model->add_ornum($total);
					$this->session->set_flashdata('message_type', 'warning'); 
					$this->session->set_flashdata('message', '<div style="background: green; color: white;">Successfully added ORs!</div>');
					redirect("cash/ornum/search");
				}
				else
				{
					$data["record"] = $this->cash_model->get_cash_cat();
					$data["venue"] = $this->admin_model->getvenue();
					$this->session->set_flashdata('message_type', 'warning'); 
					$this->session->set_flashdata('message', '<div style="background: red; color: white;">OR already in database!</div>');
					$this->load->view("cash/ORAdd",$data);
				}
				break;
			case "cancel":
				$this->cash_model->cancel_or($idnum);
				redirect("cash/ornum/search");
				break;
			case "search":
				$ornum = $this->input->post("ornum");
				if (!empty($ornum))
				{
					$this->session->set_userdata(array("searchor" => $this->input->post("ornum")));
				}
				
				$config['base_url'] = site_url('cash/ornum/search');
				$config['total_rows'] = $this->cash_model->get_ornum_pagination(1)->num_rows();
				$config['per_page'] = 10;
				$config['num_links'] = 4;
				$config['full_tag_open'] = '<div id="pagination">';
				$config['full_tag_close'] = '</div>';
				$config['cur_tag_open'] = '<span class="page active">';
				$config['cur_tag_close'] = '</span>';
				$config['next_link'] = 'Next';
				$config['prev_link'] = 'Prev';
				$config['uri_segment'] = 4;
				
				$this->pagination->initialize($config);
				#print_r($this->db->last_query());
				#echo "<br>";
				$data["result"] = $this->cash_model->get_ornum_pagination(2,$config['per_page']);
				#print_r($this->db->last_query()); #die();
				$data["record"] = $this->cash_model->get_cash_cat();
				$this->load->view("cash/ORSearch",$data);
				break;
			default:
				break;
		}
	}
	
	public function isAccepted()
	{
		$total = $this->input->post("lastornum") - $this->input->post("firstornum");
		if (is_numeric($total) and $total >= 0)
		{
			$lols = $this->cash_model->check_ornum($this->input->post("lastornum"),$this->input->post("firstornum"));
			
			if ($lols->num_rows() == 0)
			{
				return $total;
			}
			else
			{
				return -1;
			}
		}
		return -1;
	}
	
	public function addcatonor($lols)
	{
		$merged_ornum = sprintf("%02d",$this->input->post("cat"))."-".$lols;
		
		return $merged_ornum;
	}
	
	#----------------Fee's Section----------------------------------
	
	public function feesdiscount()
	{
		#$this->check_if_cash();
		#$this->check_admin();
		$this->check_session();
		$data["categories"] = $this->cash_model->get_cash_cat();
		$data['module'] = $this->admin_model->getmodule();
		
		
		$config['base_url'] = site_url('cash/feesdiscount/');
		$config['total_rows'] = $this->cash_model->getfee_pagination(1)->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$query = $this->cash_model->getfee_pagination(2,$config['per_page'])->result_array();
		
		$data['records'] = $query;
		#print_r($this->db->last_query()); die();
		#print_r($this->session->all_userdata());
		$this->load->view("cash/FeesDiscount",$data);
	}
	
	public function feesadd()
	{
		$this->form_validation->set_rules('category','Category Type', 'required|xss');
		$this->form_validation->set_rules('typename','Fee Name', 'is_unique[cash_payment_type.typename]|required|xss');
		$this->form_validation->set_rules('typeshort','Fee Short Name', 'required|xss');
		$this->form_validation->set_rules('amount','Amount.', 'required|xss');
		#$this->form_validation->set_rules('active','active', 'required|xss');
		if($this->form_validation->run() == TRUE)
		{
			$this->cash_model->add_fee();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Successfully Added a Fee!</div>');
			redirect("cash/feesdiscount");
		}
		else
		{
			$this->feesdiscount();
		}
	}
	
	public function feesedit($idnum)
	{
		$data["record"] = $this->cash_model->getfee($idnum)->row_array();
		$this->load->view("cash/FeesEdit",$data);
	}
	
	public function activate_fee_status($paytypeid = 0)
	{
		$this->cash_model->activate_fee_status($paytypeid);
		redirect("cash/feesadd");
	}
	
	public function deactivate_fee_status($paytypeid = 0)
	{
		$this->cash_model->deactivate_fee_status($paytypeid);
		redirect("cash/feesadd");
	}
	
	public function trainingfeesadd()
	{
		$this->form_validation->set_rules('category2','Category Type', 'required|xss');
		$this->form_validation->set_rules('module_id2','Training', 'is_unique[cash_payment_type.typename]|required|xss');
		$this->form_validation->set_rules('amount2','Amount', 'required|xss');
		#$this->form_validation->set_rules('active','Active', 'required|xss');
		if($this->form_validation->run() == TRUE)
		{
			$this->cash_model->add_fee_training();
			$this->session->set_flashdata('message_type', 'warning'); 
			$this->session->set_flashdata('message', '<div style="background: red; color: white;">Successfully Added a Training Fee!</div>');
			redirect("cash/feesdiscount");
		}
		else
		{
			$this->feesdiscount();
		}
	}
	
	public function addfeetoor()
	{
		$this->check_if_cash();
		$this->cash_model->add_payment_list();
		redirect("cash/paymentlist/".$this->session->userdata("payid"));
	}
	
	#---------------- End Fee's Section----------------------------------
	
	function convert_number_to_words($number) 
	{
	
		$hyphen      = '-';
		#$conjunction = ' and ';
		$conjunction = ' ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' and ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'One',
			2                   => 'Two',
			3                   => 'Three',
			4                   => 'Four',
			5                   => 'Five',
			6                   => 'Six',
			7                   => 'Seven',
			8                   => 'Eight',
			9                   => 'Nine',
			10                  => 'Ten',
			11                  => 'Eleven',
			12                  => 'Twelve',
			13                  => 'Thirteen',
			14                  => 'Fourteen',
			15                  => 'Fifteen',
			16                  => 'Sixteen',
			17                  => 'Seventeen',
			18                  => 'Eighteen',
			19                  => 'Nineteen',
			20                  => 'Twenty',
			30                  => 'Thirty',
			40                  => 'Forty',
			50                  => 'Fifty',
			60                  => 'Sixty',
			70                  => 'Seventy',
			80                  => 'Eighty',
			90                  => 'Ninety',
			100                 => 'Hundred',
			1000                => 'Thousand',
			1000000             => 'Million',
			1000000000          => 'Billion',
			1000000000000       => 'Trillion',
			1000000000000000    => 'Quadrillion',
			1000000000000000000 => 'quintillion'
		);

		if (!is_numeric($number)) {
			return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}

		$string = $fraction = null;

		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}

		switch (true) 
		{
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convert_number_to_words($remainder);
				}
			break;
		}

			if (null !== $fraction && is_numeric($fraction)) 
			{
				$string .= $decimal;
				$words = array();
				foreach (str_split((string) $fraction) as $number) 
				{
					$words[] = $dictionary[$number];
				}
				$string .= implode(' ', $words);
			}

		return $string;
	}
	
	public function reports($main = 0,$type = 0)
	{
		$this->check_if_cash();
		switch($main)
		{
			case "print":
				$type = $this->input->post("cat");
				switch($type)
				{
					case 1:
						$data['records'] = $this->cash_model->get_paymentlist_report(1);
						$data['report'] = $this->cash_model->get_reports("cash_reports_regularfunds");
						$data['controlno'] = $this->cash_model->get_controlno(1)->result_array();
						$data['begbal'] = $this->cash_model->get_begbalance(1)->row_array();
						$data['started'] = $this->input->post("startdate");
						$html = $this->load->view("cash/Print/RegularFundsReports",$data, true);
						$this->printthis($html);
						#$this->load->view("cash/Print/RegularFundsReports",$data);
						break;
					case 2:
						$data['records'] = $this->cash_model->get_paymentlist_report(2);
						$data['report'] = $this->cash_model->get_reports("cash_reports_lcca");
						$data['controlno'] = $this->cash_model->get_controlno(2)->result_array();
						$data['begbal'] = $this->cash_model->get_begbalance(2)->row_array();
						$data['started'] = $this->input->post("startdate");
						#$this->load->view("cash/Print/RegularFundsReports",$data);
						// $this->load->view("cash/Print/LCCAReports",$data);
						$html = $this->load->view("cash/Print/LCCAReports",$data, true);
						$this->printthis($html);
						break;
					/*case ($type == "DailylyLCCA"):
						$data['report'] = $this->cash_model->get_reports("cash_reports_lcca");
						$this->load->view("cash/Print/DailylyLCCAReports",$data);
						break;
					case ($type == "DailyRegularFunds"):
						$data['report'] = $this->cash_model->get_reports("cash_reports_regularfunds");
						$this->load->view("cash/Print/DailyRegularFundsReports",$data);
						break; */
					default:
						break;
				}
			case "options":
				switch($type)
				{
					case "regularfunds":
						$data['records'] = $this->cash_model->getfee(1);
						$data['report'] = $this->cash_model->get_reports("cash_reports_regularfunds");
						$this->load->view("cash/OptionsRegularFunds",$data);
						break;
					case "lcca":
						$data['records'] = $this->cash_model->getfee(2);
						$data['report'] = $this->cash_model->get_reports("cash_reports_lcca");
						$this->load->view("cash/OptionsLCCA",$data);
						break;
					default:
						break;
				}
				break;
			default:
				$this->check_session();
				$data["record"] = $this->cash_model->get_cash_cat();
				$data["venue"] = $this->admin_model->getvenue();
				$this->load->view("cash/Reports",$data);
				break;
		}
	}
	
	public function insert_reportheader_lcca()
	{
		$this->form_validation->set_rules('cashtypeid','Cash Type','required|trim|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			redirect("cash/reports/options_lcca");
		}
		else
		{
			$this->cash_model->add_module_to_reportheader("cash_reports_lcca");
			$this->session->set_flashdata('message','Successfully Added a Module for header!');
			redirect("cash/reports/options/lcca");
		}
	}
	
	public function insert_reportheader_regularfunds()
	{
		$this->form_validation->set_rules('cashtypeid','Cash Type','required|trim|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			redirect("cash/reports/options/regularfunds");
		}
		else
		{
			$this->cash_model->add_module_to_reportheader("cash_reports_regularfunds");
			$this->session->set_flashdata('message','Successfully Added a Module for header!');
			redirect("cash/reports/options_regularfunds");
		}
	}
	
	public function printthis($html)
	{
		$this->load->library('pdf2');
		$pdf = $this->pdf2->load();
		#$pdf->setFooter('{PAGENO} / {nb}');
		$pdf->AddPage('Letter-P', // L - landscape, P - portrait
        '', '', '', '',
        10, // margin left
        0, // margin right
        5, // margin top
        0, // margin bottom
        10, // margin header
        12);
		$pdf->WriteHTML($html);
		$pdf->Output(); 
	}
	
	public function set_paycatid_ornum($paycatid = 0)
	{
		$this->session->unset_userdata("searchor");
		$this->session->set_userdata(array("paycatid" => $paycatid));
		redirect("cash/ornum/search");
	}

	public function ornumber($ornumber = NULL)
	{
		$this->check_if_cash();
		$data["paymentlist"] = $this->cash_model->get_paymentlist($ornumber);
		$data["category"] = $this->cash_model->get_cash_cat();
		
		$data["lols"] = $data["paymentlist"]->row_array();
		$cutoff = $data["cutoff"] = $this->cash_model->get_cutoff()->row_array();
		$data["dateused"] = $this->cash_model->check_cutoff($cutoff["cutoff"],$data["lols"]);
		
		$this->session->set_userdata(array("ornumber" => $ornumber));
		$this->session->set_userdata(array("paycatid" => $data["lols"]["paycatid"]));
		
		$data["fees"] = $this->admin_model->getfee(1);
		$totalam = 0;
		foreach($data["paymentlist"]->result_array() as $lols)
		{
			$totalam = $totalam + $lols['amount'];
		}
		
		#print_r($this->session->all_userdata());
		$data["towords"] = $this->convert_number_to_words($totalam);
		$this->load->view('cash/PaymentList',$data);
	}

	function delete_report_header($table = "",$repid = 0)
	{
		$this->cash_model->delete_header($table,$repid);
		redirect("cash/reports/options/".$table);
	}
	
	public function getfee($lols)
	{	
		$data = $this->cash_model->getfeejson($lols)->row_array();
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function confirm_editfee()
	{
		$this->cash_model->confirmeditfee();
		$this->feesdiscount();
	}
	
	public function transfer($paylistid = 0)
	{
		$payid = $this->input->post("payid");
		$split = explode("*",$payid);
		$category = $this->input->post("category");
		
		$rec = $this->cash_model->getpayment($split[1])->row_array();
		$rec2 = $this->cash_model->transfer($rec,$split[0],$category,$split[2]);
		redirect("cash/paymentlist/".$split[1]);
	}
	
	public function cutoff($var)
	{
		$data = $this->cash_model->set_cutoff($var);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}
	
	public function changepayor($payid = 0)
	{
		$this->cash_model->changepayor($payid);
		redirect("cash/paymentlist/".$payid);
	}
	
	public function owwa($mode = 0,$payid = NULL)
	{
		$this->check_if_cash();
		switch ($mode)
		{
			case "search":
				$config['base_url'] = site_url('cash/owwa/search');
				$config['total_rows'] = $this->cash_model->get_owwa_list(1)->num_rows();
				$config['per_page'] = 10;
				$config['num_links'] = 1;
				$config['full_tag_open'] = '<div id="pagination">';
				$config['full_tag_close'] = '</div>';
				$config['cur_tag_open'] = '<span class="page active">';
				$config['cur_tag_close'] = '</span>';
				$config['next_link'] = 'Next';
				$config['prev_link'] = 'Prev';
				$config['uri_segment'] = 4;
				
				$this->pagination->initialize($config);
				
				$data["result"] = $this->cash_model->get_owwa_list(2,$config['per_page']);
				// print_r($this->db->last_query()); die();
				$this->load->view("cash/owwa",$data);
				break;
			case "list":
				$data["result"] = $this->cash_model->get_owwa_list_ornum($payid);
				$data["lols"] = $this->cash_model->get_owwa_list_ornum($payid)->row_array();
				// $data["row"] = $this->cash_model->get_controlno_edit($cnid)->row_array();
				$this->load->view("cash/Owwalist",$data);
				break;
			case "add":
				$trid = $this->input->post("trid");
				$trainingid = $this->input->post("trainingid");
				$ornum_id = $this->input->post("ornum_id");
				$paylistid = $this->input->post("paylistid");
				$check = $this->cash_model->check_owwa_list($trainingid, $paylistid)->num_rows();
				if ($check == 0) {
					$this->cash_model->insert_owwa_list($trainingid, $ornum_id, $paylistid);
					header('Content-Type: application/x-json; charset=utf-8');
					echo(json_encode(1));
				} else {
					header('Content-Type: application/x-json; charset=utf-8');
					echo(json_encode(0));
				}
				break;
			case "delete":
				$owwaid = $this->input->post("owwaid");
				$this->cash_model->delete_owwa_trainee($owwaid);
				header('Content-Type: application/x-json; charset=utf-8');
				echo(json_encode(3));
				break;
			default:
				$data["record"] = $this->cash_model->get_cash_cat();
				$this->load->view("cash/ControlNoAdd",$data);
				break;
		}
		
	}
	
	public function searchtrainee_ajax()
	{
		$trainee = $this->input->post('trainee');
		$data = $this->cash_model->get_owwa_trainee($trainee)->result_array();
		header('Content-Type: application/x-json; charset=utf-8');
		// print_r($this->db->last_query());
		echo(json_encode($data));
	}
	
	public function searchtraining_ajax()
	{
		$trid = $this->input->post('trid');
		$data = $this->trainee_model->searchtraining2($trid)->result_array();
		header('Content-Type: application/x-json; charset=utf-8');
		// print_r($this->db->last_query());
		echo(json_encode($data));
		
	}
	
	public function searchOwwaListPaylistid()
	{
		$paylistid = $this->input->post('paylistid');
		$data = $this->cash_model->get_owwa_list_paylistid($paylistid)->result_array();
		header('Content-Type: application/x-json; charset=utf-8');
		// print_r($this->db->last_query());
		echo(json_encode($data));
	}
	
}
