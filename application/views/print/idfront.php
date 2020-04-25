<style>
	* {
	margin: 0;
}
#container
{
    height:367px;
    width:235px;
    position:relative;
}

#image
{    
    position:absolute;
    left:0;
    top:0;
	z-index:1;
}
#text{
	top:250px;
}
#id{
	top:125px;
}
#sig{
	top:300px;
}
#signature{
	top:320px;
}
.pos
{
    z-index:100;
    position:absolute;    
    color:#000;
    font-size:15px;
    font-weight:bold;
	text-align:center;
}
.Centerer
{
    display: inline-block;
    height: 100%;
    vertical-align: middle;
}
.Centered
{
    display: inline-block;
    vertical-align: middle;
}
</style>
<div id="container">
    <img id="image" src="<?php echo base_url()?>images/front.jpg"/>
	<div id="id" class="pos">
		<div style="text-align:center; z-index:101;height: 200px; width:235px">
			<img id="image" src="<?php echo base_url()?>photos/<?php echo $this->session->userdata("trid")?>.jpg" style="width:110px; margin-left:10px; border:2px solid #ccc; margin-top:-10px;" />
		</div>
	</div>
    <div id="text" class="pos">
        <div style="text-align:center; z-index:102;height: 200px; width:235px; font-family:'Verdana'; font-size:13px">
			<?php echo $trainee["trid"] ?> <br />
			<?php echo $trainee["lname"]. ", " . $trainee["fname"] . " " . substr($trainee["mname"],0,1) . ". " . $trainee["suffix"]; ?>
		</div>
    </div>
	<?php 
				$path = $_SERVER['DOCUMENT_ROOT']."/mtisv4/photos/".$this->session->userdata("trid")."sig.jpg"; 
				if (file_exists($path)) { ?>
	<div id="sig" class="pos">
        <div style="width:235px; position:absolute; text-align: center;">
			<span class="Centerer"></span>
			
					<img class="Centered" src="<?php echo base_url()?>photos/<?php echo $this->session->userdata("trid")?>sig.jpg" style="width:100px;"/>
				
		</div>
    </div>
	<div id="signature" class="pos">
        <div style="text-align:center; z-index:104;height: 200px; width:235px">
			____________________ <br />
			Signature
		</div>
    </div> 
	<?php } ?>
	
</div>
<div id="container">
    <img id="image" src="<?php echo base_url()?>images/back.jpg"/>
	
</div>