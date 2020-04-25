<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Modules > Edit</p></div>
				
				<form name='search' action='<?php echo base_url()?>modules/edit_module' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="txtcontainer">
						<div class="anchortext">Module Code: </div>
						<div class="placeholdertb">
							<input name='modcode' type='text' value='<?php echo $mod->modcode ?>' disabled />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Module Name: </div>
						<div class="placeholdertb">
							<input name='descriptn' type='text' style="width: 758px;" value='<?php echo $mod->descriptn ?>' />
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Short Name: </div>
						<div class="placeholdertb">
							<input name='modsht' type='text' value='<?php echo $mod->module ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">No. of Days: </div>
						<div class="placeholdertb">
							<input name='ndays' type='text' value='<?php echo $mod->ndays ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Hours: </div>
						<div class="placeholdertb">
							<input name='hours' type='text' value='<?php echo $mod->hours ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Fee: </div>
						<div class="placeholdertb">
							<input name='fee' type='text' value='<?php echo $mod->fee ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Venue: </div>
						<div class="placeholdertb">
							<input name='venue' type='text' value='<?php echo $mod->venue ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Section: </div>
						<div class="placeholdertb">
							<input name='section' type='text' value='<?php echo $mod->section ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Max: </div>
						<div class="placeholdertb">
							<input name='max' type='text' value='<?php echo $mod->max ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Certificate Series: </div>
						<div class="placeholdertb">
							<input name='certnum' type='text' value='<?php echo $mod->lastno ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Compendium: </div>
						<div class="placeholdertb">
							<input name='compendium' type='text' value='<?php echo $mod->compendium ?>'/>
						</div>
					</div>
					<?php /* <div class="txtcontainer">
						<div class="anchortext">Assessment: </div>
						<div class="placeholdertb">
							<input name='assessment' type='text' value='<?php #echo $mod->assessmentfee ?>'/>
						</div>
					</div> */ ?>
					<div class="txtcontainer">
						<div class="anchortext">
							Active:
						</div>
						<div class="placeholdertb">
							<?php 
								$active['Y'] = 'Yes'; 
								$active['N'] = 'No'; 
							?>
							<?php echo form_dropdown('active', $active, $mod->active, 'id="active"'); ?>
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