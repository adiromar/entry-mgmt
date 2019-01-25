  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Add Items</h1>
      <p>Set your Item name and Fields:</p>
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb"> -->
      <!-- <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li> -->
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    <!-- </ul> -->

    <a class="btn btn-info" href="<?php echo base_url(); ?>admins/view_items"><i class="fa fa-eye"> </i>View Items</a>
  </div>
<?php if($this->session->flashdata('item_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('item_added').'</p>'; 
  endif; 
if($this->session->flashdata('error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; 
  endif; 
if($this->session->flashdata('duplicate')): 
    echo '<p style="text-align: center;" class="alert alert-warning">'.$this->session->flashdata('duplicate').'</p>'; 
  endif; 
  ?>
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
        	<?php echo form_open('posts/insert_items', array('class' => 'mt-4', 'id' => 'form')) ?>
        	<div class="row col-md-12 col-sm-12">
            <!-- <div class="col-md-3 col-sm-3 col-lg-3">
              <label>Branch Name: </label>
              <select name="branch" class="form-control" required>
                <option value="">Choose Branch</option>
                <?php foreach ($location as $loc) {
                  echo '<option>'.$loc['location'].'</option>';
                } ?>
              </select>
            </div> -->
        		<div class="col-md-5 col-sm-4 col-lg-5">
        			<label>Item Name: </label>
        			<input type="text" name="item_name" class="form-control" required>
        		</div>

        		<!-- <div class="col-md-3 col-sm-3 col-lg-3">
        			<label>Item Quantity: </label>
        			<input type="number" name="quantity" class="form-control" required>
        		</div> -->

        		<div class="col-md-3 col-sm-3 col-lg-3">
        			<label>Per Unit Price: </label>
        			<input type="number" name="price" min="0" class="form-control" required>
        		</div>

        		<!-- <div class="col-md-12 col-sm-4 col-lg-12 mt-4"> -->
        			<input type="submit" name="submit" class="btn btn-success col-md-12 col-sm-3 mt-5">
        		<!-- </div> -->
        	</div>

        	<?php form_close(); ?>
       	</div>
       </div>
   </div>
</div>

</main>