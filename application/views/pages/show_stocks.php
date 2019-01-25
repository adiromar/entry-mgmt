<div class="container-fluid" >
	<div class="card pt-2 pl-5 pr-5 pb-4" style="min-height: 500px;">
		<h4 class="mt-3 mb-4" style="text-align: center;">Transaction Information:</h4>
<?php
$loc = $this->session->userdata('location'); ?>

		<table class="table table-bordered table-striped resp">
			<thead class="thead-dark" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Sent Date</th>
					<th>Item Name</th>
					<th>Total Quantity</th>
					<th>Price</th>
					<th>Commission</th>
					<th>Delivered</th>
					<th>In Stock</th>
					<!-- <th>Total Amount</th> -->
					<th>Net Amount</th>
				</tr>
			</thead>
			<tbody>
					<?php 
					$i = 1;$tot_del=$tot_left=$pay=0;$qty=$total_due=$tot_net=0;
					foreach ($stocks as $stk) {
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$stk['sent_date'].'</td>';
						echo '<td>'.$stk['item_name'].'</td>';
						echo '<td>'.$stk['sum(quantity)'].'</td>';
						echo '<td>'.$stk['price'].'</td>';
						echo '<td>'.$stk['commission'].'</td>';

	$left=$del=$comm=$net=0;
	$effi = $this->page_model->branch_efficiency_by_item($loc, $stk['item_name']);
	foreach ($effi as $val) {
		
		$del = $val['eff'];
		$left = ($stk['sum(quantity)'] - $val['eff']);
		$tot_del += $del;
		$tot_left += $left;
	}	
		$comm = $stk['commission'] * $del;
		$net = $stk['price'] * $del - $comm;
		$tot_net += $net;
						echo '<td>'.$del.'</td>';
						echo '<td>'.$left.'</td>';
						echo '<td>'.$net.'</td>';
						echo '</tr>';
	$deliver = $this->page_model->get_transaction_record($stk['item_name'],$stk['branch']);
	// echo '<pre>';
	// print_r($deliver);
	$paid=$due=$prv_due=0;
	if ($deliver == true){
	foreach ($deliver as $deliv => $ddd) {
		$paid = $ddd['total_cash'];
		$prv_due = $ddd['due_amount'];
		$due = $net - $paid;
		$total_due += $due;
	}
}else{
	$due = $net - 0;
	$total_due += $due;
}

						echo '<tr>';
							echo '<td></td>';
							
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>Paid: </td>';
							echo '<td class="green">'.$paid.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
							
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>Due Amount: </td>';
							echo '<td class="due">'.$due.'</td>';
						echo '</tr>';
					$i++; }
						echo '<tr>';
							echo '<td></td>';
							
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td><b>Total :</b></td>';
							echo '<td><b>'.$tot_del.'</b></td>';
							echo '<td><b>'.$tot_left.'</b></td>';
							echo '<td><b>'.$tot_net.'</b></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
							echo '<td><b>Total Due:</b></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td class="due"><b>'.$total_due.'</b></td>';
						echo '</tr>';
			
				?>
			</tbody>
		</table>
	</div>
</div>
<style type="text/css">
	.due{
		color: red;
	}
	.green{
		color: green;
	}
</style>