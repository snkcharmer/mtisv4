<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Submodules > Edit</p></div>
				
				<form name='search' action='<?php echo base_url()?>submodules/edit_module' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer">
						<div class="anchortext">Module:</div>
						<?php 
						foreach ($modules->result_array() as $key)
						{
							$lols[$key['modcode']] = $key['module'];
						}
						?>
						<div class="placeholdertb">
							<?php
							$lols['#'] = 'Please Select';								
							echo form_dropdown('modcode', $lols,$mod->modcode); 
							?>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Submodule Name: </div>
						<div class="placeholdertb">
							<input name='submodule' type='text' value='<?php echo $mod->submodule ?>'/>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Description: </div>
						<div class="placeholdertb">
							<input name='description' type='text' value='<?php echo $mod->description ?>'/>
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