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

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style4.css" />
      <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>    

        <script type="text/javascript" src="<?php echo base_url()?>js/modernizr.custom.86080.js"></script>
    </head>
<style type="text/css">
   .button {
      border-radius: 10px;
     /* box-shadow: 0 15px 17px rgba(0,0,0,255.15);*/
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 28px;
      padding: 20px;
      width: 300px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
    }

    .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .button span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }

    .button:hover span {
      padding-right: 25px;
    }

    .button:hover span:after {
      opacity: 1;
      right: 0;
    }
    .button:hover{
        box-shadow: 0 15px 17px rgba(0,0,0,255.15);
        transition: box-shadow 0.3s ease-in-out;

    }

    body { 
        background-image: url(<?php echo base_url()?>images/1.jpg) ;
        background-position: center center;
        background-repeat:  no-repeat;
        background-attachment: fixed;
        background-size:  cover;                
        /*background-color: #192f5c;*/
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

    <body id="">
        
        <div class="container">
            <!-- <div style="height: 170px;"></div> -->
            <div style="padding-top: 90px;">
                <div class="row" style="/*background-color: rgba(255,255,255,0.6);*/padding: 0px 0px 30px 0px;">
                    <div class="col-md-6">
                        <img src="<?php echo base_url()?>images/logo2.png" style="width: 250px;">
                        
                        <div>
                            <h3 style="font-size: 50px;font-weight: bold;color: black;/*text-shadow: 0 12px 15px black;*/">Maritime Training<br>Express
	                    Registration System</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-top: 40px;margin-left: -50px;">
                            <button class="button btn-4 reg" style="background-color: #e6e6e6;color: black"><span>Register </span></button><br>
                            <button class="button b2" style="background-color: #f39c12;"><span>Training Schedule </span></button><br>
                            <button class="button b3" style="background-color: #00c0ef"><span>Requirements </span></button><br>
                        
                            <button class="button b4" style="background-color: #d73925"><span>Accomodation </span></button><br>
                            <button class="button b5" style="background-color: #008d4c"><span>Announcement </span></button>
                        </div>
                    </div>
                </div>    
            </div>    
        </div>
        <div class="footer">
		  <p style="font-size: 19px;"> <span style="color: white;">By using this system, you agree to our <!--a href="<?php //echo base_url()?>termsofservice" target="_blank"  style="color:red;">Terms of Services </a--> <a href="<?php echo base_url()?>nea/policy" target="_blank" style="color:red;">Privacy Policy</a></span></p>
		</div>
    </body>
</html>
<script type="text/javascript">
    /*$(document).on('keypress',function(e) {
        if(e.which) {
            window.location.href = "<?php //echo base_url()?>Home/";
        }
    });*/
    $(document).on('click','.reg',function(){

        window.location.href = "<?php echo base_url()?>Home/";
    });

    $(document).on('click','.b5',function(){

        window.open("<?php echo base_url()?>nea/announcement_display");
    });

    $(document).on('click','.b2',function(){

        //window.location.href = "<?php //echo base_url()?>images/AMTS20191st Sem.pdf";
        window.open("<?php echo base_url()?>nea/scheduledisp");
    });
//
    $(document).on('click','.b3',function(){
    	 window.open("<?php echo base_url()?>nea/trainingrequirements");
        //window.location.href = "<?php echo base_url()?>images/requirements.pdf";
    });

    $(document).on('click','.b4',function(){
    	window.open("<?php echo base_url()?>nea/accomodation");
       // window.location.href = "<?php echo base_url()?>images/accomodation.pdf";
    });
    
</script>