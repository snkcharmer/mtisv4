<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Search Payments</p></div>
				<?php echo $this->session->flashdata('message'); ?>
				<?php echo validation_errors();?>
				<form name='search' action='<?php echo base_url()?>cash/payment/searchresult' method='post'>
					<div class="spacer"><div class="anchortext">Trainee ID:</div>
						<div class="placeholdertb">
							<input id='trid' name='trid' type='text' style='width: 300px;' value='<?php echo set_value('trid'); ?>'/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">OR No.:</div>
						<div class="placeholdertb">
							<input id='ornum' name='ornum' type='text' style='width: 300px;' value='<?php echo set_value('ornum'); ?>'/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Payor:</div>
						<div class="placeholdertb">
							<input id='payor' name='payor' type='text' style='width: 300px;' value='<?php echo set_value('payor'); ?>'/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Date:</div>
						<div class="placeholdertb">
							<input id='paydate' name='paydate' type='date' style='width: 300px;' value='<?php echo set_value('paydate'); ?>'/>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px; " value="Search" /></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>