<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Payments for Trainees
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/addpayment2' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Last Name: </div>
						<div class="placeholdertb">
							<input name='lname' type='text' value='<?php echo set_value('lname'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">First Name: </div>
						<div class="placeholdertb">
							<input name='fname' type='text' value='<?php echo set_value('fname'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Training ID: </div>
						<div class="placeholdertb">
							<input name='trid' type='text' value='<?php echo set_value('trid'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Search"/></div>
					<div id="clear"></div> <?php //------------------------- Next Function -----------------?>
				</form>
				
				<div id="generalinfo_header">
					<p>Other Payments</p>
				</div>
				
				<form name='search' action='<?php echo base_url()?>cash/addpayment3/2' method='post'>
					<div class="spacer">
						<div class="anchortext">Payor: </div>
						<div class="placeholdertb">
							<input name='fullname' type='text' value='<?php echo set_value('fullname'); ?>' style="width:300px;" required />
						</div>
					</div>
					
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Add Payment"/></div>
					<div id="clear"></div> 
				</form>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>