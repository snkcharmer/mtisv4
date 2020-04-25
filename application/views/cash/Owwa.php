<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<form name='search' action='<?php echo base_url()?>cash/owwa/search' method='post'>
					<p>
						Search OWWA OR. <input type="text" name="controlno" style="font-size:15px" autofocus>
						
					</p>
					</form>	
				</div>
				
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
				
				
					<table cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:10px;">No.</th>
						<th style="width:60px;">OWWA Payment OR#</th>
						<th style="width:60px;">Payor</th>
						<th style="width:150px">Date</th>
						<th style="width:40px">Amount</th>
						<th style="width:70px">User</th>
						<th style="width:70px">Options</th>
					</thead>
					<?php $x = (!($this->uri->segment(4)) ? 0 : $this->uri->segment(4)); 
						foreach ($result->result_array() as $row) {?>
					<tr>
						<td><?php echo ++$x; ?></td>
						<td><?php echo $row["ornum"] ?></td>
						<td><?php echo $row["payor"] ?></td>
						<td><?php echo $row["paydate"] ?></td>
						<td><?php echo $row["amount"] ?></td>
						<td><?php echo $row["user"] ?></td>
						<td>
							<a href="<?php echo base_url()?>cash/owwa/list/<?php echo $row["payid"] ?>" style="text-decoration:none;">View</a>
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