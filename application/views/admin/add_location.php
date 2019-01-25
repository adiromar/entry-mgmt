  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Add Location</h1>
      <p>Set your Item name and Fields:</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>
<?php if($this->session->flashdata('location_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('location_added').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('location_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('location_error').'</p>'; 
  endif; ?>
<style type="text/css">
  .hr{
    border-top: 2px solid #d9cdcd;
    padding-top: 10px;
  }

  .app_div{
    border: 2px solid #b9b3b3;
    padding: 12px;
    margin-top: 15px;
    border-radius: 36px;
  }
</style>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<?php // echo form_open('posts/insert_location', array('class' => 'mt-4', 'id' => 'form', 'name' => 'location')) ?>
          <form method="post" action="<?= base_url(); ?>posts/insert_location" class="mt-4" id="form" name="loc" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-md-3 col-sm-3 col-lg-3">
        			<label>Location Name: </label>
        			<input type="text" name="location" class="form-control" required>
        		</div>

            <div class="col-md-3 col-lg-3 col-sm-3 mt-4">
        			<input type="submit" name="submit" class="btn btn-success" value="Add">
        		</div>
        	</div>

        </form>
        	<?php //form_close(); ?>
       	</div>
       </div>
   </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="tile-body">
      <div class="tile">
        <h6>Currently Added location: </h6>

          <table class="table table-striped table-bordered table-responsive">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Location Name</th>
                <th>Inserted By</th>
                <th>Delete</th>
              </tr>  
            </thead>
            <tbody>
              <?php 
              $i = 1;
              foreach ($location as $val) { 
                echo '<tr>';
                  echo '<td>'.$i.'</td>';
                  echo '<td>'.$val['location'].'</td>';
                  echo '<td>'.$val['user_id'].'</td>'; ?>
                  <td><a href="<?= base_url(); ?>admins/delete_location/<?= $val['id']?>" onclick="return del_location();"><i class="app-menu__icon fa fa-trash"></i></a></td>

                <?php echo '</tr>';
              $i++; } ?>
            </tbody>
  </table>
      </div>
    </div>
    
  </div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
           $("form[name=loc]").submit(function() {
            alert("clicked");
            $(this).submit(function() {
                return false;
            });
            return true;
        });
});


     function del_location(){
       // alert(title);
        var r=confirm("Confirm Delete this Data?")
        if (r==true)
          // window.location = url+"admins/delete_location/"+title+;
        else
          return false;
        } 

</script>