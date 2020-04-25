<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Maritime Training Information System - National Maritime Polytechnic</title>
	<link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
	<!--<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto"> ---->
	<link href="<?php echo base_url()?>css/login.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo base_url()?>js/tabber.js" ></script>
</head>
<body>
	<div id="container">
		<div id="header">
		<!--<p class="blocktext"><img src="<?php //echo base_url()?>/img/logo1.png" style="margin-bottom:-20px;" />Login</div></p> -->
		<div id="login_form">
		<?php
			echo '<div class="errorMessage">'.$this->session->flashdata('message').'</div>';
			if (!empty($msg)) {
				echo $msg;
				}
			echo form_open(base_url().'home/validate'); ?>
			<span class='font-effect-anaglyph'><b>Welcome to MTISv4. </b>Please Login</span><br>
			<span>Username:</span><br>
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" style="position: relative"/>
			<br />
			<span>Password:</span><br>
			<input type="password" name="password" value="<?php echo set_value('password'); ?>" />
		<?php
			echo form_submit('login_submit','Login');
			echo form_close();
		?>
		</div>
	</div>
</body>