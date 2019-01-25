<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->model('user_model');
		$this->load->model('admin_model');
	}

	public function index(){
		$data['title'] = "Admin";
		$data['entry'] = $this->admin_model->get_items();
		$data['loca'] = $this->admin_model->get_location();

		$this->load->view('includes/header');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('includes/footer');
	}

	public function add_items(){
		$data['location'] = $this->admin_model->get_location();

		$this->load->view('includes/header');
		$this->load->view('admin/add_items', $data);
		$this->load->view('includes/footer');
	}

	public function send_items_to_branch(){
		$data['location'] = $this->admin_model->get_location();
		$data['entry'] = $this->admin_model->get_items();
		
		$this->load->view('includes/header');
		$this->load->view('admin/items_to_branch', $data);
		$this->load->view('includes/footer');
	}


	public function add_location(){
		$data['location'] = $this->admin_model->get_location();

		$this->load->view('includes/header');
		$this->load->view('admin/add_location', $data);
		$this->load->view('includes/footer');
	}

	public function notification(){
		$data['location'] = $this->admin_model->get_location();

		$this->load->view('includes/header');
		$this->load->view('admin/noti', $data);
		$this->load->view('includes/footer');
	}

	public function view_items(){
		$this->load->model('page_model');
		$data['title'] = "View Items";

		$config['base_url'] = site_url('admins/view_items');
		$config['total_rows'] = $this->page_model->countAll('item_info');
		$config['per_page'] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

        $config["num_links"] = floor($choice);

        /* This Application Must Be Used With BootStrap 4 *  */
$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] 	= '</ul></nav></div>';
$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] 	= '</span></li>';
$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close'] 	= '</span></li>';
$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['last_tagl_close'] 	= '</span></li>';
		
		$this->pagination->initialize($config);		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$count_all = $this->page_model->countAll("item_info");

		$data['items'] = $this->admin_model->get_items_range($config['per_page'],$data['page']);
		$data['pagination'] = $this->pagination->create_links();

		$data['stock'] = $this->admin_model->get_stock();
		$data['price'] = $this->page_model->get_last_records();
		
	
		$this->load->view('includes/header');
		$this->load->view('admin/view_items', $data);
		$this->load->view('includes/footer');
	}

	public function view_report(){
		$data['title'] = "View Items Details";
		$data['details'] = $this->page_model->get_itemdetails();
		$data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/view_item_details', $data);
		$this->load->view('includes/footer');
	}

	public function transaction(){
		$data['title'] = "View Items Details";
		$data['details'] = $this->page_model->get_itemdetails();
		$data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/transaction', $data);
		$this->load->view('includes/footer');
	}

	public function cash_entry(){
		$data['title'] = "View Items Details";
		// $data['details'] = $this->page_model->get_itemdetails();
		$data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/cash_entry', $data);
		$this->load->view('includes/footer');
	}

	public function view_cash_flow(){
		$data['title'] = "View Items Details";
		$data['all'] = $this->page_model->get_entire_transactions();
		// $data['flow'] = $this->page_model->get_cashflow_record();
		$data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/view_cash_flow', $data);
		$this->load->view('includes/footer');
	}

	public function view_stocks(){
		$data['title'] = "View Stocks Details";
		$data['details'] = $this->page_model->branchstocks_all();
		$data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/view_stocks', $data);
		$this->load->view('includes/footer');
	}

	public function add_delivery(){
		$data['title'] = "View Stocks Details";
		$data['branch'] = $this->page_model->get_branch_name();
		$data['items'] = $this->admin_model->get_items();

		$this->load->view('includes/header');
		$this->load->view('admin/add_delivery', $data);
		$this->load->view('includes/footer');
	}

	public function view_branch_items(){
		$data['title'] = "View Branch Stocks";

		$config['base_url'] = site_url('admins/view_branch_items');
		$config['total_rows'] = $this->page_model->countAll('branch_items_stocks');
		$config['per_page'] = 25;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

        $config["num_links"] = floor($choice);

        /* This Application Must Be Used With BootStrap 4 *  */
$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] 	= '</ul></nav></div>';
$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] 	= '</span></li>';
$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close'] 	= '</span></li>';
$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['last_tagl_close'] 	= '</span></li>';
		
		$this->pagination->initialize($config);		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$count_all = $this->page_model->countAll("branch_items_stocks");

		$data['branch_stk'] = $this->page_model->get_branchstocks_all($config['per_page'],$data['page']);
		$data['pagination'] = $this->pagination->create_links();
	
		$this->load->view('includes/header');
		$this->load->view('admin/view_branch_items', $data);
		$this->load->view('includes/footer');
	}

	public function entry_log(){
		$data['title'] = "View Branch Stocks";
		
		$config['base_url'] = site_url('admins/entry_log');
		$config['total_rows'] = $this->page_model->countAll('data_entry');
		$config['per_page'] = 25;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] 	= '</ul></nav></div>';
$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] 	= '</span></li>';
$config['prev_link'] = 'Prev';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close'] 	= '</span></li>';
$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['first_link'] = '<<<';
$config['last_link'] = '>>>';
$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['last_tagl_close'] 	= '</span></li>';
// $config['display_pages'] = FALSE;
$config['num_links'] = 1;
		
		$this->pagination->initialize($config);		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$count_all = $this->page_model->countAll("data_entry");

		$data['records'] = $this->page_model->view_entry_records($config['per_page'],$data['page']);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('includes/header');
		$this->load->view('admin/entry_log', $data);
		$this->load->view('includes/footer');
	}

	public function delete_form(){
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$last = explode("/", $str, 6);
		// echo $last[5];
		// echo $str;die;
		
		$del =$this->admin_model->delete_from_values_tbl($last[5]);
		$delete =$this->admin_model->delete_form_by_title($last[4]);
		$del_tbl =$this->admin_model->delete_table_by_title($last[4]);
		if ($del == true && $delete == true && $del_tbl == true){
			$this->session->set_flashdata('post_deleted', 'Form Deleted Successfully.');
			redirect ('admins/list_form/');
		}else{
			$this->session->set_flashdata('error_deletion', 'form deleted.');
			redirect ('admins/list_form/');
		}
	}

	public function backup(){
		
		$this->load->dbutil();

		$prefs = array(     
    		'format'      => 'zip',             
    		'filename'    => 'sasto_backup.sql'
    		);

		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'wump_backup'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 

		$this->load->helper('download');
		force_download($db_name, $backup);
	}


	public function get_report(){
		// echo $_POST['date'];
		// print_r($_POST);die;
		$branch = $_POST['branch'];
		$date = $_POST['date'];
		if ($branch == "all" && $_POST['date'] == null ){
			$data = $this->page_model->get_itemdetails();
		}elseif($_POST['date'] && $_POST['branch'] == "all"){
			$data = $this->page_model->get_itemdetails_by_day($date);
			// echo '<pre>';
			// print_r($data);die;
		}elseif($_POST['date'] && $_POST['branch']){
			$data = $this->page_model->get_itemdetails_by_branch_day($branch, $date);
		}else{
		$data = $this->page_model->get_itemdetails_by_branch($branch);
			}
		// echo '<pre>';
		// print_r($data);die;
					$i = 1;
					foreach ($data as $val) {
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['items'].'</td>';
						echo '<td>'.$val['deli'].'</td>';
						echo '<td>'.$val['canc'].'</td>';
						echo '<td>'.$val['not_rec'].'</td>';
						echo '<td>'.$val['inq'].'</td>';
						echo '<td>'.$val['later'].'</td>';
						echo '<td>'.$val['emp'].'</td>';
						echo '</tr>';
					$i++; } 
					if (empty($data)){
						echo "<p style='color: red' class='ml-4'>No Data To Display</p>";
					}
	}

	public function get_transaction(){
		$loc = $this->session->userdata('location');
		// print_r($_POST);die;
		$branch = $_POST['branch'];
		$date = $_POST['date'];
		if ($branch == "all" && $_POST['date'] == null ){
			$data = $this->page_model->get_itemdetails();
		}elseif($_POST['date'] && $_POST['branch'] == "all"){
			$data = $this->page_model->get_itemdetails_by_day($date);
			// echo '<pre>';
			// print_r($data);die;
		}elseif($_POST['date'] && $_POST['branch']){
			$data = $this->page_model->get_itemdetails_by_branch_day($branch, $date);
			// echo '<pre>';
			// print_r($data);die;
		}else{
		$data = $this->page_model->get_itemdetails_by_branch($branch);
			}
		// echo '<pre>';
		// print_r($data);die;
					$total = 0;$t_com=0;$i = 1;
					foreach ($data as $val) {
						$pri = $this->admin_model->get_price_by_itemname($val['items']); 
						
						$cash = $val['deli'] * $pri[0]['price'];
						$total += $cash;
						
						$sold=0;
						$stocks = $this->page_model->get_stocks_for_branch_item($branch, $val['items']);
						// print_r($stocks);die;
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['items'].'</td>';
						// echo '<td>'.$val['modified_date'].'</td>';
						echo '<td>'.$val['deli'].'</td>';
						echo '<td>'.$pri[0]['price'].'</td>';
						echo '<td>'.$cash.'</td>';
						foreach ($stocks as $del) {
							$stk = $del['sum(quantity)'] - $val['deli'];
							$comm = $del['commission'] * $val['deli'];
							$t_com += $comm;
							echo '<td>'.$del['commission'].'</td>';
							echo '<td>'.$comm.'</td>';
							echo '<td>'.$del['sum(quantity)'].'</td>';
							echo '<td>'.$stk.'</td>';
						}
						

						echo '</tr>';
					$i++; }
					if (empty($data)){
						echo "<p style='color: red' class='ml-4'>No Data To Display</p>";
					}
						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><b>Total = </b></td>';
						echo '<td><b>'.$total.'</b></td>';
						echo '<td></td>';
						echo '<td><b>'.$t_com.'</b></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '</tr>';		
	}

		public function get_stocks(){
		$loc = $this->session->userdata('location');
		// print_r($_POST);die;
		$branch = $_POST['branch'];
		$date = $_POST['date'];
		if ($branch == "all" && $_POST['date'] == null ){
			// $data = $this->page_model->branchstocks_all();
			echo '<td colspan="12" style="text-align: center;">Please Select At Least One field.</td>';die;
		}elseif($_POST['date'] && $_POST['branch'] == "all"){
			$data = $this->page_model->fetch_stocks_by_day($date);

		}elseif($branch && $date == null){
			$data = $this->page_model->fetch_stocks_by_branch($branch);

		}elseif($_POST['date'] && $_POST['branch']){
			$data = $this->page_model->fetch_stocks_by_branch_date($branch, $date);
		}else{
		$data = $this->page_model->fetch_stocks_by_branch($branch);

			}
			$i = 1;$total =$t_com=$tot_rem=0;$stkss=0;
			foreach ($data as $val) {						
			$sold=0;
			$deli_only = $this->page_model->count_deli_only($val['item_name'], $val['branch']);
			$ddd=0;
			foreach ($deli_only as $kkey => $get) {
				$ddd = $get['deli'];
			}	
			$stkss = $val['sum(quantity)'] - $val['sum(returned_qty)'];
			$rem = $stkss - $ddd;
			$tot_rem += $rem;
			
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['branch'].'</td>';
						echo '<td>'.$val['item_name'].'</td>';
						echo '<td>'.$val['price'].'</td>';
						echo '<td>'.$val['commission'].'</td>';
						echo '<td>'.$stkss.'</td>';
						echo '<td>'.$val['extra_quantity'].'</td>';
            			echo '<td>'.$ddd.'</td>';
            			echo '<td>'.$rem.'</td>';
            			echo '<td>'.$val['sent_date'].'</td>';
						
						echo '</tr>';
					$i++; }
					if (empty($data)){
						echo "<td colspan='12' style='color: red;text-align: center;' class='ml-4'>No Result Found</td>";die;
					}
						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><b>Total = </b></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><b>'.$tot_rem.'</b></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '</tr>';		
	}

	public function get_cash_due(){
		// echo $_POST['date'];
		// print_r($_POST);die;
		$branch = $_POST['branch'];
		$data['branch'] = $branch;
		$date = $_POST['date'];
		if ($branch == "all" && $_POST['date'] == null ){
			$data['datas'] = $this->page_model->get_itemdetails();
		}elseif($_POST['date'] && $_POST['branch'] == "all"){
			$data['datas'] = $this->page_model->get_itemdetails_by_day($date);
			// echo '<pre>';
			// print_r($data);die;
		}elseif($_POST['date'] && $_POST['branch']){
			$data['datas'] = $this->page_model->get_itemdetails_by_branch_day($branch, $date);
		}else{
		$data['datas'] = $this->page_model->get_itemdetails_by_branch($branch);
			}
		// echo '<pre>';
		// print_r($data);die;
			if (!empty($data)){
					$this->load->view('admin/show_ajax', $data);
				}else{
					echo "<p style='color: red' class='ml-4'>No Data To Display</p>";
					
					}
	}

	

	public function delete_location(){
		$tid = $this->uri->segment(3,1);
		$dd = $this->db->delete('location_info', array('id' => $tid));
		redirect('admins/add_location');
	}

	public function cash_flow(){
		$data['item'] = $this->uri->segment(3,1);
		// $data['qty'] = $this->uri->segment(4,1);
		// $data['price'] = $this->uri->segment(5,1);
		// $data['amt'] = $this->uri->segment(6,1);
		// $data['stk'] = $this->uri->segment(7,1);
		// $data['branch'] = $this->uri->segment(8,1);
		// $data['commission'] = $this->uri->segment(9,1);
		// $data['prev_due'] = $this->uri->segment(10,1);
		// $data['url'] = $this->uri->segment(9,0);

		$this->load->view('includes/header');
		$this->load->view('admin/test', $data);
		$this->load->view('includes/footer');
	}

	public function edit_cashflow(){
		$data['tid'] = $this->uri->segment(3,1);
		$data['transaction'] = $this->page_model->get_transaction_record_by_id($data['tid']);
		$data['added'] = $this->admin_model->get_stock($data['tid']);

		$this->load->view('includes/header');
		$this->load->view('admin/edit_cashflow', $data);
		$this->load->view('includes/footer');
	}

	public function item_purchased(){
		$data['title'] = "View Items Details";
		$data['items'] = $this->admin_model->get_items();
		// $data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/purchased', $data);
		$this->load->view('includes/footer');
	}

	public function view_purchased(){
		$data['title'] = "View Items Details";
		$data['purchases'] = $this->page_model->get_items_purchased();
		// $data['branch'] = $this->page_model->get_branch_name();

		$this->load->view('includes/header');
		$this->load->view('admin/view_purchased', $data);
		$this->load->view('includes/footer');
	}

	public function view_returned_items(){
		$data['title'] = "View Items Details";
		$config['base_url'] = site_url('admins/view_returned_items');
		$config['total_rows'] = $this->page_model->countAll('items_returned');
		$config['per_page'] = 25;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

        $config["num_links"] = floor($choice);

        /* This Application Must Be Used With BootStrap 4 *  */
$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] 	= '</ul></nav></div>';
$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] 	= '</span></li>';
$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close'] 	= '</span></li>';
$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['last_tagl_close'] 	= '</span></li>';
		
		$this->pagination->initialize($config);		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['ret'] = $this->page_model->get_items_returned($config['per_page'],$data['page']);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('includes/header');
		$this->load->view('admin/view_returned_items', $data);
		$this->load->view('includes/footer');
	}

  	public function filter_records_by_date(){
  		$branch = $this->input->post('branch');
  		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
  		// print_r($_POST);die;

  		if (!empty($branch) && empty($start_date) && empty($end_date) ){
			$rec = $this->page_model->get_entire_transactions_branch($branch); // branch only
			// echo "branch only";die;
		}else if (!empty($start_date) && $end_date == null && $branch == null){
			$rec = $this->page_model->get_all_transactions_day($start_date); // start only
			// echo "start only";die;
		}else if (!empty($start_date) && !empty($end_date) && empty($branch)){
			$rec = $this->page_model->get_all_transactions_daterange($start_date, $end_date); // date range
			// echo "date range";die;
		}else if (!empty($start_date) && !empty($end_date) && !empty($branch)){
			$rec = $this->page_model->get_all_transactions_daterange_branch($start_date, $end_date,$branch); // branch & date
			// echo "branch & date";die;
		}else if (!empty($start_date) && empty($end_date) && !empty($branch)){
			$rec = $this->page_model->get_all_transactions_start_branch($start_date,$branch); // branch & start date
			// echo "branch & start date";die;
		}else{
			$rec = $this->page_model->get_entire_transactions();
			// echo "all";die;
		}

		$i =1;$due=0;$diff=0;$instk=0;
        $total_due=$net_sp=$total_amt=$total_net=$old=$tot_old=$t_ppaid=0;$stkss=$tot_stkss=$tot_del=$tot_ext_comm=$only_ext_comm=$stok=$extra_comm=0;
            foreach ($rec as $key => $val) {
                // $diff = $val['net_amount'] - $val['paid_amount'];
                // $due = $diff + $val['due_amount'];
                // $total_due += $diff;  
                
                
                $deli_only = $this->page_model->count_deli_only($val['item_name'], $val['branch']);
                $dd =$amt=$ppaid=0;
                    foreach ($deli_only as $kkey => $get) {
                        $ppaid = $val['paid_amount'];
                        $ddd = $get['deli'];
                        $dd = $ddd;
                        $tot_del += $ddd;
                        $amt = ($val['price'] - $val['commission']) * $dd;
                        
                        $total_due += $diff;
                        $total_amt += $ppaid;
                        $total_net += $amt;
                    }
                    $tot_ext_comm = $val['paid_amount'];
                    $net_sp = $val['price'] - $val['commission'];
					$net_spp = $val['price'] - $val['commission'] -$val['extra_commission'];	
					// echo $net_sp;
					$stkss = $val['sum(quantity)'] - $val['sum(returned_qty)'] -$val['extra_quantity'];	
					$stok = $val['sum(quantity)'] - $val['sum(returned_qty)'];				
					$old = ($net_sp * $stkss) + (($net_spp-50) * $val['extra_quantity']);


                    // $ppaid = $val['paid_amount'];
                    $t_ppaid += $tot_ext_comm;
                    $tot_stkss += $stkss;
					// $old = $net_sp * $stok;
					$only_ext_comm = ($net_sp - 50) * $val['extra_quantity'];
					$extra_comm += $val['extra_commission'];
					$diff = $old - $tot_ext_comm;
					// echo $only_ext_comm;die;
					// $old = $old + $only_ext_comm;
					$tot_old += $old;
                    echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$val['transaction_date'].'</td>';
                        echo '<td>'.$val['item_name'].'</td>';
                        echo '<td>'.$val['branch'].'</td>';
                        echo '<td>'.$stok.'</td>';
                        echo '<td>'.$val['extra_quantity'].'</td>';
                        echo '<td>'.$val['price'].'</td>';
                        echo '<td>'.$val['commission'].'</td>';
                        
                        if ($val['price'] != 0){
                            echo '<td>'.$dd.'</td>';
                        }else{
                            echo '<td>0</td>';
                        }
                        
                        echo '<td>'.$amt.'</td>';
                        echo '<td>'.$val['extra_commission'].'</td>';
                        echo '<td>'.$old.'</td>';
                        if (!empty($val['paid_amount'])){
                            echo '<td><button class="btn btn-success paid_amount">'.$tot_ext_comm.'</button></td>';
                        }else{
                            echo '<td>'.$tot_ext_comm.'</td>';
                        }
                        
                        if ($val['item_name'] == null){
                        	echo '<td>-</td>';
						}else{
							echo '<td>'.$diff.'</td>';
						}
                        
                    echo '</tr>';
                $i++; } 
                if (empty($rec)){
                    echo '</tr>';
                    echo '<tr>';
                    	echo '<td colspan="12" style="text-align: center;color: red;">No Records Found</td>';
                    echo '</tr>';
                }else{
                    $gt = $tot_old-$t_ppaid;
                    echo '<tr>';
                        echo '<td><b>Total: </b></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        
                        echo '<td>'.$tot_stkss.'</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td>'.$tot_del.'</td>';
                        echo '<td><b>'.$total_net.'</b></td>';
                        echo '<td>'.$extra_comm.'</td>';
                        echo '<td><b>Rs. '.$tot_old.'</b></td>';
                        echo '<td><b>Rs. '.$t_ppaid.'</b></td>';
                        if ($gt >= 0){
                        echo '<td><button class="btn btn-danger">Rs. '.$gt.'</b></td>';
                    	}else{
                    		echo '<td><button class="btn btn-secondary">Rs. '.$gt.'</b></td>';
                    	}
                    }
  	}


  	public function daily_notes(){
  		$data['loca'] = $this->admin_model->get_location();
		$data['note'] = $this->page_model->fetch_notes_daily();

		$this->load->view('includes/header');
		$this->load->view('admin/daily_notes', $data);
		// $this->load->view('includes/footer');
	}
}//main class loop
