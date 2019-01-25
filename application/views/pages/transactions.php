<div class="container-fluid" >
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;"> Transactions Info</h4>
<?php
$loc = $this->session->userdata('location'); ?>

		<table class="table table-bordered table-striped resp">
			<thead class="thead-dark">
				<tr>
					<th>S.N.</th>
					<th>Date</th>
					<th>Item Name</th>
					<th>Total Quantity</th>
					<th>Price</th>
					<th>Commission</th>
					<th>Delivered</th>
					<th>Net Amount</th>
					<th>To Be Paid</th>
					<th>Paid</th>
					<th>Due</th>
				</tr>
			</thead>
			<tbody>
				<?php $i =1;$due=0;$diff=0;$gt=0;
				$total_due=$total_amt=$total_net=$old=$tot_old=$t_ppaid=$stkss=$tot_ext_paid=$tot_stkss=$net_sp=$stok=0;
				foreach ($all as $key => $val) {
						// $diff = $val['net_amount'] - $val['paid_amount'];
						// $due = $diff + $val['due_amount'];
						// $total_due += $diff;	
					
					$deli_only = $this->page_model->count_deli_only($val['item_name'], $val['branch']);
					$dd =$amt=$ppaid=0;$minus=0;
					foreach ($deli_only as $kkey => $get) {

						$ddd = $get['deli'];
						$dd = $ddd;
						$amt = ($val['price'] - $val['commission']) * $dd;
						// if ($val['due_amount'] < 0){
						// 	$minus = (abs($val['due_amount']));
						// 	$diff = ($amt - $val['paid_amount']) + $minus;
						// }else{
						// 	$diff = ($amt - $val['paid_amount']) + $val['due_amount'];
						// }
						
						$total_net += $amt;
						$total_amt += $val['paid_amount'];
						// $total_due += $diff;
						$total_due = $total_net - $total_amt;
					}
					$tot_ext_paid = $val['paid_amount'];

					$net_sp = $val['price'] - $val['commission'];
					$net_spp = $val['price'] - $val['commission'] -$val['extra_commission'];	
					// echo $net_sp;
					$stkss = $val['sum(quantity)'] - $val['sum(returned_qty)'] -$val['extra_quantity'];	
					$stok = $val['sum(quantity)'] - $val['sum(returned_qty)'];				
					$old = ($net_sp * $stkss) + (($net_spp-50) * $val['extra_quantity']);

					// echo $old;
					$tot_old += $old;
					// $ppaid = $val['paid_amount'];
					$t_ppaid += $tot_ext_paid;
					$only_ext_comm = ($net_sp - 50) * $val['extra_quantity'];
					// $old = $old + $only_ext_comm;
					$diff = $old - $tot_ext_paid;
					echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['transaction_date'].'</td>';
						echo '<td>'.$val['item_name'].'</td>';
						echo '<td>'.$stok.'</td>';
						echo '<td>'.$val['price'].'</td>';
						echo '<td>'.$val['commission'].'</td>';
						if ($val['price'] != 0){
							echo '<td>'.$dd.'</td>';
						}else{
							echo '<td>0</td>';
						}
						
						echo '<td>'.$amt.'</td>';
						echo '<td>'.$old.'</td>';
						if (!empty($val['paid_amount'])){
							echo '<td class="btn btn-success paid_amount">'.$tot_ext_paid.'</td>';
						}else{
							echo '<td>'.$tot_ext_paid.'</td>';
						}
						
						if ($val['item_name'] == null){
                        	echo '<td>0</td>';
						}else{
							echo '<td>'.$diff.'</td>';
						}
						

					echo '</tr>';
				$i++; } 
				if (empty($all)){
					echo '<tr>';
					echo '<td colspan="11" class="empty_msg">No Data To Display.</td>';
					echo '</tr>';
				}
					$gt = $tot_old-$t_ppaid;
					echo '<tr>';
						echo '<td>Total: </td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						// echo '<td><b>Rs. '.$total_net.'</b></td>';
						echo '<td><b>Rs. '.$tot_old.'</b></td>';
						echo '<td><b>Rs. '.$t_ppaid.'</b></td>';
						if ($gt >= 0){
                        echo '<td><button class="btn btn-danger">Rs. '.$gt.'</b></td>';
                    	}else{
                    		echo '<td><button class="btn btn-secondary">Rs. '.$gt.'</b></td>';
                    	}
						
					echo '</tr>';


				?>
			</tbody>
		</table>

	</div>
</div>

<style type="text/css">
	.paid_amount{
		width: 85px;
		text-align: center;
	}
</style>