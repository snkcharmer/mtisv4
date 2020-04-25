<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script>
		function lols()
		{
			if ($("#sex").val() == "#")
			{
				alert("Please select Gender");
			}
			else
			{
				$("#formadd").submit(); 
				$("#savebutton").disabled=true; 
				$("#savebutton").value='Sending…';
			}
		}
	</script>
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Register New Trainee</p></div>
				<form name='formadd' action='<?php echo base_url()?>trainee/addtrainee2' method='post' id="formadd">
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><input name='lname' type='text' value='<?php echo $this->session->userdata('lname'); ?>' /></div></div>
					<div class="spacer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo $this->session->userdata('fname'); ?>'/></div></div>
					<div class="spacer"><div class="anchortext">Middle Name: </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo set_value('mname'); ?>'/></div></div>
					<div class="spacer"><div class="anchortext">Suffix: </div><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo set_value('suffix'); ?>' style="width:170px;" /></div></div>
					<div class="spacer"><div class="anchortext">Sex: </div>
						<div class="placeholdertb">
							<?php 
							$sex['M'] = 'Male';
							$sex['F'] = 'Female';
							$sex['#'] = 'Please Select';
							echo form_dropdown('sex', $sex, '#','id="sex" required style="width: 185px;"'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Birth Date: </div><div class="placeholdertb"><input name='bdate' type='date' style="width: 170px;"/></div></div>
					<div class="spacer floatright" style="margin-top: 10px;">
						<button class="fadein" id="savebutton" type="button" style="height:40px;width:200px;float:left; font-size:25px;" onclick="lols()"/>
							Save
						</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>