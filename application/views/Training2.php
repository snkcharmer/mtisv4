<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<style>
	a{
		color: #000;
	}
	a:hover {
		color: red;	
	}
</style>
<div id="container">
	<script type="text/javascript">
		$(document).ready(function()
		{     
			$('#module').change(function(){  
				$("#dataTable tr").remove();
				$("#dataTable thead").remove();
				var module_id = $('#module').val(); 
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getavailableschedule/"+module_id, 
					success: function(data)
					{
						$("#generalinfo").animate({height:$("#generalinfo").height()}, 400);
						
						$('<thead>').html("<th>Code</th><th style='width:35px'>Batch</th><th style='width:35px'>Max</th><th style='width:35px'>Size</th><th>Start</th><th>End</th><th></th>").appendTo('#dataTable');
						
						$.each(data.module_details,function(code,batch)
						{
						$('<tr>').html("<td>" + code + "</td><td>" + batch.batch + "</td><td>" + batch.max + "</td><td>" + batch.size + "</td><td>" + batch.start + "</td><td>" + batch.end + "</td><td><a class='lols' href='<?php echo base_url()?>trainee/addcart/" + code + "/" + batch.paycatid + "/'>Add to Cart</a></td>").appendTo('#dataTable');
						});
						
						//alert($("#generalinfo").height());
						$("#generalinfo").animate({
							height:$("#checkheight").height() + 70
						},600);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert(XMLHttpRequest);
					}
				});
			});
		});
	</script>
	<div id="mid">
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Trainee > Select Training | Select:
				<?php $module['#'] = 'Please Select'; ?>
				<?php echo form_dropdown('module_id', $module, '#', 'id="module" style="font-size: 14px"'); ?>
				 | <a href="<?php echo base_url()?>trainee/proceedenroll/backtrack">Backtrack</a> 
				</p>
				</div>
				<?php echo $this->pagination->create_links(); ?>
				<?php  echo $this->session->flashdata('message'); ?>
				<?php echo validation_errors();?>
				<div id="checkheight">
					<?php echo form_open(base_url().'trainee/confirm_enroll'); ?>
					<div style="overflow:hidden;">
						<div style="float:left; width:20%; margin:0 0 5px 5px;">
							<table cellpadding="6" cellspacing="0" border="0" style="width:100%;" class="tablenopadding resizable">
								<tr>
									<th width="70%">Fees</th>
									<th width="30%"></th>
								</tr>
								<?php foreach ($fees->result() as $row) { ?>
									<tr>
										<td><?php echo $row->typename; ?></td>
										<?php
										if ($row->amount != 0)
										{ ?>
											<td><label><input type="checkbox" name="fees[<?php echo $row->paytypeid ?>]" value=""></label></td>
										<?php } else { ?>
											<td><input type="text" name="fees[<?php echo $row->paytypeid ?>]" value="" style="width:50px"></td>
										<?php } ?>
									</tr>
								<?php } ?>
							</table>
						</div>
						<div style="float:left; width:20%; margin:0 0 5px 5px;">
							<table cellpadding="6" cellspacing="0" border="0" style="width:100%;" class="tablenopadding resizable">
								<th>Sponsor</th>
							</table>
							<div class="spacer">
								<?php 
									$key = NULL;
									foreach ($sponsors->result_array() as $key)
									{
										$sponsor[$key['sptypeid']] = $key['sptypename'];
									}

								echo form_dropdown('sponsor', $sponsor, 1, 'id="sponsor" style="width:92%; margin-top:5px;"'); ?>

							</div>

						</div>
						
						
						<div style="float:left; width:55%" class="tablenopadding resizable">
							<table id="dataTable" cellspacing="0" style="width:100%; margin:0 0 5px 5px;">
							</table>
						</div>
					</div>
					
					
					<div></div>
					<div id="generalinfo_header"><p>Selected Training</p></div>
					<table cellpadding="6" cellspacing="0" style="width:100%" border="0">
						<tr>
						  <th>Code</th>
						  <th>Module</th>
						  <th>Start</th>
						  <th>End</th>
						  <th>No. of Days</th>
						  <th>Venue</th>
						  <th>Fee</th>
						</tr>
						<?php #print_r($this->session->userdata("cartitems")); die(); ?>
						<?php if ($schedules){ ?>
						<?php foreach ($schedules as $modules){ ?>
							<?php //foreach ($modules as $items){?>
						<tr>
							<td><label><?php echo $modules['code']?></label></td>
							<td><?php echo $modules['module']?></td>
							<td><?php echo $modules['start']?></td>
							<td><?php echo $modules['end']?></td>
							<td><?php echo $modules['ndays']?></td>
							<td><?php echo $modules['venue']?></td>
							<td><?php echo $modules['fee']?></td>
						</tr>	
						<?php }
						}?>
						<tr>
						  <td class="right"></td>
						  <td class="right"></td>
						  <td class="right"></td>
						  <td class="right"></td>
						  <td class="right"></td>
						  <td class="right"></td>
						  <td class="right"></td>
						</tr>
					</table>
					<p style='margin-top: 5px;'>
					<?php 
						$data = array(
						'class' => 'fadein',
						'value' => 'Confirm Enrollment',
						);
						echo form_submit($data);
					?>
					<a href = ''><input type="button" value="Cancel" class="fadein" style="padding:5px;"/></a>
					</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php //require_once('include/footer.php'); ?>
</body>
</html>