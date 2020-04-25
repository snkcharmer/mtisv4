<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script type="text/javascript">
		$(document).ready(function(){    
			
			$('#zip').keydown(function(){ 
				$("#region > option").remove();
				var module_id = $('#zip').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getaddress/"+module_id, 
					success: function(data) 
					{
						$.each(data,function(max,fee) 
						{
							$("#region").val(fee.region);
							//$("#town").val(fee.municipality);
							var opt = jQuery('<option selected="selected" />'); 
							  opt.val(fee.idnum);
							  opt.text(fee.municipal);
							  jQuery('#town').append(opt); 
						});
					}
				});
				 
			});
			
			$('#region').change(function(){
				document.getElementById('town').options.length = 0;
				var catid = $('#region').val();
				//alert(catid);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/gettown/"+catid, 
					success: function(data) 
					{
						//$("#town").text(JSON.stringify(data));
						var opt = jQuery('<option />'); 
						opt.val('#');
						opt.text('Please Select');
						jQuery('#town').append(opt); 
						//alert(data);
						$.each(data.region, function() {
							var opt = jQuery('<option />'); 
							  opt.val(this.idnum);
							  opt.text(this.municipal);
							  jQuery('#town').append(opt); 
						});
					}
				});
			});
			
			$('#town').change(function(){
				//document.getElementById('town').options.length = 0;
				var town = $('#town').val();
				//alert(town);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getzip/"+town, 
					success: function(data) 
					{
						//alert(JSON.stringify(data));
						$("#zip").val(data.zip.code.code);
					}
				});
			});
			
			$('#school').mouseenter(function(){
				
				var school = $('#school').val();
				if (school == '#'){
					document.getElementById('school').options.length = 0;
				}
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getschooljson/", 
					success: function(data) 
					{
						var opt = jQuery('<option />'); 
						opt.val('#');
						opt.text('Please Select');
						jQuery('#school').append(opt); 
						$.each(data.school, function() {
							var opt = jQuery('<option />'); 
							  opt.val(this.idnum);
							  opt.text(this.school);
							  jQuery('#school').append(opt); 
						});
					}
				});
			});
			
			$('#courses').mouseenter(function(){
				var course = $('#courses').val();
				if (course == '#'){
					document.getElementById('courses').options.length = 0;
				}
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getcoursejson/", 
					success: function(data) 
					{
						//alert(JSON.stringify(data));
						//$("#zip").val(data.zip.code.code);
						
						var opt = jQuery('<option />'); 
						opt.val('#');
						opt.text('Please Select');
						jQuery('#courses').append(opt); 
						$.each(data.course, function() {
							var opt = jQuery('<option />'); 
							  opt.val(this.idnum);
							  opt.text(this.course);
							  jQuery('#courses').append(opt); 
						});
					}
				});
			});

			
		});
		// ]]>
	</script>
	<script>
		
	</script>
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Home > Register</p></div>
			<form name='search' action='<?php echo base_url()?>trainee/addtrainee' method='post'>
			<?php  echo $this->session->flashdata('message'); ?>
			<?php echo validation_errors();?>
					<div class="txtcontainer"><div class="anchortext">Last Name: </div>
					<div class="placeholdertb">
						<input name='lname' type='text' value='<?php echo set_value('lname'); ?>' required />
					</div>
					</div>
					<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><input name='fname' type='text' value='<?php echo set_value('fname'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">Middle Name: </div><div class="placeholdertb"><input name='mname' type='text' value='<?php echo set_value('mname'); ?>' /></div></div>
					<div class="txtcontainer"><div class="anchortext">Suffix: </div><div class="placeholdertb"><input name='suffix' type='text' value='<?php echo set_value('suffix'); ?>'  /></div></div>
					
					<div class="txtcontainer">
						<div class="anchortext">
							Sex:
						</div>
						<div class="placeholdertb">
							<?php 
							$sex['M'] = 'Male';
							$sex['F'] = 'Female';
							$sex['#'] = 'Please Select'; 
							echo form_dropdown('sex', $sex, '#', 'id="sex" style="width: 185px;"'); ?>
					</div></div>
					<div class="txtcontainer">
						<div class="anchortext">
							Civil Status:
						</div>
						<div class="placeholdertb">
						<?php
							#$civ['#'] = "Please Select";
							foreach ($civstat as $key)
								{
									$civ[$key['civstatid']] = $key['civstat'];
								}
								
							echo form_dropdown('civilstat', $civ, "6", 'id="civstat" style="width: 185px;"'); 
							#echo form_dropdown('sex', $sex, $row['sex'], 'id="sex"');?>
					</div></div>

					<div class="txtcontainer">
						<div class="anchortext">
							Religion
						</div>
						<div class="placeholdertb">
							<?php 
							#$rel['#'] = "Please Select";
							foreach ($religion as $key)
								{
									$rel[$key['relid']] = $key['religion'];
								}
								
							echo form_dropdown('religion', $rel, "17", 'id="religion" style="width: 185px;"'); ?>
					</div></div>
					<div class="txtcontainer"><div class="anchortext">Birth Date: </div><div class="placeholdertb"><input name="bdate" type="date" value="<?php echo set_value('bdate'); ?>" /></div></div>
					<div class="txtcontainer"><div class="anchortext">Birth Place: </div><div class="placeholdertb"><input name='bplace' type='text' value='<?php echo set_value('bplace'); ?>' required /></div></div>
					<div class="txtcontainer">
							<div class="anchortext">
								Citizenship: 
							</div>
						<div class="placeholdertb">
							<?php
							#$cit['#'] = "Please Select";
							foreach($citizenship->result_array() as $citz)
							{
								$cit[$citz["citid"]] = $citz["citizen"];
							}

							echo form_dropdown('citizenship', $cit, "1",'id="citizenship" required style="width: 185px;"');
							?>
					</div></div>
					<div class="txtcontainer"><div class="anchortext">Mobile Number: </div><div class="placeholdertb"><input name='mobile' type='text' value='<?php echo set_value('mobile'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">Landline: </div><div class="placeholdertb"><input name='landline' type='text' value='<?php echo set_value('landline'); ?>' required /></div></div>
					<div class="spacer"><div class="anchortext">Address: </div><div class="placeholdertb"><input name='address' type='text' value='<?php echo set_value('address'); ?>' required style="width: 760px" /></div></div>
					<div class="txtcontainer"><div class="anchortext">Postal Code </div><div class="placeholdertb"><input name='zip' type='text' value='<?php echo set_value('zip'); ?>' required id="zip" /></div></div>
					<div class="txtcontainer"><div class="anchortext">Region: </div><div class="placeholdertb"><input name='region' type='text' value='<?php echo set_value('region'); ?>' required id="region" /></div></div>
					<div class="txtcontainer"><div class="anchortext">Email Add: </div><div class="placeholdertb"><input name='eadd' type='text' value='<?php echo set_value('eadd'); ?>' required id="eadd"/></div></div>
					<div class="txtcontainer"><div class="anchortext">Municipality: </div><div class="placeholdertb">
					<select id="town" style="width: 450px;" name="town">
					<?php 
					if ($town) 
					{ ?>
						<option value='<?php $town['idnum']?>'><?php $town['municipal']?></option>
					<?php } ?>
					</select> <a href="" target="_blank"> Add Address Code.. </a>
					</div></div>
					
					<div class="spacer">
						<div class="anchortext">
							Course: 
						</div>
						<div class="placeholdertb">
							<select id="courses" style="width: 450px;" name="course">
							</select>
							<a href="<?php echo base_url()?>home/course" target="_blank"> Add Course..</a>
						</div>
					</div>
					
					<div class="spacer">
						<div class="anchortext">
							School: 
						</div>
						<div class="placeholdertb">
							<select id="school" style="width: 450px;" name="school">
							</select>
							<a href="<?php echo base_url()?>home/school" target="_blank"> Add School..</a>
						</div>
					</div> 
					

					<div class="spacer"><p>Contact Person In Case of Emergency</p></div>
					<div class="txtcontainer"><div class="anchortext">Name: </div><div class="placeholdertb"><input name='emname' type='text' value='<?php echo set_value('emname'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">Address: </div><div class="placeholdertb"><input name='emaddr' type='text' value='<?php echo set_value('emaddr'); ?>' required /></div></div>
					<div class="txtcontainer"><div class="anchortext">Phone: </div><div class="placeholdertb"><input name='emphone' type='text' value='<?php echo set_value('emphone'); ?>' required /></div></div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Save"/></div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>