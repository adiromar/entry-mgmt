<?php
// echo '<pre>';
// print_r($canc);
?>
<div class="container-fluid">
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">Confirmed Entries </h4>

<table class="table table-bordered table-striped resp">
			<thead class="thead-dark" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Mobile Number</th>
					<th>Other Info</th>
					<th>Items</th>
					<!-- <th>Price</th> -->
					<th>Status</th>
					<th>Remarks</th>
					<th>Branch</th>
					<th>Inserted Date</th>
					<th>Modified Date</th>
				</tr>
			</thead>
			<tbody>
				<?php $i =1+$page;
				foreach ($inter as $val) {
					$str = $val['mobile_number'];
						preg_match_all('!\d+!', $str, $matches); // removes words from string
						$words = preg_replace('/\d/', '', $str); //removes numbers from string
						if ($matches[0] != null){ // error handling if empty
							$mob_no = $matches[0][0];
						}else{
							$mob_no = '';
						}

					echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$mob_no.'</td>';
						echo '<td>'.$words.'</td>';
						echo '<td>'.$val['items'].'</td>';
						echo '<td><button class="btn btn-primary">'.$val['status'].'</button></td>';
						
						echo '<td>'.$val['remarks'].'</td>';
						echo '<td>'.$val['location'].'</td>';
						echo '<td>'.$val['inserted_time'].'</td>';
						echo '<td>'.$val['modified_date'].'</td>';
					echo '</tr>';
				$i++; } 
				if (empty($inter)){
					echo '<tr>';
					echo '<td colspan="11" class="empty_msg">No Data To Display.</td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>

<?php // if (!empty($inter)){ ?>
		<div class="row"><div class="col-md-12">
            <?php echo $pagination; ?>
        </div></div>
<?php // } ?>
	</div>
</div>