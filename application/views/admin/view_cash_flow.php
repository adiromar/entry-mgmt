  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Cash Flow Details</h1>
      <p>Transactions Info :</p>
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      
    </ul> -->

    <!-- <a href="<?= base_url(); ?>admins/view_cash_flow" class="btn btn-info">View Cash Flow</a> -->
  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="tile">
        <div class="tile-body">

  <?php if($this->session->flashdata('upd')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('upd').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('err')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('err').'</p>'; 
  endif; ?>



<form id="filter_date" method="post">
    <div class="row mb-4">
        <div class="col-md-3">
            <label>Branch:</label>
            <select name="branch" class="form-control">
                <option value="">Select</option>
                <?php
                foreach ($branch as $key => $value) {
                    echo '<option>'.$value['location'].'</option>';
                } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="col-md-3">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="col-md-2">
            <input type="submit" name="filter" value="Search" class="btn btn-secondary" style="margin-top: 33px;">
        </div>
    </div>

    <div id="loading-image" style="display: none;" class="loading-div">Please Wait..<img class="loading-image" src="<?= base_url();?>assets_front/facebook.gif"></div>
</form>

<!-- <div id="loading-image" class="float-right"><img class="loading" src="<?= base_url()?>assets_front/facebook.gif" /></div> -->

<table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Date</th>
                    <th>Item Name</th>
                    <th>Branch</th>
                    <th>Total Quantity</th>
                    <th>Ext Qty</th>
                    <th>Price</th>
                    <th>Commission</th>
                    
                    <th>Delivered</th>
                    <th>Net Amount</th>
                    <th>Extra Commission</th>
                    <th>To Be Paid</th>
                    <th>Paid</th>
                    <th>Due</th>
                    
                </tr>
            </thead>
            <tbody id="app-here">
                <?php $i =1;$due=0;$diff=0;
                $total_due=$total_amt=$total_net=$old=$tot_old=$t_ppaid=0;$stkss=0;
                foreach ($all as $key => $val) {
                        // $diff = $val['net_amount'] - $val['paid_amount'];
                        // $due = $diff + $val['due_amount'];
                        // $total_due += $diff;                 
                    $old = ($val['price'] - $val['commission']) * $val['quantity'];
                    $tot_old += $old;
                    $deli_only = $this->page_model->count_deli_only($val['item_name'], $val['branch']);
                    $dd =$amt=$ppaid=0;
                    foreach ($deli_only as $kkey => $get) {
                        $ppaid = $val['paid_amount'];
                        $ddd = $get['deli'];
                        $dd = $ddd;
                        $amt = ($val['price'] - $val['commission']) * $dd;
                        
                        $total_due += $diff;
                        $total_amt += $ppaid;
                        $total_net += $amt;
                    }
                    $diff = $old - $val['paid_amount'] ;
                    $ppaid = $val['paid_amount'];
                        $t_ppaid += $ppaid;
                    echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$val['transaction_date'].'</td>';
                        echo '<td>'.$val['item_name'].'</td>';
                        echo '<td>'.$val['branch'].'</td>';
                        echo '<td>'.$val['quantity'].'</td>';
                        echo '<td>'.$val['extra_quantity'].'</td>';
                        echo '<td>'.$val['price'].'</td>';
                        echo '<td>'.$val['commission'].'</td>';
                        
                        if ($val['price'] != 0){
                            echo '<td>'.$dd.'</td>';
                        }else{
                            echo '<td>0</td>';
                        }
                        
                        echo '<td>'.$amt.'</td>';
                        echo '<td>'.$val['extra_commission'].'</td>';
                        echo '<td>'.$old.'</td>';
                        if (!empty($val['paid_amount'])){
                            echo '<td><button class="btn btn-success paid_amount">'.$val['paid_amount'].'</button></td>';
                        }else{
                            echo '<td>'.$val['paid_amount'].'</td>';
                        }
                        if ($val['item_name'] == null){
                            echo '<td>0</td>';
                        }else{
                            echo '<td>'.$diff.'</td>';
                        }
                        
                    echo '</tr>';
                $i++; } 
                    $gt = $tot_old-$t_ppaid;
                    echo '<tr>';
                        echo '<td></td>';
                        echo '<td><b>Total: </b></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td><b>'.$total_net.'</b></td>';
                        echo '<td></td>';
                        
                        echo '<td><b>'.$tot_old.'</b></td>';
                        echo '<td><b>'.$t_ppaid.'</b></td>';
                        echo '<td><button class="btn btn-danger">Rs. '.$gt.'</b></td>';
                        
                    echo '</tr>';


                ?>
            </tbody>
        </table>
        
        <div id="append"></div>


            </div>
        </div>
        </div>
    </div>
</div>
</div>
</main>
<style type="text/css">
    .paid_amount{
        width: 85px;
        text-align: center;
    }
    .loading-image{
        width: 50px;
        height: 50px;
        margin: 0px auto;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
    $('#loading-image').hide();
    $(document).ready(function(){
        $("#filter_date").submit(function(){
      var val = $(this).val();
      // alert(val);
      $.post('<?= base_url()?>admins/filter_records_by_date', $('#filter_date').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1600);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#app-here').show('slidedown').html(data);
            // $('#append').show('slidedown').html(data);
        }, 1605);
         // $('.loading').show().html(data);
    });
    return false;
    });
});
</script>