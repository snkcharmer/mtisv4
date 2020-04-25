<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Maritime Training Information System - National Maritime Polytechnic</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
   </head>

   <style>
	
	.hero-text {
	  	text-align: center;
	  	position: absolute;
	  	top: 50%;
	  	left: 50%;
	  	transform: translate(-50%, -50%);
	  	color: white;
	  	background-color: black;
	  	margin-top: 112px;
	  	width: 150px;
	}
		
	</style>
	
	<body style="font-family: Arial;font-size: 12pt;">
		<htmlpageheader name="MyHeader1">
			
		</htmlpageheader>
			<htmlpagefooter name="MyFooter1">
				<div>
					
				</div>
			</htmlpagefooter>
		<sethtmlpageheader name="MyHeader1" value="on"  show-this-page="1"/>
		<sethtmlpagefooter name="MyFooter1" value="on" />	
		<?php 
		
		if(count($template) == 0){ ?>
			<div style="border:2px solid black;padding: 20px;height: 11.7in;">
			<h4>No template Found please check template and module name</h4>
			</div>
		<?php }else{	
		foreach ($records as $key) {
			
			//echo $key['end'].' fdf';
			if (strpos($template['body'], 'end_') !== false) {
				$start = date('F d',strtotime($key['start']));
				$end = date('F d, Y',strtotime($key['end']));
				$body = str_replace("start_",$start,$template['body']);
				$body = str_replace("end_",$end,$body);
			}else{
				$start = date('F d Y',strtotime($key['start']));
				$body = $sdfs = str_replace("start_",$start,$template['body']);;
			}
			
			$date1 = date('dS',strtotime($key['certdate']));
			$date2 = date('F, Y',strtotime($key['certdate']));
			$body = str_replace("date_",$date1,$body);
			$body = str_replace("month_",$date2,$body);
		?>
			<div style="border:2px solid black;padding: 20px;height: 11.7in;">	
				<div style="width: 100%">
					<div class="" style="width:1.5in;float: right;">
						<img src="<?php echo base_url()?>images/logo1.png" alt="NMP LOGO" style="width:173.858267717px;height: 179.149606299px;">
					</div>
					<div class="" style="width:1.5in;float: left;">
						<img src="<?php echo base_url()?>images/logo.jpg" alt="NMP LOGO" style="width:173.858267717px;height: 179.149606299px;">
					</div>

					<div class="" style="width:4in;">
						
						<div style="text-align: center;">Republic of the Philippines</div>
						
						<div style="text-align: center;">Department of Labor and Employment</div>
						<div style="text-align: center;font-weight: 900px;font-size: 24px;font-family: Arial, Helvetica, sans-serif;">National Maritime Polytechnic</div>
						<div style="text-align: center;">Cabalawan, Tacloban City</div>
					</div>
				</div>
				<div style="height: 20px;"></div>
				<div style="width: 100%;height: 50px;">
					<div style="float: right;width: 3in;">
						<div class="div1">
							<p style="text-align: left;">
								<span>Certificate No.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php echo strtoupper($key['certnumber']);?><br>
								<span>Registration No.</span>&nbsp;&nbsp;&nbsp;
								<?php echo $key['trid']?>
							</p>
						</div>
					</div>
				</div>
				<div style="height: 20px;"></div>
				
					
				<div style="text-align: center;font-size: 26pt;"><b>Certificate of Completion</b></div>
				<div style="text-align: center;margin-top: 10px;">This certificate is issued to</div>
				<div style="height: 20px;"></div>
				<div style="text-align: center;font-size: 20pt;"><b><?php echo $key['fullname']?></b></div>
				<!--     -->
				<div style="height: <?php if($template['hmargintop'] == 0){echo "0px";}else{echo $template['hmargintop'].'px';}?>"></div>
				<div style="text-align: center;"><?php echo $template['header'];?></div>
				<div style="height: <?php if($template['hmarginbottom'] == 0){echo "0px";}else{echo $template['hmarginbottom'].'px';}?>"></div>

				<div style="height: <?php if($template['h1margintop'] == 0){echo "0px";}else{echo $template['h1margintop'].'px';}?>"></div>
				<div style="text-align: center;font-weight: 700px;"><?php echo nl2br($template['header1']);?></div>
				<div style="height: <?php if($template['h1marginbottom'] == 0){echo "0px";}else{echo $template['h1marginbottom'].'px';}?>"></div>

				<div style="height: <?php if($template['h2margintop'] == 0){echo "0px";}else{echo $template['h2margintop'].'px';}?>"></div>
				<div style="text-align: center;"><?php echo nl2br($template['header2']);?></div>
				<div style="height: <?php if($template['h2marginbottom'] == 0){echo "0px";}else{echo $template['h2marginbottom'].'px';}?>"></div>
				
				<div style="height: <?php if($template['bmargintop'] == 0){echo "0px";}else{echo $template['bmargintop'].'px';}?>"></div>
				<div style="width: 100%;">
					<p style="text-align: justify;">
						<?php echo nl2br($body);?>
					</p>
				</div>
				<div style="height: <?php if($template['bmarginbottom'] == 0){echo "0px";}else{echo $template['bmarginbottom'].'px';}?>"></div>
					
				<div style="height: <?php if($template['fmargintop'] == 0){echo "0px";}else{echo $template['fmargintop'].'px';}?>"></div>
				<div style="width: 100%;">
					<div style="float: right;width: 4in;">
						<div style="text-align: center;"><u><b>CAPT. EMMANUEL JESUS M. LAGUITAN</b></u></div>
						<div style="text-align: center;">Head, Maritime Training and Assesment Division</div>
					</div>

					<div style="width: 3in;">
						<div style="text-align: center;"><u><b>JOEL B. MAGLUNGSOD</b></u></div>
						<div style="text-align: center;">Executive Director III</div>
					</div>
				</div>
				<div style="height: <?php if($template['fmarginbottom'] == 0){echo "0px";}else{echo $template['fmarginbottom'].'px';}?>"></div>

				<div id="over" style="text-align: center;width: 100%;">
					<!-- <span style="z-index: 9999;">sadasdasd</span> -->
					
					<?php 
							
						$url = "photos/".$key['trid'].".jpg";
						
						#echo $url;
						if (file_exists($url)) { ?>
							<!-- <img src="<?php //echo base_url()?>photos/<?php //echo $key['trid']?>.jpg" style="width:1.5in;height: 1.5in;z-index: -9999px;" /> -->
							<div style="
								margin: auto;
								text-align: center;
								width:170px;
								height: 1.5in;
								background-image: url('<?php echo base_url()?>photos/<?php echo $key['trid']?>.jpg');
								background-repeat: no-repeat;
								background-size: cover;
								position: relative;
								">
								<div class="hero-text">
							    	<h1 style="font-size:12px"><?php echo $key['sname']?></h1>
							    	
							 	</div>
								<!-- <p style="background: black;color: white;width:145px;margin-top:130px;"></p> -->
							</div>
	
					<?php
						} else { 
					?>		
						<h3 style="width:1.5in;height: 1.5in;border: 1px solid black;margin: auto;"></h3>
					<?php 
							
						} 
					?>
					
				</div>
			</div>
		<?php 
			echo "<div style='clear: both;'>";
		}
	}
		?>		
	</body>	
</html>