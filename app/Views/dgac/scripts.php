<script src="<?php echo base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url() ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="<?php echo base_url() ?>/assets/dist/js/app.min.js"></script>
<script src="<?php echo base_url() ?>/assets/dist/js/app.init.horizontal.js"></script>
<script src="<?php echo base_url() ?>/assets/dist/js/app-style-switcher.horizontal.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo base_url() ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url() ?>/assets/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url() ?>/assets/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url() ?>/assets/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- chartist chart -->
<!-- <script src="<?php echo base_url() ?>/assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> -->
<!--c3 JavaScript -->
<script src="<?php echo base_url() ?>/assets/libs/d3/dist/d3.min.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/c3/c3.min.js"></script>
<!-- Chart JS -->
<!-- <script src="<?php echo base_url() ?>/assets/dist/js/pages/dashboards/dashboard1.js"></script> -->

<script src="<?php echo base_url() ?>/assets/extra-libs/prism/prism.js"></script>

<script src="<?php echo base_url() ?>/assets/extra-libs/treeview/dist/bootstrap-treeview.min.js"></script>
<script>
	<?php $session = session(); ?>

	// Cierre de sesion
	var close_session = function close_session(){
		
		$.ajax({
            url:'<?php echo base_url('public/Usuario/close_session'); ?>',
            method: 'post',
            success: function(response){
                if( response == 'success' ){
                	window.location = "<?php echo base_url('public/login'); ?>";
                }
            }
        });
	}

	var sessionExpiration = function sessionExpiration(value_time){
		
		$.ajax({
            url:'<?php echo base_url('public/Usuario/refresh_session'); ?>',
            method: 'post',
            data: { 'sessionExpiration' : value_time },
            success: function(response){
                
            }
        });

	}

	var upgradeTime = function upgradeTime(){
		return <?php echo $session->sessionExpiration; ?>;
	}

	var upgradeTime = upgradeTime();
	var seconds = upgradeTime;
	function timer() {
	       var days        = Math.floor(seconds/24/60/60);
	       var hoursLeft   = Math.floor((seconds) - (days*86400));
	       var hours       = Math.floor(hoursLeft/3600);
	       var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
	       var minutes     = Math.floor(minutesLeft/60);
	       var value_remainingSeconds = document.getElementById('remainingSeconds').innerHTML;
	       var remainingSeconds = seconds % 60;
	       if (remainingSeconds < 10) {
	           remainingSeconds = "0" + remainingSeconds; 
	       }

	       if( isNaN(hours) == true ){
	       	document.getElementById('countdown').innerHTML = "";
	       }else{
	       	document.getElementById('countdown').innerHTML = hours + ":" + minutes + ":" + remainingSeconds;
	       }

	       if (seconds == 0) {
	       		clearInterval(countdownTimer);
	       		close_session();
	       } else {
	           seconds--;
	       }

	       if( minutes == 10 && remainingSeconds == 10 ){
	       		var doc; 
	       		var result = confirm("¿Te quedan menos de ("+minutes+") minutos, deseas aun permanecer en el sistema?"); 
	       		if (result == true) { 
	            	alert("Puede seguir continuando en el sistema...");
	            	sessionExpiration(minutes);

	        	} else { 
	            	close_session();
	        	}
	       }

	       document.getElementById('remainingSeconds').innerHTML = remainingSeconds;
	}


	var countdownTimer = setInterval('timer()', 1000);


</script>