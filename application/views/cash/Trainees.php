<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						List of Trainees for <?php echo "[ ".$schedule->description." - " . $schedule->code." ]";?>
					</p>
				</div>

				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						<th>Training ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>suffix</th>
						<th>Total Payment</th>
						<th>More Information</th>
					</thead>
					
			<?php
				
				if ($records->num_rows > 0) 
				{
					foreach($records->result_array() as $key) 
					{ ?>
					<tr>
						<td><?php echo $key['trid']?> </td>
						<td><?php echo $key['lname']?> </td>
						<td><?php echo $key['fname']?> </td>
						<td><?php echo $key['mname']?></td>
						<td><?php echo $key["suffix"] ?></td>
						<td><?php echo $key["totalpayment"]; ?></td>
						<td><a href="#">Click for full payment feess</a></td>
					</tr>
			<?php 	} 
				} else { ?>
					<tr>
						<td> - No Records found - </td>
					</tr>
			<?php 
				} 
			?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>