<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>

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
									document.getElementById("certnumber[" + i + "]").value = arr[0]+"-"+year+ "-" + pad((parseInt(arr[1]) + i + 1),4);
								}else{
									document.getElementById("certnumber[" + i + "]").value = arr[0]+"-"+year+ "-" + pad((parseInt(arr[2]) + i + 1),4);
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
		
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content2" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						<a href="<?php echo base_url()?>schedule" style="font-size:20px;">Schedule</a> > 
						<a href="javascript:void(0);" style="font-size:20px;">Reissuance</a>  
						[<?php echo $schedule["code"]." - ".$schedule["module"]; ?>]
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="hidden" name="modcode" value="<?php echo $this->session->userdata("code"); ?>" id="modcode" />
						<a href="#" id="fillseries">Fill Series</a> | 
						<a href="#" id="fillseriesdate">Fill Date</a>| 
						
						
					</p>
				</div>
				<form name='search' class="reissue" action='<?php echo base_url()?>schedule/confirmreissuedcert' method='post'>
					<input type="hidden" name="end" value="<?php echo $end->end ?>" />
					<input type="hidden" name="trainingid" class="trainingid" value="">
					<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
						<thead>
							<th style="width:150px">License</th>
							<th style="width:150px">Rank</th>
							<th style="width:250px">Trainee</th>
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
							<td><?php echo $key['rank']?> <input type="hidden" name="trid[]" value="<?php echo $key["trainingid"]; ?>" /></td>
							<td><?php echo $key['fullname']?></td>
							<td><?php echo $key['name']?></td>
							<td><?php echo $key['fgrade']?></td>
							<td></td>
							<td><input type="text" name="certnumber[]" id="certnumber[<?php echo $xx ?>]" value="" style="width:95%"/></td>
							<td><input type="date" name="certdate[]" id="certdate[<?php echo $xx ?>]" value="" style="width:200px"/></td>
						</tr>
						<?php $xx++; } ?>
					</table>
					<div class="spacer floatright" style="margin-top: 10px;">
						<input type="button" class="confirmreis" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/>
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
<script type="text/javascript">
	$(document).on('click','.confirmreis', function() {

		
		var length = $("input[name='trid[]']").length;
		//console.log(lnght);
		var x = 1;
		var final = '';
	    $("input[name='trid[]']").each(function(){        
	        var values = $(this).val();
	        if (length == x) {
	        	final += values;
	        }else{
	        	final += values+",";
	        }
	        x++;
	    });

	   	$('.trainingid').val(final);
		//$('.enroll').submit();
		$('.reissue').submit();

		
	});	
</script>
</body>
</html>