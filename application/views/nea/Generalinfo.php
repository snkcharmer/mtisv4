<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>


<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>
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
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p style="margin-bottom: 0px; padding:0px;">Home > Edit Information
				<?php if($row['trid'] != '0'){?>	
				<a href='<?php echo base_url()?>nea/enroll_module/<?php echo $this->session->userdata('nid')?>'><button style="float:right; color:#000" type="button">Enroll</button></a></p>
				<?php } ?>
				</div>
				<form name='search' action='<?php echo base_url()?>nea/update' method='post'>
					
					<input type="hidden" name="idnum" value="<?php echo $this->session->userdata('nid');?>">
					<div class="row">
						<div class="col-sm-12">
						
						<?php  echo $this->session->flashdata('message'); ?>
						<?php echo validation_errors();?>
							<div class="txtcontainer" style="width:100%;">
								<?php 
									if($row['trid'] == '0'){
										$url = "photos/".$row['id_'].".jpg";
									}else{
										$url = "photos/".$row['trid'].".jpg";
									}
									#echo $url;
									if (file_exists($url)) { ?>
										<?php
										if($row['trid'] == '0'){
										?>
										<img src="<?php echo base_url()?>photos/<?php echo $row['id_']?>.jpg" style="width:140px;" />
										<?php
										}else{
										?>
										<img src="<?php echo base_url()?>photos/<?php echo $row['trid']?>.jpg" style="width:140px;" />
										<?php
										}
										?>
										
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
								<div class="placeholdertb" style="float:left;">
									<input type="text" name="trid" value="<?php if($row['trid'] == '0'){echo $row['trid'];}else{echo $row['trid'];}?>" readonly>
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Last Name: </div>
								<div class="placeholdertb">
									<input type="text" name="lname" value="<?php if($row['trid'] == '0'){echo $row['lname'];}else{echo $row['lname'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">First Name: </div>
								<div class="placeholdertb">
									<input type="text" name="fname" value="<?php if($row['trid'] == '0'){echo $row['fname'];}else{echo $row['fname'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Middle Name: </div>
								<div class="placeholdertb">
									<input type="text" name="mname" value="<?php if($row['trid'] == '0'){echo $row['mname'];}else{echo $row['mname'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Suffix: </div>
								<div class="placeholdertb">
									<input type="text" name="suffix" value="<?php if($row['trid'] == '0'){echo $row['suffix'];}else{echo $row['suffix'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Sex: </div>
								<div class="placeholdertb">
									<select name="sex" id="sex" style="width: 170px;">

										<option value="#">Please Select</option>
										<option value="M" <?php if($row['trid'] == '0'){if($row['sex']== 'M'){echo "selected";}}else{if($row['sex']== 'M'){echo "selected";}}?>>Male</option>
										<option value="F" <?php if($row['trid'] == '0'){if($row['sex']== 'F'){echo "selected";}}else{if($row['sex']== 'F'){echo "selected";}}?>>Female</option>
									</select>
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Status: </div>
								<div class="placeholdertb">
									<select name="civilstat" id="civilstat" style="width: 170px;">
										<?php 
										foreach ($civstat as $key)
										{ ?>
											<option value="<?php echo $key['civstatid']?>" <?php if($row['trid'] == '0'){if($row['civstatid']== $key['civstatid']){echo "selected";}}else{if($row['civstatid']== $key['civstatid']){echo "selected";}} ?>><?php echo $key['civstat']?></option>
										<?php
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Birth Date: </div>
								<div class="placeholdertb">
									<input type="date" name="bdate" value="<?php if($row['trid'] == '0'){echo $row['bdate'];}else{echo $row['bdate'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Birth Place: </div>
								<div class="placeholdertb">
									<input type="text" name="bplace" value="<?php if($row['trid'] == '0'){echo $row['bplace'];}else{echo $row['bplace'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Citizenship: </div>
								<div class="placeholdertb">
									<input type="text" value="<?php if($row['trid'] == '0'){echo $row['citizenship'];}else{echo "Filipino";}?>" />
									<input name="citizenship" id="citizenship" type="hidden" value="1" />
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Mobile Number: </div>
								<div class="placeholdertb">
									<input type="text" name="mobile" value="<?php if($row['trid'] == '0'){echo $row['mobilenum'];}else{echo $row['mobile'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Landline: </div>
								<div class="placeholdertb">
									<input type="text" name="landline" value="<?php if($row['trid'] == '0'){echo $row['landline'];}else{echo $row['landline'];}?>">
								</div>
							</div>
							<div class="spacer">
								<div class="anchortext">Address: </div>
								<div class="placeholdertb">
									<input type="text" name="address" value="<?php if($row['trid'] == '0'){echo $row['address'];}else{echo $row['address'];}?>" style = "width:760px">
									&nbsp;<button type="button"><a href="#myModal" data-toggle="modal" data-id="">Search</a></button>
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Region: </div>
								<div class="placeholdertb">
									<input type="text" name="region" value="<?php if($row['trid'] == '0'){echo $row['region'];}else{echo $row['region'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Postal Code: </div>
								<div class="placeholdertb">
									<input type="text" name="zip" id= "zip" value="<?php if($row['trid'] == '0'){echo $row['pcode'];}else{echo $row['pcode'];}?>">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Email Add: </div>
								<div class="placeholdertb">
									<input type="text" name="eadd" value="<?php if($row['trid'] == '0'){echo $row['emailadd'];}else{echo $row['eadd'];}?>" style = "width:450px">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Municipality: </div>
								<div class="placeholdertb">
									<select id="town" style="width: 450px;" name="town" >
										<option value='<?php if($row['trid'] == '0'){echo $row['mcid'];}else{echo $row['locid_'];}?>'><?php if($row['trid'] == '0'){ echo $row['municipal'];}else{echo $row['municipal'];} ?></option>
									</select>
								</div>
							</div>
							<div class="spacer">
								<div class="anchortext">Course: </div>
								<div class="placeholdertb">
									<select name="course" id="course"  style="width: 774px;">
										<?php 
										foreach ($courses as $key)
										{ ?>
											<option value="<?php echo $key['courseid']?>" <?php if($row['trid'] == '0'){if($row['courseid']== $key['courseid']){echo "selected";}}else{if($row['courseid']== $key['courseid']){echo "selected";}} ?>><?php echo $key['course']?></option>
										<?php
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="spacer">
								<div class="anchortext">School: </div>
								<div class="placeholdertb">
									<select name="school" id="school"  style="width: 774px;">
										<?php 
										foreach ($schools as $key)
										{ ?>
											<option value="<?php echo $key['schoolid']?>" <?php if($row['trid'] == '0'){if($row['schoolid']== $key['schoolid']){echo "selected";}}else{if($row['schoolid']== $key['schoolid']){echo "selected";}} ?>><?php echo $key['school']. " - " . $key['address'];?></option>
										<?php
										}
										?>
										
									</select>
								</div>
							</div>
							<div class="spacer"><p>Contact Person In Case of Emergency</p></div>
							<div class="txtcontainer">
								<div class="anchortext">Name: </div>
								<div class="placeholdertb">
									<input type="text" name="emname" value="<?php if($row['trid'] == '0'){echo $row['efullname'];}else{echo $row['emname'];}?>" >
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Relationship: </div>
								<div class="placeholdertb">
									<input type="text" name="emrel" value="<?php if($row['trid'] == '0'){echo $row['relationship'];}else{echo $row['emrelation'];}?>" >
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Address: </div>
								<div class="placeholdertb">
									<input type="text" name="emaddr" value="<?php if($row['trid'] == '0'){echo $row['ecomaddress'];}else{echo $row['emaddr'];}?>" style = "width:450px">
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Phone: </div>
								<div class="placeholdertb">
									<input type="text" name="emphone" value="<?php if($row['trid'] == '0'){echo $row['emobilenum'];}else{echo $row['emphone'];}?>" >
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Landline: </div>
								<div class="placeholdertb">
									<input type="text" name="emlandline" value="<?php if($row['trid'] == '0'){echo $row['elandline'];}else{echo $row['emlandline'];}?>" >
								</div>
							</div>
							<div class="txtcontainer">
								<div class="anchortext">Email address: </div>
								<div class="placeholdertb">
									<input type="text" name="emeadd" value="<?php if($row['trid'] == '0'){echo $row['eemailadd'];}else{echo $row['ememailadd'];}?>" >
								</div>
							</div>

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