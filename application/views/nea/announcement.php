<script src="<?php echo base_url()?>bootstrap/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>


<?php $this->load->view("include/header") ?>
<?php $this->load->view("include/navmenu") ?>
<div id="container">
	<div id="mid">
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				
				<div id="generalinfo_header"><p style="margin-bottom: 0px; padding:0px;">Home > Announcement
				
				</div>
				<form name='search' action='<?php echo base_url()?>nea/saveannouncement' method='post'>
					<input type="hidden" name="anid" value="<?php if(isset($rec['id']) && $rec['id'] != ""){echo $rec['id'];}?>"> 
					<div>
						<textarea name="announce"  style="width: 93%;height: 70%;font-size: 16px;text-align: left">
						<?php 
						if(isset($rec['announcement']) && $rec['announcement'] != "") 
						{
						echo $rec['announcement'];
						}
						?>	
						</textarea>
					</div>
					<div class="row"><br>
						<div class="col-sm-3 col-md-2">
							<button type="submit" class="btn btn-primary">Confirm</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>