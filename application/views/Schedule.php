<?php require_once('include/header.php'); ?>
<script src="<?php echo base_url()?>js/datatable.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );
} );
</script>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header" ><p>
					<form name='search' action='<?php echo base_url()?>schedule/index' method='post' style="float:left;">
						<div style="float:left;">Search Schedule
						<input type="text" name="search" style="font-size:15px; width:200px; margin-left: 5px" />
						</div></p>
					</form>
						<div id='cssmenu' style="float:left;margin-top:-10px;height:45px;">
							<ul>
								<?php if ($this->session->userdata("user_level") == 1)
								{ ?>
								<li><a href='#' id="edit" target="_blank">Edit</a></li>
								<?php /**<a href='<?php echo base_url()?>schedule/Delete/<?php echo $rows['code'];?>'>Delete</a><br /> **/ ?>
								<li><a href='#' onClick="alert('Cannot delete schedule, please call Administrator for confirmation.')">Delete</a></li>
								<?php } ?>
								<li><a href='#' id="grades" target="_blank">Grades</a></li>
								<li><a href='#' id="certificate" target="_blank">Certificate</a></li>
								<li class='has-sub'><a href='#'>Trainer</a>
									<ul>
										<li><a href='#' id="trainer" target="_blank">Add Trainer</a></li>
										<li><a href='#' id="deltrainer" target="_blank">Delete Trainer</a></li>
									</ul>
								</li>	
								<li class='has-sub'>
									<a href='#'>
										<img src="<?php echo base_url()?>images\printer.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
										Print
									</a>
									<ul>
										<li><a href='#' id="ORL" target="_blank">ORL</a></li>
										<li><a href='#' id="preliminary" target="_blank">Preliminary List</a></li>
										<li><a href='#' id="blankgradesheet" target="_blank">Blank Grade Sheet</a></li>
										<li><a href='#' id="regform" target="_blank">Print Registration Form</a></li>
									</ul>
								</li>		
							</ul>
						</div>
					
					<div style="clear:both;"></div>
				</div>

				
				
				
				<table class="example" cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:10px;"></th>
						<th style="width:60px;">Code</th>
						<th style="width:150px">Module</th>
						<th style="width:20px">Batch</th>
						<th style="width:70px">Start</th>
						<th style="width:70px">End</th>
						<th style="width:20px">Hrs</th>
						<th style="width:20px">Room</th>
						<?php /**<th>Fee</th> **/ ?>
						<th style="width:20px">Venue</th>
						<th style="width:20px;">Max</th>
						<th style="width:20px;">Size</th>
						<th>Trainer</th>
						<th>GR</th>
						<th>CT</th>
					<?php if ($this->session->userdata("user_level") == 1)
							{ ?>
						<th>User</th>
					<?php } ?>
					</thead>
					<?php 
						$x = 0;
						foreach ($records as $rows) { ?>
					<tr>
						<td><input type="radio" name="code" id="code<?php echo $x; ?>" value="<?php echo $rows['code']?>" onclick="callmeMaybe(<?php echo $rows['code']?>)"></input></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['code']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['module']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['batch']?></label></td>
						<td style="width:70px"><label for="code<?php echo $x; ?>"><?php echo $rows['start']?></label></td>
						<td style="width:70px"><label for="code<?php echo $x; ?>"><?php echo $rows['end']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['hours']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['room']?></label></td>
						<?php /**<td><?php echo $rows['fee']?></td> **/ ?>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['venue']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['max']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['size']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['trainergroup']?></label></td>
						<td>
							<label for="code<?php echo $x; ?>">
								<?php if ($rows["gradeok"] == "Y") { ?>
									<img src="<?php echo base_url()?>images\verified2.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } elseif ($rows["gradeok"] == "C") { ?>
									<img src="<?php echo base_url()?>images\verify.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } else { ?>
									<img src="<?php echo base_url()?>images\pending.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } ?>
							</label>
						</td>
						<td>
							<label for="code<?php echo $x; ?>">
								<?php if ($rows["certiok"] == "Y") { ?>
									<img src="<?php echo base_url()?>images\verified2.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } elseif ($rows["certiok"] == "C") { ?>
									<img src="<?php echo base_url()?>images\verify.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } else { ?>
									<img src="<?php echo base_url()?>images\pending.png" style="height: 15px; width: auto; vertical-align:middle; padding-right:2px">
								<?php } ?>
							</label>
						</td>
						<?php if ($this->session->userdata("user_level") == 1)
							{ ?>
						<td></td>
						<?php } ?>
					</tr>
					<?php $x++; } ?>
				</table>
				<div style="margin-top:10px">
				<?php 
				//echo $this->session->userdata('currentyear');
				echo $this->pagination->create_links(); 
				?>
				</div>
			</div>
		</div>
	</div>
	<script>
		function callmeMaybe(lols)
		{
			<?php if ($this->session->userdata("user_level") == 1)
			{ ?>
			document.getElementById('edit').href='<?php echo base_url()?>schedule/Edit/'+lols;
			<?php } ?>
			document.getElementById('grades').href='<?php echo base_url()?>schedule/grades/'+lols;
			document.getElementById('certificate').href='<?php echo base_url()?>schedule/certificate/'+lols;
			document.getElementById('trainer').href='<?php echo base_url()?>schedule/trainer/'+lols;
			document.getElementById('deltrainer').href='<?php echo base_url()?>schedule/deltrainer/'+lols;
			document.getElementById('blankgradesheet').href='<?php echo base_url()?>schedule/printblankgradesheet/'+lols;
			document.getElementById('ORL').href='<?php echo base_url()?>schedule/printORL/'+lols;
			document.getElementById('preliminary').href='<?php echo base_url()?>schedule/printpreliminarylist/'+lols;
			document.getElementById('regform').href='<?php echo base_url()?>printrecord/printregistrationform/'+lols;
		}
	</script>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>