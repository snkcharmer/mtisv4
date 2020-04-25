<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container">
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p>Statistics for <?php echo $this->session->userdata("currentyear")?></p>
				</div>
				<div style="text-align: left; margin-left:30px; font-size:20px">
					Total No. of Trainees: <?php echo $total_trainees["mynum"] ?><br>
					No. of New Trainees for the Year: <?php echo $total_unique_trainees["mynum"] ?><br>
					No. of Enrollees for this Month: <?php echo $unique_month["mynum"] ?><br>
					No. of Trainees for this Year: <?php echo $get_total_trainees["mynum"] ?><br>
					Most Taken Module: <?php 
						foreach ($module as $rows)
						{
							echo $rows["module"]. " - " . $rows["mynum"]. ",";
						}
					?>
						<br>
					No. of Female Trainees: <?php echo $female["mynum"] ?><br>
					No. of Male Trainees: <?php echo $male["mynum"] ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>