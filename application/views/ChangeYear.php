<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Change Current Year</p></div>
				<form name='search' action='<?php echo base_url()?>home/confirmchangeyear' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer"><div class="anchortext">Current Year:</div>
						<div class="placeholdertb">
							<input id='year' name='year' type='text' style='width: 300px;' value='<?php echo $this->session->userdata("currentyear"); ?>' placeholder="Input desired year" required/>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:120px;float:left; font-size:25px; margin-left: 100px;" value="Save" /></div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>