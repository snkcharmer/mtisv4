<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div class="midShadow" id="content2">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						<a href="<?php echo base_url()?>schedule" style="font-size:20px;">Schedule</a> > 
						<a href="<?php echo base_url()?>schedule/grades/<?php echo $schedule["code"]?>" style="font-size:20px;">Grades</a> [
						<?php echo $schedule["code"]." - ".$schedule["module"]; ?> ] &nbsp;&nbsp;&nbsp;&nbsp; 
						<?php if ($schedule["gradeok"] != "Y") { ?>
						<img src="<?php echo base_url()?>images/edit.PNG" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
						<a href="<?php echo base_url()?>schedule/editgrades">Edit Grades</a> | 
						<?php } ?>
						<img src="<?php echo base_url()?>images/printer.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
						<a href="<?php echo base_url()?>schedule/printgrade/<?php echo $code ?>" target="_blank">Print</a> |
						<?php 
						if ($this->session->userdata("user_level") == 1) {
							if($schedule["gradeok"] == "Y"){ ?>
								<a href="<?php echo base_url()?>schedule/uncheckgrade/<?php echo $code ?>">
									<img src="<?php echo base_url()?>images/pending.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">Uncheck
								</a> 
							<?php } else { ?>
								<a href="<?php echo base_url()?>schedule/verifygrade/<?php echo $code ?>">
									<img src="<?php echo base_url()?>images/verified2.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">Verify
								</a>
						<?php } 
							} else { 
								if ($this->session->userdata("user_level") == 2 and $schedule["gradeok"] == "N"){ ?>
								<a href="<?php echo base_url()?>schedule/checkgrade/<?php echo $code; ?>">
									<img src="<?php echo base_url()?>images/verify.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">Check
								</a>
							<?php } elseif ($this->session->userdata("user_level") == 2 and $schedule["gradeok"] == "C") { ?> 
								<a href="<?php echo base_url()?>schedule/uncheckgrade/<?php echo $code; ?>">
									<img src="<?php echo base_url()?>images/pending.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">Uncheck
								</a>
							<?php } 
							} 
							?>
						
						
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font style="color:#aaa; font-size:20px">
							Status: 
						</font>
						<?php if ($schedule["gradeok"] == "Y") { ?>
							<img src="<?php echo base_url()?>images\verified2.png" style="height: 20px; width: auto; vertical-align:middle; padding-right:2px">Verified
						<?php } elseif ($schedule["gradeok"] == "C") { ?>
							<img src="<?php echo base_url()?>images\verify.png" style="height: 20px; width: auto; vertical-align:middle; padding-right:2px">Checked / For Verification
						<?php } else { ?>
							<img src="<?php echo base_url()?>images\pending.png" style="height: 20px; width: auto; vertical-align:middle; padding-right:2px">Pending 
						<?php } ?>
						<?php /**
						<span class="btn" style="margin-left:30px"><a href="" class="btn">Edit</a></span>
						<span class="btn" style="margin-left:3px"><a href="" class="btn">Series</a></span>
						<span class="btn" style="margin-left:3px"><a href="" class="btn">Print</a></span>
						<span class="btn" style="margin-left:3px"><a href="" class="btn">Verify</a></span> **/ ?>
					</p>
					
				</div>
				<font style="color:#red"><?php  echo $this->session->flashdata('error'); ?></font>
				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						
							<th rowspan="2" style="width:80px">License</th>
							<th rowspan="2" style="width:80px">Rank</th>
							<th rowspan="2">Trainee</th>
							<?php /*<th rowspan="2">Company</th>*/?>
							<?php if ($submodule->num_rows() > 0) {?>
								<th colspan="<?php echo $submodule->num_rows() + 1; ?>" style="width:250px">Grade</th>
							<?php } else { ?>
								<th rowspan="2">Grade</th>
							<?php } $x = 0;?>
							<th rowspan="2">Comp</th>
							<th rowspan="2" style="width:160px">Date</th>
							<th rowspan="2">REFR</th>
							<?php #<th rowspan="2">Remarks</th> ?>
						
						<?php if ($submodule->num_rows() > 0) {?>
						<tr>
							<?php foreach ($submodule->result_array() as $rows){ ?>
								<th><?php echo $rows["submodule"]?></th>
							<?php } ?>
							<th>FGrade</th>
						</tr>
						<?php } ?>
					</thead>
					<?php #0------------Edit dd nian
						if ($submodgrades) 
						{
							foreach($submodgrades as $row => $key) { 
							$x = 0; $total = 0; $ifselect = 0 ?>
							<tr>
								<td><?php echo (empty($key['license']) ? "NONE" : $key['license'])?> </td>
								<td><?php echo (empty($key['rank']) ? "NONE" : $key['rank']) ?> </td>
								<td><?php echo $key['fullname']?></td>
								
								<?php if ($submodule->num_rows() > 0) {?>
									<?php foreach($key["grade"] as $grades => $lols) { $x++;?>
										<td>
											<?php echo $lols["fgrade"]; $ifselect = 1; ?>
										</td>
									<?php $total = $lols["fgrade"] + $total; } ?>
								<?php } ?>
								
								<?php if ($ifselect == 0 && $submodule->num_rows() > 0){?>
								<td></td><td></td><td></td><td></td> <?php } ?>
								<td><?php echo (empty($total) ? $key["fgrade"] : round($total / $x)); ?></td>
								<td><?php echo $key["compgrade"]; ?></td>
								<td><?php echo $key["compdate"]; ?></td>
								<td><?php echo $key["compref"]; ?></td>
								<?php /*<td><input type="text" name="remarks[]" value="<?php echo $row; ?>" style="width:80px"/></td> */?>
							</tr>
							<?php $x++; 
							}
						}
					?>
				</table>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>