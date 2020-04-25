<?php $this->load->view("include/nea_header") ?>
<style type="text/css">
	body{
		background-image: url(<?php echo base_url()?>images/inquire.jpg) ;
        background-position: center center;
        background-repeat:  no-repeat;
        background-attachment: fixed;
        background-size:  cover;

	}
	.ls{
		margin-left: 30px;
	}
</style>	

    <body id="page">
        <div class="container">
        	<div style="height:10px;"></div>
        	<h2 style="text-align:center;font-size: 60px;color: white;font-weight: bold;text-shadow: 3px 1px #690303;"> WHAT'S NEW!</h2>
           	<div class="row">
           		<div class="col-md-5">
           			<div style="height:130px;"></div>
           			<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal0" style="font-size: 25px;padding: 10px;">Training Schedule</button><br>
           			<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal1" style="font-size: 25px;padding: 10px;">Registration Requirement</button><br>
           			<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal" style="font-size: 25px;padding: 10px;">Accommodation</button>
           			<br>
           			<!-- <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal2" style="font-size: 25px;padding: 10px;"><b>Send to Email</b></button>
           			<br> -->
           			<a href="<?php echo base_url()?>Home_/" class="btn btn-primary btn-block"style="font-size: 25px;padding: 10px;"><i class="fa fa-arrow-circle-left"></i> Back to Home</a>
           		</div>	
           		<!-- <div class="col-md-1">
           			
           		</div> -->
           		<div class="col-md-7	">
           			<div style="height:50px;"></div>
           			<div style="font-size:17px;background: white;padding: 5px 20px 30px 20px;color: black;border-radius: 5px;">
	           			<h2 style="font-size: 22px;font-weight: bold;">To our valued clients/trainees:</h2>
	           			<br>
	           			<p style="text-align: justify;">
	           				Pursuant to MARINA STCW Advisory No. 2015-20, in view of the full implementation of the 2010 Manila Amendments of the 1978 STCW Convention by January 1, 2017, all seafarers who will revalidate their Certificate of Proficiency (COP) on Basic Safety Training (BST) / Basic Training (BT), the following rules shall be adopted:
	           			</p>
	           			<br>
	           			<p style="text-align: justify;margin-left: 30px;">1. Seafarers with Certificate of Proficiency (COP) on Basic Safety Training (BST)but without the required approved seagoing service of at least 12 months in total during the preceding five years or 3 months in total during the preceding six months immediately prior to revalidating shall take the full course of Basic Training (BT).</p>
	           			<p style="text-align: justify;margin-left: 30px;">2.  Seafarers who are holders of Certificate of Completion/Training Completion of Basic Safety Training (BST) but without the Certificate of Proficiency (COP) on BST shall take the full course of Basic Training (BT).</p>
	           			<p style="text-align: justify;margin-left: 30px;">3.  Seafarers with Certificate of Proficiency (COP) on Basic Safety Training (BST) and with the required sea going service shall take Basic Training Updating (BTU) and Basic Training Refresher (BTR) only.</p>
	           				
	           			<p style="text-align: justify;margin-left: 30px;">4.  Seafarers who will revalidate their Basic Training (BT) with the required sea going service shall take the Basic Training Refresher (BTR) only.</p>
	           				
	           		</div>
           		</div>	
           			
           	</div>
        </div>
    </body>
</html>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title" style="font-size: 20px;color: black;">Send to G-mail Account</h4>
      	</div>

      	<form method="post" action="/action_page.php">
	      	<div class="modal-body" style="color: black;">
			  	<div class="checkbox">
				  	<label><input type="checkbox" value="1">Training Schedule</label>
				</div>
				<div class="checkbox">
				  	<label><input type="checkbox" value="2">Registration Requirements</label>
				</div>
				<div class="checkbox">
				  	<label><input type="checkbox" value="3">Accomodation</label>
				</div>
				<div class="form-group">
					<label>Email address</label>
					<input type="email" name="email" class="form-control" placeholder="Please provide email address" required>
				</div>

				<i>Note: This form will send data to your G-mail account</i>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary">Submit</button>
	      	</div>
      </form>	
    </div>

  </div>
</div>

<div id="myModal0" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-size: 30px;font-weight: bold;color: black;">Training Schedule</h4>
      </div>
      <div class="modal-body" style="font-size: 20px;color: black;">
      	<object type="application/pdf" data="<?php echo base_url()?>images/AMTS20191st Sem.pdf" width="100%" height="500" style="height: 85vh;">No Support</object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-size: 30px;font-weight: bold;color: black;">Registration Requirements</h4>
      </div>
      <div class="modal-body" style="font-size: 20px;color: black;">
      	<object type="application/pdf" data="<?php echo base_url()?>images/requirements.pdf" width="100%" height="500" style="height: 85vh;">No Support</object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-size: 30px;font-weight: bold;color: black;">Accomodation</h4>
      </div>
      <div class="modal-body" style="font-size: 20px;color: black;">
      	<object type="application/pdf" data="<?php echo base_url()?>images/accomodation.pdf" width="100%" height="500" style="height: 85vh;">No Support</object>
        <!-- <h3><u>Officer's Dorm Fee:</u></h3>	
	        <h4 class="ls">Trainees enrolled - &#8369;80.00</h4>
	        <h4 class="ls">Guests - &#8369;150.00</h4>
	        <h4 class="ls">Trainees enrolled (Air-Conditioned) - &#8369;200.00</h4>
	        <h4 class="ls">Guests (Air-Conditioned) - &#8369;250.00</h4>
	        <br>
	    <h3><u>Rating's Dorm Fee:</u></h3>	
	        <h4 class="ls">Trainees enrolled - &#8369;50.00</h4>
	        <h4 class="ls">Guests - &#8369;80.00</h4>
	    <div style="height: 30px;"></div>    
	    <h5 style="border: 1px black dashed;padding: 10px;"><label>Note:</label> <i style="font-size: 18px;">For accompanying family member's, please bring:<br>
	    	For husband/wife - Marriage Contract or any proof of marriage<br>
	    	For Children - Certificate of Live Birth</i></h5> -->    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">

	/*$(document).on('click','*',function(){

		window.location.href = "<?php echo base_url()?>Home/";
	});*/
	
</script>