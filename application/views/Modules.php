<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
	
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
			
				<form name='search' action='<?php echo base_url()?>modules/search' method='post'>
					<div id="generalinfo_header">
						<p>List of Modules | Search Modules: <input name='modcode' type='text' value='' style="font-size:15px;"/></p>
					</div>
				</form>
				
				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						<th>Module ID</th>
						<th>Module Name</th>
						<th width="25%">Description</th>
						<th>Days</th>
						<th>Fee</th>
						<th width="7%">Active</th>
						<th width="60px"></th>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td><label><?php echo $rows['modcode']?></label></td>
						<td><?php echo $rows['module']?></td>
						<td><?php echo $rows['descriptn']?></td>
						<td><?php echo $rows['ndays']?></td>
						<td><?php echo $rows['fee']?></td>
						<td><?php echo $rows['active']?></td>
						<td>
							<?php 
							if ($this->session->userdata("user_level") == 1)
							{ ?>
								<a href='<?php echo base_url()?>modules/edit/<?php echo $rows['modcode'];?>'>Edit</a>
								<?php //<a href='Delete'>Delete</a> ?>
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
<?php require_once('include/footer.php'); ?>
</body>
</html>