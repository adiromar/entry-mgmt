<style type="text/css">
	.icn-size{
		font-size: 24px;
	}
	.gcirc{
		color: green;
		text-align: center;
	}
	.circ{
		color: red;
		text-align: center;
	}
</style>

<div class="container-fluid" >
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">Return Items To Admin:</h4>

		<div class="container col-md-12 col-sm-12 col-xs-12 col-lg-12" style="background-color: #dad4d4;padding: 20px;">
<?php if($this->session->flashdata('damage')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('damage').'</p>'; 
  endif; 
if($this->session->flashdata('dam_err')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('dam_err').'</p>'; 
  endif; 
  ?>

			<form method="post" action="<?= base_url()?>posts/items_returned">
			<div class="row mt-4">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<label>Item Name:</label>
					<select class="form-control" name="item_name" id="item_name" required>
						<option value="">Select</option>
						<?php $max=0;
						foreach ($stocks as $stk => $val) {
							$max = $val['sum(quantity)'];
							echo '<option data-id="'.$val['item_id'].'">'.$val['item_name'].'</option>';
						} ?>
					</select>
				</div>

				<select name="item_id" style="display: none;">
					<option id="here"></option>
				</select>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<label>Quantity:</label>
					<input type="number" name="quantity" min="0" max="<?= $max ?>" class="form-control" required>
				</div>

				<div class="col-md-3 col-sm-3 col-xs-3">
					<label>Reason For Returning:</label>
					<input type="text" name="reason" class="form-control" required>
				</div>

				<div class="col-md-2 col-sm-2 col-xs-2" style="margin-top: 30px;">
				<button type="submit" class="btn btn-primary form-control">Submit</button>
				</div>

			</div>
		</form>
		</div>

		<div class="container mt-4 mb-5" style="overflow-x:auto;">
			<h4>Returned Items</h4>
			<table class="table table-bordered table-striped resp">
				<thead class="thead-dark"> 
				<tr>
					<th>S.N.</th>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Reason</th>
					<th>Ret. Date</th>
					<th width="150px">Admin Approval</th>
				</tr>
				</thead>
				<tbody>
					<?php $i =1;
					foreach ($return as $key => $val) {
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['item_name'].'</td>';
						echo '<td>'.$val['quantity'].'</td>';
						echo '<td>'.$val['reason'].'</td>';
						echo '<td>'.$val['returned_date'].'</td>';
						if ($val['status'] == 'Approved'){
							echo '<td class="gcirc"><i class="far fa-check-circle icn-size"></i></td>';
						}else if ($val['status'] == 'Declined'){
							echo '<td class="circ"><i class="far fa-times-circle icn-size"></i></td>';
						}else {
							echo '<td class="circ">Pending</td>';
						}
						
						echo '</tr>';
					$i++; } ?>
				</tbody>
			</table>
		</div>

	</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#item_name').on('change', function() {
        var val = $(this).val();
        var id = $('#item_name option:selected').data('id');
        // alert(id);
        $('#here').text(id);
    });
});
</script>