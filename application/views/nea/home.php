<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NMP</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/demo.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>dist/sweetalert/sweetalert.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style4.css" />
      <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>    

        <script type="text/javascript" src="<?php echo base_url()?>js/modernizr.custom.86080.js"></script>
         <script src="<?php echo base_url()?>dist/sweetalert/sweetalert-dev.js"></script>
    </head>
<style type="text/css">
	.div0{
		height: 400px;
		/*border:5px solid white;*/
		width: 700px;
		border-radius: 10px;
		z-index:9999;
	}
	.div1{
		
		width: 300px;
		background: #f76d6d;
		z-index: -1;
		margin-top: -53px;
	}
	body { 
                background-image: url(<?php echo base_url()?>images/2.jpg) ;
                background-position: center center;
                background-repeat:  no-repeat;
                background-attachment: fixed;
                background-size:  cover;
                /*background-color: #192f5c;*/
                
      
    }
    .img:hover {
	  /* Start the shake animation and make the animation last for 0.5 seconds */
	  animation: shake 0.5s; 

	  /* When the animation is finished, start again */
	  animation-iteration-count: infinite; 
	}

	@keyframes shake {
	  0% { transform: translate(1px, 1px) rotate(0deg); }
	  10% { transform: translate(-1px, -2px) rotate(-1deg); }
	  20% { transform: translate(-3px, 0px) rotate(1deg); }
	  30% { transform: translate(3px, 2px) rotate(0deg); }
	  40% { transform: translate(1px, -1px) rotate(1deg); }
	  50% { transform: translate(-1px, 2px) rotate(-1deg); }
	  60% { transform: translate(-3px, 1px) rotate(0deg); }
	  70% { transform: translate(3px, 1px) rotate(-1deg); }
	  80% { transform: translate(-1px, -1px) rotate(1deg); }
	  90% { transform: translate(1px, 2px) rotate(0deg); }
	  100% { transform: translate(1px, -2px) rotate(-1deg); }
	}

	.footer {
	   position: fixed;
	   left: 0;
	   bottom: 0;
	   width: 100%;
	   /*background-color: red;*/
	   color: white;
	   text-align: left;
	}
</style>
<body class="">
	<h3 style="color: white;margin-top: 10px;"><a style="color: white;" href="<?php echo base_url()?>Home_/" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to Home Page</a></h3>
	<div class=""><!-- #f1f3cE -->
		
		<div style="padding-top:90px;">
			<div class="row">
				<div class="col-md-6" style="text-align: center;margin-left: -50px;">
	                <img src="<?php echo base_url()?>images/logo.png" style="width: 250px;">
	                
	                <div>
	                    <h3 style="font-size: 50px;font-weight: bold;color: white;">Maritime Training<br>Express
	                    Registration <br>System</h3>
	                </div>
	            </div>
	            <div class="col-md-6">
	            	<div style="padding-left:0px;margin-top: 50px;color: white;">
	            		<h3 style="color: black;font-size: 27px;"><b>Instruction:</b> Choose <span  style="color: red;"><u>NEW</u></span> if you have never enrolled in NMP or <span  style="color: red;"><u>RETURNEE</u></span> if you have previously  enrolled.</h3>
		            	<br>
						<div class="col-md-6" style="text-align: right;">
							<img src="<?php echo base_url()?>img/new2.png" style="width: 60%;cursor: pointer;" class="new img">
						</div>
						<div class="col-md-6">
							<img src="<?php echo base_url()?>img/returnee2.png" style="width: 60%;cursor: pointer;" class="returnee img"><br>
						</div>
					</div>	
	            </div>
				<!-- <div class="col-md-8">
					<center>
						<h3 style="color: white;"><a style="color: white;" href="<?php //echo base_url()?>Home_/" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a></h3>
					</center>	
					
				</div> -->
				
				
			</div>
				
			
		</div>
	</div>
	<div class="footer">
		  <p style="font-size: 19px;"> <span style="color: white;">By using this system, you agree to our <!--a href="<?php //echo base_url()?>termsofservice" target="_blank"  style="color:red;">Terms of Services </a--> <a href="<?php echo base_url()?>nea/policy" target="_blank" style="color:red;">Privacy Policy</a></span></p>
		</div>
</body>
<div class="example-modal" >
	<div class="show_modal modal fade" >
	  <div class="modal-dialog" style="width: 30%;">
		<div class="modal-content" style="background-color: #f1f3cE;"> 
			<form method="post" action="<?php echo base_url()?>Registration01/1">
				<div class="modal-body">
					<h4 style="color:#f62a00;font-weight: bold;">Please filled up this field.</h4>
					<div class="form-group">
						<label style="font-size: 17px;">First Name <span style="font-size: 17px;color: red;">*</span></label>
						<input style="height: 50px;font-size: 17px;" type='text' class="form-control" name="fname" id="fname" autocomplete="off" placeholder="First Name" required />
					</div>
					<div class="form-group">
						<label style="font-size: 17px;">Last Name <span style="font-size: 17px;color: red;">*</span></label>
						<input style="height: 50px;font-size: 17px;" type='text' class="form-control" name="lname" id="lname" autocomplete="off" placeholder="Last Name" required />
					</div>
					<div class="form-group">
						<label style="font-size: 17px;">Birthdate <span style="font-size: 17px;color: red;">*</span></label>
						<input style="height: 50px;font-size: 17px;" type='date' class="form-control" name="bdate" id="bdate" autocomplete="off" placeholder="Birthdate" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-defualt pull-left" data-dismiss="modal" style="height: 40px;font-size: 17px;"><i class="fa fa-remove"></i> Close</button>
					<button type="submit" style="height: 40px;font-size: 17px;" class="btn btn-primary check_this"><i class="fa fa-anchor"></i> Submit</button>
				</div>
			</form>	
		</div>
		<input type="hidden" name="" class="_error" value="<?php echo $this->session->flashdata('cerror');?>">
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
<?php $this->session->unset_userdata('cerror');?>
<!-- <footer >
    <h4 style="color: white;">National Maritime Polytechnic <a href="#" style="color: #a5ff2e">Terms of Services</a> and <a href="#" style="color: #a5ff2e">Privacy Policy</a></h4>
</footer> -->
<?php $this->load->view("include/nea_footer") ?>
<script type="text/javascript">
	$(document).on("click", ".new", function(event){

		window.location.href = "<?php echo base_url()?>Registration/0";
	});

	$(document).on('click','.returnee', function() {
		$('.show_modal').modal({
			backdrop:'static',
			keyboard:false
		});
	});

	if($('._error').val() == "ok")
	{	
		
		$(document).ready(function() {
			$('.show_modal').modal('hide');
			swal("Alert!", "Oops... No Record found Please check inputs", "error");
		});	
		
	}
</script>