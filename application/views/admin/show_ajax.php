<?php

$i = 1;$due_tot =0;$paid_tot=0;$tot_stock=$t_com=$no=0;
					foreach ($datas as $val) {
						$pri = $this->admin_model->get_price_by_itemname($val['items']); 
						$cash = $val['deli'] * $pri[0]['price'];
						
						$sold=0;
						$stocks = $this->page_model->get_stocks_for_branch_item($branch, $val['items']);
						$trans = $this->page_model->get_all_transaction_record($val['items'], $branch);
            // echo '<pre>';
            // print_r($trans);die;
						echo '<tr>'; 
						echo '<td>'.$i.'</td>';
						echo '<td>'.$val['items'].'</td>';
						echo '<td>'.$val['deli'].'</td>';
						echo '<td>'.$pri[0]['price'].'</td>';
						echo '<td>'.$cash.'</td>';

						if ($stocks == true){
						foreach ($stocks as $del) {
							$stk = $del['sum(quantity)'] - $val['deli'];
							$comm = $del['commission'] * $val['deli'];
							$t_com += $comm;
              $tot_stock += $stk;
              $no = $cash - $comm;
							// echo '<td>'.$del['commission'].'</td>';
							// echo '<td>'.$comm.'</td>';
							echo '<td>'.$del['commission'].'</td>';
							echo '<td>'.$del['sum(quantity)'].'</td>';
							echo '<td>'.$stk.'</td>';

							}
						}else{
							echo '<td>-</td>';
							echo '<td>-</td>';
							echo '<td>-</td>';
						}
            $due_t=$minus=0;
						if ($trans == true){
							$paid = $diff=0;
						foreach ($trans as $tra) {
              $duee = $tra['sum(due_amount)'];
              $diff = $cash -$comm;
							$paid = $tra['sum(paid_amount)'];
              if ($tra['sum(due_amount)'] < 0){
                $minus = (abs($tra['sum(due_amount)']));
                $due_t = ($diff -$paid) ;
              }else{
                $due_t = $diff -$paid ;
              }
              
              
              // $due_tot += $due_t;
              $paid_tot += $paid;
              $due_tot += $due_t;
							echo '<td>'.$paid.'</td>';
							// echo '<td>'.$tra['due_amount'].'</td>';
              echo '<td>'.$due_t.'</td>';
							}
						}else{
              $due_tot += $no;
							echo '<td>-</td>';
							echo '<td>'.$no.'</td>';
						}
						if ($tra['due_amount'] == 0 && $val['deli'] != 0){
							echo '<td><a target="_blank" href="'.base_url().'admins/cash_flow?item='.$val['items'].'&deli='.$val['deli'].'&price='.$pri[0]['price'].'&amt='.$cash.'&stk='.$stk.'&branch='.$branch.'&commission='.$del['commission'].'&paid='.$paid.'&due='.$duee.'" class="btn btn-info edit_data">Edit</a></td>';
						}else if ($val['deli'] == 0){
							echo '<td><button class="btn btn-warning">Delivery Pending</button></td>';
						}
						else{
						echo '<td><a target="_blank" href="'.base_url().'admins/cash_flow?item='.$val['items'].'&deli='.$val['deli'].'&price='.$pri[0]['price'].'&amt='.$cash.'&stk='.$stk.'&branch='.$branch.'&commission='.$del['commission'].'&paid='.$paid.'&due='.$duee.'" class="btn btn-info edit_data">Edit</a></td>';
						}
						// echo '</form>';

						echo '</tr>';
					$i++; } 
          if (empty($datas)){
            echo "<p style='color: red' class='ml-4'>No Data To Display</p>";
          }
        echo '<tr>';
              echo '<td><b>Total: </b></td>';
              echo '<td></td>';
              echo '<td></td>';
              echo '<td></td>';
              echo '<td></td>';
              echo '<td></td>';
              echo '<td></td>';
              echo '<td>'.$tot_stock.'</td>';
              echo '<td><b>'.$paid_tot.'</b></td>';
              echo '<td><b>'.$due_tot.'</b></td>';
              echo '<td></td>';
            echo '</tr>';

?>

<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">PHP Ajax Update MySQL Data Through Bootstrap Modal</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Employee Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Employee Address</label>  
                          <textarea name="address" id="address" class="form-control"></textarea>  
                          <br />  
                          <label>Select Gender</label>  
                          <select name="gender" id="gender" class="form-control">  
                               <option value="Male">Male</option>  
                               <option value="Female">Female</option>  
                          </select>  
                          <br />  
                          <label>Enter Designation</label>  
                          <input type="text" name="designation" id="designation" class="form-control" />  
                          <br />  
                          <label>Enter Age</label>  
                          <input type="text" name="age" id="age" class="form-control" />  
                          <br />  
                          <input type="hidden" name="employee_id" id="employee_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 

<div id="app"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // $('#loading-image').hide();

    // $("#send").submit(function(){
    //   var val = $(this).val();
    //   alert(val);
    //   $.post('<?= base_url()?>admins/send', $('#send').serialize(),   
    //     function (data, textStatus) {
    //         $("#loading-image").show();
    //     setTimeout(function() {
    //         $("#loading-image").hide();
    //     }, 1100);
    //   // $( "#view_data" ).hide();
    //   setTimeout(function() {
    //         $('#app').show('slidedown').html(data);
    //     }, 1105);
    //      // $('.loading').show().html(data);
    // });
    // return false;
    // });

    $('#loading-image').hide();

    $("#send_url").submit(function(){
      // var val = $(this).val();
      alert('adsd');
      $.post('<?= base_url()?>posts/update_cash_flow', $('#send_url').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1100);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#apps').show('slidedown').html(data);
        }, 1105);
         // $('.loading').show().html(data);
    });
    return false;
    });
});


</script>