  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> View Purchases</h1>
      <!-- <p>Set your Item name and Fields:</p> -->
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
        	<table class="table table-bordered table-striped">
        		<thead class="thead-light">
        			<tr>
        				<th>S.N</th>
        				<th>Item Name</th>
        				<th>Purchase Price</th>
        				<th>Quantity</th>
        				<th>Purchased By</th>
        				<th>Purchased Date</th>
        				<th>Remarks</th>
        			</tr>
        		</thead>
            <tbody>
              <?php $i =1;
              foreach ($purchases as $val) {
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$val['item_name'].'</td>';
                echo '<td>'.$val['purchased_price'].'</td>';
                echo '<td>'.$val['quantity'].'</td>';
                echo '<td>'.$val['purchased_by'].'</td>';
                echo '<td>'.$val['purchased_date'].'</td>';
                echo '<td>'.$val['remarks'].'</td>';
              $i++; } ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</main>