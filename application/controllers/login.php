<?php 
class Login extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->load->model("login_model");
		$this->load->helper('url');
		// $this->load->model("upload_model");
	}
	
	public function index()
	{	
		$this->data['error_message'] = "";
		if(isset($_POST['login']))
		{	
			$session = $this->session->userdata('isLogin');
			// print_r($_POST);die();
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			 
			// echo $username;
			// echo $password;
			$login_condition = array("user_name"=>$username, "user_password"=>$password, "status"=>'active');
			$user_data = $this->login_model->userLogin($login_condition);
			
			if($user_data !== FALSE)
			{
				$user_id = $user_data['user_id'];
				// echo "logged_in" . $user_id;
				// die();
				
				$this->session->set_userdata("user_id", $user_id);				
				$this->session->set_userdata("username", $user_data['user_name']);

			redirect('admins/index');
							}	
			else
			{
				$this->session->set_flashdata('login_error', 'Username/Password not matched.');
			}
		}		
		$this->load->view("user/login", $this->data);
	}
	public function logout()
	{
		$this->session->unset_userdata("username");
		$this->session->unset_userdata("status");
		$this->session->sess_destroy();
		redirect("login");
	}
}
?>