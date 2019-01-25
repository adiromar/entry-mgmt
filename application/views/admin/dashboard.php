  <main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Place Requested Order To Respective Branch</h1>
      <p>For Sending Orders Info To Branch:</p>
    </div>

    <a class="btn btn-secondary" href="<?php echo base_url(); ?>admins/entry_log"><i class="app-menu__icon fa fa-eye"></i>View Entry Log</a>
  </div>

<?php if($this->session->flashdata('entry')): 
    echo '<p style="text-align: center;" class="alert alert-success">'.$this->session->flashdata('entry').'</p>'; 
  endif; ?>
  <?php if($this->session->flashdata('entry_error')): 
    echo '<p style="text-align: center;" class="alert alert-danger">'.$this->session->flashdata('entry_error').'</p>'; 
  endif; ?>

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
    <div class="col-md-12 col-sm-6">
      <div class="tile">
        <div class="tile-body">
            <form method="post" id="entry_save" action="<?= base_url(); ?>posts/save_entry">

      <h4 class="mt-4 mb-5" style="text-align: center;text-decoration: underline;color:#363736;">Data Entry Form</h4>
      <div class="multi-field-wrapper">
          <label class="col-md-3 col-sm-3 offset-0">Info + Mobile Number: </label>
          <label class="offset-2 col-sm-3 col-md-1">Location: </label>
          <label class="offset-2 col-sm-3 col-md-1">Items: </label>
        <div class="multi-fields">
            <div class="row multi-field mb-3">
        <div class="col-md-5 col-lg-5 col-sm-3">
          
          <!-- <input type="text" name="mob_number" class="form-control" pattern="[9][678][0-9]{8}" placeholder="Enter Valid Mobile No." required> -->
          <input type="text" name="mob_number[]" class="form-control" placeholder="Eg. John Doe 9841556677" required>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-3">
          
          <!-- <input type="number" name="location" class="form-control"> -->
          <select class="form-control" name="location[]" required>
            <option value="">Select Location</option>
            <?php
            foreach ($loca as $val) {
              echo '<option>'.$val['location'].'</option>';
            } ?>
          </select>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-4">
          
          <select class="form-control" name="item_name[]" id="sec_tbl" required>
            <option value="">Select Items</option>
            <?php
            foreach ($entry as $val) { ?>
              <option value="<?= $val['item_name']?>"><?= $val['item_name']?></option>
            <?php } ?>
          </select>
        </div>

        <?php //$items = '<p id="all_price"></p>';
              //$alls = $this->admin_model->fetch_all_prices($items); 
              //$pri = $alls[0]['price']; ?>
              <!-- <div class="col-md-2">
              <select id="foreign_tbl" name="price" class="form-control">
              <?php foreach ($alls as $all => $vals) {
                echo '<option data-group="'.$vals['item_name'].'">'.$vals['price'].'</option>';
              }
              ?>
            </select>
          </div> -->

        <button type="button" class="btn btn-success btn-sm float-right" id="add-field" style="margin-top: 0px; height: 40px;">+</button>
        <button type="button" class="btn btn-danger remove-field ml-2" style="margin-top: 0px; height: 40px;display: none;">-</button>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-2 col-sm-2 col-lg-2">
          <label>Quantity</label>
          <input class="form-control" id="qty" type="number" name="quantity" min="0">
        </div> -->

        <!-- <div class="col-md-2 col-lg-2">
          <label>Price</label>
          <select id="price" class="form-control" name="price">
            <option id="app_here"></option>
            <?php
            foreach ($entry as $val) { ?>

              <option data-group="<?= $val['item_name']?>"><?= $val['price']?></option>
            <?php } ?>
          </select>
        </div> -->

        <div class="col-md-12 mt-5 mb-5">
          <input type="submit" name="enter" value="Submit" class="btn btn-secondary col-md-12">
        </div>
    </form>

        </div>
      </div>
    </div>
</div>

      </div>
    </div>
  </div>
  </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $("#add-field", $(this)).click(function(e) {
      // alert('clicked');
      console.log('works');
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find("input:text").val("").focus();
        $('.multi-field:last-child .remove-field').show();

    });
    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});

  $(document).ready(function(){
           $("form[id=entry_save]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });

      $(function(){
    $('#sec_tbl').on('change', function(){
        var val = $(this).val();
        
        var sub = $('#foreign_tbl');
        $('option', sub).filter(function(){
            if (
                 $(this).attr('data-group') === val 
              || $(this).attr('data-group') === 'SHOW'
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $('#foreign_tbl').trigger('change');
});

$(function() {
    $('#sec_tbl').on('change', function (e) {
    $('#foreign_tbl').val('');
        var endingChar = $(this).val().split('').pop();       
        var selected = $( '#sec_tbl' ).val();
          $('#foreign_tbl option').addClass('show');
          $('#foreign_tbl option[value^='+selected+']').toggleClass('show');
    })
})
});
</script>

