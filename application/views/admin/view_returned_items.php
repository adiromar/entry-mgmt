  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i>Returned Items From Branch (Admin Approval)</h1>
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
  .qty{
  	width: 80px;
  	text-align: center;
  }
</style>

<?php if($this->session->flashdata('ret')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('ret').'</p>';
  endif; 
if($this->session->flashdata('ret_err')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('ret_err').'</p>'; 
  endif; 
  ?>

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
          <th>Quantity</th>
          <th>Reason</th>
          <th>Returned Date</th>
          <th>Status</th>
          <th>Verify</th>
        </tr>
      </thead>
      <tbody id="here">
          <?php 
          // echo '<pre>';
          // print($ret);
          $i = 1+$page;
          foreach ($ret as $val) {
          	echo '<form method="post" action="'.base_url().'posts/update_returned">';
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$val['branch'].'</td>';
            echo '<td>'.$val['item_name'].'</td>';
            // echo '<td>'.$val['quantity'].'</td>';
            echo '<td><input class="qty" type="number" name="quantity" min="0" max="'.$val['quantity'].'" value='.$val['quantity'].'></td>';
            echo '<td>'.$val['reason'].'</td>';
            echo '<td>'.$val['returned_date'].'</td>';
            echo '<td><select name="status">
            	<option>'.$val['status'].'</option>
            	<option>Approved</option>
            	<option>Declined</option>
            </select></td>';
            echo '<td><input type="submit" value="Save" class="btn btn-info"></td>';
            echo '<input type="hidden" name="item_name" value="'.$val['item_name'].'">';
            echo '<input type="hidden" name="branch" value="'.$val['branch'].'">';
            echo '<input type="hidden" name="data_id" value="'.$val['id'].'">';
            echo '<input type="hidden" name="item_id" value="'.$val['item_id'].'">';
            echo '</tr>';
            echo '</form>';
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