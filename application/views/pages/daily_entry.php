<?php 
$loc = $this->session->userdata('location');
date_default_timezone_set('Asia/Kathmandu');
$now = date('Y-m-d'); 
$yes = date('Y-m-d',strtotime("-1 days"));
// echo '<pre>';
// echo $tid;
// print_r($daily_stk);
?>
<div class="container-fluid" >
	<div id="app_here"></div>
	 <div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">Daily Transaction Entry </h4>

			<div class="row">
				<div class="col-md-12">
					<?php echo form_open('', 'class="email" id="myform"'); ?>
				
					<div class="col-md-12" style="background-color: #b6cfe5;padding: 15px;">
						<div class="row">
							<div class="col-md-5"></div>
							
							<div class="col-md-2">
								<label>Transaction Date: </label>
								<input type="text" name="new_date" id="datepicker" value="<?= $yes ?>" class="form-control datepick" autocomplete="off">
							</div>

							<div class="col-md-5"></div>
						</div>
					</div>
					<?php echo form_close(); ?>

<div id="loading-image" style="display: none;" class="loading-div">Please Wait..<img class="loading-image" src="<?= base_url();?>assets_front/facebook.gif"></div>
<div id="app_here"></div>

					<table class="table table-bordered table-striped resp mt-4">
						<thead class="thead-dark">
					<tr>
						<th>S.N.</th>
						<th>Item Name</th>
						<th>Date</th>
						<th>Total Entry Received</th>
						<th>Delivered</th>
					</tr>
						</thead>
						<tbody id="app_here1">
							<?php 
							// echo '<pre>';
							// print_r($daily);
							$i = 1;
							foreach ($daily_stk as $key => $value) {
								$notes = $this->page_model->get_delivered_by_branch_date($value['items'] , $loc, $value['inserted_time']);

								$del=0;
								foreach ($notes as $nkey => $vals) {
									$del = $vals['item_delivered'];
								}
								
								echo '<tr>';
								echo '<td>'.$i.'</td>';
								echo '<td>'.$value['items'].'</td>';
								echo '<td>'.$value['inserted_time'].'</td>';
								echo '<td>'.$value['count(id)'].'</td>';
								echo '<td>'.$del.'</td>';

							$i++; } ?>
						</tbody>
						
					</table>
					
				</div>
			</div>
</div>


<script type="text/javascript">
	$( function() {
		var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

	    $('#loading-image').hide();
    $(document).ready(function(){
    	$(".datepick").change(function(){
    		// alert("alert");
      $.post('<?= base_url()?>posts/filter_daily', $('#myform').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1600);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#app_here1').show('fadein').html(data);
        }, 1605);
    });
    return false;
    });
});
</script>