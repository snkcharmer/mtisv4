<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p> List of Pending Payments for <?php echo date("Y-m-d") ?></p>
				</div>
				
				<?php echo $this->pagination->create_links(); ?>
				<table cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:60px;">Code</th>
						<th style="width:80px;">Module</th>
						<th style="width:40px">Batch</th>
						<th>Start</th>
						<th>End</th>
						<th>Hrs</th>
						<th>Room</th>
						<?php /**<th>Fee</th> **/ ?>
						<th>Venue</th>
						<th style="width:30px;">Max</th>
						<th style="width:30px;">Size</th>
						<th style="width:100px;">Trainers</th>
						<th style="width:80px;"></th>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td><?php echo $rows['code']?></td>
						<td><?php echo $rows['module']?></td>
						<td><?php echo $rows['batch']?></td>
						<td style="width:70px"><?php echo $rows['start']?></td>
						<td style="width:70px"><?php echo $rows['end']?></td>
						<td><?php echo $rows['hours']?></td>
						<td><?php echo $rows['room']?></td>
						<?php /**<td><?php echo $rows['fee']?></td> **/?>
						<td><?php echo $rows['venue']?></td>
						<td><?php echo $rows['max']?></td>
						<td><?php echo $rows['size']?></td>
						<td><?php echo $rows['trainers']?></td>
						<td>
							<?php 
							if ($this->session->userdata("user_level") == 1)
							{ ?>
								<a href='<?php echo base_url()?>schedule/Edit/<?php echo $rows['code'];?>'>Edit</a><br />
								<a href='<?php echo base_url()?>schedule/Delete/<?php echo $rows['code'];?>'>Delete</a><br />
							<?php } ?>
							
							<a href='<?php echo base_url()?>schedule/grades/<?php echo $rows['code'];?>'>Grades</a><br />
							<a href='<?php echo base_url()?>schedule/certificate/<?php echo $rows['code'];?>'>Certificate</a><br />
						</td>
					</tr>
					<?php } ?>
				</table>
				
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>