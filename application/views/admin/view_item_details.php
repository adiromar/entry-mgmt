  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> View Item Details</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
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

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<form id="branch_form" method="post" action="">
            <div class="row">
        	   <div class="col-md-3 mb-4" >
        	     <h5>Sort by branch</h5>
        	       <select class="form-control" name="branch" id="change">
        		        <option value="all">Choose Branch (All)</option>
        		        <?php
        		        foreach ($branch as $val) { 
        		        echo '<option>'.$val['location'].'</option>'; 
        		        } ?>
        	       </select>
        	   </div>

          <div class="col-md-3">
            <label>Date</label>
            <input type="date" name="date" id="datepickers" class="form-control cc" autocomplete="off">
          </div>

          <!-- <div class="col-md-3">
            <label>Date</label>
            <input type="date" data-date="" data-date-format="yy-mm-dd" class="form-control">
          </div> -->
          

          <div>
            <a class="btn btn-danger" onclick="document.getElementById('datepickers').value = ''" style="margin-top: 32px;color: #fff">X</a>
          </div>

          <div class="col-md-2" style="margin-top: 32px;">
          <button type="submit" id="filter" class="btn btn-success">Filter</button>
          </div>
        </div>

        </form>

        <div id="loading-image">loading...</div>

        	<table class="table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>S.N.</th>
					<th>Item Name</th>
					<th>Delivered</th>
					<!-- <th>Price</th> -->
					<th>Cancelled</th>
					<th>Call Not Received</th>
					<th>Inquiry Only</th>
					<th>Later On</th>
					<th>Pending</th>
					<th><i class="fas fa-cog"></i></th>
				</tr>
			</thead>
			<tbody id="here">
					<?php 
					$i = 1;
					foreach ($details as $val) {
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['items'].'</td>';
						echo '<td>'.$val['deli'].'</td>';
						echo '<td>'.$val['canc'].'</td>';
						echo '<td>'.$val['not_rec'].'</td>';
						echo '<td>'.$val['inq'].'</td>';
						echo '<td>'.$val['later'].'</td>';
						echo '<td>'.$val['emp'].'</td>';

						echo '</tr>';
					$i++; } ?>

			</tbody>
		</table>
        </div>
    </div>
</div>
</div>
</main>

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#loading-image').hide();
    // $("#change").change(function(){
    // 	var val = $(this).val();
    // 	// alert(val);
    // 	$.post('<?= base_url()?>admins/test', $('#branch_form').serialize(),   
    //     function (data, textStatus) {
    //         $("#loading-image").show();
    //     setTimeout(function() {
    //         $("#loading-image").hide();
    //     }, 1100);
    //   // $( "#view_data" ).hide();
    //   setTimeout(function() {
    //         $('#here').show('slidedown').html(data);
    //     }, 1105);
    //      // $('.loading').show().html(data);
    // });
    // return false;
    // });

    $("#branch_form").submit(function(){
      var val = $(this).val();
      // alert(val);
      $.post('<?= base_url()?>admins/get_report', $('#branch_form').serialize(),   
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

     $( function() {
    $( "#datepicker" ).datepicker({ 
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      changeMonth: true
    });
  } );
</script>