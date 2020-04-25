<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add Trainers to [Module Name: <?php echo $schedule->module ."-".$code?>]</p></div>
				<form name='search' action='<?php echo base_url()?>schedule/assigntrainer' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer">
						<div class="anchortext">Trainer Name: </div>
						<div class="placeholdertb">
						<?php 
						foreach ($trainers->result_array() as $key)
						{
							$trainer[$key['trainerid']] = $key['lname'].", ".$key['fname']." ".$key['mname'];
						}
						
						$trainer['#'] = 'Please Select';
						echo form_dropdown('trainer', $trainer, "#", 'id="trainer" style="width:500px"'); 
						?>
						</div>
					</div>
					
					<?php if ($withsubmod == TRUE) 
					{ ?>
						<div class="spacer">
							<div class="anchortext">Submodule: </div>
							<div class="placeholdertb">
							<?php 
							foreach ($submodules->result_array() as $key)
							{
								$submod[$key['submodid']] = $key['submodule'];
							}
							
							$submod['#'] = 'Please Select';
							echo form_dropdown('submod', $submod, "#", 'id="submod" style="width:500px"'); 
							?>
							</div>
						</div>
					<?php } ?>
					<div class="spacer floatright" style="margin-top: 10px;"><input type="submit" class="fadein" style="height:40px;width:200px;float:left; font-size:25px;" value="Add Trainer"/></div>

				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>