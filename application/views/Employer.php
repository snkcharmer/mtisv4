<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p>Option > Employer</p></div>
				<div style="float:left; width:50%">
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<form name='search' action='<?php echo base_url()?>home/saveemployer' method='post'>
						<div class="txtcontainer">
							<div class="anchortext">Employer Name:</div>
								<div class="placeholdertb">
									<input name='employer' type='text' value='<?php echo set_value('employer'); ?>' style="width:350px" required />
								</div>
								<br />
							<div class="anchortext">Address 1:</div>
							<div class="placeholdertb">
								<input name='address1' type='text' value='<?php echo set_value('address1'); ?>' style="width:350px" required />
							</div>
							<br />
							<?php /*<div class="anchortext">Address 2:</div>
							<div class="placeholdertb">
								<input name='address2' type='text' value='<?php echo set_value('address2'); ?>' style="width:500px" required />
							</div>
							<br /> */?>
						</div>
						<?php /*
						<div class="spacer">
							<div class="anchortext">Contact No.:</div>
							<div class="placeholdertb">
								<input name='contactnum' type='text' value='<?php echo set_value('contactnum'); ?>' style="width:150px" required />
							</div>
						</div>
						
						<div class="spacer">
							<div class="anchortext">Contact Name.:</div>
							<div class="placeholdertb">
								<input name='contactname' type='text' value='<?php echo set_value('contactname'); ?>' style="width:150px" required />
							</div>
						</div> */ ?>
						
						<div id="clear"></div>
						
						<div style="margin-top: 10px;">
							<input type="submit" class="fadein" style="height:40px;width:200px;float:left; font-size:25px;margin-left: 10px" value="Save"/>
						</div>
					</form>
				</div>
				

				<div style="float:left; width:50%">

					<table cellspacing="0" cellpadding="0">
						<thead>
							<th style="width:300px;">Employer Name</th>
							<th style="width:300px;">Address</th>
							<?php if ($this->session->userdata('user_level') == 99){ ?>
							<th style="width:100;"></th>
							<?php } ?>
						</thead>
						<?php foreach ($records as $rows) {?>
						<tr>
							
							<td style="text-align:left;"><label><?php echo $rows['name']?></label></td>
							<td style="text-align:left;"><?php echo $rows['address1']?></td>
							<?php if ($this->session->userdata('user_level') == 99){ ?>
							<td>
								<a href='<?php echo site_url('home/'); ?>/deletelicense/<?php echo $rows['spcode'];?>' onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
							</td>
							<?php } ?>
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
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>