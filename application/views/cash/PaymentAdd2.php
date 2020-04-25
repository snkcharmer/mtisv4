<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add Payment
					</p>
				</div>
					<?php  echo $this->session->flashdata('message'); ?>
				<table cellspacing="0" cellpadding="0" class="tablenopadding">
					<thead>
						<th style="width:70px">Trainee ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th style="width:100px">Middle Name</th>
						<th style="width:30px">Ext</th>
						<th style="width:250px"></th>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td><?php echo $rows['trid']?></td>
						<td><?php echo $rows['lname']?></td>
						<td><?php echo $rows['fname']?></td>
						<td><?php echo $rows['mname']?></td>
						<td><?php echo $rows['suffix']?></td>
						<td>
							<a href='<?php echo base_url()?>cash/addpayment3/1/<?php echo $rows['trid'];?>'>Proceed to Payments</a>
						</td>
					</tr>
					<?php } ?>
				</table>
				<div style="margin-top:10px">
				<?php echo $this->pagination->create_links(); ?>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>