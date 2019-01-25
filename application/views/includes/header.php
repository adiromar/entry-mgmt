<?php
$user_id=$this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
$user_name=$this->session->userdata('user_name');
// echo $user_id;die;
if($user_id = true && $user_type == 'SuperAdmin' || $user_type == 'Admin'){

}elseif ($user_id != true){
  redirect('user/index');
}else{
  redirect('pages/view_entry');
}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Sastoshowroom Admin</title>
  </head>
  <body class="app sidebar-mini sidenav-toggled">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Sasto</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"></a>
      <!-- Navbar Right Menu-->

      <ul class="app-nav">
        <li><a class="app-nav__item" href="<?php echo base_url(); ?>admins/view_stocks">View Stocks</a></li>
        <li><a class="app-nav__item" href="<?php echo base_url(); ?>admins/view_cash_flow">Transactions</a></li>
        <li><a class="app-nav__item" href="<?php echo base_url(); ?>admins/view_report"> Report</a></li>
        

        <li><a class="app-nav__item" href="<?php echo base_url(); ?>pages/view_entry" target="_blank">Website</a></li>
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
          
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i><?php echo $user_name;?></a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('user/logout');?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            <li></li>
          </ul>
        </li>
      </ul>
    </header>

<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"> -->
        <!-- <div>
          <p class="app-sidebar__user-name">Wump Admin</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div> -->
      <!-- </div> -->
      <div id="accordion">
      <ul class="app-menu">
        <!-- <li><a class="app-menu__item" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample"><i class="app-menu__icon fa fa-angle-down"></i>
        Insert</a></li> -->

        <!-- <div class="collapse show" id="collapseExample"> -->
          <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/item_purchased"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Item Purchases</span></a></li>

            <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/add_location"><i class="app-menu__icon fa fa-map-marker"></i><span class="app-menu__label">Add Location</span></a></li>

            <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/add_items"><i class="app-menu__icon fa fa-plus"></i><span class="app-menu__label">Add New Items</span></a></li>
        <!-- </div> -->

        <!-- <hr> -->

        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/view_items"><i class="app-menu__icon fa fa-eye"></i><span class="app-menu__label">View Items</span></a></li> -->

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/send_items_to_branch"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Send Items TO Branch</span></a></li>

        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/view_branch_items"><i class="app-menu__icon fa fa-eye"></i><span class="app-menu__label">View Items (Branch)</span></a></li> -->

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/index"><i class="app-menu__icon fa fa-wpforms"></i><span class="app-menu__label">Data Entry</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/add_delivery"><i class="app-menu__icon fa fa-plus"></i><span class="app-menu__label">Add Delivery Status</span></a></li>

        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/entry_log"><i class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label">Entry Log</span></a></li> -->

        <!-- <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/transaction"><i class="app-menu__icon fa fa-dollar"></i><span class="app-menu__label">Cash Flow</span></a></li> -->
        
        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/cash_entry"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Transaction Entry</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/view_cash_flow"><i class="app-menu__icon fa fa-eye"></i><span class="app-menu__label">View Transactions</span></a></li>
        <hr>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/view_returned_items"><i class="app-menu__icon fa fa-undo"></i><span class="app-menu__label">Returned Items</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/daily_notes"><i class="app-menu__icon fa fa-sticky-note"></i><span class="app-menu__label">Daily Notes</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>user/info"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User Management</span></a></li>

        <li><a class="app-menu__item" href="<?php echo base_url(); ?>admins/backup"><i class="app-menu__icon fa fa-download"></i><span class="app-menu__label">Backup Database</span></a></li>
        
      </ul>
    </div>
    </aside>

<script type="text/javascript">
function AlertIt() {
  var answer = confirm ("UnAuthorized User Access. For Super Admin Only")
  if ((answer)==true){
    window.location="<?= base_url(); ?>admins/index";
  }
window.location="#";
}
</script>