<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>

<div id="container">
	<div id="mid">
	
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		<script src="<?php echo base_url()?>js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{     
				
				function pad (str, max) {
					str = str.toString();
					return str.length < max ? pad("0" + str, max) : str;
				}
				
				$('#fillseries').click(function(){    
					var module_id = $('#modcode').val();  
					//alert(module_id);
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>home/getcertificateseries/"+module_id,
						success: function(data) 
						{
							//console.log(data.series.code);
							lols = data.series.code.lastno;
							modcode = "<?php echo $schedule['code']?>";
							var year = modcode.substr(0, 4); 
							//lols = data.series.code.lastno;
							//console.log(year);
							var sernum = prompt("Last series number: ", lols);
							arr = sernum.split("-");
							if (arr[0] == ""){arr[0] = 0}
							if (isNaN(arr[1])){arr[1] = 0}
							//console.log(arr.length);
							for(i = 0;i < <?php echo $records->num_rows(); ?>; i++)
							{
								if(arr.length < 3){
									document.getElementById("certnumber[" + i + "]").value = arr[0]+"-"+year+ "-" + pad((parseInt(arr[1]) + i + 1),5);
								}else{
									document.getElementById("certnumber[" + i + "]").value = arr[0]+"-"+year+ "-" + pad((parseInt(arr[2]) + i + 1),5);
								}
								
								var today = new Date();
								
								document.getElementById("certdate[" + i + "]").value = today.toISOString().substring(0, 10);
							}
						}
						<?php /*error: function(lols)
						{
							alert(JSON.stringify(lols));
						} */ ?>
					});
				});
				
				$('#fillseriesdate').click(function(){  
					var serdate = prompt("Date yyyy/MM/dd (2018-05-31): ");
					for(i = 0;i < <?php echo $records->num_rows(); ?>; i++)
					{
						document.getElementById("certdate[" + i + "]").value = serdate;
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
						<a href="<?php echo base_url()?>schedule/certificate/<?php echo $schedule["code"]?>" style="font-size:20px;">Certificate</a> > 
						Edit [<?php echo $schedule["code"]." - ".$schedule["module"]; ?>]
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="hidden" name="modcode" value="<?php echo $this->session->userdata("code"); ?>" id="modcode" />
						<a href="#" id="fillseries">Fill Series</a> | 
						<a href="#" id="fillseriesdate">Fill Date</a>
						
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>schedule/confirmeditcertificate' method='post'>
					<input type="hidden" name="end" value="<?php echo $end->end ?>" />
					<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
						<thead>
							<th style="width:150px">License</th>
							<th style="width:150px">Rank</th>
							<th style="width:300px">Trainee</th>
							<th>Company</th>
							<th style="width:40px">Grade</th>
							<th>Remarks</th>
							<th>Number</th>
							<th>Issued</th>
						</thead>
						
						<?php $xx = 0;
						foreach($records->result_array() as $key) {  ?>
						<tr>
							<td><?php echo $key['license']?></td>
							<td><?php echo $key['rank']?> <input type="hidden" name="trainingid[]" value="<?php echo $key["trainingid"]; ?>" /></td>
							<td><?php echo $key['fullname']?></td>
							<td><?php echo $key['name']?></td>
							<td><?php echo $key['fgrade']?></td>
							<td></td>
							<td><input type="text" name="certnumber[]" id="certnumber[<?php echo $xx ?>]" value="<?php echo $key["certnumber"]; ?>" style="width:95%"/></td>
							<td><input type="date" name="certdate[]" id="certdate[<?php echo $xx ?>]" value="<?php echo $key["certdate"]; ?>" style="width:200px"/></td>
						</tr>
						<?php $xx++; } ?>
					</table>
					<div class="spacer floatright" style="margin-top: 10px;">
						<input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/>
						<a href="<?php echo base_url()?>schedule/certificate/<?php echo $schedule["code"]?>" style="font-size:20px;">
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