
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>

<?php $this->load->view('include/headercash') ?>
<script>
	$(document).on("click", ".lols", function () {
		 var myBookId = $(this).data('id');
		 $(".modal-body #payid").val( myBookId );
	});
	
	$(document).ready(function () {
		$('#cutoff').change(function() {
			if($(this).is(":checked")) {
				//'checked' event code
				//alert("checked");
				varcut = 1;
			} else {
				varcut = 0;
			}
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>cash/cutoff/"+varcut, 
				success: function(data)
				{
					//alert(varcut);
					window.location.reload()
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest);
				}
			});
		});
		
		$('#feestr2').change(function(){
			$('#paytypeidtr').val($('#feestr2').val());
		});
	});
	
</script>
	
<?php $this->load->view('include/navmenu.php'); $user_level = $this->session->userdata("user_level"); ?>
<div id="container">
	<div id="mid">
		<script src="<?php echo base_url()?>js/resizetable/resizable-table.js"></script>
		
		<div class="midShadow" id="content">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p style="margin-bottom: 0px;">
						Name: <font style="color:red; font-size:20px;margin-right: 30px;"> <?php echo (empty($lols["fullname"]) ? $lols["payor"] : $lols["fullname"]); ?></font>
						Payment ID:<font style="color:red; font-size:20px;margin-right: 30px;"> <?php echo $lols["payid"]; ?></font>
						Category:<font style="color:red; font-size:20px;margin-right: 30px;"> <?php echo $lols["catname"]; ?></font>
						OR No:<font style="color:red; font-size:20px;margin-right: 10px;"> <?php echo empty($lols["ornum_id"]) ? "None" : $lols["ornum"]; ?></font>
						<input type="checkbox" name="cutoff" id="cutoff" <?php echo($cutoff['cutoff'] == 1 ? "checked" : "") ?>><font style="color:red; font-size:20px;margin-right: 10px;"> Cut-off</font>
						<?php if ($user_level == 4 && $lols["status"] == 0 && $lols["fullname"] == "") { ?>
							<a class='lols' href='#myModal3' data-toggle='modal' data-id=''>
								<img src="<?php echo base_url()?>images\edit.PNG" style="height: 22px; width: auto; vertical-align:middle;">Change Name</a>
						<?php } ?>
						<?php if ($lols["status"] == 1) { ?>
							<a href='<?php echo base_url()?>cash/printor_cash/<?php echo $lols["payid"];?>' class="print" target="blank"><img src="<?php echo base_url()?>images\printer.png" style="height: 22px; width: auto; vertical-align:middle;">Print Cash</a> | 
							<a href='<?php echo base_url()?>cash/printor_check/<?php echo $lols["payid"];?>' class="print" target="blank"><img src="<?php echo base_url()?>images\printer.png" style="height: 22px; width: auto; vertical-align:middle;">Print Check</a>
						<?php } ?>
						<?php if ($user_level == 4 and $lols["status"] == 1)  { ?>
							<a class='lols' href='#myModal2' data-toggle='modal' data-id=''><img src="<?php echo base_url()?>images\verify.png" style="margin-left: 20px;height: 22px; width: auto; vertical-align:middle;">Unverify?</a>
						<?php } ?>
					</p>
					
				</div>
				<?php  echo $this->session->flashdata('message'); ?>
				
				<div style="overflow:hidden;">
					<div style="float:left; margin:0 0 5px 5px; width: 800px;">
						<table cellspacing="0" cellpadding="0" class="tablenopadding resizable" id="table1" style="width:100%;" style="float:left">
							<thead>
								<tr>
									<th>Fee</th>
									<th>Remarks</th>
									<th>Amount</th>
									<th width="240">Options</th>
								</tr>
							</thead>
							
						<?php
							$totalam = 0;
							#print_r($paymentlist->result_array()); die();
							// Edited ko 10-25-2016; Pyde kuhaon, tapos an may && ha $checkpaylist
							$checkpaylist = $paymentlist->row_array();
						
							
							//End
							if ($paymentlist->num_rows > 0 && (!empty($checkpaylist["paylistid"]))) //adi hea
							{
								foreach($paymentlist->result_array() as $key) 
								{ $totalam = $totalam + $key['amount']?>
								<tr>
									<td style="text-align: right;">
										<?php #echo (!empty($key["module"]) ? $key["module"] : $key['typename']); ?> 
										<?php echo (!empty($key["modfee"]) ? $key["modfee"] : $key['typename']); ?> 
										<?php echo (!empty($key["remarks"]) ? "- " . $key["remarks"] : ""); ?> 
									</td>
									<td><?php echo $key["rem"] ?></td>
									<td style="text-align: right"><?php echo number_format((float)$key['amount'], 2, '.', ''); ?> </td>
									<?php if ($lols["status"] == 0) { ?>
									<td>
										
										<a href="<?php echo base_url()?>cash/editpayment/<?php echo $key["paylistid"]; ?>">Edit</a> | 
										<?php if($key['isTraining'] != 1) { ?>
										<a href="<?php echo base_url()?>cash/deletepayment/<?php echo $lols["payid"]; ?>/<?php echo $key["paylistid"]; ?>" onClick="return confirm('Delete payment?')">Delete
										</a> |
										<?php } ?>
										<a href="<?php echo base_url()?>cash/addremarks/<?php echo $key["paylistid"]; ?>">Remarks</a> | 
										<?php /* <a href="<?php echo base_url()?>cash/transfer/<?php echo $key["paylistid"]; ?>/<?php echo $lols["paycatid"] ?>">Transfer</a> */ ?>
										<a class='lols' href='#myModal' data-toggle='modal' data-id='<?php echo $key["paylistid"]; ?>*<?php echo $lols["payid"]; ?>*<?php echo $key["trainingid"]; ?>'>Transfer</a>
										<?php /*
										<a class='lols' href='#partialPayment' data-toggle='modal' data-id='<?php echo $key["paylistid"]; ?>*<?php echo $lols["payid"]; ?>'>Partial</a>
										*/ ?>
									</td>
									<?php } ?>
								</tr>
						<?php 	} 
							} else { ?>
								<tr>
									<td colspan="4" align="center"> - No Records found - </td>
								</tr>
						<?php 
							} 
						?>
							<tr>
								<td style="background:#aaa; border:1px solid #333;border-left:0px;border-right:0px;">Total Amount</td>
								<td style="background:#aaa; border:1px solid #333;border-left:0px;border-right:0px;"></td>
								<td style="background:#aaa;border:1px solid #333;text-align: right; border-left:0px;"><?php echo number_format((float)$totalam, 2, '.', '');; ?></td>
							</tr>
								
						</table>
						
						<form name='search' action='<?php echo base_url()?>cash/confirmpayment' method='post'>
							<div class="spacer">
								<div class="placeholdertb">
								Date of Payment: 
								</div>	
							<div class="anchortext">
									<input type="date" name="paydate" style="margin-left:10px; width:160px" value="<?php echo date('Y-m-d',strtotime($dateused));?>" <?php echo ($lols["status"] == 1 ? "disabled" : "" ) ?>/>
							</div>
							</div>
							
							<div class="spacer">
							<div class="anchortext">
								<?php if ($lols["status"] == 0) { ?>
								<input class="fadein" type="submit" style="height:30px;width:150px;float:left; font-size:15px; margin-left: 10px;" value="Confirm Payment" onClick="this.form.submit(); this.disabled=true; this.value='Sending…';" /><?php } ?>
							</div>
							
							</div>
						</form>	
						
						
					</div>
					
					<?php if ($lols["status"] == 0) { #($this->session->userdata("priv") == )?>
						<div style="float:right; width:400px; margin:0 20px 5px 5px;">
							<table cellpadding="6" cellspacing="0" border="0" style="width:250px;" class="tablenopadding resizable">
								<tr>
									<th width="200px">Fees</th>
									<th width="100px">Amount</th>
									<th width="50px"></th>
								</tr>
							</table>
							<?php foreach ($fees->result() as $row) { ?>
								<div style="height:50px;">
									<form action="<?php echo base_url()?>cash/addfeetoor/" method="post">
									
									<div class="txtcontainer">
										<div class="anchortext" style="width:200px"><?php echo $row->typename; ?></div>
										<div class="placeholdertb">
											<input name="amount" type="text" style="width:70px; text-align: right; font-size:15px;" value="<?php echo $row->amount; ?>" />
											<input name="paytypeid" type="text" value="<?php echo $row->paytypeid ?>" hidden />
											<input class="fadein" type="submit" style="height:30px;width:50px; margin-left:10px; font-size:15px;" value="Add"/>
											
										</div>
									</div>
									</form>
								</div>
							<?php } ?>
							<div style="height:50px;">
								<form action="<?php echo base_url()?>cash/addfeetoor/" method="post">
								<div class="txtcontainer">
									<div class="anchortext" style="width:200px">
										<select name="feestr2" id="feestr2" style="width:190px" class="form-control" required>
											<option value="">Select Module</option>
											<?php foreach ($feestr->result_array() as $key3) { ?>
												<option value="<?php echo $key3['paytypeid']; ?>">
													<?php echo $key3['module'] . " - " .$key3['typename']; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="placeholdertb">
										<input name="amount" type="text" style="width:70px; text-align: right; font-size:15px;" value="0.00" />
										<input name="paytypeid" type="text" value="" hidden id="paytypeidtr" />
										<input class="fadein" type="submit" style="height:30px;width:50px; margin-left:10px; font-size:15px;" value="Add"/>
									</div>
								</div>
								</form>
							</div>
						</div>
					<?php } ?>
				</div>
				
				<?php /*<div class="spacer floatright" style="margin-top: 10px;">
					
					<input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:20px;" value="Add Payment" onclick="javascript:void window.open('<?php echo base_url()?>cash/feesadd/<?php echo $lols["payid"]; ?>','1457058148264','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;"/>
				</div> */ ?>
			</div>
		</div>
	</div>
</div>

<div class="bs-example">
    <div id="partialPayment" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>cash/partial' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Partial Payment</h4>
					</div>
					
					<div class="modal-body">
						<input type="text" id="parpay_amount" name="parpay_amount" placeholder="Amount" style="width:350px"/> <br/>
						<input type="text" id="payid" name="payid" />
						<?php 
							$key = NULL;
							foreach ($category->result_array() as $key)
							{
								$cat[$key['paycatid']] = $key['catname'];
							}
							echo form_dropdown('category', $cat,'style="width:414px" class="form-control"'); 
						?>
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

<div class="bs-example">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>cash/transfer' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Transfer Payment</h4>
					</div>
					
					<div class="modal-body">
						<input type="text" id="payid" name="payid" hidden /> <br/>
						<?php 
							$key = NULL;
							foreach ($category->result_array() as $key)
							{
								$cat[$key['paycatid']] = $key['catname'];
							}
							echo form_dropdown('category', $cat,'style="width:414px" class="form-control"'); 
						?>
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

<div class="bs-example">
    <div id="myModal2" class="modal fade">
        <div class="modal-dialog">
			<form name='search' action='<?php echo base_url()?>cash/unverify/<?php echo $lols["payid"]; ?>' method='post'>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Unverify Payment</h4>
					</div>
					
					<div class="modal-body">
						
							<input name='remarks' type='text' value='<?php echo set_value('remarks'); ?>' style="width:92%; margin-left:10px;" placeholder="Remarks / Reason for Unverifying" />
							
							<div id="clear"></div> 
						
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

<div class="bs-example">
    <div id="myModal3" class="modal fade">
        <div class="modal-dialog">
			<form name='search' action='<?php echo base_url()?>cash/changepayor/<?php echo $lols['payid'] ?>' method='post'>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Change Name</h4>
					</div>
					
					<div class="modal-body">
						
							<input name='payor' type='text' value='<?php echo set_value('payor'); ?>' style="width:92%; margin-left:10px;" placeholder="Change Name of Payor" />
							
							<div id="clear"></div> 
						
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