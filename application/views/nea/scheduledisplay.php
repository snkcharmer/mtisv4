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

    .pagination {
	  display: inline-block;
	}

	.pagination a {
	  color: black;
	  float: left;
	  padding: 8px 16px;
	  text-decoration: none;
	  transition: background-color .3s;
	  border: 1px solid #ddd;
	  margin: 0 4px;
	}

	.pagination a.active {
	  background-color: #4CAF50;
	  color: white;
	  border: 1px solid #4CAF50;
	}
	.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<div  class="container" >
	<h1 style="margin-top: 10px;"><b>Training Schedule</b></h1>
	<form method="post" action="<?php echo base_url()?>nea/search_sched">
		<input type="text" name="search_sched" class="form-control" placeholder="Search here ....." style="width: 80%;" autocomplete="off" autofocus>
	</form>
	<div class="row">
		<?php
		$year = date('Y');
		$y = 1;
		$x = 1;
			foreach ($records as $key) {

			$sql = "SELECT * from schedule where modcode = ? and year(start) = ? order by start";
			$res = $this->db->query($sql,[$key['modcode'],$year]);	
			//print_r($this->db->last_query());die();
		?>
			
			<?php if($x < 4){?>
				<div class="col-md-6">
					<h4><b><?php echo $key['descriptn'].'('.$key['module'].')'?></b></h4>
					<h4 style="font-size: 15px;"><span> Duration: <?php  if($key['ndays'] == 1){echo $key['ndays'].' day';}else{echo $key['ndays'].' days';}?> </span> <span style="margin-left: 100px;"> Venue: <?php echo $key['venue']?> </span></h4>
					<h4 style="font-size: 15px;"><span> Fee: &#8369;<?php echo $key['fee'].' + &#8369;170 (Misc. Fee) + &#8369;50 (ID Fee)';?> </span> </h4>
					<div class="row">
						<?php 
						if($res->num_rows() > 0){	
							foreach ($res->result_array() as $value) {
							$date = date('M d',strtotime($value['start'])).'-'.date('d',strtotime($value['end']));	
						?>
							<div class="col-md-3" style="font-size: 14px;">
								<span><?php echo $date;?></span> <span>Slot: (<?php echo $value['max'] - $value['size'];?>)</span> 	
							</div>
						<?php	
							}
						}else{
							echo"<span style='margin-left:20px;'>-TO BE ANNOUNCED-</span>";
						}	
						?>
					</div>	
				</div>
			<?php } ?>
			<?php if($x > 3){?>
				<div class="col-md-6">
					<h4><b><?php echo $key['descriptn'].'('.$key['module'].')'?></b></h4>
					<h4 style="font-size: 15px;"><span> Duration: <?php  if($key['ndays'] == 1){echo $key['ndays'].' day';}else{echo $key['ndays'].' days';}?> </span> <span style="margin-left: 100px;"> Venue: <?php echo $key['venue']?> </span></h4>
					<h4 style="font-size: 15px;"><span> Fee: &#8369;<?php echo $key['fee'].' + &#8369;170 (Misc. Fee) + &#8369;50 (ID Fee)';?> </span> </h4>
					<div class="row">
						<?php 
						if($res->num_rows() > 0){	
							foreach ($res->result_array() as $value) {
							$date = date('M d',strtotime($value['start'])).'-'.date('d',strtotime($value['end']));	
						?>
							<div class="col-md-3" style="font-size: 14px;">
								<span><?php echo $date;?></span> <span>Slot: (<?php echo $value['max'] - $value['size'];?>)</span> 	
							</div>
						<?php	
							}
						}else{
							echo"<span style='margin-left:20px;'>-TO BE ANNOUNCED-</span>";
						}	
						?>
					</div>	
				</div>
			<?php } ?>
			<?php
			if ($y == 2) {
				$y = 0;
				echo"<div style='clear:both;'></div>";
			}
			?>

		<?php
			$y++;	
			$x++;	
			}
		?>
	</div>
	<?php		
	echo $this->pagination->create_links(); 
	?>
</div>