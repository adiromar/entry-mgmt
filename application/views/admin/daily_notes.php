  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Daily Notes (Status)</h1>
      <p>Sent By Branch:</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>

<style type="text/css">
  .hr{
    border-top: 2px solid #d9cdcd;
    padding-top: 10px;
  }

  .app_div{
    border: 2px solid #b9b3b3;
    padding: 12px;
    margin-top: 15px;
    border-radius: 36px;
  }
  img{
    width: 85px;
  }
</style>


  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">

        <?php echo form_open('', 'class="email" id="myforms"'); ?>
        
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <label>Branch Name:</label>
                <select class="form-control" name="location" required>
              <option value="">Select Location</option>
            <?php
            foreach ($loca as $val) {
              echo '<option>'.$val['location'].'</option>';
            } ?>
          </select>
              </div>
              
              <div class="col-md-4">
                <label>Transaction Date: </label>
                <input type="text" name="new_date" id="datepicker" value="" class="form-control" autocomplete="off">
              </div>

              <div class="col-md-2 mt-4">
              <input type="submit" name="go" value="Filter" class="btn btn-success">
            </div>
            </div>
          </div>
          <?php echo form_close(); ?>

<div id="loading-image" style="display: none;height:55px;" class="loading-div">Please Wait..<img class="loading-image" src="<?= base_url();?>assets_front/facebook.gif"></div>
<div id="app_here"></div>

        <table class="table table-striped table-bordered mt-4">
              <thead class="" style="background-color: #6b706b;color:#fff;">
        <tr>
          <th>S.N.</th>
          <th>Branch Name</th>
          <th>Item Name</th>
          <th>Total Sent</th>
          <th>Total Delivered</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody id="here">
          <?php 
          $i = 1;
          foreach ($note as $val) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$val['branch'].'</td>';
            echo '<td>'.$val['item_name'].'</td>';
            echo '<td>'.$val['item_delivered'].'</td>';
            echo '<td>'.$val['item_delivered'].'</td>';
            echo '<td>'.$val['date'].'</td>';            
            echo '</tr>';
          $i++; } ?>

      </tbody>
    </table>

    <div class="row">
        <div class="col-md-12">
            <?php //echo $pagination; ?>
        </div>
</div>
       	</div>
       </div>
   </div>
</div>

</main>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $( function() {
    var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

      // $('#loading-image').hide();
    $(document).ready(function(){
      $("#myforms").submit(function(){
        // alert("alert");
      $.post('<?= base_url()?>posts/filter_daily_admin', $('#myforms').serialize(),   
        function (data, textStatus) {
            $("#loading-image").show();
        setTimeout(function() {
            $("#loading-image").hide();
        }, 1600);
      // $( "#view_data" ).hide();
      setTimeout(function() {
            $('#here').show('fadein').html(data);
        }, 1605);
    });
    return false;
    });
});
  </script>