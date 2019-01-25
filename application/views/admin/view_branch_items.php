  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> View Items Send To Branch</h1>
      <!-- <p>Send your Items Quantity and Price:</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>
<?php if($this->session->flashdata('item_added')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('item_added').'</p>'; 
  endif; 
if($this->session->flashdata('error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('error').'</p>'; 
  endif; 
if($this->session->flashdata('duplicate')): 
    echo '<p style="text-align: center;" class="alert alert-warning">'.$this->session->flashdata('duplicate').'</p>'; 
  endif; 
  ?>
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
</style>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
              <table class="table table-striped table-bordered">
              <thead class="thead-dark">
        <tr>
          <th>S.N.</th>
          <th>Branch Name</th>
          <th>Item Name</th>
          <th>Total Quantity</th>
          <th>Ext. Quantity</th>
          <th>Price</th>
          <th>Commission</th>
          
          <!-- <th>In Stock</th> -->
          <th>Sent Date</th>
        </tr>
      </thead>
      <tbody id="here">
          <?php 
          $i = 1+$page;
          // echo '<pre>';
          // print_r($branch_stk);die;
          foreach ($branch_stk as $val) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$val['branch'].'</td>';
            echo '<td>'.$val['item_name'].'</td>';
            echo '<td>'.$val['quantity'].'</td>';
            echo '<td>'.$val['extra_quantity'].'</td>';
            echo '<td>'.$val['price'].'</td>';
            echo '<td>'.$val['commission'].'</td>';
            echo '<td>'.$val['sent_date'].'</td>';
            
            echo '</tr>';
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