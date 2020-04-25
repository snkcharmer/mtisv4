<?php 
#--------------------Users for Cash
if ($this->session->userdata("user_level") == 3 or $this->session->userdata("user_level") == 4) { ?>
	<div id='cssmenu' class='midShadow'>
		<ul>
			<li class='has-sub'><a href='<?php echo base_url()?>cash/index'>Payments</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/index'>Daily Payments</a></li>
					<li><a href='<?php echo base_url()?>cash/payment/search'>Search Payments</a></li>
					<li><a href='<?php echo base_url()?>cash/owwa'>OWWA</a></li>
					<?php /*<li><a href='<?php echo base_url()?>cash/allpayments'>All Payments</a></li>
					<?php /*<li><a href='<?php echo base_url()?>cash/ornum'>Add OR No.</a></li> 
					<li><a href='<?php echo base_url()?>cash/advancedsearch'>Advanced Search</a></li>
					<li><a href='<?php echo base_url()?>cash/misc'>Other Payments</a></li>*/ ?>
					<li><a href='<?php echo base_url()?>home/logoff'>Logout</a></li>
				</ul>
			</li>
			<li><a href='<?php echo base_url()?>cash/addpayment1'>Add Payment</a></li>
			<li class='has-sub'><a href='#'>Control No.</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/controlno/search'>Search</a></li>
					<li><a href='<?php echo base_url()?>cash/controlno/add'>Add</a></li>
				</ul>
			</li>
			<li class='has-sub'><a href='#'>Reports</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/reports/select'>Reports</a></li>
					<li class='has-sub'><a href='#'>Options</a>
						<ul>
							<li><a href='<?php echo base_url()?>cash/reports/options/lcca'>LCCA</a></li>
							<li><a href='<?php echo base_url()?>cash/reports/options/regularfunds'>Regular Funds</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php if ($this->session->userdata("user_level") == 4) { ?>
			<li><a href='<?php echo base_url()?>cash/feesdiscount'>Fees/Discount</a></li>
			<li class='has-sub'><a href='#'>OR No.</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/ornum/search'>Search</a></li>
					<li><a href='<?php echo base_url()?>cash/ornum/add'>Add</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</div>
<?php }
else #-----------------For userlevel 1 and 2, users for Registration of MTIS
{
	?>
	<div id='cssmenu' class='midShadow'>
		<ul style="float:left">
			<li class='has-sub'><a href='<?php echo base_url()?>home/searchtrainee'>Menu</a>
				<ul>
					<li><a href='<?php echo base_url()?>trainee/newtrainee'>Register</a></li>
					<li><a href='<?php echo base_url()?>schedule'>Schedule</a></li>
					<li><a href='<?php echo base_url()?>nea/announcement'>Announcement</a></li>
					<li><a href='<?php echo base_url()?>nea/cert_template'>Certificate Template</a></li>
					<li><a href='<?php echo base_url()?>nea/errorcertificate'>Error Certificate number</a></li>
					<!--li><a href='<?php// echo base_url()?>nea/reissuance'>Reissuance</a></li-->
					<li><a href='<?php echo base_url()?>home/logoff'>Logout</a></li>
				</ul>
			</li>	
			<li class='has-sub'><a href='#'>Administration</a>
				<ul>
					<li class='has-sub'><a href='<?php echo base_url()?>modules/search'>Modules</a>
						<ul>
						   <li><a href='<?php echo base_url()?>modules/add'>Add Modules</a></li>
						   <li><a href='<?php echo base_url()?>modules/search'>Search Module</a></li>
						</ul>
					</li>
					<li class='has-sub'><a href='<?php echo base_url()?>submodules/search'>Sub Module</a>
						<ul>
						   <li><a href='<?php echo base_url()?>submodules/add'>Add Submodules</a></li>
						   <li><a href='<?php echo base_url()?>submodules/search'>Search Submodule</a></li>
						</ul>
					</li>
					<li><a href='<?php echo base_url()?>cash/feesdiscount' target="_blank">Training Fee's</a></li>
					<li><a href='<?php echo base_url()?>home/course' target="_blank">Courses</a></li>
					<li><a href='<?php echo base_url()?>home/license' target="_blank">Licenses</a></li>
					<li><a href='<?php echo base_url()?>home/rank' target="_blank">Ranks</a></li>
					<li><a href='<?php echo base_url()?>home/position' target="_blank">Positions</a></li>
					<li><a href='<?php echo base_url()?>home/employer' target="_blank">Employer</a></li>
					<li><a href='<?php echo base_url()?>home/school' target="_blank">School</a></li>
					<li><a href='<?php echo base_url()?>home/sponsor' target="_blank">Sponsor</a></li>
					<li><a href='<?php echo base_url()?>home/trainer' target="_blank">Trainers</a></li>
					<?php if ($this->session->userdata("user_level") == 1) { ?>
						<li><a href='<?php echo base_url()?>home/addusers' target="_blank">Add Users</a></li>
					<?php } ?>
				</ul>
			</li>
			<li class='has-sub'><a href='<?php echo base_url()?>cash/index'>Payments</a>
				<ul>
					<li><a href='<?php echo base_url()?>cash/index'>Daily Payments</a></li>
					<li><a href='<?php echo base_url()?>cash/allpayments'>Search</a></li>
				</ul>
			</li>
			<?php if ($this->session->userdata("user_level") == 1) { ?>
				<li><a href='<?php echo base_url()?>home/options'>Options</a></li>
			<?php } ?>
		</ul>
		<ul style="float:right; color:#fff; margin:16px 5px 0 0">
			<li>Logged In as [<?php echo $this->session->userdata("username") ?>]</li>
		</ul>
	</div>
<?php } ?>