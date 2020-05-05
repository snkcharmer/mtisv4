<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		<script>
			$(document).ready(function () {
				
				$('#submitbtn').click(function() {
					$('#formSearch').attr('action', '<?php echo base_url()?>cash/reports/print');
					$("#formSearch").submit();
				});
					
				$('#summary').click(function() {
					startdate = $("#startdate").val();
					enddate = $("#enddate").val();
					
					if(startdate == "") {	
						alert("Please input Start Date");
						return
					}
					
					if(enddate == "") {	
						alert("Please input End Date");
						return
					}
					
					$('#formSearch').attr('action', '<?php echo base_url()?>cash/summaryReport');
					$("#formSearch").submit();
				});
				
			});
		</script>
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>
						Print Reports
					</p>
				</div>
				<form id="formSearch" name='search' action='<?php echo base_url()?>cash/reports/print' method='post' target="_blank">
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<div style="clear:both;"></div>
					<div class="spacer">
						<div class="anchortext">Start Date: </div>
						<div class="placeholdertb">
							<input id="startdate" name='startdate' type='date' value='<?php echo set_value('startdate'); ?>' style="width:170px;" required />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">End Date: </div>
						<div class="placeholdertb">
							<input id="enddate" name='enddate' type='date' value='<?php echo set_value('enddate'); ?>' style="width:170px;" required />
						</div>
					</div>
					<div class="spacer"><div class="anchortext">Category: </div>
						<?php 
						foreach ($record->result_array() as $key)
						{
							$cat[$key['paycatid']] = $key['catname'];
						}
						?>
						<div class="placeholdertb">
							<?php 
							echo form_dropdown('cat', $cat,'id="cat" style="width:414px"'); 
							?>
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;">
						<input id="submitbtn" class="fadein" type="button" style="height:40px;width:140px;float:left; font-size:20px;" value="View"/> 
						<input id="summary" class="fadein" type="button" style="height:40px;width:140px;float:left; font-size:20px;margin-left: 10px" value="Summary"/>
					</div>
					<div id="clear"></div> <?php //------------------------- Next Function -----------------?>
				
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>