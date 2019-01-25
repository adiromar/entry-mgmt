<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library("upload");	
		$this->load->model('post_model');
	}

	public function insert_items(){
		$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|is_unique[item_info.item_name]');

		if($_POST['submit'] != True)
		{
			$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/add_items');
		}
		else{
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('duplicate', 'Duplicate Values. Item Name already exists');
			redirect('admins/add_items');
		}else{
			$user_id=$this->session->userdata('user_id');
			$item_name = $this->input->post('item_name');
			$price = $this->input->post('price');
			date_default_timezone_set('Asia/Kathmandu');
			$now = date('Y-m-d H:i:s');

			$data = array(
					'item_name' => $item_name,
					'price' => $price,
					'user_id' => $user_id
					);
			$datas = array(
					'item_name' => $item_name,
					'price' => $price,
					'effective_from' => $now
					);

			$insert = $this->db->insert('item_info', $data);
			$inserts = $this->db->insert('price_info', $datas);
			// print_r($insert);die;
			if ($insert == true){
				$this->session->set_flashdata('item_added', 'Item Successfully Added To Table');
				redirect('admins/add_items');
			}else{
				redirect('admins/add_items');
				}
			}
		}
	} //ends here

	public function insert_location(){
		if($_POST['submit'] != True)
		{
			$this->session->set_flashdata('location_error', 'Error !! Could not Save Form.');
			redirect('admins/add_location');
		}
		else
		{	
			$user_id=$this->session->userdata('user_id');
			$location = $this->input->post('location');

			$data = array(
					'location' => $location,
					'user_id' => $user_id
					);
			$insert = $this->db->insert('location_info', $data);
			if ($insert == true){
				$this->session->set_flashdata('item_added', 'Location Successfully Added To Table');
				redirect('admins/add_location');
			}
		}
	}

public function save_entry(){
	if($_POST['enter'] != True)
		{
			$this->session->set_flashdata('entry_error', 'Error !! Could not Save Form.');
			redirect('admins/index');
		}
		else
		{	
			// echo '<pre>';
			// print_r($_POST);die;
			date_default_timezone_set('Asia/Kathmandu');
			$now = date('Y-m-d H:i:s');
			$user_id=$this->session->userdata('user_id');
			$mob_number = $this->input->post('mob_number');
			$location = $this->input->post('location');
			$item_name = $this->input->post('item_name');
			$price = $this->input->post('price');
			$inserted_datetime= $now;
			$c = count($item_name);

			for ($i=0; $i < $c; $i++) { 
				$get = $this->page_model->get_item_id($item_name[$i]);
				$item_id = $get[0]['id'];
				// echo $item_id;

			$data = array(
					'mobile_number' => $mob_number[$i],
					'location' => $location[$i],
					'items' => $item_name[$i],
					'user_id' => $user_id,
					'item_id' => $item_id,
					'price' => $price,
					'inserted_time' => $now
					);
			$insert = $this->db->insert('data_entry', $data);
			}
			
			
			if ($insert == true){
				$this->session->set_flashdata('entry', 'Entry Successfully Added To Table');
				redirect('admins/index');
			}else{
				echo "error";
				redirect('admins/index');
			}
		}
	}

	public function update_entry(){
		// print_r($_POST);die;
		$table = 'data_entry';
		$id = $this->input->post('id');
		$url = $this->input->post('url');
		$str = explode("/", $url, 3);

		$user_id=$this->session->userdata('user_id');

		if (!empty($_POST['referto'])){
			$referto = $this->input->post('referto');
			$loc_data= array(
				'location' => $referto
			);
			$ins = $this->post_model->update_form($table , $loc_data, $id);
					if ($ins == true){
			$this->session->set_flashdata('update_entry', 'Location Successfully Reffered to '.$referto.'');
				redirect($url);
			}else{
				$this->session->set_flashdata('update_error', 'Sorry!! Could not update entry.');
				redirect($url);
			}

		}else if(empty($_POST['referto'])){
		$status = $this->input->post('status');
		$remarks = $this->input->post('remarks');
		$entry_id = $this->input->post('entry_id');
		$items = $this->input->post('items');
		$branch = $this->input->post('branch');
		
		if ($status == 'Delivered'){
			$notes_status = 1;
		}else{
			$notes_status = 0;
		}
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');

		$dis_data= array(
		'status' => $status,
		'remarks' => $remarks,
		'modified_date' => $now,
		'modified_by' => $user_id,
		'notes_status' => $notes_status
		);

		if ($status == 'Delivered'){
			$new_data= array(
		'entry_id' => $entry_id,
		'status' => $status,
		'items' => $items,
		'branch' => $branch,
		'remarks' => $remarks,
		'modified_date' => $now,
		'modified_by' => $user_id
		);
		$send = $this->post_model->insert_form('recent_entries' , $new_data);
		// }
		// print_r($dis_data);echo $id;die;
		$insert = $this->post_model->update_form($table , $dis_data, $id);

		// print_r($insert);die;
		if ($insert == true){

			
			$this->session->set_flashdata('update_entry', 'Entry Successfully Updated');
				redirect($str[2]);
			// echo '<p class="success_msg offset-4 col-md-4 offset-4 col-xs-6">Entry Successfully Updated</p>';die;
			}else{
				$this->session->set_flashdata('update_error', 'Sorry!! Could not update entry.');
				redirect($str[2]);
				// echo '<p class="failed_msg">Sorry!! Could not update entry.</p>';die;
			}
			// die;
		}
	  }
	}

	public function send_items_to_branch(){
		// $this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|is_unique[item_info.item_name]');

		if($_POST['submit'] != True)
		{
			$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/send_items_to_branch');
		}
		else{
			$user_id=$this->session->userdata('user_id');
			$item_name = $this->input->post('item_name');
			$item_id = $this->input->post('item_id');
			$quantity = $this->input->post('quantity');
			$extra_quantity = $this->input->post('extra_quantity');
			$qty = $quantity + $extra_quantity;
			$price = $this->input->post('price');
			$branch = $this->input->post('branch');
			$comm = $this->input->post('commission');
			date_default_timezone_set('Asia/Kathmandu');
			$now = date('Y-m-d H:i:s');

			$data = array(
					'item_id' => $item_id,
					'item_name' => $item_name,
					'quantity' => $qty,
					'price' => $price,
					'branch' => $branch,
					'commission' => $comm,
					'extra_quantity' => $extra_quantity,
					'sent_date' => $now,
					'user_id' => $user_id
					);

			$insert = $this->db->insert('branch_items_stocks', $data);
			
			$check = $this->page_model->check_item_branch_exists($item_name, $branch);
			if ($check == true){
				$idd = $check[0]['id'];
				$qty = $check[0]['quantity'] + $quantity;

				$dataa = array('quantity' => $qty,
					'transaction_date' => $now
			);
				$upp = $this->post_model->update_form('all_transactions' , $dataa, $idd);
			}else{
			$net_amt = 0;
			$net_amt = ($price - $comm ) * $quantity;
			$t_data = array(
					'item_id' => $item_id,
					'item_name' => $item_name,
					'quantity' => $qty,
					'price' => $price,
					'branch' => $branch,
					'commission' => $comm,
					'net_amount' => $net_amt,
					'extra_quantity' => $extra_quantity,
					'transaction_date' => $now,
					'user_id' => $user_id
					);
			$tra = $this->db->insert('all_transactions', $t_data);
			}

			if ($insert == true){
				$this->session->set_flashdata('item_added', 'Item Successfully Send To Branch');
				redirect('admins/send_items_to_branch');
			}else{
				$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/send_items_to_branch');
				}
			}
	} //ends here

	public function update_cash_flow(){
		// print_r($_POST);die;
		if($_POST['submit'] != True)
		{
			$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/test');
				echo "hsj";
		}
		else{
			// print_r($_POST);die;
			$item_name = $this->input->post('item_name');
			// $price = $this->input->post('price');
			$qty = $this->input->post('qty');
			// $stk = $this->input->post('stock');
			$branch = $this->input->post('branch');
			// $amount = $this->input->post('amount');
			// $net_amount = $this->input->post('net_amount');
			// $comm = $this->input->post('commission');
			// $price = $this->input->post('price');
			// $stock = $this->input->post('stock');
			$cash = $this->input->post('received');
			$due = $this->input->post('due_amount');
			date_default_timezone_set('Asia/Kathmandu');
			$now = date('Y-m-d H:i:s');
			$upd = array(
					'item_name' => $item_name,
					'branch' => $branch,
					'delivered' => $qty,
					'paid_amount' => $cash,
					'due_amount' => $due,
					'transaction_date' => $now
					);

			// $ddue = 0;
			// if ($due >= 0){
			// 	$ddue = $due;
				
			// }else{
			// 	$excess = $due;
			// }
			// date_default_timezone_set('Asia/Kathmandu');
			// $now = date('Y-m-d H:i:s');

			// $sum = $cash + $current;
			// $get = $this->page_model->get_transaction_record($item_name, $branch);;
			
			// if ($get == true){
			// 	$id = $get[0]['id'];
			// 	// print_r($get);die;
			// 	$upd = array(
			// 		'item_name' => $item_name,
			// 		'item_price' => $price,
			// 		'quantity' => $qty,
			// 		'stock_left' => $stk,
			// 		'total_cash' => $sum,
			// 		'branch' => $branch,
			// 		'actual_amount' => $amount,
			// 		'net_amount' => $net_amount,
			// 		'branch_comm' => $comm,
			// 		'previous_due' => $due,
			// 		'excess' => $excess,
			// 		'due_amount' => $ddue,
			// 		'inserted_time' => $now
			// 		// 'user_id' => $user_id
			// 		);
			// 	$update = $this->post_model->update_form('transaction_records', $upd, $id);
			// 		if ($update == true){
			// 			$this->session->set_flashdata('upd', 'Transaction Updated Successfully.');
			// 	redirect('admins/view_cash_flow');
			// 		}else{
			// 			$this->session->set_flashdata('err', 'Transaction Updated Failed.');
			// 			redirect('admins/view_cash_flow');
			// 		}
			// }else{
			// $data = array(
			// 		'item_name' => $item_name,
			// 		'item_price' => $price,
			// 		'quantity' => $qty,
			// 		'stock_left' => $stk,
			// 		'total_cash' => $sum,
			// 		'branch' => $branch,
			// 		'actual_amount' => $amount,
			// 		'net_amount' => $net_amount,
			// 		'branch_comm' => $comm,
			// 		'excess' => $excess,
			// 		'due_amount' => $ddue,
			// 		'inserted_time' => $now
			// 		);
			
			$insert = $this->db->insert('all_transactions', $upd);
			if ($insert == true){
				$this->session->set_flashdata('upd', 'Transaction Made Successfully.');
				redirect('admins/view_cash_flow');
			}else{
				$this->session->set_flashdata('err', 'Transaction Failed.');
				redirect('admins/view_cash_flow');
			}
		  // }  // if get is false ends
		}
	}

	public function save_purchases(){
		if($_POST['enter'] != True)
		{
			$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/item_purchased');
		}
		else{
		// print_r($_POST);die;
			
			// echo '<pre>';
			// print_r($_POST);die;
			$user_id=$this->session->userdata('user_id');
			$item_name = $this->input->post('item_name');
			$purchased_price = $this->input->post('purchased_price');
			$quantity = $this->input->post('quantity');
			$purchased_by = $this->input->post('purchased_by');
			$purchased_date = $this->input->post('purchased_date');
			$remarks = $this->input->post('remarks');
			// date_default_timezone_set('Asia/Kathmandu');
			// $now = date('Y-m-d H:i:s');

			$data = array(
					'purchased_price' => $purchased_price,
					'item_name' => $item_name,
					'quantity' => $quantity,
					'purchased_by' => $purchased_by,
					'purchased_date' => $purchased_date,
					'remarks' => $remarks
					// 'user_id' => $user_id
					);

			$insert = $this->db->insert('purchases_table', $data);
			// print_r($insert);die;
			if ($insert == true){
				$this->session->set_flashdata('item_added', 'Purchases Added');
				redirect('admins/item_purchased');
			}else{
				$this->session->set_flashdata('error', 'Error !! Could not Save Form.');
				redirect('admins/item_purchased');
				}
			}
	} //ends here


	public function save_cash(){
		// print_r($_POST);die;
		$branch = $this->input->post('branch');
		$cash = $this->input->post('cash');
		$date = $this->input->post('date');
		$extra_comm = $this->input->post('ext_comm');

		$dataa = array(
			'branch' => $branch,	
			'paid_amount' => $cash,
			'extra_commission' => $extra_comm,
			'transaction_date' => $date,
		);
		$insert = $this->db->insert('all_transactions', $dataa);
		if ($insert == true){
				$this->session->set_flashdata('location_added', 'Transaction Added');
				redirect('admins/cash_entry');
			}else{
				$this->session->set_flashdata('location_error', 'Error !! Could not Save Form.');
				redirect('admins/cash_entry');
				}

	}

		public function add_delivery(){
		// print_r($_POST);die;
		$user_id=$this->session->userdata('user_id');
		$branch = $this->input->post('branch');
		$item_name = $this->input->post('item_name');
		$remarks = $this->input->post('remarks');
		$delivered = $this->input->post('delivered');
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');
		$noww = date('Y-m-d');
		
		$dataa = array(
			'location' => $branch,
			'items' => $item_name,
			'status' => 'Delivered',
			'remarks' => $remarks,
			'user_id' => $user_id,
			'inserted_time' => $now,
			'modified_date' => $noww
		);
		for ($i=0; $i < $delivered; $i++) { 
			$insert = $this->db->insert('data_entry', $dataa);
		}
		
		if ($insert == true){
				$this->session->set_flashdata('deli_added', 'Delivery Status Maintained');
				redirect('admins/add_delivery');
			}else{
				$this->session->set_flashdata('location_error', 'Error !! Could not Save Form.');
				redirect('admins/add_delivery');
				}

	}

	public function items_returned(){
		// print_r($_POST);die;
		$user_id=$this->session->userdata('user_id');
		$branch = $this->session->userdata('location');

		$item_name = $this->input->post('item_name');
		$item_id = $this->input->post('item_id');
		$quantity = $this->input->post('quantity');
		$reason = $this->input->post('reason');
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');
		$noww = date('Y-m-d');
		
		$dataa = array(
			'branch' => $branch,
			'item_id' => $item_id,
			'item_name' => $item_name,
			'quantity' => $quantity,
			'reason' => $reason,
			'user_id' => $user_id,
			'returned_date' => $now
		);
		$insert = $this->db->insert('items_returned', $dataa);
		
		if ($insert == true){
				$this->session->set_flashdata('damage', 'Status Maintained');
				redirect('pages/return_items');
			}else{
				$this->session->set_flashdata('dam_err', 'Error !! Could not Save Form.');
				redirect('pages/return_items');
				}
	}

	public function update_returned(){
		// print_r($_POST);die;
		$user_id=$this->session->userdata('user_id');

		$branch = $this->input->post('branch');
		$idd = $this->input->post('data_id');
		$item_id = $this->input->post('item_id');
		$item_name = $this->input->post('item_name');
		$quantity = $this->input->post('quantity');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');
		$noww = date('Y-m-d');
		
		$dataa = array(
			// 'branch' => $branch,
			// 'item_name' => $item_name,
			// 'quantity' => $quantity,
			'app_qty' => $quantity,
			'status' => $status,
			// 'reason' => $reason,
			'user_id' => $user_id,
			'approved_date' => $now
		);
		$insert = $this->post_model->update_form('items_returned', $dataa, $idd);
		
		if ($status == 'Approved'){
			$upda = array(
			'branch' => $branch,
			'item_name' => $item_name,
		    'item_id' => $item_id,
			'returned_qty' => $quantity,
			'user_id' => $user_id,
			'sent_date' => $now
			);
			$trans = array(
			'branch' => $branch,
			'item_name' => $item_name,
		    'item_id' => $item_id,
			'returned_qty' => $quantity,
			'user_id' => $user_id,
			'transaction_date' => $now
			);
			$add_ret = $this->db->insert('branch_items_stocks', $upda);
			$add_ret1 = $this->db->insert('all_transactions', $trans);
		}
		if ($insert == true){
				$this->session->set_flashdata('ret', 'Returned Items Status Maintained');
				redirect('admins/view_returned_items');
			}else{
				$this->session->set_flashdata('ret_err', 'Error !! Could not Save Form.');
				redirect('admins/view_returned_items');
				}
	}


	public function updateprice(){
		$idd = $this->input->post('id');
		$newprice = $this->input->post('newprice');
		$item_name = $this->input->post('item_name');
		$date = $this->input->post('effective_from');
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');

		$last = $this->page_model->get_previous($item_name);
		// echo '<pre>';
		// print_r($last);
		if (!empty($last)){
			$prv = $last[0]['effective_from'];
			$prv_id = $last[0]['id'];
			$date_only = array('latest_date' => $now);
			$inj = $this->post_model->update_form('price_info',$date_only,$prv_id);
		}else{
			$prv = null;$nxt = null;
		}
		// echo $prv_id;echo $prv;die;
		$dataa = array(
			'new_price' => $newprice
		);

		$pri_data = array(
			'item_id' => $idd,
			'item_name' => $item_name,
			'price' => $newprice,
			'prev_date' => $prv,
			'effective_from' => $now,
			// 'latest_date' => $nxt
		);
		// print($pri_data);die;
		$updd = $this->post_model->insert_form('price_info', $pri_data);

		$upd = $this->post_model->update_form('item_info', $dataa, $idd);
		if ($upd == true){
				$this->session->set_flashdata('price', 'New Price Updated Successfully.');
				redirect('admins/view_items');
			}else{
				$this->session->set_flashdata('ret_err', 'Error !! Could not Save Form.');
				redirect('admins/view_items');
		}
	}

	public function daily_notes(){
		// print_r($_POST);die;
		$branch=$this->session->userdata('location');
		$item_name = $this->input->post('item_name');
		$delivered = $this->input->post('delivered');
		$total = $this->input->post('total');
		$date = $this->input->post('date');
		date_default_timezone_set('Asia/Kathmandu');
		$now = date('Y-m-d H:i:s');
		$c = count($item_name);

		$result = $this->post_model->get_last_entry_records_branch('data_entry', $branch)->row();
		$res = $result->notes_status;
		// print_r($res);die;
		for ($i=0; $i < $c; $i++) { 

			$dataa = array(
			'item_name' => $item_name[$i],	
			'item_delivered' => $delivered[$i],
			'item_del_maintained' => $total[$i],
			'branch' => $branch,
			'date' => $date,
		);
		$daily = $this->db->insert('daily_notes', $dataa);
		}
		
		if ($daily == true){
				$this->session->set_flashdata('location_added', 'Transaction Added');
				redirect('admins/cash_entry');
			}else{
				$this->session->set_flashdata('location_error', 'Error !! Could not Save Form.');
				redirect('admins/cash_entry');
				}

	}

	public function filter_daily_admin(){

		$date = $_POST['new_date'];
		$location = $_POST['location'];

		$res = $this->page_model->daily_entry_stk($location, $date);
		// print_r($res);
		$i = 1;
		foreach ($res as $key => $value) {
			$notes = $this->page_model->get_delivered_by_branch_date($value['items'] , $location, $value['inserted_time']);
			$del=0;
			foreach ($notes as $nkey => $vals) {
				$del = $vals['item_delivered'];
			}
			// echo '<pre>';
			// print_r($notes);
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$value['location'].'</td>';
			echo '<td>'.$value['items'].'</td>';
			echo '<td>'.$value['count(id)'].'</td>';
			echo '<td>'.$del.'</td>';
			echo '<td>'.$value['inserted_time'].'</td>';
			$i++; } 
			if (empty($res)){
				echo "<td colspan='5' style='text-align: center;color: red;'>Records Does Not Exists.</td>";
			}
	}

	public function filter_daily(){
		$date = $_POST['new_date'];
		$loc = $this->session->userdata('location');
		$res = $this->page_model->daily_entry_stk($loc, $date);
		// print_r($res);
		$i = 1;
		foreach ($res as $key => $value) {
			$notes = $this->page_model->get_delivered_by_branch_date($value['items'] , $loc, $value['modified_date']);
			$del=0;
			foreach ($notes as $nkey => $vals) {
				$del = $vals['item_delivered'];
			}
			// echo '<pre>';
			// print_r($notes);
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$value['items'].'</td>';
			echo '<td>'.$value['inserted_time'].'</td>';
			echo '<td>'.$value['count(id)'].'</td>';
			echo '<td>'.$del.'</td>';
			$i++; } 
			if (empty($res)){
				echo "<td colspan='5' style='text-align: center;color: red;'>Records Does Not Exists.</td>";
			}
	}
} // 