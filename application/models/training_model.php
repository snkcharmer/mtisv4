<?php	
	class Training_model extends CI_Model
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
		
		public function addtrainee()
		{
			//sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix,bdate) select concat('" & selyear & "',LPAD(mid(max(trid) + 1,5,9),5,'0')),'" & txtLname.Text & "','" & txtFname.Text & "','" & txtmName.Text & "','" & txtSuffix.Text & "','" & Format(txtBday.Value, "yyyy-MM-dd") & "' from trainee where exists (select * from trainee where trid = '" & selyear & "00001')"
			
			//Select selyear 00001 if exists, kun waray
			$selyear = $this->getselyear();
			$lname = $this->input->post('lname');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$suffix = $this->input->post('suffix');
			
			if ($this->checkfirstrecord())
			{
				$sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix) select concat(?,LPAD(mid(max(trid) + 1,5,9),5,'0')),?,?,?,? from trainee where exists (select * from trainee where trid = ?)";
				$query = $this->db->query($sql, array($selyear,$lname,$fname,$mname,$suffix,$selyear.'00001'));
			}
			else
			{
				//$sql = "INSERT INTO trainee (trid,lname,fname,mname,suffix) select concat(?,LPAD(mid(max(trid),5,9),5,'0')),?,?,?,? from trainee where not exists (select * from trainee where trid = ?)";
				$sql = "Insert into trainee (trid,lname,fname,mname,suffix) values (?,?,?,?,?)";
				$query = $this->db->query($sql, array($selyear.'00001',$lname,$fname,$mname,$suffix));
			}
		}
		
		public function get_training_records($code = NULL)
		{
			$this->db->select('concat(b.lname,", ",b.fname," ",left(b.mname,1)) as fullname,g.module,c.code,b.lname, b.fname, b.mname, b.suffix, b.bdate, d.license, f.rank, e.name, a.fgrade, a.trainingid, a.remark, a.compdate, a.compgrade, a.compref, b.trid, a.certnumber,c.end, a.certdate,h.sptypename,h.sptypeshort,a.remarks_cert,a.error_certnum',false);
			$this->db->from('training a');
			$this->db->join('trainee b', 'a.trid = b.trid', 'left');
			$this->db->join('schedule c', 'a.code = c.code', 'left');
			$this->db->join('license d','a.licid = d.licid', 'left');
			$this->db->join('employer e','a.employid = e.employid', 'left');
			$this->db->join('rank f','a.rankid = f.rankid', 'left');
			$this->db->join('module g','c.modcode = g.modcode', 'left');
			$this->db->join('sponsor_type h','a.sponid = h.sponid', 'left');
			$this->db->where('a.code', $code);
			$this->db->order_by("b.lname asc, b.fname asc");
			$query = $this->db->get();
			
			#print_r($this->db->last_query()); die();
			#print_r($query->result_array); die();
			#if ($query->num_rows > 0){ echo "lols";} else { echo "waray"; } die();
			return $query;
		}
		
		public function get_training_recordsssss($code = NULL)
		{
			$trid = $this->input->post('trid_data');
			
			$param = [$code];
			//print_r($trid);die();
			$sql = "SELECT concat(b.lname,', ',left(b.fname,1),'. ',left(b.mname,1),'.') as sname,concat(b.fname,' ',left(b.mname,1),'. ',b.lname,' ',b.suffix) as fullname,g.module,c.code,b.lname, b.fname, b.mname, b.suffix, b.bdate, d.license, f.rank, e.name, a.fgrade, a.trainingid, a.remark, a.compdate, a.compgrade, a.compref, b.trid, a.certnumber,c.start,c.end, a.certdate,h.sptypename,h.sptypeshort 
				from training as a 
				left join trainee as b on a.trid = b.trid
				left join schedule as c on a.code = c.code
				left join license as d on a.licid = d.licid
				left join employer as e on a.employid = e.employid
				left join rank as f on a.rankid = f.rankid
				left join module as g on c.modcode = g.modcode
				left join sponsor_type as h on a.sponid = h.sponid
				where a.code = ? and a.trainingid IN ($trid) and (a.certnumber <> null or a.certnumber <> '') order by b.lname";
			
			$query = $this->db->query($sql,$param);
			
			//print_r($this->db->last_query()); die();
			#print_r($query->result_array); die();
			#if ($query->num_rows > 0){ echo "lols";} else { echo "waray"; } die();
			return $query;
		}
		
		public function get_cert_template($modcode){

			$param = [$modcode];
			$sql = 'SELECT * from certificate_temp
				where modcode = ? ';
			
			$query = $this->db->query($sql,$param);
			
			//print_r($this->db->last_query()); die();
			#print_r($query->result_array); die();
			#if ($query->num_rows > 0){ echo "lols";} else { echo "waray"; } die();
			return $query;

		}
		
		public function get_reissuance_certificate(){

			$param = [$this->input->post('trainingid')];
			$this->db->select('concat(b.lname,", ",b.fname," ",left(b.mname,1),".") as fullname,g.module,c.code,b.lname, b.fname, b.mname, b.suffix, b.bdate, d.license, f.rank, e.name, a.fgrade, a.trainingid, a.remark, a.compdate, a.compgrade, a.compref, b.trid, a.certnumber,c.start,c.end, a.certdate,h.sptypename,h.sptypeshort',false);
			$this->db->from('training a');
			$this->db->join('trainee b', 'a.trid = b.trid', 'left');
			$this->db->join('schedule c', 'a.code = c.code', 'left');
			$this->db->join('license d','a.licid = d.licid', 'left');
			$this->db->join('employer e','a.employid = e.employid', 'left');
			$this->db->join('rank f','a.rankid = f.rankid', 'left');
			$this->db->join('module g','c.modcode = g.modcode', 'left');
			$this->db->join('sponsor_type h','a.sponid = h.sponid', 'left');
			//$this->db->join('certnumber i','a.trainingid = i.trainingid', 'left');
			$this->db->where_in('a.trainingid', $param);
			//$this->db->group_by('i.certnum');
			$this->db->order_by("b.lname asc, b.fname asc");
			$query = $this->db->get();
			
			//print_r($this->db->last_query()); die();
			#print_r($query->result_array); die();
			#if ($query->num_rows > 0){ echo "lols";} else { echo "waray"; } die();
			return $query;
		}
		
		public function get_training_data_(){

			$param = [$this->input->post('trainingid')];
			$sql = "SELECT * from training where trainingid IN (?) ";
			$query = $this->db->query($sql,$param);

			return $query;
		}
		
		public function confirmreissuedcert($code,$records)
		{

			//print_r($records);die();
			$x = 0;
			//$y = count($records);
			foreach ($records as $key) {

				$data = [
					'trid'=> $key['trid'],
					'code'=> $key['code'],
					'region'=> $key['region'],
					'fgrade'=>$key['fgrade'],
					'compgrade'=> $key['compgrade'],
					'compdate'=> $key['compdate'],
					'compref'=> $key['compref'],
					'remark'=> $key['remark'],
					'fgradeuser'=> $key['fgradeuser'],
					'certcode'=> $key['certcode'],
					'certnumber'=> "",
					'certdate'=> "",
					'sponcode'=> $key['sponcode'],
					'grok'=> $key['grok'],
					'gruser'=> $key['gruser'],
					'grdate'=> $key['grdate'],
					'crok'=> $key['crok'],
					'cruser'=> $key['cruser'],
					'crdate'=> $key['crdate'],
					'lastupdate'=> $key['lastupdate'],
					'enrolled'=> $key['enrolled'], 
					'sex'=> $key['sex'],
					'civstatid'=> $key['civstatid'],
					'withlic'=> $key['withlic'],
					'licid'=> $key['licid'],
					'licno'=> $key['licno'],
					'issued'=> $key['issued'],
					'withexp'=> $key['withexp'],
					'rankid'=> $key['rankid'],
					'employid'=> $key['employid'],
					'duration'=> $key['duration'],
					'sponcomp'=> $key['sponcomp'],
					'payid'=> $key['payid'],
					'payid2'=> $key['payid2'],
					'sponid'=> $key['sponid'],
					'emprofid'=> $key['emprofid'],
					'manid'=> $key['manid'],
					'certid'=> $key['certid'],
					'dateofdisembarkation'=> $key['dateofdisembarkation'],
					'remarks_cert'=> 'Reissue',
					'user'=> $this->session->userdata('userid'),
				];

				$this->db->insert('training',$data);
				$trid = $this->db->insert_id();
				$certnumber = $this->input->post("certnumber");
				$certdate = $this->input->post("certdate");

				$checkcert = $this->get_certnumber_records($certnumber[$x],$code)->num_rows();
				//print_r($checkcert); die();
				if($checkcert == 0){
					//die('sasdsa');
					$trainingrec = array(
						'trainingid' => $trid,
						'certnumber' => $certnumber[$x],
						'certdate' => empty($certdate[$x]) ? NULL : $certdate[$x],
						'crok' => empty($certdate[$x]) ? "N" : "Y",
						'cruser' => $this->session->userdata("userid"),
					);

					$certrec[] = array(
						'trainingid' => $trid,
						'certnum' => $certnumber[$x],
						'certdate' => empty($certdate[$x]) ? NULL : $certdate[$x],
						'code' => $code
					);

					$this->db->insert_batch('certnumber',$certrec);
			
					$this->db->where('trainingid',$trid);
					$this->db->update('training',$trainingrec);
				}

				$this->insertlogs($code,"Updated certificate of code: " . $code);
				#print_r($this->db->last_query()); die();
				//Edit Last No. of Certificate on Module
				//if(($x + 1) == $y){
				$sql = "Update module a inner join schedule b on a.modcode = b.modcode set a.lastno = ? where b.code = ?";
			
				$this->db->query($sql,array($certnumber[$x],$code));
				//}
				

				$x++;
			}

		}
		
		function get_certnumber_records($certnumber,$code){

			$param = [$certnumber,$code];
			$sql = "select * from certnumber where certnum = ? and code = ?";
			$query = $this->db->query($sql,$param);
			//print_r($this->db->last_query());die();
			return $query;
		}
		
		public function check_submodules($code = NULL)
		{
			#$this->db->select("code, modcode");
			#return $this->db->get_where("schedule_with_submod",array("code" => $code));
			$sql = "select a.code,b.modcode,b.module 
			from schedule a 
			inner join module b on a.modcode = b.modcode
			inner join submodule c on b.modcode = c.modcode 
			where a.code = ?
			group by a.code";
			$query = $this->db->query($sql,array($code));
			return $query;
		}
		
		public function get_submodule($code = NULL)
		{
			$this->db->select("c.submodule");
			$this->db->from('schedule a');
			$this->db->join('module b', 'a.modcode = b.modcode', 'inner');
			$this->db->join('submodule c', 'b.modcode = c.modcode', 'inner');
			$this->db->where("a.code", $code);
			
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		public function get_submodules_grades($code)
		{
			$trainee = $this->get_training_records($code);
			
			foreach ($trainee->result_array() as $rows)
			{
				$sql = "select b.subtrainid,d.code,e.trid,b.submodid,c.submodule,b.fgrade
						from training a 
						join subtraining b on a.trainingid = b.trainingid
						join submodule c on b.submodid = c.submodid
						join schedule d on a.code = d.code
						join trainee e on a.trid = e.trid 
						where a.trid = ? and a.code = ?
						order by e.lname asc,e.fname asc,c.submodule";
				$result = $this->db->query($sql,array($rows["trid"],$code));
				#print_r($this->db->last_query()); die();
				$grades = array();
				
				foreach($result->result_array() as $rows2)
				{
					$grades[] = array(
						"submodid" => $rows2["submodid"],
						"fgrade" => $rows2["fgrade"],
						"subtrainid" => $rows2["subtrainid"],
					);
				}
				
				#print_r($grades); die();
				
				$data[] = array(
					"trid" => $rows["trid"],
					"trainingid" => $rows["trainingid"],
					"license" => $rows["license"],
					"rank" => $rows["rank"],
					"fullname" => $rows["fullname"],
					"fname" => $rows["fname"],
					"lname" => $rows["lname"],
					"mname" => $rows["mname"],
					"suffix" => $rows["suffix"],
					"bdate" => $rows["bdate"],
					"name" => $rows["name"],
					"sptypename" => (empty($rows["sptypename"]) ? "PERS" : $rows["sptypename"]),
					"sptypeshort" => (empty($rows["sptypeshort"]) ? "PERS" : $rows["sptypeshort"]),
					"fgrade" => $rows["fgrade"],
					"compgrade" => $rows["compgrade"],
					"compdate" => $rows["compdate"],
					"compref" => $rows["compref"],
					"grade" => $grades
					);
			}
			
			if (!empty($data)) {
				return $data;
			}
		}
		
		public function editgrade($code)
		{
			$trid = $this->input->post("trid");
			$fgrade = $this->input->post("fgrade");
			$compgrade = $this->input->post("compgrade");
			$compref = $this->input->post("compref");
			$compdate = ($this->input->post("compdate") == "" ? NULL : $this->input->post("compdate"));
			$trainingid = $this->input->post("trainingid");
			$grades = $this->input->post("grades");
			$submodid = $this->input->post("submodid");
			$subtrainid = $this->input->post("subtrainid");
			
			$total_rec = $this->get_training_records($code)->num_rows();
			$total_submod = $this->get_submodule($code)->num_rows();
			
			#echo $total_rec; die();
			$updateArray = array();
			for($x = 0; $x < $total_rec; $x++)
			{
				$trainingrec[] = array(
					'trainingid'=>$trainingid[$x],
					'fgrade' => $fgrade[$x],
					'compgrade' => $compgrade[$x],
					'compdate' => $compdate[$x],
					'compref' => $compref[$x]
				);
				

				for($y = 0; $y < $total_submod; $y++)
				{
					#$print_r($grades);
					#echo "<br>";
					#echo $grades[$y][$x]." - ".$subtrainid[$y][$x]."<br>";
					$subtrainingrec[] = array(
						'subtrainid' => $subtrainid[$y][$x],
						'fgrade' => $grades[$y][$x],
					);
					
					$this->db->update_batch("subtraining",$subtrainingrec, "subtrainid");
				}  
			}      
	
			$this->db->update_batch('training',$trainingrec, 'trainingid');
			$this->insertlogs($code,"Updated grades of code: " . $code . " " . $this->db->last_query());
		}

		public function editcertificate($code)
		{
			$trainingid = $this->input->post("trainingid");
			$certnumber = $this->input->post("certnumber");
			$certdate = $this->input->post("certdate");
			
			$total_rec = $this->get_training_records($code)->num_rows();
			
			for($x = 0; $x < $total_rec; $x++)
			{
				$trainingrec[] = array(
					'trainingid' => $trainingid[$x],
					'certnumber' => $certnumber[$x],
					'certdate' => empty($certdate[$x]) ? NULL : $certdate[$x],
					'crok' => empty($certdate[$x]) ? "N" : "Y",
					'cruser' => $this->session->userdata("userid"),
				);
			}
			
			$this->db->update_batch('training',$trainingrec, 'trainingid');
			
			$this->insertlogs($code,"Updated certificate of code: " . $code);
			#print_r($this->db->last_query()); die();
			//Edit Last No. of Certificate on Module
			$sql = "Update module a inner join schedule b on a.modcode = b.modcode set a.lastno = ? where b.code = ?";
			
			$this->db->query($sql,array($certnumber[$x-1],$code));
		}
		
		function get_submodules_of_sched($code)
		{
			$this->db->select("b.submodid,");
			$this->db->from("schedule_complete a");
			$this->db->join("submodule b","a.modcode = b.modcode","left");
			$this->db->where("a.code",$code);
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function get_training($trainingid)
		{
			$this->db->where("trainingid",$trainingid);
			return $this->db->get("training");
		}
		
		function training_edit($trainingid)
		{
			$data = array(
				"licid" => $this->input->post("licid"),
				"rankid" => $this->input->post("rankid"),
				"employid" => $this->input->post("employer"),
				"sponid" => $this->input->post("sponid"),
				"fgrade" => $this->input->post("fgrade"),
				"compgrade" => $this->input->post("compgrade"),
				"compref" => $this->input->post("compref"),
				"compdate" => $this->input->post("compdate"),
				"certnumber" => $this->input->post("cert"),
				"lastupdate" => $this->session->userdata("userid"),
			);
			
			$this->db->where("trainingid",$this->input->post("trainingid"));
			$this->db->update("training",$data);
			
			$this->insertlogs(0,$this->db->last_query());
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