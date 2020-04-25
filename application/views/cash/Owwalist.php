


<style>
	.traineeTable { 
		width: 100%;
		border: 1px solid #f4f4f4;
	}
	
	.traineeTable tr td, #traineeTable tr th{
		padding: 8px;
		line-height: 1.42857143;
		vertical-align: top;
		border: 1px solid #ddd;
	}
</style>
<?php $this->load->view('include/headercash') ?>
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
<script>
	
	function showTraining(trid)
	{
		// alert(trid);
		$('.trTraining').remove();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>cash/searchtraining_ajax/", 
			data: { trid: trid },
			success: function(data)
			{
				console.log(data,"training");
				str = '';
				str += '<tr class="trTraining" style="background-color:#ccc"><th></th>';
				str += '<th>Schedule Code</th>';
				str += '<th>Module</th>';
				str += '<th>Start</th>';
				str += '<th>End</th></tr>';
				
				$.each(data,function(row,key)
				{
					str += '<tr class="trTraining" style="background-color:#ccc">';
					str += '<td></td>';
					str += '<td><input type="radio" name="optTrainingSelected" value="' + key.trainingid + '"> ' + key.code + '</td>';
					str += '<td>' + key.module + '</td>';
					str += '<td>' + key.start + '</td>';
					str += '<td>' + key.end + '</td>';
					str += '</tr>';
				});
				
				$(str).insertAfter('.' + trid).hide().show('slow');;
			}
		});
	}
		
	$(document).ready(function () {
		
		paylistid = 0;
		
		$('#searchTrainee').click(function(){
			
			var traineeName = $('#traineeName').val();
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/searchtrainee_ajax/", 
				data: { trainee: traineeName },
				success: function(data)
				{
					console.log(data);
					$('.trTrainee').remove();
					str = '';
					str += '<tr><th>Trainee ID</th>';
					str += '<th>Last Name</th>';
					str += '<th>First Name</th>';
					str += '<th>Middle Name</th>';
					str += '<th>Birthday</th></tr>';
					
					$.each(data,function(row,key)
					{
						str += '<tr id="" class="trTrainee ' + key.trid +'">';
						str += '<td><input type="radio" name="traineeOption" value="' + key.trid + '" onclick="showTraining(' + key.trid + ')"> ' + key.trid + '</td>';
						str += '<td>' + key.lname + '</td>';
						str += '<td>' + key.fname + '</td>';
						str += '<td>' + key.mname + '</td>';
						str += '<td>' + key.bdate + '</td>';
						str += '</tr>';
					});
					
					if (data.length === 0) {
						str += '<tr class="text-center"><td colspan="6">No matching records found</td></tr>';
					}
					
					$('#traineeTable').html(str);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		});
		

		$('.showModal').click(function(){
			// alert($(this).attr("data-payid"));
			paylistid = $(this).attr("data-payid");
			$('#txtPaylistid').val(paylistid);
			$('#txtOrnum_id').val(<?php echo $lols["ornum_id"]; ?>);
			showOwwaList(paylistid);
			$('#listModal').modal('show');
		});
		
		$('#delOwwaTrainee').click(function(){
			var owwaid = $('input[name=traineeOwwaOption]:checked').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/owwa/delete", 
				data: { owwaid: owwaid },
				success: function(data)
				{
					showOwwaList(paylistid);
					alert("Trainee has been deleted");
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		});
		
		$('#btn_addTraineeToOwwaList').click(function(){
			var trid = $('input[name=traineeOption]:checked').val();
			var trainingid = $('input[name=optTrainingSelected]:checked').val();
			var paylistid = $('#txtPaylistid').val();
			var ornum_id = $('#txtOrnum_id').val();
			// alert(lols);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/owwa/add", 
				data: { trid: trid, trainingid: trainingid, paylistid:paylistid, ornum_id:ornum_id },
				success: function(data)
				{
					if (data == 1) {
						alert("Selected Trainee has been added to the Owwa List.");
					} else {
						alert("Duplicate Entry, Trainee has already been added.");
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		});
		
		$('#myModal3').on('hidden.bs.modal', function () {
			showOwwaList(paylistid)
		})
		
		function showOwwaList(paylistid)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/searchOwwaListPaylistid", 
				data: { paylistid: paylistid },
				success: function(data)
				{
					
					str = '';
					ctr = 0;
					$('.trOwwaList').remove();
					$.each(data,function(row,key)
					{
						ctr = ctr + 1;
						str += '<tr class="trOwwaList">';
						str += '<td>' + ctr + '</td>';
						str += '<td><input type="radio" name="traineeOwwaOption" value="' + key.owwaid + '"> ' + key.trid + '</td>';
						str += '<td>' + key.lname + '</td>';
						str += '<td>' + key.fname + '</td>';
						str += '<td>' + key.mname + '</td>';
						str += '<td>' + key.start + '</td>';
						str += '<td>' + key.end + '</td>';
						str += '<td>' + key.module + '</td>';
						str += '</tr>';
					});
					
					if (data.length === 0) {
						str += '<tr class="trOwwaList text-center"><td colspan="6">No matching records found</td></tr>';
					}
					
					$('#owwaListTable').append(str);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		}
		
		
	});
	
</script>
	
<?php $this->load->view('include/navmenu.php'); $user_level = $this->session->userdata("user_level"); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p style="margin-bottom: 0px;">
						Connect OWWA Trainee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Payment ID:<font style="color:red; font-size:20px;margin-right: 30px;"> <?php echo $lols["payid"]; ?></font>
						OR No:<font style="color:red; font-size:20px;margin-right: 10px;"> <?php echo empty($lols["ornum_id"]) ? "None" : $lols["ornum"]; ?></font>
					</p>
					
				</div>
				<?php  echo $this->session->flashdata('message'); ?>
				
				<div style="overflow:hidden;">
					<table cellspacing="0" cellpadding="0" style="width:50%">
					<thead>
						<th style="width:50px">No.</th>
						<th>Module Name</th>
						<th>Date of Payment</th>
						<th>Option</th>
					</thead>
					<?php $x = 0; 
						foreach ($result->result_array() as $row) {?>
					<tr>
						<td><?php echo ++$x; ?></td>
						<td><?php echo $row["typename"] ?></td>
						<td><?php echo $row["paydate"] ?></td>
						<td>
							<a class='showModal' data-payid='<?php echo $row["paylistid"] ?>'>View</a>
						</td>
					</tr>
					<?php } ?>
				</table>
				</div>
				
				<?php /*<div class="spacer floatright" style="margin-top: 10px;">
					
					<input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:20px;" value="Add Payment" onclick="javascript:void window.open('<?php echo base_url()?>cash/feesadd/<?php echo $lols["payid"]; ?>','1457058148264','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"/>
				</div> */ ?>
			</div>
		</div>
	</div>
</div>


<div class="bs-example">
    <div id="listModal" class="modal fade">
        <div class="modal-dialog" style="width:60%">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">List of Trainees</h4>
					<input type="hidden" id="txtPaylistid" />
					<input type="hidden" id="txtOrnum_id" />
				</div>
				
				<div class="modal-body">
					
					<table id="owwaListTable" class="table">
						<tr>
							<th style="width: 50px">No.</th>
							<th>Trainee ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Date Start</th>
							<th>Date End</th>
							<th>Schedule</th>
						</tr>
					</table>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button id="delOwwaTrainee" type="button" class="btn btn-danger">Delete</button>
					<a class='lols' href='#myModal3' data-toggle='modal' data-id=''><button type="button" class="btn btn-success">Add</button></a>
					<button type="button" class="btn btn-warning">Print</button>
				</div>
				
			</div>
        </div>
    </div>
</div>

<div class="bs-example">
    <div id="myModal3" class="modal fade">
        <div class="modal-dialog" style="width:60%; z-index:99999">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Search Trainee</h4>
				</div>
				
				<div class="modal-body">
					
					<input id='traineeName' type='text' value='<?php echo set_value('payor'); ?>' style="width:92%; margin-left:10px;" placeholder="Search Trainee (Last Name, First Name)" />
					<button type="button" class="btn btn-primary" id="searchTrainee">Search</button>
					<div id="clear"></div> 
					
					<table id="traineeTable" class="table">
						<tr>
							<th>Trainee ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Birthday</th>
						</tr>
					</table>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="btn_addTraineeToOwwaList">Confirm Add</button>
				</div>
				
			</div>
        </div>
    </div>
</div>


<?php //require_once('include/footer.php'); ?>
</body>
</html>