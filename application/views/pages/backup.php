<div class="container-fluid" >
	<div class="card pt-2 pl-5 pr-5 pb-4" style="background: beige; min-height: 500px;">
		<h4 class="mt-3 mb-4" style="text-align: center;">Stocks Information:</h4>
<?php
$loc = $this->session->userdata('location'); ?>

		<table class="table">
			<thead class="" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Commission</th>
					<th>Delivered</th>
					<th>In Stock</th>
					<th>Collected (Rs.)</th>
					<th>Total Comm.</th>
				</tr>
			</thead>
			<tbody>
					<?php 
		
					$i = 1;$tot_comm=$tot_cash=$pay=0;$qty=0;;
					foreach ($stocks as $stk) {
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$stk['item_name'].'</td>';
						echo '<td>'.$stk['sum(quantity)'].'</td>';
						echo '<td>'.$stk['price'].'</td>';
						echo '<td>'.$stk['commission'].'</td>';

	$sold=0;
	$deliver = $this->page_model->get_delivered_stocks_for_branch($loc, $stk['item_name']);
	foreach ($deliver as $val) {
		$item = $val['items'];
		$sold += $val['deli'];
	}
						$stock = ($stk['sum(quantity)'] - $sold);
						$coll = $stk['price'] * $sold;
						$comm = $stk['commission'] * $sold;
						$tot_cash += $coll;
						$tot_comm += $comm;
						$pay = $tot_cash - $tot_comm;
						echo '<td>'.$sold.'</td>';
						echo '<td>'.$stock.'</td>';
						echo '<td>'.$coll.'</td>';
						echo '<td>'.$comm.'</td>';
						
						echo '</tr>';
					$i++; } 
						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><b>Total Collected Cash: </b></td>';
						echo '<td>'.$tot_cash.'</td>';
						echo '<td>'.$tot_comm.'</td>';
						echo '</tr>';

						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><b>Total Payment: </b></td>';
						echo '<td></td>';
						echo '<td>'.$pay.'</td>';
						echo '</tr>';
					?>
			</tbody>
		</table>
	</div>
</div>