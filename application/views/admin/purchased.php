 <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Items Purchased</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      
    </ul> -->

    <a href="<?= base_url(); ?>admins/view_purchased" class="btn btn-info">View Purchases</a>
  </div>

<?php if($this->session->flashdata('item_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('item_added').'</p>'; 
  endif; 
if($this->session->flashdata('error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; 
  endif; 
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <form method="post" id="go" name="go" action="<?= base_url();?>posts/save_purchases">

            <div class="row">
                <div class="col-md-4 col-lg-4">
                <label>Item Name: </label>
                <select class="form-control" name="item_name" required>
                <option value="">Select Item</option>
                <?php 
                foreach ($items as $val) {
                  echo '<option>'.$val['item_name'].'</option>';
                }
                ?>
                </select>
                </div>

                <div class="col-md-3 col-lg-3">
                <label>Purchased Unit Price: </label>
                <input type="number" name="purchased_price" min="0" class="form-control" required>
                </div>

                <div class="col-md-2 col-lg-2">
                <label>Quantity: </label>
                <input type="number" name="quantity" min="0" id="comm" class="form-control" required>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-3 col-lg-3">
                <label>Purchased By: </label>
                <input type="text" name="purchased_by" value="" class="form-control" required>
                </div>

                <div class="col-md-3 col-lg-3">
                <label>Purchased Date: </label>
                <input type="date" name="purchased_date" value="" class="form-control" required>
                </div>

                <div class="col-md-6 col-lg-6">
                <label>Remarks: </label>
                <input type="text" name="remarks" value="" class="form-control">
                </div>

                <input type="submit" name="enter" value="submit" class="col-md-12 mt-4 btn btn-info" id="enter">
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
           $("form[name=go]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });
});
</script>