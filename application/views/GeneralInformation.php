<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>


<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<script type="text/javascript">
		function searchaddress()
		{
			var mystring = $('#searchadd').val();
			$("#dataTable tr").remove();
			$("#dataTable thead").remove();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>home/getalladdress/"+mystring, 
				success: function(data) 
				{
					$('<thead>').html("<th style='width:35px'>Zip</th><th style='width:35px'>Municipal</th><th style='width:35px'>City</th><th>Province</th><th>Region</th><th></th>").appendTo('#dataTable');
						
						$.each(data.alladdress,function(code,batch)
						{
						$('<tr>').html("<td style='padding:5px 10px 5px 10px' id='code"+ code +"'>" + batch.code + "</td><td style='padding:5px 10px 5px 10px' id='mun"+ code +"'>" + batch.municipal + "</td><td style='padding:5px 10px 5px 10px'>" + batch.city + "</td><td style='padding:5px 10px 5px 10px'>" + batch.province + "</td><td style='padding:5px 10px 5px 10px' id='region"+ code +"'>" + batch.region + "</td><td style='padding:5px 10px 5px 10px'><a class='lols' data-id='' data-dismiss='modal' onclick='addtoinput("+ code +")'>Select</a></td>").appendTo('#dataTable');
						});
				},
			});
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){     
			
			$("#searchadd").keyup(function(event){
				if(event.keyCode == 13){
					searchaddress();
				}
			});
		});
		// ]]>
	</script>
	<script>
		function addtoinput(zipcode)
		{
			$("#town option").remove();
			zip = $("#code" + zipcode).text();
			mun = $("#mun" + zipcode).text();
			region = $("#region" + zipcode).text();
			
			var opt = jQuery('<option />'); 
			opt.val(zipcode);
			opt.text(mun);
			jQuery('#town').append(opt); 
			
			$("#zip").val(zip);
			$("#region").val(region);
		}
	</script>
	
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p style="margin-bottom: 0px; padding:0px;">Home > Edit Information <a href='<?php echo base_url()?>trainee/enroll/<?php echo $row['trid']?>'><button style="float:right; color:#000" type="button">Enroll</button></a></p></div>
				<form name='search' action='<?php echo base_url()?>trainee/update' method='post'>
					<div class="row">
						<div class="col-sm-12">
						
						<?php  echo $this->session->flashdata('message'); ?>
						<?php echo validation_errors();?>
							<div class="txtcontainer" style="width:100%;">
								<?php 
									$url = "photos/".$row['trid'].".jpg";
									#echo $url;
									if (file_exists($url)) { ?>
										<img src="<?php echo base_url()?>photos/<?php echo $row['trid']?>.jpg" style="width:140px;" />
									<?php } else { 
										if ($row['sex'] == "F") {?>
										
										<img src="<?php echo base_url()?>photos/female.jpg" style="width:105px; margin:5px auto;text-align:center; display:block;" />
									<?php } else { ?>
										<img src="<?php echo base_url()?>photos/male.png" style="width:105px; margin:5px auto;text-align:center; display:block;" />
									<?php 
									}
									} ?>
							</div>
							<div class="txtcontainer" style="width:100%;">
								<div class="anchortext">Trainee ID: </div>
								<div class="placeholdertb" style="float:left;"><?php echo form_input('trid', $row['trid'],'readonly') ?></div>
							</div>
							<div class="txtcontainer"><div class="anchortext">Last Name: </div><div class="placeholdertb"><?php echo form_input('lname', $row['lname']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">First Name: </div><div class="placeholdertb"><?php echo form_input('fname', $row['fname']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Middle Name: </div><div class="placeholdertb"><?php echo form_input('mname', $row['mname']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Suffix: </div><div class="placeholdertb"><?php echo form_input('suffix', $row['suffix']) ?></div></div>
							<div class="txtcontainer">
								<div class="anchortext">
									Sex:
								</div>
								<div class="placeholdertb">
									<?php $sex['M'] = 'Male';
									$sex['F'] = 'Female';
									$sex['#'] = 'Please Select';
									echo form_dropdown('sex', $sex, $row['sex'], 'id="sex" style="width: 170px;"'); ?>
							</div></div>
							<div class="txtcontainer">
								<div class="anchortext">
									Civil Status:
								</div>
								<div class="placeholdertb">
									<?php 
									foreach ($civstat as $key)
										{
											$civ[$key['civstatid']] = $key['civstat'];
										}
										
										$currentciv = ($row["civstatid"] == NULL ? "6" : $row["civstatid"]);
									echo form_dropdown('civilstat', $civ, $currentciv, 'id="civstat" style="width: 170px;"'); ?>
							</div></div>

							<div class="txtcontainer">
								<div class="anchortext">
									Religion
								</div>
								<div class="placeholdertb">
									<?php
									foreach ($religion as $key)
										{
											$rel[$key['relid']] = $key['religion'];
										}
										
										#$rel["#"] == "Please Select";
										$currentrel = ($row["relid"] == NULL ? "17" : $row["relid"]);
									echo form_dropdown('religion', $rel, $currentrel, 'id="religion" style="width: 170px;"'); ?>

							</div></div>
							<div class="txtcontainer"><div class="anchortext">Birth Date: </div><div class="placeholdertb"><input name="bdate" type="date" value="<?php echo $row["bdate"] ?>" /></div></div>
							<div class="txtcontainer"><div class="anchortext">Birth Place: </div><div class="placeholdertb"><?php echo form_input('bplace', $row['bplace']) ?></div></div>
							<div class="txtcontainer">
									<div class="anchortext">
										Citizenship: 
									</div>
								<div class="placeholdertb">
									<?php 
									foreach($citizenship->result_array() as $citz)
									{
										$cit[$citz["citid"]] = $citz["citizen"];
									}
									$currentcit = ($row["citid"] == NULL ? "1" : $row["citid"]);
									echo form_dropdown('citizenship', $cit, $currentcit,'id="citizenship" required style="width: 170px;"'); ?>
							</div></div>
							<div class="txtcontainer"><div class="anchortext">Mobile Number: </div><div class="placeholdertb"><?php echo form_input('mobile', $row['mobile']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Landline: </div><div class="placeholdertb"><?php echo form_input('landline', $row['landline']) ?></div></div>
							<div class="spacer"><div class="anchortext">Address: </div><div class="placeholdertb"><?php echo form_input('address', $row['address'],'style = "width:760px"') ?> &nbsp;<button type="button"><a href="#myModal" data-toggle="modal" data-id="">Search</a></button></div></div>
							<div class="txtcontainer"><div class="anchortext">Region: </div><div class="placeholdertb"><?php echo form_input('region', $row['region'],'id = "region"') ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Postal Code </div><div class="placeholdertb"><?php echo form_input('zip', $row['zip'],'id = "zip"') ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Email Add: </div><div class="placeholdertb"><?php echo form_input('eadd', $row['eadd'],'id = eadd') ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Municipality: </div><div class="placeholdertb">
							<select id="town" style="width: 450px;" name="town" >
								<option value='<?php echo $row['locid'] ?>'><?php echo $row['municipal'] ?></option>
							</select></div></div>
							
							<div class="spacer">
								<div class="anchortext">
									Course: 
								</div>
								<div class="placeholdertb"><?php 
									foreach ($courses as $key)
										{
											$course[$key['courseid']] = $key['course'];
										}
										
										$currentcourse = ($row["courseid"] == NULL || $row["courseid"] == 0 ? "11" : $row["courseid"]);
							echo form_dropdown('course', $course, $currentcourse, 'id="course" style="width: 774px;"'); ?>
							</div></div>
							
							<div class="spacer">
								<div class="anchortext">
									School: 
								</div>
								<div class="placeholdertb">
									<?php 
									foreach ($schools as $key)
										{
											$school[$key['schoolid']] = $key['school']. " - " . $key['address'];
										}
										
										$school["#"] = "Please Select";
										$currentschool = ($row["schoolid"] == NULL || $row["schoolid"] == 0 ? "#" : $row["schoolid"]);
							echo form_dropdown('school', $school, $currentschool, 'id="school" style="width: 774px;"'); ?>
							</div></div>
							
							<div class="spacer"><p>Contact Person In Case of Emergency</p></div>
							<div class="txtcontainer"><div class="anchortext">Name: </div><div class="placeholdertb"><?php echo form_input('emname', $row['emname']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Address: </div><div class="placeholdertb"><?php echo form_input('emaddr', $row['emaddr']) ?></div></div>
							<div class="txtcontainer"><div class="anchortext">Phone: </div><div class="placeholdertb"><?php echo form_input('emphone', $row['emphone']) ?></div></div><br>
							<div class="clear"></div>
						</div>
					</div>
				<div class="row"><br>
					<div class="col-sm-3 col-md-2">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="bs-example">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Address</h4>
				</div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<input type="text" class="form-control" id="searchadd" name="searchadd" style="width:300px; float:left;"/>
							<button type="button" onclick="searchaddress()" style="margin-left: 20px;">Search</button>
						</div>
					</div>
					<div class="col-sm-12" style="text-align:center">
						<table id="dataTable" style="width:100%; margin-top:10px;">
						</table>
					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
        </div>
    </div>
</div> 


</body>
</html>