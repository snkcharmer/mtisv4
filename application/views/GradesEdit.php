<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		<script type="text/javascript">
			function lols(lost)
			{
				var amt0 = parseFloat($('#amt'+lost+'0').val());
				var amt1 = parseFloat($('#amt'+lost+'1').val());
				var amt2 = parseFloat($('#amt'+lost+'2').val());
				var amt3 = parseFloat($('#amt'+lost+'3').val());
				document.getElementById('fgrade'+lost).value = Math.round((amt0 + amt1 + amt2 + amt3) / 4);
			}
		</script>
		
		<script>
			$(document).ready(function()
			{     
				$('#filldate').click(function(){ 
					
					for(i = 0;i < <?php echo $records->num_rows(); ?>; i++)
					{
						var today = new Date();
						if (document.getElementById("gradedate[" + i + "]").value == "")
						{
							document.getElementById("gradedate[" + i + "]").value = today.toISOString().substring(0, 10);
						}
						
					}
							
				});
			});
		</script>
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content2" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						<a href="<?php echo base_url()?>schedule" style="font-size:20px;">Schedule</a> > 
						<a href="<?php echo base_url()?>schedule/grades/<?php echo $schedule["code"]?>" style="font-size:20px;">Grades</a> > 
						Edit [<?php echo $schedule["code"]." - ".$schedule["module"]; ?>]
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" id="filldate">Fill Date</a>
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>schedule/confirmeditgrades' method='post'>
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
					<?php
					$xx = 0;					
					foreach($submodgrades as $row => $key) {  $x = 0; $total = 0; $ifselect = 0; ?>
					<tr>
						<td><?php echo $key['license']?> <input type="hidden" name="trid[]" value="<?php echo $row; ?>" /></td>
						<td><?php echo $key['rank']?> <input type="hidden" name="trainingid[]" value="<?php echo $key["trainingid"]; ?>" /></td>
						<td><?php echo $key['fullname']?></td>
						<?php /*<td><?php echo $key['name']?></td>*/?>
						
						<?php if ($submodule->num_rows() > 0) {?>
							<?php foreach($key["grade"] as $grades => $lols) { $ifselect = 1; ?>
								<td>
									<input type="hidden" name="submodid[<?php echo $x; ?>][]" value="<?php echo $lols["submodid"]; ?>" />
									<input type="hidden" name="subtrainid[<?php echo $x; ?>][]" value="<?php echo $lols["subtrainid"]; ?>" />
									<input type="text" id="amt<?php echo $row.$x?>" name="grades[<?php echo $x; ?>][]" value="<?php echo $lols["fgrade"]?>" style="width:30px; text-align: center"/>
								</td>
							<?php $total = $lols["fgrade"] + $total; $x++;} ?>
							
							<?php /**if ($submodsched->num_rows() > 0 && $ifselect == 0){ #didi masulod it kanan BT?>
								<?php foreach($submodsched->result_array() as $grades) { ?>
									<input type="hidden" name="submodid[<?php echo $x; ?>][]" value="<?php echo $lols["submodid"]; ?>" />
									<input type="hidden" name="subtrainid[<?php echo $x; ?>][]" value="<?php echo $lols["subtrainid"]; ?>" />
									<input type="text" id="amt<?php echo $row.$x?>" name="grades[<?php echo $x; ?>][]" value="<?php echo $lols["fgrade"]?>" style="width:45px; text-align: center"/>
								<?php #$total = $lols["fgrade"] + $total; 
									$x++; } ?>
							<?php } **/ ?>
							
							<td><input type="text" name="fgrade[]" value="<?php echo (empty($total) ? $key["fgrade"] : $total / $x); ?>" style="width:45px; text-align: center" id="fgrade<?php echo $row?>" onclick="lols(<?php echo $row?>)"/></td>
						<?php } else { ?> 
							<td><input type="text" name="fgrade[]" value="<?php echo (empty($total) ? $key["fgrade"] : $total / $x); ?>" style="width:45px; text-align: center" id="fgrade<?php echo $row?>" /></td>
						<?php } ?>
						
						
						<td><input type="text" name="compgrade[]" value="<?php echo $key["compgrade"]; ?>" style="width:80px"/></td>
						<td><input type="date" name="compdate[]" id="gradedate[<?php echo $xx ?>]" value="<?php echo (empty($key["compdate"]) ? NULL : $key["compdate"]); ?>" style="width:160px;"/></td>
						<td><input type="text" name="compref[]" value="<?php echo $key["compref"]; ?>" style="width:80px"/></td>
						<?php /*<td><input type="text" name="remarks[]" value="<?php echo $row; ?>" style="width:80px"/></td> */ ?>
					</tr>
					<?php $x++; $xx++; } ?>
				</table>
					<div class="spacer floatright" style="margin-top: 10px;">
						<input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save" /> 
						<a href="<?php echo base_url()?>schedule/grades/<?php echo $schedule["code"]?>" style="font-size:20px;">
							<input type="button" style="height:40px;width:200px;float:left; font-size:25px; margin-left:10px;" value="Cancel" />
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>