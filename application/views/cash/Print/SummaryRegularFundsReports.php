<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>Regular Funds Report - Cash Collection Information System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
    <body style="background:none;">
	<style>
	#bottable td,#bottable th {
		border:1px solid #000;
	}
	
	.noborder {
		border: none;
	}
	
	</style>
	
	
	<table id="bottable" style="font-size:15px; border:1px solid #000; border-collapse:collapse;">
		<tr>
			<th>Type</th>
			<th>Short</th>
			<th>Amount</th>
		</tr>
		<?php
			$total = 0;
			foreach($records->result_array() as $row) { ?>
			<tr>
				<td><?php echo $row['typename']; ?></td>
				<td><?php echo $row['typeshort']; ?></td>
				<td style="text-align: right"><?php echo number_format($row['totalSum'],2); ?></td>
			</tr>
		<?php $total = $total + $row['totalSum']; } ?>
			<tr>
				<th colspan="2">Total:</th>
				<th><?php echo number_format($total,2); ?></th>
			</tr>
	</table>
		
</body>
</html>