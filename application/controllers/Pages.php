<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __Construct()
	{
		parent::__Construct();
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->model('user_model');	
		$this->load->model('page_model');
		$this->load->model('admin_model');
		$user_id = $this->session->userdata('user_id');
		$user_itype = $this->session->userdata('user_type');
		$branch = $this->session->userdata('location');	
	}
	
	public function view(){
			// if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			// 	show_404();
			// }
			$data['title'] = "sjhad";
			// $data['title'] = ucfirst($page);

			$this->load->view('templates/header_new');
			$this->load->view('pages/home',$data);
			$this->load->view('templates/footer');
		}

		// public function data_entry(){
		// 	$data['title'] = 'Hllo';
		// 	$data['entry'] = $this->admin_model->get_items();
		// 	$data['loca'] = $this->admin_model->get_location();

		// 	$this->load->view('templates/header_new');
		// 	$this->load->view('pages/data_entry', $data);
		// 	$this->load->view('templates/footer');
		// } 

		public function view_entry(){
			$user_id = $this->session->userdata('user_id');	
			$user_type = $this->session->userdata('user_type');
			$loc = $this->session->userdata('location');
			$data['location'] = $this->page_model->get_branch_name();
			$data['stocks'] = $this->page_model->get_stocks_for_branch($loc);
			$data['numb'] = $this->page_model->get_view_entry_products($loc);
			
			$config['base_url'] = site_url('pages/view_entry');
		$config['total_rows'] = $this->page_model->countAll('data_entry');
		$config['per_page'] = 100;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];

        // $config["num_links"] = floor($choice);

        /* This Application Must Be Used With BootStrap 4 *  */
$config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
$config['full_tag_close'] 	= '</ul></nav></div>';
// $config['first_link'] = 'First';
// $config['first_tag_open'] = '<li>';
// $config['first_tag_close'] = '</li>';
$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
$config['num_tag_close'] 	= '</span></li>';

$config['prev_link'] = 'Prev';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
//For NEXT PAGE Setup
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
		// $count_all = $this->page_model->countAll("data_entry");

		// $data['items'] = $this->admin_model->get_items_range($config['per_page'],$data['page']);
		if ($user_type == 'User' || $user_type == 'Branch'){
			$data['records'] = $this->page_model->view_entry_records_user($loc,$config['per_page'],$data['page']);
			$data['rec'] = $this->page_model->view_entry_records_user_wl($loc);
				}else if ($user_type == 'SuperAdmin' || 'Admin'){
				$data['records'] = $this->page_model->view_entry_records($user_id);
				}
		$data['pagination'] = $this->pagination->create_links();

			
			$this->load->view('templates/header_new');
			$this->load->view('pages/view_entry', $data);
			$this->load->view('templates/footer');
		} 

		public function item_details(){
			$user_id = $this->session->userdata('user_id');	
			$user_type = $this->session->userdata('user_type');
			$loc = $this->session->userdata('location');

			if ($user_type == 'User' || $user_type == 'Branch'){
			$data['details'] = $this->page_model->get_itemdetails_by_branch($loc);
			}else if ($user_type == 'SuperAdmin' || $user_type == 'Admin'){
				$data['details'] = $this->page_model->get_itemdetails();
			}
			$this->load->view('templates/header_new');
			$this->load->view('pages/view_item_details', $data);
			$this->load->view('templates/footer');
		}

		public function stocks_info(){
			$user_id = $this->session->userdata('user_id');	
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";
			$data['user_info'] = $this->user_model->get_user_info($user_id);
			$data['user_eff'] = $this->user_model->get_user_eff($loc);
			$data['stocks'] = $this->page_model->get_stocks_for_branch($loc);

			$this->load->view('templates/header_new');
			$this->load->view('pages/user_info', $data);
			$this->load->view('templates/footer');
		}

		public function show_stocks(){
			$user_id = $this->session->userdata('user_id');	
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";
			$data['stocks'] = $this->page_model->get_stocks_for_branch($loc);
			$data['user_eff'] = $this->user_model->get_user_eff($loc);
			// $data['deliver'] = $this->page_model->get_cashflow_record_item_branch($loc);

			$this->load->view('templates/header_new');
			$this->load->view('pages/show_stocks', $data);
			$this->load->view('templates/footer');
		}

		public function cancelled(){
			$user_id = $this->session->userdata('user_id');	
			$user_type = $this->session->userdata('user_type');
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";

			$config['base_url'] = site_url('pages/cancelled');

			$cout = $this->page_model->count_deli($loc);
			$count = count($cout);
		$config['total_rows'] = $count;
		$config['per_page'] = 100;
        $config["uri_segment"] = 3;
        $choice = $count / $config["per_page"];

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
		// $count_all = $this->page_model->countAll("data_entry");

			if ($user_type == 'Admin' || $user_type == 'SuperAdmin'){
			$data['canc'] = $this->page_model->cancelled_rec_all();
			}else{
			$data['canc'] = $this->page_model->cancelled_rec($loc);
			}
			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('templates/header_new');
			$this->load->view('pages/cancelled', $data);
			$this->load->view('templates/footer');
		}

	public function later(){
			$user_id = $this->session->userdata('user_id');	
			$user_type = $this->session->userdata('user_type');
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";

			$config['base_url'] = site_url('pages/later');

			$cout = $this->page_model->count_deli($loc);
			$count = count($cout);
		$config['total_rows'] = $count;
		$config['per_page'] = 100;
        $config["uri_segment"] = 3;
        $choice = $count / $config["per_page"];

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
		// $count_all = $this->page_model->countAll("data_entry");

			if ($user_type == 'Admin' || $user_type == 'SuperAdmin'){
			$data['later'] = $this->page_model->count_later();
			}else{
			$data['later'] = $this->page_model->count_later_branch($loc);
			}
			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('templates/header_new');
			$this->load->view('pages/call_not_received', $data);
			$this->load->view('templates/footer');
		}

	public function transactions(){
			$user_id = $this->session->userdata('user_id');	
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";
			$data['all'] = $this->page_model->get_all_transactions($loc);

			$this->load->view('templates/header_new');
			$this->load->view('pages/transactions', $data);
			$this->load->view('templates/footer');
		}

	public function return_items(){
			$user_id = $this->session->userdata('user_id');	
			$loc = $this->session->userdata('location');	
			$data['title'] = "User Info";
			$data['stocks'] = $this->page_model->get_stocks_for_branch($loc);
			$data['return'] = $this->page_model->fetch_returned_items($loc);

			$this->load->view('templates/header_new');
			$this->load->view('pages/return_items', $data);
			$this->load->view('templates/footer');
		}

	public function interested(){
		$user_id = $this->session->userdata('user_id');	
		$user_type = $this->session->userdata('user_type');
		$loc = $this->session->userdata('location');	
		$data['title'] = "User Info";
		$config['base_url'] = site_url('pages/interested');
		$cout = $this->page_model->count_interested($loc);
		$count = count($cout);
		$config['total_rows'] = $count;
		$config['per_page'] = 30;
        $config["uri_segment"] = 3;
        $choice = $count / $config["per_page"];

        $config["num_links"] = floor($choice);
        // echo $config['num_links'];
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
		// $count_all = $this->page_model->countAll("data_entry");

			if ($user_type == 'Admin' || $user_type == 'SuperAdmin'){
			$data['inter'] = $this->page_model->count_interested_admin();
			}else{
			$data['inter'] = $this->page_model->count_interested($loc);
			}
			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('templates/header_new');
			$this->load->view('pages/interested', $data);
			$this->load->view('templates/footer');
		}

	
	public function daily_entry(){
		$data['tid'] = $this->uri->segment(3, 1);
		$yes = date('Y.m.d',strtotime("-1 days"));
		$user_id = $this->session->userdata('user_id');	
		$user_type = $this->session->userdata('user_type');
		$loc = $this->session->userdata('location');
		$data['daily_stk'] = $this->page_model->daily_entry_stk($loc, $data['tid']);
		$data['daily'] = $this->page_model->daily_entry_list($loc);
			$this->load->view('templates/header_new');
			$this->load->view('pages/daily_entry', $data);
			$this->load->view('templates/footer_oth');
	}
}