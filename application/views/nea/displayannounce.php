<?php $this->load->view("include/nea_header") ?>
<style type="text/css">
	body { 
        background-image: url(<?php echo base_url()?>images/3.jpg) ;
        background-position: center center;
        background-repeat:  no-repeat;
        background-attachment: fixed;
        background-size:  cover;                
        /*background-color: #192f5c;*/
    }
</style>
<div  class="container" style="font-size: 18px;">
	<h1 style="margin-top: 50px;"><b>Announcement</b></h1>
	<div style="">
		<p>
			<?php 
			if(isset($rec['announcement'])){
				echo nl2br($rec['announcement']);
			}else{
				echo"No Announcement display";
			}	
			
			?>
		</p>
	</div>
</div>