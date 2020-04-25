<div style="width: 8.5in; font-family: Calibri, sans-serif;">
	<?php /*<div style="padding:1.6in 0in 0in 1in; width: 5.1in; height: 11in; background-image:url(<?=base_url()?>images/or.jpg); background-size: cover;"> */ ?>
	<div style="padding:1.8in 0in 0in 0.4in; width: 3.5in; height: auto;">
		<?php $lols = $paymentlist->row_array(); ?>
		<div style="text-align: right; padding-right: 90px;">
			<?php echo date('F j, Y',strtotime($lols['paydate'])); ?>
		</div>
		<div style="margin-top: 10px">
			<div style="margin-left:30px;">
				National Maritime Polytechnic
			</div>
			<div style="margin-left:30px; margin-top:5px;">
				<?php echo (empty($lols["fullname"]) ? $lols["payor"] : $lols["fullname"]); ?>
			</div>
		</div>
		<div style="margin-top: 0.45in; height: 1.7in">
			<table>			
			<?php
				$totalam = 0;
				if ($paymentlist->num_rows > 0) 
				{
					foreach($paymentlist->result_array() as $key) 
					{ $totalam = $totalam + $key['amount']?>
					<tr>
						<td style="text-align: left; width: 2.15in ">
							<?php echo (!empty($key["module"]) ? $key["module"] : $key['typename']); ?>
							<?php echo (!empty($key["rem"]) ? " - ".$key["rem"] : ""); ?>
						</td>
						<td style="text-align: right; width: 0.9in "><?php echo number_format($key['amount'], 2, '.', ' ')?> </td>
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
		<div style="height: 0.5in; margin-top:10px;">
			<table>
				<tr>
					<td style="text-align: right; width: 2.15in "></td>
					<td style="text-align: right; width: 0.9in "><?php echo number_format($totalam, 2, '.', ' '); ?></td>
				</tr>
			</table>
		</div>
		<div style="text-align: center; font-size: 12px; margin-top:10px; width:3.2in; border:1px solid #fff">
			***<?php echo $pesos. " Pesos". $centavo ." Only"; ?>***
		</div>
		<div style="text-align: left; height: 0.24in; margin-top:0.15in">
			<?php # add "X" Here ?>X
		</div>
		<div style="text-align: center; height: 0.5in; margin-top: 0.4in">
			<center>
			<table style="margin:0 auto;">
				<tr>
					<td style="font-size:12px">Time: <?php echo date('g:i A'); ?></td>
					<td style="font-size:12px">User: <?php echo $this->session->userdata("username"); ?></td>
				</tr>
			</table>
			</center>
		</div>
		<div style="text-align: right; height: 0.4in; padding-right:80px; margin-top:-20px;">
			AGNES PANES
		</div>
		
	</div>
</div>