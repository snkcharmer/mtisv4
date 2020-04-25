

<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
				<form action="<?php echo base_url()?>trainee/trainingconfirmedit" method='post' name='enroll'>
				<div id="generalinfo_header"><p style="margin-bottom: 0px;">Edit Training Records > <?php echo $code["module"] . " - " . $code["code"]; ?></p></div>
					<input name='trid' type='text' value="<?php echo $record['trid']; ?>" readonly hidden/>
					<input name='trainingid' type='text' value="<?php echo $record['trainingid']; ?>" readonly hidden/>
					<input name='code' type='text' value="<?php echo $record['code']; ?>" readonly hidden/>
					<div class="txtcontainer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><input name='lname' type='text' value="<?php echo $records['lname']?>" disabled /></div></div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo $records['fname']?>' disabled /></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo $records['mname']?>' disabled /></div></div>
					<div class="txtcontainer"><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo $records['suffix']?>' style="width:40px;" disabled /></div></div> 
				<div id="clear"></div>
					<div style="text-align:left;">	
						<div class="txtcontainer">
							<div class="anchortext">License Name: </div>
							<div class="placeholdertb">
							<?php 
							foreach ($licenses as $key)
							{
								$lic[$key['licid']] = $key['license'];
							}
							
							$lic['0'] = 'Please Select';
							$currentlic = ($record["licid"] == NULL ? "#" : $record["licid"]);
							echo form_dropdown('licid', $lic, $currentlic, 'id="license" style="width:400px"'); 
							?>
							<a href="<?php echo base_url()?>home/license">Add License...</a>
							</div>
						</div>
					</div>
					<div id="clear"></div>
					<div style="text-align:left;">
						<div class="txtcontainer">
							<div class="anchortext">Current Rank:</div>
							<div class="placeholdertb">
							<?php 
								$key = NULL;
								foreach ($ranks as $key)
								{
									$rank[$key['rankid']] = $key['rank'];
								}
								$rank['0'] = 'Please Select';
								$currentrank = ($record["rankid"] == NULL ? "#" : $record["rankid"]);
								echo form_dropdown('rankid', $rank, $currentrank, 'id="rank" style="width:400px"'); 
								?> <a href="<?php echo base_url()?>home/rank">Add Rank...</a>
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Recent Sponsor: </div>
							<div class="placeholdertb">
							<?php 
								$key = NULL;
								foreach ($sponsor as $key)
								{
									$spon[$key['sponid']] = $key['sptypename'];
								}
								$spon['0'] = 'Please Select';
								$currentspon = ($record["sponid"] == 0 ? "0" : $record["sponid"]);
							echo form_dropdown('sponid', $spon, $currentspon, 'id="sponsor" style="width:400px"'); ?> <a href="<?php echo base_url()?>home/sponsor" target="_blank">Add Sponsor...</a>
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Recent Employer: </div>
							<div class="placeholdertb">
							<?php 
								$key = NULL;
								foreach ($employer as $key)
								{
									$empl[$key['employid']] = $key['name'];
								}
								$empl['0'] = 'Please Select';
								$currentemployer = ($record["employid"] == 476 ? "476" : $record["employid"]);
							echo form_dropdown('employer', $empl, $currentemployer, 'id="employer" style="width:400px"'); ?> <a href="<?php echo base_url()?>home/employer" target="_blank">Add Employer...</a>
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Final Grade:</div>
							<div class="placeholdertb">
								<input name='fgrade' type='text' value='<?php echo $record['fgrade']?>' style="width: 100px" />
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Reexam Grade:</div>
							<div class="placeholdertb">
								<input name='compgrade' type='text' value='<?php echo $record['compgrade']?>' style="width: 100px" />
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Comp Ref:</div>
							<div class="placeholdertb">
								<input name='compref' type='text' value='<?php echo $record['compref']?>' style="width: 100px" />
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Comp Date:</div>
							<div class="placeholdertb">
								<input name='compdate' type='date' value='<?php echo $record['compdate']?>' style="width: 150px" />
							</div>
						</div>
						<div class="spacer">
							<div class="anchortext">Certificate:</div>
							<div class="placeholdertb">
								<input name='cert' type='text' value='<?php echo $record['certnumber']?>' style="width: 130px" />
							</div>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 30px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
				
				</form>
			</div>
		</div>
	</div>
</div>

<?php //require_once('include/footer.php'); ?>
</body>
</html>