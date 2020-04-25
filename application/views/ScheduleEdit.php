<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{     
			$('#module').change(function(){    
				$("#dataTable tr").remove();
				$("#dataTable thead").remove();
				var module_id = $('#module').val();  
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getfee/"+module_id,
					success: function(data) 
					{
						$("#max").val(data.module_details.mod.max);
						$("#fee").val(data.module_details.mod.fee);
						$("#ndays").val(data.module_details.mod.ndays);
						
						$('<thead>').html("<th>Code</th><th>Batch</th><th>Start</th><th>End</th>").appendTo('#dataTable');
						
						$.each(data.schedule,function(code,batch)
						{
							$('<tr>').html("<td>" + code + "</td><td>" + batch.batch + "</td><td>" + batch.start + "</td><td>" + batch.end + "</td>").appendTo('#dataTable');
							//$("#code").text(JSON.stringify(max));
							//$("#batch").text(JSON.stringify(fee));
						});
						
						
					}
				});
				 
			});
		});
		// ]]>
	</script>
	
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Edit Schedule</p></div>
				<form name='search' action='<?php echo base_url()?>schedule/validateedit' method='post'>
					<?php echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<?php foreach ($records->result_array() as $row) { 
						echo '<div class="txtcontainer" style="width:100%;"><div class="anchortext">Code No.: </div>'. '<div class="placeholdertb" style="float:left;">'.form_input('code', $row['code'],'readonly').'</div></div>';
						echo '<div class="txtcontainer">
								<div class="anchortext">
									Course:
								</div>
								<div class="placeholdertb">';
									
									$module['#'] = 'Please Select'; 
						echo form_dropdown('module_id', $module, $mod->modcode, 'id="module" style="width:170px"');
						echo '</div></div>';
						//echo $mod->module;
						echo '<div class="txtcontainer"><div class="anchortext">Batch Number: </div>'. '<div class="placeholdertb">'.form_input('batch', $row['batch']).'</div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">Start: </div><div class="placeholdertb"><input name="start" type="date" value="'.$row["start"].'" /></div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">End: </div><div class="placeholdertb"><input name="end" type="date" value="'.$row["end"].'" /></div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">No. of Days: </div>'. '<div class="placeholdertb">'.form_input('ndays', $row['ndays']).'</div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">Room: </div>'. '<div class="placeholdertb">'.form_input('room', $row['room']).'</div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">Fee: </div>'. '<div class="placeholdertb">'.form_input('fee', $row['fee']).'</div></div>';
						// echo '<div class="txtcontainer"><div class="anchortext">Venue: </div>'. '<div class="placeholdertb">'.form_input('', $row['venue']).'<input name="venue" type="hidden" value="'.$row["venid"].'" /></div></div>';
						echo '<div class="txtcontainer">
								<div class="anchortext">
									Venue:
								</div>
								<div class="placeholdertb">';
									
									$venue1['#'] = 'Please Select'; 
						echo form_dropdown('venue', $venue1, $row['venid'], 'id="venue" style="width:170px"');
						echo '</div></div>';
						echo '<div class="txtcontainer"><div class="anchortext">Max: </div>'. '<div class="placeholdertb">'.form_input('max', $row['max']).'</div></div>';
						echo '<div class="spacer floatright" style="margin-top: 10px;"><input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>';
						}
					?>
			</form>
			
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>