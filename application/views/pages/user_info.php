<div class="container-fluid">
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">User Information:</h4>

<?php 
	// echo '<pre>';
	// print_r($user_eff);
	$sold=0;$can=0;$nr=0;$inq=0;$lat=0;$emp=0;$tot=0;$eff=0;
	foreach ($user_eff as $val) {
		$sold += $val['deli'];
		$can += $val['canc'];
		$nr += $val['not_rec'];
		$inq += $val['inq'];
		$lat += $val['later'];
		$emp += $val['emp'];
	}
	// echo $sold;
	$tot = $can +$nr + $inq + $lat + $emp +$sold;
	// echo $tot;	
	if ($sold != 0 && $tot != 0){
		$eff = number_format($sold / $tot*100, 2,'.','');
	}else{
		$eff = '0%';
	}
	
	// echo $eff;	
?>
		<table class="table table-bordered table-striped resp">
			<thead class="" style="background-color: #dee2e6">
				<tr>
					<th rowspan="2">Username</th>
					<th rowspan="2">Branch</th>
					<th rowspan="2">Name</th>
					<th rowspan="2">User Type</th>
					<th colspan="3">Total Transaction Information</th>
				</tr>
				<tr>
					<th>Total</th>
					<th>Delivered</th>
					<th>Efficiency (%)</th></tr>
			</thead>
			<tbody>
				<?php foreach ($user_info as $info) { 
				echo '<tr>';
					echo '<td>'.$info['user_name'].'</td>';
					echo '<td>'.$info['location'].'</td>';
					echo '<td>'.$info['firstname'] . ' ' . $info['lastname'].'</td>';
					echo '<td>'.$info['user_type'].'</td>';
					echo '<td>'.$tot.'</td>';
					echo '<td>'.$sold.'</td>';
					echo '<td>'.$eff.'</td>';
				echo '</tr>'; } ?>
			</tbody>
		</table>

<h4 class="mt-3 mb-4" style="text-align: center;">Stocks Details Sent By Admin:</h4>	
<?php $loc = $this->session->userdata('location'); ?>

		<table class="table table-bordered table-striped resp">
			<thead class="thead-dark" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Sent Date</th>
					<th>Item Name</th>
					<th>Total Quantity</th>
					<th>Price</th>
					<th>Commission</th>
					<th>Delivered By User</th>
					<th>In Stock</th>
				</tr>
			</thead>
			<tbody>
<?php 
					$i = 1;$tot_del=$tot_left=$pay=$qty=$stkss=0;
					foreach ($stocks as $stk) {
						$stkss = $stk['sum(quantity)'] - $stk['sum(returned_qty)'];
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$stk['sent_date'].'</td>';
						echo '<td>'.$stk['item_name'].'</td>';
						echo '<td>'.$stkss.'</td>';
						echo '<td>'.$stk['price'].'</td>';
						echo '<td>'.$stk['commission'].'</td>';

	$left=0;$del=0;
	$deliver = $this->page_model->branch_efficiency_by_item($loc, $stk['item_name']);
	foreach ($deliver as $val) {
		
		$del = $val['eff'];
		$left = ($stk['sum(quantity)'] - $stk['sum(returned_qty)'] - $val['eff']);
		$tot_del += $del;
		$tot_left += $left;
	}
						echo '<td>'.$del.'</td>';
						echo '<td>'.$left.'</td>';

						echo '</tr>';
					$i++; }
						echo '<tr>';
							echo '<td></td>';
							echo '<td><b>Total :</b></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td><b>'.$tot_del.'</b></td>';
							echo '<td><b>'.$tot_left.'</b></td>';
						echo '</tr>';
					?>
			</tbody>
		</table>
	</div>
</div>