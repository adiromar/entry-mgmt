  <?php 
  date_default_timezone_set('Asia/Kathmandu');
  $now = date('Y-m-d H:i:s');
  // $now = '2018-12-03 10:07:40';
  // $get = $this->page_model->get_all_price('watch', $now);
  // echo '<pre>';
  // $new = $get[0]['price'];
  // echo $new;
  // print_r($get);die;
  ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Send Items to Branch</h1>
      <p>Stocks, Unit Price & Commission to branch:</p>
    </div>

    <a class="btn btn-secondary" href="<?php echo base_url(); ?>admins/view_branch_items"><i class="app-menu__icon fa fa-eye"></i><span class="app-menu__label"></span>View Items (Branch)</a></li>
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
        	<?php echo form_open('posts/send_items_to_branch', array('class' => 'mt-4', 'id' => 'form')) ?>
        	<div class="row col-md-12 col-sm-12">
            <div class="col-md-4 col-sm-4 col-lg-4">
              <label>Branch Name: </label>
              <select name="branch" class="form-control" id="branch" required>
                <option value="">Choose Branch</option>
                <?php foreach ($location as $loc) {
                  echo '<option>'.$loc['location'].'</option>';
                } ?>
              </select>
            </div>
        		<div class="col-md-4 col-sm-4 col-lg-4">
        			<label>Item Name: </label>
        			<!-- <input type="text" name="item_name" class="form-control" required> -->
              <select class="form-control" name="item_name" id="item_name" required>
                <option>Select Item</option>
            <?php
            foreach ($entry as $val) { 
              ?>
              <option data-group="<?= $val['id'] ?>" value="<?= $val['item_name']?>" data-item="<?= $val['item_name'] ?>" data-price="<?= $val['price'] ?>"><?= $val['item_name']?></option>
            <?php } ?>
              </select>
        		</div>
            <select name="item_id" id="idd" style="display: none;">
              <option id="here"></option>
            </select>

        		<div class="col-md-2 col-sm-2 col-lg-2">
        			<label>Item Quantity : </label>
        			<input type="number" name="quantity" class="form-control" min="0" required>
        		</div>
            <p></p>
            <div class="col-md-2 col-sm-2 col-lg-2">
              <label>Extra Quantity: </label>
              <input type="number" name="extra_quantity" class="form-control" min="0" placeholder="Default 0">
            </div>

        		<div class="col-md-4 col-sm-3 col-lg-4 mt-4">
        			<label>Per Unit Price: </label>
        			<!-- <input type="number" name="price" min="0" class="form-control" required> -->
              <select class="form-control" name="price" required>
                <option id="price"></option>
              </select>


              <?php //$items = '<p id="all_price"></p>';
              //$alls = $this->admin_model->fetch_all_prices($items); 
              //$pri = $alls[0]['price']; ?>
              <!-- <select id="foreign_tbl" name="price" class="form-control"> -->
              <?php //foreach ($alls as $all => $vals) {
                //echo '<option data-group="'.$vals['item_name'].'">'.$vals['price'].'</option>'; } ?>
            <!-- </select> -->
              <!-- <select>
                <option id="all_price"></option>
              </select> -->
        		</div>

            <div class="col-md-4 col-sm-3 col-lg-4 mt-4">
              <label>Branch Commission: </label>
              <input type="number" name="commission" min="0" class="form-control" required>
              <?php
              $item = '<p id="name_item"></p>';
              $brnch = '<p id="brnch"></p>';

              ?>
              <!-- <select class="form-control" name="commission" required>
                <option id="comm"></option>
              </select> -->
            </div>

        		<!-- <div class="col-md-12 col-sm-4 col-lg-12 mt-4"> -->
        			<input type="submit" name="submit" class="btn btn-primary col-md-12 col-sm-3 mt-5">
        		<!-- </div> -->
        	</div>

        	<?php form_close(); ?>
       	</div>
       </div>
   </div>
</div>

</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#item_name').on('change', function() {
      // var fromVal = $(this).val();
  
  var id = $('#item_name option:selected').data('group');
  var price = $('#item_name option:selected').data('price');
  var item = $('#item_name option:selected').data('item');

  // var pp = $('#new_place option:selected').data('val');
  // var branch = $('#brnch option:selected').val();  

  $('#here').text(id);
  jQuery("#price").text(price)
  // $('#all_price').text(item);
  // alert(price);
});

// $(function(){
//     $('#sec_tbl').on('change', function(){
//         var val = $(this).val();
        
//         var sub = $('#foreign_tbl');
//         $('option', sub).filter(function(){
//             if (
//                  $(this).attr('data-group') === val 
//               || $(this).attr('data-group') === 'SHOW'
//             ) {
//                 $(this).show();
//             } else {
//                 $(this).hide();
//             }
//         });
//     });
//     $('#foreign_tbl').trigger('change');
// });

// $(function() {
//     $('#sec_tbl').on('change', function (e) {
//     $('#foreign_tbl').val('');
//         var endingChar = $(this).val().split('').pop();       
//         var selected = $( '#sec_tbl' ).val();
//           $('#foreign_tbl option').addClass('show');
//           $('#foreign_tbl option[value^='+selected+']').toggleClass('show');
//     })
// })

     $("form[id=form]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
      });
})
</script>