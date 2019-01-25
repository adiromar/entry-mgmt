<div class="container-fluid" >
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">Records By Lists:</h4>
		<?php
		// print_r($details);
		?>

		<table class="table table-bordered table-striped resp">
			<thead class="thead-dark" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Item Name</th>
					<th>Delivered</th>
					<th>Cancelled</th>
					<th>Call Not Received</th>
					<th>Inquiry Only</th>
					<th>Later On</th>
					<th>Pending</th>
				</tr>
			</thead>
			<tbody>
					<?php 
					$i = 1;$pend=$deliver=$canc=$nr=$inq=$later=0;
					foreach ($details as $val) {
						$pend += $val['emp'];
						$deliver += $val['deli'];
						$canc += $val['canc'];
						$nr += $val['not_rec'];
						$inq += $val['inq'];
						$later += $val['later'];
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
					$i++; } 
					if (empty($details)){
					echo '<tr>';
					echo '<td colspan="8" class="empty_msg">No Data To Display.</td>';
					echo '</tr>';
				}else{
						echo '<tr>';
						echo '<td></td>';
						echo '<td><b>Total :</b></td>';
						echo '<td>'.$deliver.'</td>';
						echo '<td>'.$canc.'</td>';
						echo '<td>'.$nr.'</td>';
						echo '<td>'.$inq.'</td>';
						echo '<td>'.$later.'</td>';
						echo '<td>'.$pend.'</td>';
						echo '</tr>';
					}
					?>
			</tbody>
		</table>
	</div>
</div>