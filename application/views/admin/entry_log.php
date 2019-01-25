  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> View Entry Log</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <?php
          // echo '<pre>';
          // print_r($records);
          ?>

          <table class="table table-bordered table-striped">
          <thead style="background-color: #dee2e6">
          <tr>
            <th>S.N.</th>
            <th>Mobile Number</th>
            <th>Other Info</th>
            <th>Location</th>
            <th>Items</th>
            <!-- <th>Price</th> -->
            <th>Status</th>
            <th>Remarks</th>
            <th>Entry Date</th>
            <th>Modified Date</th>
        </tr>
      </thead>
        <tbody>
          <?php $i = 1+$page;$check=0;$chk=0;$dups = array();
          foreach ($records as $key => $val) { 
            if ($val['status'] == ''){
              $check = count($val['status']);
              $chk += $check;
            }
            $str = $val['mobile_number'];
            preg_match_all('!\d+!', $str, $matches); 
            $words = preg_replace('/\d/', '', $str);

            if ($matches[0] != null){ // error handling if empty
              $mob_no = $matches[0][0];
            }else{
              $mob_no = '';
            }

            echo '<tr>';
              echo '<td>'.$i.'</td>';
              echo '<td>'.$mob_no.'</td>';
              echo '<td>'.$words.'</td>';
              echo '<td>'.$val['location'].'</td>';
              echo '<td>'.$val['items'].'</td>';
              echo '<td>'.$val['status'].'</td>';
              echo '<td>'.$val['remarks'].'</td>';
              echo '<td>'.$val['inserted_time'].'</td>';
              echo '<td>'.$val['modified_date'].'</td>';
          $i++; } ?>
        </tbody>
</table>

<div class="row">
        <div class="col-md-12">
            <?php echo $pagination; ?>
        </div>
</div>

        </div>
      </div>
    </div>
  </div>

</main>