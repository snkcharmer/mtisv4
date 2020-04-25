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
#valid{
	top:150px;
}
.pos
{
    z-index:100;
    position:absolute;    
    color:#000;
    font-size:15px;
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
	<img id="image" src="<?php echo base_url()?>images/back.jpg"/>
	<div id="valid" class="pos">
        <div style="text-align:center; z-index:102;height:200px; width:235px; font-family:'Verdana'; font-style:Italic;font-size:11px; color: #fff;">
			<?php echo $trainee["valid_id"] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $trainee["expire_id"] ?> 
		</div>
    </div>
</div>