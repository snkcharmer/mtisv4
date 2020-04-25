<?php
	class Trainee_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();	
		}	
		
		function getselyear()
		{
			$query = $this->db->get('settings');
			if ($query->num_rows() > 0)
			{
			   $row = $query->row(); 
			   return $row->year;
			}
		}
		
		function checkfirstrecord()
		{
			$selyear = $this->getselyear().'00001';
			$query = $this->db->get_where('trainee', array('trid' => $selyear));
			if ($query->num_rows() > 0)
			{
			   return true;
			}
		}
		
		function searchtraining($trid)
		{
			$sql = "select a.trainingid,a.fgrade,a.compgrade,a.compdate,a.compref,a.certnumber,b.*,d.license,e.rank,f.name,c.module,g.sptypename,concat(i.code,' - DNA') as lolss,k.module as dnamodule,j.start as dnastart,j.end as dnaend,l.ornum,m.venue
			from training a 
			left join schedule b on a.code = b.code 
			left join module c on b.modcode = c.modcode 
			left join license d on a.licid = d.licid 
			left join rank e on a.rankid = e.rankid 
			left join employer f on a.employid = f.employid
			left join sponsor_type g on a.sponid = g.sponid
			left join cash_payment h on a.payid = h.payid
			left join schedule_removed i on a.trainingid = i.trainingid
			left join schedule j on i.code = j.code
			left join module k on j.modcode = k.modcode 
			left join cash_ornum l on h.ornum_id = l.ornum_id
			left join venue m on m.venid = b.venid
			where a.trid = ? 
			order by 
			a.code desc";
			$query = $this->db->query($sql,array($trid));
			#print_r($this->db->last_query());die();
			return $query;
		}
		
		function searchtraining2($trid)
		{
			$sql = "select a.*,b.*,d.license,e.rank,f.name,c.module,g.sptypename
			from training a 
			inner join schedule b on a.code = b.code 
			inner join module c on b.modcode = c.modcode 
			left join license d on a.licid = d.licid 
			left join rank e on a.rankid = e.rankid 
			left join employer f on a.employid = f.employid
			left join sponsor_type g on a.sponid = g.sponid
			where a.trid = ? 
			order by 
			a.code desc";
			$query = $this->db->query($sql,array($trid));
			#print_r($this->db->last_query());die();
			return $query;
		}
		
		function searchtrainingdel($trid)
		{
			$sql = "select a.trainingid,b.*,c.module 
					from training a 
					inner join schedule b on a.code = b.code 
					inner join module c on b.modcode = c.modcode 
					where a.trid = ? 
					order by a.code desc";
			$query = $this->db->query($sql,array($trid));
			return $query;
		}
		
		function searchtrainee($trid)
		{
			return $this->db->get_where('trainee',array('trid' => $trid));
		}
		
		function complete_trainee_info($trid)
		{
			$sql = "SELECT a.trid,a.lname,a.fname,a.mname,a.suffix,d.license,e.rank,f.name
			FROM trainee AS a
			LEFT JOIN training AS b ON b.trid = a.trid
			LEFT JOIN schedule AS c ON c.code = b.code
			LEFT JOIN license AS d ON d.licid = b.licid
			LEFT JOIN rank AS e ON e.rankid = b.rankid
			LEFT JOIN employer AS f ON f.employid = a.employid
			where a.trid = ?
			order by c.code desc";
			return $this->db->query($sql,array($trid));
		}
		
		public function addtrainee()
		{
			$lname = $this->input->post("lname");
			$fname = $this->input->post("fname");
			$mname = $this->input->post("mname");
			$suffix = $this->input->post("suffix");
			$bdate = $this->input->post("bdate");
			$sex = $this->input->post("sex");
			$civstatid = $this->input->post("civilstat");
			$citid = $this->input->post("citizenship");
			$landline = $this->input->post("landline");
			$mobile = $this->input->post("mobile");
			$relid = $this->input->post("religion");
			$bplace = $this->input->post("bplace");
			$address = $this->input->post("address");
			$zip = $this->input->post("zip");
			$regid = $this->input->post("region");
			$locid = $this->input->post("town");
			$courseid = $this->input->post("course");
			$schoolid = $this->input->post("school");
			$eadd = $this->input->post("eadd");
			$emname = $this->input->post("emname");
			$emaddr = $this->input->post("emaddr");
			$emphone = $this->input->post("emphone");
			$user = $this->session->userdata("userid"); #24
			$selyear = $this->getselyear();
			
			if ($this->checkfirstrecord())
			{
				$sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix,bdate,sex,civstatid,citid,landline,mobile,relid,bplace,address,zip,regid,locid,courseid,schoolid,eadd,emname,emaddr,emphone,user,entrydate) select concat(?,LPAD(mid(max(trid) + 1,5,9),5,'0')),UCASE(?),UCASE(?),UCASE(?),UCASE(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now() from trainee where exists (select * from trainee where trid = ?)";
				$query = $this->db->query($sql, array($selyear,$lname,$fname,$mname,$suffix,$bdate,$sex,$civstatid,$citid,$landline,$mobile,$relid,$bplace,$address,$zip,$regid,$locid,$courseid,$schoolid,$eadd,$emname,$emaddr,$emphone,$user,$selyear.'00001'));
			}
			else
			{
				$sql = "Insert into trainee (trid,lname,fname,mname,suffix,bdate,sex,civstatid,citid,landline,mobile,relid,bplace,address,zip,regid,locid,courseid,schoolid,eadd,emname,emaddr,emphone,user) values (UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$query = $this->db->query($sql, array($selyear.'00001',$lname,$fname,$mname,$suffix,$bdate,$sex,$civstatid,$citid,$landline,$mobile,$relid,$bplace,$address,$zip,$regid,$locid,$courseid,$schoolid,$eadd,$emname,$emaddr,$emphone,$user));
			}
			$sql = "select max(trid) as lols from trainee";
			$lastid = $this->db->query($sql)->row_array();
			return $lastid["lols"];
			#$this->db->insert("trainee", $data);
		}
		
		public function getmaxtrid($selyear)
		{
			$sql = "select max(trid) as maxtrid from trainee where left(trid,4) = ?";
			$query = $this->db->query($sql,array($selyear));
			return $query;
		}
		
		public function addtrainee2()
		{
			$selyear = $this->getselyear();
			$rec = $this->getmaxtrid($selyear)->row_array();
			$maxtrid = $rec["maxtrid"] + 1;
			$lname = $this->input->post('lname');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$suffix = $this->input->post('suffix');
			$sex = $this->input->post('sex');
			$bdate = $this->input->post('bdate');
			
			if ($this->checkfirstrecord())
			{
				$data = array(
					"trid" => $maxtrid, 
					"lname" => strtoupper($lname), 
					"fname" => strtoupper($fname), 
					"mname" => strtoupper($mname), 
					"suffix" => $suffix, 
					"bdate" => $bdate, 
					"sex" => $sex, 
					"entrydate" => date("Y-m-d")
				);
				$this->db->insert("trainee",$data);
			}
			else
			{
				$sql = "Insert into trainee (trid,lname,fname,mname,suffix,sex,bdate,entrydate) values (UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),?,now())";
				$query = $this->db->query($sql, array($selyear.'00001',$lname,$fname,$mname,$suffix,$sex,$bdate));
			}
			
			$last_id = $this->db->insert_id();
			$sql = "select trid from trainee where idnum = ?";
			$lastid = $this->db->query($sql,array($last_id))->row_array();
			
			return $lastid["trid"];
		}
		
		public function addtrainee22()
		{
			//sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix,bdate) select concat('" & selyear & "',LPAD(mid(max(trid) + 1,5,9),5,'0')),'" & txtLname.Text & "','" & txtFname.Text & "','" & txtmName.Text & "','" & txtSuffix.Text & "','" & Format(txtBday.Value, "yyyy-MM-dd") & "' from trainee where exists (select * from trainee where trid = '" & selyear & "00001')"
			
			//Select selyear 00001 if exists, kun waray
			$selyear = $this->getselyear();
			$lname = $this->input->post('lname');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$suffix = $this->input->post('suffix');
			$sex = $this->input->post('sex');
			$bdate = $this->input->post('bdate');
			
			#echo $sex; die();
			if ($this->checkfirstrecord())
			{
				$sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix,bdate,sex,entrydate) select concat(?,LPAD(mid(max(trid) + 1,5,9),5,'0')),UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),?,now() from trainee where exists (select * from trainee where trid = ?)";
				$query = $this->db->query($sql, array($selyear,$lname,$fname,$mname,$suffix,$bdate,$sex,$selyear.'00001'));
			}
			else
			{
				//$sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix) select concat(?,LPAD(mid(max(trid),5,9),5,'0')),?,?,?,? from trainee where not exists (select * from trainee where trid = ?)";
				$sql = "Insert into trainee (trid,lname,fname,mname,suffix,sex,bdate,entrydate) values (UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),UCASE(?),?,now())";
				$query = $this->db->query($sql, array($selyear.'00001',$lname,$fname,$mname,$suffix,$sex,$bdate));
			}
			$sql = "select max(trid) as lols from trainee";
			$lastid = $this->db->query($sql)->row_array();
			return $lastid["lols"];
		}
		
		public function updateenroll()
		{
			$rankid = ($this->input->post('rankid') != "#" ? $this->input->post('rankid') : NULL);
			$licid = ($this->input->post('licid') != "#" ? $this->input->post('licid') : NULL);
			//$posid = ($this->input->post('posid') != "#" ? $this->input->post('posid') : NULL);
			#$sponid = ($this->input->post('sponid') != "#" ? $this->input->post('sponid') : NULL);
			$employer = $this->input->post('employer');
			$empid = $this->input->post('empid');
			$trid = $this->input->post('trid');
	
			$data['licid'] = $licid;
			$data['rankid'] = $rankid;
			#$data['posid'] = $posid;
			$data['employid'] = $employer;

			#print_r($data); die();
			$this->db->where('trid',$trid);
			$this->db->update('trainee',$data);
			
		}
		
		function delete_trainee($trid = NULL)
		{
			$sql = "DELETE a.*, aa.*, b.*, c.*, d.*, e.*
					FROM trainee aa
					LEFT JOIN training a
					ON aa.trid = a.trid
					LEFT JOIN cash_payment b 
					ON a.payid = b.payid
					LEFT JOIN cash_paymentlist c
					ON a.payid = c.payid					
					LEFT JOIN training d 
					ON a.payid = d.payid
					LEFT JOIN subtraining e 
					ON a.trainingid = e.trainingid
					WHERE aa.trid = ?";
			$this->db->query($sql,array($trid));
		}
		
		
		function confirm_enroll($records)
		{
			//die();
			#$data['sponid'] = $sponid;
			$userid = $this->session->userdata("userid");
			
			foreach($records as $key3){ $lols[] = $key3["code"]; }
			
			$this->db->where_in('code', $lols);
			$query = $this->db->get('schedule')->result_array();
			
			$trid = $this->session->userdata('trid');
			$record = $this->searchtrainee($trid)->row_array();
			
			#---insert new cash payment
			$payments = array(
				"trid" => $trid,
				"paydate" => date("Y-m-d"),
				"paycatid" => $this->session->userdata("paycatid"),
				"venid" => $this->session->userdata("venid"),
				"user" => $this->session->userdata("userid"),
			);
			$this->db->insert("cash_payment",$payments);
			#---end
			
			#get latest cash_payment--start
			$lastid1 = $this->db->insert_id();
			#get latest cash_payment--end
			
			#insert other fees / payid2--------------------start
			$ofee = $this->session->userdata("ofee");
			$ofee2 = $ofee;
			#print_r(is_array($ofee)); die();
			if (is_array($ofee))
			{
				#echo count($ofee); die();
				reset($ofee2); #---------get first key to determine the paycatid of other fee
				$first_key = key($ofee2); 
				$sql = "select * from cash_payment_type where paytypeid = ?";
				$qweqwe = $this->db->query($sql,array($first_key))->row_array();
		
				#print_r($qweqwe); die();
				$payments = array(
					"trid" => $trid,
					"paydate" => date("Y-m-d"),
					"paycatid" => $qweqwe["paycatid"],
					"venid" => $this->session->userdata("venid"),
					"user" => $this->session->userdata("userid"),
				);
				
				$this->db->insert("cash_payment",$payments);
				
				$lastid2 = $this->db->insert_id();
				
				foreach($ofee as $row5 => $key5)
				{
					$sql = "insert into cash_paymentlist (payid,amount,paytypeid) values (?,?,?)";
					$this->db->query($sql,array($lastid2,$key5,$row5));
				}
			}
			#insert other fees / payid2--------------------end
			
			
			
			foreach ($query as $row){
				
				$key = array_search($row['code'], array_column($records, 'code'));
				
				$data[] = array(
				'trid' => $trid,
				'code' => $row['code'],
				'licid' => $record['licid'],
				'rankid' => $record['rankid'],
				'employid' => $record['employid'],
				'civstatid' => $record['civstatid'],
				'sponid' => $records[$key]["sponsor"],
				'enrolled' => date('Y-m-d'),
				//'regid' => $record['regid'],
				'user' => $userid,
				'payid' => $lastid1,
				'payid2' => ($lastid2 == NULL ? 0 : $lastid2)
				);
				
				$sql = "update schedule set size = size + 1 where code = ?";
				$this->db->query($sql,array($row["code"]));
				
				#check if it has submodule--------start
				$sql = "select a.code,b.modcode,b.module
					from schedule a 
					join module b on a.modcode = b.modcode
					join submodule c on b.modcode = c.modcode 
					where a.code = ?
					group by a.code";
				$result = $this->db->query($sql,array($row["code"]));
				//$this->db->select("code");
				//$result = $this->db->get_where("schedule_with_submod",array("code" => $row["code"]));
				
				if ($result->num_rows() > 0)
				{
					$result = $result->row_array();
					$subcode = $result["code"];
				}
				#check if it has submodule--------end
			}
			
			$this->db->insert_batch('training',$data);
			
			foreach ($query as $row)
			{
				#insert to cash_paymentlist an mga modules--
				#get amount of fee------
				$sql = "select a.paytypeid,a.amount,c.trainingid from cash_payment_type a 
				inner join schedule b on a.typename = b.modcode 
				inner join training c on c.code = b.code 
				inner join trainee d on d.trid = c.trid 
				where b.code = ? and d.trid = ?";
				$trainfee = $this->db->query($sql,array($row["code"],$trid))->row();
				
				#get amount of fee------
				$sql = "Insert into cash_paymentlist(payid,amount,paytypeid,trainingid) values (?,?,?,?)";
				$this->db->query($sql,array($lastid1,$trainfee->amount,$trainfee->paytypeid,$trainfee->trainingid));
			}
			
			#---insert to subtraining-----------start
			if (!empty($subcode)) 	
			{
				$sql = "Insert into subtraining(trainingid,submodid,user) select a.trainingid,c.submodid,? from training a inner join schedule b on a.code = b.code inner join submodule c on b.modcode = c.modcode where a.code = ? and a.trid = ?";
				
				$this->db->query($sql,array($this->session->userdata("userid"), $subcode,$trid));
			}
			#insert to subtraining-----------end 
			
			#---insert other fees to cash_payments----------start
			$fees = $this->input->post("fees");
			
			foreach($fees as $row => $key)
			{
				if ((!empty($key)) or ($key != 0))
				{
					$sql = "insert into cash_paymentlist (payid,amount,paytypeid) values (?,?,?)";
					$this->db->query($sql,array($lastid1,$key,$row));		
				}
				else
				{
					$this->db->select("amount");
					$sql = "INSERT INTO cash_paymentlist
							(payid,amount,paytypeid)
							SELECT ?,amount,?
							FROM cash_payment_type where paytypeid = ? and amount != 0";
					$this->db->query($sql,array($lastid1,$row,$row));
				}
			}
				
			#insert to cash_payments-----------end
			
			#---insert other discount to cash_payments----------start
			$disccode = $this->input->post("disccode");
			$discamount = $this->input->post("discamount");
			
			foreach($disccode as $row => $key)
			{
				if (!empty($discamount[$row]) or $discamount[$row] != "") 
				{
					#$sql = "insert into cash_paymentlist (payid,amount,misccode) values (?,? * -1,?)";
					$sql = "insert into cash_paymentlist (payid,amount,paytypeid) values (?,? * -1,0)";
					$this->db->query($sql,array($lastid1,intval($discamount[$row]),$key));
					
					$data = array(
						"sponid" => $disccode[$row]
					);
					$this->db->where("payid",$lastid1);
					$this->db->update("training",$data);
				}
			}
			
			
		}
		
		/*function delete_training($code = NULL)
		{
			$trid = $this->session->userdata("trid");
			
			$this->db->select("payid,payid2");
			$res = $this->db->get_where("training", array("code" => $code,"trid" => $trid))->row_array();
			$payid1 = $res["payid"];
			$payid2 = $res["payid2"];
			
			$sql = "DELETE a.*, e.*
					FROM training a 
					LEFT JOIN subtraining e ON a.trainingid = e.trainingid
					WHERE a.code = ? and a.trid = ?";
			$this->db->query($sql,array($code,$trid));
			
			
			$sql = "Delete a.*,b.*
					from cash_payment a
					LEFT JOIN cash_paymentlist b on a.payid = b.payid
					where a.payid in (?,?)";
			$this->db->query($sql,array($payid1,$payid2));
			
			$sql = "update schedule set size = (Select count(trid) from training where code = ?) where code = ?";
			
			$this->db->query($sql,array($code,$code));
		}*/
		
		function delete_training($trid = 0,$trainingid = "abc")
		{
			$mode = $this->input->post("optiondel");
			
			$this->db->select("payid,payid2,code");
			$res = $this->db->get_where("training", array("trainingid" => $trainingid))->row_array();
			$payid1 = $res["payid"];
			$payid2 = $res["payid2"];
			$code = $res["code"];
			#print_r($this->db->last_query()); die();
			// if ($mode == 1)
			// {
				$sql = "DELETE a.*, e.*
					FROM training a 
					LEFT JOIN subtraining e ON a.trainingid = e.trainingid
					WHERE a.trainingid = ?";
				$this->db->query($sql,array($trainingid));
				$this->insertlogs($trid,$this->db->last_query());
				$sql = "Delete from cash_paymentlist where trainingid = ?";
				$this->db->query($sql,array($trainingid));
				$this->insertlogs($trid,$this->db->last_query());
				$sql = "update schedule set size = (Select count(trid) from training where code = ?) where code = ?";
				$this->db->query($sql,array($code,$code));
				$this->insertlogs($trid,$this->db->last_query());
			// }
			// elseif ($mode == 2)
			// {
				// $sql = "select code from training where payid = ?";
				// $search = $this->db->query($sql,array($payid1))->result_array();
				// $this->insertlogs($trid,$this->db->last_query());
				// $sql = "DELETE a.*, e.*
					// FROM training a 
					// LEFT JOIN subtraining e ON a.trainingid = e.trainingid
					// WHERE a.payid = ?";
				// $this->db->query($sql,array($payid1));
				// $this->insertlogs($trid,$this->db->last_query());
				// $sql = "Delete a.*,b.*
					// from cash_payment a
					// LEFT JOIN cash_paymentlist b on a.payid = b.payid
					// where a.payid in (?,?)";	
				// $this->db->query($sql,array($payid1,$payid2));
				// $this->insertlogs($trid,$this->db->last_query());
				// foreach ($search as $key)
				// {
					// $sql = "update schedule set size = (Select count(trid) from training where code = ?) where code = ?";
					// $this->db->query($sql,array($key["code"],$key["code"]));
				// }
			// }
			
			// $this->insertlogs($trid,$this->db->last_query());
		}
		
		public function update_information()
		{
			$data = array(
			"lname" => strtoupper($this->input->post("lname")),
			"fname" => strtoupper($this->input->post("fname")),
			"mname" => strtoupper($this->input->post("mname")),
			"suffix" => strtoupper($this->input->post("suffix")),
			"sex" => $this->input->post("sex"),
			"civstatid" => $this->input->post("civilstat"),
			"citid" => $this->input->post("citizenship"),
			"landline" => $this->input->post("landline"),
			"mobile" => $this->input->post("mobile"),
			"relid" => $this->input->post("religion"),
			"bdate" => $this->input->post("bdate"),
			"bplace" => strtoupper($this->input->post("bplace")),
			"address" => strtoupper($this->input->post("address")),
			"zip" => $this->input->post("zip"),
			"regid" => $this->input->post("region"),
			"locid" => $this->input->post("town"),
			"courseid" => $this->input->post("course"),
			"schoolid" => $this->input->post("school"),
			"eadd" => $this->input->post("eadd"),
			"emname" => strtoupper($this->input->post("emname")),
			"emaddr" => strtoupper($this->input->post("emaddr")),
			"emphone" => $this->input->post("emphone"),
			"user" => $this->session->userdata("userid"),
			);
			
			#print_r($data); die();
			#echo $this->input->post("course"); die();
			$this->db->where("trid", $this->input->post("trid"));
			$this->db->update("trainee", $data);
		}
		
		public function add_date_validation($trid = NULL)
		{
			$data = array(
				"valid_id" => $this->input->post("valid"),
				"expire_id" => $this->input->post("expire")
			);
			$this->db->where("trid",$trid);
			$this->db->update("trainee",$data);
		}
		
		public function remove_code($trainingid = 0,$code = 0)
		{
			$sql = "INSERT INTO schedule_removed
							(trainingid,code,user)
							SELECT trainingid,code,?
							FROM training where trainingid = ?";
			$this->db->query($sql,array($this->session->userdata("userid"),$trainingid));
			
			$data = array(
				"code" => 0,
			);
			
			$this->db->where("trainingid",$trainingid);
			$this->db->update("training",$data); 
			
			$sql = "update schedule set size = size - 1 where code = ?";
			$this->db->query($sql,array($code));
		}
		
		public function transfer_sched()
		{
			$code = $this->input->post("code");
			$trainingid = $this->input->post("trainingid");
			
			$sql1 = $this->db->get_where("schedule",["code" => $code])->row_array();
			$query2 = "select j.modcode from training a
					inner join schedule_removed i on a.trainingid = i.trainingid
					inner join schedule j on i.code = j.code
					where a.trainingid = ?";
			$sql2 = $this->db->query($query2,array($trainingid))->row_array();
			// print_r($this->db->last_query());
			// print_r($sql2['modcode']); die();
			if ($sql1['modcode'] == $sql2['modcode']) {
				
				$data = array(
					"code" => $code
				);
				$this->db->where("trainingid",$trainingid);
				$this->db->update("training",$data);
				
				$sql = "update schedule set size = size + 1 where code = ?";
				$this->db->query($sql,array($code));
				
				$sql = "select d.* from training a 
						inner join schedule b on a.code = b.code
						inner join module c on b.modcode = c.modcode
						inner join cash_payment_type d on c.modcode = d.typename
						where trainingid = ?";
				$query = $this->db->query($sql,array($trainingid))->row_array();
				
				$sql = "update cash_paymentlist
						set paytypeid = ?
						where trainingid = ?";
				$this->db->query($sql,array($query["paytypeid"],$trainingid));
				$this->session->set_flashdata('message', '<div style="background: green; margin-top:5px; color:#fff;">Successfully transferred to a different Schedule</div>');
			} else {
				$this->session->set_flashdata('message', '<div style="background:#ad0c0c; margin-top:5px; color:#fff;">Transfer must be with the same Module</div>');
			}
		}
		
		function printregistrationform($code = 0)
		{
			$this->db->select('aa.*,b.civstatid,b.civstat, c.religion, d.course, e.licid as liccode, e.license as licname, f.rankid as rankcode, f.rank as rankname, g.regid, g.region, h.citid, h.citizen, i.municipal, i.province,group_concat(concat(cc.module,":",bb.start,":",bb.end,":",m.venue,
			":", k.sptypename) separator "*") as modulestake, j.name, a.enrolled,
			l.school, l.address as schadd',false);
			$this->db->from("training a");
			$this->db->join("trainee aa","aa.trid = a.trid");
			$this->db->join("schedule bb","bb.code = a.code");
			$this->db->join("module cc","cc.modcode = bb.modcode");
			$this->db->join("civstat b","aa.civstatid =  b.civstatid","left");
			$this->db->join("religion c","aa.relid = c.relid","left");
			$this->db->join("course d","aa.courseid = d.courseid","left");
			$this->db->join("license e","a.licid = e.licid","left");
			$this->db->join("rank f","a.rankid = f.rankid", "left");
			$this->db->join("region g","aa.regid = g.regid", "left");
			$this->db->join("citizen h","aa.citid = h.citid", "left");
			$this->db->join("zip i","aa.locid = i.idnum", "left");
			$this->db->join("employer j","aa.employid = j.employid", "left");
			$this->db->join("sponsor_type k","a.sponid = k.sponid", "left");
			$this->db->join("school l","aa.schoolid = l.schoolid", "left");
			$this->db->join("venue m","bb.venid = m.venid", "left");
			$this->db->where("a.code",$code); 
			$this->db->group_by("a.trid"); 
			$this->db->order_by("lname,fname"); 
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function printregformtrainee($trainingid = 0)
		{
			$this->db->select('aa.*,b.civstatid,b.civstat, c.religion, d.course, e.licid as liccode, e.license as licname, f.rankid as rankcode, f.rank as rankname, g.regid, g.region, h.citid, h.citizen, i.municipal, i.province,cc.module,bb.start,bb.end,m.venue,k.sptypename, j.name, a.enrolled,
			l.school, l.address as schadd',false);
			$this->db->from("training a");
			$this->db->join("trainee aa","aa.trid = a.trid");
			$this->db->join("schedule bb","bb.code = a.code");
			$this->db->join("module cc","cc.modcode = bb.modcode");
			$this->db->join("civstat b","aa.civstatid =  b.civstatid","left");
			$this->db->join("religion c","aa.relid = c.relid","left");
			$this->db->join("course d","aa.courseid = d.courseid","left");
			$this->db->join("license e","a.licid = e.licid","left");
			$this->db->join("rank f","a.rankid = f.rankid", "left");
			$this->db->join("region g","aa.regid = g.regid", "left");
			$this->db->join("citizen h","aa.citid = h.citid", "left");
			$this->db->join("zip i","aa.locid = i.idnum", "left");
			$this->db->join("employer j","aa.employid = j.employid", "left");
			$this->db->join("sponsor_type k","a.sponid = k.sponid", "left");
			$this->db->join("school l","aa.schoolid = l.schoolid", "left");
			$this->db->join("venue m","bb.venid = m.venid", "left");
			$this->db->where("a.trainingid",$trainingid); 
			$query = $this->db->get();
			// print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function insertlogs($trid = 0, $actiontaken = "")
		{
			$data = array(
				"trid" => $trid,
				"query" => $actiontaken,
				"user" => $this->session->userdata("userid"),
			);
			
			$this->db->insert("logs_mtis",$data);
		}
	}
?>