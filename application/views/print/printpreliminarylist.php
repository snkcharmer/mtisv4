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
    </head>
    
    <body style="background:none;"> 
    	<div id="PrintContainer" style="margin-top:5px; width:1055px; margin-bottom:-35px; text-align:right; z-index:555555">  
        	<a href="javascript:void(0);" onclick="displayMessage(PrintBodyContainer.innerHTML)" title="Print Preview"><img src="<?php echo base_url()?>/img/printpreview.png" style="margin-bottom:-10px;">Print Preview</a>
        	<a href="#" onclick="printMe(PrintBodyContainer.innerHTML)" title="Print"><img src="<?php echo base_url()?>/img/print.png" style="margin-bottom:-10px;">Print</a>
        </div>
        <div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:1251px; height:426px;">        	
        	<div style="text-align:center; width:1055px; margin:0 auto;">
            	<div style="border:1px #000000 solid; text-align:left; width:140px; padding:5px; margin-bottom:-70px; height:62px; margin-top:13px; font-size:12px;">NMP Form No. REG-04<br>Issue No. 01<br>Rev No. 01 March 4, 2010<br>Approved by : ED</div>
                <font style="font-size:15px;">Republic of the Philippines</font><br />
                <font style="font-size:13px;">Department of Labor and Employment</font><br />
                <font style="font-size:18px; text-transform:uppercase;">National Maritime Polytechnic</font><br />
                <font style="font-size:13px; font-style:italic;">Cabalawan, Tacloban City</font><br />
                
                <font style="font-size:18px; font-weight:bold;">Preliminary List</font>
            </div> 
            
            <div style="text-align:left; width:1055px; margin:0 auto; margin-top:2px;">
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
                            <td style="padding:3px;">Trainers</td>
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
								<td style="padding:3px;"><?php echo $row->trainergroup; ?></td>
							</tr>
						</tbody>
                    <tfoot>
                    	<tr>
                        	<td style="padding:3px;">Description:</td>
                            <td colspan="8" style="padding:3px; border-right:1px #FFFFFF solid;"></td>
                        </tr>
                    </tfoot>
                </table>
                                
                			
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">
					<thead style="text-align:center;">
						<tr>
							<td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">License</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Rank</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Last Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">First Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Middle Name</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"></td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">BirthDate</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Employer</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Sponsor</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid; width: 60px">ID</td>
                            <td rowspan="2" style="padding:3px; border-top:1px #FFFFFF solid; width: 50px">Signature</td>
						</tr>
					</thead>
					<?php
						$y = 0;
						if ($submodgrades) {
						foreach($submodgrades as $row => $key) { $x = 0; $total = 0; ?>
					<tr>
						<td><?php echo (empty($key['license']) ? "NONE" : $key['license'])?> </td>
						<td><?php echo (empty($key['rank']) ? "NONE" : $key['rank']) ?> </td>
						<td><?php echo $key['lname']?></td>
						<td><?php echo $key['fname']?></td>
						<td><?php echo $key['mname']?></td>
						<td><?php echo $key['suffix']?></td>
						<td><?php echo $key['bdate']?></td>
						<td><?php echo $key["name"]; ?></td>
						<td><?php echo $key["sptypename"]; ?></td>
						<td><?php echo $key["trid"]; ?></td>
						<td></td>
						<?php /*<td><input type="text" name="remarks[]" value="<?php echo $row; ?>" style="width:80px"/></td> */?>
						
					</tr>
						<?php $x++; $y++; } } ?>
				</table>
                <div style="width:1055px;">
					<table width="600px" style="float:left;font-size:12px;">
						<tr>
							<td>NOTE: NO CERTIFICATE OF COMPLETION shall be issued to trainees not listed herein.
							</td>
						</tr>
                        <tr>
							<td>Number of Trainees = <?php echo $y;?></td>
						<tr>
					</table>
                    
					<table width="300px" style="float:left;font-size:12px;">
						<thead>
                            <tr>
                            	<td>CERTIFIED BY:</td>
							<tr>
							</tr>
								<td></td>
                            	<td>__________________________<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;Registrar</td>
                            </tr>
                        </thead>
                    </table>
                </div> 
            </div>         
		</div> 
    </body>
</html>