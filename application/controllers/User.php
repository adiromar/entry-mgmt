<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __Construct()
	{
		parent::__Construct();
		$this->load->model("user_model");
		$this->load->helper('url');
		$this->load->model("admin_model");
	}

	public function index()
	{	
		$this->data['error_message'] = "";
		if(isset($_POST['login']))
		{	
			$session = $this->session->userdata('isLogin');
			// print_r($_POST);die();
			$username = $this->input->post("username");
			$password = sha1($this->input->post("password"));
			 
			// echo $username;
			// echo $password;die;
			$login_condition = array("user_name"=>$username, "user_password"=>$password, "status"=>'active');
			$user_data = $this->user_model->userLogin($login_condition);
			
			if($user_data !== FALSE)
			{
				$user_id = $user_data['user_id'];
				$user_type = $this->user_model->get_user_type($user_id);
				$type = $user_type[0]['user_type'];
				$user_location = $user_type[0]['location'];
				// echo $user_location;
				// echo "logged_in" . $user_id;echo $type;die;
				// die();
				
				$this->session->set_userdata("user_id", $user_id);			
				$ty = $this->session->set_userdata("user_type", $type);
				$this->session->set_userdata("user_name", $username);
				$this->session->set_userdata("location", $user_location);

				$this->session->set_userdata("username", $user_data['user_name']);
				if ($type == 'User'){
					redirect('pages/view_entry');
				}elseif ($type == 'Branch'){
					redirect('pages/view_entry');
				}elseif ($type == 'Admin'){
					redirect('admins/index');
				}
			redirect('admins/index');				
						}	
			else{
				$this->session->set_flashdata('login_error', 'Username/Password not matched.');
			}
		}		
		$this->load->view("user/login", $this->data);
	}

	public function info()
	{
		$this->load->model('user_model');
		$data['list_user'] = $this->user_model->check_user();

		$data['title'] = "User Mgmt";
		$this->load->view('includes/header');
		$this->load->view('user/info', $data);
		$this->load->view('includes/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata("username");
		$this->session->unset_userdata("status");
		$this->session->sess_destroy();
		redirect("user/index");
	}

	public function adduser()
	{
		$data['title'] = "Add New User";
		// $log_data = array("user_name"=>$username, "user_password"=>$password, "status"=>'active');
		// 	$user_data = $this->user_model->adduser($log_data);
		$data['show_location'] = $this->admin_model->get_location();

		$this->load->view('includes/header');
		$this->load->view('user/adduser', $data);
		$this->load->view('includes/footer');
	}

	public function insertuser()
	{
		// print_r($_POST);die();
		// $data['title'] = "Add New User";
		
		if(isset($_POST['user_add'])){
			
			$firstname =$this->input->post('firstname');
			$lastname =$this->input->post('lastname');
			$username =$this->input->post('username');
			$password =$this->input->post('password');
			$location =$this->input->post('location');
			$user_type =$this->input->post('user_type');
			$email =$this->input->post('email');
			$status =$this->input->post('status');

			$log_data = array(
					'firstname'=>$firstname,
					'lastname'=>$lastname,
			        'user_name'=>$username,
			        'user_password' => sha1($password),
			        'email' => $email,
			        'location' => $location,
			        'user_type' => $user_type,
			        'status' =>$status
			    );
			
			$d = $this->user_model->insertUser($log_data);
			// print_r($d);
			redirect("user/info");
		}
		
	}

	public function edituser($id)
	{
		
		// $data['title'] = "Add New User";
		$data['title'] = "Edit User";
		// $log_data = array("user_name"=>$username, "user_password"=>$password, "status"=>'active');
		// 	$user_data = $this->user_model->adduser($log_data);
		$data['get_user'] = $this->user_model->get_user($id);
		$data['location'] = $this->admin_model->get_location();
		$this->load->view('includes/header');
		$this->load->view('user/edituser', $data);
		$this->load->view('includes/footer');

		$tablename = 'user_login';
		// print_r($_POST);die();
		if(isset($_POST['user_edit'])){
			// echo "hello";
			$id = $this->input->post('user_id');
			$firstname =$this->input->post('firstname');
			$lastname =$this->input->post('lastname');
			$username =$this->input->post('username');
			$password =$this->input->post('password');
			$location =$this->input->post('location');
			$user_type =$this->input->post('user_type');
			$email = $this->input->post('email');
			$status =$this->input->post('status');
			
			$log_data = array(
					'firstname'=>$firstname,
					'lastname'=>$lastname,
			        'user_name'=>$username,
			        'user_password' => sha1($password),
			        'email' => $email,
			        'location' => $location,
			        'user_type' => $user_type,
			        'status' =>$status
			    );
			
			$d = $this->user_model->update_user($tablename, $log_data, $id);
			// print_r($d);
			redirect("user/info");
		}
		
	}
	
	public function deleteuser()
	{
		$str = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$id = explode("/", $str, 5);
		// echo $id[4];die();
		// echo "delete user";	
		$this->db->where("user_id",$id[4]);
    	$this->db->delete('user_login');
    	// return $this->db->affected_rows();
    	redirect("user/info");
	}
}





