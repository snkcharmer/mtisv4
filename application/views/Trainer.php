<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Add > Trainer</p></div>
				<form name='search' action='<?php echo base_url()?>home/savetrainer' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="txtcontainer"><div class="anchortext">Last Name:</div><div class="placeholdertb"><input name='lname' type='text' value='<?php echo set_value('lname'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo set_value('fname'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name: </div><div class="placeholdertb"><input name='mname' type="text" value='<?php echo set_value('mname'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Suffix: </div><div class="placeholdertb"><input name='suffix' type='text' id='suffix' value='<?php echo set_value('suffix'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Birth Date:</div><div class="placeholdertb"><input name='bday' type='date' value='<?php echo set_value('bday'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Sex: </div>
					<div class="placeholdertb">
							<?php $sex['M'] = 'Male'; ?>
							<?php $sex['F'] = 'Female'; ?>
							<?php echo form_dropdown('sex', $sex, '#', 'id="sex"'); ?>
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Address: </div><div class="placeholdertb"><input name='venue' type='text' value='<?php echo set_value('venue'); ?>' style="width:758px;"/></div></div>
					<div class="txtcontainer"><div class="anchortext">Zipcode: </div><div class="placeholdertb"><input name='max' type='text' id="max" value='<?php echo set_value('max'); ?>' /></div></div>
					<div class="txtcontainer"><div class="anchortext">Active: </div>
					<div class="placeholdertb">
							<?php $active['1'] = 'Yes'; ?>
							<?php $active['0'] = 'No'; ?>
							<?php echo form_dropdown('active', $active, '1', 'id="active"'); ?>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>	
				</form>
				<div id="clear"></div>
				<div id="generalinfo_header"><p>Search > Trainer</p></div>
					<table cellspacing="0" cellpadding="0" style="width: 100%; margin-left:5px;">
						<thead>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Suffix</th>
							<?php //<th>Action</th> ?>
						</thead>
						<?php foreach ($records as $rows) {?>
						<tr>
							<td><label><?php echo $rows['lname']?></label></td>
							<td><?php echo $rows['fname']?></td>
							<td><?php echo $rows['mname']?></td>
							<td><?php echo $rows['suffix']?></td>
							<?php /* <td>
								<a href='<?php echo base_url()?>deletetrainer/<?php echo $rows['trainerid'];?>' onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
							</td>  */ ?>
						</tr>
						<?php } ?>
					</table>
					<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>