<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Fees Edit
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/ornum/addconfirm' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Fee Name: </div>
						<div class="placeholdertb">
							<input name='typename' type='text' value='<?php echo $record["typename"] ?>' style="width:300px;" />
							<input name='paycatid' type='text' value='<?php echo $record["paycatid"] ?>' style="width:300px;" hidden read-only />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Fee Short Name: </div>
						<div class="placeholdertb">
							<input name='typeshort' type='text' value='<?php echo $record["typeshort"] ?>' style="width:300px;" />
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Category: </div>
							<?php 
							foreach ($categories->result_array() as $key)
							{
								$cat[$key['paycatid']] = $key['catname'];
							}
							?>
							<div class="placeholdertb">
								<?php 
								echo form_dropdown('cat', $cat,$record["paycatid"],'id="cat" style="width:414px"'); 
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