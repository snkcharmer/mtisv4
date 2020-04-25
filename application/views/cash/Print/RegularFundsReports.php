<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>Regular Funds Report - Cash Collection Information System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
    <body style="background:none;">
	<style>
	#bottable tbody td,#bottable thead td {
		border:1px solid #000;
	}
	.noborder {
		border: none;
	}
	</style>
					
		<div style="width:15in">
				
		</div>
	
		<div style="width:15in">	
			<?php 
				$rphead_arr_1 = $total_others_date = $lolss = $sum_of_control_no = $total_balance2 = 0;
				foreach($report->result_array() as $row){ 
				
				$rpheader[] = $row["paytypeid"];
				}
					#print_r($rpheader); #die();
				$row = $records->row_array();
				$lrow = $records->last_row("array");
				#echo $lrow["ornum"];
				$total_rphead = array();
				$somesome = array();
				$rphead_arr = 0;
				$total_balance = 0;
				$total_others_tanan = 0;
				$ifone = 1;
				$x = $zzz = 0;
			?>
			
			<?php 
			while ($ifone == 1) 
			{ 
			
			$lols = 0;
			$rphead_arr_1++;
			$counter = 0; 
			
			?>
				<table style="font-size:11px; width:15in">
					<thead>
						<tr>
							<td colspan="3" align="center">
								<b style="font-size:17px">CASH RECEIPTS REGISTER</b><br>
								<font style="font-size:12px">Regular Funds</font>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="500px">Entity Name: NATIONAL MARITIME POLYTECHNIC</td>
							<td width="300px"></td>
							<td width="400px">Name of Collecting Officer/Cashier: 
								<?php 
								$venid = $this->session->userdata("venid");
								if ($venid == 1) {
									echo "EUFEMIA M. BALANGBANG";
								} elseif ($venid == 2) {
									echo "AGNES G. PANES";
								} ?>
							</td>
						</tr>
						<tr>
							<td>Sub-Office/District/Division: ADMINISTRATIVE, FINANCIAL AND MANAGEMENT DIVISION</td>
							<td></td>
							<td>Fund Cluster: 01</td>
						</tr>
						<tr>
							<td>Municipal/City/Province: TACLOBAN CITY, LEYTE</td>
							<td></td>
							<td>Sheet No. <?php echo $rphead_arr_1 ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
				
			<table id="bottable" style="font-size:11px; border:1px solid #000; width:15in; border-collapse:collapse;">
				<thead>
					<tr>
						<td colspan="2" align="center">Official Receipt/ Deposit Slip</td>
						<td rowspan="4" align="center" width="200px">Payor</td>
						<td colspan="4" align="center" style="width:100px;">Cash-Collecting Officer<br>(10101010)</td>
						<td colspan="<?php echo $report->num_rows() + 3;?>" align="center">Breakdown of Receipts</td>
					</tr>
					<tr>
						<td rowspan="3" align="center" width="40px">Date</td>
						<td rowspan="3" align="center" width="40px">Number</td>
						<td rowspan="2" align="center">Receipts</td>
						<td colspan="2" align="center" width="40px">Deposits</td>
						<td rowspan="2" align="center" width="40px">Balance</td>
						<?php foreach($report->result_array() as $row2){ ?>
							<td align="center" rowspan="3" width="50px"><?php echo empty($row2["module"]) ? $row2["typeshort"] : $row2["module"]; ?></td>
						<?php } ?>
						<td colspan="3" align="center">Others</td>
					</tr>
					<tr>
						<td align="center">National Treasury</td>
						<td align="center">AGDB</td>
						<td rowspan="2" align="center">Account Description</td>
						<td rowspan="2" align="center">UACS Object Code</td>
						<td rowspan="2" align="center">Amount</td>
					</tr>	
					<tr>
						<td align="center" width="40px">(+)</td>
						<td align="center" width="40px">(-)</td>
						<td align="center" width="40px">(-)</td>
						<td align="center" width="40px">(=)</td>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="<?php echo $report->num_rows() + 3;?>" align="center"></td>
						<td colspan="3" align="left">Certified Correct:</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="<?php echo $report->num_rows() + 3;?>" align="center"></td>
						<td align="center"></td>
						<td colspan="6" align="center"><br>
							<font style="border-bottom:1px solid #000; padding-left:20px; padding-right:20px">
								<?php 
								$venid = $this->session->userdata("venid");
								if ($venid == 1) {
									echo "EUFEMIA M. BALANGBANG";
								} elseif ($venid == 2) {
									echo "AGNES G. PANES";
								} ?>
							</font><br>
							Signature over Printed Name of Collecting <br> 
							Officer/Cashier<br>
							
							____________________<br> 
							Date<br> 
						</td>
					</tr>
				</tfoot>
				<tbody>

					<?php
					#foreach($records->result_array() as $rowss){ 
					#for ($i = 0; $records->num_rows() > $i; $i++)
					$rphead_arr_2 = 0;
					$current_date = $row["paydate"];
					$current_date2 = $row["paydate"];
					$showDate = 1;
					$xxx = 1;
					
					for ($i = 0; 35 > $i; $i++)
					{
						$rphead_arr_2++;
						++$counter;
						
						if(date('j',strtotime($started)) === '1' and $zzz == 0 and !empty($begbal["amount"])) 
						{ $zzz = 1; ?>
						<tr>
							<td></td>
							<td></td>
							<td>PREVIOUS BALANCE</td>
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo $begbal["amount"]; $lolss = $begbal["amount"]; ?></td>
							<td colspan="<?php echo $report->num_rows() + 3;?>" align="center"></td>
						</tr>
						
						<?php
						}
						
						if ($counter == 1 and $rphead_arr_1 != 1) { $i++; #--------kun first row hea amo ini it magawas?> 
						<tr>
							<td style="height:15px"></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo number_format($total_balance, 2);  ?></td>
							<td align="right" colspan="2"><?php echo number_format($sum_of_control_no, 2) ?></td>
							<td></td>
							<?php foreach($report->result_array() as $rows => $rphead){ ?>
								<td align="right" width="50px">
									<?php 
										if (empty($total_rphead[$rphead["paytypeid"]]))
										{
											echo 0;
										}
										else
										{
											echo number_format(array_sum($total_rphead[$rphead["paytypeid"]]), 2);
										}
									?>
								</td>
							<?php } ?>
							<td></td>
							<td></td>
							<td align="right"><?php echo number_format($total_others_tanan, 2); ?></td>
						</tr>
						<?php } #-----------kun first row hea amo ini it magawas
							
							if ($current_date != $row["paydate"]) 
							{
								$showDate = 1;
								$current_date = $row["paydate"];
								#$lolss = 0;
							}
							?>
						
						<tr>
							<td style="height:15px">
								<?php 
								echo ($showDate == 1 ? $row["paydate"] : "");
									$showDate = 0;
								?>
							</td>
							<td align="right">
							<?php
								//$xx = explode("-",$row["ornum"]);
								//$xx[1]; 
							
								#echo $xxx++. ".)"; 
								echo $row["ornum"]; ?>
							</td>
							<td><?php echo empty($row["fullname"]) ? $row["payor"] : $row["fullname"]; ?></td>
							<td align="right"><?php echo number_format($row["totalpayment"], 2); ?></td>
							<td></td>
							<td></td>
							<td align="right">
								<?php 
									$lolss+=$row["totalpayment"];  #$lolss na variable it para mga control no., Axa maincrement hea every payment, tapos mazero kun meada control no.
									echo number_format($lolss, 2);
									$total_balance+=$row["totalpayment"]; 
									$total_balance2+=$row["totalpayment"]; 
								?>
							</td>
							<?php
							$z = explode("*",$row["grpamount"]);
							
							foreach($rpheader as $rows => $key) #search kada header
							{
								$lols = "waray";
								$x = explode("*",$row["grpamount"]);
								foreach($x as $rows2 => $key2) #search kada group concat
								{
									$y = explode(":",$key2); #explode an meada ":" ha group_concat
									if ($y[0] == $key)
									{
										#echo "<td align='right'>".number_format($y[1], 2)."</td>";
										echo "<td align='right'>".number_format($y[1], 2)."</td>";
										#$z = array_diff($z, array($key2)); #tanggalon ha array kun meada kapareho
										unset($z[$rows2]);
										$lols = "meada";
										#$total_rphead[$key][$rphead_arr_1][$rphead_arr_2][] = $y[1] ;
										$total_rphead[$key][] = $y[1];
										$somesome[$row["paydate"]][$key][] = $y[1];
									}
									
									
									
								}
								if ($lols == "waray")
								{
									echo "<td></td>";
								}
							}
							
							$total_others = 0;
							$feename = "";
							foreach ($z as $rowx => $key) #loop an waray ha header na mga fees
							{
								$yy = explode(":",$key);
								if (!empty($yy[1]))
								{
									$total_others = $yy[1] + $total_others;
								}
								if (!empty($yy[2]))
								{
									$feewithsurat = (!empty($yy[2]) ? ($yy[2] == "Others" ? $yy[3] : $yy[2]) : $yy[3]);
									if (is_numeric($feewithsurat))
									{
										#$feewithsurat = $this->db->get_where("cash_payment_list",array("typename" => $feewithsurat))->row_array();
										$asd = $this->db->get_where("module",array("modcode" => $feewithsurat))->row_array();
										$feewithsurat = $asd["module"];
									}
									
									#$feename =  $feewithsurat ." / ".$feename;
									$feename = ($feename != "" ? $feewithsurat . "/" . $feename : $feewithsurat);
								}
							}

							$total_others = $total_others == 0 ? "" : $total_others;
							echo "<td align='right'>".$feename."</td>";
							echo "<td></td>";
							echo "<td align='right'>".number_format(floatval($total_others), 2)." </td>";
							#echo "<td align='right'>".$total_others."</td>";
							$total_others_date += $total_others;
							$total_others_tanan += $total_others; 
							?>
						</tr>
						<?php 
							if (!empty($controlno)){
							#$key = array_search($row["ornum"],array_column($controlno, 'afterornum')); #------------ Para control No.
							$keyss = array_keys(array_column($controlno, 'afterornum'),$row["ornum"]); #------------ Para control No.
							#print_r(array_column($controlno, 'afterornum'));# die(); #echo "<br>"; #print_r($row["ornum"]);
							if (!empty($keyss) or $keyss === 0)  #kun diri na parehas it date, ma add kita hin usa ka row
							{
							?>
								
								<?php foreach ($keyss as $key){ $i++; ?>
								<tr>
									<td><?php echo $controlno[$key]["dateadded"] ?></td>
									<td></td>
									<td align="right"><?php echo $controlno[$key]["controlno"]." / #".$controlno[$key]["ornum"]  ?></td>
									<td></td>
									<td colspan="2" align="right">
										<?php 
											echo number_format($controlno[$key]["amount"],2); #------ $lolss na variable it para mga control no.
											#echo number_format($lolss, 2);#$controlno[$key]["amount"]
											#$sum_of_control_no += $lolss; 
											$sum_of_control_no += $controlno[$key]["amount"]; 
											#$lolss = 0;
										?>
									</td>
									<td align="right"><?php
										$lolss = $lolss - $controlno[$key]["amount"];
										echo number_format($lolss,2);
										//<?php echo ($controlno[$key]["remamount"] == 0 ? "0.00" : number_format($controlno[$key]["remamount"],2)); 
										#kun meada remamount;
										#$lolss = $controlno[$key]["remamount"];
									?></td>
									<?php foreach($report->result_array() as $rows => $rphead){ ?>
										<td></td>
									<?php } ?>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<?php } }
							}
							?>
							
							
						<?php
						
						if ($lrow["ornum"] == $row["ornum"]) #------------------------if last na
						{ 
							$ifone = 2;	
							break;
						}
						
						$row = $records->next_row("array"); 
						
						 ?>
						
					<?php 
					} 
					
					?>
					
					<tr>
							<td style="height:15px"></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo number_format($total_balance2, 2) ?></td>
							<td align="right" colspan="2"><?php echo number_format($sum_of_control_no, 2) ?></td>
							<td></td>
							<?php foreach($report->result_array() as $rows => $rphead){ ?>
								<td align="right" width="50px">
									<?php 
										if (empty($total_rphead[$rphead["paytypeid"]]))
										{
											echo 0;
										}
										else
										{
											echo number_format(array_sum($total_rphead[$rphead["paytypeid"]]), 2);
										}
									?>
								</td>
							<?php } ?>
							<td></td>
							<td></td>
							<td align="right"><?php echo number_format($total_others_tanan, 2) ?></td>
					</tr>
				</tbody>
			</table>
			
			<?php
						
			// if ($lrow["ornum"] != $row["ornum"]) #------------------------if last na
			// { 
				echo "<pagebreak />";
			// }
			?>
			
		<?php 
		} 
		?>
			
			
		</div>
</body>
</html>