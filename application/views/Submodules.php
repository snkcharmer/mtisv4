<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
			
				<form name='search' action='<?php echo base_url()?>submodules/search' method='post'>
					<div id="generalinfo_header">
						<p>List of Submodules | Search: <input name='submodcode' type='text' value='' style="font-size:15px;"/></p>
					</div>
				</form>
				
				<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1">
					<thead>
						<th>Module</th>
						<th>Submodule Name</th>
						<th width="30%">Description</th>
						<th></th>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td><label><?php echo $rows['module']?></label></td>
						<td><?php echo $rows['submodule']?></td>
						<td><?php echo $rows['description']?></td>
						<td>
							<?php 
							if ($this->session->userdata("user_level") == 1)
							{ ?>
								<a href='<?php echo base_url()?>submodules/edit/<?php echo $rows['submodid'];?>'>Edit</a> |
								<a href='Delete'>Delete</a>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>	
	</div>
</div>
<?php require_once('include/footer.php'); ?>
</body>
</html>