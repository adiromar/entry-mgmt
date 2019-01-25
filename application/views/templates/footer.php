<?php $yes = date('Y-m-d',strtotime("-1 days"));
$yes1 = 'ht'; ?>
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
    

    <
</div>

<!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets_front/vendor/jquery/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets_front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function() {
	// get current URL path and assign 'active' class
	var home = 'http://encoderslab.com';
	var pathname = window.location.pathname;
	var pathname = home + pathname;
	console.log(pathname);
	$('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
})
    </script>

</body>

</html>