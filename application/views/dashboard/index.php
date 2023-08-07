
<?=link_tag("assets/dashboard/index.css")?>
<?=script_tag("assets/chart/index.js")?>
<?=script_tag("assets/dashboard/index.js")?>
<?=script_tag("assets/index.js")?>

<div class="row gy-4">
	
	<?php $this->load->view('dashboard/cards'); ?>
	
	<div class="col-12 col-lg-5">
		<div class="card">
			<div class="card-header">
				<?=heading('Best product by pricing', 6, 'class="me-auto c-mantle"')?>
			</div>
			<div class="card-body">
				
			</div>
		</div>	
	</div>	

	<div class="col-12 col-lg-7">
		<div class="card">
			<div class="card-header">
				<?=heading('Top product', 6, 'class="me-auto c-mantle"')?>
			</div>
			<div class="card-body">
				
			</div>
		</div>	
	</div>

	<div class="col-12">
		<p>Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Minus autem quos debitis odit qui doloribus explicabo commodi delectus, veniam dolores sit, aperiam, corporis a, tempora. In deserunt illo, nemo laudantium!</p>
	</div>
</div>


