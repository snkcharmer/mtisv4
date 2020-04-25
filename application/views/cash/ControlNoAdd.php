<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add Control No.
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/addcontrolno' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">After OR No.: </div>
						<div class="placeholdertb">
							<input name='firstornum' type='text' value='<?php echo set_value('firstornum'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Control No.: </div>
						<div class="placeholdertb">
							<input name='controlno' type='text' value='<?php echo set_value('controlno'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">OR No.: </div>
						<div class="placeholdertb">
							<input name='ornum' type='text' value='<?php echo set_value('ornum'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Amount: </div>
						<div class="placeholdertb">
							<input name='amount' type='text' value='<?php echo set_value('amount'); ?>' style="width:300px;" />
						</div>
					</div>
					<?php /*<div class="spacer">
						<div class="anchortext">Remaining Amount: </div>
						<div class="placeholdertb">
							<input name='remamount' type='text' value='<?php echo set_value('remamount'); ?>' style="width:300px;" />
						</div>
					</div> */ ?>
					<div class="spacer">
						<div class="anchortext">Date: </div>
						<div class="placeholdertb">
							<input name='dateadded' type='date' value='<?php echo set_value('dateadded'); ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Category: </div>
						<?php 
						foreach ($record->result_array() as $key)
						{
							$cat[$key['paycatid']] = $key['catname'];
						}
						?>
						<div class="placeholdertb">
							<?php 
							echo form_dropdown('cat', $cat,1,'id="cat" style="width:414px"'); 
							?>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;">
						<input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/>
					</div>
					
					<div id="clear"></div> 
				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>