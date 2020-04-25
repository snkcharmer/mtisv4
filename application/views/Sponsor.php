<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p>Option > Sponsor</p></div>
				<div style="float:left; width:30%;">
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<form name='search' action='<?php echo base_url()?>home/savesponsor' method='post'>
						<div class="txtcontainer">
							<div class="anchortext">Sponsor:</div>
							<div class="placeholdertb">
								<input name='sponsor' type='text' value='<?php echo set_value('sponsor'); ?>' required />
							</div>
							<br />
							<div class="anchortext">Sponsor Short:</div>
							<div class="placeholdertb">
								<input name='sponshort' type='text' value='<?php echo set_value('sponshort'); ?>' required />
							</div>
						</div>	
						<div id="clear"></div>
						<div style="margin-top: 10px;"><input type="submit" class="fadein" style="height:40px;width:200px;float:left; font-size:25px;margin-left: 10px" value="Save"/></div>
					</form>
				</div>
				
				<div style="float:left; margin-left: 10px; width: 65%">
				
				<table cellspacing="0" cellpadding="0" style="width: 100%">
					<thead>
						<th style="width: 45%">Sponsor</th>
						<th>Sponsor Short</th>
						<?php if ($this->session->userdata('user_level') == 99){ ?>
						<th style="width: 50px;"></th>
						<?php } ?>
					</thead>
					<?php foreach ($records as $rows) {?>
					<tr>
						<td style="text-align:left;"><label><?php echo $rows['sptypename']?></label></td>
						<td><?php echo $rows['sptypeshort']?></td>
						<?php if ($this->session->userdata('user_level') == 99){ ?>
						<td>
							<a href='<?php echo site_url('home/'); ?>/deletesponsor/<?php echo $rows['sponid'];?>' onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
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