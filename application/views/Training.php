
<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>


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
						
						$('<thead>').html("<th>Code</th><th style='width:35px'>Batch</th><th style='width:35px'>Max</th><th style='width:35px'>Size</th><th>Start</th><th>End</th><th>Venue</th><th></th>").appendTo('#dataTable');
						
						$.each(data.module_details,function(code,batch)
						{
						$('<tr>').html("<td>" + code + "</td><td>" + batch.batch + "</td><td>" + batch.max + "</td><td>" + batch.size + "</td><td>" + batch.start + "</td><td>" + batch.end + "</td><td>" + batch.venue + "</td><td><a class='lols' href='#myModal' data-toggle='modal' data-id='"+ code +"*"+ batch.paycatid+"'>Add to Cart</a></td>").appendTo('#dataTable');
						});
						
						//alert($("#generalinfo").height());
						$("#generalinfo").animate({
							height:$("#checkheight").height() + 150
						},600);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert(XMLHttpRequest);
					}
				});
			});
		});
	</script>
	<script>
		$(document).on("click", ".lols", function () {
			 var myBookId = $(this).data('id');
			 $(".modal-body #codeid").val( myBookId );
		});
	</script>
	<div id="mid">
		
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
				<p style="margin-bottom: 0px;">Trainee > Select Training | Select:
					<?php $module['#'] = 'Please Select'; ?>
					<?php echo form_dropdown('module_id', $module, '#', 'id="module" style="font-size: 14px"'); ?>
						| <a href="<?php echo base_url()?>trainee/proceedenroll/backtrack">Backtrack</a>
						<?php
							$ca = $this->session->userdata("cartitems");
							$ca_2 = ($ca == 0 ? array() : $ca);
							//echo "asd" - $ca;
							if(count($ca_2) > 0) { ?>
						| <a href='#myModal2' data-toggle='modal' data-id=''>Add Payments</a>
						<?php } ?>
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
						
						<div style="float:left; width:55%" class="tablenopadding resizable">
							<table id="dataTable" cellspacing="0" style="width:100%; margin:0 0 5px 5px;">
							</table>
						</div>
					</div>
					
					
					<div></div>
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
						'class' => 'btn btn-primary',
						'value' => 'Confirm Enrollment',
						'onClick' => "this.form.submit(); this.disabled=true; this.value='Sending…';",
						'style' => 'margin-top: 5px;padding:5px;',
						);
						echo form_submit($data);
					?>
					<a href='<?php echo base_url()?>trainee/enroll/<?php echo $this->session->userdata('trid'); ?>'>
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
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
			<form action='<?php echo base_url()?>trainee/addcart' method="post">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Sponsor</h4>
					</div>
					
					<div class="modal-body">
						<input type="text" class="form-control" id="codeid" name="code"/> <br/>
						<?php 
							$key = NULL;
							foreach ($sponsors->result_array() as $key)
							{
								$sponsor[$key['sponid']] = $key['sptypename'];
							}

						echo form_dropdown('sponsor', $sponsor, 1, 'class="form-control" style="width:100%; margin-top:5px;"'); ?>
						
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
			<form action='<?php echo base_url()?>trainee/addotherfee' method="post">
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