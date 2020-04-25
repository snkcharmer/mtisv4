<?php	
	class Schedule_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}	
		
		public function searchallschedule()
		{
			
			$this->db->get('schedule');
			$query = $this->db->order_by('code','desc');
			if ($query->num_rows() > 0)
			{
			   return $row->year;
			}
		}
		
		function search_total_schedule()
		{
			$year = $this->session->userdata('currentyear');
			$module = $this->session->userdata('search');
		
			$sql = "select a.*,b.*,group_concat(d.lname,' ',d.fname separator ', ') as trainergroup from schedule a inner join module b on a.modcode = b.modcode left join trainers_sched c on a.code = c.code left join trainer d on c.trainerid = d.trainerid where (b.module like ? or a.code like ?) and left(a.code,4) = ? group by a.code order by a.code asc";
			$query = $this->db->query($sql, array('%'.$module.'%','%'.$module.'%',$year));
			
			#print_r($this->db->last_query());
			return $query;
		}
		
		function searchschedule($count)
		{
			$schedule = $this->session->userdata('search');
			$year = $this->session->userdata('currentyear');
			
			$sql = "select a.*,b.module,coalesce(a.trainers,group_concat(d.lname,' ',left(d.fname,1),'.',left(d.mname,1),'.' separator ', ')) as trainergroup, e.venshort as venue
					from schedule a 
					inner join module b on a.modcode = b.modcode 
					left join trainers_sched c on a.code = c.code 
					left join trainer d on c.trainerid = d.trainerid
					left join venue e on a.venid = e.venid
					where (b.module like ? or a.code like ?) 
					and left(a.code,4) = ? 
					group by a.code 
					order by a.code asc limit ?,?";
			$query = $this->db->query($sql, array('%'.$schedule.'%','%'.$schedule.'%',$year,intval($this->uri->segment(3)), $count));
			#echo "<br>";
			#print_r($this->db->last_query());
			#print_r($this->db->last_query()); die();
			return $query;
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
			#$selyear = $this->session->userdata("currentyear").'0001';
			$selyear = $this->getselyear().'0001';
			$query = $this->db->get_where('schedule', array('code' => $selyear));
			if ($query->num_rows() > 0)
			{
			   return true;
			}
		}
		
		function getschedule($code)
		{
			$param = [$code];
			$sql = "select a.*,b.venue from schedule as a left join venue as b on a.venid = b.venid where a.code = ?";
			$query1 = $this->db->query($sql,$param);
			//print_r($query1);
			//$query = $this->db->get_where('schedule',array('code'=>$code));
			return $query1;
		}
		
		function get_schedule_complete($code)
		{
			
			#$query = $this->db->get_where('schedule_complete',array('code'=>$code));
			$sql = "select a.code,a.modcode,a.batch,a.start,a.end,a.ndays,a.hours,a.fee,a.room,e.venue,a.descriptn,a.max,
			a.size,a.section,a.trainerid,a.lastupdate,a.gradeok, a.certiok,a.remarks,a.verified,b.module, b.descriptn AS description, 
			coalesce(a.trainers,group_concat(d.lname,' ',d.fname separator ', ')) AS trainergroup 
			from schedule a 
			join module b on a.modcode = b.modcode 
			left join trainers_sched c on a.code = c.code 
			left join trainer d on c.trainerid = d.trainerid 
			left join venue e on a.venid = e.venid
			where a.code = ? 
			group by a.code desc";
			$query = $this->db->query($sql,array($code));
			
			return $query;
		}
		
		function getmultipleschedule($code)
		{
			if (!empty($code)){
				foreach($code as $key)
				{
					$lols[] = $key["code"];
				}
			}
			else
			{
				$lols = array("");
			}
			
			
			$this->db->join("module b","a.modcode = b.modcode","left");
			$this->db->where_in('a.code', $lols);
			$query = $this->db->get('schedule a');
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function getmaxcode($selyear)
		{
			$sql = "select max(code) as maxcode from schedule where left(code,4) = ?";
			$query = $this->db->query($sql,array($selyear));
			return $query;
		}
		
		public function addschedule()
		{
			$selyear = $this->getselyear();
			$substr_year = substr($this->input->post('end'),0,4);
			$rec = $this->getmaxcode($substr_year)->row_array();
			$maxcode = $rec["maxcode"] + 1;
			$module_id = $this->input->post('module_id');
			$batch = $this->input->post('batch');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$ndays = $this->input->post('ndays');
			$fee = $this->input->post('fee');
			$room = $this->input->post('room');
			$venue = $this->input->post('venue');
			$max = $this->input->post('max');
			
			if ($this->checkfirstrecord())
			{	
				$data = array(
					"code" => $maxcode,
					"modcode" => $module_id,
					"batch" => $batch,
					"start" => $start,
					"end" => $end, 
					"ndays" => $ndays,
					"fee" => $fee,
					"room" => $room,
					"venid" => $venue,
					"max" => $max,
				);
				
				$this->db->insert("schedule",$data);
			}
			else
			{
				$sql = "Insert into schedule(code,modcode,batch,start,end,ndays,fee,room,venid,max,section) select ?,modcode,?,?,?,?,?,?,?,?,section from module where modcode = ?";
				$query = $this->db->query($sql, array($selyear.'0001',$batch,$start,$end,$ndays,$fee,$room,$venue,$max,$module_id));
			}
		}
		
		public function addschedule2()
		{
			$selyear = $this->getselyear();
			#$selyear = $this->session->userdata("currentyear");
			$module_id = $this->input->post('module_id');
			$batch = $this->input->post('batch');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$ndays = $this->input->post('ndays');
			$fee = $this->input->post('fee');
			$room = $this->input->post('room');
			$venue = $this->input->post('venue');
			$max = $this->input->post('max');
			
			if ($this->checkfirstrecord())
			{
				$sql = "INSERT INTO schedule(code,modcode,batch,start,end,ndays,fee,room,venid,max,section) 
				select concat(?,LPAD(mid(max(a.code) + 1,5,8),4,'0')),b.modcode,?,?,?,?,?,?,?,b.max,b.section 
				from schedule a 
				left join module b on b.modcode = ? 
				where exists (select * from schedule where code = ?)";
				$query = $this->db->query($sql, array($selyear,$batch,$start,$end,$ndays,$fee,$room,$venue,$module_id,$selyear.'0001'));
				if (!$query){
					echo "waray sumulod"; die();
				}
				
				#$kuery = $this->db->query($sql);
			}
			else
			{
				$sql = "Insert into schedule(code,modcode,batch,start,end,ndays,fee,room,venid,max,section) select ?,modcode,?,?,?,?,?,?,?,?,section from module where modcode = ?";
				$query = $this->db->query($sql, array($selyear.'0001',$batch,$start,$end,$ndays,$fee,$room,$venue,$max,$module_id));
			}
		}
		
		function editschedule()
		{
			$data = array(
			"batch" => $this->input->post("batch"),
			"start" => $this->input->post("start"),
			"end" => $this->input->post("end"),
			"ndays" => $this->input->post("ndays"),
			"room" => $this->input->post("room"),
			"fee" => $this->input->post("fee"),
			"venid" => $this->input->post("venue"),
			"max" => $this->input->post("max")
			);
			
			$this->db->where("code",$this->session->userdata("code"));
			$this->db->update("schedule",$data);
		}
		
		function assign_trainer($code = NULL)
		{
			$submod = ($this->input->post('submod') != NULL ? $this->input->post('submod') : NULL);
			
			$data = array(
			"trainerid" => $this->input->post("trainer"),
			"code" => $code,
			"submodid" => $submod,
			);
			
			$this->db->insert("trainers_sched",$data);
		}
		
		function trainer_count($code)
		{
			$sql = "select count(trschedid) as tr from trainers_sched where code = ?";
			$query = $this->db->query($sql,array($code));
			return $query;
			#print_r($query->row());print_r($this->db->last_query()); die();
		}
		
		function get_schedule_trainer($code = NULL)
		{
			$this->db->from("trainers_sched a");
			$this->db->join("trainer b","a.trainerid = b.trainerid","inner");
			$this->db->where("a.code",$code);
			$query = $this->db->get();
			return $query;
		}
		
		function delete_trainer($code = NULL)
		{
			$trainerid = $this->input->post("trainer");
			$this->db->delete("trainers_sched",array("trainerid" => $trainerid, "code" => $code));
		}
		
		function verify_grade($code = 0)
		{
			$data = array(
				"gradeok" => "Y"
			);
			$this->db->where("code",$code);
			$this->db->update("schedule",$data);
		}
		
		function check_grade($code = 0)
		{
			$data = array(
				"gradeok" => "C"
			);
			$this->db->where("code",$code);
			$this->db->update("schedule",$data);
		}
		
		function checkifverified($code = 0){
			$sql = "select gradeok,certiok from schedule where code = ?";
			$query = $this->db->query($sql,array($code));
			return $query;
		}
		
		function uncheck_grade($code = 0)
		{
			$x = $this->checkifverified($code)->row_array();
			if ($this->session->userdata("user_level") == 1 or $x["gradeok"] == "C") 
			{
				$sql = "update schedule set gradeok = 'N' where code = ?";
				$query = $this->db->query($sql,array($code));
				return TRUE;
			} else {
				return FALSE;
			}
		}
		
		function confirm_certificate($code = 0)
		{
			$data = array(
				"certiok" => "Y"
			);
			$this->db->where("code",$code);
			$this->db->update("schedule",$data);
		}
		
		function unconfirm_certificate($code = 0)
		{
			$data = array(
				"certiok" => "N"
			);
			$this->db->where("code",$code);
			$this->db->update("schedule",$data);
		}
	}
?>
