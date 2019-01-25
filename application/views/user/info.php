<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><?= $title?></li>
    </ul>
  </div>

<?php if($this->session->flashdata('post_updated')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; 
  endif; ?>
<?php if($this->session->flashdata('post_deleted')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>'; 
  endif; ?>
<div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
<a style="float: right;" class="btn btn-success" href="adduser">+ Add New User</a>

<h3 style="color: green;">Existing Users</h3>
<table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>User Id</th>
                <th>Username</th>
                <th>User Type</th>
                <th>Location</th>
                <th>Status</th>
              </tr>  
            </thead>
           <?php
           foreach ($list_user as $key) {
           // print_r($list_user);die();
           ?>
            <tbody>
            	<tr>
            		<td><?php if($key['user_type'] != 'SuperAdmin'){ echo $key['user_id']; }else{echo '**'; } ?></td>
            		<td><?php if($key['user_type'] != 'SuperAdmin'){ echo $key['user_name']; }else{echo '********'; }?></td>
            		<td><?php echo $key['user_type']; ?></td>
                <td><?php echo $key['location']; ?></td>
                <td><a class="
                  <?php
                  if($key['status'] == 'Active'){
                    echo 'btn btn-info btn-sm';
                  }elseif($key['status'] == 'Pending'){
                    echo 'btn btn-default btn-sm';
                  }else{
                    echo 'btn btn-danger btn-sm';
                  }
                  ?>"><?php echo $key['status']; ?><a>

                   <?php 
                  if($key['user_type'] != 'SuperAdmin'){ ?><a class="btn btn-warning btn-sm" href="edituser/<?= $key['user_id'] ?>">Edit</a><?php } ?>
                  
                  <?php 
                  if($key['user_type'] != 'SuperAdmin'){ ?>
                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="return confirmDialog(<?php echo $key['user_id']; ?>);">Delete</a>
                 <?php }  ?>
                  </td>

                  </td>
            	</tr>
            	<?php  } ?>
            </tbody>
  </table>
  </div>
</div>
</div>
</div>

</main>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script type="text/javascript">
    var url="<?php echo base_url();?>";
    function confirmDialog(id){
       // alert(id);
        var r=confirm("Confirm Delete this User?")
        if (r==true)
          window.location = url+"user/deleteuser/"+id;
        else
          return false;
        } 
</script>