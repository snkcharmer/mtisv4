<?php $this->load->view("include/nea_header") ?>
<link href="<?php echo base_url()?>css/jquery.signaturepad.css" rel="stylesheet">
<style type="text/css">
	html, body{
      height: 100%;
    }
    body { 
        background-image: url(<?php echo base_url()?>images/background.jpg) ;
        background-position: center center;
        background-repeat:  no-repeat;
        background-attachment: fixed;
        background-size:  cover;
        background-color: #999;
  
    }
</style>
<div class="container" style="background: white;margin-top: 50px;">
	<div style="height: 650px;">
		<h1 style="text-align: center;"><img src="<?php echo base_url()?>images/camera.png" style="width: 10%;"> Take a Photo</h1>
		<div class="col-xs-6">
			<center>
				<input type="hidden" id="trid" class="trid" value="<?php echo $trid;?>">
				<video id="video" autoplay ></video>
				<canvas id="canvas" width="320" height="240" style="display: none; position: relative;"></canvas>
				<div id="clear"></div>
				
			</center>
		</div>
		<div class="col-xs-2"></div>
		<div class="col-xs-4">
			<button id="snap" class="btn btn-primary">Capture</button>
			<button id="new" class="btn btn-warning">New</button>
			<button id="upload" class="btn btn-danger">Upload</button>
			<button id="skip" class="btn btn-primary">Skip</button>
		</div>
	</div>	
</div>
<?php $this->load->view("include/nea_footer") ?>
<script>
		// Put event listeners into place
		window.addEventListener("DOMContentLoaded", function() {
			// Grab elements, create settings, etc.
			$('#upload').hide();
			var canvas = document.getElementById("canvas"),
				sig = document.getElementById("sig"),
				context = canvas.getContext("2d"),
				video = document.getElementById("video"),
				videoObj = { "video": true },
				errBack = function(error) {
					console.log("Video capture error: ", error.code); 
				};

			// Put video listeners into place
			if(navigator.getUserMedia) { // Standard
				navigator.getUserMedia(videoObj, function(stream) {
					// video.src = window.URL.createObjectURL(stream);
					video.srcObject = stream;
					video.play();
				}, errBack);
			} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
				navigator.webkitGetUserMedia(videoObj, function(stream){
					video.src = window.webkitURL.createObjectURL(stream);
					video.play();
				}, errBack);
			} else if(navigator.mozGetUserMedia) { // WebKit-prefixed
				navigator.mozGetUserMedia(videoObj, function(stream){
					video.src = window.URL.createObjectURL(stream);
					video.play();
				}, errBack);
			}

			// Trigger photo take
			document.getElementById("snap").addEventListener("click", function() {
				context.drawImage(video, 0, 0, 320, 240);
				// Littel effects
				$('#video').fadeOut('slow');
				$('#canvas').fadeIn('slow');
				$('#snap').hide();
				$('#new').show();
				$('#upload').show();
				// Allso show upload button
				//$('#upload').show();
			});
			
			
			// Capture New Photo
			document.getElementById("new").addEventListener("click", function() {
				$('#video').fadeIn('slow');
				$('#canvas').fadeOut('slow');
				$('#snap').show();
				$('#new').hide();
				$('#upload').hide();
			});
			// Upload image to sever
			
			document.getElementById("upload").addEventListener("click", function(){
				$('#snap').hide();
				$('#new').show();
				$('#upload').hide();
				var dataUrl = canvas.toDataURL();
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url()?>nea/saveid",
				  data: { 
					 imgBase64: dataUrl,
					 'trid':$('.trid').val()
				  }
				}).done(function(msg) {
				  swal({ 
		                title: "Done!",
		                text: "Photo successfully uploaded",
		                type: "success" 
		            }, function(){
		                window.location.href="<?php echo base_url()?>Done_/"+$('#trid').val();
		            });
				 // Do Any thing you want
				});
			});

			document.getElementById("skip").addEventListener("click", function(){
				
		        window.location.href="<?php echo base_url()?>Done_/"+$('#trid').val();
		            
			});
			
			/*document.getElementById("sigsave").addEventListener("click", function(){
				var dataUrl = sig.toDataURL();
				$.ajax({
				  type: "POST",
				  url: "<?php //echo base_url()?>trainee/savesignature",
				  data: { 
					 imgBase64: dataUrl
				  }
				}).done(function(msg) {
				  console.log('lols');
				 // Do Any thing you want
				});
			});*/
			
		}, false);

	</script>