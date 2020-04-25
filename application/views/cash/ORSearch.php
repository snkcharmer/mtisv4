<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<form name='search' action='<?php echo base_url()?>cash/ornum/search' method='post'>
					<p>
						Search OR No. <input type="text" name="ornum" style="font-size:15px" autofocus> 
							<a <?php if ($this->session->userdata("paycatid") == 1) { echo "style='color:#fff; font-size:25px;margin-left:50px'"; } else { echo "style='margin-left:50px'"; } ?> href="<?php echo base_url()?>cash/set_paycatid_ornum/1" style="text-decoration:none;">Regular Funds</a> |
							<a <?php if ($this->session->userdata("paycatid") == 2) { echo "style='color:#fff; font-size:25px;'"; } ?> href="<?php echo base_url()?>cash/set_paycatid_ornum/2">LCCA</a> | 
							<a <?php if ($this->session->userdata("paycatid") == 0) { echo "style='color:#fff; font-size:25px;'"; } ?> href="<?php echo base_url()?>cash/set_paycatid_ornum/0">All</a>
					</p>
					</form>	
				</div>
				
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
				
					<table cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:100px;">OR No.</th>
						<th>Date</th>
						<th>Status</th>
						<th>Options</th>
					</thead>
					<?php $x = 0; foreach ($result->result_array() as $row) {?>
					<tr>
						<td align="left">
							<?php if (!empty($row["payid"])) { ?>
								<a href="<?php echo base_url()?>cash\ornumber\<?php echo $row["payid"]; ?>"><?php echo $row["ornum"] ?></a>
							<?php } else { ?> 
								<?php echo $row["ornum"]; ?>
							<?php } ?>
						</td>
						<td><?php echo $row["dateadded"] ?></td>
						<td><?php echo ($row["status"] == 1 ? "Used" : ($row["status"] == 2 ? "Cancelled" : ($row["status"] == 3 ? "Error Correction" : "Unused"))) ?></td>
						<td align="center">
							<?php if($row["status"] == 1) { ?>
								<a href="<?php echo base_url()?>cash/ornum/cancel/<?php echo $row["ornum_id"] ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to Cancel <?php echo $row['ornum'];?>? ');">Cancel</a>
							<?php } ?>
							
							<?php /*<a href="<?php echo base_url()?>cash/ornum/edit/<?php echo $row["ornum_id"] ?>" style="text-decoration:none;">Edit</a> */ ?>
						</td>
					</tr>
					<?php } ?>
				</table>
					
					<div id="clear"></div> 
				<div style="margin-top:10px">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>