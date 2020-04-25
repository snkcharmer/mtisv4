<?php	
	class Admin_model extends CI_Model
	{
		var $data = array();
		function __construct()
		{
			parent::__construct();	
		}	
		
		function alreadyhadrd($id){


			$data = ['redcross' => 0];
			$this->db->where('idnum',$id);
			$this->db->update('trainee_',$data);

		}	

		function start_($id){

			if($this->session->userdata('userid') == '6'){
				$win = 2;
			}else if($this->session->userdata('userid') == '36'){
				$win = 3;
			}else if($this->session->userdata('userid') == '14'){
				$win = 4;
			}else{
				$win = 1;
			}

			$data = ['window' => $win];
			$this->db->where('idnum',$id);
			$this->db->update('trainee_',$data);

		}

		function stop_($id){


			$data = ['window' => ""];
			$this->db->where('idnum',$id);
			$this->db->update('trainee_',$data);

		}
		
		function checklogin()
		{		
			$username = $this->input->post("username");
			$password = $this->input->post("password");

			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			
			$query = $this->db->get('login');
			
			return $query;
		}
		
		function search_total_trainee()
		{
			$lname = $this->session->userdata('lname');
			$fname = $this->session->userdata('fname');
		
			$sql = "select trid from trainee where lname like ? and fname like ?";
			$query = $this->db->query($sql, array('%'.$lname.'%','%'.$fname.'%'));
			
			return $query;
		}
		
		function searchtrainee($count)
		{
			$lname = $this->session->userdata('lname');
			$fname = $this->session->userdata('fname');
			
			$sql = "select trid,lname,fname,mname,suffix from trainee where lname like ? and fname like ? order by lname,fname limit ?,?";
			$query = $this->db->query($sql, array('%'.$lname.'%','%'.$fname.'%', intval($this->uri->segment(3)), $count));
			
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function last_enrolled()
		{
			$sql = "select count(a.trid),a.trid,lname,fname,mname,suffix
			from training a
			inner join trainee b on a.trid = b.trid
			group by a.trid
			order by trainingid desc
			limit 20";
			$query = $this->db->query($sql);
			return $query;
		}
		
		function searchtrid($trid)
		{
			
			$this->db->select('a.*,b.civstatid, c.religion, d.course, e.licid as liccode, e.license as licname, f.rankid as rankcode, f.rank as rankname, g.regid, i.region, h.citid, h.citizen, i.municipal,i.code as pcode,i.idnum as locid_');
			$this->db->from("trainee a");
			$this->db->join("civstat b","a.civstatid =  b.civstatid","left");
			$this->db->join("religion c","a.relid = c.relid","left");
			$this->db->join("course d","a.courseid = d.courseid","left");
			$this->db->join("license e","a.licid = e.licid","left");
			$this->db->join("rank f","a.rankid = f.rankid", "left");
			$this->db->join("region g","a.regid = g.regid", "left");
			$this->db->join("citizen h","a.citid = h.citid", "left");
			$this->db->join("zip i","a.locid = i.idnum", "left");
			$this->db->where("a.trid",$trid); 
			$query = $this->db->get();
			//print_r($this->db->last_query()); die();
			return $query;
		}
		
		function getfee($mode = 0)
		{
			$paycatid = $this->session->userdata("paycatid");
			if (!empty($paycatid))
			{
				$this->db->where("paycatid",$paycatid);
			}
			
			if (!empty($mode))
			{
				$this->db->where("isActive",1);
			}
			
			$this->db->where("isTraining",0);
			$query = $this->db->get('cash_payment_type');
			return $query;
		}
		
		function getfee_training()
		{
			$paycatid = $this->session->userdata("paycatid");
			if (!empty($paycatid))
			{
				$this->db->where("paycatid",$paycatid);
			}
			$this->db->select('b.module,a.typename,a.paytypeid,a.amount');
			$this->db->from('cash_payment_type a');
			$this->db->join('module b','a.typename = b.modcode','inner');
			$this->db->where("isActive",1);
			$this->db->where("isTraining",1);
			$this->db->order_by("b.module");
			$query = $this->db->get();
			return $query;
		}
		
		function getfee_not_on_paycatid()
		{
			$paycatid = $this->session->userdata("paycatid");
			if (!empty($paycatid))
			{
				$this->db->where("paycatid <>",$paycatid);
			}
			
			if (!empty($mode))
			{
				$this->db->where("isActive",1);
			}
			
			$this->db->where("isTraining",0);
			$query = $this->db->get('cash_payment_type');
			return $query;
		}
		
		function getdiscount()
		{
			//$this->db->where("amount <> 0");
			$this->db->where("paycatid",3);
			return $this->db->get('cash_payment_type');
		}
		
		function getrank()
		{
			$this->db->order_by("rank", "asc"); 
			$ranks = $this->db->get('rank');
			return $ranks;
		}
		
		function getcivstat()
		{
			$this->db->order_by("civstatid", "asc"); 
			$civstat = $this->db->get('civstat');
			return $civstat;
		}
		
		function getreligion()
		{
			$this->db->order_by("relid", "asc"); 
			$religion = $this->db->get('religion');
			return $religion;
		}
		
		function getlicense()
		{
			$this->db->order_by("license", "asc");
			$licenses = $this->db->get('license');
			return $licenses;
		}
		
		function getposition()
		{
			$this->db->order_by("position", "asc");
			$position = $this->db->get('position');
			return $position;
		}
		
		function getcitizenship()
		{
			$this->db->order_by("citid", "desc");
			$citizenship = $this->db->get('citizen');
			return $citizenship;
		}
		
		function getemployer()
		{
			$this->db->order_by("name", "asc");
			$employer = $this->db->get('employer');
			return $employer;
		}
		
		function getrainers()
		{
			$this->db->order_by("lname,fname", "asc");
			$trainers = $this->db->get('trainer');
			return $trainers;
		}
		
		function getcourse()
		{
			$this->db->order_by("course", "asc");
			$courses = $this->db->get('course');
			return $courses;	
		}
		
		function getschool()
		{
			$this->db->order_by("school", "asc");
			$schools = $this->db->get('school');
			return $schools;	
		}
		
		function getsubmodule($modcode = NULL)
		{
			$this->db->where("modcode",$modcode);
			return $this->db->get("submodule");
		}
		
		function getmodule()
		{
			$sql = "select module,modcode from module where active = 'Y' order by module desc";
			$query = $this->db->query($sql);
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$module[$mod->modcode] = $mod->module;
				}
				return $module;
			} 
			else 
			{
				return FALSE;
			}
		}
		
		function getvenue1()
		{
			$sql = "select * from venue order by venue";
			$query = $this->db->query($sql);
			
			if($query->result()){
				foreach ($query->result() as $ven) {
					$venue[$ven->venid] = $ven->venue;
				}
				return $venue;
			} 
			else 
			{
				return FALSE;
			}
		}
		
		function getmodule2()
		{
			$paycatid = $this->session->userdata("paycatid");
			if (empty($paycatid))
			{
				$sql = "select module,modcode from module where active = 'Y' order by module desc";
				$query = $this->db->query($sql);
			}
			else
			{
				$sql = "select a.module,a.modcode from module a
				inner join cash_payment_type b on a.modcode = b.typename
				where a.active = 'Y' and b.paycatid = ?
				order by a.module desc";
				$query = $this->db->query($sql,array($paycatid));
			}
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$module[$mod->modcode] = $mod->module;
				}
				return $module;
			} 
			else 
			{
				return FALSE;
			}
		}
		
		function get_selected_module($modcode = NULL)
		{
			return $this->db->get_where("module",array("modcode" => $modcode));
		}
		
		function get_all_modules()
		{
			$this->db->order_by("module asc");
			return $this->db->get("module");
		}
		
		function get_selected_submodule($submodid = NULL)
		{
			$this->db->select("*");
			$this->db->from("submodule a");
			$this->db->join("module b","a.modcode = b.modcode","inner");
			$this->db->where("a.submodid", $submodid);
			$query = $this->db->get();
			return $query;
		}
		
		function get_all_submodules()
		{
			return $this->db->get("submodule");
		}
		
		function getmod($module = NULL)
		{
			$this->db->select("b.modcode,a.end");
			$this->db->from("schedule a");
			$this->db->join("module b","a.modcode = b.modcode","inner");
			$this->db->where("a.code",$module);
			$query = $this->db->get();

			return $query;
		}
		
		//------------------------Create Table (License, Ranks, Course, Trainer)---------------
		function total_table_result($table,$where = 0,$wheredt = 0)
		{
			if (!empty($where)) { $this->db->like($where,$wheredt); }
			return $this->db->get($table);
		}
		
		function searchtable($count,$table,$colname,$where = 0,$wheredt = 0)
		{	
			$this->db->select('*');
			$this->db->order_by($colname,'asc');
			if (!empty($where)) { $this->db->like($where,$wheredt); }
			$query = $this->db->get($table, $count,intval($this->uri->segment(3)));
			return $query;
		}
		
		function search_if_pk_is_used($table, $fromtable, $field, $code)
		{
			$sql = "select * from $fromtable a
					inner join $table b on a.$field = b.$field
					where b.$field = ? limit 2";
			$query = $this->db->query($sql,array($code));
			#print_r($this->db->last_query()); print_r($query->row_array());die();
			return $query;
		}
		
		function delete_table($code,$table,$colname)
		{
			$this->db->delete($table, array($colname => $code)); 
		}
		
		function save_license()
		{
			$data = array(
				'license' => strtoupper($this->input->post('license')),
				'licname' => strtoupper($this->input->post('licname'))
				);
			$this->db->insert('license', $data);
			//$this->db->delete($table, array($colname => $table)); 
		}
		
		function save_rank()
		{
			$data = array(
				'rank' => strtoupper($this->input->post('rank')),
				'rankshort' => strtoupper($this->input->post('rankshort')),
				'ranktype' => strtoupper($this->input->post('ranktype'))
				);
			$this->db->insert('rank', $data);
			//$this->db->delete($table, array($colname => $table)); 
		}
		
		function save_position()
		{
			$data = array(
				'position' => strtoupper($this->input->post('position')),
				'posshort' => strtoupper($this->input->post('posshort')),
				);
			$this->db->insert('position', $data);
			//$this->db->delete($table, array($colname => $table)); 
		}
		
		function save_sponsor()
		{
			$data = array(
				'sptypename' => strtoupper($this->input->post('sponsor')),
				'sptypeshort' => strtoupper($this->input->post('sponshort')),
				);
			$this->db->insert('sponsor_type', $data);
			//$this->db->delete($table, array($colname => $table)); 
		}
		
		function edit_sponsor()
		{
			$data = array(
				'sptypename' => strtoupper($this->input->post('sponsor')),
				'sptypeshort' => strtoupper($this->input->post('sponshort')),
				);
			$this->db->where("sponid",$this->input->post("sponid"));
			$this->db->update('sponsor_type', $data);
		}
		
		function save_course()
		{
			$data = array(
				'course' => strtoupper($this->input->post('course')),
				);
				
			$this->db->insert('course', $data);
		}
		
		function save_school()
		{
			$data = array(
				'school' => strtoupper($this->input->post('school')),
				'address' => strtoupper($this->input->post('address')),
				);
				
			$this->db->insert('school', $data);
		}
		
		function save_trainer()
		{
			$data = array(
				'lname' => strtoupper($this->input->post('lname')),
				'fname' => strtoupper($this->input->post('fname')),
				'mname' => strtoupper($this->input->post('mname')),
				'suffix' => strtoupper($this->input->post('suffix')),
				'bday' => strtoupper($this->input->post('bday')),
				'sex' => strtoupper($this->input->post('sex')),
				'address' => strtoupper($this->input->post('address')),
				'zipcode' => strtoupper($this->input->post('zipcode')),
				'active' => strtoupper($this->input->post('active')),
				);
				
			$this->db->insert('trainer', $data);
		}
		
		function save_employer()
		{
			$data = array(
				'name' => strtoupper($this->input->post('employer')),
				'address1' => strtoupper($this->input->post('address1')),
				'address2' => strtoupper($this->input->post('address2')),
				'contactnm' => strtoupper($this->input->post('contactname')),
				'contactti' => strtoupper($this->input->post('contactnum')),
				);
				
			$this->db->insert('employer', $data);
		}
		
		//------------------------Onchange Eventdropdown----------------------
		
		function getmoduledetails($module = null)
		{
			$this->db->select('fee, modcode, max, ndays');
			if($module != NULL){
				$this->db->where('modcode', $module);
			}
			
			$query = $this->db->get('module');
			if($query->result())
			{
				foreach ($query->result() as $mod) 
				{
					$data['mod'] = array('fee' => $mod->fee, 
						'max' => $mod->max,
						'ndays' => $mod->ndays);
				}		
				return $data;
			}
			else
			{
				return FALSE;
			}
		}
		
		function getaddress($module = null){
			$this->db->select('*');
			if($module != NULL){
				$this->db->where('code', $module);
			}
			$this->db->order_by("municipal");
			$query = $this->db->get('zip');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data['code'] = array(
						'idnum' => $mod->idnum,
						'municipal' => $mod->municipal, 
						'city' => $mod->city,
						'province' => $mod->province,
						'region' => $mod->region);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		function getprovince($region = null){
			$this->db->select('distinct(province) as prov');
			if($region != NULL){
				$this->db->where('region', $region);
			}
			
			$query = $this->db->get('zip');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data[] = array(
						'province' => $mod->prov
						);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		function gettown($region = null){
			$this->db->select('*');
			if($region != NULL){
				$this->db->where('region', $region);
			}
			$this->db->order_by("municipal");
			$query = $this->db->get('zip');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data[] = array(
						'idnum' => $mod->idnum,
						'code' => $mod->code,
						'municipal' => $mod->municipal, 
						'region' => $mod->region);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		function gettown2($province = null){ //----Para ha advanced Search
			$this->db->select("*");
			if($province != NULL){
				$this->db->where('province', urldecode($province));
			}
			
			$query = $this->db->get('zip');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data[] = array(
						'idnum' => $mod->idnum,
						'code' => $mod->code,
						'municipal' => $mod->municipal, 
						'region' => $mod->region
						);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		function getcoursejson($code = null){
			$this->db->order_by("course","asc");
			$query = $this->db->get('course');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data[] = array(
						'idnum' => $mod->courseid,
						'course' => $mod->course,
						);
				}
				return $data;
			} else {
				return FALSE;
			}
		}
		
		function getschooljson($code = null){
			$this->db->order_by("school","asc");
			$query = $this->db->get('school');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data[] = array(
						'idnum' => $mod->schoolid,
						'school' => $mod->school . " - " . $mod->address,
						);
				}
				return $data;
			} else {
				return FALSE;
			}
		}
		
		function getzip($code = null){
			$this->db->select('*');
			if($code != NULL){
				$this->db->where('idnum', $code);
			}
			
			$query = $this->db->get('zip');
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					$data['code'] = array(
						'idnum' => $mod->idnum,
						'code' => $mod->code,
						'municipal' => $mod->municipal, 
						'region' => $mod->region);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		function getidnum($idnum)
		{
			$this->db->select('idnum,municipal');
			$this->db->where('idnum',$idnum);
			$query = $this->db->get('zip');
			return $query;
		}
		
		
		public function getschedule($module){

			$sql = "Select a.code,a.batch,a.start,a.end from schedule a 
			inner join module b on a.modcode = b.modcode 
			where b.modcode = ? 
			order by a.code desc 
			limit 5";

			$query = $this->db->query($sql,array($module));
			
			if($query->result())
			{
				foreach ($query->result() as $mod) 
				{
					$data[$mod->code] = array('batch' => $mod->batch, 
						'code' => $mod->code,
						'start' => $mod->start,
						'end' => $mod->end
						);
				}
				
				return $data;
			}
			else
			{
				return $module;
			}

		}
		
		public function getavailableschedule($module,$selyear)
		{
			$backtrack = $this->session->userdata("backtrack");
			
			if ($backtrack == TRUE)
			{
				$sql = "Select a.code,b.module,a.batch,a.start,a.end,a.size,a.max,d.venshort as venue,c.paycatid 
				from schedule a 
				inner join module b on a.modcode = b.modcode 
				inner join cash_payment_type c on a.modcode = c.typename
				inner join venue d on a.venid = d.venid
				where b.modcode = ? and year(start) = ? and a.size < a.max 
				order by a.code";
				$query = $this->db->query($sql,array($module,$selyear));
			}	
			elseif ($backtrack == False)
			{
				$sql = "Select a.code,b.module,a.batch,a.start,a.end,a.size,a.max,d.venshort as venue,c.paycatid 
				from schedule a 
				inner join module b on a.modcode = b.modcode 
				inner join cash_payment_type c on a.modcode = c.typename
				inner join venue d on a.venid = d.venid
				where b.modcode = ? and start >= date(now()) and a.size < a.max 
				order by a.code";
				$query = $this->db->query($sql,array($module));
			}
			
			if($query->result())
			{
				foreach ($query->result() as $mod) 
				{
					$data[$mod->code] = array(
						'code' => $mod->code,
						'module' => $mod->module,
						'batch' => $mod->batch,
						'start' => $mod->start,
						'end' => $mod->end,
						'size' => $mod->size,
						'max' => $mod->max,
						'venue' => $mod->venue,
						'paycatid' => $mod->paycatid
						);
				}
				
				return $data;
			}
			else
			{
				return $module;
			}

		}
		
		function getcertificateseries($module)
		{
			$this->db->select("b.modcode,b.lastno");
			$this->db->from("schedule a");
			$this->db->join("module b","a.modcode = b.modcode","left");
			$this->db->where("a.code",$module);
			$query = $this->db->get();
			
			if($query->result()){
				foreach ($query->result() as $mod) {
					
					$data['code'] = array(
						'modcode' => $mod->modcode,
						'lastno' => $mod->lastno,
						);
				}
				return $data;
			}else{
				return FALSE;
			}
		}
		
		
		function getalladdress($string)
		{
			$string = urldecode($string);
			$sql = "select * from zip where code like ? or municipal like ? or city like ? or province like ? or region like ?";
			$query = $this->db->query($sql,array('%'.$string.'%','%'.$string.'%','%'.$string.'%','%'.$string.'%','%'.$string.'%'));
			#$query = $this->db->last_query();
			if($query->result()){
				foreach ($query->result() as $mod) {
					
					$data[$mod->idnum] = array(
						'code' => $mod->code,
						'municipal' => $mod->municipal,
						'city' => $mod->city,
						'province' => $mod->province,
						'region' => $mod->region,
						);
				}
				return $data;
			}else{
				return $this->db->last_query();
			}
		}
		//-------------------------End Onchange Function-------------------------
		
		/********** Modules ********************/
		
		function checkfirstrecord_module($year)
		{
			$selyear = $year.'0001';
			$query = $this->db->get_where('module', array('modcode' => $selyear));
			if ($query->num_rows() > 0)
			{
			   return true;
			}
		}
		
		function addmodule($year)
		{
			$module = $this->input->post("descriptn");
			$modsht = $this->input->post("modsht");
			$ndays = $this->input->post("ndays");
			$hours = $this->input->post("hours");
			$fee = $this->input->post("fee");
			$venue = $this->input->post("venue");
			$section = $this->input->post("section");
			$max = $this->input->post("max");
			$certnum = $this->input->post("certnum");
			$active = $this->input->post("active");
			$compendium = $this->input->post("compendium");
			$assessment = $this->input->post("assessment");
			
			if ($this->checkfirstrecord_module($year))
			{
				$sql = "INSERT INTO module (modcode,module,ndays,hours,fee,venue,descriptn,section,max,lastno,active,modsht,compendium,assessmentfee) select concat(?,LPAD(mid(max(modcode) + 1,5,8),4,'0')),?,?,?,?,?,?,?,?,?,?,?,?,? from module where exists (select * from module where modcode = ?)";
				$query = $this->db->query($sql, array($year,$modsht,$ndays,$hours,$fee,$venue,$module,$section,$max,$certnum,$active,$modsht,$compendium,$assessment,$year.'0001'));
			}
			else
			{
				$sql = "Insert into module (modcode,module,ndays,hours,fee,venue,descriptn,section,max,lastno,active,modsht,compendium,assessmentfee) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$query = $this->db->query($sql, array($year.'0001',$modsht,$ndays,$hours,$fee,$venue,$module,$section,$max,$certnum,$active,$modsht,$compendium,$assessment));
			}
		}
		
		function editmodule()
		{
			$data = array (
				"descriptn" => $this->input->post("descriptn"),
				"modsht" => $this->input->post("modsht"),
				"ndays" => $this->input->post("ndays"),
				"hours" => $this->input->post("hours"),
				"fee" => $this->input->post("fee"),
				"venue" => $this->input->post("venue"),
				"section" => $this->input->post("section"),
				"max" => $this->input->post("max"),
				"active" => $this->input->post("active"),
				"compendium" => $this->input->post("compendium"),
				#"assessmentfee" => $this->input->post("assessment"),
				"lastno" => $this->input->post("certnum")
			);
			
			$this->db->where("modcode",$this->session->userdata("modcode"));
			$this->db->update("module",$data);
		}
		
		function search_total_module()
		{
			$modcode = $this->session->userdata('modcode');
		
			$sql = "select modcode from module where modcode like ? or module like ?";
			$query = $this->db->query($sql, array('%'.$modcode.'%','%'.$modcode.'%'));
			return $query;
		}
		
		function searchmodule($count)
		{
			$modcode = $this->session->userdata('modcode');
			
			$sql = "select * from module where modcode like ? or module like ? order by module limit ?,?";
			$query = $this->db->query($sql, array('%'.$modcode.'%','%'.$modcode.'%', intval($this->uri->segment(3)), $count));
			
			return $query;
		}
		
		/********** End of Modules ********************/
		
		/********** Submodules ********************/
		
		function addsubmodule()
		{
			$data = array(
			"modcode" => $this->input->post("modcode"),
			"submodule" => $this->input->post("submodule"),
			"description" => $this->input->post("description"),
			);
			
			$this->db->insert("submodule",$data);
		}
		
		function editsubmodule()
		{
			$data = array (
				"modcode" => $this->input->post("modcode"),
				"submodule" => $this->input->post("submodule"),
				"description" => $this->input->post("description"),
			);
			
			$this->db->where("submodid",$this->session->userdata("submodid"));
			$this->db->update("submodule",$data);
		}
		
		function search_total_submodule()
		{
			$submodid = $this->session->userdata('submodid');
		
			$sql = "select submodid from submodule a inner join module b on a.modcode = b.modcode where submodid like ? or submodule like ?";
			$query = $this->db->query($sql, array('%'.$submodid.'%','%'.$submodid.'%'));
			return $query;
		}
		
		function searchsubmodule($count)
		{
			$submodid = $this->session->userdata('submodid');
			
			$sql = "select * from submodule a inner join module b on a.modcode = b.modcode where submodid like ? or submodule like ? order by module,submodule limit ?,?";
			$query = $this->db->query($sql, array('%'.$submodid.'%','%'.$submodid.'%', intval($this->uri->segment(3)), $count));
			
			return $query;
		}
		
		/********** End of Submodules ********************/
		
		function get_employee()
		{
			$this->db->order_by("lname, fname", "asc");
			$query = $this->db->get('hrm_employee');
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function add_user()
		{
			$password = $this->input->post("password");
			$lols = $this->get_specific_employee_details($this->input->post("empid"))->row_array();
			$data = array(
					   'username' => $this->input->post("username"),
					   'password' => md5($password),
					   'priv' => $this->input->post("acctype"),
					   'fullname' => $lols['fname'].' '.substr($lols['mname'],0,1).'. '.$lols['lname'],
					   'active' => 'Y',
					   'venid' => $this->input->post("venue"),
					   );
			$this->db->set('Time', 'NOW()', FALSE);
			$query = $this->db->insert("login",$data);
			return $query;
		}
		
		function get_specific_employee_details($empid)
		{
			$query = $this->db->get_where('hrm_employee',array('empid' =>$empid));
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function changesystemyear($year = NULL)
		{
			$year = $this->input->post("year");
			
			$data = array(
				"year" => $year
			);
			
			$this->db->update("settings",$data);
		}
		
		function getregion()
		{
			$sql = "select region as lols from zip group by region";
			$query = $this->db->query($sql);
			#print_r($this->db->last_query());
			return $query;
		}
		
		function getsponsor($sponid = 0)
		{
			$query = ($sponid != 0 ? $this->db->get_where("sponsor_type",array($sponid)) : $this->db->get("sponsor_type"));
			//$query = $this->db->get_where("sponsor_type",array("sponid" => $sponid));
			return $query;
		}
		
		function getprice($paytypeid = 0)
		{
			$this->db->select("amount");
			$this->db->where("paytypeid",$paytypeid);
			$query = $this->db->get("cash_payment_type");
			return $query;
		}
		
		function getvenue($venid = 0)
		{
			$query = ($venid != 0 ? $this->db->get_where("venid",array($venid)) : $this->db->get("venue"));
			//$query = $this->db->get_where("sponsor_type",array("sponid" => $sponid));
			return $query;
		}
		
		function getvessel($vesid = 0)
		{
			if (!empty($vesid)) { $this->db->where("vesid",$vesid); }
			$query = $this->db->get("vessel");
			
			return $query;
		}
		
		function getvesselsize($vessizeid = 0)
		{
			if (!empty($vessizeid)) { $this->db->where("vessizeid",$vessizeid); }
			$query = $this->db->get("vessel_size");
			return $query;
		}
		
		function getvesselflag($vesflagid = 0)
		{
			if (!empty($vesflagid)) { $this->db->where("vesflagid",$vesflagid); }
			$query = $this->db->get("flag");
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