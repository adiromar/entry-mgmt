<?php 
if(!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!');

class User_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();

	}

	public function userLogin($login_condition)
	{
		$result_set = $this->db->get_where("user_login",$login_condition);
		if($result_set->num_rows()>0)
		{
			return $result_set->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	public function insertUser($log_data)
	{
		$this->db->insert("user_login", $log_data);
		return TRUE;
	}
	
	public function update_user($tablename, $log_data, $id)
	{
		$this->db->where('user_id', $id);
		$this->db->update($tablename ,$log_data);
		return true;
	}

	public function get_user($id)
	{
		$query = $this->db->get_where('user_login', array('user_id' => $id));

		return $query->result_array();
	}

	function check_user() {

   // $this->db->where("user_id");
		$query = $this->db->get("user_login");
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else{
			return NULL;
		}
	}

	public function get_user_type($id)
	{
		$query = $this->db->query('SELECT * FROM user_login WHERE user_id = "'.$id.'" ');
		return $query->result_array();
	}

	public function get_all_district_user($dist)
	{
		$query = $this->db->query('SELECT user_id FROM user_login WHERE district = "'.$dist.'" ');
		return $query->result_array();
	}

	public function get_user_info($id)
	{
		$query = $this->db->query('SELECT * FROM user_login WHERE user_id = "'.$id.'" ');
		return $query->result_array();
	}

	public function get_user_eff($branch){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli,
			sum(case when status = "Cancelled" then 1 else 0 end) as canc,
			sum(case when status = "Call Not Received" then 1 else 0 end) as not_rec,
			sum(case when status = "Inquiry Only" then 1 else 0 end) as inq,
			sum(case when status = "Later On" then 1 else 0 end) as later,
			sum(case when status = "" then 1 else 0 end) as emp
			');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->group_by('items');
		$query = $this->db->get();
		return $query->result_array();	
	}
}
?>