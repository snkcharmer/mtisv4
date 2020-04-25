<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add Payment Remarks on: <?php echo (empty($record["module"]) ? $record["typename"] : $record["module"]); ?>
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>cash/confirmaddremarks' method='post'>
					<?php echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors(); ?>
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Remarks: </div>
						<div class="placeholdertb">
							<input name='remarks' type='text' value='' style="width:400px;" />
							<input name='paylistid' type='text' value='<?php echo $record["paylistid"] ?>' style="width:300px;" hidden read-only />
							<input name='payid' type='text' value='<?php echo $record["payid"] ?>' style="width:300px;" hidden read-only />
						</div>
					</div>
					
					<div class="spacer floatright" style="margin-top: 10px;">
						<input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Confirm"/>
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