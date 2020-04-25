<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Add Modules on Report for LCCA
					</p>
				</div>
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div style="clear:both;"></div>
					
					<form name='search' action='<?php echo base_url()?>cash/insert_reportheader_lcca' method='post'>
					<div style="float:left; width:30%;">
						<div class="spacer">
							<div class="anchortext">Training Name: </div>
							<div class="placeholdertb">
								<?php 
								foreach ($records->result_array() as $key)
								{
									#$cat[$key['paycatid']] = (empty($key['module']) ? $key['typename'] : $key['module']);
									$cat[$key['paytypeid']] = (empty($key['module']) ? $key['typename'] : $key['module']);
								}
								echo form_dropdown('cashtypeid', $cat, 'id="category"'); 
							?>	
							</div>
						</div>
						
						<div class="spacer floatright" style="margin-top: 10px;">
							<input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/>
						</div>
					</div>
					</form>
					<div style="float:left; margin-left: 10px; width: 65%">
				
						<table cellspacing="0" cellpadding="0" style="width: 100%">
							<thead>
								<th style="width: 50px">No.</th>
								<th colspan="2">Module Name</th>
							</thead>
							<?php foreach ($report->result_array() as $rows) {?>
							<tr>
								<td style="text-align:left;"><?php echo $rows['repid']?></td>
								<td style="text-align:left;"><?php echo $rows['typename']." - ".$rows['descriptn']?></td>
								<td>
									<a href='<?php echo base_url()?>cash/delete_report_header/lcca/<?php echo $rows['repid'];?>' onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
								</td>
							</tr>
							<?php } ?>
						</table>
						
						<?php echo $this->pagination->create_links(); ?>
					</div>
					
					
					<div id="clear"></div> <?php //------------------------- Next Function -----------------?>
				
					
			
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>