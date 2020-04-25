<?php
	class Employment_model extends CI_Model
	{
		function get_employment_profile($trainingid = 0)
		{
			$this->db->where("trainingid",$trainingid);
			$query = $this->db->get("employment_profile");
			return $query;
		}
		
		function add_employment_profile($empid = 0)
		{
			// var_dump($this->input->post("offdeck")); 
			$ismixed = $this->input->post("ismixed");
			$offdeck = $this->input->post("offdeck");
			$offengine = $this->input->post("offengine");
			$ratdeck = $this->input->post("ratdeck");
			$ratengine = $this->input->post("ratengine");
			
			$data = array(
				"empid" => $empid,
				"isemp" => $this->input->post("isemp"),
				"typeemp" => $this->input->post("typeemp"),
				"occu_lb" => $this->input->post("occupation"),
				"yearsemp_lb" => $this->input->post("noyearsemplb"),
				"yearsemp_sb" => $this->input->post("noyearsempsea"),
				"trading_route" => $this->input->post("traderoute"),
				"vesid" => $this->input->post("vesseltype"),
				"vessize" => $this->input->post("vesselsize"),
				"flagofregistry" => $this->input->post("flagreg"),
				"nationofvessel" => $this->input->post("natvesprin"),
				"crewonboard" => $this->input->post("nocrewonves"),
				"nationofcrew" => $this->input->post("nationcrew"),
				"ifmixed" => (empty($ismixed) ? "" : implode(",",$ismixed)),
				"nofornat" => $this->input->post("nofornat"),
				"offdeck" => (empty($offdeck) ? "" : implode(",",$offdeck)),
				"offengine" => (empty($offengine) ? "" : implode(",",$offengine)),
				"ratdeck" => (empty($ratdeck) ? "" : implode(",",$ratdeck)),
				"ratengine" => (empty($ratengine) ? "" : implode(",",$ratengine)),
				"dateadded" => date('Y-m-d H:i:s'),
				"datetaken" => $this->input->post("datetaken"),
				"userid" => $this->session->userdata("userid"),
			);
			
			// var_dump($data);
			$this->db->insert("employment_profile",$data);
		}
		
		function update_employment_profile()
		{
			$ismixed = $this->input->post("ismixed");
			$offdeck = $this->input->post("offdeck");
			$offengine = $this->input->post("offengine");
			$ratdeck = $this->input->post("ratdeck");
			$ratengine = $this->input->post("ratengine");
			$emprofid = $this->input->post("emprofid");
			
			$data = array(
				"isemp" => $this->input->post("isemp"),
				"typeemp" => $this->input->post("typeemp"),
				"occu_lb" => $this->input->post("occupation"),
				"yearsemp_lb" => $this->input->post("noyearsemplb"),
				"yearsemp_sb" => $this->input->post("noyearsempsea"),
				"trading_route" => $this->input->post("traderoute"),
				"vesid" => $this->input->post("vesseltype"),
				"vessize" => $this->input->post("vesselsize"),
				"flagofregistry" => $this->input->post("flagreg"),
				"nationofvessel" => $this->input->post("natvesprin"),
				"crewonboard" => $this->input->post("nocrewonves"),
				"nationofcrew" => $this->input->post("nationcrew"),
				"ifmixed" => (empty($ismixed) ? "" : implode(",",$ismixed)),
				"nofornat" => $this->input->post("nofornat"),
				"offdeck" => (empty($offdeck) ? "" : implode(",",$offdeck)),
				"offengine" => (empty($offengine) ? "" : implode(",",$offengine)),
				"ratdeck" => (empty($ratdeck) ? "" : implode(",",$ratdeck)),
				"ratengine" => (empty($ratengine) ? "" : implode(",",$ratengine)),
				"datetaken" => $this->input->post("datetaken"),
				"userid" => $this->session->userdata("userid"),
			);
			$this->db->where("emprofid",$emprofid);
			$this->db->update("employment_profile",$data);
		}
		
		function connect_employment_profile($trainingid = 0,$emprofid = 0)
		{
				$data = array(
					"emprofid" => $emprofid,
				);
				
				$this->db->where_in("trainingid",$trainingid);
				$this->db->update("training",$data);
			
				return $this->db->affected_rows();
		}
		
		function delete_employment_profile($emprofid = 0)
		{
			$sql = "delete from employment_profile ";
			$this->db->delete("emprofid",$emprofid);
			$query = $this->db->get("employment_profile");
			return $query;
		}
		
		function get_employment_profile_all($empid = 0,$emprofid = 0)
		{
			$this->db->select("a.*,group_concat(b.code) as grpcode",false);
			if (!empty($emprofid)) { $this->db->where("a.emprofid",$emprofid); }
			$this->db->where("empid",$empid);
			$this->db->from("employment_profile a");
			$this->db->join("training b","a.emprofid = b.emprofid","left");
			$this->db->group_by("a.emprofid");
			$query = $this->db->get();
			// var_dump($query->result_array());
			return $query;
		}
		
		// function 
	}
	
?>