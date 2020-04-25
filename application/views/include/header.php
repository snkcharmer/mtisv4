<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
	<link rel="stylesheet" href="<?php echo base_url()?>css/nav.css">
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url()?>css/datepicker.css" />
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
	<?php /* <script type="text/javascript" src="<?php echo base_url()?>js/datepicker/datepicker.js"></script> */ ?>
	<link href="<?php echo base_url()?>css/content.css" rel="stylesheet" type="text/css" media="screen" />
	<!--<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">--->
	<script>
		function oist(){
			  $('#date').DatePicker({
					flat: true,
					date: '2008-07-31',
					current: '2008-07-31',
					calendars: 1,
					starts: 1
				});
		}
	</script>
	<script type="text/javascript" src="<?php echo base_url()?>js/nav.js"></script>
	
	<title>Maritime Training Information System - National Maritime Polytechnic</title>
</head>
<body>