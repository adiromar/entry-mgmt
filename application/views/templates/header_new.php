<?php
$user_id=$this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
$username=$this->session->userdata('user_name');
$branch=$this->session->userdata('location');
// echo $username;die;

if($user_id != true ){
	$this->session->set_flashdata('session_error', '<b>Session Ended. Re-Login </b>to continue');
	redirect('user/index');
}else{
  // redirect('pages/view_entry');
}

if ($user_type == 'User' || $user_type == 'Branch'){
    $records = $this->page_model->view_entry_records_user_wl($branch);
    $check=0;$chk=0;
    foreach ($records as $key => $val) {
      $check = $val['not_del'] - $val['can'];
    }
}else{
  $check = "0";
}

// check for daily notes updating
if ($user_type == 'User' || $user_type == 'Branch'){
  $entry_exists = $this->page_model->fetch_delivered_recent($branch);
  if ($entry_exists == true){
    $daily = $this->page_model->check_daily_notes($branch);
  }else{
    
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Amaryllis 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140131

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sastoshowroom</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" /> -->
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php echo base_url();?>assets_front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/simple-sidebar.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets_front/css/fonts.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
  <style>
    body{
      font-family: Arial, Helvetica, sans-serif;
    }
</style>


<div id="header-wrapper">
  <div class="row">
	<div id="header" class="col-md-12 col-sm-9 col-xs-9">
		<div class="mt-0 logo-header"><a href="<?= base_url(); ?>pages/view_entry"><img src="<?php echo base_url();?>assets_front/logoname.png"></a></div>
	</div>

  <div class="col-sm-3 col-xs-3 float-right">
    <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
  </div>
</div>

    <div class="topnavs" id="menus" style="display: none;">
      <p class="listcc">Welcome, <?= $username?></p>

      <?php if ($user_type == 'SuperAdmin' || $user_type == 'Admin') { ?>
      <p class="listcc"><a href="<?php echo base_url('admins/index');?>">Admin Section</a></p>
<?php } ?>

      <p class="listcc"><a href="<?php echo base_url(); ?>pages/view_entry" class=""><span>View Entry</span><span class="badge"><?= $check ?></span></a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/item_details" class="">Report</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/stocks_info" class="">Stocks Info</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/transactions" class="">Transactions</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/interested" class="">Confirmed</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/cancelled" class="">Delivered/Cancelled</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/later" class="">Later/Call Not Received</a></p>
      <p class="listcc"><a href="<?php echo base_url(); ?>pages/return_items" class="">Return Items</a></p>
      <!-- <p class="listcc"><a href="<?php echo base_url(); ?>pages/daily_entry" class="">Daily Entry</a></p> -->
      <p class="listcc"><a href="<?php echo base_url('user/logout');?>">Log Out</a></p>
    </div>

    <div id="menu" class="ml-5 mt-4 topnav">
          <a href="<?php echo base_url(); ?>pages/view_entry" class="notification"><span>View Entry</span><span class="badge">
            <?= $check ?>
            </span></a>
          <a href="<?php echo base_url(); ?>pages/interested" class="notification">Confirmed</a>

          <a href="<?php echo base_url(); ?>pages/item_details" class="notification">Report</a>
        <!-- </li> -->

        <?php if ($user_type == 'User' || $user_type == 'Branch'){ ?>
        <!-- <li class="btn"> -->
          <a href="<?php echo base_url(); ?>pages/stocks_info" class="notification">Stocks Info</a>
        <?php } ?>

        <a href="<?php echo base_url(); ?>pages/transactions" class="notification">Transactions</a>

        <a href="<?php echo base_url(); ?>pages/cancelled" class="notification">Delivered/Cancelled</a>

        <a href="<?php echo base_url(); ?>pages/later" class="notification">Later/Call Not Received</a>

        <a href="<?php echo base_url(); ?>pages/return_items" class="notification">Return Items</a>
        <!-- <a href="<?php echo base_url(); ?>pages/daily_entry" class="notification">Daily Entry</a> -->

        
    </div>

</div>

<div class="dropdown float-right mr-4" style="margin-top: -35px;">
  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #fff;color: black;border: none;">
    Welcome, <?= $username ?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php if ($user_type == 'SuperAdmin' || $user_type == 'Admin') { ?>
    <a href="<?php echo base_url('admins/index');?>" accesskey="5" title="">Admin Section</a>
<?php } ?>

    <a href="<?php echo base_url('user/logout');?>">Log Out</a>

  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("menu");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

$("li").click(
    function(event) {
      $('li').removeClass('active');
      $(this).addClass('active');
      event.preventDefault()
    }
);
</script>
<script type="text/javascript">
  window.onload = function(){
    <?php if($daily != true): ?>
    $('#checks').click();
    <?php endif; ?>
  <?php if($check >= 10) : ?>
    // var chk = $chk;
    // alert(chk);
            // $('#myID').show();
            $('#check').click();
        <?php else : ?>
            // $('#mySecondID').show();
        <?php endif; ?>
    }

function myFunction() {
    var x = document.getElementById("menus");
    // x.classList.toggle("mystyle");
    document.getElementById("menus").style.display = "block";
    if (x.className === "topnavs") {
        x.className += " responsive mystyle";
    } else {
        x.className = "topnavs";
        document.getElementById("menus").style.display = "none";
    }
}

</script>