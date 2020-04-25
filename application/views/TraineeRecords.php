<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Trainees Record</p></div>
					<table cellspacing="0" cellpadding="0" style="width:100%;">
						<thead>
							<th>Code</th>
							<th>Module</th>
							<th>Start</th>
							<th>End</th>
							<th>Fin Grade</th>
							<th>Reexam</th>
							<th>Reexam Date</th>
							<th>Reexam Ref</th>
							<th>Cert</th>
							<th>License</th>
							<th>Rank</th>
							<th>Employer</th>
							<th>Edit</th>
						</thead>
						<?php foreach($training as $train){ ?>
						<tr>
							<td><?php echo $train->code?></td>
							<td><?php echo $train->module?></td>
							<td><?php echo $train->start?></td>
							<td><?php echo $train->end?></td>
							<td><?php echo $train->fgrade?></td>
							<td><?php echo $train->compgrade?></td>
							<td><?php echo $train->compdate?></td>
							<td><?php echo $train->compref?></td>
							<td><?php echo $train->certnumber?></td>
							<td><?php echo $train->license?></td>
							<td><?php echo $train->rank?></td>
							<td><?php echo $train->name?></td>
							<td><a href="<?php echo base_url()?>trainee/trainingedit/<?php echo $train->trainingid; ?>">Edit</a></td>
							<?php /**<td><a href="<?php echo base_url()?>printrecord/proofofregistration/<?php echo $train->trainingid?>" target="blank">Print</a>
								<?php if ($train->verified == "N") { ?>
									<a href="<?php echo base_url()?>trainee/deletetraining/<?php echo $train->code?>" onClick="return confirm('Delete This Training?')">Delete</a> 
								<?php } ?>
							</td> */ ?>
						</tr>
						<?php } ?>
					</table>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>