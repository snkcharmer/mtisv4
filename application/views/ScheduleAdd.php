<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	
	<script type="text/javascript">
		$(document).ready(function()
		{     
			$('#module').change(function(){ //any select change on the dropdown with id module trigger this code   	
				$("#dataTable tr").remove();
				$("#dataTable thead").remove();
				var module_id = $('#module').val();  // here we are taking module id of the selected one.
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getfee/"+module_id, //here we are calling our user controller and get_fee method with the module_id
					success: function(data) //we're calling the response json array 'fee'
					{
						$("#max").val(data.module_details.mod.max);
						$("#fee").val(data.module_details.mod.fee);
						$("#ndays").val(data.module_details.mod.ndays);
						$("#generalinfo").animate({height: "600px"}, 400);
						
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
				<div id="generalinfo_header"><p>Add Schedule</p></div>
				<form name='search' action='<?php echo base_url()?>schedule/validateschedule' method='post'>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div class="txtcontainer"><div class="anchortext">Code:</div><div class="placeholdertb"><input name='code' type='text' disabled /></div></div>
					<div class="txtcontainer">
						<div class="anchortext">
							Course:
						</div>
						<div class="placeholdertb">
							<?php $module['#'] = 'Please Select'; ?>
							<?php echo form_dropdown('module_id', $module, '#', 'id="module"'); ?>
						</div>
					</div>
					<div class="txtcontainer"><div class="anchortext">Batch Number:</div><div class="placeholdertb"><input name='batch' type='text' value='<?php echo set_value('batch'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">Start: </div><div class="placeholdertb"><input name='start' type='date' value='<?php echo set_value('start'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">End: </div><div class="placeholdertb"><input name='end' id="date" type="date" value='<?php echo set_value('end'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">No. of Days:</div><div class="placeholdertb"><input name='ndays' type='text' id='ndays' required value='<?php echo set_value('ndays'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Room:</div><div class="placeholdertb"><input name='room' type='text' required value='<?php echo set_value('room'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Fee: </div><div class="placeholdertb"><input name='fee' type='text' id="fee" value='<?php echo set_value('fee'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Venue: </div>
						<div class="placeholdertb">
							<?php
								foreach ($venue as $rowss)
								{
									$ven[$rowss["venid"]] = $rowss["venue"];
								}
								echo form_dropdown('venue', $ven, $this->session->userdata("venid"), 'id="venue"'); ?>
						</div>
						</div>
					<div class="txtcontainer"><div class="anchortext">Max: </div><div class="placeholdertb"><input name='max' type='text' id="max" value='<?php echo set_value('max'); ?>' required /></div></div>
					<?php /*<div class="txtcontainer"><div class="anchortext">Compendium: </div><div class="placeholdertb"><input name='compendium' type='text' required value='<?php echo set_value('compendium'); ?>'/></div></div>
					<div class="txtcontainer"><div class="anchortext">Assessment Fee: </div><div class="placeholdertb"><input name='assessment' type='text' required value='<?php echo set_value('assessment'); ?>'/></div></div> */ ?>
					<div class="spacer floatright" style="margin-top: 10px;"><input type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
					<div style="clear:both"></div>
					<div style="margin:10px auto; overflow:hidden">
						<table id="dataTable" cellspacing="0" style="margin:10px auto;width:500px;">
						</table>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>