<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		<script type="text/javascript">
		$(document).ready(function()
		{     
			$('#mydate').change(function(){  
				$("#dataTable tr").remove();
				$("#dataTable thead").remove();
				var mydate = $('#mydate').val(); 
				var payor = "";
				var status = "";
				var totalpayment2 = 0;
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>cash/changepaymentdate/"+mydate, 
					success: function(data) 
					{
						$("#generalinfo").animate({height:$("#generalinfo").height()}, 400);
						
						$('<thead>').html("<th>Training ID</th><th>Name</th><th>Date of Payment</th><th width='100px'>Total Payment</th><th>OR #</th><th>Status</th><th>Remarks</th><th>More Information</th>").appendTo('#dataTable');
						
						//alert(JSON.stringify(data.records));
						$.each(data.records,function(key,val)
						{
							payor = (!(val.fullname) ? val.payor : val.fullname);
							status = ((val.status) == 0 ? "Unpaid" : "Paid");
							//$('<tr>').html("<td>" + val.trid + "</td><td>" + val.payor + " " + val.fullname + "</td><td>" + val.suffix + "</td><td>" + val.paydate + "</td><td>" + val.totalpayment + "</td><td><a href='<?php echo base_url()?>cash/paymentlist/" + val.payid + "'>Click for full payment fees</a></td>").appendTo('#dataTable');
							$('<tr>').html("<td>" + val.trid + "</td><td>" + payor + "</td><td>" + val.paydate + "</td><td style='text-align:right'>" + val.totalpayment + "</td><td>" + status + "</td><td>" + val.ornum + "</td><td>" + val.remarks + "</td><td><a href='<?php echo base_url()?>cash/paymentlist/" + val.payid + "'>Click for full payment fees</a></td>").appendTo('#dataTable');
							totalpayment2 += parseFloat(val.totalpayment);
						});
						
						$('<tr>').html("<td colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Payment</td><td style='text-align:right'>" + totalpayment2.toFixed(2) + "</td><td colspan='2'></td>").appendTo('#dataTable');
						
						$("#generalinfo").animate({
							height:$("#checkheight").height() + 70
						},600);
					},
				});
				
				
			});
		});
	</script>
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						<p> List of Pending Payments for <input type="date" value="<?php echo date("Y-m-d") ?>" style="font-size:15px; width:150px;" id="mydate" /> | 
						<a <?php if ($this->session->userdata("paystat") == "paid") { echo "style='color:#fff; font-size:25px;'"; } ?> href="<?php echo base_url()?>cash/paid/">Paid</a> | 
						<a <?php if ($this->session->userdata("paystat") == "unpaid") { echo "style='color:#fff; font-size:25px;'"; } ?>href="<?php echo base_url()?>cash/unpaid/">Unpaid</a> </p>
					</p>
				</div>
				<div id="checkheight">
					<table cellspacing="0" cellpadding="0" class="tablenopadding" id="dataTable">
						<thead>
							<th>Training ID</th>
							<th>Payor</th>
							<th>Date of Payment</th>
							<th width="100px">Total Payment</th>
							<th>OR #</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>More Information</th>
						</thead>
						
					<?php
						$totalpayment = 0;
						if ($records->num_rows > 0) 
						{
							foreach($records->result_array() as $key) 
							{ ?>
							<tr>
								<td><?php echo $key['trid']?></td>
								<td><?php echo $key['fullname'] == "" ? $key["payor"] : $key['fullname']; ?> </td>
								<td><?php echo $key["paydate"] ?></td>
								<td style="text-align:right"><?php echo $key["totalpayment"]; $totalpayment += $key["totalpayment"];?></td>
								<td><?php echo $key["ornum"]?></td>
								<td><?php echo $key["status"] == 1 ? "Paid" : "Unpaid";?></td>
								<td><?php echo $key['remarks']?></td>
								<td>
									<?php if ($this->session->userdata("user_level") == 3 or $this->session->userdata("user_level") == 4) { ?>
									<a href="<?php echo base_url()?>cash/paymentlist/<?php echo $key['payid'] ?>">Click for full payment fees</a>
									<?php } ?>
								</td>
							</tr>
							<?php 	}  ?>
							<tr>
								<td style="align:right; margin-left: 200px;" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Payment</td>
								<td style="align:right" colspan="1"><?php echo number_format($totalpayment, 2); ?></td>
								<td colspan="2"></td>
							</tr>
						<?php } else { ?>
							<tr>
								<td colspan="7" align="center"> - No Records found - </td>
							</tr>
					<?php 
						}
					?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>