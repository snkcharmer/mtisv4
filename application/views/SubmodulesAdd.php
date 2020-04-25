<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Submodules > Add</p></div>
				<form name='search' action='<?php echo base_url()?>submodules/add_module' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="txtcontainer">
						<div class="anchortext">Module:</div>
						<?php 
						foreach ($modules->result_array() as $key)
						{
							$mod[$key['modcode']] = $key['module'];
						}
						?>
						<div class="placeholdertb">
							<?php
							$mod['#'] = 'Please Select';								
							echo form_dropdown('modcode', $mod,'#'); 
							?>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Submodule Name: </div>
						<div class="placeholdertb">
							<input name='submodule' type='text' style="width: 300px;" value='<?php echo set_value('submodule'); ?>'/>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Description: </div>
						<div class="placeholdertb">
							<input name='description' type='text' value='<?php echo set_value('description'); ?>'/>
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