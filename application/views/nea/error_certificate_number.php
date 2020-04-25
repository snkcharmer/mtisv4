<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>

<div id="container">
	<div id="mid">
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header" ><p>
					<div id='cssmenu' style="float:left;height:45px;">
						<ul>
							<li style="padding-top: 5px;font-size: 20px;margin-right: 40px;">List of Error Certificate number > </li>
						</ul>
					</div>
					<form name='search' action='<?php echo base_url()?>Nea/search_na_mod' method='post' style="float:left;">
						<div style="float:left;">Search Module
						<input type="text" name="search" style="font-size:15px; width:200px; margin-left: 5px" />
						</div>
					</form>
						
					</p>
					<div style="clear:both;"></div>
				</div>

				
				
				
				<table class="example" cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:60px;">Module</th>
						<th style="width:150px">Certificate Number</th>
						<th style="width:20px">Issued date</th>
						<th style="width:70px">Date added</th>
					</thead>
					<?php 
						$x = 0;
						foreach ($records as $rows) { ?>
					<tr>
						
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['module']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['certnum']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['certdate']?></label></td>
						<td><label for="code<?php echo $x; ?>"><?php echo $rows['dateadded']?></label></td>
						
					</tr>
					<?php $x++; } ?>
				</table>
				<div style="margin-top:10px">
				<?php 
				//echo $this->session->userdata('currentyear');
				echo $this->pagination->create_links(); 
				?>
				</div>
			</div>
		</div>
	</div>
	<script>
		
	</script>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>