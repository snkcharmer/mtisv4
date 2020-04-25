
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>


<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>
<style>
	a{
		color: #000;
	}
	a:hover {
		color: red;	
	}
</style>
<div id="container">
	<div id="mid">
		<?php $this->load->view('leftpane/lp_index.php') ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
				<p style="margin-bottom: 0px;">Trainee > Select Training 
					| <a href='#myModal2' data-toggle='modal' data-id=''>Add Payments</a>
				</p>
				</div>
				
				<?php  echo $this->session->flashdata('message'); ?>
				<?php echo validation_errors();?>
				<div id="checkheight">
					<?php echo form_open(base_url().'nea/confirm_enroll'); ?>
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
						
						<div style="float:left; width:55%" class="tablenopadding resizable">
							<table id="dataTable" cellspacing="0" style="width:100%; margin:0 0 5px 5px;">
							</table>
						</div>
					</div>
					
					
					<div>
						<input type="hidden" name="trainid" value="<?php echo $this->session->userdata('trainid');?>">
						<input type="hidden" name="licid" value="<?php echo $this->session->userdata('licid');?>">
						<input type="hidden" name="rankid" value="<?php echo $this->session->userdata('rankid');?>">
						<input type="hidden" name="employid" value="<?php echo $this->session->userdata('employer');?>">
						<input type="hidden" name="disembark" value="<?php echo $this->session->userdata('dateofme');?>">
						<input type="hidden" name="paycatid" value="<?php echo $this->session->userdata('paycatid');?>">
						<input type="hidden" name="codeid" value="<?php echo $this->session->userdata('codeid');?>">
					</div>
					<div id="generalinfo_header"><p style='margin-bottom: 0px;'>Selected Training</p></div>
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
						<?php// if ($schedules){ ?>
						<?php foreach ($gettrainings->result_array() as $modules){ ?>
							<input type="hidden" name="modcode[]" value="<?php echo $modules['modcode'];?>">	
							<input type="hidden" name="code[]" value="<?php echo $modules['scode'];?>">
							<input type="hidden" name="venid[]" value="<?php echo $modules['venueid'];?>">
							<input type="hidden" name="spid[]" value="<?php echo $modules['sponsor'];?>">
						<tr>
							<td><label><?php echo $modules['modcode']?></label></td>
							<td><?php echo $modules['dnamodule']?></td>
							<td><?php echo $modules['start']?></td>
							<td><?php echo $modules['end']?></td>
							<td><?php echo $modules['ndays']?></td>
							<td><?php echo $modules['venue']?></td>
							<td><?php echo $modules['fee']?></td>
						</tr>
						<?php }
						//}?>
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
						'class' => 'btn btn-primary',
						'value' => 'Confirm Enrollment',
						'onClick' => "this.form.submit(); this.disabled=true; this.value='Sending…';",
						'style' => 'margin-top: 5px;padding:5px;',
						);
						echo form_submit($data);
					?>
					<a href='<?php echo base_url()?>nea/enroll_module/<?php echo $this->session->userdata('nid'); ?>'>
						<input type="button" value="Cancel" class="btn btn-primary" style="margin-top:5px; padding:5px;" onClick="return confirm('Are you sure to Cancel this enrollment?')"/>
					</a>
					</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bs-example">
    <div id="myModal2" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>nea/addotherfee' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add Other Fees</h4>
					</div>
					
					<div class="modal-body">
						<table>
						<?php foreach ($fees2->result() as $row) { ?>
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
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
					
				</div>
			</form>
        </div>
    </div>
</div>

<?php //require_once('include/footer.php'); ?>
</body>
</html>