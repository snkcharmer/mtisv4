<?php	
	class Statistics_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();	
		}	
		
		public function total_trainees() #total no. of trainee
		{
			$sql = "Select count(a.trid) as mynum from trainee a inner join training b on a.trid = b.trid";
			$query = $this->db->query($sql);
			
			return $query;
		}
		
		public function get_total_trainees_unique() #total no. of trainee
		{
			$sql = "select count(trid) as mynum from trainee where left(trid,4) = ?";
			$query = $this->db->query($sql,array($this->session->userdata("currentyear")));
			
			return $query;
		}
		
		public function get_total_trainees()
		{
			$sql = "select count(trainingid) as mynum from training where left(code,4) = ?";
			$query = $this->db->query($sql,array($this->session->userdata("currentyear")));
			
			return $query;
		}
		
		public function get_total_trainees_month_unique()
		{
			$sql = "select count(trid) as mynum from trainee where left(trid,4) = ? and month(entrydate) = ?";
			$query = $this->db->query($sql,array($this->session->userdata("currentyear"),date("m")));
			
			return $query;
		}
		
		public function get_male()
		{
			$sql = "Select count(trid) as mynum from trainee where sex = 'M'";
			$query = $this->db->query($sql);
			
			return $query;
		}
		
		public function get_female()
		{
			$sql = "Select count(trid) as mynum from trainee where sex = 'F'";
			$query = $this->db->query($sql);
			
			return $query;
		}
		
		public function get_most_taken_module()
		{
			$sql = "Select b.module,count(trainingid) as mynum from training a inner join schedule_complete b on a.code = b.code group by b.module order by mynum desc limit 5";
			$query = $this->db->query($sql);
			
			return $query;
		}
		
		public function get_by_location()
		{
			$modcode = $this->input->post("modcode");
			$region = $this->input->post("region");
			$province = $this->input->post("province");
			$town = $this->input->post("town");
			$from = $this->input->post("from");
			$to = $this->input->post("to");
			
			if ($modcode != "#")
				{ $this->db->where("c.modcode",$modcode);}
			if ($region != "#" and $region != "")
				{ $this->db->where("d.region",$region);}
			if ($province != "#" and $province != "")
				{ $this->db->where("d.province",$province);}
			if ($town != "")
				{ $this->db->where("d.municipal",$town); }
			if ($from != "")
				{ $this->db->where("c.end >=",$from); }
			if ($to != "")
				{ $this->db->where("c.end <=",$to); }
			
			$this->db->select("count(distinct(a.trid)) as lols,concat('".$from."') as from2,concat('".$to."') as to2",true);
			$this->db->from("training a");
			$this->db->join("trainee b","a.trid = b.trid","inner");
			$this->db->join("schedule c","c.code = a.code","inner");
			$this->db->join("zip d","b.zip = d.code","left");
			$query = $this->db->get();
			
			#print_r($this->db->last_query());
			return $query;
		}
		
		public function get_by_location_group_by_region()
		{
			$modcode = $this->input->post("modcode");
			$region = $this->input->post("region");
			$province = $this->input->post("province");
			$town = $this->input->post("town");
			$from = $this->input->post("from");
			$to = $this->input->post("to");
			
			if ($modcode != "#")
				{ $this->db->where("c.modcode",$modcode);}
			if ($region != "#" and $region != "")
				{ $this->db->where("d.region",$region);}
			if ($province != "#" and $province != "")
				{ $this->db->where("d.province",$province);}
			if ($town != "" and $town != "#")
				{ $this->db->where("d.municipal",$town); }
			if ($from != "")
				{ $this->db->where("c.end >=",$from); }
			if ($to != "")
				{ $this->db->where("c.end <=",$to); }
			
			$this->db->select("count(distinct(a.trid)) as lols, d.region",true);
			$this->db->from("training a");
			$this->db->join("trainee b","a.trid = b.trid","inner");
			$this->db->join("schedule c","c.code = a.code","inner");
			$this->db->join("zip d","b.zip = d.code","left");
			$this->db->group_by("d.region");
			$query = $this->db->get();
			
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		
	}

	
?>