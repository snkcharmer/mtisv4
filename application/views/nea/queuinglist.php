
<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>
<div id="container">
	<div id="mid">
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow" >
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>List of Queued Trainee
						
					</p>
				</div>
				
				<?php  echo $this->session->flashdata('message'); ?>
				
				<table cellspacing="0" cellpadding="0" class="tablenopadding">
					<thead>
						<th>Last Name</th>
						<th>First Name</th>
						<th style="width:100px">Middle Name</th>
						<th style="width:30px">Ext</th>
						<th style="width:130px"></th>
						<th style="width:250px"></th>
					</thead>
					<?php foreach ($rec->result_array() as $rows) {?>
					<tr style="height: 50px;">
						<td><?php echo $rows['lname']?></td>
						<td><?php echo $rows['fname']?></td>
						<td><?php echo $rows['mname']?></td>
						<td><?php echo $rows['suffix']?></td>
						<td><?php 
							if($rows['redcross'] != 1 ){
								if($rows['window'] != 0){ echo $this->session->userdata('username').' - Window '. $rows['window']; } }else{?>
							<?php 
							echo "<span style='color:red;'>Please get Redcross Insurance</span>";

							}	?>		
						</td>
						<td>
						<?php 
							if($rows['redcross'] != 1 ){
							if($rows['window'] != 0){?>
							<audio controls autoplay hidden>
							  	<source src="<?php echo base_url()?>video/Doorbell.wav" type="audio/wav">
							  	<source src="<?php echo base_url()?>video/Doorbell.wav" type="audio/wav">
							  	Your browser does not support the audio element.
							</audio>
							<a href='<?php echo base_url()?>home/stop/<?php echo $rows['idnum']?>'><img src="<?php echo base_url()?>img/load.gif" style="width: 50px;"></a>
							<a href='<?php echo base_url()?>nea/enroll/<?php echo $rows['idnum']?>'><b>VIEW PROFILE</b></a>
						<?php }else{ ?>
							<a href='<?php echo base_url()?>home/start/<?php echo $rows['idnum']?>'><b>START PROCESSING</b></a>  
						<?php } }else{?>
							<a href='<?php echo base_url()?>home/alreadyhadrd/<?php echo $rows['idnum']?>'><b>ALREADY HAD INSURANCE</b></a>

						<?php } ?>
							
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
</div>
<?php $this->load->view("include/footer") ?>
</body>
</html>