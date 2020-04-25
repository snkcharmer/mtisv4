<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<title>Proof Of Registration</title>
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
    	<div id="PrintContainer" style="margin-top:5px; width:816px;">  
    		<a href="javascript:void(0);" onclick="displayMessage(PrintBodyContainer.innerHTML)" title="Print Preview"><img src="<?php echo base_url()?>/img/printpreview.png" style="margin-bottom:-10px;">Print Preview</a>
            <a href="#" onclick="printMe(PrintBodyContainer.innerHTML)" title="Print"><img src="<?php echo base_url()?>/img/print.png" style="margin-bottom:-10px;">Print</a>
        </div>
              
        <div id="PrintBodyContainer" style="margin-top:30px; margin-bottom:20px; width:8.5in;">
        	<div style="text-align:center; width:auto; margin:0 auto;">
				<div style="border:1px #000000 solid; text-align:left; width:140px; padding:5px; margin-bottom:-70px; height:62px; margin-top:13px; font-size:12px;">NMP Form No. REG-03<br>Issue No. 01<br>Rev No. 01 March 4, 2010<br>Approved by : ED</div>
				
            	<font style="font-size:15px;">Republic of the Philippines</font><br />
                <font style="font-size:13px;">Department of Labor and Employment</font><br />
                <font style="font-size:18px; text-transform:uppercase;">National Maritime Polytechnic</font><br />
                <font style="font-size:13px; font-style:italic;">Cabalawan, Tacloban City</font><br />
                <br/> </br>
                <font style="font-size:18px; font-weight:bold;">Proof of Registration</font>
				
				<div style="float:right;border:1px #000000 solid; text-align:left; width:200px; margin-bottom:-70px; height:150px; margin-top:-140px; ">
					<?php 
						$url = "photos/".$this->session->userdata('trid').".jpg";
						#echo $url;
						if (file_exists($url)) { ?>
							<img src="<?php echo base_url()?>photos/<?php echo $this->session->userdata('trid')?>.jpg" style="width:200px;" />
						<?php } else { ?>
							<img src="<?php echo base_url()?>photos/nopic.png" style="width:105px; margin:5px auto;text-align:center; display:block;" />
						<?php } ?>
				</div>
			</div> 
			
            <style>
				.traineecont{
					display:block;
					
				}
				.traineecont table {
					width: 816px;
				}
				
				.traineecont td,.traineecont th {
					border-right: 1px solid #adadad;
					border-bottom: 1px solid #adadad;
					padding: 2px;
					color:#000;
					word-wrap:break-word;
					text-align: center;
					font-size: 12px;
				}
				
				.traineecont td:first-child, .traineecont th:first-child{
					border-left: 1px solid #adadad;
				}
				.traineecont th {
					border-top: 1px solid #adadad;
				}
			</style>
			
			<div class="traineecont">
				<table cellspacing = 0 cellpadding = 0 >
				<tr>
					<th style="width:100px">Trainee ID</th>
					<th style="width:180px">Last Name</th>
					<th style="width:290px">First Name</th>
					<th style="width:180px">Middle Name</th>
					<th>Extension</th>
				</tr>
				<tr>
					<td><?php echo $trainee['trid']?></td>
					<td><?php echo $trainee['lname']?></td>
					<td><?php echo $trainee['fname']?></td>
					<td><?php echo $trainee['mname']?></td>
					<td><?php echo $trainee['suffix']?></td>
				</tr>
				</table>
			</div>
			
			<div style="font-size:15px;">
				<table cellspacing = 0 cellpadding = 0 style="margin:10px 0 10px 0; width:100%; font-size:13px;">	
					<tr>
						<td>License:</td>
						<td><?php echo $trainee['license']?></td>
						<td>Rank on Board:</td>
						<td><?php echo $trainee['rank']?></td>
					</tr>
				</table>
			</div>
			
			<div class="traineecont">
				<table cellspacing=0 cellpadding=0>
				<tr>
					<th style="width:300px;">Course Title</th>
					<th style="width:30px">Batch</th>
					<th style="width:400px">Training Schedule</th>
					<th style="width:30px">Room</th>
					<th style="width:100px">Trainer Signature</th>
					<th style="width:150px">Sponsor</th>
					<th style="width:250px">Trng Fee</th>
					<th style="width:150px">Remarks</th>
					<th style="width:250px">OR No.</th>
				</tr>
				<?php $totamount = $trtotamount = 0; $x=0; 
				if ($training->num_rows() > 0) { $totamount = 0;
						foreach ($training->result_array() as $rows) {
							$x++;
						?>
				<tr>
					<td style="text-align:left"><?php echo $rows['module']?></td>
					<td><?php echo $rows['batch']?></td>
					<td><?php echo $rows['start']. " to " . $rows['end']?></td>
					<td><?php echo $rows['room']?></td>
					<td></td>
					<td><?php echo $rows['sptypename']?></td>
					<td style="text-align:right;">
						<?php echo number_format((float)$rows['tramount'], 2, '.', '');  $totamount = $totamount + $rows['amount']; $trtotamount = $trtotamount + $rows['tramount']?>
						<?php //echo "(".$rows['tramount'].")"; ?>
					</td>
					<td></td>
					<td><?php echo $rows['ornum']?><?php echo (!empty($rows['ornum2']) ? "/".$rows['ornum2'] : ""); ?></td>
				</tr>
				<?php } } else { ?>
					<tr>
						<td colspan="10">No Records Found</td>
					</tr>
				<?php } ?>
				</table>
			</div>
			
			<div style="float:left; display:block; margin-left: 10px; font-size:12px; overflow:hidden;">
				Note: Present this slip to the Cashier when paying.
				<table cellspacing=0 cellpadding=0 style="margin-top: 10px">
					<tr>
						<td style="width:150px"><?php # Issued by:?></td>
					</tr><tr>
						<td style="width:200px">Number of Courses: <?php echo $x ?></td>
					</tr>
				</table>
			</div>
			<div style="float:left;">
				<table cellspacing=0 cellpadding=0 style="text-align:right; font-size:12px; margin-left:85px; overflow:hidden;">
					<tr>
						<td style="width:50px;"></td>
						<td style="width:100px">Total Tr. Fees Paid</td>
						<td style="width:105px"><?php echo number_format((float)$totamount, 2, '.', ''); ?></td>
					</tr>
					<?php foreach($misc->result_array() as $rows)
					{ ?>
					<tr>
						<td style="width:50px;"></td>
						<td style="width:100px"><?php echo $rows["typename"] ?></td>
						<td style="width:84px">
							<?php echo number_format($rows["amount"], 2, '.', ''); 
							$totamount = $totamount + $rows['amount']; ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td colspan="2"><hr></td>
					</tr>
					<tr>
						<td style="width:50px;"></td>
						<td style="width:100px"><b>TOTAL:</b></td>
						<td style="width:84px"><b><?php echo number_format((float)$totamount, 2, '.', ''); ?></b></td>
					</tr>
				</table>
			</div>
			<div style="clear:both"></div>
			<hr style=""/>
			<table cellspacing=0 cellpadding=0 style="text-align:right; font-size:12px; margin-left:85px; overflow:hidden;">
				<tr>
					<td><br><br>
						Issued by: <u><?php echo $this->session->userdata("userfullname"); ?></u>
							<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Authorized Representative
					</td>
					<td></td>
				</tr>
			</table>
			
		</div> 
    </body>
</html>