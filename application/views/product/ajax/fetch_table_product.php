
<div class="bootstrap-table">
	<table class="table table-hover nowrap" id="fetch_table_product" width="100%"></table>	
</div>

<script>
	$('table[id="fetch_table_product"]').dataTable({
		order: [],
		scrollX: true,
		data: <?=json_encode($result)?>,
		columns:
		[
			{ title: 'Detail <i class="ri-shopping-bag-3-fill"></i>', data: 'product_details' },
			{ title: 'Product type <i class="ri-product-hunt-fill"></i>', data: 'product_type' },
			{ title: 'Date <i class="ri-calendar-todo-fill"></i> ', data: 'date_created' }
		]  
	});
</script>
	
