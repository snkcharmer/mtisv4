<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add OR to System
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/ornum/addconfirm' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Starting OR No.: </div>
						<div class="placeholdertb">
							<input name='firstornum' type='text' value='' style="width:300px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Last OR No.: </div>
						<div class="placeholdertb">
							<input name='lastornum' type='text' value='' style="width:300px;" />
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Category: </div>
							<?php 
							foreach ($record->result_array() as $key)
							{
								$cat[$key['paycatid']] = $key['catname'];
							}
							?>
							<div class="placeholdertb"><?php echo form_dropdown('cat', $cat,'id="cat" style="width:414px"'); ?></div>
						</div>
					<div class="spacer"><div class="anchortext">Office: </div>
						<?php 
						foreach ($venue->result_array() as $key)
						{
							$ven[$key['venid']] = $key['venue'];
						}
						?>
						<div class="placeholdertb"><?php echo form_dropdown('venue', $ven, $this->session->userdata("venid"),'id="venue"'); ?></div>
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