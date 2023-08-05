
<?php 
	$file = array(
		'product/index.css',
		'dataTable/index.css',
		'date-range-picker/index.css',
		'dataTable/index.js',
		'dataTable/c-index.js',
		'date-range-picker/moment.min.js',
		'date-range-picker/index.js',
		'product/index.js'
	);

	$this->is_app->load_assets($file);
?>

<div class="row gy-4">
	<div class="col-12">
		<?php 
			$url = base_url("product/fetch_add_product");
			$title = '<i class=ri-add-circle-fill></i>';
			$attr = [
				'class' => 'btn btn-sm btn-success',
				'content' => "<i class='ri-add-fill'></i>",
				'onclick' => "fetch_form_product('{$url}', '{$title} Product')"
			];
			
			echo form_button($attr);
		?>
	</div>

	<div class="col-12" id="fetch_table_product"></div>
</div>



