<?php	
	class Cash_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Taipei"); 
		}	
		
		public function get_records_totalpayment($code = NULL)
		{
			$this->db->select('concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,b.trid,b.lname, b.fname, b.mname, b.suffix, b.bdate, sum(d.amount) as totalpayment',false);
			$this->db->from('training a');
			$this->db->join('trainee b', 'a.trid = b.trid', 'left');
			$this->db->join('schedule c', 'a.code = c.code', 'left');
			$this->db->join('cash_payments d','a.trainingid = d.trainingid', 'left');
			$this->db->join('venue e','d.venid = e.venid', 'left');
			$this->db->where('a.code', $code);
			$this->db->where('d.venid', $this->session->userdata("venid"));
			$this->db->order_by("b.lname, b.fname", "desc");
			$this->db->group_by("a.payid");
			$query = $this->db->get();
			
			return $query;
		}
		
		public function get_currentdate_payments($num = NULL,$numrows = 0,$mydate = NULL)
		{
			$this->db->select('a.payor,a.payid,a.paydate,concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,b.trid,b.lname, b.fname, b.mname, b.suffix, b.bdate, sum(c.amount) as totalpayment,a.status,a.paydate,a.remarks,d.ornum',false);
			$this->db->from('cash_payment a');
			$this->db->join('trainee b', 'a.trid = b.trid', 'left');
			$this->db->join('cash_paymentlist c','a.payid = c.payid', 'left');
			$this->db->join('cash_ornum d','a.ornum_id = d.ornum_id', 'left');
			$this->db->join('venue e','a.venid = e.venid', 'left');
			#Kun all payments it igclick
			if ($num == "all")
			{
				
				#numrows refer to showing total number of rows for pagination();
				if ($numrows == 0){ $this->db->limit(10,intval($this->uri->segment(3))); }
			}
			else
			{	
				if ($num == 1) { $this->db->where('a.status',$num); }
				if ($num == 2) { $this->db->where('a.status',0); }
				#Kun meada date
				if ($mydate == NULL)
				{
					$this->db->where('a.paydate = date(now())');
				}
				else
				{
					$this->db->where('a.paydate',$mydate);
				}
				
			}
			$this->db->where('a.venid', $this->session->userdata("venid"));
			$this->db->order_by("a.payid", "desc");
			$this->db->group_by("a.payid");
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		
		public function get_paymentlist($payid = 0,$lols = 0)
		{
			// $this->db->select('h.catname,j.ornum,j.ornum_id,j.dateused, c.payid,a.paylistid,c.payor,
			// c.paycatid,a.amount,d.typename,c.status,
			// concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			// c.trid, b.suffix, b.bdate, a.amount,g.module,c.paydate,i.remarks as rem,e.trainingid,d.isTraining',false);
			// $this->db->from('cash_payment c');
			// $this->db->join('cash_paymentlist a','a.payid = c.payid', 'left');
			// $this->db->join('trainee b', 'c.trid = b.trid', 'left');
			// $this->db->join('cash_payment_type d','a.paytypeid = d.paytypeid', 'left');
			// $this->db->join('training e','a.trainingid = e.trainingid', 'left');
			// $this->db->join('schedule f','e.code = f.code', 'left');
			// $this->db->join('module g','f.modcode = g.modcode', 'left');
			// $this->db->join('cash_payment_category h','c.paycatid = h.paycatid', 'left');
			// $this->db->join('cash_paymentlist_remarks i','a.paylistid = i.paylistid', 'left');
			// $this->db->join('cash_ornum j','c.ornum_id = j.ornum_id', 'left');
			// if ($lols == 0) { #kun diri all payments
				// $this->db->where('c.payid',$payid);
				// $this->db->order_by("a.payid", "asc");
			// }
			// else{
				// $this->db->order_by("c.paydate", "asc");
				// $this->db->order_by("c.ornum_id", "asc");
				// $this->db->group_by("c.payid");
			// }
			// $query = $this->db->get();
			// #print_r($this->db->last_query());
			// return $query;
			
			$this->db->select('h.catname,j.ornum,j.ornum_id,j.dateused, c.payid,a.paylistid,c.payor,
			c.paycatid,a.amount,d.typename,c.status,k.module as modfee,
			concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			c.trid, b.suffix, b.bdate, a.amount,g.module,c.paydate,i.remarks as rem,e.trainingid,d.isTraining',false);
			$this->db->from('cash_payment c');
			$this->db->join('cash_paymentlist a','a.payid = c.payid', 'left');
			$this->db->join('trainee b', 'c.trid = b.trid', 'left');
			$this->db->join('cash_payment_type d','a.paytypeid = d.paytypeid', 'left');
			$this->db->join('training e','a.trainingid = e.trainingid', 'left');
			$this->db->join('schedule f','e.code = f.code', 'left');
			$this->db->join('module g','f.modcode = g.modcode', 'left');
			$this->db->join('cash_payment_category h','c.paycatid = h.paycatid', 'left');
			$this->db->join('cash_paymentlist_remarks i','a.paylistid = i.paylistid', 'left');
			$this->db->join('cash_ornum j','c.ornum_id = j.ornum_id', 'left');
			$this->db->join('module k','d.typename = k.modcode', 'left');
			if ($lols == 0) { #kun diri all payments
				$this->db->where('c.payid',$payid);
				$this->db->order_by("a.payid", "asc");
			}
			else{
				$this->db->order_by("c.paydate", "asc");
				$this->db->order_by("c.ornum_id", "asc");
				$this->db->group_by("c.payid");
			}
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function get_paymentlist_ornumber($ornumber = 0)
		{
			$this->db->select('h.catname,c.ornum,c.payid,a.paylistid,c.trid as payor,
			c.paycatid,a.amount,d.typename,c.status,
			concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			c.trid, b.suffix, b.bdate, a.amount,g.module,c.paydate,i.remarks as rem',false);
			$this->db->from('cash_payment c');
			$this->db->join('cash_paymentlist a','a.payid = c.payid', 'left');
			$this->db->join('trainee b', 'c.trid = b.trid', 'left');
			$this->db->join('cash_payment_type d','a.paytypeid = d.paytypeid', 'left');
			$this->db->join('training e','a.trainingid = e.trainingid', 'left');
			$this->db->join('schedule f','e.code = f.code', 'left');
			$this->db->join('module g','f.modcode = g.modcode', 'left');
			$this->db->join('cash_payment_category h','c.paycatid = h.paycatid', 'left');
			$this->db->join('cash_paymentlist_remarks i','a.paylistid = i.paylistid', 'left');
			$this->db->where('c.ornumber',$ornumber);
			$this->db->order_by("a.payid", "asc");
			$query = $this->db->get();

			return $query;
		}
		
		public function get_portrainingfees($payid)
		{
			$this->db->select('c.payid,a.amount,d.typename,
			concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			b.trid,b.lname, b.fname, b.mname, b.suffix, b.bdate, a.amount, 
			g.module, f.start, f.end, f.room, f.batch, h.ornum, k.ornum as ornum2, i.sptypename, d.amount as tramount',false);
			$this->db->from('cash_paymentlist a');
			$this->db->join('cash_payment c','a.payid = c.payid', 'left');
			$this->db->join('trainee b', 'c.trid = b.trid', 'left');
			$this->db->join('cash_payment_type d','a.paytypeid = d.paytypeid', 'left');
			$this->db->join('training e','a.trainingid = e.trainingid', 'left');
			$this->db->join('schedule f','e.code = f.code', 'left');
			$this->db->join('module g','f.modcode = g.modcode', 'left');
			$this->db->join('cash_ornum h','c.ornum_id = h.ornum_id','left');
			$this->db->join('sponsor_type i','e.sponid = i.sponid','left');
			
			//join for other #ornumber
			$this->db->join('training l','a.trainingid = l.trainingid', 'left');
			$this->db->join('cash_payment j','l.payid2 = j.payid', 'left');
			$this->db->join('cash_ornum k','j.ornum_id = k.ornum_id','left');
			
			
			$this->db->where('a.payid',$payid);
			$this->db->where('d.isTraining',1);
			$this->db->order_by("a.payid", "asc");
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function get_pormiscfees($payid,$payid2)
		{
			$sql = "(SELECT a.payid, a.amount, b.typename 
					from cash_paymentlist a
					LEFT JOIN cash_payment_type b ON a.paytypeid = b.paytypeid
					WHERE a.payid = ?
					AND b.isTraining = 0)
					UNION
					(SELECT a.payid, a.amount, b.typename 
					from cash_paymentlist a
					LEFT JOIN cash_payment_type b ON a.paytypeid = b.paytypeid
					WHERE a.payid = ?
					AND b.isTraining = 0)";
			$query = $this->db->query($sql,array($payid,$payid2));
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function get_specific_payment_list($paylistid = 0)
		{
			$this->db->select("a.amount,b.typename,c.module,a.paylistid,a.payid");
			$this->db->from('cash_paymentlist a');
			$this->db->join('cash_payment_type b','a.paytypeid = b.paytypeid', 'left');
			$this->db->join('module c','b.typename = c.modcode', 'left');
			$this->db->where("a.paylistid",$paylistid);
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function get_specific_payment_search()
		{
			$trid = $this->input->post("trid");
			$ornum = $this->input->post("ornum");
			$payor = $this->input->post("payor");
			$paydate = $this->input->post("paydate");
			
			$this->db->select("a.payid,a.trid,a.payor,a.paydate,sum(c.amount) as totalpayment,a.status,b.lname,concat(b.lname,', ',b.fname,' ',b.mname,' ',b.suffix) as fullname,a.payor",false);
			$this->db->from("cash_payment a");
			$this->db->join("trainee b","a.trid = b.trid","left");
			$this->db->join("cash_paymentlist c","a.payid = c.payid","inner");
			$this->db->join("cash_ornum d","a.ornum_id = d.ornum_id","left");
			
			if (!empty($trid)) { $this->db->where("b.trid",$trid); }
			if (!empty($ornum)) { $this->db->where("d.ornum",$ornum); }
			if (!empty($payor)) 
			{ 
				$this->db->or_like("b.fname",$payor); 
				$this->db->or_like("b.lname",$payor); 
				$this->db->or_like("b.mname",$payor);
				$this->db->or_like("a.payor",$payor);
			}
			if (!empty($paydate)) { $this->db->where("a.paydate",$paydate); }
			
			$this->db->group_by("c.payid");
			
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function update_payment_list()
		{
			$data = array(
					"amount" => $this->input->post("amount")
				);
			$this->db->where("paylistid",$this->input->post("paylistid"));
			$this->db->update("cash_paymentlist",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		public function add_remarks()
		{
			$sql = "INSERT INTO cash_paymentlist_remarks (paylistid, remarks)
					VALUES (?, ?)
					ON DUPLICATE KEY UPDATE 
					remarks=VALUES(remarks)";
			$query = $this->db->query($sql, array($this->input->post("paylistid"),$this->input->post("remarks")));
			
			$this->insertlogs($this->db->last_query());
		}
		
		public function delete_payment_list($payid = 0)
		{
			$this->db->delete("cash_paymentlist", array("paylistid" => $payid)); 
			$this->insertlogs($this->db->last_query());
		}
		
		public function check_cutoff($cutoff = 0,$rec = NULL)
		{
			if ($cutoff == 1)
			{
				$date = new DateTime(date('Y-m-d'));
				$date->add(new DateInterval('P1D'));
				$qwe = $date->format('Y-m-d');
				$lols = (date('N', strtotime($qwe)) >= 6);
				if ($lols == TRUE)
				{
					$date = new DateTime();
					$date->modify('next monday');
					$paydate = $date->format('Y-m-d');
				}
				else
				{
					$paydate = $qwe;
				}
			} 
				else
			{
				$paydate = ($rec["dateused"] == NULL ? date('Y-m-d') : $rec["dateused"]);
			}
			
			return $paydate;
		}
		
		public function update_payment($payid = 0) #--------------- Updates OR No.
		{
			$paycatid = $this->session->userdata("paycatid");
			$paydate = $this->input->post("paydate");
			
			$this->db->select("ornum_id,status");
			$this->db->limit(1);
			$this->db->order_by("ornum_id");
			$this->db->where("status",0);
			$this->db->where("venid",$this->session->userdata("venid"));
			$this->db->where("paycatid",$paycatid);
			$query = $this->db->get("cash_ornum");
			
			$result = $query->row_array();
				
			if ($query->num_rows() > 0)
			{
				$sql = "select ornum_id from cash_payment where payid = ?";
				$check = $this->db->query($sql,array($payid))->row_array();
				
				if ($check["ornum_id"] != 0)
				{
					return 3;
				}
				
				$data1 = array(
					"status" => 1,
					"ornum_id" => $result["ornum_id"],
					"paydate" => $paydate,
					"user" => $this->session->userdata("userid"),
				);
				
				$this->db->where("payid",$payid);
				$this->db->where("ornum_id",0);
				$this->db->update("cash_payment",$data1);
				
				$this->insertlogs($this->db->last_query());

				$data2 = array(
					"status" => 1,
					"dateused" => $paydate,
				);
				
				$this->db->where("ornum_id",$result["ornum_id"]);
				$this->db->update("cash_ornum",$data2);
				#print_r($this->db->last_query()); die();
				return 2;
			}
			else
			{
				return 1;
			}
		}
		
		function getpayid($trainingid)
		{
			return $this->db->get_where("training",array("trainingid" => $trainingid));
		}
		
		function get_cash_type()
		{
			$this->db->order_by("paytypeid","asc");
			return $this->db->get("cash_payment_type");
		}
		
		function get_cash_cat()
		{
			$this->db->order_by("paycatid","asc");
			return $this->db->get("cash_payment_category");
		}
		
		function searchtrainee()
		{
			$lname = $this->input->post('lname');
			$fname = $this->input->post('fname');
			$trid = $this->input->post('trid');
		
			$sql = "select trid,fname,lname,mname,suffix from trainee where lname like ? and fname like ? and trid like ? order by lname,fname";
			$query = $this->db->query($sql, array('%'.$lname.'%','%'.$fname.'%','%'.$trid.'%'));
			
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function add_payment()
		{
			$trid = $this->input->post("trid");
			$rec = ($trid == 0 ? $this->input->post("payor") : "");
			
			$data = array(
				#"ornum" => $this->input->post("ornum"),
				"paydate" => $this->input->post("paydate"),
				"payor" => strtoupper($rec),
				"trid" => $trid,
				"paycatid" => $this->input->post("cat"),
				"venid" => $this->session->userdata("venid"),
				"status" => 0,
				"user" => $this->session->userdata("userid")
			);
			
			$this->db->insert("cash_payment",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		function add_payment_list()
		{
			$data = array(
				"payid" => $this->session->userdata("payid"),
				"amount" => $this->input->post("amount"),
				"paytypeid" => $this->input->post("paytypeid"),
				#"remarks" => $this->input->post("others"),
			);
			
			$this->db->insert("cash_paymentlist",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		function get_reports($table)
		{
			$this->db->select("b.paytypeid,b.typeshort,a.repid,c.module,c.modcode,c.descriptn,b.typename");
			$this->db->from($table." a");
			$this->db->join("cash_payment_type b","a.paytypeid = b.paytypeid");
			$this->db->join("module c","b.typename = c.modcode","left");
			$this->db->join("venue d","a.venid = d.venid","left");
			if ($table == "cash_reports_regularfunds")
			{
				$this->db->where("b.paycatid",1);
			}
			elseif($table == "cash_reports_lcca")
			{
				$this->db->where("b.paycatid",2);
			}
			$this->db->where("a.venid",$this->session->userdata("venid"));
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function add_module_to_reportheader($table)
		{
			$cashtypeid = $this->input->post("cashtypeid");
			
			$data = array(
				"paytypeid" => $cashtypeid,
				"dateadd" => date("Y-m-d"),
				"venid" => $this->session->userdata("venid"),
			);
			$this->db->insert($table,$data);
			
			// print_r($this->db->last_query()); die();
		}
		
		function getfee($paycatid = 0)
		{
			$this->db->select("*");
			$this->db->from("cash_payment_type a");
			$this->db->join("module b","a.typename = b.modcode","left");
			
			if (!empty($paycatid))
			{
				$this->db->where("a.paycatid",$paycatid);
			}
			$this->db->where("a.isActive",1);
			
			$this->db->order_by("isTraining","desc");
			$this->db->order_by("b.module");
			$query = $this->db->get();
			#print_r($this->db->last_query());
			return $query;
		}
		
		function activate_fee_status($paytypeid = 0)
		{
			$data = array(
				"isActive" => 1
			);
			$this->db->where("paytypeid",$paytypeid);
			$this->db->update("cash_payment_type",$data);
		}
		
		function deactivate_fee_status($paytypeid = 0)
		{
			$data = array(
				"isActive" => 0
			);
			$this->db->where("paytypeid",$paytypeid);
			$this->db->update("cash_payment_type",$data);
		}
		
		function add_fee()
		{
			$data = array(
				"paycatid" => $this->input->post("category"),
				"typename" => $this->input->post("typename"),
				"typeshort" => $this->input->post("typeshort"),
				"amount" => $this->input->post("amount"),
				"isTraining" => 0,
				"isActive" => 1,
			);
			
			$this->db->insert("cash_payment_type",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		function add_fee_training()
		{
			$data = array(
				"paycatid" => $this->input->post("category2"),
				"typename" => $this->input->post("module_id2"),
				"isTraining" => 1,
				"isActive" => 1,
				"amount" => $this->input->post("amount2"),
			);
			
			$this->db->insert("cash_payment_type",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		public function getfee_pagination($mode = 2,$count = 0)
		{
			
			if ($mode == 1) #KUN WARAY WHERE DATE = CHURVA
 			{
				$this->db->select("paytypeid");
			}
			else
			{
				$this->db->select("a.amount,a.paycatid,a.paytypeid,a.typename,b.module,c.catname,a.isActive");
				$this->db->limit($count,intval($this->uri->segment(3)));	
			}
			$this->db->from("cash_payment_type a");
			$this->db->join("module b","a.typename = b.modcode","left");
			$this->db->join("cash_payment_category c","a.paycatid = c.paycatid","left");
			$this->db->where("a.isTraining <>",2);
			
			$this->db->order_by("a.paycatid");
			$this->db->order_by("a.typename");
			$query = $this->db->get();
			
			return $query;
		}
		
		public function get_paymentlist_report($payid = 0,$lols = 0,$venid = 0)
		{
			$sql = 'select h.catname,c.ornum_id,j.ornum,c.payid,a.paylistid,if(c.payor is not NULL,c.payor,"cancelled") as payor,
			c.paycatid,a.amount,d.typename,sum(a.amount) as totalpayment,
			concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			b.suffix, b.bdate, a.amount,g.module,c.paydate,
			group_concat(a.paytypeid,":",a.amount,":",if(g.module is NULL,concat(d.typename,":",if(i.remarks is not NULL,i.remarks,"")),g.module) order by a.paytypeid separator "*") grpamount, dateused
			from cash_ornum j 
			left join cash_payment c on c.ornum_id = j.ornum_id
			left join cash_paymentlist a on a.payid = c.payid
			left join trainee b on c.trid = b.trid
			left join cash_payment_type d on a.paytypeid = d.paytypeid
			left join training e on a.trainingid = e.trainingid
			left join schedule f on e.code = f.code
			left join module g on f.modcode = g.modcode
			left join cash_payment_category h on c.paycatid = h.paycatid
			left join cash_paymentlist_remarks i on a.paylistid = i.paylistid
			left join venue k on c.venid = k.venid
			where j.dateused between ? and ? and j.paycatid = ? and j.venid = ? 
			group by j.ornum_id
			order by j.ornum asc';
			$query = $this->db->query($sql,array($this->input->post("startdate"),$this->input->post("enddate"),$this->input->post("cat"),$this->session->userdata("venid")));
			// print_r($this->db->last_query()); die();
			// print_r($query->result_array()); 
			return $query;
		}
		
		public function get_paymentlist_report22($payid = 0,$lols = 0)
		{
			$this->db->select('h.catname,c.ornum_id,j.ornum,c.payid,a.paylistid,c.payor,
			c.paycatid,a.amount,d.typename,sum(a.amount) as totalpayment,
			concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,
			b.suffix, b.bdate, a.amount,g.module,c.paydate,
			group_concat(a.paytypeid,":",a.amount,":",if(g.module is NULL,concat(d.typename,":",if(i.remarks is not NULL,i.remarks,"")),g.module) order by a.paytypeid separator "*") grpamount',false);
			$this->db->from('cash_payment c');
			$this->db->join('cash_paymentlist a','a.payid = c.payid', 'left');
			$this->db->join('trainee b', 'c.trid = b.trid', 'left');
			$this->db->join('cash_payment_type d','a.paytypeid = d.paytypeid', 'left');
			$this->db->join('training e','a.trainingid = e.trainingid', 'left');
			$this->db->join('schedule f','e.code = f.code', 'left');
			$this->db->join('module g','f.modcode = g.modcode', 'left');
			$this->db->join('cash_payment_category h','c.paycatid = h.paycatid', 'left');
			$this->db->join('cash_paymentlist_remarks i','a.paylistid = i.paylistid', 'left');
			$this->db->join('cash_ornum j','c.ornum_id = j.ornum_id', 'left');
			$this->db->order_by("c.paydate", "asc");
			$this->db->order_by("c.ornum_id", "asc");
			$this->db->group_by("c.payid");
			
			$this->db->where("c.paydate >=",$this->input->post("startdate"));
			$this->db->where("c.paydate <=",$this->input->post("enddate"));
			$this->db->where("h.paycatid",$this->input->post("cat"));
			$this->db->where("c.status",1);
			
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function get_controlno($paycatid = NULL)
		{
			$this->db->select("controlno,amount,afterornum,remamount,dateadded,ornum");
			$this->db->from("cash_controlno");
			if (!empty($paycatid)){ $this->db->where("paycatid",$paycatid); }
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			#print_r($query->result_array()); die();
			return $query;
		}
		
		public function get_controlno_pagination($mode = 2,$count = 0)
		{
			if ($mode == 1) #KUN WARAY WHERE DATE = CHURVA
 			{
				$this->db->select("controlno");
			}
			else
			{
				$this->db->limit($count,intval($this->uri->segment(4)));	
			}
			
			$controlno = $this->input->post("controlno");
			if (!empty($controlno))
			{
				$this->db->where("controlno",$controlno);
			}
			
			$this->db->from("cash_controlno a");
			$this->db->join('venue b','a.venid = b.venid', 'left');
			$this->db->where('a.venid', $this->session->userdata("venid"));
			$query = $this->db->get();
			// print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function get_controlno_edit($cnid)
		{
			$this->db->where("cnid",$cnid);
			$query = $this->db->get("cash_controlno");
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function add_controlno()
		{
			$data = array(
				"controlno" => $this->input->post("controlno"),
				#"afterornum" => "0".$this->input->post("cat")."-".$this->input->post("firstornum"),
				"afterornum" => $this->input->post("firstornum"),
				"ornum" => $this->input->post("ornum"),
				"amount" => $this->input->post("amount"),
				#"remamount" => $this->input->post("remamount"),
				"dateadded" => $this->input->post("dateadded"),
				"paycatid" => $this->input->post("cat"),
				"venid" => $this->session->userdata("venid"),
			);
			
			$this->db->insert("cash_controlno",$data);
			$this->insertlogs($this->db->last_query());
		}
		
		public function edit_controlno()
		{
			$data = array(
				"controlno" => $this->input->post("controlno"),
				"afterornum" => $this->input->post("firstornum"),
				"ornum" => $this->input->post("ornum"),
				"amount" => $this->input->post("amount"),
				"remamount" => $this->input->post("remamount"),
				"dateadded" => $this->input->post("dateadded"),
				"paycatid" => $this->input->post("cat"),
				"venid" => $this->session->userdata("venid"),
			);
			$this->db->where("cnid",$this->input->post("cnid"));
			$this->db->update("cash_controlno",$data);
			
			$this->insertlogs($this->db->last_query());
		}
		
		public function delete_controlno($cnid = NULL)
		{
			$this->db->where("cnid",$cnid);
			$this->db->delete("cash_controlno");
			
			$this->insertlogs("Deleted cnid $cnid on cash_controlno");
		}

		public function add_ornum($total = 0)
		{
			//$firstornum = explode("-",$this->input->post("firstornum"));
			$firstornum = $this->input->post("firstornum");
			#print_r($firstornum); die();
			for ($i = 0; $i <= $total; $i++)
			{
				$ornum = $firstornum + $i;
				
				$data[] = array(
					//"ornum" => sprintf("%02d",$this->input->post("cat"))."-".$ornum,
					"ornum" => $ornum,
					"paycatid" => $this->input->post("cat"),
					"venid" => $this->input->post("venue"),
					"status" => 0,
					"dateadded" => date("Y-m-d"),
				);
			}
			
			//print_r($data); die();
			$this->db->insert_batch("cash_ornum",$data);
			
			$this->insertlogs("Added ornum ". $this->input->post("firstornum"). " to ".$this->input->post("lastornum"). " Date: ". date("Y-m-d"));
		}
		
		public function check_ornum($firstnum,$lastnum)
		{
			$sql = "select ornum from cash_ornum where ornum in (?,?) and paycatid = ?";
			$query = $this->db->query($sql,array($firstnum,$lastnum,$this->input->post("cat")));
			return $query;
		}
		
		
		public function get_ornum_pagination($mode = 2,$count = 0)
		{
			if ($mode == 1) #KUN WARAY WHERE DATE = CHURVA
 			{
				$this->db->select("a.ornum,b.payid");
			}
			else
			{
				$this->db->limit($count,intval($this->uri->segment(4)));	
			}
			
			if (!empty($paycatid))
			{
				
				$this->db->where("a.paycatid",$paycatid);
			}
			
			$paycatid = $this->session->userdata("paycatid");
			$searchor = $this->session->userdata("searchor");
				
			if(!empty($paycatid)) { $this->db->where("a.paycatid",$paycatid);}
			if(!empty($searchor)) { $this->db->like("a.ornum",$searchor);}
			
			$this->db->select("a.ornum,b.payid,a.ornum_id,a.status,a.dateadded,b.payid");
			#$this->db->from("cash_ornum");
			$this->db->from("cash_ornum a");
			$this->db->join("cash_payment b","a.ornum_id = b.ornum_id","left");
			$this->db->join("venue c","a.venid = c.venid","left");
			$this->db->where('c.venid', $this->session->userdata("venid"));
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function cancel_or($idnum = 0)
		{	
			$sql = 'update cash_payment a
				inner join cash_ornum b on a.ornum_id = b.ornum_id
				set a.status = 0, a.ornum_id = 0, b.status = 2
				where b.ornum_id = ?';
			$this->db->query($sql,array($idnum));
			#print_r($this->db->last_query()); die();
			$this->insertlogs("Cancelled OR ID:".$idnum." on cash_ornum");
		}
		
		public function unverify($payid = 0)
		{	
			// Insert error correction if it was unverified
			$remarks = $this->input->post('remarks');
			$sql = "INSERT INTO cash_ornum_error (ornum_id,remarks)
					SELECT ornum_id,?
					FROM   cash_payment
					WHERE  payid = ?";
			$this->db->query($sql,array($remarks,$payid));
			//--------------------------------------
			
			$sql = 'update cash_payment a
				inner join cash_ornum b on a.ornum_id = b.ornum_id
				set a.status = 0, a.ornum_id = 0, b.status = 0
				where a.payid = ?';
			$this->db->query($sql,array($payid));
			
			$this->insertlogs("Unverified Payid: $payid on cash_payment");
		}
				
		public function insertlogs($actiontaken)
		{
			$data = array(
				"query" => $actiontaken,
				"user" => $this->session->userdata("userid"),
			);
			
			$this->db->insert("logs_cash",$data);
		}
		
		public function delete_header($table = "",$repid = 0)
		{
			$this->db->where("repid",$repid);
			$this->db->delete("cash_reports_".$table);
			
			$this->insertlogs("Deleted $repid on cash_reports_".$table);
		}
		
		function getfeejson($lols = null){
			$this->db->select("typename,typeshort,amount,module,descriptn,paycatid,paytypeid");
			$this->db->from("cash_payment_type a");
			$this->db->join("module b","a.typename = b.modcode","left");
			$this->db->where("a.paytypeid",$lols);
			$query = $this->db->get();
			return $query;
		}
		
		function confirmeditfee()
		{
			$data = array(
				"amount" => $this->input->post("amount"),
				"paycatid" => $this->input->post("category3")
			);
			
			$this->db->where("paytypeid",$this->input->post("paytypeid"));
			$this->db->update("cash_payment_type",$data);
		}
		
		function getornum($trainingid = "abc")
		{
			$sql = "Select ornum_id,a.code,a.trid
					from training a
					inner join cash_payment b on a.payid = b.payid or a.payid2 = b.payid
					where a.trainingid = ?";
			$query = $this->db->query($sql,array($trainingid));
			return $query;
		}
		
		function getpayment($payid)
		{
			$query = $this->db->get_where("cash_payment",array("payid" => $payid));
			#print_r($this->db->last_query());
			return $query;
		}
		
		function transfer($rec = 0,$paylistid = 0,$category = 0,$trainingid = 0)
		{
			
			$data = array(
				"paydate" => date("Y-m-d"),
				"paycatid" => $category,
				"trid" => $rec["trid"],
				"payor" => $rec["payor"],
			);
			$this->db->insert("cash_payment",$data);
			
			$lastid = $this->db->insert_id();
			
			$sql = "update cash_paymentlist
			set payid = ? where paylistid = ?";
			$this->db->query($sql,array($lastid,$paylistid));
			
			$sql = "update training set payid = ?, payid2 = 0 where trainingid = ?";
			$this->db->query($sql,array($lastid,$trainingid));
		}
		
		//Cut-off
		public function get_cutoff()
		{
			return $this->db->get("cash_options");
		}
		
		public function set_cutoff($var = 0)
		{
			$sql = "update cash_options set cutoff = ?";
			return $this->db->query($sql,array($var));
		}
		//-----------------------
		
		public function changepayor($payid = 0)
		{
			$sql = "update cash_payment set payor = UCASE(?) where payid = ?";
			$this->db->query($sql,array($this->input->post("payor"),$payid));
		}
		
		public function get_begbalance2($paycatid)
		{
			$sql = "select sum(amount) from cash_payment a
			inner join cash_paymentlist b on a.payid = b.payid
			where ornum_id <> 0 and year(paydate) = year(now()) and month(paydate) < month(now()) and a.paycatid = 2";
			$collected = $this->db->query($sql,array($paycatid))->row_array();


			$sql = "select sum(amount) from cash_controlno a
			inner join cash_ornum b on a.afterornum = b.ornum
			where year(dateused) = year(now()) and month(dateused) < month(now()) and a.paycatid = 2";
			$deposited = $this->db->query($sql,array($paycatid))->row_array();
			
			$amount = floatval($collected["amount"]) - floatval($deposited["amount"]);
			
			return $amount;
		}
		
		public function get_begbalance($paycatid = 0)
		{
			$startdate = $this->input->post("startdate");
			
			$sql = "select * from cash_begbal where paycatid = ? and bbmonth = month(?) and bbyear = year(?)";
			$query = $this->db->query($sql,array($paycatid,$startdate,$startdate));
			// print_r($this->db->last_query()); die;
			return $query;
		}
		
		public function get_owwa_list($mode = 2,$count = 0)
		{
			if ($mode == 1) #KUN WARAY WHERE DATE = CHURVA
 			{
				$this->db->select("a.payid");
			}
			else
			{
				// $this->db->select("a.payid");
				$this->db->limit($count,intval($this->uri->segment(4)));	
			}
			
			$ornum_id = $this->input->post("ornum_id");
			if (!empty($ornum_id))
			{
				$this->db->where("controlno",$ornum_id);
			}
			
			$this->db->from("cash_payment a");
			$this->db->join('cash_paymentlist b','a.payid = b.payid', 'left');
			$this->db->join('cash_payment_type c','b.paytypeid = c.paytypeid', 'left');
			$this->db->join('cash_ornum d','a.ornum_id = d.ornum_id', 'left');
			$this->db->like('a.payor', 'OWWA');
			$this->db->where('a.status', 1);
			$this->db->order_by('a.paydate', 'desc');
			$query = $this->db->get();
			// print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function get_owwa_list_ornum($payid = 0)
		{
			$sql = "select a.*,coalesce(c.module,b.typename) as typename,d.paydate, e.ornum, e.ornum_id
					from cash_paymentlist a
					inner join cash_payment_type b on a.paytypeid = b.paytypeid
					left join module c on b.typename = c.modcode
					left join cash_payment d on a.payid = d.payid
					left join cash_ornum e on d.ornum_id = e.ornum_id
					where a.payid = ?";
			$query = $this->db->query($sql, [$payid]);
			// print_r($this->db->last_query()); die();
			return $query;		
		}
		
		public function get_owwa_trainee($string = '')
		{
			$string = explode(',',$string);
			$lname = (!isset($string[0]) ? '' : trim($string[0]));
			$fname = (!isset($string[1]) ? '' : trim($string[1]));
			$mname = (!isset($string[2]) ? '' : trim($string[2]));
			
			$this->db->like('lname', $lname);
			$this->db->like('fname', $fname);
			$this->db->like('mname', $mname);
			$query = $this->db->get('trainee');
			return $query;
		}
		
		public function insert_owwa_list($trainingid, $ornum_id, $paylistid)
		{
			$data = [
						"ornum_id" => $ornum_id,
						"trainingid" => $trainingid,
						"paylistid" => $paylistid,
						"dateadded" => date('Y-m-d H:i:s'),
						"userid" => $this->session->userdata('userid')
					];
			$this->db->insert("cash_owwa_list",$data);
		}
		
		public function get_owwa_list_paylistid($paylistid = 0)
		{
			$sql = "select a.*,b.trid, c.lname, c.fname, c.mname, d.start, d.end, e.module
					from cash_owwa_list a
					inner join training b on a.trainingid = b.trainingid
					inner join trainee c on b.trid = c.trid
					inner join schedule d on b.code = d.code
					inner join module e on d.modcode = e.modcode
					where paylistid = ?";
			$query = $this->db->query($sql, [$paylistid]);
			// print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function check_owwa_list($trainingid, $paylistid)
		{
			$sql = "select * from cash_owwa_list where trainingid = ? and paylistid = ?";
			$query = $this->db->query($sql, [$trainingid, $paylistid]);
			// print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function delete_owwa_trainee($owwaid)
		{
			$sql = "delete from cash_owwa_list where owwaid = ?";
			$query = $this->db->query($sql, [$owwaid]);
			print_r($this->db->last_query()); die();
			return $query;
		}

		
	}
?>