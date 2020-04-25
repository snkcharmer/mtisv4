<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<link rel="stylesheet" href="<?php echo base_url()?>dist/sweetalert/sweetalert.css">
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div class="midShadow" id="content2">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						<a href="<?php echo base_url()?>schedule" style="font-size:20px;">Schedule</a> >
						<a href="<?php echo base_url()?>schedule/certificate/<?php echo $schedule["code"]?>" style="font-size:20px;">Certificate</a> [
						<?php echo $schedule["code"]." - ".$schedule["module"]; ?> ] &nbsp;&nbsp;&nbsp;&nbsp; | 
						<a href="<?php echo base_url()?>schedule/editcertificate">Edit Certificate</a> | 
						<a href="<?php echo base_url()?>schedule/printcertificate" target="_blank">Print</a> | 
						<a href="javascript:void(0);" class="printcertificate">Print Certificate</a> | 
						<a href="javascript:void(0);" class="reis">Reissuance</a>
						<?php 
						if ($this->session->userdata("user_level") == 1) {
						if($schedule["certiok"] == "Y"){ ?>
							<a href="<?php echo base_url()?>schedule/unconfirmcertificate/<?php echo $schedule["code"] ?>">
								Unconfirm
							</a> 
						<?php } else {?>
							<a href="<?php echo base_url()?>schedule/confirmcertificate/<?php echo $schedule["code"] ?>">
								Confirm
							</a> 
						<?php } } ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<font style="color:#aaa; font-size:20px">
							Status: 
						</font>
						<?php echo ($schedule["certiok"] == "Y" ? "<img src=".base_url()."images/verify.png style='height: 20px; width: auto; vertical-align:middle; padding-right:2px'> Confirmed" : "Unconfirmed"); ?>
					</p>
				</div>
				<form id="reissue" method="post" action="<?php echo base_url()?>schedule/reissuance_certificate">
				<input type="hidden" name="trainingid" class="trainingid" value="">
				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						<th><input type="checkbox" class="ace" onclick="checkall(this)" style="cursor: pointer;"></th>
						<th style="width:80px">License</th>
						<th style="width:80px">Rank</th>
						<th>Trainee</th>
						<th>Company</th>
						<th style="width:40px">Grade</th>
						<th>Remarks</th>
						<th>Number</th>
						<th>Issued</th>
						<th style="width: 100px;"></th>
					</thead>
					
			<?php
				
				if ($records->num_rows > 0) 
				{
					foreach($records->result_array() as $key) 
					{ ?>
					<tr>
						<td><input style="margin-top: 5px;cursor: pointer;" type="checkbox" name="chktrainingid[]" id="chktrainingid[]" value="<?php echo $key['trainingid']?>"></td>
						<td><?php echo (empty($key['license']) ? "NONE" : $key['license'])?> </td>
						<td><?php echo (empty($key['rank']) ? "NONE" : $key['rank']) ?> </td>
						<td><?php echo $key['fullname']?></td>
						<td><?php echo $key["name"] ?></td>
						<td><?php echo $key["fgrade"]; ?></td>
						<td><?php echo $key['remarks_cert']?></td>
						<td><?php echo $key["certnumber"]; ?></td>
						<td><?php echo $key["certdate"]; ?></td>
						<td>
							<?php
							if($key["error_certnum"] == 0){?>
								<a href="<?php echo base_url()?>nea/error_cert/<?php echo $key['certnumber'].'/'.$key['trainingid']?>" onclick="return confirm('Are you Sure, you to want to move this Certnumber to error.')" class="errorcert" style="color: red;">error certnum</a>
							<?php	
							}else{
							?>	
								<a href="<?php echo base_url()?>nea/good_cert/<?php echo $key['certnumber'].'/'.$key['trainingid']?>" class="errorcert" style="color: red;">error</a>
							<?php
							}	
							?>	
						</td>
					</tr>
			<?php 	} 
				} 
			?>
				</table>
			</form>		
			<form id="printcert_data" method="post" target="_blank" action="<?php echo base_url()?>schedule/printcertificatewithcertnum"><input type="hidden" name="trid_data" class="trid_data" value="">	
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
<script src="<?php echo base_url()?>dist/sweetalert/sweetalert-dev.js"></script>
<script type="text/javascript">
	$(document).on('click','.reis', function() {

		if (!$("input[name='chktrainingid[]']:checked").val()) {
			//alert('Please click a Record to proceed editing.');
			swal("ALERT!", "Please select a data to procedd!", "error");
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

		   	$('.trainingid').val(final);
    		//$('.enroll').submit();
    		$('#reissue').submit();

		}
	});

	$(document).on('click','.printcertificate', function() {

		if (!$("input[name='chktrainingid[]']:checked").val()) {
			//alert('Please click a Record to proceed editing.');
			swal("ALERT!", "Please select a data to procedd!", "error");
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

		   	$('.trid_data').val(final);
    		//$('.enroll').submit();
    		$('#printcert_data').submit();

		}
	});

	function checkall(ele) {
 		var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               //console.log(i)
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
	}
</script>
</body>
</html>