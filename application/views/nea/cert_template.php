<?php $this->load->view("include/header") ?>
<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url()?>js/datatable.js"></script>
<?php $this->load->view("include/navmenu") ?>
 <script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
 <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script> 
 <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2/select2.min.css">
<div id="container">
	<div id="mid">
		<?php $this->load->view("leftpane/lp_index") ?>
		<div id="content" class="midShadow">
			<div id="generalinfo" class="column">
				<div id="generalinfo_header" ><p>
					<form name='search' action='<?php echo base_url()?>nea/search_cert' method='post' style="float:left;">
						<div style="float:left;">Search module
						<input type="text" name="search_cert" style="font-size:15px; width:200px; margin-left: 5px" autocomplete="off" />
						</div></p>
					</form>
					<div id='cssmenu' style="float:left;margin-top:-10px;height:45px;">
						<ul>
							<li><a href='javascript:void(0);' class="addcert">Add certificate template</a></li>
							<li><a href='<?php echo base_url()?>nea/toturial' target="_blank">Toturial on how to add contents to certificate template</a></li>
						</ul>
					</div>
					<div style="clear:both;"></div>
				</div>

				<table class="example" cellspacing="0" cellpadding="0" style="width:99%">
					<thead>
						<th style="width:100px;">Code</th>
						<th style="width:100px">Module</th>
						<th style="width:500px">Description</th>
						<th style="width:0px"></th>
					</thead>
					<?php
					foreach ($records as $key) {
					?>
						<tr style="height: 40px;">
							<td style="height: 30px;"><?php echo $key['modcode']?></td>
							<td><?php echo $key['module']?></td>
							<td><?php echo $key['descriptn']?></td>
							<td>
								<a href="javascript:void(0);" class="btn updatecert" 
								data-modid="<?php echo $key['modcode'];?>" 
								data-id="<?php echo $key['id'];?>" 
								data-header="<?php echo $key['header'];?>" 
								data-hmt="<?php echo $key['hmargintop'];?>" 
								data-hmb="<?php echo $key['hmarginbottom'];?>" 
								data-header1="<?php echo $key['header1'];?>" 
								data-h1mt="<?php echo $key['h1margintop'];?>" 
								data-h1mb="<?php echo $key['h1marginbottom'];?>"
								data-header2="<?php echo $key['header2'];?>" 
								data-h2mt="<?php echo $key['h2margintop'];?>" 
								data-h2mb="<?php echo $key['h2marginbottom'];?>"
								data-body="<?php echo $key['body'];?>" 
								data-bmt="<?php echo $key['bmargintop'];?>" 
								data-bmb="<?php echo $key['bmarginbottom'];?>"
								data-fmt="<?php echo $key['fmargintop'];?>" 
								data-fmb="<?php echo $key['fmarginbottom'];?>"
								>Edit</a>
								<a href="<?php echo base_url()?>nea/view_certificate/<?php echo $key['modcode']?>" class="btn btn-warning" target="_blank">View</a>
								<a href="<?php echo base_url()?>nea/delete_cert_temp/<?php echo $key['id']?>" onclick="return confirm('Are you Sure, You want to Delete thiss Record.')" class="btn btn-danger">Delete</a>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
				<div style="margin-top:10px">
				<?php 
				
				echo $this->pagination->create_links(); 
				?>
				</div>
			</div>
		</div>
	</div>
<script src="<?php echo base_url()?>plugins/select2/select2.min.js"></script>
<div class="example-modal" >
	<div class="show_modal modal fade" >
	  <div class="modal-dialog" style="width: 1000px;">
		<div class="modal-content" style="background-color: #f1f3cE;"> 
			<form method="post" action="<?php echo base_url()?>nea/save_template">
				<input type="hidden" name="cert_id" class="cert_id">
				<div class="modal-body">
					<textarea style="border: none;background: #f1f3ce;width: 100%;font-size: 16px;font-weight: bold;" >NOTE: if you want the text to be bold put (<b></b>) between the text. EXAMPLE: (<b>sample</b>)</textarea>
					<div class="col-md-10">
						<div class="row form-group">
							<label>Select module</label>
	                        <select class="form-control modid" name="modid" id="modid" style="margin-left:-30px;width: 60%;" required>
	                           <option value="">Select module....</option>
	                            <?php
	                            foreach ($mod->result_array() as $key) {?>
	                                <option value="<?php echo $key['modcode']?>"><?php echo '<b>'.$key['module'].'</b> - '.$key['descriptn']?></option>
	                            <?php
	                            }
	                           ?>
	                        </select>
	                    </div>
	                </div>    
                    <div class="row">
                    	<div class="col-md-10">
                    		<div class="form-group">
                    			<label>Header</label>
                    			<textarea class="form-group header" style="width: 800px; height: 70px;" name="header" required></textarea>
                    		</div>
                    	</div>
                    	<div class="col-md-2">
                    		<label>Header margin</label>
                    		<div style="clear: both;"></div>
                    		<div class="col-md-6">
                    			<label>Top</label>
                    			<input type="text" name="hmargint" class="form-control hmargint" style="width: 50px;">
                    		</div>	
                    		<div class="col-md-6">
                    			<label>Bottom</label>
                    			<input type="text" name="hmarginb" class="form-control hmarginb" style="width: 50px;">
                    		</div>	
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-10">
                    		<div class="form-group">
                    			<label>Header1</label>
                    			<textarea class="form-group header1" style="width: 800px; height: 70px;" name="header1" required></textarea>
                    		</div>
                    	</div>
                    	<div class="col-md-2">
                    		<label>Header1 margin</label>
                    		<div style="clear: both;"></div>
                    		<div class="col-md-6">
                    			<label>Top</label>
                    			<input type="text" name="h1margint" class="form-control h1margint" style="width: 50px;">
                    		</div>	
                    		<div class="col-md-6">
                    			<label>Bottom</label>
                    			<input type="text" name="h1marginb" class="form-control h1marginb" style="width: 50px;">
                    		</div>	
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-10">
                    		<div class="form-group">
                    			<label>Header2</label>
                    			<textarea class="form-group header2" style="width: 800px; height: 100px;" name="header2"></textarea>
                    		</div>
                    	</div>
                    	<div class="col-md-2">
                    		<label>Header2 margin</label>
                    		<div style="clear: both;"></div>
                    		<div class="col-md-6">
                    			<label>Top</label>
                    			<input type="text" name="h2margint" class="form-control h2margint" style="width: 50px;">
                    		</div>	
                    		<div class="col-md-6">
                    			<label>Bottom</label>
                    			<input type="text" name="h2marginb" class="form-control h2marginb" style="width: 50px;">
                    		</div>	
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-10">
                    		<div class="form-group">
                    			<label>Body</label>
                    			<textarea class="form-group body" style="width: 800px; height: 300px;" name="body" required></textarea>
                    		</div>
                    	</div>
                    	<div class="col-md-2">
                    		<label>Body margin</label>
                    		<div style="clear: both;"></div>
                    		<div class="col-md-6">
                    			<label>Top</label>
                    			<input type="text" name="bmargint" class="form-control bmargint" style="width: 50px;">
                    		</div>	
                    		<div class="col-md-6">
                    			<label>Bottom</label>
                    			<input type="text" name="bmarginb" class="form-control bmarginb" style="width: 50px;">
                    		</div>	
                    		<div style="height: 200px;"></div>
                    		<label>Footer margin</label>
                    		<div style="clear: both;"></div>
                    		<div class="col-md-6">
                    			<label>Top</label>
                    			<input type="text" name="fmargint" class="form-control fmargint" style="width: 50px;">
                    		</div>	
                    		<div class="col-md-6">
                    			<label>Bottom</label>
                    			<input type="text" name="fmarginb" class="form-control fmarginb" style="width: 50px;">
                    		</div>	
                    	</div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning pull-left" data-dismiss="modal" style="height: 40px;font-size: 17px;"><i class="fa fa-remove"></i> Close</button>
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
	<script>
		$('#modid').select2({
	        placeholder: "Select a Module",
	        allowClear: true
	    });
		$(document).on("click", ".addcert", function(event){
			$('.show_modal').modal({
				backdrop:'static',
				keyboard:false
			});
			
		});

		$(document).on("click", ".updatecert", function(event){

			var certid = $(this).attr('data-id');$('.cert_id').val(certid);
			var modid = $(this).attr('data-modid');$('.modid').val(modid).trigger("change");
			var header = $(this).attr('data-header');$('.header').val(header);
			var hmt = $(this).attr('data-hmt');$('.hmargint').val(hmt);
			var hmb = $(this).attr('data-hmb');$('.hmarginb').val(hmb);
			var header1 = $(this).attr('data-header1');$('.header1').val(header1);
			var h1mt = $(this).attr('data-h1mt');$('.h1margint').val(h1mt);
			var h1mb = $(this).attr('data-h1mb');$('.h1marginb').val(h1mb);
			var header2 = $(this).attr('data-header2');$('.header2').val(header2);
			var h2mt = $(this).attr('data-h2mt');$('.h2margint').val(h2mt);
			var h2mb = $(this).attr('data-h2mb');$('.h2marginb').val(h2mb);
			var body = $(this).attr('data-body');$('.body').val(body);
			var bmt = $(this).attr('data-bmt');$('.bmargint').val(bmt);
			var bmb = $(this).attr('data-bmb');$('.bmarginb').val(bmb);
			var fmt = $(this).attr('data-fmt');$('.fmargint').val(fmt);
			var fmb = $(this).attr('data-fmb');$('.fmarginb').val(fmb);
			

			$('.show_modal').modal({
				backdrop:'static',
				keyboard:false
			});
			
		});
	</script>
</div>
<?php //require_once('include/footer.php'); ?>
</body>
</html>