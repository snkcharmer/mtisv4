<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script type="text/javascript">
		$(document).ready(function(){     
						
			$('#zip').change(function(){ 
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
				document.getElementById('province').options.length = 0;
				document.getElementById('town').options.length = 0;
				var catid = $('#region').val();
				//alert(catid);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/getprovince/"+catid, 
					success: function(data) 
					{
						//$("#town").text(JSON.stringify(data));
						var opt = jQuery('<option />'); 
						opt.val('#');
						opt.text('Please Select');
						jQuery('#province').append(opt); 
						//alert(data);
						$.each(data.region, function() {
							var opt = jQuery('<option />'); 
							  opt.val(this.province);
							  opt.text(this.province);
							  jQuery('#province').append(opt); 
						});
					}
				});
			});
			
			$('#province').change(function(){
				document.getElementById('town').options.length = 0;
				var catid = encodeURIComponent($('#province').val());
				//alert(catid);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>home/gettown2/" + catid, 
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
							  opt.val(this.municipal);
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
		});
		// ]]>
	</script>
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header"><p>Search by Location </p></div>
				<?php  echo $this->session->flashdata('message'); ?>
				<?php echo validation_errors();?>
				<form name='search' action='<?php echo base_url()?>statistics/search/location' method='post' target="_blank">
					<div class="txtcontainer">
						<div class="anchortext">Module: </div>
						<div class="placeholdertb">
							<?php 
							foreach ($modcode as $key)
							{
								$mod[$key['modcode']] = $key['module'];
							}
							
							$mod['#'] = 'Please Select';
							echo form_dropdown('modcode', $mod, '#', 'id="modcode" style="width:450px"'); 
							?>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Region: </div>
						<div class="placeholdertb">
							<?php 
							foreach ($region as $key)
							{
								$reg[$key['lols']] = $key['lols'];
							}
							
							$reg['#'] = 'Please Select';
							echo form_dropdown('region', $reg, '#', 'id="region"'); 
							?>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Province: </div>
						<div class="placeholdertb">
							<select id="province" style="width: 450px;" name="province" >
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">Municipality: </div>
						<div class="placeholdertb">
							<select id="town" style="width: 450px;" name="town" >
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">From: </div>
						<div class="placeholdertb">
							<input name='from' type='date' style="width: 170px;" placeholder="Input Year" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">To: </div>
						<div class="placeholdertb">
							<input name='to' type='date' style="width: 170px;" placeholder="Input Year" />
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Search"/></div>
				</form>
				
				<div id="clear"></div> <?php //------------------------- Next Function -----------------?>
				
				<div id="generalinfo_header"><p>For PESO </p></div>
				<form name='search' action='<?php echo base_url()?>search/location' method='post'>
					<div class="txtcontainer">
						<div class="anchortext">Type: </div>
						<div class="placeholdertb">
							<?php 
							$training['0'] = 'Certificated';
							$training['1'] = 'Training';
							echo form_dropdown('mode', $training, '#', 'id="mode"'); 
							?>
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">From: </div>
						<div class="placeholdertb">
							<input name='from' type='date' style="width: 170px;" />
						</div>
					</div>
					<div class="spacer">
						<div class="anchortext">To: </div>
						<div class="placeholdertb">
							<input name='to' type='date' style="width: 170px;" />
						</div>
					</div>
					<div class="spacer floatright" style="margin-top: 10px;"><input class="fadein" type="submit" style="height:40px;width:200px;float:left; font-size:25px;" value="Search"/></div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>