  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Add Delivery Details</h1>
      <p>Manually Setting Delivered Status on behalf of Branch By Admin:</p>
    </div>

    <!-- <a href="<?= base_url(); ?>admins/view_cash_flow" class="btn btn-info">View Cash Flow</a> -->
  </div>
<?php if($this->session->flashdata('deli_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('deli_added').'</p>'; 
  endif; 
if($this->session->flashdata('location_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('location_error').'</p>'; 
  endif; 
  ?>

  <div class="row">
    <div class="col-md-12">
        <div class="tile">
        <div class="tile-body mt-4">
        	<form method="post" action="<?= base_url(); ?>posts/add_delivery" id="form">
        		<div class="row">
        			<div class="col-md-3">
        				<label>Branch: </label>
        				<select class="form-control" name="branch" required>
        					<option>Choose Branch</option>
        					<?php foreach ($branch as $key => $value) {
        						echo '<option>'.$value['location'].'</option>';
        					} ?>
        				</select>
        			</div>

        			<div class="col-md-3">
        				<label>Itemname: </label>
        				<select class="form-control" name="item_name" required>
        					<option>Choose Item</option>
        					<?php foreach ($items as $ite => $val) {
        						echo '<option>'.$val['item_name'].'</option>';
        					} ?>
        				</select>
        			</div>

        			<div class="col-md-2">
        				<label>Items Delivered: </label>
        				<input type="number" name="delivered" min="0" class="form-control" required>
        			</div>

        			<div class="col-md-3">
        				<label>Remarks: </label>
        				<input type="text" name="remarks" class="form-control">
        			</div>
        		</div>
        		<div class="col-md-12 mt-5">
        			<input class="btn btn-secondary offset-4 col-md-4 offset-4" type="submit" name="go" value="Enter">
        		</div>
        	</form>
        </div>
    </div>
</div>
</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
     $("form[id=form]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
      });
})
</script>