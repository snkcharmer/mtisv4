<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/font-awesome-4.7.0/css/font-awesome.min.css">
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>dist/sweetalert/sweetalert.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>css/select2.css">
<script src="<?php echo base_url()?>dist/sweetalert/sweetalert-dev.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{     
		$(".js-example-basic-multiple").select2();
		$(".js-example-programmatic-multi").select2();
	});
</script>
<div id="container">
	<div id="mid">
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow">
			<form method="post" class="confrmtraining" action="<?php echo  base_url()?>nea/confrmtraining">
				<input type="hidden" class="paycatid" name="paycatid" value="">
				<input type="hidden" class="trainid_" name="trainid_" value="">
				<input type="hidden" class="codeid" name="codeid" value="">
			<!-- </form> -->
			<div id="generalinfo" class="column">
				<!-- <form action="<?php //echo base_url()?>Nea/proceedenroll" method='post' name='enroll'> -->
				<div id="generalinfo_header"><p style="margin-bottom: 0px;"><a href="<?php echo base_url()?>trainee/edit/<?php echo $records['trid']?>" style="font-size:20px;">Trainee</a> > Information Validation</p></div>
					<?php  echo $this->session->flashdata('message'); ?>
					<div class="txtcontainer" style="width:100%;"><div class="anchortext">Trainee ID: </div><div class="placeholdertb" style="float:left;"><input id='trid' name='trid' type='text' value="<?php echo $records['trid']; ?>" readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><input name='lname' type='text' value="<?php echo $records['lname']?>"readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo $records['fname']?>'readonly/></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo $records['mname']?>'readonly/></div></div>
					<div class="txtcontainer"><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo $records['suffix']?>' style="width:40px;" readonly/></div></div> 
					<div id="clear"></div>
					<div id="generalinfo_header"><p style="margin-bottom: 0px;">Shipboard Experience</p></div>
					<div style="text-align:left;">	
						<?php //echo $row['licid'];die();
								//	var_dump($row['licid']) ;die(); ?>
						<div class="txtcontainer">
							<div class="anchortext" id="liccs">License Name: </div>
							<div class="placeholdertb">
								<select class="js-example-basic-multiple license" id="license" name="licid" style="height:100px; width:300px">
									<option value="">Please Select</option>
									<?php
									
									foreach ($licenses as $key) {
									?>
										<option value="<?php echo $key['licid']?>" 
										<?php 
										if($row['licid'] != ""){
											if($row['licid'] == $key['licid']){
												echo"selected";
											}
										}else{
											if($records['licid'] == $key['licid']){
												echo"selected";
											}
										}											
										?>
										><?php echo $key['license']?></option>
									<?php
									}
									?>
								</select>
								<a href="javascript:void(0);" class="addlcs">Add License...</a>
							</div>
						</div>
					</div>
					<!-- <div id="clear"></div> -->
					<!-- <div id="generalinfo_header">
						<p style="margin-bottom: 0px;">Shipboard</p>
					</div> -->
					<div style="text-align:left;">
						<div class="txtcontainer">
							<div class="anchortext">Current Rank:</div>
							<div class="placeholdertb">
							<select class="js-example-basic-multiple rankid" id="rank" name="rankid" style="height:100px; width:300px">
								<option value="">Please Select</option>
								<?php
								//var_dump($licenses) ;die();
								foreach ($ranks as $key) {
								?>
									<option value="<?php echo $key['rankid']?>" 
									<?php 
									if($row['rankid'] != ""){
										if($row['rankid'] == $key['rankid']){
											echo"selected";
										}
									}else{
										if($records['rankid'] == $key['rankid']){
											echo"selected";
										}
									}
									?>
									><?php echo $key['rank']?></option>
								<?php
								}
								?>
							</select>
								<a href="javascript:void(0);" class="addrank">Add Rank...</a>
							</div>
						</div>
						
						<div class="txtcontainer">
							<div class="anchortext" >Employer: </div>
							<div class="placeholdertb">
							<select class="js-example-basic-multiple employer" id="employer" name="employer" style="height:100px; width:300px">
								<option value="">Please Select</option>
								<?php
								//var_dump($licenses) ;die();
								foreach ($employer as $key) {
								?>
									<option value="<?php echo $key['employid']?>" 
									<?php
									if($row['shipprinid'] != ""){
										if($row['shipprinid'] == $key['employid']){
											echo"selected";
										}
									}else{
										if($records['employid'] == $key['employid']){
											echo"selected";
										}
									}
									?>
									><?php echo $key['name']?></option>
								<?php
								}
								?>
							</select>
							<a href="javascript:void(0);" class="addemployer">Add Employer...</a>
							</div>
						</div>
						<div class="txtcontainer">
							<div class="anchortext" style="width: 150px;">Date of Disembarkation: </div>
							<div class="placeholdertb">
								<input type="date" name="dateofme" value="<?php if($row['dateofdesimbark'] == ""){ echo $records['dateofdisembarkation'];}else{	echo $row['dateofdesimbark'];}?>" style="width: 300px;">
							</div>
						</div>
						<!-- <div class="txtcontainer">
							<div class="anchortext">Ship Owner: </div>
							<div class="placeholdertb">
								<input type="text" name="cname" value="<?php //echo $row['companyname']?>" style="width: 200px;">
							</div>
						</div>
						<div class="txtcontainer">
							<div class="anchortext" style="width: 120px;">Landline Number: </div>
							<div class="placeholdertb">
								<input type="text" name="lnum" value="<?php //echo $row['selandline']?>" style="width: 200px;">
							</div>
						</div>
						<div class="txtcontainer">
							<div class="anchortext">Mobile Number: </div>
							<div class="placeholdertb">
								<input type="text" name="mnum" value="<?php //echo $row['semobilenum']?>" style="width: 200px;">
							</div>
						</div> -->
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
							<td><input type="checkbox" name="chktrainingid[]" id="chktrainingid" value="<?php echo $train->modcode ?>" <?php if($train->label == 1){echo"checked";}?>><input type="checkbox" name="chkcode[]" id="chkcode" value="<?php echo $train->scode ?>" checked hidden><input type="checkbox" name="chktrain[]" id="chktrain" value="<?php echo $train->trainingid ?>" checked hidden></td>
							<td><label><?php echo (!empty($train->code) ? $train->code : $train->lolss); ?></label></td>
							<td><?php echo (!empty($train->module) ? $train->module : $train->dnamodule); ?></td>
							<td><?php echo $train->batch?></td>
							<td><?php echo (!empty($train->start) ? $train->start : $train->dnastart); ?></td>
							<td><?php echo (!empty($train->end) ? $train->end : $train->dnaend); ?></td>
							<td><?php echo $train->venue?></td>
							<td><?php echo (!empty($train->sptypename) ? $train->sptypename : $train->sptypename); ?> </td>
							<td><?php echo $train->fee?></td>
							<td><?php echo $train->fee?></td>
							<td><?php echo $train->max?></td>
							<td><?php echo $train->size?></td>
							<td>
								<?php 
								if($train->label == 0){
								?>
								<a href="<?php echo base_url()?>nea/delete_sched_enroll/<?php echo $train->trainingid?>" onclick="return confirm('Are You Sure! You want to Delete this Schedue')" style="color: red;"><i class="fa fa-trash"></i> Delete</a>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</table>
					<div class="spacer floatright" style="margin-top: 10px;">
						
						<?php if($getlabel['min_'] == 1){?>
						<button type="button" class="btn btn-primary finish_cnfrm" data-cfrmid="" style="font-size: 18px">Finish</button>
						<?php }else{ ?>
						<button type="button" class="btn btn-primary finish_cnfrm" disabled data-cfrmid="" style="font-size: 18px">Finish</button>	
						<?php 
						}
						?>
						
						
						<button type="button" class="btn btn-primary chk" style="font-size: 18px">Check course</button>
						
					</div>
				
				<!-- </form> -->
			</div>
		</form>
		</div>
	</div>
</div>

<div class="bs-example">
    <div class="modal fade addlcs_01">
        <div class="modal-dialog">
			<!-- <form action='<?php //echo base_url()?>trainee/transfersched/' method="post"> -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add License</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>License (<samall style="color: red;">ex: 1ST ASSISSTANT ENGINEER</samall>)</label>
						<input style="width: 500px;" type="text" class="form-control lcs" name="lcs" placeholder="Enter license" required />
					</div>
					<div class="form-group">
						<label>License name (<samall style="color: red;">ex: 1AE</samall>)</label>
						<input style="width: 500px;" type="text" class="form-control lcsname" name="lcsname" placeholder="Enter license name" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary savelcs">Confirm</button>
				</div>
			</div>
			<!-- </form> -->
        </div>
    </div>
</div>

<div class="bs-example">
    <div class="modal fade addemployer_01">
        <div class="modal-dialog">
			<!-- <form action='<?php //echo base_url()?>trainee/transfersched/' method="post"> -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add Employer</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Employer name</label>
						<input style="width: 500px;" type="text" class="form-control eemployername" name="employername" placeholder="Enter employer name" required />
					</div>
					<div class="form-group">
						<label>Employer address</label>
						<input style="width: 500px;" type="text" class="form-control eemployeradd" name="employeradd" placeholder="Enter employer address" required />
					</div>
					<div class="form-group">
						<label>Ship Owner</label>
						<input style="width: 500px;" type="text" class="form-control esowner" name="sowner" placeholder="Enter ship owner" required />
					</div>
					<div class="form-group">
						<label>Mobile number</label>
						<input style="width: 500px;" type="text" class="form-control emnumber" name="emnumber" placeholder="Enter mobile number" required />
					</div>
					<div class="form-group">
						<label>Telephone number</label>
						<input style="width: 500px;" type="text" class="form-control etelnum" name="etelnum" placeholder="Enter tel number" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary saveemployer">Confirm</button>
				</div>
			</div>
			<!-- </form> -->
        </div>
    </div>
</div>

<div class="bs-example">
    <div class="modal fade addrank_01">
        <div class="modal-dialog">
			<!-- <form action='<?php //echo base_url()?>trainee/transfersched/' method="post"> -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add Rank</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Rank name</label>
						<input style="width: 500px;" type="text" class="form-control rrankname" name="rrankname" placeholder="Enter rank" required />
					</div>
					<div class="form-group">
						<label>Rank short name </label>
						<input style="width: 500px;" type="text" class="form-control rshortname" name="rshortname" placeholder="Enter rank short name" required />
					</div>
					<div class="form-group">
						<label>Rank type</label>
						<input style="width: 500px;" type="text" class="form-control rtype" name="rtype" placeholder="Enter rank type" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary saverank">Confirm</button>
				</div>
			</div>
			<!-- </form> -->
        </div>
    </div>
</div>

<script>
	$(document).on('click','.addlcs', function() {

		$('.addlcs_01').modal('show');

	});

	$(document).on('click','.savelcs', function() {

		$('.addlcs_01').modal('hide');
		$.ajax({
	        url : "<?php echo base_url('nea/savelcs')?>",
	        type: "POST",
	        dataType: "JSON",
	        data:{
	        	"lcs":$('.lcs').val(),
	        	"lcsname": $('.lcsname').val()
	        },
	        success: function(data)
	        {
	        	//console.log(data);
	        	if(data['rec']['licid'] == "error"){
	        		swal("ALERT!", "Something is Wrong Please check data!", "error");
	        	}else{
	        		$('.license').append('<option value='+data['rec']['licid']+'>'+data['rec']['license']+'</option>');	
	        	}
	        	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            swal("ALERT!", "Something is Wrong Please check data!", "error");
	        }
	    });
	});

	$(document).on('click','.addemployer', function() {

		$('.addemployer_01').modal('show');

	});

	$(document).on('click','.saveemployer', function() {

		$('.addemployer_01').modal('hide');
		$.ajax({
	        url : "<?php echo base_url('nea/saveemployer')?>",
	        type: "POST",
	        dataType: "JSON",
	        data:{
	        	"ename":$('.eemployername').val(),
	        	"eadd": $('.eemployeradd').val(),
	        	"owner":$('.esowner').val(),
	        	"enumber": $('.enumber').val(),
	        	"etelnum": $('.etelnum').val()
	        },
	        success: function(data)
	        {
	        	//console.log(data);
	        	if(data['rec']['employid'] == "error"){
	        		swal("ALERT!", "Something is Wrong Please check data!", "error");
	        	}else{
	        		$('.employer').append('<option value='+data['rec']['employid']+'>'+data['rec']['name']+'</option>');
	        	}
	        	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            swal("ALERT!", "Something is Wrong Please check data!", "error");
	        }
	    });
	});

	$(document).on('click','.addrank', function() {

		$('.addrank_01').modal('show');

	});

	$(document).on('click','.saverank', function() {

		$('.addrank_01').modal('hide');
		$.ajax({
	        url : "<?php echo base_url('nea/saverank')?>",
	        type: "POST",
	        dataType: "JSON",
	        data:{
	        	"rname":$('.rrankname').val(),
	        	"rsname": $('.rshortname').val(),
	        	"rtype":$('.rtype').val()
	        },
	        success: function(data)
	        {
	        	//console.log(data);
	        	if(data['rec']['rankid'] == "error"){
	        		swal("ALERT!", "Something is Wrong Please check data!", "error");
	        	}else{
	        		$('.rankid').append('<option value='+data['rec']['rankid']+'>'+data['rec']['rank']+'</option>');
	        	}
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            swal("ALERT!", "Something is Wrong Please check data!", "error");
	        }
	    });
	});

	$(document).on('click','.chk', function() {
		if (!$("input[name='chktrainingid[]']:checked").val()) {
			//alert('Please click a Record to proceed editing.');
			swal("ALERT!", "Please select a data to add courses!", "error");
		}else{
			var length = $("input[name='chktrainingid[]']:checked").length;
			//console.log(lnght);
			var x = 1;
			var final = '';
		    $("input[name='chktrainingid[]']:checked").each(function(){        
		        var values = $(this).val();
		        if (length == x) {
		        	final += values;
		        }else{
		        	final += values+",";
		        }
		        x++;
		    });

		    var length1 = $("input[name='chktrain[]']:checked").length;
			//console.log(lnght);
			var x1 = 1;
			var final1 = '';
		    $("input[name='chktrain[]']:checked").each(function(){        
		        var values1 = $(this).val();
		        if (length1 == x1) {
		        	final1 += values1;
		        }else{
		        	final1 += values1+",";
		        }
		        x1++;
		    });

		    
			//alert(final);
			$.ajax({
		        url : "<?php echo base_url('nea/checkcourses')?>",
		        type: "POST",
		        dataType: "JSON",
		        data:{
		        	"code":final
		        },
		        success: function(data)
		        {
		        	//console.log(data[1]['rec']['paycatid']);
		        	if(data[0]['cnt'] == '2'){
		        		swal("ALERT!", "Please select LCCA or Regular only!", "error");
		        	}else{
		        		//swal("ALERT!", "Something is Wrong Please check data!", "success");
		        		$('.paycatid').val(data[1]['rec']['paycatid']);
		        		$('.trainid_').val(final1);
		        		$('.codeid').val(final);
		        		//$('.enroll').submit();
		        		$('.confrmtraining').submit();
		        	}
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            swal("ALERT!", "Something is Wrong Please check data!", "error");
		        }
		    });
		}
	});	

	$(document).on('click','.finish_cnfrm', function() {
		
		swal({
			  title: "Are you sure? ",
			  text: "You want to finish this transaction!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-success",
			  confirmButtonText: "Yes, Finish it!",
			  cancelButtonText: "No, cancel pls!",
			  closeOnConfirm: false,
			  closeOnCancel: false
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	$.ajax({
		        url : "<?php echo base_url('nea/confirm_finish')?>",
		        type: "POST",
		        dataType: "JSON",
		        data:{
		        	
		        },
		        success: function(data)
		        {
		           //console.log(data);
		           window.location.href="<?php echo base_url()?>List";	  
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            swal("ALERT!", "Something is Wrong Please check data!", "error");
		        }
		    });
		    

		  } else {
		    swal("Cancelled", "Your data is safe :)", "error");
		  }
		});
		
	});	
</script>
		
</body>
</html>