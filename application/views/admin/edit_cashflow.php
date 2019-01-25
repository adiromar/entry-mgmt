<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Update Cash Flow</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      
    </ul> -->

    <a href="<?= base_url(); ?>admins/view_cash_flow" class="btn btn-info">View Cash Flow</a>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<form method="post" id="go" action="<?= base_url();?>posts/update_cash_flow">
        		<?php
        		foreach ($transaction as $key => $value) { 
        			
        			?>
        			<div class="row">
        				<div class="col-md-4 col-lg-4">
        				<label>Item Name: </label>
        				<input type="text" name="item_name" value="<?= $value['item_name'] ?>" class="form-control" readonly>
        				</div>

        				<div class="col-md-2 col-lg-2">
        				<label>Branch: </label>
        				<input type="text" name="branch" value="<?= $value['branch'] ?>" class="form-control" readonly>
        				</div>

        				<div class="col-md-3 col-lg-3">
        				<label>Branch Commission (Total): </label>
        				<input type="text" name="commission" value="<?= $value['branch_comm'] ?>" id="comm" class="form-control" readonly>
        				</div>

        				<div class="col-md-2 col-lg-2">
        				<label>Stock Left: </label>
        				<input type="text" name="stock" value="<?= $value['stock_left'] ?>" class="form-control" readonly>
        				</div>
        			</div>

        			<div class="row mt-4">
        				<div class="col-md-3 col-lg-3">
        				<label>Unit Price: </label>
        				<input type="text" name="price" value="<?= $value['item_price'] ?>" class="form-control" readonly>
        				</div>

        				<div class="col-md-2 col-lg-2">
        				<label>Item Delivered: </label>
        				<input type="text" name="qty" value="<?= $value['quantity'] ?>" class="form-control" readonly>
        				</div>

        				<div>
        					<label></label>
        					<p class="mt-2">=</p>
        				</div>

        				<div class="col-md-3 col-lg-3">
        				<label>Actual Amount: </label>
        				<input type="text" name="amount" value="<?= $value['actual_amount'] ?>" class="form-control" id="amount" readonly>
        				</div>

        				<div class="col-md-3 col-lg-3">
        				<label>Net Amount ( - Commission): </label>
        				<input type="text" name="net_amount" value="<?= $value['net_amount'] ?>" class="form-control" id="net" readonly>
        				</div>
        			</div>
        			
        			<div class="row mt-4">
        				
        			</div>

        			<div class="row mt-4">

        				<div class="col-md-3 col-lg-3">
        				<label>Last Paid Amount: </label>
        				<input type="number" name="cash" min="0" class="form-control" id="cash_old" value="<?= $value['total_cash'] ?>" readonly>
        				</div>

        				<div class="col-md-3 col-lg-3">
        				<label>Currently Received: </label>
        				<input type="number" name="new_cash" min="0" class="form-control" id="cash" required>
        				</div>

        				<div class="col-md-3 col-lg-3">
        				<label>Cash Due: </label>
        				<!-- <input type="number" name="due_amount" min="0" class="form-control"> -->
        				<select name="due_amount" class="form-control">
        					<option id="due"><?= $value['due_amount'] ?></option>
        				</select>
        				</div>

        				<b class="mt-4 ml-3">Last Transaction Date: <?= $value['inserted_time'] ?></b>

        				<input type="submit" name="submit" value="Submit" class="btn btn-secondary col-md-12 mt-5" id="proceed">
        				
        			</div>
        		<?php } ?>
        		</form>
        </div>
    </div>
</div>
</div>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $("#cash").keyup(function(){
        // $("input").css("background-color", "pink");
        var amt = $('#net').val();
        var cash_o = $('#cash_old').val();
        var cash = $('#cash').val();
        // var comm = $('#comm').val();
        var due = (amt - cash_o);
        var diff = (due - cash);
        $('#due').text(diff);
        // alert(due);
    });

    if ($('#amount').val() == 0){
        	// $('#proceed').hide();
        	document.getElementById('proceed').disabled = true;
        	$('#message').text('Items Not Delivered Yet.');
        }

    $('#loading-image').hide();

    // $("#go").submit(function(){
    //   var val = $(this).val();
    //   // alert(val);
    //   $.post('<?= base_url()?>posts/update_cash_flow', $('#go').serialize(),   
    //     function (data, textStatus) {
    //         $("#loading-image").show();
    //     setTimeout(function() {
    //         $("#loading-image").hide();
    //     }, 1100);
    //   // $( "#view_data" ).hide();
    //   setTimeout(function() {
    //         $('#res').show('slidedown').html(data);
    //     }, 1105);
    //      // $('.loading').show().html(data);
    // });
    // return false;
    // });
});
</script>