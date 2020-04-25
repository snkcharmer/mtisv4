<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>MTIS - Print Grade</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="ICON" href="<?php echo base_url()?>images/NMP.ico" />
        <link href="<?php echo base_url()?>css/backend.css" rel="stylesheet" type="text/css" media="screen" />
        
       
    </head>
    
    <body style="background:none;"> 
    	
        <div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:13in; height:426px;">        	
        	<div style="text-align:center; width:13in; margin:0 auto;">
            	<div style="border:1px #000000 solid; text-align:left; width:140px; padding:5px; margin-bottom:-70px; height:62px; margin-top:13px; font-size:12px;">NMP Form No. REG-04<br>Issue No. 01<br>Rev No. 01 March 4, 2010<br>Approved by : ED</div>
                <font style="font-size:15px;">Republic of the Philippines</font><br />
                <font style="font-size:13px;">Department of Labor and Employment</font><br />
                <font style="font-size:18px; text-transform:uppercase;">National Maritime Polytechnic</font><br />
                <font style="font-size:13px; font-style:italic;">Cabalawan, Tacloban City</font><br />
                
                <font style="font-size:18px; font-weight:bold;">Report on Trainees' Grades and Certification</font>
            </div> 
            
            <div style="text-align:left; width:13in; margin:0 auto; margin-top:2px;">
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">
                	<thead>
                    	<tr align="center">
                        	<td style="padding:3px; width:50px; text-align:center">Code</td>
                            <td style="padding:3px; width:200px">Course</td>
                            <td style="padding:3px; width:50px">BN</td>
                            <td style="padding:3px; width:50px">Hours</td>
                            <td style="padding:3px; width:80px">Start</td>
                            <td style="padding:3px; width:80px">End</td>
                            <td style="padding:3px; width:50px">Room</td>
                            <td style="padding:3px; width:50px">Venue</td>
                        </tr>
                    </thead>
                    <?php
						$row = $schedule->row();
						?>
						<tbody>
							<tr>
								<td style="padding:3px;"><?php echo $row->code; ?></td>
								<td style="padding:3px;"><?php echo $row->module; ?></td>
								<td style="padding:3px;"><?php echo $row->batch; ?></td>
								<td style="padding:3px;"><?php echo $row->hours; ?></td>
								<td style="padding:3px;"><?php echo $row->start; ?></td>
								<td style="padding:3px;"><?php echo $row->end; ?></td>
								<td style="padding:3px;"><?php echo $row->room; ?></td>
								<td style="padding:3px;"><?php echo $row->venue; ?></td>
							</tr>
						</tbody>
                </table>
                              <br>  
                			
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">
					<thead style="text-align:center;">
						<tr>
							<td rowspan="2" style="padding:3px;">License</td>
                            <td rowspan="2" style="padding:3px; ">Rank</td>
                            <td rowspan="2" style="padding:3px; ">Last Name</td>
                            <td rowspan="2" style="padding:3px; ">First Name</td>
                            <td rowspan="2" style="padding:3px; ">Middle Name</td>
                            <td rowspan="2" style="padding:3px; ">Ext</td>
                            <td rowspan="2" style="padding:3px; ">BirthDate</td>
							<td rowspan="2" style="padding:3px; width:30px;">Final Grade</td>
                            <td rowspan="2" style="padding:3px; width:60px;">Cert No.</td>
                            <td rowspan="2" style="padding:3px; ">Employer</td>
                            <td rowspan="2" style="padding:3px; width:50px;">Sponsor</td>
							<td rowspan="2" style="padding:3px; width:60px; ">Trainee No.</td>
							<td rowspan="2" style="padding:3px; width:80px;">Signature</td>
							<td rowspan="2" style="padding:3px; width:50px;">Date/Time</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$y = 0;
						if ($records) {
						foreach($records->result_array() as $key) { ?>
						<tr>
							<td><?php echo (empty($key['license']) ? "NONE" : $key['license'])?> </td>
							<td><?php echo (empty($key['rank']) ? "NONE" : $key['rank']) ?> </td>
							<td><?php echo $key['lname']?></td>
							<td><?php echo $key['fname']?></td>
							<td><?php echo $key['mname']?></td>
							<td><?php echo $key['suffix']?></td>
							<td><?php echo $key['bdate']?></td>
							<td><?php echo $key["fgrade"]; ?></td>
							<td><?php echo $key["certnumber"]; ?></td>
							<td><?php echo $key["name"]; ?></td>
							<td><?php echo substr($key["sptypename"],0,4); ?></td>
							<td><?php echo $key["trid"]; ?></td>
							<td></td>
							<td></td>
						</tr>
						<?php $y++; } } ?>
					</tbody>
				</table>
                
                <div style="width:1055px; margin-top:20px;">
                    <table width="1055px" style="font-size:12px;">
                    	<thead>
                        	<tr>
                            	<td>Number of Trainees = <?php echo $y;?></td>
                                <td>_______________________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of Trainer</td>
                            	<td>_______________________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of Assessor</td>
                            	<td>CERTIFIED BY:</td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                                <td>_______________________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of Trainer</td>
                            	<td><br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            	<td>__________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;Supervisor</td>
                            </tr>
                        </thead>
                    </table>
                </div> 
            </div>         
		</div> 
    </body>
</html>