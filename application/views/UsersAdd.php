<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add User</p></div>
				<form name='search' action='<?php echo base_url()?>home/confirmadduser' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="spacer"><div class="anchortext">Employee: </div>
						<?php 
						foreach ($employees->result_array() as $key)
						{
							$emp[$key['empid']] = $key['lname'].", ". $key['fname']. " " . $key['mname'];
						}
						?>
						<div class="placeholdertb">
							<?php 
							$emp['#'] = 'Please Select';
							echo form_dropdown('empid', $emp, '#','id="empid" style="width:314px"'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Username:</div>
						<div class="placeholdertb">
							<input id='username' name='username' type='text' style='width: 300px;' value='<?php echo set_value('username'); ?>' required/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Password:</div>
						<div class="placeholdertb">
							<input id='password' name='password' type='password' style='width: 300px;' value='<?php echo set_value('password'); ?>' required/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Confirm Password:</div>
						<div class="placeholdertb">
							<input id='passwordf' name='passwordf' type='password' style='width: 300px;' value='<?php echo set_value('passwordf'); ?>' required/>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Account Type: </div>
						<div class="placeholdertb">
							<?php 
							$type['2'] = 'User';
							$type['1'] = 'Admin';
							$type['4'] = 'Cash_Admin';
							$type['3'] = 'Cash';
							echo form_dropdown('acctype', $type, '2','id="acctype" style="width:314px" required'); 
							?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Venue: </div>
						<div class="placeholdertb">
							<?php
								foreach ($venue as $rowss)
								{
									$ven[$rowss["venid"]] = $rowss["venue"];
								}
								echo form_dropdown('venue', $ven, $this->session->userdata("venid"), 'id="venue" style="width:314px" required'); ?>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px; margin-left: 160px;" value="Save" /></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>