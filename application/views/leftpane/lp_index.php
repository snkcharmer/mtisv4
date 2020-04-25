<div id="leftpane" class="midShadow">
	<div style="margin:10px auto; width: 95%; overflow:hidden;">

		<div class="search">
			<form name='search' action='<?php echo base_url()?>home/searchtrainee' method='post'>
				<div><input name='txtlname' type='text' style="width:90%" placeholder="Last Name" /></div>
				<div><input name='txtfname' type='text' style="width:90%;margin-top:3px;" placeholder="First Name" /></div>
				<div><input type='submit' class ='fadein' name='search' value='Submit' style="float:right;margin:10px 13px 0 0"/></div>
			</form>
		</div>

	</div>
	<div id="leftoption">
		<ul>
			<?php /* <li><a href="<?php echo base_url()?>trainee/newtrainee">Register</a></li> */ ?>
			<li><a href="<?php echo base_url()?>schedule">Schedules</a></li>
			<li><a href="<?php echo base_url()?>schedule/add">Add Schedule</a></li>
			<li><a href="http://10.10.80.10/reports">Reports</a></li>
			<li><a href="<?php echo base_url()?>home/lastenrolled">Last Enrolled</a></li>
			<li><a href="<?php echo base_url()?>home/changeyear">Current Year: <?php echo $this->session->userdata("currentyear"); ?></a></li>
			<li><a href="<?php echo base_url()?>List">Registered Trainee(MTERS)</a></li>
		</ul>
		
		
	</div>
	
	<div style="color:#fff">
		<img src="<?php echo base_url()?>images/nmplogo.png" style="width:90%; opacity: 0.8;"/><br>
		<font>Maritime Training Information System</font>
	</div>
</div>