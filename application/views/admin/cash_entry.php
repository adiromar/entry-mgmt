  <main class="app-content mb-5">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Cash Transaction Details</h1>
      <p>Bulk Cash Transactions Of Particular Branch:</p>
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
          <form id="form" method="post" action="<?= base_url()?>posts/save_cash">
            <div class="row">
             <div class="col-md-3 mb-4" >
               <h5>Branch Name</h5>
                 <select class="form-control" name="branch" id="change">
                    <option value="all">Choose Branch</option>
                    <?php
                    foreach ($branch as $val) { 
                    echo '<option>'.$val['location'].'</option>'; 
                    } ?>
                 </select>
             </div>
            
          <div class="col-md-2 col-lg-2">
            <label>Cash Paid</label>
            <input type="number" name="cash" class="form-control" required>
          </div>

          <div class="col-md-2 col-lg-2">
            <label>Extra Commission Paid</label>
            <input type="number" name="ext_comm" class="form-control" required>
          </div>

          <div class="col-md-3">
            <label>Cash Paid Date</label>
            <input type="date" id="dates" name="date" class="form-control cc" autocomplete="off">
          </div>

          <!-- <div class="col-md-3">
            <label>Date</label>
            <input type="date" data-date="" data-date-format="yy-mm-dd" class="form-control">
          </div> -->
          
          <div>
            <a class="btn btn-danger" onclick="document.getElementById('dates').value = ''" style="margin-top: 32px;color: #fff">X</a>
          </div>
        </div>

        <div class="row">

          <div class="col-md-12 mt-4">
          <button type="submit" id="filter" name="enter" class="btn btn-success col-md-10">Submit</button>
          </div>
        </div>
      </form>

<div id="here"></div>
        </div>
      </div>
    </div>
  </div>

 
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#loading-image').hide();

    $("#branch_formss").submit(function(){
      var val = $(this).val();
      // alert(val);
      $.post('<?= base_url()?>posts/save_cash', $('#branch_forms').serialize(),   
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

    $("form[id=form]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
      });
});
</script>