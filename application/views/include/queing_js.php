<script type="text/javascript">

	$(document).on("click", ".finish_", function(event){
		//event.preventDefault();
		$.ajax({
		   url:"<?php echo base_url(); ?>nea/finish_na/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'trid':$('#trid').val()
		   },
		   success:function(data)
		   {
		   		///load_que_data(); 
		   		window.location.href="<?php echo base_url()?>Home_/";
		   }
		});
			
	});

	 
</script>