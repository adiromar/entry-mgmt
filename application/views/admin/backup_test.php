<?php
// $item = str_replace('%20', ' ', $item);
$item = $_GET['item'];
$branch = $_GET['branch'];
$stk = $_GET['stk'];
$commission = $_GET['commission'];
$price = $_GET['price'];
$deli = $_GET['deli'];
$amt = $_GET['amt'];
$prev_due = $_GET['due'];
$paid = $_GET['paid'];
?>
  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Transaction Details</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>
<?php if($this->session->flashdata('location_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('location_added').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('location_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('location_error').'</p>'; 
  endif; ?>

<div id="loading-image">...</div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
                <form method="post" id="go" action="<?= base_url();?>posts/update_cash_flow">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                        <label>Item Name: </label>
                        <input type="text" name="item_name" value="<?= $item ?>" class="form-control" readonly>
                        </div>

                        <div class="col-md-2 col-lg-2">
                        <label>Branch: </label>
                        <input type="text" name="branch" value="<?= $branch ?>" class="form-control" readonly>
                        </div>

                        <div class="col-md-3 col-lg-3">
                        <label>Branch Commission: </label>
                        <input type="text" name="commission" value="<?= $commission?>" id="comm" class="form-control" readonly>
                        </div>

                        <div class="col-md-2 col-lg-2">
                        <label>Stock Left: </label>
                        <input type="text" name="stock" value="<?= $stk ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3 col-lg-3">
                        <label>Unit Price: </label>
                        <input type="text" name="price" value="<?= $price ?>" class="form-control" readonly>
                        </div>

                        <div class="col-md-2 col-lg-2">
                        <label>Item Delivered: </label>
                        <input type="text" name="qty" value="<?= $deli ?>" class="form-control" readonly>
                        </div>

                        <div>
                            <label></label>
                            <p class="mt-2">=</p>
                        </div>

                        <div class="col-md-3 col-lg-3">
                        <label>Actual Amount: </label>
                        <input type="text" name="amount" value="<?= $amt ?>" class="form-control" id="amount" readonly>
                        </div>

                        <div class="col-md-3 col-lg-3">
                        <label>Net Amount ( - Commission): </label>
                        <input type="text" name="net_amount" value="<?= $amt - ($commission * $deli) ?>" class="form-control" id="net" readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        
                    </div>

                    <div class="row mt-4">
                    <?php $tot_comm=0;
                    $tot_comm = ($commission * $deli);
                    $net = $amt - $tot_comm;
                    
                    $net_prev = $net - $paid;
                     ?>
                        <?php //if ($prev_due != false){ ?>
                        <div class="col-md-3 col-lg-3">
                        <label>Previous Paid: </label>
                        <input type="text" value="<?= $paid; ?>" class="form-control" id="paid" readonly>
                        </div>
                        <?php //} ?>
                        <!-- <div class="col-md-3 col-lg-3">
                        <label>Previous Due: </label>
                        <input type="text" value="<?= $prev_due; ?>" class="form-control" id="prev_due" readonly>
                        </div> -->

                        <div class="col-md-3 col-lg-3">
                        <label>Currently Received: </label>
                        <input type="number" name="received" min="0" class="form-control" id="cash" required>
                        </div>

                        
                        <div class="col-md-3 col-lg-3">
                            <label>Cash Due: </label>
                            <select name="due_amount" class="form-control">
                            <option id="due"><?= $net_prev ?></option>
                            </select>
                        </div>
                        
                        

                        

                        <input type="submit" name="submit" value="Submit" class="btn btn-secondary col-md-12 mt-5" id="proceed">
                        
                    </div>
                </form>

                <h4 id="message" class="mt-3" style="color: red;"></h4>
        </div>
    </div>
</div>
</div>

<div id="res"></div>

</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#cash").keyup(function(){

        var amt = parseInt($('#net').val(), 10);
        var paid = parseInt($('#paid').val(), 10);
        var cash = parseInt($('#cash').val(), 10);
        var due = parseInt($('#prev_due').val(), 10);
        
        var diff = (amt - cash) - paid;

        $('#due').text(diff); 
        console.log(diff);
        console.log(due);
    });

    var net = parseInt($('#net').val(), 10);
    var paidd = parseInt($('#paid').val(), 10);
    if (net == paidd){
        document.getElementById('proceed').disabled = true;
            $('#message').text('All Dues Are Cleared.');
    }

    if ($('#amount').val() == 0){
            // $('#proceed').hide();
            document.getElementById('proceed').disabled = true;
            $('#message').text('Items Not Delivered Yet.');
        }
    $('#loading-image').hide();
});
</script>