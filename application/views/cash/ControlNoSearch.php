<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<form name='search' action='<?php echo base_url()?>cash/controlno/search' method='post'>
					<p>
						Search Control No. <input type="text" name="controlno" style="font-size:15px" autofocus>
					</p>
					</form>	
				</div>
				
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
				
				
					<table cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:10px;">No.</th>
						<th style="width:60px;">Control No.</th>
						<th style="width:150px">Date</th>
						<th style="width:40px">Amount</th>
						<th style="width:70px">User</th>
						<th style="width:70px">Options</th>
					</thead>
					<?php $x = 0; foreach ($result->result_array() as $row) {?>
					<tr>
						<td><?php echo ++$x; ?></td>
						<td><?php echo $row["controlno"] ?></td>
						<td><?php echo $row["dateadded"] ?></td>
						<td><?php echo $row["amount"] ?></td>
						<td><?php echo $row["user"] ?></td>
						<td>
							<a href="<?php echo base_url()?>cash/controlno/edit/<?php echo $row["cnid"] ?>" style="text-decoration:none;">Edit</a> |
							<a href="<?php echo base_url()?>cash/controlno/delete/<?php echo $row["cnid"] ?>" onClick="return confirm('Are you sure you want to delete this Control No. <?php echo $row["controlno"] ?>?')" style="text-decoration:none;">Delete</a>
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