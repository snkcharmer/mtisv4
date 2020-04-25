<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>List of Trainee
						<?php $reg = $this->session->userdata("reg");
						if ($reg == 1) { ?>
						<a href="<?php echo base_url()?>trainee/newtrainee"><button style="float:right; color:#000" type="button">Register New Trainee</button></a>
						<?php } ?>
					</p>
				</div>
				
				<?php  echo $this->session->flashdata('message'); ?>
				
				<table cellspacing="0" cellpadding="0" class="tablenopadding">
					<thead>
						<th style="width:70px">Trainee ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th style="width:100px">Middle Name</th>
						<th style="width:30px">Ext</th>
						<th style="width:250px"></th>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td><label><?php echo $rows['trid']?></label></td>
						<td><?php echo $rows['lname']?></td>
						<td><?php echo $rows['fname']?></td>
						<td><?php echo $rows['mname']?></td>
						<td><?php echo $rows['suffix']?></td>
						<td>
							<a href='<?php echo base_url()?>trainee/edit/<?php echo $rows['trid'];?>'>Edit</a>
								<?php 
							if ($this->session->userdata("user_level") == 1)
							{ ?>|
								<?php /**<a href='trainee/delete/<?php echo md5($rows['trid']) ?>' onClick="return confirm('All trainings and payments would be deleted. Are you sure you want to DELETE this Trainee? ')">Delete</a> **/ ?>
								<a href='<?php echo base_url()?>trainee/delete/<?php echo $rows['trid'] ?>' onClick="return confirm('Do not DELETE if Trainee has record on other Trainings. Please check on Enroll option. Are you sure you want to delete?')">Delete</a>
							<?php } ?>| 
							<a href='<?php echo base_url()?>trainee/training/<?php echo $rows['trid'] ?>' > Trainings</a> | 
							<a href='<?php echo base_url()?>trainee/createid/<?php echo $rows['trid'] ?>' > Create ID</a> |
							<a href='<?php echo base_url()?>trainee/enroll/<?php echo $rows['trid']?>' >Enroll</a></td>
					</tr>
					<?php } ?>
				</table>
				<div style="margin-top:10px">
				<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php require_once('include/footer.php'); ?>
</body>
</html>