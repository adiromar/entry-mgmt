<?php $user_type = $this->session->userdata('user_type'); 
$url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$branch=$this->session->userdata('location');
if ($user_type == 'User' || $user_type == 'Branch'){
    $nott = $this->page_model->view_entry_records_user_wl($branch);
    $check=0;$chk=0;
    foreach ($nott as $notii => $not) {
      $check = $not['not_del'] - $not['can'];
      // echo $check;
    }
}else{
  $check = "0";
}
?>
<style type="text/css">
	/*input:focus{
		width: 150px;
	}*/
</style>
<div class="container-fluid" >

<?php if($this->session->flashdata('update_entry')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('update_entry').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('update_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('update_error').'</p>'; 
  endif; ?>
  
<div id="loading-image" style="display: none;" class="loading-div">Please Wait..<img class="loading-image" src="<?= base_url();?>assets_front/facebook.gif"></div>
<div id="app_here"></div>
	<div class="card card_prof">
		<h4 class="mt-3 mb-4" style="text-align: center;">View Records Entry </h4>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-striped resp">
			<thead class="thead-dark" style="background-color: #dee2e6">
				<tr>
					<th>S.N.</th>
					<th>Mobile Number</th>
					<th>Other Info</th>
					<?php if ($user_type == 'Admin' || $user_type == 'SuperAdmin'){ ?>
					<th>Location</th>
					<?php } ?>
					<th>Items</th>
					<!-- <th>Price</th> -->
					<th>Status</th>
					<th>Remarks</th>
					<th>Refer To (Only For Referrals)</th>
					<th><i class="fas fa-cog"></i></th>
				</tr>
			</thead>
			<tbody>
					<?php 

					$i = 1+$page;$checkk=0;$chk=$dups = array();
					foreach ($records as $key => $val) {
						$str = $val['mobile_number'];
						preg_match_all('!\d+!', $str, $matches); // removes words from string
						// preg_match_all('(?:\+?98|0)(?:\s*\d{3}){2}\s*\d{4}', $str, $matches);
						$words = preg_replace('/\d/', '', $str); //removes numbers from string

						if ($matches[0] != null){ // error handling if empty
							$mob_no = $matches[0][0];
						}else{
							$mob_no = '';
						}
						
						echo '<tr class="send_form">';
						
						echo '<td>'.$i.'</td>';
						echo '<td class="phone"><a href="tel:'.$mob_no.'">'.$mob_no.'</a></td>';
						echo '<td>'.$words.'</td>';
						if ($user_type == 'Admin' || $user_type == 'SuperAdmin'){
						echo '<td>'.$val['location'].'</td>';
							}
						echo '<td>'.$val['items'];
						// echo '<td>'.$val['price'].'</td>'; 
						echo '<form method="post" id="update_entry" class="update_entry" action="'.base_url().'posts/update_entry">
							<input type="hidden" name="items" value="'.$val['items'].'">
							<input type="hidden" name="branch" value="'.$val['location'].'">
							<input type="hidden" name="entry_id" value="'.$val['id'].'">
							<input type="hidden" name="url" value="'.$url .'"></td>';

						echo '<td class="remarks_input"><select name="status" class="form-control" id="status">
							  <option>'.$val['status'].'</option>
							  <option>Interested</option>
							  <option>Delivered</option>
							  <option>Cancelled</option>
							  <option>Later On</option>
							  <option>Call Not Received</option>
							  <option>Inquiry Only</option>
							</select>
						</td>';
						echo '<td class="remarks_input"><input type="text" name="remarks" class="form-control" value="'.$val['remarks'].'"></td>';
						echo '<input type="hidden" name="id" value='.$val['id'].'>';  // hidden
						echo '<td class="remarks_input"><select name="referto" class="form-control">';
							 echo '<option value="">Select</option>'; 
						foreach ($location as $loc) {
							  echo '<option>'.$loc['location'].'</option>'; 
							} 
						echo '</select></td>';

						if ($val['status'] == 'Delivered'){

						}else{
							echo '<td><button type="submit" name="go" class="btn btn-info insert"><i class="fas fa-check"></i></button></td>';
						} 
						echo '</form>';
						echo '</tr>';

					$i++; }
					if (empty($records)){
					echo '<tr>';
					echo '<td colspan="9" class="empty_msg">No Data To Display.</td>';
					echo '</tr>';
				} 
				 ?>
			</tbody>
		</table>
</div>
</div>

		<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo $pagination; ?>
        </div></div>

	</div>
</div>




<button id="check" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="display: none;">Launch</button>
 <!-- Modal starts for pending notification more than 10-->
<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Status - Pending Entries</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          echo "You have not maintained transaction for <b>$check </b> entries. Please Update records.";
         ?>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div> <!-- modal ends here -->

<!-- Modal for Daily Transactions form -->

<button id="checks" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterr" style="display: none;">Launch</button>

<div class="modal" id="exampleModalCenterr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Fill Up Yesterday's Entries</h5>
        
        </button>
      </div>
      <div class="modal-body">
      	<!-- <fieldset>Delivered Items Info</fieldset> -->
      	<div class="row ml-2">
      		<form method="post" action="<?= base_url()?>posts/daily_notes">
			<table class="table table-bordered resp">
				<thead>
					<tr>
						<th>S.N.</th>
						<th>Item Name</th>
						<th>Delivered</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				
			<?php $i =1;
			foreach ($numb as $stk => $val) {
				echo '<input type="hidden" name="item_name[]" value="'.$val['items'].'">';
				echo '<input type="hidden" name="date" value="'.$val['modified_date'].'">';
				echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$val['items'].'</td>';
				echo '<td><input type="number" min="0" max="'.$val['tot_del'].'" name="delivered[]" required class="form-control">';
				echo '<td><input type="number" min="0" name="total[]" value="'.$val['tot_del'].'" class="form-control" readonly>';
        $i++; } ?>    			
    		</tbody>

		</table>
		<button type="submit" class="btn btn-secondary offset-5" name="go" data-dismiss="modalss">Submit</button>
		</form>
        </div> 
        
        
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div> 

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
    $('#loading-image').hide();
    $(document).ready(function(){
    	$(".insert").click(function(){
    		e.preventDefault();
    		$(this).closest("tr").css({"background-color": "#a8dbad", "border": "1px solid #627e60"});
        // $(".update_entry").submit(function(){
      // alert("posted");
      $.post('<?= base_url()?>posts/update_entry', $('.update_entry').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1600);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#app_here').show('slidedown').html(data);
        }, 1605);
    });
    return false;
    });
});
</script>