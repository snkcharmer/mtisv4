<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>

<?php require_once('include/header.php'); ?>
<?php require_once('include/navmenu.php'); ?>
<div id="container" >
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<link href="<?php echo base_url()?>css/jquery.signaturepad.css" rel="stylesheet">
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
				  url: "<?php echo base_url()?>trainee/saveid",
				  data: { 
					 imgBase64: dataUrl
				  }
				}).done(function(msg) {
				  console.log('saved');
				 // Do Any thing you want
				});
			});
			
			document.getElementById("sigsave").addEventListener("click", function(){
				var dataUrl = sig.toDataURL();
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url()?>trainee/savesignature",
				  data: { 
					 imgBase64: dataUrl
				  }
				}).done(function(msg) {
				  console.log('lols');
				 // Do Any thing you want
				});
			});
			
		}, false);

	</script>
	<script>
		$(document).ready(function()
		{   
			var element = document.getElementById("sig");
			var bodyRect = document.body.getBoundingClientRect(),
				elemRect = element.getBoundingClientRect(),
				offset = elemRect.top - bodyRect.top;
				offset2 = elemRect.left - bodyRect.left;
			var timer;
			$('#lols').on("mousedown",function(){
				timer = setTimeout(function(){
					//alert('Element is ' + offset + ' vertical pixels from <body> ' + offset2);
					$(document).mousemove(function (e) {
						
						tempX = offset;
						tempY = offset2;
					});
				},200);
			}).on("mouseup mouseleave",function(){
				clearTimeout(timer);
			});
		});
	</script>
	<style>
		#video{
		display: block;
		position: relative;
		max-height: 500px;
		height: 100%;
		margin: auto;
		}
	</style>
	<div id="mid">
		<?php require_once('leftpane/lp_index.php'); $trainee = $trainee->row_array(); ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header">
					<p style="margin-bottom: 0px; padding:0px">
						Valid from <?php echo date("m/d/Y",strtotime($trainee["valid_id"])). " to ". date("m/d/Y",strtotime($trainee["expire_id"]));?>
					</p>
				</div>
				<form name='search' action='<?php echo base_url()?>trainee/adddatevalidation' method='post'>
				<div style="margin-left:5px">
					<div class="txtcontainer">
						<div class="anchortext">Valid from:</div>
						<div class="placeholdertb">
							<input name='valid' type='date' value='<?php echo date("Y-m-d"); ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="anchortext">Expiration Date:</div>
						<div class="placeholdertb">
							<input name='expire' type='date' value='<?php echo date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d')))); ?>'/>
						</div>
					</div>
					<div class="txtcontainer">
						<div class="placeholdertb">
							<input class="fadein" type="submit" style="height:30px;width:60px;float:left; font-size:15px;" value="Save"/>
						</div>
					</div>
				</div>
				</form>
				<div id="clear"></div>
				<div id="generalinfo_header">
					<p style="margin-bottom: 0px;">
						Create ID >
						<button id="front" style="margin-left:5px;"><a href="<?php echo base_url()?>printrecord/idfront" style="color:#000;" target="blank">Print Front</a></button> 
						<button id="back" style="margin-left:5px;"><a href="<?php echo base_url()?>printrecord/idback" style="color:#000;" target="blank">Print Back</a></button>
					</p></div>
				<video id="video" autoplay style="float:left; margin-left:5px"></video>
				<canvas id="canvas" width="320" height="240" style="float:left; margin-left:5px; display: block; position: relative;"></canvas>
				<div id="clear"></div>
				<button id="snap" style="float:left; margin-left:5px;">Capture</button>
				<button id="new" style="float:left; margin-left:5px;">New</button>
				<button id="upload" style="float:left; margin-left:5px;">Upload</button>
			
				<div id="clear"></div><div></div>
				<div id="generalinfo_header"><p style="margin-bottom: 0px;">Create Signature</p></div>
				<a href='#myModal' data-toggle='modal' data-id='' data-backdrop="static" data-keyboard="false"><button type="button">Signature</button></a>
				
			</div>
		</div>	
	</div>
</div>

				
				
				
				
<div class="bs-example">
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Draw Signature</h4>
					</div>
					
					<div class="modal-body">
						<div style="margin-left:5px" id="lols">
					
							<form method="post" action="" class="sigPad">
								<ul class="sigNav">
									<li class="clearButton"></li>
								</ul>
								
								<div class="typed"></div>
								<canvas id="sig" class="pad" width="300" height="150" style="border:1px solid #000"></canvas>
								<input type="hidden" name="output" class="output">
									
								<button id="sigsave" style="float:left; margin:5px;">Save</button>
								<button type="button" style="float:left; margin:5px;" class="clearButton"><a href="#clear">Clear</a></button>
							</form>
							
							<script src="<?php echo base_url()?>js/jquery.signaturepad.js"></script>
							<script>
								$(document).ready(function() {
									$('.sigPad').signaturePad({drawOnly:true});
								});
							</script>
							
							
							
							<script src="<?php echo base_url()?>js/json2.min.js"></script>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				
        </div>
    </div>
</div> 


<?php require_once('include/footer.php'); ?>
</body>
</html>