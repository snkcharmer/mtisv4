<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<form>
					<p>
						<p>List of Payments</p>
					</p>
					</form>
				</div>

				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						<th width="100">Trainee ID</th>
						<th width="70">Date</th>
						<th>Full Name</th>
						<th>Status</th>
						<th>Total Payment</th>
						<th>More Information</th>
					</thead>
					
			<?php
				
				if ($records->num_rows() > 0) 
				{
					foreach($records->result_array() as $key) 
					{ ?>
					<tr>
						<td><?php echo $key['trid']?> </td>
						<td><?php echo $key['paydate']?> </td>
						<td>
							<?php
							if (!empty($key['lname'])){
								echo $key["fullname"];
							}
							else
							{
								echo $key["payor"];
							}
							?>
						</td>
						<td><?php echo ($key["status"] == 1 ? 'Paid' : 'Unpaid'); ?></td>
						<td><?php echo $key["totalpayment"]; ?></td>
						
						<td><?php if($this->session->userdata("user_level") == 3 or $this->session->userdata("user_level") == 4){ ?>
							<a href="<?php echo base_url()?>cash/paymentlist/<?php echo $key['payid'] ?>">
								Click for full payment fees
							</a>
							<?php } ?>
						</td>
						
					</tr>
			<?php 	} 
				} else { ?>
					<tr>
						<td align="center" colspan="6"> - No Records found - </td>
					</tr>
			<?php 
				} 
			?>
				</table>
				<div style="margin-top:10px;">
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>