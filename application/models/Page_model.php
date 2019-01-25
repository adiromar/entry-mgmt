<?php
class Page_model extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}
	public function view_entry_records_user($loc,$start=0,$end=100){
		// $loc = $this->session->userdata('location');
		$this->db->order_by('id', 'DESC');
		$this->db->limit($start, $end);
		$query = $this->db->get_where('data_entry', array('location' => $loc));
		return $query->result_array();
	}
	public function view_entry_records_user_wl($loc){
		
		$this->db->select('sum(case when status = "" then 1 else 0 end) as not_del,
			sum(case when status = "Cancelled" then 1 else 0 end) as can');
		// $this->db->from('data_entry');
		$this->db->where('location', $loc);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('data_entry');
			return $query->result_array();
	}
	public function view_entry_records($start=0,$end=25){
		// $query = $this->db->query("SELECT * FROM data_entry order by id desc");
		$this->db->order_by('id', 'desc');
		$this->db->limit($start, $end);
		$query = $this->db->get('data_entry');
		return $query->result_array();
	}
	public function get_branch_name(){
		$query = $this->db->query('SELECT location FROM location_info group by location');
		return $query->result_array();
	}
	public function get_items_returned($start=0,$end=25){
		$this->db->select('*');
		$this->db->order_by('returned_date', 'desc');
		$this->db->limit($start, $end);
		$query = $this->db->get('items_returned');
		return $query->result_array();
	}
	public function get_itemdetails(){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli,
			sum(case when status = "Cancelled" then 1 else 0 end) as canc,
			sum(case when status = "Call Not Received" then 1 else 0 end) as not_rec,
			sum(case when status = "Inquiry Only" then 1 else 0 end) as inq,
			sum(case when status = "Later On" then 1 else 0 end) as later,
			sum(case when status = "" then 1 else 0 end) as emp
			');
		// $this->db->from('data_entry');
		$this->db->group_by('items');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('data_entry');
			return $query->result_array();
	}
	public function get_itemdetails_by_day($date){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli,
			sum(case when status = "Cancelled" then 1 else 0 end) as canc,
			sum(case when status = "Call Not Received" then 1 else 0 end) as not_rec,
			sum(case when status = "Inquiry Only" then 1 else 0 end) as inq,
			sum(case when status = "Later On" then 1 else 0 end) as later,
			sum(case when status = "" then 1 else 0 end) as emp
			');
		$this->db->from('data_entry');
		$this->db->where('modified_date', $date);
		$this->db->group_by('items');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_itemdetails_by_branch($branch){
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
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_itemdetails_by_branch_day($branch, $date){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli,
			sum(case when status = "Cancelled" then 1 else 0 end) as canc,
			sum(case when status = "Call Not Received" then 1 else 0 end) as not_rec,
			sum(case when status = "Inquiry Only" then 1 else 0 end) as inq,
			sum(case when status = "Later On" then 1 else 0 end) as later,
			sum(case when status = "" then 1 else 0 end) as emp
			');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where('modified_date', $date);
		// $this->db->or_where('modified_date', '');
		$this->db->group_by('items');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function branch_efficiency($branch){
		$this->db->select('sum(case when status = "Delivered" then 1 else 0 end) as eff,sum(case when status != "Delivered" then 1 else 0 end) as allq');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function branch_efficiency_by_item($branch, $item){
		$this->db->select('sum(case when status = "Delivered" then 1 else 0 end) as eff,sum(case when status != "Delivered" then 1 else 0 end) as allq');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where('items', $item);
		$this->db->group_by('items');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function stk_info_cashflow($branch, $item){
		$this->db->select('*,sum(quantity)');
		$this->db->from('branch_items_stocks');
		$this->db->where('branch', $branch);
		$this->db->where('item_name', $item);
		$this->db->group_by('item_name');
		// $this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function record_inserted_by($id){
		$query = $this->db->get_where('user_login', array('user_id' => $id));
		return $query->result_array();
	}
	public function get_item_id($item_name){
		$this->db->select('id');
		$this->db->from('item_info');
		$this->db->where('item_name', $item_name);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_stocks_for_branch($branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('branch_items_stocks');
		$this->db->where('branch', $branch);
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_stocks_for_branch_item($branch, $item){
		$this->db->select('*,sum(quantity)');
		$this->db->from('branch_items_stocks');
		$this->db->where('branch', $branch);
		$this->db->where('item_name', $item);
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		// $query = $this->db->query("SELECT * FROM branch_items_stocks where item_name = '.$item.' and branch = '.$branch.' ");
			return $query->result_array();
	}
	public function get_stocks_items($item){
		$this->db->select('*');
		$this->db->from('branch_items_stocks');
		$this->db->where('item_name', $item);
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_delivered_stocks_for_branch($branch, $item){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli
			');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where('items', $item);
		$this->db->group_by('items');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_branchstocks_all($start=0,$end=25){
		$this->db->select('*');
		$this->db->from('branch_items_stocks');
		$this->db->order_by('id', 'desc');
		$this->db->limit($start, $end);
		$query = $this->db->get();
			return $query->result_array();
	}
	public function branchstocks_all(){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('branch_items_stocks');
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	// stocks info starts here
	public function fetch_stocks_by_day($day){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->where('sent_date like', $day.'%');
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('branch_items_stocks');
			return $query->result_array();
	}
	public function fetch_stocks_by_branch($branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->where('branch', $branch);
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('branch_items_stocks');
			return $query->result_array();
	}
	public function fetch_stocks_by_branch_date($branch,$date){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->where('branch', $branch);
		$this->db->where('sent_date like', $date.'%');
		$this->db->group_by('item_name');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('branch_items_stocks');
			return $query->result_array();
	}
	// stocks ends
	public function countAll($table_name)
{
return $this->db->count_all($table_name);
}
public function get_transaction_record($item, $branch){
	$this->db->select('*');
		$this->db->from('transaction_records');
		$this->db->where('item_name', $item);
		$this->db->where('branch', $branch);
		$this->db->group_by('item_name');
		$query = $this->db->get();
			return $query->result_array();
}
public function get_all_transaction_record($item, $branch){
	$this->db->select('item_name,sum(paid_amount),sum(due_amount)');
		$this->db->from('all_transactions');
		$this->db->where('item_name', $item);
		$this->db->where('branch', $branch);
		$this->db->group_by('item_name');
		$query = $this->db->get();
			return $query->result_array();
}
public function get_cashflow_record(){
	$this->db->select('*');
		$this->db->from('all_transactions');
		// $this->db->where('item_name', $item);
		// $this->db->where('branch', $branch);
		// $this->db->group_by('item_name');
		$query = $this->db->get();
}
public function get_cashflow_record_item_branch($branch){
	$this->db->select('*');
		$this->db->from('transaction_records');
		// $this->db->where('item_name', $item);
		$this->db->where('branch', $branch);
		// $this->db->group_by('item_name');
		$query = $this->db->get();
			return $query->result_array();
}
public function get_transaction_record_by_id($id){
	$this->db->select('*');
		$this->db->from('transaction_records');
		$this->db->where('id', $id);
		$query = $this->db->get();
			return $query->result_array();
}
public function check_notification($branch){
		$this->db->select('sum(case when status = "" then 1 else 0 end) as new');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_items_purchased(){
		$this->db->select('*');
		$this->db->from('purchases_table');
		// $this->db->where('location', $branch);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function previous_comm_branch_items($branch, $item){
		$this->db->select('commission');
		$this->db->from('branch_items_stocks');
		$this->db->where('branch', $branch);
		$this->db->where('item_name', $item);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function cancelled_rec($branch,$start=100){
		$names = array('Delivered', 'Cancelled');
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where_in('status', $names);
		// $this->db->or_where('status', "Delivered");
		$this->db->order_by('modified_date', 'desc');
		$this->db->limit($start);
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_deli($branch){
		$names = array('Delivered', 'Cancelled');
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where_in('status', $names);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_interested($branch){
		$names = array('Interested');
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where_in('status', $names);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_interested_admin(){
		$names = array('Interested');
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where_in('status', $names);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_later_branch($branch){
		$names = array('Later On', 'Call Not Received','Inquiry Only');
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where_in('status', $names);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_later(){
		$names = array('Later On', 'Call Not Received','Inquiry Only');
		$this->db->select('*');
		$this->db->from('data_entry');
		// $this->db->where('location', $branch);
		// $this->db->where_in('status', $names);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function count_deli_only($item, $branch){
		$names = array('Delivered');
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as deli');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		$this->db->where('items', $item);
		$this->db->group_by('items');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function cancelled_rec_all(){
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('status', "Cancelled");
		$this->db->or_where('status', "Delivered");
		// $this->db->where('location', $branch);
		$this->db->order_by('modified_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	// ******** all transaction records ***************************
	public function get_entire_transactions(){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->order_by('transaction_date', 'desc');
		$this->db->group_by('transaction_date');
		// $this->db->limit($start,$end);
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_entire_transactions_branch($branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('branch', $branch);
		$this->db->group_by('transaction_date');
		// $this->db->order_by('id', 'desc');
		// $this->db->limit($start,$end);
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_all_transactions($branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('branch', $branch);
		$this->db->group_by('transaction_date');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_all_transactions_daterange($start, $end){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('transaction_date >=', $start);
		$this->db->where('transaction_date <', $end);
		$this->db->group_by('transaction_date');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_all_transactions_start_branch($start,$branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('branch', $branch);
		$this->db->where('transaction_date =', $start);
		$this->db->group_by('transaction_date');
		// $this->db->where('transaction_date <', $end);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_all_transactions_daterange_branch($start, $end,$branch){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('branch >=', $branch);
		$this->db->where('transaction_date >=', $start);
		$this->db->where('transaction_date <', $end);
		$this->db->group_by('transaction_date');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_all_transactions_day($start){
		$this->db->select('*,sum(quantity),sum(returned_qty)');
		$this->db->from('all_transactions');
		$this->db->where('transaction_date =', $start);
		// $this->db->where('transaction_date <', $end);
		$this->db->group_by('transaction_date');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function check_item_branch_exists($item, $branch){
		$this->db->select('*');
		$this->db->from('all_transactions');
		$this->db->where('item_name', $item);
		$this->db->where('branch', $branch);
		$this->db->where('price !=', 0);
		$query = $this->db->get();
			return $query->result_array();
	}
	public function fetch_returned_items($branch){
		$this->db->select('*');
		$this->db->from('items_returned');
		$this->db->where('branch', $branch);
		$this->db->order_by('returned_date', 'desc');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_all_price($name, $date){
		$query = $this->db->query("SELECT item_name,price from price_info where item_name = '$name' and '$date' > effective_from and '$date' <= latest_date");
			return $query->result_array();
	}
	public function get_previous($item){
	$this->db->select('id,effective_from,item_name');
		$this->db->from('price_info');
		$this->db->where('item_name', $item);
		$this->db->order_by('effective_from', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
}
	public function get_last_records(){
	$this->db->select('*');
		$this->db->from('price_info');
		// $this->db->group_by('item_id');
		// $this->db->order_by('effective_from', 'desc');
		$query = $this->db->get();
		return $query->result_array();
}
public function check_daily_notes($branch){
		$this->db->select('*');
		$this->db->from('daily_notes');
		$this->db->where('branch', $branch);
		$this->db->where('date >= CURDATE() - INTERVAL 1 DAY');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function check_entry_exists($branch){
		$this->db->select('*');
		$this->db->from('data_entry');
		$this->db->where('location', $branch);
		// $this->db->where('modified_date', $date);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function daily_entry_stk($branch, $date){
		$this->db->select('*,count(id)');
		$this->db->where('location', $branch);
		$this->db->where('inserted_time like', $date . '%');
		$this->db->group_by('items');
		// $this->db->where('date >= now() - INTERVAL 1 DAY');
		$query = $this->db->get('data_entry');
		return $query->result_array();
	}
	public function daily_entry_list($branch){
		$this->db->select('*');
		$this->db->from('daily_notes');
		$this->db->where('branch', $branch);
		// $this->db->group_by('date');
		$this->db->order_by('date', 'desc');
		// $this->db->where('date >= now() - INTERVAL 1 DAY');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function fetch_notes_daily(){
		$this->db->select('*');
		$this->db->from('daily_notes');
		$query = $this->db->get();
			return $query->result_array();
	}
	public function get_view_entry_products($branch){
		$this->db->select('*, sum(case when status = "Delivered" then 1 else 0 end) as tot_del');
		$this->db->where('location', $branch);
		// $this->db->where('modified_date', 'NOW() - INTERVAL 1 DAY');
		$this->db->where('modified_date >= CURDATE() - INTERVAL 1 DAY');
		$this->db->group_by('items');
		$query = $this->db->get('data_entry');
		return $query->result_array();
	}

	// daily status for yesterdays 
	public function fetch_delivered_recent($branch){
		$this->db->select('*');
		$this->db->where('status like', '%Delivered%');
		$this->db->where('location', $branch);
		$this->db->where('modified_date >= CURDATE() - INTERVAL 2 DAY');
		$query = $this->db->get('data_entry');
		return $query->result_array();
	}

	public function get_delivered_by_branch_date($items, $branch, $date){
		$this->db->select('item_name,item_delivered');
		$this->db->where('item_name', $items);
		$this->db->where('branch', $branch);
		$this->db->where('date >= CURDATE() - INTERVAL 1 DAY');
		$query = $this->db->get('daily_notes');
		return $query->result_array();
	}

}