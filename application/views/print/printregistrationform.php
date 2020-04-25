<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>MTIS - Print Grade</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="ICON" href="<?php echo base_url()?>images/NMP.ico" />
        <link href="<?php echo base_url()?>css/backend.css" rel="stylesheet" type="text/css" media="screen" />
        
        <script language="javascript">
			function displayMessage(printContent) 
			{
				var inf = printContent;
				win = window.open("", 'popup', 'toolbar = no, status = no');
				win.document.write(inf);
				win.window.innerWidth='1228';
				win.document.close(); // new line
			}
			
			function printMe(PrintBodyContainer) 
			{				
				var inf = PrintBodyContainer;
				win = window.open("", 'popup', 'toolbar = no, status = no');
				win.document.write(inf);
				win.window.innerWidth='1228';
				win.window.print();
			}
		</script>
		<style>
	@media print {
		footer {page-break-after: always;}
	}
		</style>
    </head>
    
    <body style="background:none;"> 
        <div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:8.5in; height:426px;">        	
        	
            
			<?php foreach($trainee->result_array() as $row){ ?>
			<div style="text-align:center; width:8.5in; margin:0 auto;">
            	<div style="border:1px #000000 solid; text-align:left; width:140px; padding:5px; margin-bottom:-60px; height:62px; margin-top:13px; font-size:12px;">
					NMP Form No. REG-02<br>
					Issue No. 01<br>
					Rev No. 01 March 4, 2010<br>
					Approved by : ED
				</div>
					<h2>Registration Form</h2>
            </div> 
			
            <div style="text-align:left; width:8.5in; margin:0 auto; margin-top:2px;">
                <table id="tblStyle" style="width:100%; font-size:12px;">
					<tr>
						<td colspan="4" rowspan="2">
							<font style="border:1px #000000 solid; font-size:13px; padding:5px 50px 5px 5px;">Instruction: Fill up items and check all necassary boxes. Write legibly in block letter.</font>
						</td>
						<td align="center" style="width:1.5in;">
							<font style="border:1px #000000 solid; width:1in; display:block"><?php echo $row["trid"]?></font>
						</td>
					</tr>
					<tr>
						<td align="center">Trainee No</td>
					</tr>
					<tr style="">
						<td colspan="2" style="font-size:14px; height:70px;"><b>1. GENERAL INFORMATION</b></td>
						<td colspan="2"></td>
						<td rowspan="3" align="center">
							<table style="width:1in;height:1in; font-size:12px; border-collapse: collapse; border:1px #000000 solid;">
								<tr>
									<td></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="width:1.5in;"><font style=" margin-left:30px;">Family Name:</font></td>
						<td colspan="3" style="border-bottom:1px #000 solid;"><?php echo $row["lname"] ?></td>
					</tr>
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">Given Name:</td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["fname"] ?></td>
						<td style="width:1.5in"><font style=" margin-left:30px;">Ext (Jr,Sr):</td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["suffix"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Middle Name:</td>
						<td style="border-bottom:1px #000 solid;"><?php echo $row["mname"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">License:</td>
						<td style="border-bottom:1px #000 solid;"><?php echo $row["licname"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Sex:</td>
						<td>Male <input type="radio" <?php if($row["sex"] == 'M') { echo "checked"; } ?> /></td>
						<td>Female <input type="radio" <?php if($row["sex"] == 'F') { echo "checked"; } ?> /></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Civil Status:</td>
						<td style="border-bottom:1px #000 solid;"><?php echo $row["civstat"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Citizenship:</td>
						<td style="border-bottom:1px #000 solid;"><?php echo $row["citizen"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Birthday:</td>
						<td style="border-bottom:1px #000 solid;" ><?php echo $row["bdate"] ?></td>
						<td>Birthplace:</td>
						<td style="border-bottom:1px #000 solid;" ><?php echo $row["bplace"] ?></td>
					</tr>
					<tr>
						<td colspan="1"><font style=" margin-left:30px;">Complete Mailing </td>
						<td colspan="3" style="border-bottom:1px #000 solid;"><?php echo $row["address"] ?></td>
					</tr>
					<tr>
						<td colspan="1"><font style=" margin-left:30px;">Address:</td>
						<td colspan="3" style="border-bottom:1px #000 solid;"><?php echo $row["zip"]. ", ". $row["province"].", ". $row["regid"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Contact Numbers:</td>
						<td style="border-bottom:1px #000 solid;" colspan="2">&nbsp;<?php echo $row["mobile"] ?></td>
					</tr>
					<tr>
						<td><font style=" margin-left:30px;">Email Address:</td>
						<td style="border-bottom:1px #000 solid;" colspan="2">&nbsp;<?php echo $row["eadd"] ?></td>
					</tr>
					
					<tr style="">
						<td colspan="2" style="font-size:14px; height:40px;"><b>2. HIGHEST EDUCATIONAL ATTAINMENT</b></td>
					</tr>
					
					<tr>
						<td style="width:1.5in;"><font style=" margin-left:30px;">Course/s Taken:</font></td>
						<td colspan="3" style="border-bottom:1px #000 solid;"><?php echo $row["course"] ?></td>
					</tr>
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">School Graduated:</td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["school"] ?></td>
						<td style="width:1.5in"><font style=" margin-left:30px;">Address:</td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["schadd"] ?></td>
					</tr>
					
					<tr>
						<td colspan="2" style="font-size:14px; height:40px;"><b>3. SHIPBOARD EXPERIENCE</b></td>
					</tr>
					
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">Rank: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["rankname"] ?></td>
						<td style="width:1.5in"><font style=" margin-left:30px;">Recent Company: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["name"] ?></td>
					</tr>
					
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">Contract Duration: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"></td>
					</tr>
					
					<tr>
						<td colspan="2" style="font-size:14px; height:40px;"><b>4. TRAINING COURSE YOU WISH TO ENROLL</b></td>
					</tr>
					
					<tr>
						<td colspan="5">
							<table style="margin-left:30px; width:7.8in; font-size:12px; border-collapse: collapse; border:1px #000000 solid; text-align:center;">
								<tr>
									<th rowspan="2" style="border:1px #000000 solid;">Course</th>
									<th colspan="2" style="border:1px #000000 solid;">Schedule</th>
									<th rowspan="2" style="border:1px #000000 solid;">Venue</th>
									<th rowspan="2" style="border:1px #000000 solid;">Sponsor</th>
								</tr>
								<tr>
									<td style="border:1px #000000 solid;">yyyy-mm-dd</td>
									<td style="border:1px #000000 solid;">yyyy-mm-dd</td>
								</tr>
								<?php $var = explode("*",$row["modulestake"]); ?>
								<?php foreach($var as $key){ $lols = explode(":",$key);?>
								<tr>
									<td style="border:1px #000 solid;"><?php echo $lols[0] ?></td>
									<td style="border:1px #000 solid;"><?php echo $lols[1] ?></td>
									<td style="border:1px #000 solid;"><?php echo $lols[2] ?></td>
									<td style="border:1px #000 solid;"><?php echo $lols[3] ?></td>
									<td style="border:1px #000 solid;"><?php echo $lols[4] ?></td>
								</tr>
								<?php } ?>
							</table>
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-size:14px; height:40px;"><b>5. CONTACT PERSON IN CASE OF EMERGENCY</b></td>
					</tr>
					
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">Name: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["emname"] ?></td>
						<td style="width:1.5in"><font style=" margin-left:30px;">Relationship: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"></td>
					</tr>
					
					<tr>
						<td style="width:1.5in"><font style=" margin-left:30px;">Address: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["emaddr"] ?></td>
						<td style="width:1.5in"><font style=" margin-left:30px;">Contact No: </font></td>
						<td style="width:1.5in; border-bottom:1px #000 solid;"><?php echo $row["emphone"] ?></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td align="center" colspan="3" style="margin-top:10px;">I Certify the the foregoing are true and correct to the best of my knowledge and belief.</td>
					</tr>
					
					<tr>
						<td style="height:100px;">Approved:
							<br><br><center>
							(Signed)<br>
							FERDINAND T.GO<br>
							REGISTRAR III</center>
						</td>
						<td align="center"></td>
						<td align="center">(Signed)<br>Signature of Trainee</td>
						<td align="center"><?php echo $row["enrolled"]; ?><br>Date</td>
					</tr>
					
				</table>

            </div> 
			<footer>
			</footer>
			
			<?php } ?>	
			
		</div> 
    </body>
</html>