<?php $this->load->view("include/nea_header") ?>
<style type="text/css">
	html, body{
	  height: 100%;
	}
	body { 
       background-color: black; 
		margin-top:30px;
	}
	.vidcon{
		position:absolute;
		height:550px;
		width:75%; 
		background: black;
		margin-right: 100px;
	}
	.vidcon video {
		position: relative;
		min-width: 100%;
		min-height: 100%;
		top: 0;
		bottom: 0;
		height: auto;
	  
	}
	video {
	  object-fit: cover;
	}
	.bgcolorpink { background-color: #E9C3E9; }
	.footer {
	   position: fixed;
	   
	   left: 0;
	   bottom: 0;
	   width: 100%;
	   background-color: red;
	   color: white;
	   text-align: center;
	   font-size: 40px;
	}
</style>
<div style="margin-top:50px; margin-left:20px;">
	<div class="row"><!-- #00293c -->
		<div class="col-md-4">
		
			<div style="margin: -30px -25px 0px 0px;background-color: white;/*padding: 20px;*/font-size: 25px;" id="sample">
				<table class="table">
					<thead style="background: yellow;">
						<tr>
							<th colspan="2"><i class="fa fa-list"></i> LIST OF TRAINEE</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="data_insert">
						
					</tbody>
				</table>
			</div>	
		</div>
		<div class="col-md-8">
			<div class="col-md-12">
				<div class="col-md-2">
					<img src="<?php echo base_url()?>images/logo2.png" style="width:100%;margin-top:-40px;margin-bottom:20px;" />
				</div>
				<div class="col-md-7">
					<span style="color:white;font-size:25px;text-align:left;"><b>NATIONAL MARITIME POLYTECHNIC</b><br><small>Cabalawan, Tacloban City</small></span>
				</div>
				<div class="col-md-3">
					<b style="color: yellow;font-size:25px;"><?php echo date('F d, Y ')?></b><br> <span style="color:red;"><b style="font-size:25px;padding:3px 6px 3px 6px;"><b id="hours"></b><b id="sep">:</b> <b id="min"></b><b id="sep">:</b><b id="sec"></b> <?php echo date("A") ?></b></span>
				</div>
			</div>
			<div style="clear:both"></div>
			<div class="vidcon">
				<video controls autoplay>
					<source src="<?php echo base_url()?>video/TheEqualizer2.mp4" type="video/mp4">
				</video>
			</div>	
		</div>
	</div>
</div>
<div class="footer">
  <p>PLEASE REMAIN SEATED UNTIL YOUR NAME IS HIGHLIGHTED ON THE SCREEN</p>
</div>
<?php $this->load->view("include/nea_footer") ?>


<script type="text/javascript">
	

	var updateClock = function() {
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
		//console.log(month);
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
		h = h%12;
        if(h<10) {	
            h = "0" +h;
        }
		
        m = date.getMinutes();
        if(m<10) {
            m = "0" + m;
        }
        s = date.getSeconds();
        
        if(s<10) {
            s = "0"+s;
        }
        
        //result = ''+days[day]+' '+months[month]+' '+d+', '+year+' '+h+':'+m+':'+s;
        //$('#clock').html(result);

        //$('#Date').html(''+days[day]+' '+months[month]+' '+d+', '+year);
        $("#sec").html(s);
        $("#min").html(m);
        $("#hours").html(h);

        setTimeout(updateClock,'1000');
        return true;
	}
	updateClock();

	$(document).ready(function(){ 
	 	setInterval(findYellow,1000);     
		function findYellow(){ 
		  	$("tr.blinkflash").each(function(){ 
		       $(this).toggleClass("bgcolorpink");
		    })
		}
	});

	$(document).ready(function(){ 
	 	setInterval(load_que_data,1000);     
	 	//load_que_data();
		function load_que_data()
		{
			//alert('dsadsa');
			$.ajax({
			   url:"<?php echo base_url(); ?>nea/get_que_data/",
			   method:"post",
			   dataType:"json",
			   data:{},
			   success:function(data)
			   {
				   //console.log(data.rec);
					var tr= '';
					var x = 1;
					for(var i = 0; i < data.rec.length; i++){
						//console.log(data.rec[i]['window']);
						if(data.rec[i]['window'] == "0"){
							//alert('sds');
							tr += '<tr>';
							tr += '<td>'+x+'. '+data.rec[i]['name']+'</td>';
							tr += '<td></td>';
							tr += '</tr>';
						}else{
							tr += '<tr style="background: black;color: white;">';
							tr += '<td>'+x+'. '+data.rec[i]['name']+'</td>';
							if(data.rec[i]['window'] != null){
							tr += '<td>Window '+data.rec[i]['window']+' <img src="<?php echo base_url()?>img/loader.gif" style="width: 80px;"></td>';
							}else{
								if(data.rec[i]['redcross'] == 1){
									tr += '<td style="color:red;">Get RedCross Insurance</td>';	
								}else{
									tr += '<td style="color:red;">Please wait ......</td>';	
								}
								
							}	
							tr += '</tr>';
						}	
					x++;		
					}		
							
					$('.data_insert').html(tr);
					var lng = data.rec.length;
					//console.log(lng - 15);
					if( lng < 15){
						//console.log('adi na');
						for(var i = 1; i < 20 - lng; i++){
							tr += '<tr style="height:50px;">';
							tr += '<td></td>';
							tr += '<td></td>';
							tr += '</tr>';
								
						}				
						$('.data_insert').html(tr);
				   	}

				   	//setInterval(findYellow,1000);
			   }
			});
		}
	load_que_data();
	});


</script>