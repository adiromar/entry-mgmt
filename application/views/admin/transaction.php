  <main class="app-content mb-5">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Transaction Details</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
    </div>
    <!-- <ul class="app-breadcrumb breadcrumb"> -->
      <!-- <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li> -->
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    <!-- </ul> -->

    <a href="<?= base_url(); ?>admins/view_cash_flow" class="btn btn-info">View Cash Flow</a>
  </div>
<?php if($this->session->flashdata('location_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('location_added').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('location_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('location_error').'</p>'; 
  endif; ?>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <form id="branch_forms" method="post" action="">
            <div class="row">
             <div class="col-md-3 mb-4" >
               <h5>Sort by branch</h5>
                 <select class="form-control" name="branch" id="change">
                    <option value="all">Choose Branch (All)</option>
                    <?php
                    foreach ($branch as $val) { 
                    echo '<option>'.$val['location'].'</option>'; 
                    } ?>
                 </select>
             </div>

          <div class="col-md-3">
            <label>Date</label>
            <input type="date" id="dates" name="date" class="form-control cc" autocomplete="off">
          </div>

          <!-- <div class="col-md-3">
            <label>Date</label>
            <input type="date" data-date="" data-date-format="yy-mm-dd" class="form-control">
          </div> -->
          

          <div>
            <a class="btn btn-danger" onclick="document.getElementById('dates').value = ''" style="margin-top: 32px;color: #fff">X</a>
          </div>

          <div class="col-md-2" style="margin-top: 32px;">
          <button type="submit" id="filter" class="btn btn-success">Filter</button>
          </div>
        </div>
      </form>

        </div>
      </div>
    </div>
  </div>

 <div id="loading-image">loading...</div>

 <table class="table table-striped table-bordered">
      <thead style="background-color: lightblue;">
        <tr>
          <th>S.N.</th>
          <th>Item Name</th>
          <th>Delivered</th>
          <th>Price</th>
          <th>Actual Amount</th>
          <th>Commission</th>
          <th>Total Stock</th>
          <th>Stock Left</th>
          <th>Cash Paid</th>
          <th>Due Left</th>
          <th>Verify</th>
        </tr>
      </thead>
      <tbody id="here">
          <?php 
          // $i = 1;
          // foreach ($details as $val) {
          //   echo '<tr>';
          //   echo '<td>'.$i.'</td>';
          //   echo '<td>'.$val['items'].'</td>';
          //   echo '<td>'.$val['deli'].'</td>';
          //   echo '<td>'.$val['canc'].'</td>';
          //   echo '<td>'.$val['not_rec'].'</td>';
          //   echo '<td>'.$val['inq'].'</td>';
          //   echo '<td>'.$val['later'].'</td>';
          //   echo '<td>'.$val['emp'].'</td>';

          //   echo '</tr>';
          // $i++; } ?>

      </tbody>
    </table>
</main>
<div id="app"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#loading-image').hide();

    $("#branch_forms").submit(function(){
      var val = $(this).val();
      // alert(val);
      $.post('<?= base_url()?>admins/get_cash_due', $('#branch_forms').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1100);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#here').show('slidedown').html(data);
        }, 1105);
         // $('.loading').show().html(data);
    });
    return false;
    });
});
</script>