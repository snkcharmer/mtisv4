<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>Advanced Search Schedule</p>
				</div>
				<?php  echo $this->session->flashdata('message'); ?>
				<?php echo validation_errors();?>

				<div class="txtcontainer"><div class="anchortext">Batch Number:</div><div class="placeholdertb"><input name='batch' type='text' value='<?php echo set_value('batch'); ?>' required /></div></div>
				<div class="txtcontainer"><div class="anchortext">Start: </div><div class="placeholdertb"><input name='start' type='date' value='<?php echo set_value('start'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">End: </div><div class="placeholdertb"><input name='end' id="date" type="date" value='<?php echo set_value('end'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">No. of Days:</div><div class="placeholdertb"><input name='ndays' type='text' id='ndays' required value='<?php echo set_value('ndays'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">Room:</div><div class="placeholdertb"><input name='room' type='text' required value='<?php echo set_value('room'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">Fee: </div><div class="placeholdertb"><input name='fee' type='text' id="fee" value='<?php echo set_value('fee'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">Venue: </div><div class="placeholdertb"><input name='venue' type='text' required value='<?php echo set_value('venue'); ?>'/></div></div>
				<div class="txtcontainer"><div class="anchortext">Max: </div><div class="placeholdertb"><input name='max' type='text' id="max" value='<?php echo set_value('max'); ?>' required /></div></div>
				<div class="spacer floatright" style="margin-top: 10px;"><input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>