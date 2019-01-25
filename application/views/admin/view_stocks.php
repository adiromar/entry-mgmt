  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Stocks Information</h1>
      <!-- <p>Total quantity :</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>
<style type="text/css">
    .paid_amount{
        width: 85px;
        text-align: center;
    }
    .loading-image{
        width: 50px;
        height: 50px;
        margin: 0px auto;
    }
</style>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<form id="transaction" method="post" action="">
            <div class="row">
        	   <div class="col-md-3 mb-4" >
        	     <h5>Sort by branch</h5>
        	       <select class="form-control" name="branch" id="change">
        		        <option value="all">Choose Branch</option>
        		        <?php
        		        foreach ($branch as $val) { 
        		        echo '<option>'.$val['location'].'</option>'; 
        		        } ?>
        	       </select>
        	   </div>

          <div class="col-md-3">
            <label>Date</label>
            <input type="date" name="date" id="datepicker1" class="form-control cc" autocomplete="off" placeholder="All Date">
          </div>

          <div>
            <a class="btn btn-danger" onclick="document.getElementById('datepicker1').value = ''" style="margin-top: 32px;color: #fff">X</a>
          </div>

          <div class="col-md-2" style="margin-top: 32px;">
          <button type="submit" id="filter" class="btn btn-success">Filter</button>
          </div>
        </div>

        <div id="loading-image" style="display: none;" class="loading-div">Please Wait..<img class="loading-image" src="<?= base_url();?>assets_front/facebook.gif"></div>
        </form>

        <!-- <div id="loading-image">loading...</div> -->
        <div id="resp"></div>

        	<table class="table table-striped table-bordered">
			<thead class="thead-light">
				<tr>
					<th>S.N.</th>
          <th>Branch</th>
					<th>Item Name</th>
          <th>Price</th>
          <th>Commission</th>
          <th>Total Qty.</th>
          <th>Extra Qty.</th>
					<th>Delivered</th>          
          <th>In Stock</th>
          <th>Date</th>

				</tr>
			</thead>
			<tbody id="here">
			<?php 
      echo '<tr>';
        echo '<td colspan="12" style="text-align: center;">Please Select At Least One field.</td>';
      echo '</tr>'
      // $loc = $this->session->userdata('location');
					// $total = 0;
					// $i = 1;
					// foreach ($details as $val) {
					// 	echo '<tr>';
					// 	echo '<td>'.$i.'</td>';
     //        echo '<td>'.$val['branch'].'</td>';
					// 	echo '<td>'.$val['item_name'].'</td>';
					// 	echo '<td>'.$val['price'].'</td>';
					// 	echo '<td>'.$val['commission'].'</td>';
					// 	echo '<td>'.$val['sum(quantity)'].'</td>';
     //        echo '<td>'.$val['quantity'].'</td>';
     //        echo '<td>'.$val['quantity'].'</td>';
     //        echo '<td>'.$val['sent_date'].'</td>';
            
					// 	echo '</tr>';
					// $i++; } 
					// 	echo '<tr>';
					// 	echo '<td></td>';
					// 	echo '<td></td>';
					// 	echo '<td></td>';
					// 	echo '<td><b>Total = </b></td>';
					// 	echo '<td></td>';
     //        echo '<td></td>';
     //        echo '<td></td>';
     //        echo '<td></td>';
     //        echo '<td></td>';
					// 	echo '</tr>';
					?>
					
			</tbody>

        </div>
    </div>
</div>
</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$('#loading-image').hide();
	$(document).ready(function(){
		$("#transaction").submit(function(){
      var val = $(this).val();
      // alert(val);
      $.post('<?= base_url()?>admins/get_stocks', $('#transaction').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1100);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#here').show('slidedown').html(data);
        }, 1105);
         // $('.loading').show().html(data);
    });
    return false;
    });
});
	// datepicker
$( function() {
    $( "#datepicker1" ).datepicker({ 
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      changeMonth: true
    });
  } );
</script>