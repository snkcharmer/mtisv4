<?php $this->load->view("include/nea_header") ?>
<style type="text/css">
	html, body{
	  height: 100%;
	}
	body { 
       /*background-color: #00293c; */
	  margin-top:30px;
	}
</style>
<div class="container">
	<div style="margin:100px 0;">
		<center>
			<input type="hidden" id="trid" class="trid" value="<?php echo $trid;?>">
			<img src="<?php echo base_url()?>img/check1.png" style="width: 10%;">
			<h3 style="color: green;font-weight: bold;">You have successfully Registered</h3>
			<h4 style="color: red;">Click done button to finish</h4>
			<button type="button" class="btn btn-primary finish_" style="height: 60px;width: 200px;font-size: 25px;">Done !</button>
			<?php 
			if($rec['redcross'] != 0){?>
				<h2>Please get a Red cross Insurance at Information Marketing Section(IMS) to complete your registration Thank you  have a great day !!</h2>
			<?php }else{?>
				<h2>Please wait until your name flash on the tv screen and be ready all your requirements<br> Thank you  have a great day !!</h2>
			<?php 
			}
			?>
		</center>
	</div>
</div>
<?php $this->load->view("include/nea_footer") ?>
<?php $this->load->view("include/queing_js") ?>