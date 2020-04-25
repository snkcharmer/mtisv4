<div style="width: 8.5in; font-family: Calibri, sans-serif;">
	<?php /*<div style="padding:1.6in 0in 0in 1in; width: 5.1in; height: 11in; background-image:url(<?=base_url()?>images/or.jpg); background-size: cover;"> */ ?>
	<div style="padding:1.8in 0in 0in 0.8in; width: 5.1in; height: auto;">
		<?php $lols = $paymentlist->row_array(); ?>
		<div style="text-align: right; padding-right: 70px;">
			<?php echo date('F j, Y',strtotime($lols['paydate'])); #echo date('F j, Y'); ?>
		</div>
		<div style="height: 1.45in">
		<font style="font-size:18px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (empty($lols["fullname"]) ? $lols["payor"] : $lols["fullname"]); ?></font> 
		
		</div>
		<div style="height: 2.5in">
			<table>			
			<?php
				$totalam = 0;
				if ($paymentlist->num_rows > 0) 
				{
					foreach($paymentlist->result_array() as $key) 
					{ $totalam = $totalam + $key['amount']?>
					<tr>
						<td style="text-align: left; width: 3.25in "><?php echo (!empty($key["modfee"]) ? $key["modfee"] : $key['typename']); ?></td>
						<td style="text-align: right; width: 1in "><?php echo number_format($key['amount'], 2, '.', ' ')?> </td>
					</tr>
			<?php 	} 
				} else { ?>
					<tr>
						<td> - No Records found - </td>
					</tr>
			<?php 
				} 
			?>
			</table>
		</div>
		<div style="height: 0.5in">
			<table>
				<tr>
					<td style="text-align: right; width: 3.25in "><b>Php</b></td>
					<td style="text-align: right; width: 1in "><b><?php echo number_format($totalam, 2, '.', ' '); ?></b></td>
				</tr>
			</table>
		</div>
		<div style="text-align: center; height: 0.50in; font-size: 15px;">
			***<?php echo $pesos. " Pesos". $centavo ." Only"; ?>***
		</div>
		<div style="text-align: left; height: 0.24in">
			<?php # add "X" Here ?>
		</div>
		<div style="text-align: center; height: 0.5in">
			<center>
			<table style="margin:0 auto;">
				<tr>
					<td style="font-size:12px">Time: <?php echo date('g:i A'); ?></td>
					<td style="font-size:12px">User: <?php echo $this->session->userdata("username"); ?></td>
				</tr>
			</table>
			</center>
		</div>
		<div style="text-align: right; height: 0.5in; padding-right:100px;">
			<b>EUFEMIA M. BALANGBANG</b>
		</div>
		
	</div>
</div>