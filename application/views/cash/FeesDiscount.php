
<?php $this->load->view('include/headercash') ?>
<?php $this->load->view('include/navmenu.php'); ?>
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>

		
	<script type="text/javascript">
		function searchlols(lols)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/getfee/"+lols, 
				success: function(data)
				{
					//alert(JSON.stringify(data));
					document.getElementById("typename").value = (!isNaN(data.typename) ? data.descriptn : data.typename);
					document.getElementById("typeshort").value = (!isNaN(data.typename) ? data.module : data.typeshort);
					document.getElementById("amount").value = data.amount;
					document.getElementById("paycatid").value = data.paycatid;
					document.getElementById("paytypeid").value = data.paytypeid;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		}
	</script>
	
<div class="midShadow" id="content">
	<div id="generalinfo" class="column" style="width:49%; float:left; min-height:270px;">
		<div id="generalinfo_header">
			<p style='margin-bottom: 0px;'>
				Add Fees
			</p>
		</div>
			
			
			<?php  echo $this->session->flashdata('message'); ?>
			<?php echo validation_errors();?>
			<form name='search' action='<?php echo base_url()?>cash/feesadd' method='post'> <?#------------------------------------ First Form  ?>
			<div class="spacer">
				<div class="anchortext">Category: </div>
				<div class="placeholdertb">
					<?php 
					foreach ($categories->result_array() as $key)
					{
						$cat[$key['paycatid']] = $key['catname'];
					}
					
					echo form_dropdown('category', $cat, 'LCCA', 'id="category"'); ?>
				</div>
			</div>
			
			
			
				<div class="spacer">
					<div class="anchortext">Fee/Discount: </div>
					<div class="placeholdertb">
						<input name='typename' type='text' value='<?php echo set_value('typename'); ?>' style="width:200px;" placeholder="Fee Name" />
					</div>
				</div>
				<div class="spacer">
					<div class="anchortext">
						Short Name:
					</div>
					<div class="placeholdertb">
						<input type="text" name="typeshort" value='<?php echo set_value('typeshort'); ?>' style="width: 200px" placeholder="Short Name">
					</div>
				</div>
				<div class="spacer">
					<div class="anchortext">
						Amount:
					</div>
					<div class="placeholdertb">
						<input type="text" name="amount" value='<?php echo set_value('amount'); ?>' style="width: 200px" placeholder="Amount">
					</div>
				</div>
				<? #------------------------------------------------------------------------------------------------------ First Form End ?>
			<div class="spacer floatright" style="margin-top: 10px;">
				<button class="btn btn-primary" type="submit" style="width:150px;float:left;"> Save </button>
			</div>
		</form>
			<?php //------------------------- Next Function -----------------?>
	</div>
	<div id="generalinfo" class="column" style="width:48%;min-height:270px;">
		<form name='search' action='<?php echo base_url()?>cash/trainingfeesadd' method='post'> <?#------------------------------------ Second Form  ?>
		<div id="generalinfo_header"><p style='margin-bottom: 0px;'>Add Training Fee </p></div>
		<div id="clear"></div>
			<?php  echo $this->session->flashdata('message2'); ?>
			<?php echo validation_errors();?>
			<div class="spacer">
				<div class="anchortext">Training Name: </div>
				<div class="placeholdertb">
					<?php $module['#'] = 'Please Select'; ?>
					<?php echo form_dropdown('module_id2', $module, '#', 'id="module"'); ?>
				</div>
			</div>
			<div class="spacer">
				<div class="anchortext">Category: </div>
				<div class="placeholdertb">
					<?php 
					foreach ($categories->result_array() as $key)
					{
						$cat[$key['paycatid']] = $key['catname'];
					}
					
					echo form_dropdown('category2', $cat, 'LCCA', 'id="category"'); ?>
				</div>
			</div>
			<div class="spacer">
				<div class="anchortext">
					Amount:
				</div>
				<div class="placeholdertb">
					<input type="text" name="amount2" value='<?php echo set_value('amount2'); ?>' style="width: 200px" placeholder="Amount">
				</div>
			</div>
			<div class="spacer floatright" style="margin-top: 10px;">
				<button class="btn btn-primary" type="submit" style="width:150px;float:left;"> Save </button>
			</div>
		</form> <? #------------------------------------------------------------------------------------------------------ Second Form End ?>
	</div>
	
	<div id="generalinfo" class="column">
		<div id="generalinfo_header"><p style='margin-bottom: 0px;'>List of Fees </p></div>
		<table cellspacing="0" cellpadding="0" class="tablenopadding">
			<thead>
				<th>Fee Name</th>
				<th>Amount</th>
				<th>Category</th>
				<th width="80px">Options</th>
				<th width="80px">Active</th>
				<?php /*<th style="width:100px">Options</th>*/ ?>
			</thead>
			<?php foreach ($records as $rows) {?>
			<tr>
				<td><?php echo (empty($rows["module"]) ? $rows['typename'] : $rows["module"]) ;?></td>
				<td><?php echo $rows['amount']?></td>
				<td><?php echo $rows['catname']?></td>
				<td><a class='lols' href='#myModal' data-toggle='modal' data-id='<?php echo $rows["paytypeid"] ?>' onclick="searchlols(<?php echo $rows["paytypeid"] ?>)">Edit</a></td>
				<td><?php if ($rows["isActive"] == 1) { ?> 
						<a href="<?php echo base_url()?>cash/deactivate_fee_status/<?php echo $rows["paytypeid"] ?>">
							<img src="<?php echo base_url()?>images/active.gif">
						</a>
					<?php } else { ?>
						<a href="<?php echo base_url()?>cash/activate_fee_status/<?php echo $rows["paytypeid"] ?>">
							<img src="<?php echo base_url()?>images/inactive.gif">
						</a>
					<?php } ?>
				</td>
					<?php /*<td>
					<a href='<?php echo base_url()?>cash/feesedit/<?php echo $rows['paytypeid'];?>'>Edit</a>
						
					if ($this->session->userdata("user_level") == 1)
					{ ?>|
						<?php /**<a href='trainee/delete/<?php echo md5($rows['trid']) ?>' onClick="return confirm('All trainings and payments would be deleted. Are you sure you want to DELETE this Trainee? ')">Delete</a>
						<a href='<?php echo base_url()?>trainee/delete/<?php echo $rows[''] ?>' onClick="return confirm('Do not DELETE if Trainee has record on other Trainings. Please check on Enroll option. Are you sure you want to delete?')">Delete</a>
					<?php } ?> **/ ?>
			</tr>
			<?php } ?>
		</table>
		<div style="margin-top:10px; text-align:center;">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>


<div class="bs-example">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
			<form class="form-horizontal" action='<?php echo base_url()?>cash/confirm_editfee' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Edit Fee</h4>
					</div>
					
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Type Name: </label>
							<div class="col-lg-8">
								<input type="text" class="form-control" name="typename" style="width: 100%" id="typename" readonly />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Short Name: </label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="typeshort" name="typeshort" id="typeshort" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Amount: </label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="amount" name="amount" id="amount"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Category: </label>
							<div class="col-lg-8">
								<?php 
									foreach ($categories->result_array() as $key)
									{
										$cat[$key['paycatid']] = $key['catname'];
									}
									echo form_dropdown('category3', $cat, 1, 'class="form-control" id="paycatid" style="width:100%; margin-top:5px;"'); 
								?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">ID: </label>
							<div class="col-lg-7">
								<input type="text" class="form-control" id="paytypeid" name="paytypeid" required hidden readonly /> 
							</div>
						</div>
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