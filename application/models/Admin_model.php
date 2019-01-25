<?php 
/**
* Admin Model
*/
class Admin_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	// public function get_tables(){
	// 	$query = $this->db->query('SELECT * FROM cms_tables ORDER BY form_order ASC');
	// 	return $query->result_array();
	// }

	public function get_items(){
		$query = $this->db->query('SELECT * FROM item_info order by id desc');
		return $query->result_array();
	}

	public function get_items_range($start=0, $end=20){
		$this->db->select('*');
		$this->db->from('item_info');
		$this->db->order_by('id', 'desc');
		$this->db->limit($start, $end);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_location(){
		$query = $this->db->query('SELECT * FROM location_info');
		return $query->result_array();
	}

	public function get_price_by_itemname($item){
		$query = $this->db->query('SELECT price FROM item_info where item_name = "'.$item.'" ');
		return $query->result_array();
	}

	public function get_stock(){
		$this->db->select('items,sum(case when status = "Delivered" then 1 else 0 end) as sold,
			');
		$this->db->from('data_entry');
		$this->db->group_by('items');
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function fetch_all_prices($item=null){
		$this->db->select('*');
		$this->db->from('price_info');
		// $this->db->where('item_name', $item);
		$this->db->group_by('item_name');
		$this->db->order_by('effective_from', 'desc');
		// $this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function delete_id($tbl_name, $id){
    	$this->db->where("id",$id);
    	$this->db->delete($tbl_name);
    	return $this->db->affected_rows();
	}

	public function delete_sec_tbl($sec_tbl, $pri_id, $pri_dat){
		$array = array('primary_data_id' => $pri_dat, 'primary_id' => $pri_id);
    	$this->db->where($array);
    	$this->db->delete($sec_tbl);
    	return $this->db->affected_rows();
	}

	public function delete_from_values_tbl($id){
    	$this->db->where("tableid",$id);
    	$this->db->delete('cms_values');
    	return $this->db->affected_rows();
	}

	public function delete_form_by_title($title){
    	$this->db->where('title',$title);
    	$this->db->delete('cms_tables');
    	return $this->db->affected_rows();
	}
	public function delete_table_by_title($title){
		$query = $this->db->query('Drop table '.$title.' ');
		return $query;
	}
	public function get_form_type($name){
		$query = $this->db->query('SELECT form_type FROM cms_tables where title = "'.$name.'" ');
		return $query->result();
	}
	public function set_priority($value, $id){
		$query = $this->db->query('Update cms_tables set form_order = '.$value.' where id = "'.$id.'" ');
		return $query;
	}

	public function get_table_data_by_field($field, $table){
		
		$query = $this->db->query('SELECT '.$field.' from `'.$table.'` ');	
		// $query = $this->db->get_where($table, array($field));	
		return $query->result_array();
	}

	public function price_between_dates($item,$now){
		$this->db->select('price');
		$this->db->from('price_info');
		$this->db->where('item_name', $item);
		$this->db->where('effective_from <', $now);
		$this->db->where('latest_date >', $now);
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function update_form($title,$fields,$types,$values,$table_id){

		//Convert fields into string
		$allfields = implode(',', $fields);
		$alltypes = implode(',', $types);
		// print_r($alltypes);die;
		$combine = array_combine($fields,$types);
		$old_table_ttl = $this->input->post('old_table_ttl');
		// print_r($combine);die;
		foreach ($values as $key => $value) {
			$val[$key] = implode('|', $value); 
		}

		//Create table
		$this->load->dbforge();

		// 	$old_field_ttl = $this->input->post('old_field_ttl');
		// $edit_field_name = $this->input->post('edit_field_name');
		// print_r($old_field_ttl);
		// $combine = array_combine($fields,$types);
		// print_r($combine);die;
		// foreach ($combine as $key => $value) {
		// 	if ($value == 'FLOAT') {
		// 		$fields = array(
  //       		$edit_field_name => array(
  //               	'name' => $edit_field_name,
  //               	'type' => 'Float',
  //       			),
		// 		);
		// 	$this->dbforge->modify_column($old_table_ttl, $fields);
		// 		// $this->dbforge->add_field($key.' '.$value.'(20) NOT NULL');
		// 	}
		// 	if ($value == 'VARCHAR') {
		// 		$fields = array(
  //       		$edit_field_name => array(
  //               	'name' => $edit_field_name,
  //               	'type' => 'varchar (200) NOT NULL',
  //       			),
		// 		);
		// 	$this->dbforge->modify_column($old_table_ttl, $fields);
		// 		// $this->dbforge->add_field($key.' '.$value.'(20) NOT NULL');
		// 	}
		// }
			// $this->dbforge->add_field('user_id INT(55)');
		// if ($this->dbforge->create_table($title, TRUE)){
		$this->dbforge->rename_table($old_table_ttl, $title);
		// 	//Add title to table cms_tables
			$nepali = $this->input->post('nepali_title');
			// $nepali = $this->input->post('subtitle');
			// print_r($nepali);die;
			$tr = implode(', ', $nepali);
			// print_r($tr);die;
			$data = array(
					'title' => $title,
					'fields' => $allfields,
					'types' => $alltypes,
					'nepali_title' => $tr,
					'form_type' => $this->input->post('form_type'),
					'display_name' => $this->input->post('display_name'),
					'subtitle' => $this->input->post('subtitle'),
					);
			$this->db->where('id', $table_id);
			$this->db->update('cms_tables', $data);
			// $id = $this->db->insert_id();

			// print_r($table_id);
			foreach ($val as $key => $value) {
				print_r($key);
				$dat = array(
							'tableid' => $table_id,
							// 'name' => $key,
							'vals' => $value,
							);
			$this->db->where('name', $key);
			$this->db->where('tableid', $table_id);
			$this->db->update('cms_values', $dat);
			}
			return true;
		
		}
}
 ?>