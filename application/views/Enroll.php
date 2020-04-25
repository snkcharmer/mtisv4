
<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>css/select2.css">
<script type="text/javascript">
	$(document).ready(function()
	{     
		$(".js-example-basic-multiple").select2();
		$(".js-example-programmatic-multi").select2();
		
		$('#license').html('').select2({data: {id:null, text: null}});
		$('#rank').html('').select2({data: {id:null, text: null}});
		$('#employer').html('').select2({data: {id:null, text: null}});
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>home/getlicense_ajax/",
			dataType: "JSON",
			success: function(data) 
			{
				$('#license').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#rank').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#employer').append($("<option></option>").attr("value",0).text("Please Select"));


				$.each(data.license, function(key, value) {
					$('#license').append($("<option></option>").attr("value",value.licid).text(value.license));
				});
				$('#license').val('<?php $currentlic = ($records["licid"] == NULL ? "#" : $records["licid"]); echo $currentlic; ?>').trigger('change');  
				
				$.each(data.rank, function(key, value) {
					$('#rank').append($("<option></option>").attr("value",value.rankid).text(value.rank));
				});
				$('#rank').val('<?php $currentrank = ($records["rankid"] == NULL ? "#" : $records["rankid"]); echo $currentrank; ?>').trigger('change');
				
				$.each(data.employer, function(key, value) {
					$('#employer').append($("<option></option>").attr("value",value.employid).text(value.name));
				});
				$('#employer').val('<?php $currentemployer = ($records["employid"] == 476 ? "476" : $records["employid"]); echo $currentemployer; ?>').trigger('change');  
			},
		});
		
	});
</script>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<form action="<?php echo base_url()?>trainee/proceedenroll" method='post' name='enroll'>
				<div id="generalinfo_header"><p style="margin-bottom: 0px;"><a href="<?php echo base_url()?>trainee/edit/<?php echo $records['trid']?>" style="font-size:20px;">Trainee</a> > Information Validation</p></div>
					<?php  echo $this->session->flashdata('message'); ?>
					<div class="txtcontainer" style="width:100%;"><div class="anchortext">Trainee ID: </div><div class="placeholdertb" style="float:left;"><input id='trid' name='trid' type='text' value="<?php echo $records['trid']; ?>" readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><input name='lname' type='text' value="<?php echo $records['lname']?>"readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo $records['fname']?>'readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo $records['mname']?>'readonly/></div></div>
					<div class="txtcontainer"><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo $records['suffix']?>' style="width:40px;" readonly/></div></div> 
				<div id="clear"></div>
					<div id="generalinfo_header"><p style="margin-bottom: 0px;">License</p></div>
					<div style="text-align:left;">	

						<div class="txtcontainer">
							<div class="anchortext" id="liccs">License Name: </div>
							<div class="placeholdertb">
								<select class="js-example-basic-multiple" id="license" name="licid" style="height:100px; width:300px"></select>
								<a href="<?php echo base_url()?>home/license">Add License...</a>
							</div>
						</div>
					</div>
					<div id="clear"></div>
					<div id="generalinfo_header">
						<p style="margin-bottom: 0px;">Shipboard</p>
					</div>
					<div style="text-align:left;">
						<div class="txtcontainer">
							<div class="anchortext">Current Rank:</div>
							<div class="placeholdertb">
							<select class="js-example-basic-multiple" id="rank" name="rankid" style="height:100px; width:300px"></select>
								<a href="<?php echo base_url()?>home/rank">Add Rank...</a>
							</div>
						</div>
						
						<?php /*<div class="spacer">
							<div class="anchortext">Recent Position: </div>
							<div class="placeholdertb">
							<?php 
								$key = NULL;
								foreach ($position as $key)
								{
									$pos[$key['posid']] = $key['position'];
								}
								$pos['0'] = 'Please Select';
								$currentpos = ($records["posid"] == NULL ? "#" : $records["posid"]);
							echo form_dropdown('posid', $pos, $currentpos, 'id="position" style="width:400px"'); ?> <a href="<?php echo base_url()?>home/position" target="_blank">Add Position...</a>
							</div>
						</div> */ ?>
						
						<div class="spacer">
							<div class="anchortext" style="font-size:12px;">Recent Employer: </div>
							<div class="placeholdertb">
							<select class="js-example-basic-multiple" id="employer" name="employer" style="height:100px; width:300px"></select>
							<a href="<?php echo base_url()?>home/employer" target="_blank">Add Employer...</a>
							</div>
						</div>
						
						
						<?php /*<div class="txtcontainer">
							<div class="anchortext">Contract Duration (Year):</div>
							<div class="placeholdertb">
								<input name='suffix' type='text' value='<?php echo $records['suffix']?>' style="width:50px;" placeholder="From" />
								<input name='suffix' type='text' value='<?php echo $records['suffix']?>' style="margin-left:10px;width:50px;"placeholder="To" />
							</div>
						</div> */ ?>
						
					</div>
				
				<div id="clear"></div>
				<div id="generalinfo_header" style="margin-top:10px;"><p style="margin-bottom: 0px;">Courses Taken</p></div>
					<table cellspacing="0" cellpadding="0" style="width:100%; margin-top:10px;">
						<thead>
							<th></th>
							<th>Code</th>
							<th>Module</th>
							<th>Batch</th>
							<th>Start</th>
							<th>End</th>
							<th>Venue</th>
							<th>SPN</th>
							<th>Fee</th>
							<th>Paid</th>
							<th style='width:35px'>Max</th>
							<th style='width:35px'>Size</th>
							<th>Action</th>
						</thead>
						<?php 
							foreach($training as $train){ 
							?>
						<tr>
							<td><input type="checkbox" name="chktrainingid" id="chktrainingid" value="<?php echo $train->trainingid ?>"></td>
							<td><label><?php echo (!empty($train->code) ? $train->code : $train->lolss); ?></label></td>
							<td><?php echo (!empty($train->module) ? $train->module : $train->dnamodule); ?></td>
							<td><?php echo $train->batch?></td>
							<td><?php echo (!empty($train->start) ? $train->start : $train->dnastart); ?></td>
							<td><?php echo (!empty($train->end) ? $train->end : $train->dnaend); ?></td>
							<td><?php echo $train->venue?></td>
							<td><?php echo $train->sptypename?></td>
							<td><?php echo $train->fee?></td>
							<td><?php echo $train->fee?></td>
							<td><?php echo $train->max?></td>
							<td><?php echo $train->size?></td>
							<td>
								<a href="<?php echo base_url()?>printrecord/proofofregistration/<?php echo $train->trainingid?>" target="blank">Print</a>
								<a href="<?php echo base_url()?>printrecord/printregformtrainee/<?php echo $train->trainingid?>" target="blank">PrintRF</a>
								<?php if (!empty($train->code)){?>
									<?php if (!empty($train->ornum)) {?>
										<a href="<?php echo base_url()?>trainee/removecode/<?php echo $train->trainingid?>/<?php echo $train->code?>" onClick="return confirm('Remove from ORL?')">DNA</a>
									<?php } ?>
								<?php } else { ?>
									<?php /*<a href="<?php echo base_url()?>trainee/transfer/<?php echo $train->trainingid?>" onClick="return confirm('Transfer this Training?')">Transfer</a> */ ?>
									<a class='lols' href='#myModal' data-toggle='modal' data-id='<?php echo $train->trainingid?>'>Transfer</a>
								<?php } ?>
								
								<?php #if ($train->verified == "N") { 
									if ($this->session->userdata("user_level") == 1) {?>
									<?php /*<a href="<?php echo base_url()?>trainee/deletetraining/<?php echo $train->trainingid?>" onClick="return confirm('Delete This Training?')">Delete</a> */ ?>
									<a class='lols2' href='#myModal2' data-toggle='modal' data-id='<?php echo $records['trid'].'*'.$train->trainingid?>'>Delete</a>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</table>
					<div class="spacer floatright" style="margin-top: 10px;">
						
						<button type="submit" class="btn btn-primary" style="font-size: 18px">Proceed</button>
						
						<button type="button" class="btn btn-primary">
							<a href="<?php echo base_url()?>trainee/createid/<?php echo $this->session->userdata("trid"); ?>" style="display:block; font-size:18px; color:#fff;" target="_blank">
								Create ID
							</a>
						</button>
						<button type="button" class="btn btn-primary" style="font-size: 18px" id="emp">EMPLOYMENT</button>
					</div>
				
				</form>
			</div>
		</div>
	</div>
</div>

<div class="bs-example">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>trainee/transfersched/' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Transfer Schedule</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-2">Code: </div>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="code" name="code" placeholder="Enter Schedule Code" required />
								<input type="text" class="" id="trainingid" name="trainingid" placeholder="" readonly required hidden />
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Confirm</button>
						
					</div>
				</div>
			</form>
        </div>
    </div>
</div>


<div class="bs-example">
    <div id="myModal2" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>trainee/deletetraining/' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Delete Training</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
								
								<div class="radio">
									<label>
										<input type="radio" name="optiondel" id="optionsRadios2" value="2" checked>
										Delete all Trainings and Fees included in the Payment
									</label>
								</div>
								<div class="radio">
									<input type="text" name="trainingid2" id="trainingid2" value="" hidden>
									<label>
										<input type="radio" name="optiondel" id="optionsRadios1" value="1">
										Delete only this Training
									</label>
								</div>
							</div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

<div class="bs-example">
    <div id="empallModal" class="modal fade">
        <div class="modal-dialog" id="empallModaldialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Employment Profile</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<form id="formempall" method='post'>
									<table id="tblempallrec" style="width:500px;">
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="cmdConnect">Connect</button>
					<button type="button" class="btn btn-primary" id="cmddelempprof">Delete</button>
					<button type="button" class="btn btn-primary" id="cmdaddempprof">Add New</button>
					<button type="button" class="btn btn-primary" id="cmdupdempprof">Update Record</button>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="bs-example">
    <div id="empModal" class="modal fade">
        <div class="modal-dialog" style="width:1080px">
			<form action='' method="post" id="formaddemployment">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Employment Profile</h4>
					</div>

					<div class="modal-body">
						<div class="row">
						
							<div class="col-sm-3">
								<div class="col-sm-12">
									<div class="form-group">Date Taken:
										<div class="radio">
											<input type="date" name="datetaken" value="" class="form-control" id="datetaken" required>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="form-group">
										Are you employed?
										<div class="radio">
											<label><input type="radio" name="isemp" value="1" class="isemp" id="isempyes" required> Yes</label> &nbsp; &nbsp; &nbsp;
											<label><input type="radio" name="isemp" value="2" class="isemp" id="isempno" checked required> No</label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12" id="divtypeemp">
									<div class="form-group">
										Type of Employment
										<div class="radio">
											<input type="radio" hidden name="typeemp" value="0" class="typeemp" id="typeempnone" checked >
											<label><input type="radio" name="typeemp" value="1" class="typeemp" id="typeemplb"> Land Based</label> &nbsp; &nbsp; &nbsp;
											<label><input type="radio" name="typeemp" value="2" class="typeemp" id="typeempsb"> Sea-based</label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-9">
								<div class="col-sm-12 box-body" id="landbased">
								
									<div class="form-group col-sm-12">
										<label for="occupation" class="col-sm-4 control-label">Occupation: </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="occupation" name="occupation" placeholder="Type the occupation of trainee.." style="width:300px">
										</div>
									</div>
									
									<div class="form-group col-sm-12">
										<label for="noyearsemplb" class="col-sm-4 control-label">No. of Years Employed: </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="noyearsemplb" name="noyearsemplb" placeholder="Type the occupation of trainee.." style="width:300px">
										</div>
									</div>
									
								</div>
								
								<div class="col-sm-12 box-body" id="seabased">
									<div class="form-group col-sm-12">
										<label for="noyearsempsea" class="col-sm-4 control-label">No. of Years Employed: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="noyearsempsea" name="noyearsempsea" style="height:100px; width:300px" ></select>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="traderoute" class="col-sm-4 control-label">Trading Route: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="traderoute" name="traderoute" style="height:100px; width:300px" ></select>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="vesseltype" class="col-sm-4 control-label">Type of Vessel: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="vesseltype" name="vesseltype" style="height:100px; width:300px" ></select> 
											<input type="button" id="addVessel"  value="Add" />
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="vesselsize" class="col-sm-4 control-label">Size of Vessel: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="vesselsize" name="vesselsize" style="height:100px; width:300px" ></select>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="flagreg" class="col-sm-4 control-label">Flag of Registry of Vessel Boarded: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="flagreg" name="flagreg" style="height:100px; width:300px"  ></select>
											<input type="button" id="addFlag" value="Add" />
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="natvesprin" class="col-sm-4 control-label">Nationality of Vessel's Principal: </label>
										<div class="col-sm-8">
											<select class="js-example-basic-multiple" id="natvesprin" name="natvesprin" style="height:100px; width:300px"  ></select>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="nocrewonves" class="col-sm-4 control-label">No. of Crew Onboard Vessel: </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nocrewonves" name="nocrewonves"  style="width:300px"/>
										</div>
									</div>
									<div class="form-group col-sm-12">
										<label for="nationcrew" class="col-sm-4 control-label">Nationality of Crew Onboard: </label>
										<div class="col-sm-8">
											<div class="radio">
												<label><input type="radio" name="nationcrew" value="1" id="nationcrewfil" > All Filipino Crew</label> &nbsp; &nbsp; &nbsp;
												<label><input type="radio" name="nationcrew" value="2" id="nationcrewmix"> Mixed Nationality</label>
											</div>
										</div>
									</div>
									
									<div id="divmixed">
										<div class="form-group col-sm-12"><b>If Mixed Nationality</b>
										</div>
										<div class="row">
											<div class="form-group col-sm-12">
												<label for="nationvessel" class="col-sm-4 control-label">How many are foreign nationals:</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="nofornat" name="nofornat"  style="width:300px"/>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<label for="nationvessel" class="col-sm-4 control-label">What were the nationalities of crew onboard:</label>
												<div class="col-sm-8">
												<select class="js-example-basic-multiple" id="ismixed" name="ismixed" style="height:90px; width:300px" multiple="multiple" ></select>
												</div>
											</div>
											<div class="form-group col-sm-12">
												<b>What were the position of the non-Filipino onboard:</b>
											</div>
											
											<div class="form-group col-sm-12">
												<label for="offdeck" class="col-sm-4 control-label">Officers on Deck:</label>
												<div class="col-sm-8">
													<select class="js-example-basic-multiple" id="offdeck" name="offdeck" style="height:90px; width:300px" multiple="multiple" ></select>
												</div>
											</div>
											
											<div class="form-group col-sm-12">
												<label for="offengine" class="col-sm-4 control-label">Officers on Engine:</label>
												<div class="col-sm-8">
													<select class="js-example-basic-multiple" id="offengine" name="offengine" style="height:90px; width:300px" multiple="multiple" ></select>
												</div>
											</div>
											
											<div class="form-group col-sm-12">
												<label for="ratdeck" class="col-sm-4 control-label">Ratings on Deck:</label>
												<div class="col-sm-8">
													<select class="js-example-basic-multiple" id="ratdeck" name="ratdeck" style="height:90px; width:300px" multiple="multiple" ></select>
												</div>
											</div>
											
											<div class="form-group col-sm-12">
												<label for="ratengine" class="col-sm-4 control-label">Ratings on Engine:</label>
												<div class="col-sm-8">
													<select class="js-example-basic-multiple" id="ratengine" name="ratengine" style="height:90px; width:300px" multiple="multiple" ></select>
												</div>
											</div>
											
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" id="btnaddemploymentprofile" class="btn btn-primary">Confirm</button>
					</div>
					
				</div>
			</form>
        </div>
    </div>
</div>

	<script>
		$(document).ready(function() {
			
			$('.lols').click(function() {
				var myBookId = $(this).data('id');
				$(".modal-body #trainingid").val( myBookId );
			});
			
			$('.lols2').click(function() {
				var myBookId = $(this).data('id');
				$(".modal-body #trainingid2").val( myBookId );
			});
			
			$('#emp').click(function() {
				license();
				getempprof();
				
				$('#empallModal').modal('show');
			});
			
			function getempprof()
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>employment/getemploymentprofile_all_ajax/" + "<?php echo $records['trid']?>",
					dataType: "JSON",
					success: function(data) 
					{
						console.log(data);
						$("#tblempallrec tr").remove();
						$("#tblempallrec thead").remove();
						
						$('<thead>').html("<th style='width:50px'></th><th>Date Taken</th><th>Code</th>").appendTo('#tblempallrec');
						
						asd = 1;
						$.each(data,function(key,val)
						{
							$('<tr>').html("<td><input type='radio' name='rademprofid' value='" + val.emprofid + "'></td><td>" + val.datetaken + "</td><td>" + val.grpcode + "</td>").appendTo('#tblempallrec');
							asd++;
						});
						
						// $("#empallModaldialog").animate({
							// height:$("#empallModaldialog").height() + 150
						// },600);	
					}
				});
			}
			
			function qwe()
			{
				$('#traderoute').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#traderoute').append($("<option></option>").attr("value",1).text("Domestic"));
				$('#traderoute').append($("<option></option>").attr("value",2).text("Ocean-going"));
				
				$('#noyearsempsea').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#noyearsempsea').append($("<option></option>").attr("value",1).text("1 year"));
				$('#noyearsempsea').append($("<option></option>").attr("value",2).text("2 years"));
				$('#noyearsempsea').append($("<option></option>").attr("value",3).text("3-5 years"));
				$('#noyearsempsea').append($("<option></option>").attr("value",4).text("6-10 years"));
				$('#noyearsempsea').append($("<option></option>").attr("value",5).text("Above 10 years"));
				
				$('#flagreg').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#traderoute').append($("<option></option>").attr("value",0).text("Please Select"));
				$('#noyearsempsea').append($("<option></option>").attr("value",0).text("Please Select"));
					
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getvessel_ajax/",
					dataType: "JSON",
					success: function(data) 
					{
						// console.log(data);
						$('#vesseltype').append($("<option></option>").attr("value",
						"").text("Please Select"));
						$.each(data.vessel, function(key, value) {
							$('#vesseltype').append($("<option></option>").attr("value",value.vesid).text(value.vessel));
						});
						
						$('#vesselsize').append($("<option></option>").attr("value",
						"").text("Please Select"));
						$.each(data.vessize, function(key2, value2) {
							$('#vesselsize').append($("<option></option>").attr("value",value2.vessizeid).text(value2.vessel_size));
						});
						
						$('#flagreg').append($("<option></option>").attr("value",
						"").text("Please Select"));
						$('#natvesprin').append($("<option></option>").attr("value",
						"").text("Please Select"));
						
						$.each(data.vesflag, function(key3, value3) {
							$('#flagreg').append($("<option></option>").attr("value",value3.vesflagid).text(value3.vessel_flag));
							
							$('#natvesprin').append($("<option></option>").attr("value",value3.vesflagid).text(value3.vessel_flag));
							
							$('#ismixed').append($("<option></option>").attr("value",value3.vessel_flag).text(value3.vessel_flag));
						});
					}
				});
			}
			
			function clearall()
			{
				$(".typeemp").prop('checked', false);
				$(".isemp").prop('checked', false);
				
				$('input[name="chktrainingid"]:checked').val();
				$('input[name="isemp"]:checked').val(); 

				$('#occupation').val(""); 
				$('#noyearsemplb').val(""); 
				$('#noyearsempsea').empty().trigger("change");
				$('#traderoute').empty().trigger("change");
				$('#vesseltype').empty().trigger("change");
				$('#vesselsize').empty().trigger("change");
				$('#flagreg').empty().trigger("change");
				$('#natvesprin').empty().trigger("change");
				$('#vesseltype').empty().trigger("change");
				$('input[name="nationcrew"]:checked').val();
				$('#nocrewonves').val("");
				$('#nofornat').val("");
				
				// $('#offdeck').empty().trigger("change");
				// $('#offengine').empty().trigger("change");
				// $('#ratdeck').empty().trigger("change");
				// $('#ratengine').empty().trigger("change");
				$('#ismixed').empty().trigger("change");
			}

			$('#cmdaddempprof').click(function() {
				$("#landbased").hide("fast");
				$("#seabased").hide("fast");
				$("#divtypeemp").hide("fast");
				$("#divmixed").hide("fast");
				$("#btnaddemploymentprofile").text("Add New Record");
				
				clearall();
				qwe();
				
				$("#datetaken").val("<?php echo date('Y-m-d')?>");
				$('#empModal').modal('show');
			});
			
			$('#cmdupdempprof').click(function() {
				george = $('input[name="rademprofid"]:checked').length;
				george2 = $('input[name="rademprofid"]:checked').val();
				// alert(george2);
				if (george > 0) {
					
					clearall();
					qwe();
					// license();
					trid = $("#trid").val();
					$('#btnaddemploymentprofile').text("Update Record");
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>employment/getemploymentprofile_all_ajax/" + trid + "/" + george2,
						dataType: "JSON",
						success: function(data) 
						{
							console.log(data);
							$('#datetaken').val(data.datetaken);	
							if (data.isemp == 2) //if trainee unemployed
							{
								$("#isempno").prop("checked", true); 
								
								$("#landbased").hide("fast");
								$("#seabased").hide("fast");
								$("#divtypeemp").hide("fast");
							} else { 					//if trainee is employed
								// alert(asd);
								$("#isempyes").prop("checked", true); 
								
								if (data.typeemp == 2) //if trainee is seabased
								{
									$("#typeempsb").prop("checked", true);
									$('#noyearsempsea').val(data.yearsemp_sb).trigger('change'); 
									$('#traderoute').val(data.trading_route).trigger('change'); 
									$('#vesseltype').val(data.vesid).trigger('change'); 
									$('#vesselsize').val(data.vessize).trigger('change'); 
									$('#flagreg').val(data.flagofregistry).trigger('change'); 
									$('#natvesprin').val(data.nationofvessel).trigger('change'); 
									$('#nocrewonves').val(data.crewonboard);
									$('#nofornat').val(data.nofornat);
									
									
									if (data.nationofcrew == 1) {
										$("#nationcrewfil").prop("checked", true);
									} else if (data.nationofcrew == 2) {
										$("#nationcrewmix").prop("checked", true);
									}
									
									str1 = data.ifmixed;
									splits1 = str1.split(",");
									$('#ismixed').val(splits1).trigger('change');
									
									str2 = data.offdeck;
									splits2 = str2.split(",");
									$('#offdeck').val(splits2).trigger('change');
									
									str3 = data.offengine;
									splits3 = str3.split(",");
									$('#offengine').val(splits3).trigger('change');
									
									str4 = data.ratengine;
									splits4 = str4.split(",");
									$('#ratengine').val(splits4).trigger('change');
									
									str5 = data.ratdeck;
									splits5 = str5.split(",");
									$('#ratdeck').val(splits5).trigger('change');
									
									console.log(splits1);
									console.log(splits2);
									console.log(splits3);
									console.log(splits4);
									console.log(splits5);
									
									$("#seabased").show("fast");
									$("#landbased").hide("fast");
									
								} else if (data.typeemp == 1) { 		//if trainee is landbased
									$("#typeemplb").prop("checked", true); 
									$('#occupation').val(data.occu_lb);
									$('#noyearsemplb').val(data.yearsemp_lb);
									$("#seabased").hide("fast");
									$("#landbased").show("fast");
									
								}
							}	
							
							$('#vesselsize').append($("<option></option>").attr("value","").text("Please Select"));
							$('#vesseltype').append($("<option></option>").attr("value","").text("Please Select"));	
						}
					
					});
					
					$('#empModal').modal('show');
				} else {
					alert("Please Select a Training using the checkbox");
				}
			});
			
			$("#btnaddemploymentprofile").click(function() {
				txtemprofid = $('input[name="rademprofid"]:checked').val();
				txtisemployed = $('input[name="isemp"]:checked').val(); 
				txttypeemp = $('input[name="typeemp"]:checked').val(); 
				txtoccupation = $('#occupation').val(); 
				txtnoyearsemplb = $('#noyearsemplb').val(); 
				txtnoyearsempsea = $('#noyearsempsea').val(); 
				txttraderoute = $('#traderoute').val(); 
				txtvesseltype = $('#vesseltype').val(); 
				txtvesselsize = $('#vesselsize').val(); 
				txtflagreg = $('#flagreg').val(); 
				txtnatvesprin = $('#natvesprin').val(); 
				txtvesseltype = $('#vesseltype').val(); 
				txtnationcrew = $('input[name="nationcrew"]:checked').val();
				txtnocrewonves = $('#nocrewonves').val();
				txtoffdeck = $('#offdeck').val();
				txtoffengine = $('#offengine').val();
				txtratdeck = $('#ratdeck').val();
				txtratengine = $('#ratengine').val();
				txtismixed = $('#ismixed').val();
				txtnofornat = $('#nofornat').val();
				txtdatetaken = $('#datetaken').val();
				
				var myCheckboxes = new Array();
				$('input[name="chktrainingid"]:checked').each(function(i) {
					lols = $(this).val();
					myCheckboxes.push($(this).val());
				});
				
				if ($("#btnaddemploymentprofile").text() === "Add New Record") {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>employment/addemployment_ajax/",
						dataType: "JSON",
						method: "POST",
						data: { isemp:txtisemployed, typeemp:txttypeemp, occupation:txtoccupation, noyearsemplb:txtnoyearsemplb, noyearsempsea:txtnoyearsempsea, nocrewonves:txtnocrewonves, traderoute:txttraderoute, vesseltype:txtvesseltype, vesselsize:txtvesselsize, flagreg:txtflagreg, natvesprin:txtnatvesprin,vesseltype:txtvesseltype,ismixed:txtismixed, nationcrew:txtnationcrew, nofornat: txtnofornat, offdeck:txtoffdeck, offengine:txtoffengine, ratdeck:txtratdeck, ratengine:txtratengine, empid:"<?php echo $records["trid"] ?>", datetaken: txtdatetaken },
						// data: $('#formaddemployment').serialize() + "&empid=" + <?php echo $records["trid"] ?>,
						success: function(data) 
						{
							console.log(data);
							$('#empModal').modal('toggle');
							getempprof();
							alert("Successfully added an employment profile!");
							// document.reload();
						}
					});
				} else if ($("#btnaddemploymentprofile").text() === "Update Record") {
					alert(myCheckboxes);
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>employment/updateemployment_ajax/",
						dataType: "JSON",
						method: "POST",
						data: { trainingid:myCheckboxes, emprofid:txtemprofid, isemp:txtisemployed, typeemp:txttypeemp, occupation:txtoccupation, noyearsemplb:txtnoyearsemplb, noyearsempsea:txtnoyearsempsea, nocrewonves:txtnocrewonves, traderoute:txttraderoute, vesseltype:txtvesseltype, vesselsize:txtvesselsize, flagreg:txtflagreg, natvesprin:txtnatvesprin,vesseltype:txtvesseltype,ismixed:txtismixed, nationcrew:txtnationcrew, nofornat: txtnofornat, offdeck:txtoffdeck, offengine:txtoffengine, ratdeck:txtratdeck, ratengine:txtratengine, datetaken: txtdatetaken},
						success: function(data) 
						{
							console.log(data);
							$('#empModal').modal('toggle');
							getempprof();
							alert("Successfully updated an employment profile!");
						}
					});
				}
				
			});
			
			$(".isemp").click(function() {
				isempvar = $("input[name='isemp']:checked").val();
				if (isempvar == 2) {
					$("#landbased").hide("fast");
					$("#seabased").hide("fast");
					$("#divtypeemp").hide("fast");
					
					$(".typeemp").prop('checked', false);
					
					$("#flagreg").removeAttr('required');				
					$(".typeemp").removeAttr('required');	
					
					$("#traderoute").removeAttr('required');				
					$("#noyearsempsea").removeAttr('required');
					$("#vesselsize").removeAttr('required');
					$("#vesseltype").removeAttr('required');
					
				} else {
					$("#divtypeemp").show("fast");
					$('input[name="typeemp"]').attr('required', 'required');
				}
			});
			
			$(".typeemp").click(function() {
				isempvar = $("input[name='typeemp']:checked").val();
				
				if (isempvar == 2) {
					$("#seabased").show("fast");
					$("#landbased").hide("fast");
					
					$("#occupation").val("");
					$("#noyearsemplb").val("");
				} else {
					$("#landbased").show("fast");
					$("#seabased").hide("fast");
					
					$("input[name='nationcrew']").prop('checked', false);
				}
			});
			
			$('#eo').change(function() {
				$("#cause").val( $('#eo option:selected').text() );
			});
			
			$('#nationcrewmix').click(function() {
				$("#divmixed").show("fast");
			});
			
			$('#cmdConnect').click(function() {
				// txtchktrainingid = $('input[name="chktrainingid"]:checked').val();
				var myCheckboxes = new Array();
				$('input[name="chktrainingid"]:checked').each(function(i) {
					lols = $(this).val();
					myCheckboxes.push($(this).val());
				});
				
				txtemprofid = $('input[name="rademprofid"]:checked').val();
				
				if (myCheckboxes == null || txtemprofid == undefined){
					alert("Please select a training");
				} else {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>employment/connectemployment_ajax/",
						dataType: "JSON",
						data: { trainingid:myCheckboxes, emprofid:txtemprofid },
						method: "POST",
						success: function(data) 
						{
							alert("Affected rows " + data);
							getempprof();
						}
					});
				}
			});
			
			function license()
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getlicense_ajax/",
					dataType: "JSON",
					method: "POST",
					success: function(data) 
					{
						
						$.each(data.rank, function(key, value) {
							$('#offdeck').append($("<option></option>").attr("value",value.rank).text(value.rank));
						});
						
						$.each(data.rank, function(key, value) {
							$('#offengine').append($("<option></option>").attr("value",value.rank).text(value.rank));
						});
						
						$.each(data.rank, function(key, value) {
							$('#ratdeck').append($("<option></option>").attr("value",value.rank).text(value.rank));
						});
						
						$.each(data.rank, function(key, value) {
							$('#ratengine').append($("<option></option>").attr("value",value.rank).text(value.rank));
						});
					}
				});
			}
			
		});
	</script>
		
</body>
</html>