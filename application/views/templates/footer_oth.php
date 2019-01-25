<?php $yes = date('Y-m-d',strtotime("-1 days")); ?>
<div class="footer-content">
<h4 style="color: #fff;text-align: center;">Quick Links</h4>
    <div class="foot-wrapper">
        <div class="list-links">
            <ul class="foot-links" id="foot-links">
                <li><a href="<?php echo base_url(); ?>pages/view_entry"> View Entry</a></li>
                <li><a href="<?php echo base_url(); ?>pages/item_details" class=""> Report</a></li>
                <li><a href="<?php echo base_url(); ?>pages/stocks_info" class=""> Stocks Info</a></li>
                <li><a href="<?php echo base_url(); ?>pages/transactions" class=""> Transactions</a></li>
                <li><a href="<?php echo base_url(); ?>pages/interested" class=""> Confirmed</a></li>
                <li><a href="<?php echo base_url(); ?>pages/cancelled" class=""> Delivered/Cancelled</a></li>
                <li><a href="<?php echo base_url(); ?>pages/later" class=""> Later/Call Not Received</a></li>
                <li><a href="<?php echo base_url(); ?>pages/return_items" class=""> Return Items</a></li>
                <li><a href="<?php echo base_url(); ?>pages/daily_entry/<?= $yes?>" class="">Daily Entry</a></li>
                <li><a href="<?php echo base_url('user/logout');?>"> Log Out</a></li>
            </ul>
        </div>
    </div>

<script src="<?php echo base_url(); ?>assets_front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</div>
</body>
</html>