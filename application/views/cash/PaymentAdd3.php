<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add Payment
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/confirm_addpayment' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Payor: </div>
						<div class="placeholdertb">
							<input name='payor' type='text' value='<?php echo $payor ?>' readonly required />
							<input name='trid' type='text' value='<?php echo $trid ?>' readonly required hidden />
						</div>
					</div>
					
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Date: </div>
						<div class="placeholdertb">
							<input name='paydate' type='date' value='<?php echo date('Y-m-d');?>' required />
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
								echo form_dropdown('cat', $cat,'id="cat" style="width:414px"'); 
								?>
							</div>
						</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>