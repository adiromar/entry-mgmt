<?php
$user_id=$this->session->userdata('user_id');
$user_type = $this->user_model->get_user_type($user_id);
$user_type = $user_type[0]['user_type'];

?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> <?= $title ?>:</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admins/index"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><?= $title?></li>
    </ul>
  </div>
<style type="text/css">
  .eye-view{
    color: #cb8888;
    font-size: 22px;
  }

  .eye-view:hover {
    color: #009688;
  }

  .hid{
    opacity: 0;
  }
</style>

<?php if($this->session->flashdata('post_updated')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; 
  endif;
  if($this->session->flashdata('price')): 
    echo '<p class="alert alert-success">'.$this->session->flashdata('price').'</p>'; 
  endif;
  if($this->session->flashdata('post_deleted')): 
    echo '<p class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>'; 
  endif; ?>

<div class="row">
  <div class="col-md-12">
  <div class="tile">
        <div class="tile-body">
<table class="table table-striped table-bordered table-responsive">
            <thead class="thead-light">
              <tr>
                <th>S.N.</th>
                <!-- <th>Branch</th> -->
                <th>Item Name</th>
                <th>Item Price (Unit)</th>
                <th>New Price</th>
                <th>Add New Price</th>
                <!-- <th>Effective From</th> -->
                <th></th>
              </tr>  
            </thead>
            <tbody>
              <?php 
              // echo '<pre>';
              // print_r($stock);
              $i = 1+$page;
              foreach ($items as $val) { 
                echo '<form method="post" action="'.base_url().'posts/updateprice">';
                
                echo '<tr>';
                  echo '<td>'.$i.'</td>';
                  // echo '<td>'.$val['branch'].'</td>';
                  echo '<td>'.$val['item_name'].'</td>';
                  echo '<td>'.$val['price'].'</td>';
                  echo '<td>'.$val['new_price'].'</td>';
                  
                  echo '<td><input type="number" min="0" name="newprice"></td>';
                  // echo '<td><input type="date" name="effective_from"></td>';
                  echo '<td><input type="submit" name="go" value="Set New Price" class="btn btn-info"></td>';
                  // hidden values
                  echo '<input type="hidden" name="item_name" value="'.$val['item_name'].'">';
                  echo '<input type="hidden" name="id" value="'.$val['id'].'">';
                  // foreach ($stock as $stk) {
                  //   if ($val['item_name'] == $stk['items']){
                  //     echo '<td>'.$stk['sold'].'</td>';
                  //     echo '<td>'.($val['quantity'] - $stk['sold']).'</td>';
                  //   }
                  // }
                  
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

<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
