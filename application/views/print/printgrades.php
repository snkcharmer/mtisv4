<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>MTIS - Print Grade</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="ICON" href="<?php echo base_url()?>images/NMP.ico" />
        <link href="<?php echo base_url()?>css/backend.css" type="text/css" media="screen" />
    
    </head>
    
    <body style="background:none;"> 
    	<div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:1251px; height:426px;">        	
			<div id="PrintBodyContainer" style="margin-top:5px; margin-bottom:20px; width:1251px; height:426px;">        	
				<div style="text-align:center; width:1055px; margin:0 auto;">
				
				
				<table style="border-collapse: collapse; text-align:left; width:140px; padding:10px; margin-bottom:-70px; height:62px; margin-top:13px; font-size:11px;" border="1">
					<tr>
						<td style="padding-bottom:10px">
							NMP Form No. RCU-05<br>Issue No. 01<br>Rev No. 02 Oct 2, 2017<br></div>
						</td>
					</tr>
				</table>
				
				<font style="font-size:15px;">Republic of the Philippines</font><br />
				<font style="font-size:13px;">Department of Labor and Employment</font><br />
				<font style="font-size:18px; text-transform:uppercase;">National Maritime Polytechnic</font><br />
				<font style="font-size:13px; font-style:italic;">Cabalawan, Tacloban City</font><br />
				
				<font style="font-size:18px; font-weight:bold;">Grade Sheet</font>
			</div> 
			
            <div style="text-align:left; width:1055px; margin:0 auto; margin-top:2px;">
                <table id="tblStyle" border="1" style="width:100%; font-size:12px; border-collapse: collapse;">

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

                    <?php
						$row = $schedule->row();
						?>

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

                    	<tr>
                        	<td style="padding:3px;">Description:</td>
                            <td colspan="8" style="padding:3px; border-right:1px #FFFFFF solid;"><?php echo $row->description; ?></td>
                        </tr>

                </table>
                                
                			
                <table id="tblStyle" border="1" style="width:1055px; font-size:12px; border-collapse: collapse; table-layout: fixed;">
					
						<tr><?php $numsub = $submodule->num_rows();?>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">License</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Rank</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Last Name</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">First Name</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Middle Name</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"></td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">BirthDate</td>
							<?php if ($numsub > 0) {?>
								<td colspan="<?php echo $numsub + 1; ?>" style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid; text-align: center; width:100px"  >Final Grade</td>
							<?php } else { ?>
								<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;  width:80px">Final Grade</td>
							<?php } $x = 0;?>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Employer</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;">Sponsor</td>
							<td <?php if ($numsub > 0) { echo 'rowspan="2"'; } ?> style="padding:3px; border-top:1px #FFFFFF solid;">ID</td>
						</tr>

					

						<?php if ($submodule->num_rows() > 0) {?>
						<tr>
							<?php foreach ($submodule->result_array() as $rows){ ?>
								<td><?php echo $rows["submodule"]?></td>
							<?php } ?>
							<td>FGrade</td>
						</tr>
						<?php } ?>
					
						<?php
							$y = 0;
							if ($submodgrades) {
							foreach($submodgrades as $row => $key) { $x = 0; $total = 0; $ifselect = 0; ?>
						<tr>
							<td><?php echo (empty($key['license']) ? "NONE" : $key['license'])?> </td>
							<td><?php echo (empty($key['rank']) ? "NONE" : $key['rank']) ?> </td>
							<td><?php echo $key['lname']?></td>
							<td><?php echo $key['fname']?></td>
							<td><?php echo $key['mname']?></td>
							<td><?php echo $key['suffix']?></td>
							<td><?php echo $key['bdate']?></td>
							<?php if ($submodule->num_rows() > 0) 
							{
								foreach($key["grade"] as $grades => $lols) { $x++; ?>
									<td>
										<?php echo $lols["fgrade"]; $ifselect = 1;?>
									</td>
								<?php $total = $lols["fgrade"] + $total; } 
							} 
							if ($ifselect == 0 && $submodule->num_rows() > 0) {
							?>
								<td></td> 
							<?php } ?>
							<td><?php echo (empty($total) ? $key["fgrade"] : round($total / $x)); ?></td>
							<td><?php echo $key["name"]; ?></td>
							<td><?php echo $key["sptypeshort"]; ?></td>
							<td><?php echo $key["trid"]; ?></td>
							
						</tr>
							<?php $x++; $y++; } } ?>
						<tr>
							<td colspan="<?php echo ($submodule->num_rows() > 0 ? $submodule->num_rows() + 11 : 11)?>">
								Number of Trainees = <?php echo $y;?>
							</td>
						</tr>
						<tr>
							<td colspan="<?php echo ($submodule->num_rows() > 0 ? $submodule->num_rows() + 7 : 7)?>" style="border:none"></td>
							<td colspan="4" style="border:none; padding-top:20px; text-align:left;">CERTIFIED BY: <br><br>
								
								______________________________________ <br/>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supervisor
								
							</td>
						</tr>

							
						<?php 
							$i = 0; 
							$yy = $trainercount->tr; 
							while ($i < $yy) { 
						?>
							<tr>
								<td colspan="3" style="border:none; padding-top:20px; text-align:center;">____________________________________<br/> 
								Printed Name of Trainer</td>
								<td colspan="3" style="border:none; padding-top:20px; text-align:center;">__________________________________<br/>
								Signature of Trainer</td>
							</tr>
						<?php $i++; } 
						?>

				</table>
                
                
            </div>         
		</div> 
    </body>
</html>