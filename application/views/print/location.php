<div style="font-size:23px;">Total Students: <?php echo $total["lols"]; ?> </div>
<div style="font-size:15px;"><?php 
	if (!empty($total["from2"]))
	{
		echo "Date: ".$total["from2"]." to ".$total["to2"]; 
	}
	?> 
</div>
	<div style="margin-left:20px;">
		<table>
		<tr>
			<th style="width:70px; text-align:left;">Region</th>
			<th>No. of Trainees</th>
		</tr>
		<?php 
		if ($byregion->num_rows > 0)	
		{
			foreach($byregion->result_array() as $row) { ?>
		<tr>
			<?php $reg = ((!empty($row["region"])) ? $row["region"] : "None"); ?>
			<td><?php echo $reg; ?></td>
			<td><?php echo $row["lols"]."<br>"; ?></td>
		</tr>
		<?php } } ?>
	</div>
	