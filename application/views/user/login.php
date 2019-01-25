<?php
$user_id=$this->session->userdata('user_id');
// echo $user_id;
if($user_id){

  redirect('pages/home');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sastoshowroom Login Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_front/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_front/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_front/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> -->
<!--===============================================================================================-->	
	<!-- <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> -->
<!--===============================================================================================-->	
	<!-- <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_front/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_front/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?= base_url() ?>assets_front/login/images/bg-01.jpg');">
	
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
	<?php
if($this->session->flashdata('login_error')): 
    echo '<p class="alert alert-danger wrn">'.$this->session->flashdata('login_error').'</p>'; 
  endif; 
		?>

<?php if($this->session->flashdata('session_error')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('session_error').'</p>'; 
  endif; ?>

  <?php if($this->session->flashdata('error_message')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('error_message').'</p>'; 
  endif; ?>
				<form action="" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Sastoshowroom Login Form
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Type your username" autocomplete="off" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" id="submit" name="login" class="login100-form-btn">
								Login
							</button>
							<!-- <input type="submit" id="submit" class="form-control sub_log" name="login" value="Submit"> -->
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	


</body>
</html>