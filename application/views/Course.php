<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p>Option > Courses</p></div>
				
				<div style="float:left; width:30%;">
					<?php  echo $this->session->flashdata('message'); ?>
					<?php echo validation_errors();?>
					<form name='search' action='<?php echo base_url()?>home/savecourse' method='post'>
						<div class="txtcontainer">
							<div class="anchortext">Course Name:</div>
							<div class="placeholdertb">
								<input name='course' type='text' value='<?php echo set_value('course'); ?>' required /></div>
						</div>
						<div id="clear"></div>
						<div style="margin-top: 10px;">
							<input type="submit" class="fadein" style="height:40px;width:200px;float:left; font-size:25px;margin-left: 10px" value="Save"/>
						</div>
					</div>
				</form>
				
				<div style="float:left; margin-left: 10px; overflow: hidden; width: 60%">
				
					<table cellspacing="0" cellpadding="0" style="width: 100%">
						<thead>
							<th width="85%">Course Name</th>
							<?php if($this->session->userdata("user_level") == 1){ ?>
								<th></th>
							<?php } ?>
							
						</thead>
						<?php foreach ($records as $rows) {?>
						<tr>
							<td style="text-align:left;"><label><?php echo $rows['course']?></label></td>
							<?php if($this->session->userdata("user_level") == 1){ ?>
							<td>
								<a href='<?php echo site_url('home/'); ?>/deletecourse/<?php echo $rows['courseid'];?>' onclick="return confirm('Are you sure you want to Delete?');">Delete</a>
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